<div class="row">
	<?php
	$statement = $pdo->prepare("SELECT SUM(c.price * sc.student_count) AS total_profit
	FROM course c
	JOIN (
		SELECT course_id, COUNT(student_id) AS student_count
		FROM student_course
		GROUP BY course_id
	) sc ON c.id = sc.course_id;
	");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {}
		$total_profit = $row['total_profit'];
		
	?>
	<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
		<div class="widget-card widget-bg1">
			<div class="wc-item">
				<h4 class="wc-title">
					Total Frofit
				</h4>
				<span class="wc-des">
					All Customs Value
				</span>
				<span class="wc-stats">
					Rs.<span class="counter"><?php echo $total_profit; ?></span>
				</span>
				<div class="progress wc-progress">
					<div class="progress-bar" role="progressbar" style="width: 78%;" aria-valuenow="50"
						aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<span class="wc-progress-bx">
					<span class="wc-change">
						Change
					</span>
					<span class="wc-number ml-auto">
						78%
					</span>
				</span>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
		<div class="widget-card widget-bg2">
			<div class="wc-item">
				<h4 class="wc-title">
					New Feedbacks
				</h4>
				<span class="wc-des">
					Customer Review
				</span>
				<span class="wc-stats counter">
					120
				</span>
				<div class="progress wc-progress">
					<div class="progress-bar" role="progressbar" style="width: 88%;" aria-valuenow="50"
						aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<span class="wc-progress-bx">
					<span class="wc-change">
						Change
					</span>
					<span class="wc-number ml-auto">
						88%
					</span>
				</span>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
		<div class="widget-card widget-bg3">
			<div class="wc-item">
				<h4 class="wc-title">
					New Orders
				</h4>
				<span class="wc-des">
					Fresh Order Amount
				</span>
				<span class="wc-stats counter">
					772
				</span>
				<div class="progress wc-progress">
					<div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="50"
						aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<span class="wc-progress-bx">
					<span class="wc-change">
						Change
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
					New Users
				</h4>
				<span class="wc-des">
					Joined New User
				</span>
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