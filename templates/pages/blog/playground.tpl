{include file='header.tpl' page='blog'}
<div id="sratna-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="blog-entry animate-box col-pb-sm">
                    <a href="#" class="blog-img">
                        {*{html_image file=$post.image class="img-fluid" alt="" loading="lazy"}*}
                        <img src="https://sumanthratna.ml/images/blog/what-is-this.jpg" class="img-fluid" alt="" loading="lazy">
                    </a>
                    <div class="desc">
                        <h3><a href="#">My Blog Playground</a></h3>
                        <span><small>{nocache}{$smarty.now|date_format:"%B %e, %Y"}{/nocache}</small> | <small><i class="icon-bubble3"></i> 0</small></span>
                        <p>
                            content goes here
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{include file='footer.tpl'}
