<?php
session_start();
switch ($_GET['action']) {
case 'login':
    if (isset($_SESSION['user'])) {
        header("Location: https://".$_SERVER['SERVER_NAME']."/admin/manage");
        die();
    }
    if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST)) {
        $config = parse_ini_file('../private/keys.ini');
        $db = mysqli_connect('mysql1.csl.tjhsst.edu:3306/site_2022sratna', 'site_2022sratna', $config['database'], 'site_2022sratna');
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $sql = "SELECT id FROM users WHERE username = '$username' and password = SHA2('$password', 512)";
        $result = mysqli_query($db, $sql);
        if (!$result) {
            printf("Error: %s\n", mysqli_error($db));
            die();
        }
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        // $active = $row['active'];
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $_SESSION['user'] = $username;
            $message = "Authentication successful";
            header("Location: https://".$_SERVER['SERVER_NAME']."/admin/manage");
        } else {
            http_response_code(403);
            $message = "Invalid credentials";
        }
        $output = json_encode(array("message" => $message));
        echo $output;
        return $output;
    }
  exit();
  break;

case 'logout':
    if (session_destroy()) {
        header("Location: https://".$_SERVER['SERVER_NAME']."/admin/login");
    }
    exit();
    break;

default:
  //do nothing
  die();
}
?>