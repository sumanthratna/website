<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{$page|capitalize} - Sumanth Ratna</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="This is Sumanth Ratna's personal website. Sumanth is currently a student at Thomas Jefferson High School for Science and Technology." />
        <meta name="keywords" content="sumanth, ratna, tjhsst" />
        <meta name="author" content="Sumanth Ratna" />

        <meta prefix="og: http://ogp.me/ns#" name="title" property="og:title" content="{$page|capitalize} - Sumanth Ratna" />
        <meta prefix="og: http://ogp.me/ns#" name="image" property="og:image" content="{'https://'|cat:$smarty.server.HTTP_HOST|cat:'/images/ogp.png'}" />
        <meta prefix="og: http://ogp.me/ns#" property="og:image:type" content="image/png" />
        <meta prefix="og: http://ogp.me/ns#" property="og:image:width" content="1200" />
        <meta prefix="og: http://ogp.me/ns#" property="og:image:height" content="627" />
        <meta prefix="og: http://ogp.me/ns#" property="og:image:alt" content="Sumanth Ratna's logo." />
        <meta prefix="og: http://ogp.me/ns#" property="og:url" content="{'https://'|cat:$smarty.server.HTTP_HOST}" />
        <meta prefix="og: http://ogp.me/ns#" name="description" property='og:description' content="This is Sumanth Ratna's personal website. Sumanth is a current student at Thomas Jefferson High School for Science and Technology." />
        <link rel="canonical" href="{'https://'|cat:$smarty.server.HTTP_HOST}" />

        <link rel="shortcut icon" href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/favicon.ico'}>
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700%7CPlayfair+Display:400,400i,700" rel="stylesheet">

        <link rel="stylesheet" href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/css/animate.css'} media="print" onload="this.media='all'">

        <link rel="stylesheet" href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/css/icomoon.css'} media="print" onload="this.media='all'">

        <link rel="stylesheet" href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/css/bootstrap.css'}>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">

        <link rel="stylesheet" href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/css/owl.carousel.min.css'} media="print" onload="this.media='all'">
        <link rel="stylesheet" href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/css/owl.theme.default.min.css'} media="print" onload="this.media='all'">

        <link rel="stylesheet" href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/css/magnific-popup.min.css'}>
        <link rel="stylesheet" href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/style.css'}>

        <link href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/css/normalize.min.css'} media="print" onload="this.media='all'">

        <style>
            html, body {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
                scroll-behavior: smooth;
            }
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

    <script src={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/js/jquery.min.js'}></script>

    </head>
    <body>
        <nav id="sratna-main-nav" role="navigation">
            <a href="#" class="js-sratna-nav-toggle sratna-nav-toggle active"><i></i></a>
            <div class="js-fullheight sratna-table">
                <div class="sratna-table-cell js-fullheight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="search" placeholder="Search...">
                                <button type="submit" id="search-submit" class="btn btn-primary"><i class="icon-search3"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class='sratna-nav'>
                                <li {($page==='home') ? "class='active'":""}><a href={'https://'|cat:$smarty.server.HTTP_HOST}>Home</a></li>
                                <li {($page==='blog') ? "class='active'":""}><a href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/blog'}>Blog</a></li>
                                <li {($page==='about') ? "class='active'":""}><a href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/about'}>About</a></li>
                                <li {($page==='contact') ? "class='active'":""}><a href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/contact'}>Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--<div class="row">
                        <div class="col-md-12">
                            <h2 class="head-title">Works</h2>
                                <a href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/images/work-1.jpg'} class="gallery image-popup-link text-center" style="background-image: url({'https://'|cat:$smarty.server.HTTP_HOST|cat:'/images/work-1.jpg'});">
                                    <span><i class="icon-search3"></i></span>
                                </a>
                                <a href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/images/work-2.jpg'} class="gallery image-popup-link text-center" style="background-image: url({'https://'|cat:$smarty.server.HTTP_HOST|cat:'/images/work-2.jpg'});">
                                    <span><i class="icon-search3"></i></span>
                                </a>
                                <a href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/images/work-3.jpg'} class="gallery image-popup-link text-center" style="background-image: url({'https://'|cat:$smarty.server.HTTP_HOST|cat:'/images/work-3.jpg'});">
                                    <span><i class="icon-search3"></i></span>
                                </a>
                                <a href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/images/work-4.jpg'} class="gallery image-popup-link text-center" style="background-image: url({'https://'|cat:$smarty.server.HTTP_HOST|cat:'/images/work-4.jpg'});">
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
                            <div class="animate-box sratna-navbar-brand">
                                <a class="img-fluid sratna-logo" href={'https://'|cat:$smarty.server.HTTP_HOST}>
                                    {html_image file='https://'|cat:$smarty.server.HTTP_HOST|cat:'/favicon.ico' class="img-fluid" alt="Sumanth Ratna's logo" height="32px" width="32px" loading="lazy"}
                                    <!--<span>S_</span><span>_R</span>-->
                                </a>
                            </div>
                            <a href="#" class="js-sratna-nav-toggle sratna-nav-toggle"><i></i></a>
                        </div>
                    </div>
                </div>
            </header>
