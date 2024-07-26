<?php
ob_start();
include ('header.php');
include ('pages/nav.php');
include ('pages/slide-navbar.php');
$message='';

ob_end_flush();
?>
<!-- Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Calender</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>Calender</li>
            </ul>
            <div><?php echo $message; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="widget-inner">
                        <?php include('pages/calender.php');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include ('footer.php'); ?>