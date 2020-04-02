<?php

if ($_SERVER['REQUEST_METHOD']=="POST" and isset($_POST['recaptcha_response'])) {
    $config = parse_ini_file('../private/keys.ini');
    
    $message = '';
    
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = $config['recaptcha_secret'];
    $recaptcha_response = $_POST['recaptcha_response'];

    // Make and decode POST request:
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    // Take action based on the score returned:
    $recaptcha_score = $recaptcha->score;
    $captcha_success = $recaptcha_score >= 0.5;
    if (!$captcha_success) {
        $message = 'ReCAPTCHA failed.';
    } else {
        if ($_POST['secret'] == $config['secret']) {
            $neverbounce_key = $config['neverbounce_key'];
            $sendgrid_key = $config['sendgrid_key'];
            
            require_once 'vendor/autoload.php';
            
            $log_data = array();
            $log_data['sender'] = $_POST['name'];
            $log_data['sender_email'] = $_POST['email'];
            $log_data['message'] = $_POST['message'];
            $log_data['recaptcha_score'] = $recaptcha_score;
            error_log('CONTACT '.json_encode($log_data, JSON_PRETTY_PRINT));
            
            \NeverBounce\Auth::setApiKey($neverbounce_key);
            $validemail = \NeverBounce\Single::check($_POST['email'], true, true);
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
        } else {
            $message = 'INVALID SECRET';
        }
    }
    $output = json_encode(array("message" => $message));
    echo $output;
    return $output;
}
?>
