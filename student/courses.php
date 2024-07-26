<?php

include ('header.php');
include ('component/nav.php');
include ('component/slide-navbar.php');


function status_filter($str)
{
	switch ($str) {
		case 'Paid':
			return 'registered';
		case 'Pending':
			return 'pending';
		case 'Unpaid':
			return 'unpaid';
		default:
			return '';
	}
}
?>

<!--Main container start -->
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Courses</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
				<li>Courses</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="tab-pane">
						<div class="profile-head">
							<h3>My Courses</h3>
							<div class="feature-filters style1 ml-auto">
								<ul class="filters" data-toggle="buttons">
									<li data-filter="" class="btn active">
										<input type="radio">
										<a href="#"><span>All</span></a>
									</li>
									<li data-filter="registered" class="btn">
										<input type="radio">
										<a href="#"><span>Registered</span></a>
									</li>
									<li data-filter="pending" class="btn">
										<input type="radio">
										<a href="#"><span>Pending</span></a>
									</li>
									<li data-filter="unpaid" class="btn">
										<input type="radio">
										<a href="#"><span>Unpaid</span></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="widget-inner">
						<?php
						$student_id = $_COOKIE['user_id'];
						// $student_id = 2;
						$statement = $pdo->prepare("SELECT student_course.status AS status, course.id AS course_id, course.name AS course_name, course.description AS course_description ,course.price AS course_price, course.review_data AS review_data, category.name AS category_name
    FROM student_course
    INNER JOIN course ON course.id = student_course.course_id
    INNER JOIN category ON category.id = course.cat_id
    WHERE student_id=:student_id;");
						$statement->bindParam(":student_id", $student_id);
						$statement->execute();
						$result = $statement->fetchAll();
						foreach ($result as $row) {
							$course_student_status = $row['status'];
							$course_id = $row['course_id'];
							$course_name = $row['course_name'];
							$course_description = $row['course_description'];
							$course_price = $row['course_price'];
							$course_review = json_decode($row['review_data'], true);
							$category_name = $row['category_name'];


							$status = status_filter($course_student_status);
							?>
							<div class="card-courses-list admin-courses <?php echo $status; ?>">
								<div class="card-courses-media">
									<img src="assets/images/courses/pic1.jpg" style="height: 30vh; border-radius: 25px;" />
								</div>
								<div class="card-courses-full-dec">
									<div class="card-courses-title">
										<h4><?php echo $course_name; ?></h4>
									</div>
									<div class="card-courses-list-bx">
										<ul class="card-courses-view">
											<li class="card-courses-categories">
												<h5>Category</h5>
												<h4><?php echo $category_name; ?></h4>
											</li>
											<li class="card-courses-review">
												<ul class="cours-star">
													<?php
													$one = $course_review['1'];
													$two = $course_review['2'];
													$three = $course_review['3'];
													$four = $course_review['4'];
													$five = $course_review['5'];

													$values = [$one, $two, $three, $four, $five];
													$max = max($values);
													$index = array_search($max, $values);
													$starCount = $index !== false ? $index + 1 : 0;
													for ($i = 1; $i <= 5; $i++) {
														if ($i <= $starCount) {
															echo '<li class="active"><i class="fa fa-star"></i></li>';
														} else {
															echo '<li><i class="fa fa-star"></i></li>';
														}
													}
													?>
												</ul>
											</li>
											<li class="card-courses-stats">
												<span class="btn button-sm radius-xl<?php
												if ($status == 'registered') {
													echo ' green';
												} elseif ($status == 'Pending') {
													echo ' orange';
												} elseif ($status == 'unpaid') {
													echo ' red';
												} else {
													echo ' yellow';
												}
												?>"><?php echo $status; ?></span>

											</li>
											<li class="card-courses-price">
												<h5 class="text-primary">
													<?php echo $currency; ?> 	<?php echo $course_price; ?>
												</h5>
											</li>
										</ul>
									</div>
									<div class="row card-courses-dec">
										<div class="col-md-12">
											<h6 class="m-b10"><?php echo $course_description; ?></h6>
										</div>
									</div>
									<div style="margin-top: 5vh;">
									<?php
										if ($status == 'registered') {
											echo '<button class="btn green radius-xl">You are Paid</button>';
										}else if ($status == 'unpaid') {
											echo '<button class="btn green radius-xl">Pay Now</button>';
										}else if ($status == 'pending') {
											echo '<button class="btn red radius-xl">Request Now</button>';
										}
										?>
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<div class="ttr-overlay"></div>
<?php
include ('footer.php');
?>