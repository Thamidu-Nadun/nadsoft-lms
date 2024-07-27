<?php
include ('header.php');
include ('pages/nav.php');
$message = '';
$err = '';
?>
<?php
try {
	if (isset($_GET['c_id'])) {
		if ($_GET['c_id'] == '') {
			$err = 'Page ID not provided';
		} else {

			$course_id = intval($_GET['c_id']);

			$statement = $pdo->prepare('SELECT * FROM course WHERE id = :course_id');
			$statement->bindParam(':course_id', $course_id, PDO::PARAM_INT);
			$statement->execute();
			$result = $statement->fetchAll();

			if (count($result) > 0) {
				foreach ($result as $row) {
					$id = $row['id'];
					$name = $row['name'];
					$short_name = $row['short_name'];
					$price = $row['price'];
					$teacher_id = $row['teacher_id'];
					$cat_id = $row['cat_id'];
					$description = $row['description'];
					$short_description = $row['short_description'];
					$certification = $row['certification'];
					$outcomes = explode(",", $row['outcomes']);
					$curriculum = $row['curriculum'];
					$review = $row['review'];
					$review_data_json = $row['review_data'];
					$review_data = json_decode($review_data_json, true);
					$image = $row['image'];
					$duration = $row['duration'];
					$level = $row['level'];
					$language = $row['language'];
					$students = $row['students'];
					$start = $row['start'];
					$price_per = $row['price_per'];
					$views = $row['views'];
					$quizzes = $row['quizzes'];
					$sessions = $row['sessions'];
					$assessments = $row['assessments'];
				}
			} else {
				$message = 'Nothing to display';
			}
			try {
				$statement_2 = $pdo->prepare('SELECT * FROM teacher WHERE id = :t_id');
				$statement_2->bindParam(':t_id', $teacher_id, PDO::PARAM_INT);
				$statement_2->execute();
				$result_2 = $statement_2->fetchAll();
				if (count($result_2) > 0) {
					foreach ($result_2 as $row) {
						$id = $row['id'];
						$teacher_fullname = $row['full_name'];
						$teacher_user_name = $row['user_name'];
						$teacher_avatar = $row['avatar'];
						$teacher_number = $row['number'];
						$teacher_occupation = $row['occupation'];
						$teacher_linkedin = $row['linkedin'];
						$teacher_facebook = $row['facebook'];
						$teacher_x = $row['x'];
						$teacher_instagram = $row['instagram'];
						$teacher_description = $row['description'];
					}
				} else {
					$message = 'No teacher\'s data available';
				}
			} catch (Exception $e) {
				echo 'no';
			}
			try {
				$statement_3 = $pdo->prepare('SELECT * FROM category WHERE id = :cat_id');
				$statement_3->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
				$statement_3->execute();
				$result_3 = $statement_3->fetchAll();
				if (count($result_3) > 0) {
					foreach ($result_3 as $row) {
						$id = $row['id'];
						$cat_name = $row['name'];
					}
				} else {
					$message = 'No category data available';
				}
			} catch (Exception $e) {
				echo 'no';
			}
		}
	} else {
		$err = '<h1 class="text-white">Page ID not provided.</h1>';
	}
} catch (PDOException $exception) {
	die("Connection error: " . $exception->getMessage());
}

?>
<!-- Content -->
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="
	background-image:url(assets/images/banner/banner2.jpg);
	<?php
	if ($err != '') {
		echo 'height: 100vh;';
	}
	?>">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white"><?php
				if ($err != '') {
					echo 'Page ID not provided.';
					die();
				} else {
					echo 'Courses Details';
				}
				?></h1>
            </div>
        </div>
    </div>
    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="/">Home</a></li>
                <li><a href="/courses.html">Courses Details</a></li>
                <li><a href="/courses-details.php?c_id=<?php echo $id; ?>"><?php echo $short_name; ?></a></li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb row END -->
    <!-- inner page banner END -->
    <div class="content-block">
        <!-- About Us -->
        <div class="section-area section-sp1">
            <div class="container">
                <div class="row d-flex flex-row-reverse">
                    <div class="col-lg-3 col-md-4 col-sm-12 m-b30">
                        <div class="course-detail-bx">
                            <div class="course-price">
                                <del><?php echo $currency . $price + 100; ?></del>
                                <h4 class="price"><?php echo $currency . $price; ?></h4>
                            </div>
                            <div class="course-buy-now text-center">
                                <a href="enroll.php?course_id=<?php echo $course_id; ?>"
                                    class="btn radius-xl text-uppercase">Enroll Now</a>
                            </div>
                            <div class="teacher-bx">
                                <div class="teacher-info">
                                    <div class="teacher-thumb">
                                    	<img src="<?php echo $teacher_avatar; ?>" alt="">
                                    </div>
                                    <div class="teacher-name">
                                        <h5><a
                                                href="/teacher-profile.php?t_id=<?php echo $teacher_id; ?>"><?php echo $teacher_fullname; ?></a>
                                        </h5>
                                        <span><?php echo $teacher_occupation; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="cours-more-info">
                                <div class="review">
                                    <span><?php echo $review; ?> Review</span>
                                    <ul class="cours-star">
                                        <?php
										$rating = $review; // Assuming $course_data[4]['review'] holds the rating out of 5
										
										// Loop through 5 stars
										for ($i = 1; $i <= 5; $i++) {
											if ($i <= $rating) {
												echo '<li class="active"><i class="fa fa-star"></i></li>';
											} else {
												echo '<li><i class="fa fa-star"></i></li>';
											}
										}
										?>
                                    </ul>
                                </div>
                                <div class="price categories">
                                    <span>Category</span>
                                    <h5 class="text-primary"><?php echo $cat_name; ?></h5>
                                </div>
                            </div>
                            <div class="course-info-list scroll-page">
                                <ul class="navbar">
                                    <li><a class="nav-link" href="#overview"><i class="ti-zip"></i>Overview</a></li>
                                    <li><a class="nav-link" href="#curriculum"><i
                                                class="ti-bookmark-alt"></i>Curriculum</a></li>
                                    <li><a class="nav-link" href="#instructor"><i class="ti-user"></i>Instructor</a>
                                    </li>
                                    <li><a class="nav-link" href="#reviews"><i class="ti-comments"></i>Reviews</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="courses-post">
                            <div class="ttr-post-media media-effect">
                            <!-- assets/images/blog/default/thum1.jpg -->
                                <a href="#"><img src="<?php
                                if ($image=='') {
                                    echo 'assets/images/blog/default/thum1.jpg';
                                }else{
                                    echo $image;
                                }
                                ?>" alt=""></a>
                            </div>
                            <div class="ttr-post-info">
                                <div class="ttr-post-title ">
                                    <h2 class="post-title"><?php echo $name; ?></h2>
                                </div>
                                <div class="ttr-post-text">
                                    <p><?php echo $short_description; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="courese-overview" id="overview">
                            <h4>Overview</h4>
                            <div class="row">
                                <div class="col-md-12 col-lg-4">
                                    <ul class="course-features">
                                        <li><i class="ti-book"></i> <span class="label">Sessions</span> <span
                                                class="value"><?php echo $sessions; ?></span></li>
                                        <li><i class="ti-help-alt"></i> <span class="label">Quizzes</span>
                                            <span class="value"><?php
											if ($quizzes == 1) {
												echo 'Yes';
											} else {
												echo 'No';
											}
											?></span></span>
                                        </li>
                                        <li><i class="ti-time"></i> <span class="label">Duration</span> <span
                                                class="value"><?php echo $duration . " " . $price_per; ?></span></li>
                                        <li><i class="ti-stats-up"></i> <span class="label">Skill level</span> <span
                                                class="value"><?php echo $level; ?></span></li>
                                        <li><i class="ti-smallcap"></i> <span class="label">Language</span> <span
                                                class="value"><?php echo $language; ?></span></li>
                                        <li><i class="ti-user"></i> <span class="label">Students</span> <span
                                                class="value"><?php echo $students; ?></span></li>
                                        <li><i class="ti-check-box"></i> <span class="label">Assessments</span> <span
                                                class="value"><?php
												if ($assessments == 1) {
													echo 'Yes';
												} else {
													echo 'No';
												}
												?></span></li>
                                    </ul>
                                </div>
                                <div class="col-md-12 col-lg-8">
                                    <h5 class="m-b5">Course Description</h5>
                                    <p><?php echo $description; ?></p>
                                    <h5 class="m-b5">Certification</h5>
                                    <p><?php echo $certification; ?></p>
                                    <h5 class="m-b5">Learning Outcomes</h5>
                                    <ul class="list-checked primary">
                                        <?php foreach ($outcomes as $row) {
											echo "<li>" . $row . "</li>";
										} ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="m-b30" id="curriculum">
                            <h4>Curriculum</h4>
                            <?php
							$data = json_decode($curriculum, true);

							echo '<ul class="curriculum-list">';

							foreach ($data['topics'] as $topic) {
								// echo "<h2>" . htmlspecialchars($topic['week']) . "</h2>";
								foreach ($topic['sessions'] as $session) {
									echo "<h5>" . htmlspecialchars($session['session_title']) . "&emsp;&emsp;(Session " . htmlspecialchars($session['session_number']) . ")</h5>";
									echo "<ul>";
									foreach ($session['subtopics'] as $subtopic) {
										echo "<li class='curriculum-list-box'>" . htmlspecialchars($subtopic) . "</li>";
									}
									echo "</ul>";
								}
							}
							echo '</ul>';
							?>

                        </div>
                        <div class="" id="instructor">
                            <h4>Instructor</h4>
                            <div class="instructor-bx">
                                <div class="instructor-author">
                                    <img src="<?php echo $teacher_avatar; ?>" alt="">
                                </div>
                                <div class="instructor-info">
                                    <h6><a href="/teacher-profile.php?t_id<?php echo $teacher_id; ?>"><?php echo $teacher_fullname; ?>
                                        </a></h6>
                                    <span><?php echo $teacher_occupation; ?></span>
                                    <ul class="list-inline m-tb10">
                                        <li><a href="<?php echo $teacher_facebook; ?>" class="btn sharp-sm facebook"><i
                                                    class="fa fa-facebook"></i></a>
                                        </li>
                                        <li><a href="<?php echo $teacher_x; ?>" class="btn sharp-sm twitter"><i
                                                    class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo $teacher_linkedin; ?>" class="btn sharp-sm linkedin">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </li>

                                        <li><a href="<?php echo $teacher_instagram; ?>"
                                                class="btn sharp-sm instagram"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                    <p class="m-b0"><?php echo $teacher_description; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="" id="reviews">
                            <h4>Reviews</h4>

                            <div class="review-bx">
                                <div class="all-review">
                                    <h2 class="rating-type"><?php echo $review; ?></h2>
                                    <ul class="cours-star">
                                        <?php
										$rating = $review; // Assuming $course_data[4]['review'] holds the rating out of 5
										
										// Loop through 5 stars
										for ($i = 1; $i <= 5; $i++) {
											if ($i <= $rating) {
												echo '<li class="active"><i class="fa fa-star"></i></li>';
											} else {
												echo '<li><i class="fa fa-star"></i></li>';
											}
										}
										?>
                                    </ul>
                                    <span><?php echo $review; ?> Rating</span>
                                </div>
                                <?php
								$one = $review_data['1'];
								$two = $review_data['2'];
								$three = $review_data['3'];
								$four = $review_data['4'];
								$five = $review_data['5'];
								$total = $one + $two + $three + $four + $five;

								$one_percentage = $one/$total*100;
								$two_percentage = $two/$total*100;
								$three_percentage = $three/$total*100;
								$four_percentage = $four/$total*100;
								$five_percentage = $five/$total*100;

								?>
                                <div class="review-bar">
                                    <div class="bar-bx">
                                        <div class="side">
                                            <div>5 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-5" style="width:<?php echo $five_percentage; ?>%;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div><?php echo $review_data['5']; ?></div>
                                        </div>
                                    </div>
                                    <div class="bar-bx">
                                        <div class="side">
                                            <div>4 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-5" style="width:<?php echo $four_percentage; ?>%;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div><?php echo $review_data['4']; ?></div>
                                        </div>
                                    </div>
                                    <div class="bar-bx">
                                        <div class="side">
                                            <div>3 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-5" style="width:<?php echo $three_percentage; ?>%;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div><?php echo $review_data['3']; ?></div>
                                        </div>
                                    </div>
                                    <div class="bar-bx">
                                        <div class="side">
                                            <div>2 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-5" style="width:<?php echo $two_percentage; ?>%;"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div><?php echo $review_data['2']; ?></div>
                                        </div>
                                    </div>
                                    <div class="bar-bx">
                                        <div class="side">
                                            <div>1 star</div>
                                        </div>
                                        <div class="middle">
                                            <div class="bar-container">
                                                <div class="bar-5" style="width:<?php echo $one_percentage; ?>%;"></div>
                                            </div>
                                        </div>
                                        <div class="side right">
                                            <div><?php echo $review_data['1']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- contact area END -->

</div>
<!-- Content END-->
<!-- Footer ==== -->
<footer>
    <div class="footer-top">
        <div class="pt-exebar">
            <div class="container">
                <div class="d-flex align-items-stretch">
                    <div class="pt-logo mr-auto">
                        <a href="index.html"><img src="assets/images/logo-white.png" alt="" /></a>
                    </div>
                    <div class="pt-social-link">
                        <ul class="list-inline m-a0">
                            <li><a href="#" class="btn-link"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="btn-link"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="btn-link"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#" class="btn-link"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                    <div class="pt-btn-join">
                        <a href="#" class="btn ">Join Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 footer-col-4">
                    <div class="widget">
                        <h5 class="footer-title">Sign Up For A Newsletter</h5>
                        <p class="text-capitalize m-b20">Weekly Breaking news analysis and cutting edge advices on job
                            searching.</p>
                        <div class="subscribe-form m-b20">
                            <form class="subscription-form"
                                action="http://educhamp.themetrades.com/demo/assets/script/mailchamp.php" method="post">
                                <div class="ajax-message"></div>
                                <div class="input-group">
                                    <input name="email" required="required" class="form-control"
                                        placeholder="Your Email Address" type="email">
                                    <span class="input-group-btn">
                                        <button name="submit" value="Submit" type="submit" class="btn"><i
                                                class="fa fa-arrow-right"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-md-7 col-sm-12">
                    <div class="row">
                        <div class="col-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="widget footer_widget">
                                <h5 class="footer-title">Company</h5>
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about-1.html">About</a></li>
                                    <li><a href="faq-1.html">FAQs</a></li>
                                    <li><a href="contact-1.html">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="widget footer_widget">
                                <h5 class="footer-title">Get In Touch</h5>
                                <ul>
                                    <li><a href="http://educhamp.themetrades.com/admin/index.html">Dashboard</a></li>
                                    <li><a href="blog-classic-grid.html">Blog</a></li>
                                    <li><a href="portfolio.html">Portfolio</a></li>
                                    <li><a href="event.html">Event</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="widget footer_widget">
                                <h5 class="footer-title">Courses</h5>
                                <ul>
                                    <li><a href="courses.html">Courses</a></li>
                                    <li><a href="courses-details.html">Details</a></li>
                                    <li><a href="membership.html">Membership</a></li>
                                    <li><a href="profile.html">Profile</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 col-md-5 col-sm-12 footer-col-4">
                    <div class="widget widget_gallery gallery-grid-4">
                        <h5 class="footer-title">Our Gallery</h5>
                        <ul class="magnific-image">
                            <li><a href="assets/images/gallery/pic1.jpg" class="magnific-anchor"><img
                                        src="assets/images/gallery/pic1.jpg" alt=""></a></li>
                            <li><a href="assets/images/gallery/pic2.jpg" class="magnific-anchor"><img
                                        src="assets/images/gallery/pic2.jpg" alt=""></a></li>
                            <li><a href="assets/images/gallery/pic3.jpg" class="magnific-anchor"><img
                                        src="assets/images/gallery/pic3.jpg" alt=""></a></li>
                            <li><a href="assets/images/gallery/pic4.jpg" class="magnific-anchor"><img
                                        src="assets/images/gallery/pic4.jpg" alt=""></a></li>
                            <li><a href="assets/images/gallery/pic5.jpg" class="magnific-anchor"><img
                                        src="assets/images/gallery/pic5.jpg" alt=""></a></li>
                            <li><a href="assets/images/gallery/pic6.jpg" class="magnific-anchor"><img
                                        src="assets/images/gallery/pic6.jpg" alt=""></a></li>
                            <li><a href="assets/images/gallery/pic7.jpg" class="magnific-anchor"><img
                                        src="assets/images/gallery/pic7.jpg" alt=""></a></li>
                            <li><a href="assets/images/gallery/pic8.jpg" class="magnific-anchor"><img
                                        src="assets/images/gallery/pic8.jpg" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center"><a target="_blank"
                        href="https://www.templateshub.net">Templates Hub</a></div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer END ==== -->
<button class="back-to-top fa fa-chevron-up"></button>
</div>
<!-- External JavaScripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="assets/vendors/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendors/counter/waypoints-min.js"></script>
<script src="assets/vendors/counter/counterup.min.js"></script>
<script src="assets/vendors/imagesloaded/imagesloaded.js"></script>
<script src="assets/vendors/masonry/masonry.js"></script>
<script src="assets/vendors/masonry/filter.js"></script>
<script src="assets/vendors/owl-carousel/owl.carousel.js"></script>
<script src="assets/js/jquery.scroller.js"></script>
<script src="assets/js/functions.js"></script>
<script src="assets/js/contact.js"></script>
<script src="assets/vendors/switcher/switcher.js"></script>
</body>

</html>