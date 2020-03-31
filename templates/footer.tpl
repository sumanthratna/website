        <footer>
            <div id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-pb-sm">
                            <div class="row">
                                <div class="col-md-10">
                                    <h2>Let's Talk</h2>
                                    <p>Email me.</p>
                                    <p>{mailto address='sratna@'|cat:$smarty.server.HTTP_HOST}</p>
                                    {include file='socials.tpl'}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-pb-sm">
                            <h2>Latest Blog Posts</h2>
                            <div style="height:300px; overflow-y:scroll">
                                {foreach from=$posts key=id item=post}
                                    {assign var=post_url value={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/blog/'|cat:$id}}
                                    {assign var=img_url value=$post.image}
                                    {assign var=post_date value=$post.date}
                                    {assign var=post_title value=$post.title}
                                    <div class="f-entry">
                                        <a href={$post_url} class="featured-img" style="background-image: url({$img_url});"></a>
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
    <script src={'https://'|cat:$smarty.server.HTTP_HOST|cat:'/js/main.js'}></script>
</body>
</html>
