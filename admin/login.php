<?php
include('header.php');
ob_start(); // Start output buffering

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$message = '';

// Process the form when submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login_submit'])) {
        $admin_mail = filter_var($_POST['admin_email'], FILTER_SANITIZE_EMAIL);
        $admin_password = $_POST['admin_password'];
        $remember = isset($_POST['remember']) ? $_POST['remember'] : '';

        // Validate email
        if (!filter_var($admin_mail, FILTER_VALIDATE_EMAIL)) {
            $message = 'Invalid email format.';
        } else {
            // Database connection
            try {
                $statement = $pdo->prepare("SELECT * FROM teacher WHERE email = :email");
                $statement->bindParam(':email', $admin_mail, PDO::PARAM_STR);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    // Debugging: print password hash
                    echo 'Password from DB: ' . $result['password'] . '<br>';
                    echo 'Password entered: ' . md5($admin_password) . '<br>';

                    // Verify the password
                    if (md5($admin_password) === $result['password']) {
                        if ($remember == 'remember') {
                            $expire = time() + 60 * 60 * 24 * 7; // 7 days
                            setcookie('admin_id', $result['id'], $expire, '/', '', true, true);
                            setcookie('admin_name', $result['user_name'], $expire, '/', '', true, true);
                            setcookie('admin_mail', $result['email'], $expire, '/', '', true, true);
                            setcookie('admin_status', $result['status'], $expire, '/', '', true, true);
                            setcookie('admin_avatar', $result['avatar'], $expire, '/', '', true, true);
                        } else {
                            $_SESSION['admin_id'] = $result['id'];
                            $_SESSION['admin_name'] = $result['user_name'];
                            $_SESSION['admin_mail'] = $result['email'];
                            $_SESSION['admin_status'] = $result['status'];
                            $_SESSION['admin_avatar'] = $result['avatar'];
                        }
                        header("Location: index.php"); // Redirect to the dashboard
                        exit();
                    } else {
                        $message = 'Invalid password.';
                    }
                } else {
                    $message = 'No user found with this email.';
                }
            } catch (PDOException $e) {
                $message = 'Database error: ' . $e->getMessage();
            }
        }
    }
}
ob_end_flush(); // Flush the output buffer
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body class="login-page">
    <div class="login-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <h3 class="form-title">Admin Login</h3>
                    <form method="POST" action="login.php">
                        <div class="form-group">
                            <label for="admin_email">Email:</label>
                            <input type="email" name="admin_email" id="admin_email" required placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="admin_password">Password:</label>
                            <input type="password" name="admin_password" id="admin_password" required placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" name="remember" id="remember" value="remember" class="form-check-input">
                            <label for="remember" class="form-check-label">Remember Me</label>
                        </div>
                        <button type="submit" name="login_submit" class="btn btn-primary">Login</button>
                    </form>
                    <div class="message mt-3">
                        <?php echo $message; // Display the message for admin feedback ?>
                    </div>
                    <div class="social-login mt-3">
                        <h6>Login with Social media</h6>
                        <div class="d-flex">
                            <a class="btn flex-fill m-r5 facebook" href="#"><i class="fa fa-facebook"></i> Facebook</a>
                            <a class="btn flex-fill m-l5 google-plus" href="#"><i class="fa fa-google-plus"></i> Google Plus</a>
                        </div>
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
    <script src="assets/vendors/switcher/switcher.js"></script>
</body>
</html>
