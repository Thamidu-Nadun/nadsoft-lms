<?php
include ('header.php');
include ('component/nav.php');
include ('component/slide-navbar.php');
?>

<!--Main container start -->
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Mailbox</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
				<li>Mailbox</li>
			</ul>
		</div>
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="email-wrapper">
						<div class="email-menu-bar">
							<div class="compose-mail">
								<a href="mailbox-compose.php" class="btn btn-block">Compose</a>
							</div>
							<div class="email-menu-bar-inner">
								<ul>
									<li class="active"><a href="mailbox.html"><i class="fa fa-envelope-o"></i>Inbox
											<span class="badge badge-success">8</span></a></li>
									<li><a href="mailbox.html"><i class="fa fa-send-o"></i>Sent</a></li>
									<li><a href="mailbox.html"><i class="fa fa-file-text-o"></i>Drafts <span
												class="badge badge-warning">8</span></a></li>
									<li><a href="mailbox.html"><i class="fa fa-cloud-upload"></i>Outbox <span
												class="badge badge-danger">8</span></a></li>
									<li><a href="mailbox.html"><i class="fa fa-trash-o"></i>Trash</a></li>
								</ul>
							</div>
						</div>
						<div class="mail-list-container">
							<div class="mail-toolbar">
								<div class="check-all">
									<div class="custom-control custom-checkbox checkbox-st1">
										<input type="checkbox" class="custom-control-input" id="check1">
										<label class="custom-control-label" for="check1"></label>
									</div>
								</div>
								<div class="mail-search-bar">
									<input type="text" class="form-control" placeholder="Search" />
								</div>
								<div class="dropdown all-msg-toolbar">
									<span class="btn btn-info-icon" data-toggle="dropdown"><i
											class="fa fa-ellipsis-v"></i></span>
									<ul class="dropdown-menu">
										<li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
										<li><a href="#"><i class="fa fa-arrow-down"></i> Archive</a></li>
										<li><a href="#"><i class="fa fa-clock-o"></i> Snooze</a></li>
										<li><a href="#"><i class="fa fa-envelope-open"></i> Mark as unread</a></li>
									</ul>
								</div>
								<div class="next-prev-btn">
									<a href="#"><i class="fa fa-angle-left"></i></a>
									<a href="#"><i class="fa fa-angle-right"></i></a>
								</div>
							</div>
							<div class="mail-box-list">
								<?php
								$receiver = 'alex@gmail.com';
								$statement = $pdo->prepare("SELECT * FROM notifications WHERE receiver= :receiver AND status = 1 AND role = 'User';");
								$statement->bindParam(':receiver', $receiver);
								$statement->execute();
								$result = $statement->fetchAll();
								foreach ($result as $row) {
									$id = $row['id'];
									$sender = $row['sender'];
									$receiver = $row['receiver'];
									$message = $row['message'];
									$time = $row['time'];
									$date = $row['date'];
									$read_status = $row['read_status'];

									?>
									<div class="mail-list-info">
										<div class="checkbox-list">
											<div class="custom-control custom-checkbox checkbox-st1">
												<input type="checkbox" class="custom-control-input" id="check2">
												<label class="custom-control-label" for="check2"></label>
											</div>
										</div>
										<div class="mail-rateing">
											<span><i class="fa fa-star-o"></i></span>
										</div>
										<div class="mail-list-title">
											<h6><?php echo $sender; ?></h6>
										</div>&emsp;
										<div class="mail-list-title-info">
											<?php
											if ($read_status == 1){
												echo '<p>'.$message;'</p>';
											}else{
												echo '<p style="color: #fff;">'.$message.'</p>';
											}
								
											?>
										</div>
										<div class="mail-list-time">
											<span><?php echo $date.'&emsp;&emsp;&emsp;';?></span>
										</div>
										<div class="mail-list-time">
											<span><?php echo $time.' ';
											if ($time<12) {
												echo 'A.M';
											}else{
												echo 'P.M';
											}
											?></span>
										</div>
										<ul class="mailbox-toolbar">
											<li data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></li>
											<li data-toggle="tooltip" title="Archive"><i class="fa fa-arrow-down"></i></li>
											<li data-toggle="tooltip" title="Snooze"><i class="fa fa-clock-o"></i></li>
											<li data-toggle="tooltip" title="Mark as unread"><i
													class="fa fa-envelope-open"></i></li>
										</ul>
									</div>
									<?php
								} ?>
							</div>
						</div>
					</div>
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
<script src='assets/vendors/switcher/switcher.js'></script>
<script>
	$(document).ready(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});
</script>
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/mailbox.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:11:35 GMT -->

</html>