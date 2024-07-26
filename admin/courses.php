<?php
ob_start(); // Start output buffering

include ('header.php');
include ('pages/nav.php');
include ('pages/slide-navbar.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['approve'])) {
		$status = 'Active';
		$statement = $pdo->prepare('UPDATE course SET status=:status WHERE id=:id');
		$statement->bindParam(':status', $status);
		$statement->bindParam(':id', $_POST['id']);
		$statement->execute();
	} elseif (isset($_POST['cancel'])) {
		$status = 'Rejected';
		$statement = $pdo->prepare('UPDATE course SET status=:status WHERE id=:id');
		$statement->bindParam(':status', $status);
		$statement->bindParam(':id', $_POST['id']);
		$statement->execute();
	} elseif (isset($_POST['banned'])) {
		$status = 'Banned';
		$statement = $pdo->prepare('UPDATE course SET status=:status WHERE id=:id');
		$statement->bindParam(':status', $status);
		$statement->bindParam(':id', $_POST['id']);
		$statement->execute();
	}
	elseif (isset($_POST['hold'])) {
		$status = 'Pending';
		$statement = $pdo->prepare('UPDATE course SET status=:status WHERE id=:id');
		$statement->bindParam(':status', $status);
		$statement->bindParam(':id', $_POST['id']);
		$statement->execute();
	}
}

ob_end_flush(); // Flush the output buffer and turn off output buffering

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
					<div class="wc-title">
						<h4>LMS Courses</h4>
					</div>
					<div class="widget-inner">
						<?php
						try {
							$statement = $pdo->prepare("SELECT course.*, teacher.full_name AS teacher_name, category.name AS category_name 
                            FROM course
                            INNER JOIN teacher ON course.teacher_id = teacher.id
                            INNER JOIN category ON course.cat_id = category.id
							");
							$statement->execute();
							$result = $statement->fetchAll();
							if (count($result) > 0) {
								foreach ($result as $row) {
									$id = $row['id'];
									$name = $row['name'];
									$teacher_id = $row['teacher_id'];
									$teacher_name = $row['teacher_name'];
									$category_id = $row['cat_id'];
									$category_name = $row['category_name'];
									$review = $row['review'];
									$status = $row['status'];
									$price = $row['price'];
									$description = $row['description'];

									?>
									<div class="card-courses-list admin-courses">
										<div class="card-courses-media">
											<img src="assets/images/courses/pic1.jpg" alt="" />
										</div>
										<div class="card-courses-full-dec">
											<div class="card-courses-title">
												<h4><?php echo $name; ?></h4>
											</div>
											<div class="card-courses-list-bx">
												<ul class="card-courses-view">
													<li class="card-courses-user">
														<div class="card-courses-user-pic">
															<img src="assets/images/testimonials/pic3.jpg" alt="" />
														</div>
														<div class="card-courses-user-info">
															<h5>Teacher</h5>
															<h4><?php echo $teacher_name; ?></h4>
														</div>
													</li>
													<li class="card-courses-categories">
														<h5>Category</h5>
														<h4><?php echo $category_name; ?></h4>
													</li>
													<li class="card-courses-review">
														<h5><?php echo $review; ?> Review</h5>
														<ul class="cours-star">
															<li class="active"><i class="fa fa-star"></i></li>
															<li class="active"><i class="fa fa-star"></i></li>
															<li class="active"><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
															<li><i class="fa fa-star"></i></li>
														</ul>
													</li>
													<li class="card-courses-stats">
														<span class="btn button-sm radius-xl<?php
														if ($status == 'Active') {
															echo ' green';
														} elseif ($status == 'Pending') {
															echo ' orange';
														} elseif ($status == 'Rejected' || $status == 'Banned') {
															echo ' red';
														} else {
															echo ' yellow';
														}
														?>"><?php echo $status; ?></span>

													</li>
													<li class="card-courses-price">
														<del><?php echo $currency; ?><?php echo $price + 100; ?></del>
														<h5 class="text-primary"><?php echo $currency; ?><?php echo $price; ?></h5>
													</li>
												</ul>
											</div>
											<div class="row card-courses-dec">
												<div class="col-md-12">
													<h6 class="m-b10"><?php echo $description; ?></h6>
												</div>
												<?php
												if ($status == 'Active') {
													echo '<div class="col-md-12">
            <form action="' . $_SERVER["PHP_SELF"] . '" method="post">
                <input type="hidden" name="id" value="' . $id . '">
                <button type="submit" class="btn orange radius-xl" name="hold">Hold</button>
                <button type="submit" class="btn red radius-xl" name="banned">Banned</button>
            </form>
          </div>';
												} elseif ($status == 'Pending' || $status == 'Rejected') {
													echo '<div class="col-md-12">
            <form action="' . $_SERVER["PHP_SELF"] . '" method="post">
                <input type="hidden" name="id" value="' . $id . '">
                <button type="submit" class="btn green radius-xl" name="approve">Approve</button>
                <button type="submit" class="btn red radius-xl" name="cancel">Cancel</button>
            </form>
          </div>';
												}elseif ($status == 'Banned') {
													echo '<div class="col-md-12">
            <form action="' . $_SERVER["PHP_SELF"] . '" method="post">
                <input type="hidden" name="id" value="' . $id . '">
                <button type="submit" class="btn green radius-xl" name="approve">Approve</button>
            </form>
          </div>';
												} else {
													echo 'something wrong';
												}
												?>

											</div>
										</div>
									</div>
								<?php }
							} else {
								echo 'Nothing To Display!';
							}
						} catch (Exception $e) {
							echo $e;
						} ?>
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