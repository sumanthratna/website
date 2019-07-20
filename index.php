<?php
require_once 'templates.php';
?>
<?php get_header('home'); ?>
<div id="sratna-about">
    <div class="container">
        <div class="row text-center">
            <h2 class="bold">About</h2>
        </div>
        <div class="row">
            <div class="col-md-5 animate-box">
                <div class="owl-carousel3">
                    <div class="item">
                        <img class="img-responsive about-img" src="images/me.jpg" alt="a picture of me">
                    </div>
                    <div class="item">
                        <!--<img class="img-responsive about-img" src="images/about-2.jpg">-->
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-md-push-1 animate-box">
                <div class="about-desc">
                    <div class="owl-carousel3">
                        <div class="item">
                            <h2><span>Sumanth</span><span>Ratna</span></h2>
                        </div>
                        <div class="item">
                            <h2><span>I'm </span><span>A Student</span></h2>
                        </div>
                    </div>
                    <div class="desc">
                        <div class="rotate">
                            <h2 class="heading">About</h2>
                        </div>
                        <p>I'm a rising sophomore at the Thomas Jefferson High School for Science and Technology. <a href="#sratna-services">I like to code</a>, especially with machine learning, mobile apps, and web development.</p>
                        <?php socials(); ?>
                        <p><a href="contact.php" class="btn btn-primary btn-outline">Contact Me!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="sratna-services">
    <div class="container">
        <div class="row text-center">
            <h2 class="bold">Skills</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="services-flex">
                    <div class="one-third">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0 animate-box intro-heading">
                                <span>My Skills</span>
                                <h2>Here Are Some of My Skills</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="rotate">
                                    <h2 class="heading">Skills</h2>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="services animate-box">
                                    <h3>1 - General Computer Science</h3>
                                    <ul>
                                        <li>Machine Learning/TensorFlow</li>
                                        <li>Mobile App Development/Flutter</li>
                                    </ul>
                                </div>
                                <div class="services animate-box">
                                    <h3>3 - Web Development</h3>
                                    <ul>
                                        <li>HTML</li>
                                        <li>CSS/Bootstrap</li>
                                        <li>JavaScript/Angular</li>
                                        <li>Dynamic Websites/Content Management Systems/WordPress</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="services animate-box">
                                    <h3>2 - Programming Languages</h3>
                                    <ul>
                                        <li>C/C++/Java</li>
                                        <li>Python</li>
                                        <li>AppleScript/Bash</li>
                                        <li>PHP</li>
                                        <li>Dart</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="one-forth services-img" style="background-image: url(images/services-img-1.jpg);"></div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div id="sratna-work">
    <div class="container">
        <div class="row text-center">
            <h2 class="bold">Projects</h2>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-0 text-center animate-box intro-heading">
                <span>Portfolio</span>
                <h2>Done Projects</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="rotate">
                    <h2 class="heading">Portfolio</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="work-entry animate-box">
                    <a href="work.html" class="work-img" style="background-image: url(images/work-1.jpg);">
                        <div class="display-t">
                            <div class="work-name">
                                <h2>Pursuing Best</h2>
                            </div>
                        </div>
                    </a>
                    <div class="col-md-4 col-md-offset-4">
                        <div class="desc">
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                            <p class="read"><a href="#">View details</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="work-entry animate-box">
                    <a href="work.html" class="work-img" style="background-image: url(images/work-2.jpg);">
                        <div class="display-t">
                            <div class="work-name">
                                <h2>Coordinates</h2>
                            </div>
                        </div>
                    </a>
                    <div class="col-md-4 col-md-offset-4">
                        <div class="desc">
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                            <p class="read"><a href="#">View Details</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="work-entry animate-box">
                    <a href="work.html" class="work-img" style="background-image: url(images/work-3.jpg);">
                        <div class="display-t">
                            <div class="work-name">
                                <h2>Cristall</h2>
                            </div>
                        </div>
                    </a>
                    <div class="col-md-4 col-md-offset-4">
                        <div class="desc">
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                            <p class="read"><a href="#">View details</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="work-entry animate-box">
                    <a href="work.html" class="work-img" style="background-image: url(images/work-4.jpg);">
                        <div class="display-t">
                            <div class="work-name">
                                <h2>Black</h2>
                            </div>
                        </div>
                    </a>
                    <div class="col-md-4 col-md-offset-4">
                        <div class="desc">
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                            <p class="read"><a href="#">View details</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<div id="sratna-blog">
    <div class="container">
        <div class="row text-center">
            <h2 class="bold">Blog</h2>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-0 text-center animate-box intro-heading">
                <span>Blog</span>
                <h2>Interesting Things</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="rotate">
                    <h2 class="heading">My Blog</h2>
                </div>
            </div>
        </div>
        <div class="row animate-box">
            <div class="owl-carousel1">
                <?php 
                    foreach(posts() as $key=>$value) {
                        echo '<div class="item">';
                            echo '<div class="col-md-12">';
                                echo '<div class="article">';
                                    echo '<a href="'.('//'.$_SERVER['HTTP_HOST'].'/blog/'.$key).'" class="blog-img">';
                                        echo '<img class="img-responsive" src="'.$value['image'].'" alt="">';
                                        echo '<div class="overlay"></div>';
                                        echo '<div class="link">';
                                            echo '<span class="read">Read More</h2>';
                                        echo '</div>';
                                    echo '</a>';
                                    echo '<div class="desc">';
                                        echo '<span class="meta">'.$value['date'].'</span>';
                                        echo '<h2><a href="'.('//'.$_SERVER['HTTP_HOST'].'/blog/'.$key).'">'.$value['title'].'</a></h2>';
                                        echo '<p>'.$value['excerpt'].'</p>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php echo get_footer(); ?>