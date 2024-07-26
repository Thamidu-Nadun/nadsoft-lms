<?php
function status_filter($str)
{
    switch ($str) {
        case 'Paid':
            return 'registered';
        case 'Pending':
            return 'pending';
        case 'Unpaid':
            return 'unpaid';
        default:
            return '';
    }
}
?>
<div class="tab-pane active" id="courses">
    <div class="profile-head">
        <h3>My Courses</h3>
        <div class="feature-filters style1 ml-auto">
            <ul class="filters" data-toggle="buttons">
                <li data-filter="" class="btn active">
                    <input type="radio">
                    <a href="#"><span>All</span></a>
                </li>
                <li data-filter="registered" class="btn">
                    <input type="radio">
                    <a href="#"><span>Registered</span></a>
                </li>
                <li data-filter="pending" class="btn">
                    <input type="radio">
                    <a href="#"><span>Pending</span></a>
                </li>
                <li data-filter="unpaid" class="btn">
                    <input type="radio">
                    <a href="#"><span>Unpaid</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="courses-filter">
        <div class="clearfix">
            <ul id="masonry" class="ttr-gallery-listing magnific-image row">
                <?php
                $student_id = $_COOKIE['user_id'];
                // $student_id = 2;
                $statement = $pdo->prepare("SELECT student_course.status AS status, course.id AS course_id, course.name AS course_name, course.price AS course_price, course.review_data AS review_data
    FROM student_course
    INNER JOIN course ON course.id = student_course.course_id
    WHERE student_id=:student_id;");
                $statement->bindParam(":student_id", $student_id);
                $statement->execute();
                $result = $statement->fetchAll();
                foreach ($result as $row) {
                    $course_student_status = $row['status'];
                    $course_id = $row['course_id'];
                    $course_name = $row['course_name'];
                    $course_price = $row['course_price'];
                    $course_review = json_decode($row['review_data'], true);

                    $status = status_filter($course_student_status);
                    ?>
                    <li class="action-card col-xl-4 col-lg-6 col-md-12 col-sm-6 <?php echo $status; ?>">
                        <div class="cours-bx">
                            <div class="action-box">
                                <img src="assets/images/courses/pic2.jpg" alt="">
                                <a href="#" class="btn">Read More</a>
                            </div>
                            <div class="info-bx text-center">
                                <h5><a href="#"><span><?php echo $course_name; ?></span>
                            </div>
                            <div class="cours-more-info">
                                <div class="review">
                                    <span>3 Review</span>
                                    <ul class="cours-star">
                                        <?php
                                        $one = $course_review['1'];
                                        $two = $course_review['2'];
                                        $three = $course_review['3'];
                                        $four = $course_review['4'];
                                        $five = $course_review['5'];

                                        $values = [$one, $two, $three, $four, $five];
                                        $max = max($values);
                                        $index = array_search($max, $values);
                                        $starCount = $index !== false ? $index + 1 : 0;
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $starCount) {
                                                echo '<li class="active"><i class="fa fa-star"></i></li>';
                                            } else {
                                                echo '<li><i class="fa fa-star"></i></li>';
                                            }
                                        }
                                        ?>
                                    </ul>

                                </div>
                                <div class="price">
                                    <del>$190</del>
                                    <h5><?php echo $currency . $course_price; ?></h5>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                } ?>
            </ul>
        </div>
    </div>
</div>