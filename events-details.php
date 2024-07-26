<?php
include ('header.php');
include ('pages/nav.php');
$message = '';
$err = '';
?>
<?php
try {
	if (isset($_GET['id'])) {
		if ($_GET['id'] == '') {
			$err = 'Page ID not provided';
		} else {
			$event_id = intval($_GET['id']);
			$statement = $pdo->prepare('SELECT * FROM event WHERE id=:id');
			$statement->bindValue(':id', $event_id);
			$statement->execute();
			$result = $statement->fetchAll();
			if (count($result) > 0) {
				foreach ($result as $row) {
					$event_id = $row['id'];
					$event_name = $row['name'];
					$event_short_description = $row['short_description'];
					$event_long_description = $row['long_description'];
					$event_certification = $row['certification'];
					$event_cat_id = $row['cat_id'];
					$event_host = $row['host'];
					$event_location = $row['location'];
					$event_level = $row['level'];
					$event_language = $row['language'];
					$event_students = $row['students'];
					$event_assessment = $row['assessment'];
					$event_date = $row['date'];
					$event_start_time = $row['start_time'];
					$event_end_time = $row['end_time'];
					$event_content = explode(',', $row['content']);
					$event_address = $row['address'];
					$event_number = $row['number'];
					$event_email = $row['email'];
					$event_facebook = $row['facebook'];
					$event_linkedin = $row['linkedin'];
					$event_x = $row['x'];
					$event_googlePlus = $row['googlePlus'];
					$image_url = $row['image'];
				}
			} else {
				$message = 'Nothing to display';
			}


		}
	}else{
		$err = '<h1 class="text-white">Page ID not provided.</h1>';
	}
}catch(Exception $e){
	echo $e->getMessage();
}

?>

<!-- Content -->
<div class="page-content bg-white">
	<!-- inner page banner -->
	<div class="page-banner ovbl-dark" style="background-image:url(assets/images/banner/banner1.jpg);
	<?php
	if ($err != '' || $message=='Nothing to display') {
		echo 'height: 100vh;';
	}
	?>">
		<div class="container">
			<div class="page-banner-entry">
				<h1 class="text-white">
				<?php
				if ($err != '') {
					echo 'Page ID not provided.';
					die();
				}elseif ($message=='Nothing to display') {
					echo $message;
					die();
				} 
				else {
					echo 'Event Details';
				}
				?></h1>
			</div>
		</div>
	</div>
	<!-- Breadcrumb row -->
	<div class="breadcrumb-row">
		<div class="container">
			<ul class="list-inline">
				<li><a href="#">Home</a></li>
				<li>Event Details</li>
				<li><?php echo $event_short_description; ?></li>
			</ul>
		</div>
	</div>
	<!-- Breadcrumb row END -->
	<!-- inner page banner END -->
	<div class="content-block">
		<!-- About Us -->
		<div class="section-area section-sp1">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-7 col-sm-12">
						<div class="courses-post">
							<div class="ttr-post-media media-effect">
								<a href="#"><img src="<?php echo $image_url; ?>" alt=""></a>
							</div>
							<div class="ttr-post-info">
								<div class="ttr-post-title ">
									<h2 class="post-title"><?php echo $event_name; ?></h2>
								</div>
								<div class="ttr-post-text">
									<p><?php echo $event_short_description; ?>
									</p>
								</div>
							</div>
						</div>
						<div class="courese-overview" id="overview">
							<div class="row">
								<div class="col-md-12 col-lg-5">
									<ul class="course-features">
										<li><i class="ti-book"></i> <span class="label">Topics</span> <span
												class="value">Web design</span></li>
										<li><i class="ti-help-alt"></i> <span class="label">Host</span> <span
												class="value"><?php echo $event_host; ?></span></li>
										<li><i class="ti-time"></i> <span class="label">Location</span> <span
												class="value"><?php echo $event_location; ?></span></li>
										<li><i class="ti-stats-up"></i> <span class="label">Skill level</span> <span
												class="value"><?php echo $event_level; ?></span></li>
										<li><i class="ti-smallcap"></i> <span class="label">Language</span> <span
												class="value"><?php echo $event_language; ?></span></li>
										<li><i class="ti-user"></i> <span class="label">Students</span> <span
												class="value"><?php echo $event_students; ?></span></li>
										<li><i class="ti-check-box"></i> <span class="label">Assessments</span> <span
												class="value"><?php
												if ($event_assessment == 1) {
													echo 'Yes';
												} else {
													echo 'No';
												} ?></span></li>
									</ul>
								</div>
								<div class="col-md-12 col-lg-7">
									<h5 class="m-b5">Event Description</h5>
									<p><?php echo $event_long_description; ?></p>
									<h5 class="m-b5">Certification</h5>
									<p><?php echo $event_certification; ?></p>
									<h5 class="m-b5">Event Content</h5>
									<ul class="list-checked primary">
										<?php foreach ($event_content as $row) {
											echo "<li>" . $row . "</li>";
										} ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-5 col-sm-12 m-b30">
						<div class="bg-primary text-white contact-info-bx m-b30">
							<h2 class="m-b10 title-head">Contact <span>Information</span></h2>
							<p>Contact us if you want to learn more about events.</p>
							<div class="widget widget_getintuch">
								<ul>
									<li><i class="ti-location-pin"></i><?php echo $event_location; ?></li>
									<li><i class="ti-mobile"></i><?php echo $event_number; ?></li>
									<li><i class="ti-email"></i><?php echo $event_email; ?></li>
								</ul>
							</div>
							<h5 class="m-t0 m-b20">Follow Us</h5>
							<ul class="list-inline contact-social-bx">
								<li><a href="<?php echo $event_facebook; ?>" class="btn outline radius-xl"><i
											class="fa fa-facebook"></i></a></li>
								<li><a href="<?php echo $event_x; ?>" class="btn outline radius-xl"><i
											class="fa fa-twitter"></i></a></li>
								<li><a href="<?php echo $event_linkedin; ?>" class="btn outline radius-xl"><i
											class="fa fa-linkedin"></i></a></li>
								<li><a href="<?php echo $event_googlePlus; ?>" class="btn outline radius-xl"><i
											class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
						<iframe
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3448.1298878182047!2d-81.38369578541523!3d30.204840081824198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88e437ac927a996b%3A0x799695b1a2b970ab!2sNona+Blue+Modern+Tavern!5e0!3m2!1sen!2sin!4v1548177305546"
							class="align-self-stretch d-flex" style="width:100%; min-width:100%; min-height:400px;"
							allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- contact area END -->

</div>
<!-- Content END-->
<?php include ('footer.php'); ?>