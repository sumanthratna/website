<?php

if ($_SERVER['REQUEST_METHOD']=="POST" and isset($_POST['recaptcha_response'])) {
    $config = parse_ini_file('../private/keys.ini');

    $message = '';

    require __DIR__ . '/vendor/autoload.php';
    $recaptcha = new \ReCaptcha\ReCaptcha($config['recaptcha_secret']);
    $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
                      ->setExpectedAction('contact')
                      ->verify($_POST['recaptcha_response'], filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP));

    if (!$resp->isSuccess()) {
        $message = 'ReCAPTCHA failed.'.$resp->getErrorCodes();
    } else {
        if ($_POST['secret'] == $config['secret']) {
            $neverbounce_key = $config['neverbounce_key'];
            $sendgrid_key = $config['sendgrid_key'];

            $log_data = array();
            $log_data['sender'] = $_POST['name'];
            $log_data['sender_email'] = $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $log_data['message'] = $_POST['message'];
            $log_data['recaptcha_score'] = $resp->getScore();
            error_log('CONTACT '.json_encode($log_data, JSON_PRETTY_PRINT));

            \NeverBounce\Auth::setApiKey($neverbounce_key);
            try {
                $validemail = \NeverBounce\Single::check($email, true, true);
                if ($validemail->result_integer==0 || $validemail->result_integer==4) {
                    $email = new \SendGrid\Mail\Mail();
                    $email->setFrom($validemail->email);
                    $email->setSubject('Contact - Sumanth Ratna');
                    $email->addTo("sratna@sumanthratna.ml", "Sumanth Ratna");
                    $email->addContent("text/html", nl2br($_POST['message']).'<br><br><br><br>-------------------<br>'.'- '.trim($_POST['name']));
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
    $output = json_encode(array("message" => $message));
    print($output);
    return $output;
}
