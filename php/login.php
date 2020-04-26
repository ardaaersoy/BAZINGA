<?php
require "db.php";
require "loginProcess.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login to BAZINGA</title>

	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap.css">
	<link rel="shortcut icon" href="../icon/logoo.png" type="image/x-icon" />

	<!-- Main Styles CSS -->
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">

	<!-- Main Font -->
	<script src="../js/webfontloader.min.js"></script>
	<script src="../js/webfont.js"></script>

	<style>
		.row {
			margin-top: 150px;
		}
	</style>
</head>

<body class="landing-page">

	<div class="content-bg-wrap"></div>

	<!-- Header Standard Landing  -->

	<div class="header--standard header--standard-landing" id="header--standard">
		<div class="container">
			<div class="header--standard-wrap">
				<div class="img-wrap">
					<img id="logoBaz" src="../icon/logo.png">
				</div>
			</div>
		</div>
	</div>
	</div>

	<!-- ... end Header Standard Landing  -->
	<div class="header-spacer--standard"></div>

	<div class="container">
		<div class="row display-flex">
			<div class="col col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
				<div class="landing-content">
					<h1>Welcome to the BAZINGA</h1>
					<p>We are the best and biggest social network with 5 billion active users all around the world. Share you
						thoughts, write blog posts, and much more!
					</p>
					<a href="register.php" class="btn btn-md btn-border c-white">Register Now!</a>
				</div>
			</div>

			<div class="col col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">

				<!-- Login-Registration Form  -->

				<div class="registration-login-form">
					<!-- Tab panes -->

					<div class="tab-pane" id="profile" role="tabpanel" data-mh="log-tab">
						<div class="title h6">Login to your Account</div>
						<form action="" class="content" method="POST">
							<div>
								<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
									<div class="form-group label-floating is-empty">
										<label class="control-label">Your Email</label>
										<input class="form-control" placeholder="" type="email" name="loginMail" value="<?= $_COOKIE['usermail'] ?? "";?>" required>
									</div>
									<div class="form-group label-floating is-empty">
										<label class="control-label">Your Password</label>
										<input class="form-control" type="password" name="loginPassword" value="<?= $_COOKIE['password'] ?? "";?>" required>

										<?php
										if (isset($_COOKIE["pass_error"])) {
											$pass_error = unserialize($_COOKIE["pass_error"]);
											$pass_error = $_COOKIE['pass_error'];
											echo "<p style='text-align:right; padding-top:10px;'>" . $pass_error . "</p>";
										}
										if (isset($_COOKIE["user_error"])) {
											$user_error = unserialize($_COOKIE["user_error"]);
											$user_error = $_COOKIE['user_error'];
											echo "<p style='text-align:right; padding-top:10px;'>" . $user_error . "</p>";
										}
										?>

									</div>

									<div class="remember">
										<div class="checkbox">
											<label>
												<input name="optionsCheckboxes" type="checkbox">
												Remember Me
											</label>
										</div>
									</div>

									<input type="hidden" name="postcsrf" value="<?= $csrf_token ?>">
									<button type="submit" class="btn btn-lg btn-primary full-width" name="loginBTN">Login</button>

									<p>Don’t you have an account? <a href="register.php">Register Now!</a> it’s really simple and you can start enjoing all the benefits!</p>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- ... end Login-Registration Form  -->
		</div>
	</div>
	</div>

	<!-- JS Scripts -->
	<script src="../js/jquery-3.2.1.js"></script>
	<script src="../js/material.min.js"></script>
	<script src="../js/base-init.js"></script>

</body>

</html>