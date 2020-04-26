<?php
require "db.php";
//require "auth.php";
session_start();
require "registerError.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Register to BAZINGA</title>

	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap.css">
	<link rel="shortcut icon" href="../icon/logoo.png" type="image/x-icon" />

	<!-- Main Styles CSS -->
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	<link rel="stylesheet" type="text/css" href="../css/normalize.css">

	<!-- Main Font -->
	<script src="../js/webfontloader.min.js"></script>
	<script src="../js/webfont.js"></script>
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
					<a href="login.php" class="btn btn-md btn-border c-white">Login Now!</a>
				</div>
			</div>

			<div class="col col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">

				<!-- Login-Registration Form  -->

				<div class="registration-login-form">
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="home" role="tabpanel" data-mh="log-tab">
							<div class="title h6">Register to Bazinga</div>

							<form class="content" action="upload.php" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group label-floating is-empty">
											<label class="control-label">First Name</label>
											<input class="form-control" placeholder="" type="text" name="first_name" required>
											<?php
											if (isset($fname_error)) {
												echo "<p style='padding-top:5px; font-size:12px; text-align:right;'>" . $fname_error . "</p>";
											}
											?>
										</div>
									</div>
									<div class="col col-12 col-xl-6 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Last Name</label>
											<input class="form-control" placeholder="" type="text" name="last_name" required>
											<?php
											if (isset($lname_error)) {
												echo "<p style='padding-top:5px; font-size:12px; text-align:right;'>" . $lname_error . "</p>";
											}
											?>
										</div>
									</div>
									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Email</label>
											<input class="form-control" placeholder="" type="email" name="email" required>
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Password</label>
											<input class="form-control" placeholder="" type="password" name="password" required>
										</div>
										<div class="form-group date-time-picker label-floating">
											<label class="control-label">Birthday</label>
											<input type="date" value="1984-10-12" name="birth_date" />
										</div>
										<div class="form-group label-floating is-select">
											<label class="control-label">Gender</label>
											<select class="selectpicker form-control" name="gender">
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
									</div>

									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Phone</label>
											<input class="form-control" placeholder="" type="text" name="phone" required>
											<?php
											if (isset($phone_error)) {
												echo "<p style='padding-top:5px; font-size:12px; text-align:right;'>" . $phone_error . "</p>";
											}
											?>
										</div>
									</div>

									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">

										<div class="input-container">
											<input type="file" name='p_image' id="real-input">
											<button class="browse-btn">
												Browse Files
											</button>
											<span class="file-info">Upload a Profile Picture</span>
										</div>

										<?php
										if (isset($error)) {
											echo "<p style='padding-top:5px; font-size:12px; text-align:right;'>" . $error . "</p>";
										}
										if (isset($ext_error)) {
											echo "<p style='padding-top:5px; font-size:12px; text-align:right;'>" . $ext_error . "</p>";
										}
										if (isset($mb_error)) {
											echo "<p style='padding-top:5px; font-size:12px; text-align:right;'>" . $mb_error . "</p>";
										}
										?>
									</div>

									<div class="col col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
										<div class="remember">
											<div class="checkbox">
												<label>
													<input name="optionsCheckboxes" type="checkbox" required>
													I accept the Terms and Conditions of the website
												</label>
											</div>
										</div>

										<input type="hidden" name="postcsrf" value="<?= isset($csrf_token) ? $csrf_token : ""; ?>">
										<button class="btn btn-purple btn-lg full-width" type="submit" name="regSubmit">Complete Registration!</button>
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
	<script src="../js/bootstrap-select.js"></script>
	<script src="../js/smooth-scroll.js"></script>
	<script src="../js/swiper.jquery.js"></script>
	<script src="../js/moment.js"></script>
	<script src="../js/daterangepicker.js"></script>
	<script src="../js/simplecalendar.js"></script>
	<script src="../js/fullcalendar.js"></script>
	<script src="../js/base-init.js"></script>
	<script src="../bootstrap/dist/js/bootstrap.bundle.js"></script>
	<script src="../js/uploadBtn.js"></script>

</body>

</html>