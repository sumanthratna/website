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
        
        $requestUsername = $_POST['username'];
        $requestPassword = $_POST['password'];
        
        error_log(print_r($config, true));
        $dbname = $config['dbname'];
        $host = $config['dbhost'];
        $port = $config['dbport'];
        $username = $config['dbusername'];
        $password = $config['dbpassword'];
        
        $pdo = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port.';charset=utf8', $username, $password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username and password = SHA2(:password, 512)');
        $stmt->execute([ 'username' => $requestUsername, 'password' => $requestPassword ]);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        
        if (!empty($result)) {
            $_SESSION['user'] = $requestUsername;
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