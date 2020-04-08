<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('HTTP/1.0 403 Forbidden');
}

if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['recaptcha_response'])) {
    $config = parse_ini_file('../private/keys.ini');

    $message = '';

    require __DIR__ . '/vendor/autoload.php';
    $recaptcha = new \ReCaptcha\ReCaptcha($config['recaptcha_secret']);
    $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
                      ->setExpectedAction('admin')
                      ->verify($_POST['recaptcha_response'], filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP));

    if (!$resp->isSuccess()) {
        $message = 'ReCAPTCHA failed.'.$resp->getErrorCodes();
    } else {
        $posts = json_decode(file_get_contents(__DIR__."/index.json"), true);

        if ($_POST['secret'] == $config['secret']) {
            $message = '';
            if (isset($_POST['create'])) {
                $data = $_POST['create'];
                $data['date'] = date("F j, Y", strtotime($data['date']));
                $post = array(
                    $data['id']=>array(
                        "title"=>$data['title'],
                        "excerpt"=>$data['excerpt'],
                        "image"=>"https://".$_SERVER['SERVER_NAME']."/images/blog/".$data['id'].".png",
                        "date"=>$data['date'],
                        "comments"=>array(),
                        "contents"=>""
                    )
                );
                $posts = $post+$posts;
                // JSON_UNESCAPED_SLASHES won't mess up contents since contents is initialized as an empty string, not HTML
                file_put_contents(realpath(__DIR__."/index.json"), json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
                $message = "Successfully created post <a href=\"https://".$_SERVER['SERVER_NAME']."/blog/".$data['id']."\" target=\"_blank\">".$data['title']."</a>.";
                error_log('ADMIN CREATE '.json_encode($post, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
            }
            if (isset($_POST['organize'])) {
                $newArray = array();
                $oldArray = $posts;
                foreach (json_decode($_POST['organize']) as $key) {
                    $newArray[$key] = $oldArray[$key];
                }
                file_put_contents(realpath(__DIR__."/index.json"), json_encode($newArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
                error_log('ADMIN ORGANIZE '.$_POST['organize']);
            }
            if (isset($_POST['edit'])) {
                file_put_contents(realpath(__DIR__."/index.json"), $_POST['edit']);
                $message = 'Successfully updated blog index file.';
                error_log('ADMIN EDIT '.json_encode(json_decode($_POST['edit'], true)));
            }

            require_once dirname(__FILE__).'/setup.php';
            $smarty = new CustomSmarty(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'));
            $smarty->clearAllCache();
        } else {
            $message = 'INVALID SECRET';
        }
    }
    $output = json_encode(array("message" => $message));
    echo htmlspecialchars($output);
    return $output;
}
