<?php
require "db.php";
require "auth.php";
require "util.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>BAZINGA - About</title>

	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap.css">
	<link rel="shortcut icon" href="../icon/logoo.png" type="image/x-icon" />

	<!-- Main Styles CSS -->
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">

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
						echo $first_name . " " . $last_name;
						?>
						<svg class="olymp-dropdown-arrow-icon">
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
						<div class="profile-section">
							<div class="row">
								<div class="col col-lg-5 col-md-5 col-sm-12 col-12">
									<ul class="profile-menu">
										<li>
											<a href="profile.php">Timeline</a>
										</li>
										<li>
											<a href="about.php">About</a>
										</li>
									</ul>
								</div>
								<div class="col col-lg-5 ml-auto col-md-5 col-sm-12 col-12">
									<ul class="profile-menu">
										<li>
											<a href="friends.php">Friends</a>
										</li>
										<li>
											<a href="photos.php">Photos</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="top-header-author">
							<?php
							echo "<img src='uploaded/" . $profile_picture_url . "' alt='author' class='author-thumb' >";
							echo "<div class='author-content'> ";
							echo "<h4>" . $first_name, " ", $last_name . "</h4>";
							echo "<div class='country'>" . $country . "</div>";
							echo "</div>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ... end Top Header-Profile -->

	<div class="container">
		<div class="row">

			<div class="col col-xl-4 order-xl-1 col-lg-4 order-lg-1 col-md-12 order-md-2 col-sm-12 col-12">
				<div class="ui-block">
					<div class="ui-block-title">
						<h6 class="title">Personal Information</h6>
					</div>
					<div class="ui-block-content">
						<!-- W-Personal-Info -->

						<ul class="widget w-personal-info">

							<?php
							$keys = ["Birtday", "Joined", "Gender", "Email", "Phone"];
							$values = ["$birth_date", "$joined_at", "$gender", "$email", "$phone"];
							for ($i = 0; $i < count($values); $i++) {
								echo "<li>";
								echo "<span class='title'>" . $keys[$i] . "</span>";
								echo "<span class='text'>" . $values[$i] . "</span>";
								echo "</li>";
							}
							?>
						</ul>
						<!-- ... end W-Personal-Info -->
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>