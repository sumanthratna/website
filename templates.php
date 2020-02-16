<?php
require_once dirname(__FILE__).'/../private/keys.php';
error_log($_SERVER['HTTP_HOST'].' '.$_SERVER['REMOTE_ADDR'].$_SERVER['REQUEST_URI']);
if ($_SERVER['HTTP_HOST']==="2022sratna.sites.tjhsst.edu") {
    header("Location: https://sumanthratna.ml$_SERVER[REQUEST_URI]");
}
function socials()
{
    // make size 48x48px
    $out = <<<HTML
<p class='sratna-social-icons'>
	<a href='https://github.com/sumanthratna/'><i class='icon-github'></i></a>
	<a href='https://stackoverflow.com/users/7127932/sumanth-ratna'><i class='icon-stackoverflow'></i></a>
</p>
HTML;
    echo $out;
}
function posts()
{
    $data = file_get_contents("./index.json");
    return json_decode($data, true);
}
function get_header($page)
{
    $domain = "https://".$_SERVER['HTTP_HOST'];
    $navpages = '';
    $navpages .= '<li'.($page==='home' ? ' class="active"':'').'><a href="'.$domain.'">Home</a></li>';
    $navpages .= '<li'.($page==='blog' ? ' class="active"':'').'><a href="'.$domain.'/blog">Blog</a></li>';
    $navpages .= '<li'.($page==='about' ? ' class="active"':'').'><a href="'.$domain.'/about.php">About</a></li>';
    $navpages .= '<li'.($page==='contact' ? ' class="active"':'').'><a href="'.$domain.'/contact.php">Contact</a></li>';

    $title = ucfirst($page).' - Sumanth Ratna';

    $out = <<<EOT
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>$title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sumanth Ratna" />
        <meta name="keywords" content="Sumanth Ratna" />
        <meta name="author" content="Sumanth Ratna" />

        <meta property="og:title" content="Sumanth Ratna" />
        <meta property="og:image" content="images/me.jpg" />
        <meta property="og:url" content="$domain" />
        <link rel="canonical" href="$domain/"/>

        <style>
            html, body {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }
        </style>

        <link rel="shortcut icon" href="favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700" rel="stylesheet">

        <link rel="stylesheet" href="$domain/css/animate.css">

        <link rel="stylesheet" href="$domain/css/icomoon.css">

        <link rel="stylesheet" href="$domain/css/bootstrap.css">

        <link rel="stylesheet" href="$domain/css/owl.carousel.min.css">
        <link rel="stylesheet" href="$domain/css/owl.theme.default.min.css">

        <link rel="stylesheet" href="$domain/css/magnific-popup.css">
        <link rel="stylesheet" href="$domain/style.css">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css">

        <style>
            ::-webkit-scrollbar {
              width: 10px;
            }
            ::-webkit-scrollbar-track {
              background: #f0f0f0;
            }
            ::-webkit-scrollbar-thumb {
              background: #808080;
            }
            ::-webkit-scrollbar-thumb:hover {
              background: #555;
            }
        </style>

        <script src="$domain/js/jquery.min.js"></script>
        <script src="$domain/js/jquery.easing.1.3.js"></script>
        <script src="$domain/js/jquery.waypoints.min.js"></script>
        <script src="$domain/js/jquery.magnific-popup.min.js"></script>
        <script src="$domain/js/bootstrap.min.js"></script>
        <script src="$domain/js/owl.carousel.min.js"></script>
        <script src="$domain/js/modernizr-2.6.2.min.js"></script>

        <!--[if lt IE 9]>
        <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <nav id="sratna-main-nav" role="navigation">
            <a href="#" class="js-sratna-nav-toggle sratna-nav-toggle active"><i></i></a>
            <div class="js-fullheight sratna-table">
                <div class="sratna-table-cell js-fullheight">
                    <div class="row">
                        <div class="col-md-12">
                            get_search_form();
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul>
                                $navpages
                            </ul>
                        </div>
                    </div>
                    <!--<div class="row">
                        <div class="col-md-12">
                            <h2 class="head-title">Works</h2>
                                <a href="images/work-1.jpg" class="gallery image-popup-link text-center" style="background-image: url('images/work-1.jpg');">
                                    <span><i class="icon-search3"></i></span>
                                </a>
                                <a href="images/work-2.jpg" class="gallery image-popup-link text-center" style="background-image: url('images/work-2.jpg');">
                                    <span><i class="icon-search3"></i></span>
                                </a>
                                <a href="images/work-3.jpg" class="gallery image-popup-link text-center" style="background-image: url('images/work-3.jpg');">
                                    <span><i class="icon-search3"></i></span>
                                </a>
                                <a href="images/work-4.jpg" class="gallery image-popup-link text-center" style="background-image: url('images/work-4.jpg');">
                                    <span><i class="icon-search3"></i></span>
                                </a>
                        </div>
                    </div>-->
                </div>
            </div>
        </nav>
        <div id="sratna-page">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="sratna-navbar-brand">
                                <a class="img-responsive sratna-logo" href="$domain">
                                    <img src="$domain/favicon.ico" alt="logo"></img>
                                    <!--<span>S_</span><span>_R</span>-->
                                </a>
                            </div>
                            <a href="#" class="js-sratna-nav-toggle sratna-nav-toggle"><i></i></a>
                        </div>
                    </div>
                </div>
            </header>
EOT;
    echo $out;
}
function get_footer()
{
    $domain = "https://".$_SERVER['HTTP_HOST'];
    $email = "sratna@".$_SERVER['HTTP_HOST'];
    $posts = '';
    foreach (posts() as $key=>$value) {
        $posts .= '<div class="f-entry">';
        $posts .= '<a href="'.($domain.'/blog/'.$key).'" class="featured-img" style="background-image: url(\''.$value['image'].'\');"></a>';
        $posts .= '<div class="desc">';
        $posts .= '<span>'.$value['date'].'</span>';
        $posts .= '<h3><a href="'.($domain.'/blog/'.$key).'">'.$value['title'].'</a></h3>';
        $posts .= '</div>';
        $posts .= '</div>';
    }
    $year = date('Y');
    $out = <<<HTML
        <footer>
            <div id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-pb-sm">
                            <div class="row">
                                <div class="col-md-10">
                                    <h2>Let's Talk</h2>
                                    <p>Email me.</p>
                                    <p><a href="mailto:$email">$email</a></p>
                                    <?php get_socials(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-pb-sm">
                            <h2>Latest Blog</h2>
                            <div style="height:300px; overflow-y:scroll">
                                $posts
                            </div>
                        </div>
                        <div class="col-md-4 col-pb-sm">
                            <h2>Mailing List</h2>
                            <p>UNDER CONSTRUCTION</p>
                            <div class="subscribe text-center">
                                <div class="form-group">
                                    <input type="text" class="form-control text-center" placeholder="Enter Email address">
                                    <input type="submit" value="Subscribe" class="btn btn-primary btn-custom">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p>Copyright &copy; $year All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js"></script>
</body>
        <script src="$domain/js/main.js"></script>
</html>
HTML;
    echo $out;
}
