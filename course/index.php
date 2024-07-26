<?php
if (!isset($_COOKIE['user_mail'])) {
    header('Location: login.php');
    exit;
}
include ('../header.php');
include ('../pages/nav.php');
?>
<?php
$user_mail = $_COOKIE['user_mail'];
$user_name = $_COOKIE['user_name'];

try {
    $statement = $pdo->prepare('SELECT * FROM student WHERE mail=:mail;');
    $statement->bindParam(':mail', $user_mail);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $user_mail = $row['user_mail'];
        $user_name = $row['user_name'];
        $user_number = $row['number'];
    }
} catch (\Throwable $th) {
    //throw $th;
}
?>
<!-- Content -->
<div class="page-content bg-white">
    <!-- inner page banner -->
    <div class="page-banner ovbl-dark" style="background-image:url(assets/images/banner/banner1.jpg);">
        <div class="container">
            <div class="page-banner-entry">
                <h1 class="text-white">Profile</h1>
            </div>
        </div>
    </div>
    <!-- Breadcrumb row -->
    <div class="breadcrumb-row">
        <div class="container">
            <ul class="list-inline">
                <li><a href="#">Home</a></li>
                <li>Profile</li>
            </ul>&emsp;&emsp;
            <span id="messageBox">
                <?php echo $message; ?>
            </span>
            <script>
                const messageBox = document.getElementById('messageBox');
                setTimeout(() => {
                    messageBox.innerHTML = '';
                }, 4000);
            </script>
        </div>
    </div>
    <!-- Breadcrumb row END -->
    <!-- inner page banner END -->
    <div class="content-block">
        <!-- About Us -->
        <div class="section-area section-sp1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 m-b30">
                        <div class="profile-bx text-center">
                            <div class="user-profile-thumb">
                                <img src="<?php echo $_COOKIE['user_avatar']; ?>" alt="" />
                            </div>
                            <div class="profile-info">
                                <h4><?php echo $_COOKIE['user_name']; ?></h4>
                                <span><?php echo $_COOKIE['user_mail']; ?></span>
                            </div>
                            <div class="profile-social">
                                <ul class="list-inline m-a0">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-github"></i></a></li>
                                </ul>
                            </div>
                            <div class="profile-tabnav">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link" href="dashboard/online-class.php"><i class="ti-user"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#courses"><i
                                                class="ti-book"></i>Courses</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#quiz-results"><i
                                                class="ti-bookmark-alt"></i>Quiz Results </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#edit-profile"><i
                                                class="ti-pencil-alt"></i>Edit Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#change-password"><i
                                                class="ti-lock"></i>Change Password</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 m-b30">
                        <div class="profile-content-bx">
                            <div class="tab-content">
                                <!-- courses -->
                                <?php require ('component/courses.php'); ?>
                                <!-- quiz -->
                                <?php require ('component/quiz.php'); ?>
                                <!-- edit-profile -->
                                <?php require ('component/edit-profile.php'); ?>
                                <!-- change-password -->
                                <?php require ('component/change-password.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area END -->
</div>
<!-- Content END-->
<script>
    $(document).ready(function () {
        // Hide all tab panes
        $('.tab-pane').hide();
        // Show the active tab pane
        $('.tab-pane.active').show();

        $('.nav-tabs .nav-link').on('click', function (e) {
            e.preventDefault();
            // Remove active class from all tabs
            $('.nav-link').removeClass('active');
            // Add active class to the clicked tab
            $(this).addClass('active');

            // Hide all tab panes
            $('.tab-pane').hide();
            // Show the corresponding tab pane
            const target = $(this).attr('href');
            $(target).show();
        });
    });
</script>

<?php
include ('../footer.php');
?>