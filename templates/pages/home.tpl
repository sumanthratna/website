{include file='header.tpl' page='home'}
<div id="sratna-about">
    <div class="container">
        <div class="row text-center">
            <h2 class="bold">About</h2>
        </div>
        <div class="row">
            <div class="col-md-5 animate-box">
                <div class="owl-carousel3">
                    <div class="item">
                        {html_image file="images/me.jpg" class="img-responsive about-img" alt="A picture of me." height="458" width="335" loading="lazy"}
                    </div>
                    <div class="item">
                        {html_image file="images/laptop.jpg" class="img-responsive about-img" alt="A picture of me." height="768" width="1024" loading="lazy"}
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-md-push-1 animate-box">
                <div class="about-desc">
                    <div class="owl-carousel3">
                        <div class="item">
                            <h2><span>Sumanth </span><span>Ratna</span></h2>
                        </div>
                        <div class="item">
                            <h2><span>I'm </span><span>A Student</span></h2>
                        </div>
                    </div>
                    <div class="desc">
                        <div class="rotate">
                            <h2 class="heading">About</h2>
                        </div>
                        <p>I'm a sophomore at the Thomas Jefferson High School for Science and Technology. I'm interested in machine learning and biochemistry.</p>
                        {include file='socials.tpl'}
                        <p><a href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/contact'} class="btn btn-primary btn-outline">Contact Me!</a></p>
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
                {foreach from=$posts key=id item=post}
                    {assign var=post_url value={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/blog/'|cat:$id}}
                    {assign var=img_url value=$post.image}
                    {assign var=post_date value=$post.date}
                    {assign var=post_title value=$post.title}
                    {assign var=post_excerpt value=$post.excerpt}
                    <div class="item">
                        <div class="col-md-12">
                            <div class="article">
                                <a href={$post_url} class="blog-img">
                                    {html_image file=$img_url class="img-responsive" alt="" height="360" loading="lazy"}
                                    <div class="overlay"></div>
                                    <div class="link">
                                        <span class="read">Read More</h2>
                                    </div>
                                </a>
                                <div class="desc">
                                    <span class="meta">{$post_date}</span>
                                    <h2><a href={$post_url}>{$post_title}</a></h2>
                                    <p>{$post_excerpt}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    </div>
</div>
{include file='footer.tpl'}