<?php

if (filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_URL)==="2022sratna.sites.tjhsst.edu") {
    header("Location: https://sumanthratna.ml".$_SERVER['REQUEST_URI'], true, 301);
    return;
}

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

require_once dirname(__FILE__).'/custom_smarty.php';
if(!isset($_SERVER["DOCUMENT_ROOT"])) {
   $_SERVER["DOCUMENT_ROOT"] = dirname(__FILE__);
}
$smarty = new CustomSmarty(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'));
$smarty->loadFilter('output', 'trimwhitespace');

$posts = json_decode(file_get_contents(__DIR__."/index.json"), true);
$smarty->assign('posts', $posts);

$lunr_posts = array();
foreach ($posts as $id => $post) {
    $lunr_post = $post;
    $lunr_post['id'] = $id;
    $lunr_post['contents'] = strip_tags($post['contents']);
    array_push($lunr_posts, $lunr_post);
}
$smarty->assign('lunr_posts', $lunr_posts);

$config = parse_ini_file('../private/keys.ini');
$smarty->assign('secret', $config['secret']);
$smarty->assign('recaptcha_site_key', $config['recaptcha_site_key']);

$router->get('/', function () use ($smarty) {
    $smarty->display("pages/home.tpl");
});
$router->mount('/blog', function () use ($smarty, $router, $posts) {

    // will result in '/blog/'
    $router->get('/', function () use ($smarty) {
        $smarty->display("pages/blog/index.tpl");
    });

    // will result in '/blog/id'
    $router->get('/([a-z0-9-]+)', function ($id) use ($smarty, $posts) {
        if (isset($posts[$id])) {
            $post = $posts[$id];
            // error_log(print_r($posts, TRUE));
            $smarty->assign('post_id', $id);
            $smarty->assign('post', $post);
            $smarty->display("pages/blog/post.tpl");
        } else {
            // trigger 404
            print_r('404');
        }
    });
});
$router->get('/about', function () use ($smarty) {
    $smarty->display("pages/about.tpl");
});
$router->get('/contact', function () use ($smarty) {
    $smarty->display("pages/contact.tpl");
});
$router->mount('/admin', function () use ($smarty, $router) {
    session_start();

    // will result in '/admin/'
    $router->get('/', function () use ($smarty) {
        if (isset($_SESSION['user'])) {
            header("Location: https://".$_SERVER['SERVER_NAME']."/admin/manage");
        } else {
            header("Location: https://".$_SERVER['SERVER_NAME']."/admin/login");
        }
    });

    // will result in '/admin/manage'
    $router->get('/manage', function () use ($smarty) {
        if (isset($_SESSION['user'])) {
            $smarty->display("pages/admin/manage.tpl");
        } else {
            header("Location: https://".$_SERVER['SERVER_NAME']."/admin/login");
        }
    });

    // will result in '/admin/logout'
    $router->get('/logout', function () use ($smarty) {
        header("Location: https://".$_SERVER['SERVER_NAME']."/auth.php?action=logout");
    });

    // will result in '/admin/login'
    $router->get('/login', function () use ($smarty) {
        if (isset($_SESSION['user'])) {
            header("Location: https://".$_SERVER['SERVER_NAME']."/admin/manage");
        } else {
            $smarty->display("pages/admin/login.tpl");
        }
    });
});
$router->get('/search', function () use ($smarty) {
    $smarty->display("pages/search.tpl");
});
$router->get('/ibet', function () use ($smarty) {
    header("Location: https://sumanthratna.ml/assets/ibet.pdf", true, 301);
});
$router->get('/ibet.pdf', function () use ($smarty) {
    header("Location: https://sumanthratna.ml/assets/ibet.pdf", true, 301);
});
$router->mount('/api', function () use ($router) {
    
    function getRecaptchaResult($server_name, $recaptcha_response, $requestIP) {
        include_once('contact.php');
        require __DIR__ . '/vendor/autoload.php';
        $config = parse_ini_file('../private/keys.ini');
        $recaptcha = new \ReCaptcha\ReCaptcha($config['recaptcha_secret']);
        $recaptchaResp = $recaptcha
                            ->setExpectedHostname($server_name)
                            ->setExpectedAction('contact')
                            ->verify(
                                $recaptcha_response, 
                                $requestIP
                            );
        return $recaptchaResp;
    }

    // will result in '/api/contact'
    $router->post('/contact', function () {
        $recaptchaResp = getRecaptchaResult(
            $_SERVER['SERVER_NAME'], 
            $_POST['recaptcha_response'], 
            filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP)
        );
        $log_data = array();
        $log_data['sender'] = $requestName = $_POST['name'];
        $log_data['sender_email'] = $requestEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $log_data['message'] = $requestMessage = $_POST['message'];
        $log_data['recaptcha_score'] = $recaptchaResp->getScore();
        $message = $recaptchaResp->isSuccess() ? contact(
            $_POST['secret'], 
            $requestName, 
            $requestEmail, 
            $requestMessage
        ):('ReCAPTCHA failed.'.$recaptchaResp->getErrorCodes());
        $log_data['output_message'] = $message;
        print(json_encode(array("message" => $message)));
        error_log('CONTACT '.json_encode($log_data, JSON_PRETTY_PRINT));
    });

});
$router->set404(function () use ($smarty) {
    header('HTTP/1.1 404 Not Found');
    $smarty->display("pages/404.tpl");
});
$router->run(function () {
    function wasReferredFromThis($referer) {
        return (
            strncmp($referer, "https://sumanthratna.ml", 23)===0 || 
            strncmp($referer, "http://sumanthratna.ml", 22)===0
        );
    }
    function isBot($userAgent) {
        // https://stackoverflow.com/a/15047834/7127932
        return (
            isset($userAgent)
            && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $userAgent)
        );
    }
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']:'';
    if (!(substr($_SERVER['REQUEST_URI'], 0, 4) === "/api" && wasReferredFromThis($referer))) {
        $requestURL = (isset($_SERVER["HTTPS"]) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $hit = array(
            "URL" => $requestURL,
            "IP" => filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP),
            "referrer" => $referer,
            "is_bot" => isBot($_SERVER['HTTP_USER_AGENT'])
        );
        error_log('HIT '.json_encode($hit, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
    }
    
});
