<?php

// THIS IS INSECURE, ANYBODY CAN POST TO THIS FILE!

session_start();

if ($_SERVER['REQUEST_METHOD']=="POST") {
    $config = parse_ini_file('../private/keys.ini');
    $posts = json_decode(file_get_contents(__DIR__."/index.json"), TRUE);
    
    if ($_POST['secret'] == $config['secret']) {
        $message = '';
        if (isset($_POST['create'])) {
            $data = $_POST['create'];
            error_log(print_r($data, TRUE));
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
        }
        if (isset($_POST['organize'])) {
            $newArray = array();
            $oldArray = $posts;
            foreach (json_decode($_POST['organize']) as $key) {
                $newArray[$key] = $oldArray[$key];
            }
            file_put_contents(realpath(__DIR__."/index.json"), json_encode($newArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }
        if (isset($_POST['edit'])) {
            file_put_contents(realpath(__DIR__."/index.json"), $_POST['edit']);
            $message = 'Successfully updated blog index file.';
        }
        
        require_once dirname(__FILE__).'/setup.php';
        $smarty = new CustomSmarty();
        $smarty->clearAllCache();
    } else {
        $message = 'INVALID SECRET';
    }
    $output = json_encode(array("message" => $message));
    echo $output;
    return $output;
}
?>