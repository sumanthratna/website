<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

require_once dirname(__FILE__).'/setup.php';
$smarty = new CustomSmarty();

$posts = file_get_contents(__DIR__."/index.json");
$smarty->assign('posts', json_decode($posts, true));

$router->get('/', function() use ($smarty) {
    $smarty->display("pages/home.tpl");
});
$router->mount('/blog', function() use ($smarty, $router, $posts) {

    // will result in '/blog/'
    $router->get('/', function() use ($smarty) {
        $smarty->display("pages/blog/index.tpl");
    });

    // will result in '/blog/id'
    $router->get('/{id}', function($id) use ($smarty, $posts) {
        // DOESN'T WORK!
        $post = $posts[$id];
        $smarty->assign('post_id', $id);
        $smarty->assign('post', $post);
        $smarty->display("pages/blog/post.tpl");
    });

});
$router->get('/about', function($name) use ($smarty) {
    $smarty->display("pages/about.tpl");
});
$router->get('/contact', function($name) use ($smarty) {
    $smarty->display("pages/contact.tpl");
});
$router->mount('/admin', function() use ($smarty, $router) {
    
    // will result in '/admin/'
    $router->get('/', function() use ($smarty) {
        if (isset($_SESSION['user'])) {
            header("location: https://".$_SERVER['SERVER_NAME'].'/admin/manage');
        } else {
            header("location: https://".$_SERVER['SERVER_NAME'].'/admin/login');
        }
    });
    
    // will result in '/admin/session'
    $router->get('/session', function() use ($smarty) {
        // COPY LOGIC FROM session.php
    });
    
    // will result in '/admin/manage'
    $router->get('/manage', function() use ($smarty) {
        $smarty->display("pages/admin/manage.tpl");
    });
    
    // will result in '/admin/logout'
    $router->get('/logout', function() use ($smarty) {
        // COPY LOGIC FROM logout.php
        // REDIRECT TO /admin/login
    });

    // will result in '/admin/login'
    $router->get('/login', function() use ($smarty) {
        $smarty->display("pages/admin/session.tpl");
    });
    
    // will result in '/admin/config'
    $router->get('/config', function() use ($smarty) {
        // COPY LOGIC FROM config.php
    });

});
$router->set404(function() use ($smarty) {
    header('HTTP/1.1 404 Not Found');
    $smarty->display("pages/404.tpl");
});

// Run it!
$router->run();
