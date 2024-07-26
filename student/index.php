<?php
include ('header.php');
include ('component/nav.php');
include ('component/slide-navbar.php');
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
		<?php include('component/card.php'); ?>

	</div>
</main>
<div class="ttr-overlay"></div>
<?php include ('footer.php') ?>