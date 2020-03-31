{include file='header.tpl' page='blog'}
<div id="sratna-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="blog-entry animate-box col-pb-sm">
                    <a href="#" class="blog-img"><img src={nocache}{$post.image}{/nocache} class="img-responsive" alt=""></a>
                    <div class="desc">
                        <h3><a href="#">{nocache}{$post.title}{/nocache}</a></h3>
                        <span><small>{nocache}{$post.date}{/nocache}</small> | <small><i class="icon-bubble3"></i> {nocache}{$post.comments|@count}{/nocache}</small></span>
                        <p>
                            {nocache}{$post.contents}{/nocache}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{include file='footer.tpl'}
