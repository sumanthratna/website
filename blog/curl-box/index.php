<?php require_once dirname(__FILE__).'/../../templates.php'; ?>
<?php get_header('blog'); ?>
<div id="sratna-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="blog-entry animate-box col-pb-sm">
                    <a href="#" class="blog-img"><img src="img.png" class="img-responsive" alt=""></a>
                    <div class="desc">
                        <h3><a href="#">How to download a Box file from the command line</a></h3>
                        <span><small>June 20, 2019</small> | <small><i class="icon-bubble3"></i> 0</small></span>
                        <p>
                            <code>curl -L https://api.box.com/2.0/files/[FILE ID]/content -H "Authorization: Bearer [DEVELOPER TOKEN]" -o [FILE NAME]</code>
                            First get the file ID from the URL in the browser. Then get the developer token by <a href="https://app.box.com/developers/console">creating a new Box app</a> (click the configuration tab). You can choose the file name to output to. View an example <a href="https://asciinema.org/a/V1NJDw4M8RJvVVVioTIw5qa4j">here</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
