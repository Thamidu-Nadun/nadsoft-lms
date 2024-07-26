<?php
include ('header.php');
include ('component/nav.php');
include ('component/slide-navbar.php');

if (isset($_COOKIE['user_id'])) {
	$student_id = $_COOKIE['user_id'];
}elseif(isset($_SESSION['user_id'])) {
	$student_id = $_SESSION['user_id'];
}
else{
	$student_id = -1; 
}
?>
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Online Class</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
				<li>Online Class</li>
			</ul>
		</div>
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="wc-title">
						<h4>Online Class</h4>
					</div>
					<?php
					if ($student_id == -1) {
						die("Please Login");
					}else{
						$statement = $pdo->prepare("SELECT course_id FROM student_course 
						WHERE student_id=:student_id");
						$statement->bindParam('student_id', $student_id);
						$statement->execute();
						$result = $statement->fetchAll();
						foreach ($result as $row){
							$course_id = $row['course_id'];
						}
					}
					$current_date = date("Y-m-d");
					$statement = $pdo->prepare("SELECT * FROM session 
					WHERE date>:date AND course_id=:course_id");
					$statement->bindParam(':date', $current_date);
					$statement->bindParam(':course_id', $course_id);
					$statement->execute();
					$result = $statement->fetchAll();
					foreach ($result as $row) {
						$name = $row['name'];
						$description = $row['description'];
						$course_id = $row['course_id'];
						$link = $row['link'];
						$image_url = $row['image_link'];
						$date = $row['date'];

						?>
						<div class="widget-inner">
							<div class="card-courses-list bookmarks-bx">
								<div class="card-courses-media">
									<img src="<?php echo $image_url; ?>" alt="" style="border-radius: 25px;" />
								</div>
								<div class="card-courses-full-dec">
									<div class="card-courses-title">
										<h4 class="m-b5"><?php echo $name; ?></h4>
									</div>
									<div class="card-courses-list-bx">
										<ul class="card-courses-view">
											<li class="card-courses-categories">
												<h5>Categories</h5>
												<h4>Science - Biology</h4>
											</li>
											<li class="card-courses-categories">
												<h4><?php echo $date; ?></h4>
											</li>
										</ul>
									</div>
									<div class="row card-courses-dec">
										<div class="col-md-12">
											<p><?php echo $description; ?></p>
										</div>
										<div class="col-md-12">
											<a href="<?php echo $link; ?>" class="btn blue radius-xl">Join Now</a>
										</div>
									</div>

								</div>
							</div>
						</div>
						<?php
					} ?>
				</div>
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
</main>
<div class="ttr-overlay"></div>

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
<script src='assets/vendors/scroll/scrollbar.min.js'></script>
<script src="assets/js/functions.js"></script>
<script src="assets/vendors/chart/chart.min.js"></script>
<script src="assets/js/admin.js"></script>
<!-- <script src='assets/vendors/switcher/switcher.js'></script> -->
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/bookmark.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:10:19 GMT -->

</html>