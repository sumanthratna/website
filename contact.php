<?php

function contact($recaptchaResp, $requestSecret, $requestName, $requestEmail, $requestMessage) {
    $config = parse_ini_file('../private/keys.ini');

    $message = '';

    if (!$recaptchaResp->isSuccess()) {
        $message = 'ReCAPTCHA failed.'.$recaptchaResp->getErrorCodes();
    } else {
        if ($requestSecret == $config['secret']) {
            $neverbounce_key = $config['neverbounce_key'];
            $sendgrid_key = $config['sendgrid_key'];

            \NeverBounce\Auth::setApiKey($neverbounce_key);
            try {
                $validemail = \NeverBounce\Single::check($requestEmail, true, true);
                if ($validemail->result_integer==0 || $validemail->result_integer==4) {
                    $email = new \SendGrid\Mail\Mail();
                    $email->setFrom($validemail->email);
                    $email->setSubject('Contact - Sumanth Ratna');
                    $email->addTo("sratna@sumanthratna.ml", "Sumanth Ratna");
                    $email->addContent("text/html", nl2br($requestMessage).'<br><br><br><br>-------------------<br>'.'- '.trim($requestName));
                    $sendgrid = new \SendGrid($sendgrid_key);
                    try {
                        $response = $sendgrid->send($email);
                        $message = 'Success! Thanks for your message!';
                    } catch (Exception $e) {
                        $message = 'Error sending message (but a valid sender email was detected):<br><br>'.$e->getMessage();
                    }
                } else {
                    $message = 'Invalid email address.';
                }
            } catch (\NeverBounce\Errors\HttpClientException $e) {
                $message = $e->getMessage();
            }
        } else {
            $message = 'INVALID SECRET';
        }
    }
    $log_data = array();
    $log_data['sender'] = $requestName;
    $log_data['sender_email'] = $requestEmail;
    $log_data['message'] = $requestMessage;
    $log_data['recaptcha_score'] = $recaptchaResp->getScore();
    $log_data['output_message'] = $message;
    error_log('CONTACT '.json_encode($log_data, JSON_PRETTY_PRINT));
    return $message;
}
