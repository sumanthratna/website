<?php

$domain = "https://".$_SERVER['HTTP_HOST'];

session_start();

if ($_SERVER['REQUEST_METHOD']=="POST") {
    $config = parse_ini_file('../private/keys.ini');
    if (isset($_SESSION['user']) and $_POST['secret'] == $config['secret']) {
        $message = '';
        if (isset($_POST['create'])) {
            $data = $_POST['create'];
            if (empty($data[1])) {
                $data[1] = str_replace('[^0-9a-z\-]', '', preg_replace('/[[:space:]]+/', '-', strtolower($data[0])));
            }
            $data[2] = date("F j, Y", strtotime("$data[2]"));
            mkdir(dirname(__FILE__).'/../blog/'.$data[1], 0755);
            $index = json_decode(file_get_contents(realpath(dirname(__FILE__).'/../index.json')), true);
            $post = array(
                "$data[1]"=>array(
                    "title"=>"$data[0]",
                    "excerpt"=>"$data[3]",
                    "image"=>$domain."/blog/$data[1]/img.jpg",
                    "date"=>"$data[2]",
                    "comments"=>array(),
                    "contents"=>""
                )
            );
            $index = $post+$index;
            // JSON_UNESCAPED_SLASHES is okay here since contents is initialized as an empty string, not HTML
            file_put_contents(realpath(dirname(__FILE__).'/../index.json'), json_encode($index, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            $message = "Successfully created post <a href=\"https://".$domain."/blog/$data[1]\" target=\"_blank\">\"$data[0]\"</a>";
        }
        if (isset($_POST['organize'])) {
            $newArray = array();
            $oldArray = posts();
            foreach (json_decode($_POST['organize']) as $key) {
                $newArray[$key] = $oldArray[$key];
            }
            file_put_contents(realpath(dirname(__FILE__).'/../index.json'), json_encode($newArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }
        if (isset($_POST['edit'])) {
            file_put_contents(realpath(dirname(__FILE__).'/../index.json'), $_POST['edit']);
            $message = 'Successfully updated blog index file.';
        }
    } else {
        $output = 'INVALID SECRET';
    }
    echo $output;
    return $output;
}
?>