<?php
require_once 'templates.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD']=="POST" and isset($_POST['contact'])) {
    require_once 'vendor/autoload.php';
    $data = $_POST['contact'];
    $message = '';
    \NeverBounce\Auth::setApiKey($neverbounce_key);
    $validemail = \NeverBounce\Single::check($data[2], true, true);
    if ($validemail->result_integer==0 || $validemail->result_integer==4) {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($validemail->email);
        $email->setSubject('Contact - Sumanth Ratna');
        $email->addTo("sratna@sumanthratna.gq", "Sumanth Ratna");
        $email->addContent("text/html", nl2br($data[0]).'<br><br><br><br>-------------------<br>'.'- '.trim($data[1]));
        $sendgrid = new \SendGrid($sendgrid_key);
        try {
            $response = $sendgrid->send($email);
            $message = 'Thanks for your message!';
        } catch (Exception $e) {
            $message = 'error sending message (but a valid email was detected):\n\n'.$e->getMessage().'\n\nHere\'s what you wrote:\n'.nl2br($data[2]);
        }
    } else {
        $message = 'invalid email address\n\nHere\'s what you wrote:\n'.nl2br($data[2]);
    }
}
?>
<?php get_header('contact'); ?>
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
					    <div class="animate-box">
					        <center>You can contact me about any of my projects including FCPS GradeView. </center>
					    </div>
					    <br>
						<div class="row">
							<div class="col-md-4 animate-box">
								<h3>My Address</h3>
								<ul class="contact-info">
									<li><span><i class="icon-map5"></i></span>7214 Bull Run Post Office Rd, Centreville, VA 20121</li>
									<li><span><i class="icon-phone4"></i></span>+1(571)241-0094</li>
									<li><span><i class="icon-envelope2"></i></span><a href="mailto:sratna@sumanthratna.gq">sratna@sumanthratna.gq</a></li>
									<li><span><i class="icon-globe3"></i></span><a href="https://sumanthratna.gq">sumanthratna.gq</a></li>
								</ul>
							</div>
                            <div class="col-md-7 col-md-push-1 animate-box">
							    <?php if (!empty($message)): ?>
                                    <?php echo($message);?>
    						    <?php else: ?>
						            <form action="" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="contact[0]" class="form-control" id="" cols="30" rows="7" placeholder="Message (supports HTML markup)"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input name="contact[1]" type="text" class="form-control" placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input name="contact[2]" type="email" class="form-control" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input name="submit" type="submit" value="Send Message" class="btn btn-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
							    <?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php get_footer(); ?>
