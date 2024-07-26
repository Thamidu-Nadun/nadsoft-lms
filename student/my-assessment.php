<?php
include ('header.php');
include ('component/nav.php');
include ('component/slide-navbar.php');
?>
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Assessments Class</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
                <li>Assessments</li>
            </ul>
        </div>
        <div class="row">
            <!-- Your Profile Views Chart -->
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="wc-title">
                        <h4>Assessments</h4>
                    </div>
                    <table class="table table-bordered table-hover table-striped">
                        <tr style="text-align: center;">
                            <th width="05">ID</th>
                            <th width="10">Title</th>
                            <th width="35">Description</th>
                            <th width="15">Course Name</th>
                            <th width="10">Created At</th>
                            <th width="10">Due Date</th>
                            <th width="05">Max Score</th>
                            <th width="05">Passing Score</th>
                            <th width="05">Status</th>
                        </tr>
                        <?php
                        $student_id = 1;
                        $statement = $pdo->prepare("
        SELECT DISTINCT assessments.*, course.name AS course_name
        FROM assessments
        INNER JOIN course ON course.id = assessments.course_id
        INNER JOIN student_course ON student_course.course_id = assessments.course_id
        WHERE student_course.student_id = :student_id
    ");

                        $statement->bindParam(':student_id', $student_id);
                        $statement->execute();
                        $result = $statement->fetchAll();
                        $i = 1;

                        if (count($result) > 0) {
                            foreach ($result as $row) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                                    <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                    <td><?php echo htmlspecialchars($row['due_date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['max_score']); ?></td>
                                    <td><?php echo htmlspecialchars($row['passing_score']); ?></td>
                                    <td>
                                        <span class="btn button-sm radius-xl<?php
                                        if ($row['status'] == 1) {
                                            echo ' green';
                                        } else {
                                            echo ' yellow';
                                        }
                                        ?>"><?php
                                        if ($row['status'] == 1) {
                                            echo '<span class="bg-green">Completed</span>';
                                        } else {
                                            echo 'Submit';
                                        } ?></span>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        } else {
                            echo "<tr style='text-align: center;'><td colspan='9'>No data found.</td></tr>";
                        }
                        ?>
                    </table>


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
<!-- <script src='assets/vendors/switcher/switcher.js'></script> -->
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/bookmark.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:10:19 GMT -->

</html>