<?php
include ('header.php');
include ('pages/nav.php');
include ('pages/slide-navbar.php');
?>
<?php

if (!isset($_COOKIE['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Your existing index code
?>


<!--Main container start -->
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Dashboard</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
				<li>Dashboard</li>
			</ul>
		</div>
		<!-- Card -->
		<?php include ('pages/card.php'); ?>
		<!-- Card END -->
		<div class="row">
			<?php include ('pages/chart.php') ?>
			<?php include ('pages/notification.php') ?>
			<?php include ('pages/new-users.php') ?>
			<?php include ('pages/orders.php') ?>
			<?php include ('pages/calender.php') ?>
		</div>
	</div>
</main>
<div class="ttr-overlay"></div>
<?php include ('footer.php') ?>