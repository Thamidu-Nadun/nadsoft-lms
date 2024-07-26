<?php
include ('header.php');
include ('pages/nav.php');
?>
<!-- Content -->
<div class="page-content bg-white">
	<!-- inner page banner -->
	<div class="page-banner ovbl-dark" style="background-image:url(assets/images/banner/banner2.jpg);">
		<div class="container">
			<div class="page-banner-entry">
				<h1 class="text-white">Events</h1>
			</div>
		</div>
	</div>
	<!-- Breadcrumb row -->
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="#">Home</a></li>
				<li>Events</li>
			</ul>
		</div>
	</div>
	<!-- Breadcrumb row END -->
	<!-- contact area -->
	<div class="content-block">
		<!-- Portfolio  -->
		<div class="section-area section-sp1 gallery-bx">
			<div class="container">
				<div class="feature-filters clearfix center m-b40">
					<ul class="filters" data-toggle="buttons">
						<li data-filter="" class="btn active">
							<input type="radio">
							<a href="#"><span>All</span></a>
						</li>
						<li data-filter="happening" class="btn">
							<input type="radio">
							<a href="#"><span>Happening</span></a>
						</li>
						<li data-filter="upcoming" class="btn">
							<input type="radio">
							<a href="#"><span>Upcoming</span></a>
						</li>
						<li data-filter="expired" class="btn">
							<input type="radio">
							<a href="#"><span>Expired</span></a>
						</li>
					</ul>
				</div>
				<div class="clearfix">
					<ul id="masonry" class="ttr-gallery-listing magnific-image row">
						<?php
						$today_date = date('Y-m-d');
						$statement = $pdo->prepare("SELECT * FROM event WHERE date>=:Date");
						$statement->bindValue(':Date', $today_date);
						$statement->execute();
						$result = $statement->fetchAll();
						foreach ($result as $row) {
							$event_id = $row['id'];
							$event_name = $row['name'];
							$event_short_description = $row['short_description'];
							$image_url = $row['image'];
							$date = $row['date'];
							$start_time = $row['start_time'];
							$end_time = $row['end_time'];
							$event_location = $row['location'];

							?>

							<!-- upcoming -->
							<li class="action-card col-lg-6 col-md-6 col-sm-12 upcoming">
								<div class="event-bx m-b30">
									<div class="action-box">
										<img src="assets/images/event/pic2.jpg" alt="">
									</div>
									<div class="info-bx d-flex">
										<div>
											<div class="event-time">
												<div class="event-date">29</div>
												<div class="event-month">October</div>
											</div>
										</div>
										<div class="event-info">
											<h4 class="event-title"><a href="events-details.php?id=<?php echo $event_id; ?>"><?php echo $event_name; ?></a></h4>
											<ul class="media-post">
												<li><a href="#"><i class="fa fa-clock-o"></i><?php echo $start_time; ?> <?php echo $end_time; ?></a></li>
												<li><a href="#"><i class="fa fa-map-marker"></i> <?php echo $event_location; ?></a></li>
											</ul>
											<p><?php echo $event_short_description; ?></p>
										</div>
									</div>
								</div>
							</li>
							<!-- endUpcoming -->
							<?php
						} ?>

						<?php
						$today_date = date('Y-m-d');
						$today_time = time();
						$statement = $pdo->prepare("SELECT * FROM event WHERE date=:Date AND (start_time>:Start_time AND end_time>:End_time);");
						$statement->bindValue(':Date', $today_date);
						$statement->bindValue(':Start_time', $today_time);
						$statement->bindValue(':End_time', $today_time);
						$statement->execute();
						$result = $statement->fetchAll();
						foreach ($result as $row) {
							$event_id = $row['id'];
							$event_name = $row['name'];
							$event_short_description = $row['short_description'];
							$image_url = $row['image'];
							$date = $row['date'];
							$start_time = $row['start_time'];
							$end_time = $row['end_time'];
							$event_location = $row['location'];

							?>
							<!-- happening -->
							<li class="action-card col-lg-6 col-md-6 col-sm-12 happening">
								<div class="event-bx m-b30">
									<div class="action-box">
										<img src="assets/images/event/pic1.jpg" alt="">
									</div>
									<div class="info-bx d-flex">
										<div>
											<div class="event-time">
												<div class="event-date">29</div>
												<div class="event-month">October</div>
											</div>
										</div>
										<div class="event-info">
											<h4 class="event-title"><a href="events-details.php?id=<?php echo $event_id; ?>"><?php echo $event_name; ?></a></h4>
											<ul class="media-post">
												<li><a href="#"><i class="fa fa-clock-o"></i> <?php echo $start_time; ?> <?php echo $end_time; ?></a></li>
												<li><a href="#"><i class="fa fa-map-marker"></i> <?php echo $event_location; ?></a></li>
											</ul>
											<p><?php echo $event_short_description; ?></p>
										</div>
									</div>
								</div>
							</li>
							<!-- endHappening -->
							<?php
						} ?>

						<?php
						$today_date = date('Y-m-d');
						$today_time = time();
						$statement = $pdo->prepare("SELECT * FROM event WHERE date<:Date AND end_time<:Time");
						$statement->bindValue(':Date', $today_date);
						$statement->bindValue(':Time', $today_time);
						$statement->execute();
						$result = $statement->fetchAll();
						foreach ($result as $row) {
							$event_id = $row['id'];
							$event_name = $row['name'];
							$event_short_description = $row['short_description'];
							$image_url = $row['image'];
							$date = $row['date'];
							$start_time = $row['start_time'];
							$end_time = $row['end_time'];
							$event_location = $row['location'];

							?>
							<!-- expired -->
							<li class="action-card col-lg-6 col-md-6 col-sm-12 expired">
								<div class="event-bx m-b30">
									<div class="action-box">
										<img src="assets/images/event/pic2.jpg" alt="">
									</div>
									<div class="info-bx d-flex">
										<div>
											<div class="event-time">
												<div class="event-date">29</div>
												<div class="event-month">October</div>
											</div>
										</div>
										<div class="event-info">
											<h4 class="event-title"><a href="events-details.php?id=<?php echo $event_id; ?>"><?php echo $event_name; ?></a></h4>
											<ul class="media-post">
												<li><a href="#"><i class="fa fa-clock-o"></i> <?php echo $start_time; ?> <?php echo $end_time; ?></a></li>
												<li><a href="#"><i class="fa fa-map-marker"></i> <?php echo $event_location; ?></a></li>
											</ul>
											<p><?php echo $event_short_description; ?></p>
										</div>
									</div>
								</div>
							</li>
							<!-- endExpired -->
							<?php
						} ?>





					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- contact area END -->
</div>
<!-- Content END-->
<?php
include ('footer.php');
?>