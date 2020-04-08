        <footer>
            <div id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-pb-sm">
                            <div class="row">
                                <div class="col-md-10">
                                    <h2><a href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/contact'}>Let's Talk</a></h2>
                                    <p>Email me.</p>
                                    <p>{mailto address='sratna@'|cat:$smarty.server.HTTP_HOST}</p>
                                    {include file='socials.tpl'}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-pb-sm">
                            <h2><a href={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/blog'}>Latest Blog Posts</a></h2>
                            <div style="height:300px; overflow-y:scroll">
                                {foreach from=$posts key=id item=post}
                                    {assign var=post_url value={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/blog/'|cat:$id}}
                                    {assign var=img_url value=$post.image}
                                    {assign var=post_date value=$post.date}
                                    {assign var=post_title value=$post.title}
                                    <div class="f-entry">
                                        <a href={$post_url} class="featured-img"></a>
                                        <div class="desc">
                                            <span>{$post_date}</span>
                                            <h3><a href={$post_url}>{$post_title}</a></h3>
                                        </div>
                                    </div>
                                {/foreach}
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
                            <p>Copyright &copy; {$smarty.now|date_format:"%Y"} All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- START Bootstrap-Cookie-Alert -->
    <div class="alert text-center cookiealert" role="alert">
        <b>Do you like cookies?</b> &#x1F36A; We use cookies to ensure you get the best experience on our website. <a href="https://cookiesandyou.com/" target="_blank" rel="noopener">Learn more</a>
    
        <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
            I agree
        </button>
    </div>
    <!-- END Bootstrap-Cookie-Alert -->
    
    <script src={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/js/jquery.easing.1.3.js'} async></script>
    <script src={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/js/jquery.waypoints.min.js'} defer></script>
    <script src={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/js/jquery.magnific-popup.min.js'} async></script>
    <script src={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/js/bootstrap.min.js'} async></script>
    <script src={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/js/owl.carousel.min.js'} defer></script>
    <!--[if lt IE 9]>
    <script src={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/js/respond.min.js'}></script>
    <![endif]-->
    <script src={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/js/modernizr-2.6.2.min.js'}></script>
    <script src={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/js/main.js'} async></script>
    <script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js"></script>
    <script>
        $("#search-submit").click(function(event) {
            event.preventDefault();
            window.location.replace("{'https://'|cat:$smarty.server.HTTP_HOST|cat:'/search?input='}" + encodeURIComponent($("#search").val()));
        } );
    </script>
</body>
</html>
