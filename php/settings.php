<?php
require "db.php";
require "util.php";
require "auth.php";
require "settingsError.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>BAZINGA - Settings</title>

	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap.css">
	<link rel="shortcut icon" href="../icon/logoo.png" type="image/x-icon" />

	<!-- Main Styles CSS -->
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">

	<!-- Main Font -->
	<script src="../js/webfontloader.min.js"></script>
	<script src="../js/webfont.js"></script>
</head>

<body>

	<!-- Header-BP -->

	<header class="header" id="site-header">

		<div class="page-title">
			<a href="profile.php"><img src="../icon/landing.png"></a>
		</div>

		<div class="header-content-wrapper">
			<form class="search-bar w-search notification-list friend-requests" method='post' action=''>
				<div class="form-group with-button">
					<input class="form-control js-user-search" placeholder="Search people..." type="text" name='searchName'>
					<button type='submit' name='searchBtn'>Find</button>
				</div>
			</form>


			<div class="control-block">
				<div class="control-icon more has-items">
					<svg class="olymp-happy-face-icon">
						<use xlink:href="../svg-icons/sprites/icons.svg#olymp-happy-face-icon"></use>
					</svg>
					<?php
					if (!empty($friendrequest))
						echo ("<div class='label-avatar bg-blue'>!</div>");
					?>

					<div class="more-dropdown more-with-triangle triangle-top-center">
						<div class="ui-block-title ui-block-title-small">
							<h6 class="title">FRIEND REQUESTS</h6>
						</div>

						<?php
						if (empty($friendrequest)) {
							echo "	
							<div class='mCustomScrollbar' data-mcs-theme='dark'>
							<ul class='notification-list friend-requests'>
								<li>
									<div class='notification-event'>No friend request yet</div>
								</li>
							</ul>
							</div>";
						}
						for ($i = 0; $i < count($senderInfo); $i++) {
							echo "	
					   <div class='mCustomScrollbar' data-mcs-theme='dark'>
						   <ul class='notification-list friend-requests'>
							   <li>
								   <div class='author-thumb'>
								   
									  <img src='uploaded/{$senderInfo[$i]['profile_picture_url']}' alt='author'>
								   </div>
								   <div class='notification-event'>
									  <p class='h6 notification-friend'>" . $senderInfo[$i]['first_name'] . " " . $senderInfo[$i]['last_name'] . "</p>
								   </div>
								   <span class='notification-icon'>
								   <a href='confirmRequest.php?id=" . $senderInfo[$i]['user_id'] . "&fid=" . $friendrequest[$i]['friendship_id'] . "' class='accept-request'>
										   <span class='icon-add without-text'>
											   <svg class='olymp-happy-face-icon'>
												   <use xlink:href='../svg-icons/sprites/icons.svg#olymp-happy-face-icon'>
												   </use>
											   </svg>
										   </span>
									   </a>
				   
									   <a href='rejectRequest.php?fid=" . $friendrequest[$i]['friendship_id'] . "' class='accept-request request-del'>
										   <span class='icon-minus'>
											   <svg class='olymp-happy-face-icon'>
												   <use xlink:href='../svg-icons/sprites/icons.svg#olymp-happy-face-icon'>
												   </use>
											   </svg>
										   </span>
									   </a>
								   </button>
								   
							   </li>
				   
						   </ul>
					   </div>";
						}
						?>
					</div>
				</div>

				<div class='control-icon more has-items'>
					<svg class='olymp-thunder-icon'>
						<use xlink:href='../svg-icons/sprites/icons.svg#olymp-thunder-icon'></use>
					</svg>
					<?php
					if (!empty($deleterPeople)) {
						echo "<div class='label-avatar bg-primary'>!</div>";
					}

					?>
					<div class='more-dropdown more-with-triangle triangle-top-center'>
						<div class='ui-block-title ui-block-title-small'>
							<h6 class='title'>Notifications</h6>
						</div>

						<?php
						if (empty($deleterPeople)) {
							echo "	
							<div class='mCustomScrollbar' data-mcs-theme='dark'>
							<ul class='notification-list friend-requests'>
								<li>
									<div class='notification-event'>No notifification yet</div>
								</li>
							</ul>
							</div>";
						}
						?>

						<div class='mCustomScrollbar' data-mcs-theme='dark'>
							<ul class='notification-list'>
								<?php
								if (!empty($deleterPeople)) {
									foreach ($deleterPeople as $delpep) {
										echo "
												<li>
													<div class='author-thumb'>
														<img src='uploaded/{$delpep['profile_picture_url']}' alt='author'>
													</div>
													<div class='notification-event'>
														<div><p class='h6 notification-friend'>" . $delpep['first_name'] . " " . $delpep['last_name'] . "</p> has removed you.</div>
													</div>
													<div class='more'>
														<form action='' method='post'>
														<input type='hidden' name='deleterId' value='{$delpep['user_id']}'>
														<button type='submit' name='delNotification'>
															<svg class='olymp-little-delete'>
																<use xlink:href='../svg-icons/sprites/icons.svg#olymp-little-delete'></use>
															</svg>
														</button>
														</form>
													</div>
												</li>
											";
									}
								}
								?>
							</ul>
						</div>
					</div>
				</div>

				<div class="author-page author vcard inline-items more">
					<div class="author-thumb">
						<?php
						echo "<img id='pp' src='uploaded/" . $profile_picture_url . "' alt='author' class='avatar' >";
						?>
						<span class="icon-status online"></span>
						<div class="more-dropdown more-with-triangle">
							<div class="mCustomScrollbar" data-mcs-theme="dark">
								<div class="ui-block-title ui-block-title-small">
									<h6 class="title">Your Account</h6>
								</div>
								<ul class="account-settings">
									<li>
										<a href="settings.php">
											<svg class="olymp-menu-icon">
												<use xlink:href="../svg-icons/sprites/icons.svg#olymp-menu-icon"></use>
											</svg>
											<span>Profile Settings</span>
										</a>
									</li>
									<li>
										<a href="logout.php">
											<svg class="olymp-logout-icon">
												<use xlink:href="../svg-icons/sprites/icons.svg#olymp-logout-icon"></use>
											</svg>
											<span>Log Out</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="author-title author-name fn">
						<?php

						echo $newName, " ", $newSurname;

						?> <svg class="olymp-dropdown-arrow-icon">
							<use xlink:href="../svg-icons/sprites/icons.svg#olymp-dropdown-arrow-icon"></use>
						</svg>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- ... end Header-BP -->

	<div class="header-spacer"></div>

	<!-- Top Header-Profile -->

	<div class="container">
		<div class="row">
			<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="ui-block">
					<div class="top-header">
						<div class="top-header-thumb">
							<div class="content-bg-wrap bg-account"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ... end Top Header-Profile -->

	<!-- Your Account Personal Information -->

	<div class="container">
		<div class="row">
			<div class="col col-xl-9 order-xl-2 col-lg-9 order-lg-2 col-md-12 order-md-1 col-sm-12 col-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Personal Information</h6>

						<?php
						if (isset($_COOKIE["info"])) {
							$info = unserialize($_COOKIE["info"]);
							$info = $_COOKIE['info'];
							echo "<span style='text-align: right;'>$info</span>";
						}

						if (isset($_COOKIE["fname_error"])) {
							$fname_error = unserialize($_COOKIE["fname_error"]);
							$fname_error = $_COOKIE['fname_error'];
							echo "<span style='text-align: right;'>$fname_error</span>";
						}

						if (isset($_COOKIE["lname_error"])) {
							$lname_error = unserialize($_COOKIE["lname_error"]);
							$lname_error = $_COOKIE['lname_error'];
							echo "<span style='text-align: right;'>$lname_error</span>";
						}

						if (isset($_COOKIE["phone_error"])) {
							$phone_error = unserialize($_COOKIE["phone_error"]);
							$phone_error = $_COOKIE['phone_error'];
							echo "<span style='text-align: right;'>$phone_error</span>";
						}
						?>
					</div>
					<div class="ui-block-content">

						<!-- Personal Information Form  -->

						<form action="" method="post">
							<div class="row">

								<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group label-floating">
										<label class="control-label">First Name</label>

										<?php
										echo "<input class='form-control' placeholder='' type='text' value='$newName' name='firstname'>";
										?>
									</div>

									<div class="form-group label-floating">
										<label class="control-label">Your Email</label>
										<?php
										echo "<input disabled class='form-control' placeholder='' type='email' value='$mailAdress' name='newEmail'>";
										?>
									</div>

									<div class="form-group date-time-picker label-floating">
										<label class="control-label">Your Birthday</label>
										<input type="date" value="<?= $newBirth ?>" name="birthday" />

									</div>
								</div>

								<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
									<div class="form-group label-floating">
										<label class="control-label">Last Name</label>
										<?php
										echo "<input class='form-control' placeholder='' type='text' value='$newSurname' name='lastname'>";
										?>
									</div>

									<div class="form-group label-floating">
										<label class="control-label">Your Phone Number</label>
										<?php
										echo "<input class='form-control' placeholder='' type='text' value='$newPhone' name='phone'>";
										?>
									</div>

									<div class="form-group label-floating is-select">
										<label class="control-label">Your Gender</label>
										<select class="selectpicker form-control" name="gender">
											<?php
											if ($newGender === "Male") {
												echo "<option value=Male' selected>Male</option>";
												echo "<option value='Female'>Female</option>";
											} else if ($newGender === "Female") {
												echo "<option value='Male' > Male</option>";
												echo "<option value='Female' selected>Female</option>";
											} else {
												echo "<option value='Male' > Male</option>";
												echo "<option value='Female'>Female</option>";
											}
											?>

										</select>

									</div>
								</div>

								<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
									<button type="submit" name="btnSubmit" class="btn btn-primary btn-lg full-width">Save all Changes</button>
								</div>

							</div>
						</form>

						<!-- ... end Personal Information Form  -->
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- ... end Your Account Personal Information -->

	<a id="topp" class="back-to-top" href="#">
		<img src="../svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
	</a>

	<!-- JS Scripts -->
	<script src="../js/jquery-3.2.1.js"></script>
	<script src="../js/bootstrap-select.js"></script>
	<script src="../js/top.js"></script>
	<script src="../js/base-init.js"></script>
	<script src="../bootstrap/dist/js/bootstrap.bundle.js"></script>

</body>

</html>