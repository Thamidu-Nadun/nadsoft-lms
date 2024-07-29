<?php
include ('header.php');
$message = '';
?>
<?php
$valid = true;
if (isset($_POST['submit'])) {
	$user_name = $_POST['user_name'];
	$user_mail = $_POST['user_mail'];
	$user_password = $_POST['user_password'];
	$user_number = $_POST['user_number'];
	$user_birth_date = $_POST['user_birth_date'];
	$status = 'Active';

	if (empty($user_name)) {
		$valid = false;
		echo 'User Name is required';
	}
	if (empty($user_mail)) {
		$valid = false;
		echo 'User Mail is required';
	}
	if (empty($user_password)) {
		$valid = false;
		echo 'User Password is required';
	}
	if (empty($user_number)) {
		$valid = false;
		echo 'User Number is required';
	}
	if (empty($user_birth_date)) {
		$valid = true;
		$user_birth_date = 0000 - 00 - 00;
	}
	if ($valid) {
		try {
			$statement = $pdo->prepare("INSERT INTO student (name, email, number, password, status,  avatar, birth_day) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$statement->execute([
				$user_name,
				$user_mail,
				$user_number,
				md5($user_password),
				$status,
				'assets/images/profile/pic3.jpeg',
				$user_birth_date
			]);
			$message = 'Registered Successfully!';
			echo "<script>
			setTimeout(() => {
				window.location= 'index.php';
			}, 4000);
		</script>";
		} catch (Exception $e) {
			echo $e;
		}
	}
}
?>

<body id="bg">
	<div class="page-wraper">
		<div id="loading-icon-bx"></div>
		<div class="account-form">
			<div class="account-head" style="background-image:url(assets/images/background/bg2.jpg);">
				<a href="index.html"><img src="assets/images/logo.png" alt=""></a>
			</div>
			<div class="account-form-inner">
				<div class="account-container">
					<div class="heading-bx left">
						<h2 class="title-head">Sign Up <span>Now</span></h2>
						<p>Login Your Account <a href="login.php">Click here</a></p>
					</div>
					<form class="contact-bx" method="post">
						<div class="row placeani">
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Your Name</label>
										<input name="user_name" type="text" required="" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Your Email Address</label>
										<input name="user_mail" type="email" required="" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Your Password</label>
										<input name="user_password" type="password" class="form-control" required="">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label title="Enter your Whatsapp number for contact you">Whatsapp Number <i
												class="fa fa-whatsapp"></i></label>
										<input name="user_number" type="tel" class="form-control" required
											maxlength="10">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label title="Enter your Whatsapp number for contact you">Your Birth Day</label>
										<input name="user_birth_date" type="date" class="form-control" required
											maxlength="10">
									</div>
								</div>
							</div>
							<div class="col-lg-12 m-b30">
								<button name="submit" type="submit" value="Submit" class="btn button-md">Sign
									Up</button>
							</div>
							<div id="message-box">
								<?php echo $message; ?>
							</div>
							<script>
								const message_box = document.getElementById("message-box");
								setTimeout(() => {
									message_box.innerHTML = '';
								}, 3000);
							</script>
							<div class="col-lg-12">
								<h6>Sign Up with Social media</h6>
								<div class="d-flex">
									<a class="btn flex-fill m-r5 facebook" href="#"><i
											class="fa fa-facebook"></i>Facebook</a>
									<a class="btn flex-fill m-l5 google-plus" href="#"><i
											class="fa fa-google-plus"></i>Google Plus</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
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
	<script src="assets/js/functions.js"></script>
	<script src="assets/js/contact.js"></script>
	<!-- <script src='assets/vendors/switcher/switcher.js'></script> -->
</body>

</html>