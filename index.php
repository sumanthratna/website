<?php

if (filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_URL)==="2022sratna.sites.tjhsst.edu") {
    header("Location: https://sumanthratna.ml".$_SERVER['REQUEST_URI'], true, 301);
    return;
}

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

require_once dirname(__FILE__).'/setup.php';
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
$router->get('/favicon.ico', function () use ($smarty) {
    header("Location: https://sumanthratna.ml/images/favicon.ico", true, 301);
});
$router->set404(function () use ($smarty) {
    header('HTTP/1.1 404 Not Found');
    $smarty->display("pages/404.tpl");
});
$router->run(function () {
    $hit = array(
        "URL" => (isset($_SERVER["HTTPS"]) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
        "IP" => $_SERVER['REMOTE_ADDR'],
        "referrer" => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']:''
    );
    error_log('HIT '.json_encode($hit, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
});
