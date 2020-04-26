<?php
require "db.php";
require "auth.php";
require "util.php";

$sql = "select * from posts where user_id = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$user_id]);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>BAZINGA - Photos</title>

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
						echo $first_name, " ", $last_name;
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
			<div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class='tab-content'>
					<div class='tab-pane active' id='album-page' role='tabpanel'>
						<div class='photo-album-wrapper'>
							<!-- Tab panes -->

							<?php
							$t = 0;
							//<a href='' data-toggle='modal' data-target='#open-photo-popup-v1' class='full-block'></a>
							for ($i = 0; $i < count($posts); $i++) {
								if (!empty($posts[$i]['picture_url'])) {
									echo "
							<div class='photo-album-item-wrap col-4-width'>
								<div class='photo-album-item' data-mh='album-item'>
									<div class='photo-item'>
										<img id='photosImg' src='postedImages/{$posts[$i]['picture_url']}'>
									</div>
									<div class='content'>";

									if (!empty($posts[$i]['content'])) {
										echo "<a class='title h5'>{$posts[$i]['content']}</a>";
									}

									echo " <span class='sub-title'>Added: {$posts[$i]['posted_at']}</span>
						<div class='swiper-container'>
											<div class='swiper-wrapper'>
												<div class='swiper-slide'>
													<ul class='friends-harmonic'>
														<li>
															<a>
																<img src='../img/friend-harmonic5.jpg' alt='friend'>
															</a>
														</li>
														<li>
															<a>
																<img src='../img/friend-harmonic10.jpg' alt='friend'>
															</a>
														</li>
														<li>
															<a>
																<img src='../img/friend-harmonic7.jpg' alt='friend'>
															</a>
														</li>
													</ul>
												</div>
												<div class='swiper-slide'>
													<div class='friend-count' data-swiper-parallax='-500'>
														<a class='friend-count-item'>
															<div class='h6'>8</div>
															<div class='title'>Comments</div>
														</a>
													</div>
												</div>
											</div>

											<!-- If we need pagination -->
											<div class='swiper-pagination'></div>
										</div>
									</div>
								</div>
							</div>";
								} else {
									$t += 1;
								}
							}

							if (count($posts) == $t) {
								echo "
                <div style='margin:0 auto;' class='col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6'>
                    <div class='ui-block'>
					<div class='friend-item'>
						<div class='friend-header-thumb'></div>
						<div class='friend-item-content'>
							<div class='more'>
							</div>
							<div class='friend-avatar'>
								<div class='author-thumb'>
									<img src='../icon/logoo.png' alt='author' >
								</div>
								<div class='author-content'>
									<a class='h5 author-name'>No photos available</a>
								</div>
							</div>
							<div class='swiper-container'>
								<div class='swiper-wrapper'>
									<div class='swiper-slide'>
										<div class='friend-count' data-swiper-parallax='-500'>
										</div>
										<div class='control-block-button' data-swiper-parallax='-100'>
										</div>
									</div>
								</div>
								<!-- If we need pagination -->
								<div class='swiper-pagination'></div>
							</div>
                        </div>	
                    </div> 
                    </div>
                </div>";
							}

							?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="open-photo-popup-v1" tabindex="-1" role="dialog" aria-labelledby="open-photo-popup-v1" style="display: none; padding-right: 15px;">
		<div class="modal-dialog window-popup open-photo-popup open-photo-popup-v1" role="document">
			<div class="modal-content">
				<a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
					<svg class="olymp-close-icon">
						<use xlink:href="../svg-icons/sprites/icons.svg#olymp-close-icon"></use>
					</svg>
				</a>
				<div class="modal-body">
					<div class="open-photo-thumb">
						<div class="swiper-container" data-slide="fade">
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<div class="photo-item">

										<?php
										extract($_GET);

										echo "<img src='postedImages/{$posts[$img]['picture_url']}' alt='photo'>";
										?>

										<div class="content">
											<a href="#" class="h6 title">Photoshoot 2016</a>
											<time class="published" datetime="2017-03-24T18:18">2 weeks ago</time>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="open-photo-content">
						<div class="mCustomScrollbar" data-mcs-theme="dark">
							<ul class="comments-list">
								<li class="comment-item">
									<div class="post__author author vcard inline-items">
										<img src="../img/avatar48-sm.jpg" alt="author">
										<div class="author-date">
											<a class="h6 post__author-name fn" href="#">Marina Valentine</a>
											<div class="post__date">
												<time class="published" datetime="2017-03-24T18:18">
													46 mins ago
												</time>
											</div>
										</div>
									</div>
									<p>I had a great time too!! We should do it again!</p>
									<a href="#" class="post-add-icon inline-items">
										<svg class="olymp-heart-icon">
											<use xlink:href="../svg-icons/sprites/icons.svg#olymp-heart-icon"></use>
										</svg>
										<span>8</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<a id="topp" class="back-to-top" href="#">
		<img src="../svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
	</a>

	<!-- JS Scripts -->
	<script src="../js/jquery-3.2.1.js"></script>
	<script src="../bootstrap/dist/js/bootstrap.bundle.js"></script>
	<script src="../js/swiper.jquery.js"></script>
	<script src="../js/top.js"></script>
	<script src="../js/base-init.js"></script>

</body>

</html>