<?php
include('header.php');

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login_submit'])) {
        $admin_mail = filter_var($_POST['admin_email'], FILTER_SANITIZE_EMAIL);
        $admin_password = $_POST['admin_password'];
        $remember = isset($_POST['remember']) ? $_POST['remember'] : '';

        $statement = $pdo->prepare("SELECT * FROM student WHERE email = :email");
        $statement->bindParam(':email', $admin_mail, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $real_password = $result['password'];

            // Example using bcrypt for password verification (requires password_hash function)
            if (md5($admin_password) === $real_password) {
                if ($remember == 'remember') {
                    // Set cookies
                    $expire = time() + 60 * 60 * 24 * 7; // 7 days
                    setcookie('admin_id', $result['id'], $expire, '/');
                    setcookie('admin_name', $result['name'], $expire, '/');
                    setcookie('admin_mail', $result['email'], $expire, '/');
                    setcookie('admin_status', $result['status'], $expire, '/');
                    setcookie('admin_avatar', $result['avatar'], $expire, '/');
                } else {
                    // Start session
                    session_start();
                    $_SESSION['admin_id'] = $result['id'];
                    $_SESSION['admin_name'] = $result['name'];
                    $_SESSION['admin_email'] = $result['email'];
                    $_SESSION['admin_status'] = $result['status'];
                    $_SESSION['admin_avatar'] = $result['avatar'];
                }

                $message = 'Login successful';
                echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 3000);</script>";
                exit;
            } else {
                $message = 'Invalid password.';
            }
        } else {
            $message = 'Invalid email.';
        }
    }
}

echo $message; // Display the message for debugging purposes
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include your CSS and JS files -->
</head>
<body>
    <div class="page-wraper">
        <div id="loading-icon-bx"></div>
        <div class="account-form">
            <div class="account-head" style="background-image:url(assets/images/background/bg2.jpg);">
                <a href="index.php"><img src="assets/images/logo.png" alt=""></a>
            </div>
            <div class="account-form-inner">
                <div class="account-container">
                    <div class="heading-bx left">
                        <h2 class="title-head">Login to your <span>Account</span></h2>
                        <p>Don't have an account? <a href="register.php">Create one here</a></p>
                    </div>
                    <form class="contact-bx" method="post">
                        <div class="row placeani">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Your Email</label>
                                        <input name="admin_email" type="email" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label>Your Password</label>
                                        <input name="admin_password" type="password" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group form-forget">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="remember" value="remember">
                                        <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                                    </div>
                                    <a href="forget-password.html" class="ml-auto">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="col-lg-12 m-b30 button-box">
                                <button name="login_submit" type="submit" value="Submit" class="btn button-md">Login</button>
                                <button type="reset" class="btn button-md red">Reset</button>
                            </div>
                            <div class="col-lg-12">
                                <h6>Login with Social media</h6>
                                <div class="d-flex">
                                    <a class="btn flex-fill m-r5 facebook" href="#"><i class="fa fa-facebook"></i>Facebook</a>
                                    <a class="btn flex-fill m-l5 google-plus" href="#"><i class="fa fa-google-plus"></i>Google Plus</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="message">
                        <?php echo $message; // Display the message for admin feedback ?>
                    </div>
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
    <script src='assets/vendors/switcher/switcher.js'></script>
</body>
</html>
