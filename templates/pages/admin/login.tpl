{include file='header.tpl' page='admin'}
<div id="sratna-login">
    <div class="container">
        <div class="row text-center">
			<h2 class="bold">Login</h2>
		</div>
		<div class="row">
			<div class="col-md-12 col-md-offset-0 text-center animate-box intro-heading">
				<span>Admin Login</span>
				<h2>Login</h2>
			</div>
		</div>
		<p id="output-message" style="text-align: center;">&#8203;</p>
		<div class="col-md-7 col-md-push-1 animate-box">
            <form id="login-form" action="../auth.php?action=login" method="post" autocomplete="on">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username: </label><input id="username" name="username" type="text" class="form-control" autocomplete="username">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password: </label><input id="password" name="password" type="password" class="form-control" autocomplete="current-password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input id="submit" name="submit" type="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="recaptcha-response" id="recaptcha-response">
            </form>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js?render={$recaptcha_site_key}"></script>
<script>
/* attach a submit handler to the form */
$("#login-form").submit(function(event) {

  /* stop form from submitting normally */
  event.preventDefault();
  
  $("#output-message").fadeOut(function() {
      $(this).text('Loading...').fadeIn();
  });
  $("#username").prop( "disabled", true );
  $("#password").prop( "disabled", true );
  $("#submit").prop( "disabled", true );

  /* get the action attribute from the <form> element */
  var $form = $( this ), url = $form.attr( 'action' );

  grecaptcha.execute('{$recaptcha_site_key}', { action: 'login' } ).then(function(token) {
        $('#recaptcha-response').val(token);
      /* Send the data using post */
      var $secret = "{$secret|escape:'javascript'}";
      var posting = $.post( url, { username: $('#username').val(), password: $('#password').val(), secret: $secret, recaptcha_response: $('#recaptcha-response').prop("value") } );

      /* Alerts the results */
      posting.done(function( data ) {
            var outputMessage = jQuery.parseJSON(data).message;
            $("#output-message").fadeOut(function() {
                $(this).text(outputMessage).fadeIn();
            });
          if (outputMessage == 'Invalid credentials') {
                $("#submit").prop( "disabled", false );
                $("#username").prop( "disabled", false );
                $("#password").prop( "disabled", false );
                $("#submit").prop( "disabled", false );
          } else {
                window.location.replace("{'https://'|cat:$smarty.server.HTTP_HOST|cat:'/admin/manage'}");
          }
      });
  });
});
</script>
{include file='footer.tpl'}
