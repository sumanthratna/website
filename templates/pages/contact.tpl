{include file='header.tpl' page='contact'}
<div id="sratna-contact">
    <div class="container">
        <div class="row text-center">
            <h2 class="bold">Contact</h2>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-0 text-center animate-box intro-heading">
                <span>Contact</span>
                <h2>Contact Me</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="rotate">
                    <h2 class="heading">Contact</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="row">
                    <div class="col-md-4 animate-box">
                        <h3>My Address</h3>
                        <ul class="contact-info">
                            {*<li><span><i class="icon-map5"></i></span>7214 Bull Run Post Office Rd, Centreville, VA 20121</li>*}
                            {*<li><span><i class="icon-phone4"></i></span>+1(571)241-0094</li>*}
                            <li><span><i class="icon-envelope2"></i></span>{mailto address='sratna@'|cat:$smarty.server.HTTP_HOST}</li>
                            <li><span><i class="icon-globe3"></i></span><a href={'https://'|cat:$smarty.server.HTTP_HOST}>{$smarty.server.HTTP_HOST}</a></li>
                        </ul>
                    </div>
                    <div class="col-md-7 col-md-push-1 animate-box">
                        <p id="output-message">&#8203;</p>
                        <form id="contact-form" action="/api/contact" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea id="message" name="message" class="form-control" cols="30" rows="7" placeholder="Message (supports HTML markup)"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="email" name="email" type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="submit" name="submit" type="submit" value="Send Message" class="btn btn-primary">
                                    </div>
                                </div>
                                <input type="hidden" name="recaptcha-response" id="recaptcha-response">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js?render={$recaptcha_site_key}"></script>
<script>
    /* attach a submit handler to the form */
    $("#contact-form").submit(function(event) {
        /* stop form from submitting normally */
        event.preventDefault();
    
        $("#output-message").fadeOut(function() {
            $(this).text('Loading...').fadeIn();
        });
        $("#message").prop("disabled", true);
        $("#name").prop("disabled", true);
        $("#email").prop("disabled", true);
        $("#submit").prop("disabled", true);
    
        /* get the action attribute from the <form> element */
        var $form = $(this),
            url = $form.attr('action');
    
        grecaptcha.execute('{$recaptcha_site_key}', {
            action: 'contact'
        }).then(function(token) {
            $('#recaptcha-response').val(token);
    
            /* Send the data using post */
            var $secret = "{$secret|escape:'javascript'}";
            var posting = $.post(url, {
                message: $('#message').val(),
                name: $('#name').val(),
                email: $("#email").val(),
                secret: $secret,
                recaptcha_response: $('#recaptcha-response').prop("value")
            });
            /* Alerts the results */
            posting.done(function(data) {
                var outputMessage = jQuery.parseJSON(data).message;
                $("#output-message").fadeOut(function() {
                    $(this).text(outputMessage).fadeIn();
                });
                if (outputMessage == 'Success! Thanks for your message!') {
                    $("#message").val('');
                    $("#name").val('');
                    $("#email").val('');
                }
                $("#message").prop("disabled", false);
                $("#name").prop("disabled", false);
                $("#email").prop("disabled", false);
                $("#submit").prop("disabled", false);
            });
        });
    });
</script>
{include file='footer.tpl'}
