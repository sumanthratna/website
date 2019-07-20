<?php 
require_once 'config.php';
require_once '../templates.php';
session_start();
if (isset($_SESSION['user'])) {
    header("location: manage.php");
    die();
}
if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db,$_POST['login'][0]);
    $password = mysqli_real_escape_string($db,$_POST['login'][1]);
    $sql = "SELECT id FROM users WHERE username = '$username' and password = SHA2('$password', 512)";
    $result = mysqli_query($db,$sql);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($db));
        die();
    }
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    $count = mysqli_num_rows($result);
    if($count == 1) {
        $_SESSION['user'] = $username;
        header("location: manage.php");
    }
    else {
        $message = "Invalid credentials";
    }
}
?>
<?php get_header('admin'); ?>
<div id="sratna-about">
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
		<?php if (!empty($message)): ?>
            <div><?php echo $message; ?></div>
        <?php else: ?>
    		<div class="col-md-7 col-md-push-1 animate-box">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username: </label><input name="login[0]" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password: </label><input name="login[1]" type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="submit" type="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>