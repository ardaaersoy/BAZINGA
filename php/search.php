<?php
require "db.php";
require "auth.php";
require "util.php";
require "searchProcess.php";
require "auth.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>BAZINGA - Friends</title>

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
                        require_once "auth.php";
                        echo "<img id='pp' alt='author' src='uploaded/$profile_picture_url' class='avatar'>";
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

                            require_once "auth.php";
                            echo "<img src='uploaded/$profile_picture_url' alt='author' class='author-thumb'>";
                            echo " <div class='author-content'>";
                            echo "<h4>" . $first_name, " ", $last_name . "</h4>";

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php

            ?>
        </div>
    </div>

    <!-- ... end Top Header-Profile -->

    <!-- Friends -->


    <div class="container">
        <div class="row">

            <!-- Friend Item -->
            <?php
            for ($i = 0; $i < count($friends); $i++) {

                try {
                    $sql = "select count(distinct(friendship_id)) as friendcount from myfriends where my_id=? or friend_id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([$friends[$i]['user_id'], $friends[$i]['user_id']]);
                    $friendcount = $stmt->fetch(PDO::FETCH_ASSOC)['friendcount'];

                    $sql = "select count(picture_url) as photoCount from posts where user_id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([$friends[$i]['user_id']]);
                    $photoCount = $stmt->fetch(PDO::FETCH_ASSOC)['photoCount'];
                } catch (\Throwable $th) {
                    echo "Sql Error" . $th->getMessage();
                    exit;
                }

                echo "
                <div class='col col-xl-3 col-lg-6 col-md-6 col-sm-6 col-6'>
                    <div class='ui-block'>
					<div class='friend-item'>
						<div class='friend-header-thumb'></div>

						<div class='friend-item-content'>
							<div class='friend-avatar'>
								<div class='author-thumb'>
									<img src='uploaded/{$friends[$i]['profile_picture_url']}' alt='author' class='author-thumb'>
								</div>
								<div class='author-content'>
									<a class='h5 author-name'>", $friends[$i]['first_name'], " ", $friends[$i]['last_name'], "</a>
								</div>
							</div>

							<div class='swiper-container'>
								<div class='swiper-wrapper'>
									<div class='swiper-slide'>
										<div class='friend-count' data-swiper-parallax='-500'>
											<a class='friend-count-item'>
												<div class='h6'>{$friendcount}</div>
												<div class='title'>Friends</div>
											</a>
											<a class='friend-count-item'>
												<div class='h6'>{$photoCount}</div>
												<div class='title'>Photos</div>
											</a>
										</div>
										<div class='control-block-button' data-swiper-parallax='-100'>";

                try {
                    $sql = "select * from myfriends where my_id = ? and friend_id = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([$user_id, $friends[$i]['user_id']]);
                    $stmt->execute([$friends[$i]['user_id'], $user_id]);
                    $alreadyFriend = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $ex) {
                    echo "error";
                }

                try {
                    $sql = "select * from friendrequest where sender = ?";
                    $stmt = $db->prepare($sql);
                    $stmt->execute([$user_id]);
                    $ff = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $ex) {
                    echo "error";
                }

                if ($friends[$i]['user_id'] == $ff[0]['receiver']) {
                    echo "Your request has been send";
                } else if ($alreadyFriend[0]['my_id'] == $friends[$i]['user_id'] || $alreadyFriend[0]['friend_id'] == $friends[$i]['user_id']) {
                    echo "He is already your friend";
                } else {
                    echo "<a href='sendFriendRequest.php?receiver=" . $friends[$i]['user_id'] . "&sender=$user_id" . "' class='btn btn-control bg-blue'>
							<svg class='olymp-happy-face-icon'>
								<use xlink:href='../svg-icons/sprites/icons.svg#olymp-happy-face-icon'></use>
							</svg>
                        </a>";
                }

                echo "</div>
									</div>

									<div class='swiper-slide'>
                                        <div class='friend-since' data-swiper-parallax='-100'>
											<span>Born in:</span>
											<div class='h6'>{$friends[$i]['birth_date']}</div>
                                        </div>
                                        <div class='friend-since' data-swiper-parallax='-100'>
											<span>Gender:</span>
											<div class='h6'>{$friends[$i]['gender']}</div>
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

            if (!empty($error)) {
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
									<a class='h5 author-name'>$error</a>
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
            <!-- ... end Friend Item -->

        </div>
    </div>


    <a id="topp" class="back-to-top" href="#">
        <img src="../svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
    </a>

    <!-- JS Scripts -->
    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/swiper.jquery.js"></script>
    <script src="../js/top.js"></script>
    <script src="../js/base-init.js"></script>

</body>

</html>