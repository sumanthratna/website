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
                            <p>I'm a macOS user. I really only have one complaint (it's actually very minor): there's no simple default login icon, like the typical lifeless gray/white/blue person. I decided that I wanted my icon to completely blend in with the login background. There was only one problem&mdash;I had no idea how to do this. </p>
                        
                            <p>I decided to actually figure this out since the red rose was bothering me. I came up with the following (horribly inefficient) psuedocode/algorithm to do this:
                                <ol>
                                    <li>take a screenshot of the login page and name it <code>log.png</code></li>
                                    <li>take a screenshot of your home page and name it <code>desk.png</code></li>
                                    <li>in Preview, use the ellipse selection tool to select the current/bad icon in <code>log.png</code></li>
                                    <li>in Preview, copy the icon with &#8984;-C, paste it onto <code>desk.png</code>, and save this to a new file called <code>newdesk.png</code></li>
                                    <li>in Python, subtract <code>newdesk</code> and <code>desk</code> (this should leave an image array with many zeroes and some non-zero numbers where the old icon was)&mdash;name this new array <code>sub</code></li>
                                    <li>in Python, convert <code>sub</code> into a binary mask by setting all non-zero pixels to 1, name the mask <code>mask</code></li>
                                    <li>load either <code>log</code> or <code>desk</code> (your choice) into a variable named <code>final</code> and set <code>final</code> to zero when <code>mask</code> is 0</li>
                                    <li>save <code>final</code> to <code>final.png</code></li>
                                    <li>in Preview, use the ellipse selection tool to select the new/good icon in <code>final.png</code>, click crop, and save this to a new file called <code>icon.png</code></li>
                                </ol>
                            </p>
                            
                            <p>
                                This resulted in the following Python code (<code>numpy 1.18.2</code> and <code>Pillow 7.1.1</code>):<br>
                                <script src="https://gist.github.com/sumanthratna/8958b9e62f61cc3b9746e3f79634ee5d.js"></script>
                            </p>
                            
                            <p>
                                I'm sure this can be made much more efficient with advanced N-dimensional array indexing, but that usually sacrifices code readability. Please contact me if you have ideas on how to make this faster! Note: the final product isn't perfect. 
                            </p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{include file='footer.tpl'}
