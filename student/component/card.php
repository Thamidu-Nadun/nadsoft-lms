<?php
$student_id = 1;
$student_mail = 'alex@gmail.com';
?>
<div class="row">
	<?php
	$statement = $pdo->prepare("SELECT COUNT(id) AS count_of_course
	FROM student_course 
	WHERE student_id = :student_id");
	$statement->bindParam(':student_id', $student_id);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		$count_of_courses = $row['count_of_course'];
	}
	?>
	<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
		<div class="widget-card widget-bg1">
			<div class="wc-item">
				<h4 class="wc-title">
					Courses
				</h4>
				<span class="wc-stats">
					<span class="counter"><?php echo $count_of_courses; ?></span>
				</span>
				<div class="progress wc-progress">
					<div class="progress-bar" role="progressbar" style="width: 78%;" aria-valuenow="50"
						aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<span class="wc-progress-bx">
					<span class="wc-change">
						<a href="courses.php">View</a>
					</span>
					<span class="wc-number ml-auto">
						78%
					</span>
				</span>
			</div>
		</div>
	</div>
	<?php
	$statement = $pdo->prepare("SELECT COUNT(id) AS count_of_notifications
	FROM notifications 
	WHERE receiver = :student_mail");
	$statement->bindParam(':student_mail', $student_mail);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		$count_of_notifications = $row['count_of_notifications'];
	}
	?>
	<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
		<div class="widget-card widget-bg2">
			<div class="wc-item">
				<h4 class="wc-title">
					New Messages
				</h4>
				<span class="wc-stats counter">
					<?php echo $count_of_notifications; ?>
				</span>
				<div class="progress wc-progress">
					<div class="progress-bar" role="progressbar" style="width: 88%;" aria-valuenow="50"
						aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<span class="wc-progress-bx">
					<span class="wc-change">
						<a href="mailbox.php">View</a>
					</span>
					<span class="wc-number ml-auto">
						88%
					</span>
				</span>
			</div>
		</div>
	</div>
	<?php
	$statement = $pdo->prepare("SELECT COUNT(id) AS count_of_quizzes
	FROM quiz_result 
	WHERE student_id = :student_id");
	$statement->bindParam(':student_id', $student_id);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		$count_of_quizzes = $row['count_of_quizzes'];
	}
	?>
	<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
		<div class="widget-card widget-bg3">
			<div class="wc-item">
				<h4 class="wc-title">
					Quizzes
				</h4>
				<span class="wc-stats counter">
				<?php echo $count_of_quizzes; ?>
				</span>
				<div class="progress wc-progress">
					<div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="50"
						aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<span class="wc-progress-bx">
					<span class="wc-change">
						<a href="quiz.php">View</a>
					</span>
					<span class="wc-number ml-auto">
						65%
					</span>
				</span>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
		<div class="widget-card widget-bg4">
			<div class="wc-item">
				<h4 class="wc-title">
					Assessments
				</h4>
				<span class="wc-stats counter">
					350
				</span>
				<div class="progress wc-progress">
					<div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="50"
						aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<span class="wc-progress-bx">
					<span class="wc-change">
						Change
					</span>
					<span class="wc-number ml-auto">
						90%
					</span>
				</span>
			</div>
		</div>
	</div>
</div>