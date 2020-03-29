<?php
error_log(print_r($_POST, TRUE));
if ($_SERVER['REQUEST_METHOD']=="POST" and isset($_POST)) {
    $config = parse_ini_file('../private/keys.ini');
    if ($_POST['secret'] == $config['secret']) {
        $neverbounce_key = $config['neverbounce_key'];
        $sendgrid_key = $config['sendgrid_key'];
        
        require_once 'vendor/autoload.php';
        
        error_log('CONTACT '.json_encode($_POST));
        
        $message = '';
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
                $message = 'error sending message (but a valid sender email was detected):<br><br>'.$e->getMessage();
            }
        } else {
            $message = "invalid email address";
        }
        $output = json_encode(array("message" => $message));
    } else {
        $output = 'INVALID SECRET';
    }
    echo $output;
    return $output;
}
?>
