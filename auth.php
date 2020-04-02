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
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $pdo = new PDO('mysql:dbname=site_2022sratna;host=mysql1.csl.tjhsst.edu;port=3306;charset=utf8', 'site_2022sratna', $config['database']);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username and password = SHA2(:password, 512)');
        $stmt->execute([ 'username' => $username, 'password' => $password ]);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        
        if (!empty($result)) {
            $_SESSION['user'] = $username;
            $message = "Authentication successful";
        } else {
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