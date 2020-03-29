{include file='header.tpl' page='blog'}
<div id="sratna-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="blog-entry animate-box col-pb-sm">
                    <a href="#" class="blog-img"><img src={$post.image} class="img-responsive" alt=""></a>
                    <div class="desc">
                        <h3><a href="#">{$post.title}</a></h3>
                        <span><small>{$post.date}</small> | <small><i class="icon-bubble3"></i> {$post.comments|@count}</small></span>
                        <p>
                            {$post.contents}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{include file='footer.tpl'}
