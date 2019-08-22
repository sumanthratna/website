<?php require_once dirname(__FILE__).'/../../templates.php'; ?>
<?php get_header('blog'); ?>
<div id="sratna-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="blog-entry animate-box col-pb-sm">
                    <a href="#" class="blog-img"><img src="img.jpg" class="img-responsive" alt=""></a>
                    <div class="desc">
                        <h3><a href="#">How to download a Box file from the command line</a></h3>
                        <span><small>June 20, 2019</small> | <small><i class="icon-bubble3"></i> 0</small></span>
                        <p>
                            <code>curl -L https://api.box.com/2.0/files/[FILE ID]/content -H "Authorization: Bearer [DEVELOPER TOKEN]" -o [FILE NAME]</code>
                            Get file ID from URL in browser. Get developer token by creating new Box app. Choose file name.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
