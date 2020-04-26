<?php
require "db.php";
require "auth.php";
require "util.php";
require "profileProcess.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>BAZINGA - Profile</title>

	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<!-- Main Font -->
	<script src="../js/webfontloader.min.js"></script>
	<script src="../js/webfont.js"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/bootstrap.css">
	<link rel="shortcut icon" href="../icon/logoo.png" type="image/x-icon" />

	<!-- Main Styles CSS -->
	<link rel="stylesheet" type="text/css" href="../css/main.min.css">
	<link rel="stylesheet" type="text/css" href="../css/profile.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
	<style>
		#commenting {
			display: none;
		}
	</style>

	<script>

		$(document).ready(function() {
			$("#comment_status").click(function(event) {
				event.preventDefault();

				var data = $('#comment_content').val(); //input[name="content"]
				var pid = $('#postId').val();
				 
				if (data == "") {
					alert("Enter something!");
				} else {
					$.ajax({
						url: "uploadPost.php?islem=ajax",
						type: "POST",
						data: "content=" + data + "&pid=" + pid,
						success: function(cevap) {
							$('#commenting').css('display', 'block');
							$("#post_sonuc").append(cevap).hide().fadeIn(700);

							// $("#AboneOl").addClass("btn btn-danger");
							// $("#email").hide(1000).fadeIn(3000);
							// $("#AboneOl").hide(1000).fadeIn(3000);
							$('#comment_content').val('');
						}

					});

				}
			});
		});
	</script>
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
						echo "<img alt='author' id='pp' src='uploaded/$profile_picture_url' class='avatar'>";
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
							echo "<img src='uploaded/$profile_picture_url' alt='author' class='author-thumb'>";
							echo " <div class='author-content'>";
							echo "<h4>" . $first_name, " ", $last_name . "</h4>";

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

			<!-- Main Content -->

			<div class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
				<div id="newsfeed-items-grid">

					<div class="ui-block">
						<!-- News Feed Form  -->
						<div class="news-feed-form">
							<!-- Nav tabs -->
							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane active" id="home-1" role="tabpanel" aria-expanded="true">

									<form action='uploadPost.php?page=<?= $page ?>&cnt=<?= $cnt ?>&total=<?= $totalPage ?>' method='post' enctype='multipart/form-data'>
										<div class="author-thumb">

											<?php
											echo "<img id='pp' alt='author' src='uploaded/$profile_picture_url' class='avatar'>";
											?>

										</div>
										<div class="form-group with-icon label-floating is-empty">
											<label class="control-label"></label>
											<textarea name='content' class="form-control" placeholder="Share what you are thinking here..."></textarea>
										</div>


										<div class="add-options-message">

											<a href="#" class="options-message" data-toggle="tooltip" data-placement="top" data-original-title="ADD PHOTOS">
												<input type="file" id="file1" name="p_image" accept="image/*" capture style="display:none" />

												<svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo" id="upfile1" style="cursor:pointer">
													<use xlink:href="../svg-icons/sprites/icons.svg#olymp-camera-icon"></use>
												</svg>
											</a>


											<button type='submit' name='postBtn' class='btn btn-primary btn-md-2'>Post Status</button>

											<?php
											if (isset($ext_error)) {
												echo "<p style='padding-top:5px; font-size:12px; '>" . $ext_error . "</p>";
											}
											if (isset($empty_error)) {
												echo "<p style='padding-top:5px; font-size:12px; '>" . $empty_error . "</p>";
											}
											?>

										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- ... end News Feed Form  -->
					</div>


					<?php
					for ($i = 0; $i < count($posts); $i++) {

						$sql = "select * from users where user_id = ?";
						$stmt = $db->prepare($sql);
						$stmt->execute([$posts[$i]['user_id']]);
						$postUser = $stmt->fetch(PDO::FETCH_ASSOC);

						if (!empty($posts[$i]['content']) && empty($posts[$i]['picture_url'])) {
							echo " <div class='ui-block'>
					<!-- Post -->
					<article class='hentry post'>
						<div class='post__author author vcard inline-items'>
							<img alt='author' src='uploaded/{$postUser['profile_picture_url']}' class='avatar'>

							<div class='author-date'>
								<a class='h6 post__author-name fn'>{$postUser['first_name']} {$postUser['last_name']}</a>
								<div class='post__date'>
									<time class='published'>
										{$posts[$i]['posted_at']}
									</time>
								</div>
							</div>";

							if ($user_id == $postUser['user_id']) {
								echo "<div class='more'>
										<form action='' method='post'>
											<input type='hidden' name='del_id' value='{$posts[$i]['post_id']}' >
											<div id='trash'>		
												<button id='trashbutton' type='submit' name='deleteBtn'><img id='trash' src='../icon/trash.png'></button>
											</div>
										</form>
									</div>";
							}

							echo "
						</div>
						<textarea id='contentText' disabled>" . $posts[$i]['content'] .  "</textarea>
						<div class='post-additional-info inline-items'>
							

						<form action='' method='post'>
							<input type='hidden' name='likePostId' value='{$posts[$i]['post_id']}' >
							<button id='likeBtn' type='submit' name='likeBtn'>
							<a class='post-add-icon inline-items'>
								<svg class='olymp-heart-icon'>
									<use xlink:href='../svg-icons/sprites/icons.svg#olymp-heart-icon'></use>
								</svg>
							</a>
							</button>";

							$sql = "select * from likes where post_id = ?";
							$stmt = $db->prepare($sql);
							$stmt->execute([$posts[$i]['post_id']]);
							$likes = $stmt->fetchAll(PDO::FETCH_ASSOC);
							$totalLikes = count($likes);

							echo "<span>{$totalLikes}</span>
								</form><ul class='friends-harmonic'>";

							$sql = "select * from users";
							$likeUsers = $db->query($sql);

							foreach ($likeUsers as $like) {
								for ($j = 0; $j < count($likes); $j++) {
									if ($like['user_id'] == $likes[$j]['liked_by']) {
										echo "
											<li>
												<span>{$likes[$j]['first_name']}</span>
												<a>
													<img src='uploaded/{$like['profile_picture_url']}' alt='friend'>
												</a>
											</li>";
									}
								}
							}
							echo "
							</ul></div>
					</article>

					<!-- .. end Post -->";

							foreach ($comments as $comment) {
								$sql = "select * from users where user_id = ?";
								$stmt = $db->prepare($sql);
								$stmt->execute([$comment['user_id']]);
								$commentor = $stmt->fetch(PDO::FETCH_ASSOC);

								if ($posts[$i]['post_id'] == $comment['post_id']) {
									echo "<!-- Comments -->
				<ul class='comments-list'>
					<li class='comment-item'>
						<div class='post__author author vcard inline-items'>
							<img src='uploaded/{$commentor['profile_picture_url']}' alt='author'>
							<div class='author-date'>
								<a class='h6 post__author-name fn'>{$commentor['first_name']} {$commentor['last_name']}</a>
								<div class='post__date'>
									<time class='published' datetime=''>
										{$comment['commented_at']}
									</time>
								</div>
							</div>";


									if ($user_id == $commentor['user_id'] || $user_id == $posts[$i]['user_id']) {
										echo "<div class='more'>
												<form action='' method='post'>
													<input type='hidden' name='delCommentId' value='{$comment['comment_id']}' >
													<div id='trashComment'>		
														<input type='submit' id='trashComment' name='deleteComment' value='&#128465'>
													</div>
												</form>
											</div>";
									}


									echo "</div>
						<p>{$comment['comment']}</p>
					</li>
				</ul>
				<!-- ... end Comments -->";
								}
							}

							echo "<ul id ='commenting' class='comments-list'>
							<li class='comment-item'>
								<div class='post__author author vcard inline-items'>
									<img src='uploaded/{$commentor['profile_picture_url']}' alt='author'>
									<div class='author-date'>
										<a class='h6 post__author-name fn'>{$commentor['first_name']} {$commentor['last_name']}</a>
										<div class='post__date'>
											<time class='published' datetime=''>
												{$comment['commented_at']}
											</time>
										</div>
									</div>";


							if ($user_id == $commentor['user_id'] || $user_id == $posts[$i]['user_id']) {
								echo "<div class='more'>
														<form action='' method='post'>
															<input type='hidden' name='delCommentId' value='{$comment['comment_id']}' >
															<div id='trashComment'>		
																<input type='submit' id='trashComment' name='deleteComment' value='&#128465'>
															</div>
														</form>
													</div>";
							}


							echo "</div>
								
								<p id='post_sonuc'></p>
							</li>
						</ul>";


							echo "
						<!-- Comment Form  -->
						<form class='comment-form inline-items' action='' method=''>
						<input type='hidden' id='postId' value='{$posts[$i]['post_id']}' >
							<div class='post__author author vcard inline-items'>
								<img src='uploaded/$profile_picture_url' alt='author'>
								<div class='form-group with-icon-right '>
									<textarea id='comment_content' name='content' class='form-control' placeholder=''></textarea>
								</div>
							</div>
							<button id='comment_status' name='commentBtn' value='{$posts[$i]['post_id']}' onclick='' class='btn btn-md-2 btn-primary'>Post Comment</button>
						</form>
						<!-- ... end Comment Form  -->				
						</div>";
						}




						if (!empty($posts[$i]['picture_url']) && !empty($posts[$i]['content'])) {
							echo "<div class='ui-block'>
							<!-- Photoooo Post -->
	
							<article class='hentry post has-post-thumbnail shared-photo'>
								<div class='post__author author vcard inline-items'>
									<img alt='author' src='uploaded/{$postUser['profile_picture_url']}' class='avatar'>
									<div class='author-date'>
										<a class='h6 post__author-name fn'>
										{$postUser['first_name']} {$postUser['last_name']}
										</a>
										<div class='post__date'>
										<time class='published'>
										{$posts[$i]['posted_at']}
									</time>
										</div>
									</div>";

							if ($user_id == $postUser['user_id']) {
								echo "<div class='more'>
												<form action='' method='post'>
													<input type='hidden' name='del_id' value='{$posts[$i]['post_id']}' >
													<div id='trash'>		
														<button id='trashbutton' type='submit' name='deleteBtn'><img id='trash' src='../icon/trash.png'></button>
													</div>
												</form>
											</div>";
							}

							echo "</div>
								<p> {$posts[$i]['content']} </p>
	
								<div class='post-thumb'>
									<img id='postedImg' src='postedImages/{$posts[$i]['picture_url']}' alt='photo'>
								</div>
								<ul class='children single-children'></ul>
								<div class='post-additional-info inline-items'>
								<form action='' method='post'>
								<input type='hidden' name='likePostId' value='{$posts[$i]['post_id']}' >
								<button id='likeBtn' type='submit' name='likeBtn'>
								<a class='post-add-icon inline-items'>
									<svg class='olymp-heart-icon'>
										<use xlink:href='../svg-icons/sprites/icons.svg#olymp-heart-icon'></use>
									</svg>
								</a>
								</button>";

							$sql = "select * from likes where post_id = ?";
							$stmt = $db->prepare($sql);
							$stmt->execute([$posts[$i]['post_id']]);
							$likes = $stmt->fetchAll(PDO::FETCH_ASSOC);
							$totalLikes = count($likes);

							echo "<span>{$totalLikes}</span>
									</form><ul class='friends-harmonic'>";

							$sql = "select * from users";
							$likeUsers = $db->query($sql);

							foreach ($likeUsers as $like) {
								for ($j = 0; $j < count($likes); $j++) {
									if ($like['user_id'] == $likes[$j]['liked_by']) {
										echo "
												<li>
													<span>{$likes[$j]['first_name']}</span>
													<a>
														<img src='uploaded/{$like['profile_picture_url']}' alt='friend'>
													</a>
												</li>";
									}
								}
							}
							echo "
								</ul></div>
						</article>
						<!-- .. end Photooo Post -->";
							foreach ($comments as $comment) {
								$sql = "select * from users where user_id = ?";
								$stmt = $db->prepare($sql);
								$stmt->execute([$comment['user_id']]);
								$commentor = $stmt->fetch(PDO::FETCH_ASSOC);

								if ($posts[$i]['post_id'] == $comment['post_id']) {
									echo "<!-- Comments -->
			<ul class='comments-list'>
				<li class='comment-item'>
					<div class='post__author author vcard inline-items'>
						<img src='uploaded/{$commentor['profile_picture_url']}' alt='author'>
						<div class='author-date'>
							<a class='h6 post__author-name fn'>{$commentor['first_name']} {$commentor['last_name']}</a>
							<div class='post__date'>
								<time class='published' datetime=''>
									{$comment['commented_at']}
								</time>
							</div>
						</div>";

									if ($user_id == $commentor['user_id'] || $user_id == $posts[$i]['user_id']) {
										echo "<div class='more'>
												<form action='' method='post'>
													<input type='hidden' name='delCommentId' value='{$comment['comment_id']}' >
													<div id='trashComment'>		
														<input type='submit' id='trashComment' name='deleteComment' value='&#128465'>
													</div>
												</form>
											</div>";
									}


									echo "</div>
					<p>{$comment['comment']}</p>
				</li>
			</ul>
			<!-- ... end Comments -->";
								}
							}
							echo "<ul id ='commenting' class='comments-list'>
							<li class='comment-item'>
								<div class='post__author author vcard inline-items'>
									<img src='uploaded/{$commentor['profile_picture_url']}' alt='author'>
									<div class='author-date'>
										<a class='h6 post__author-name fn'>{$commentor['first_name']} {$commentor['last_name']}</a>
										<div class='post__date'>
											<time class='published' datetime=''>
												{$comment['commented_at']}
											</time>
										</div>
									</div>";


							if ($user_id == $commentor['user_id'] || $user_id == $posts[$i]['user_id']) {
								echo "<div class='more'>
														<form action='' method='post'>
															<input type='hidden' name='delCommentId' value='{$comment['comment_id']}' >
															<div id='trashComment'>		
																<input type='submit' id='trashComment' name='deleteComment' value='&#128465'>
															</div>
														</form>
													</div>";
							}


							echo "</div>
								
								<p id='post_sonuc'></p>
							</li>
						</ul>";


							echo "
					<!-- Comment Form  -->
					<form class='comment-form inline-items' action='' method=''>
					<input type='hidden' id='postId' value='{$posts[$i]['post_id']}' >
						<div class='post__author author vcard inline-items'>
							<img src='uploaded/$profile_picture_url' alt='author'>
							<div class='form-group with-icon-right '>
								<textarea id='comment_content' name='content' class='form-control' placeholder=''></textarea>
							</div>
						</div>
						<button id='comment_status' name='commentBtn' onclick='' class='btn btn-md-2 btn-primary'>Post Comment</button>
					</form>
					<!-- ... end Comment Form  -->				
					</div>";
						}




						if (!empty($posts[$i]['picture_url']) && empty($posts[$i]['content'])) {
							echo "<div class='ui-block'>
							<!-- Photoooo Post -->
	
							<article class='hentry post has-post-thumbnail shared-photo'>
								<div class='post__author author vcard inline-items'>
									<img alt='author' src='uploaded/{$postUser['profile_picture_url']}' class='avatar'>
									<div class='author-date'>
										<a class='h6 post__author-name fn'>
										{$postUser['first_name']} {$postUser['last_name']}
										</a>
										<div class='post__date'>
										<time class='published'>
										{$posts[$i]['posted_at']}
									</time>
										</div>
									</div>";

							if ($user_id == $postUser['user_id']) {
								echo "<div class='more'>
												<form action='' method='post'>
													<input type='hidden' name='del_id' value='{$posts[$i]['post_id']}' >
													<div id='trash'>		
														<button id='trashbutton' type='submit' name='deleteBtn'><img id='trash' src='../icon/trash.png'></button>
													</div>
												</form>
											</div>";
							}
							echo "</div>
	
								<div class='post-thumb'>
									<img id='postedImg' src='postedImages/{$posts[$i]['picture_url']}' alt='photo'>
								</div>
								<ul class='children single-children'></ul>
								<div class='post-additional-info inline-items'>
								<form action='' method='post'>
								<input type='hidden' name='likePostId' value='{$posts[$i]['post_id']}' >
								<button id='likeBtn' type='submit' name='likeBtn'>
								<a class='post-add-icon inline-items'>
									<svg class='olymp-heart-icon'>
										<use xlink:href='../svg-icons/sprites/icons.svg#olymp-heart-icon'></use>
									</svg>
								</a>
								</button>";

							$sql = "select * from likes where post_id = ?";
							$stmt = $db->prepare($sql);
							$stmt->execute([$posts[$i]['post_id']]);
							$likes = $stmt->fetchAll(PDO::FETCH_ASSOC);
							$totalLikes = count($likes);

							echo "<span>{$totalLikes}</span>
									</form><ul class='friends-harmonic'>";

							$sql = "select * from users";
							$likeUsers = $db->query($sql);

							foreach ($likeUsers as $like) {
								for ($j = 0; $j < count($likes); $j++) {
									if ($like['user_id'] == $likes[$j]['liked_by']) {
										echo "
												<li>
													<span>{$likes[$j]['first_name']}</span>
													<a>
														<img src='uploaded/{$like['profile_picture_url']}' alt='friend'>
													</a>
												</li>";
									}
								}
							}
							echo "
								</ul></div>
						</article>
						<!-- .. end Photooo Post -->";
							foreach ($comments as $comment) {
								$sql = "select * from users where user_id = ?";
								$stmt = $db->prepare($sql);
								$stmt->execute([$comment['user_id']]);
								$commentor = $stmt->fetch(PDO::FETCH_ASSOC);

								if ($posts[$i]['post_id'] == $comment['post_id']) {
									echo "<!-- Comments -->
			<ul class='comments-list'>
				<li class='comment-item'>
					<div class='post__author author vcard inline-items'>
						<img src='uploaded/{$commentor['profile_picture_url']}' alt='author'>
						<div class='author-date'>
							<a class='h6 post__author-name fn'>{$commentor['first_name']} {$commentor['last_name']}</a>
							<div class='post__date'>
								<time class='published' datetime=''>
									{$comment['commented_at']}
								</time>
							</div>
						</div>";

									if ($user_id == $commentor['user_id'] || $user_id == $posts[$i]['user_id']) {
										echo "<div class='more'>
												<form action='' method='post'>
													<input type='hidden' name='delCommentId' value='{$comment['comment_id']}' >
													<div id='trashComment'>		
														<input type='submit' id='trashComment' name='deleteComment' value='&#128465'>
													</div>
												</form>
											</div>";
									}


									echo "</div>
					<p>{$comment['comment']}</p>
				</li>
			</ul>
			<!-- ... end Comments -->";
								}
							}

							echo "<ul id ='commenting' class='comments-list'>
							<li class='comment-item'>
								<div class='post__author author vcard inline-items'>
									<img src='uploaded/{$commentor['profile_picture_url']}' alt='author'>
									<div class='author-date'>
										<a class='h6 post__author-name fn'>{$commentor['first_name']} {$commentor['last_name']}</a>
										<div class='post__date'>
											<time class='published' datetime=''>
												{$comment['commented_at']}
											</time>
										</div>
									</div>";


							if ($user_id == $commentor['user_id'] || $user_id == $posts[$i]['user_id']) {
								echo "<div class='more'>
														<form action='' method='post'>
															<input type='hidden' name='delCommentId' value='{$comment['comment_id']}' >
															<div id='trashComment'>		
																<input type='submit' id='trashComment' name='deleteComment' value='&#128465'>
															</div>
														</form>
													</div>";
							}


							echo "</div>
								
								<p id='post_sonuc'></p>
							</li>
						</ul>";

							echo "
					<!-- Comment Form  -->
					<form class='comment-form inline-items' action='' method=''>
					<input type='hidden' id='postId' value='{$posts[$i]['post_id']}' >
						<div class='post__author author vcard inline-items'>
							<img src='uploaded/$profile_picture_url' alt='author'>
							<div class='form-group with-icon-right '>
								<textarea id='comment_content' name='content' class='form-control' placeholder=''></textarea>
							</div>
						</div>
						<button id='comment_status' name='commentBtn' onclick='' class='btn btn-md-2 btn-primary'>Post Comment</button>
					</form>
					<!-- ... end Comment Form  -->				
					</div>";
						}
					}
					?>

				</div>
			</div>

		</div>

		<!-- ... end Main Content -->

	</div>

	<?php
	if ($page != 1 && $totalPage != 0) {
		echo "<div id='prev_next'><a href='?page=" . ($page - 1) . "'><img id='prev' src='../svg/popup-left-arrow.svg'></a></div>";
	}
	if ($page != $totalPage && count($posts) == 10) {
		echo "<div id='prev_next'><a href='?page=" . ($page + 1) . "'><img id='next' src='../svg/popup-right-arrow.svg'></a></div>";
	}

	?>


	<a id="topp" class="back-to-top" href="#">
		<img src="../svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
	</a>

	<!-- JS Scripts -->
	<script src="../js/jquery-3.2.1.js"></script>
	<script src="../js/top.js"></script>
	<script src="../js/base-init.js"></script>
	<script src="../js/addphotopopup.js"></script>
	<script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>

</body>

</html>