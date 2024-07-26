<?php

include ('header.php');
include ('component/nav.php');
include ('component/slide-navbar.php');
?>
<div class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Quizzes</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
                <li>Quizzes</li>
            </ul>
        </div>
        <div class="tab-pane" id="quiz-results">
            <div class="profile-head">
                <h3>Quiz Results</h3>
            </div>
            <?php
            $student_id = 1;
            $statement = $pdo->prepare("SELECT quiz_result.name AS quiz_name, quiz_result.mark AS mark, course.id, course.name AS course_name, course.level AS course_level, course.language AS course_language, course.duration AS course_duration
        FROM quiz_result
        INNER JOIN course ON quiz_result.course_id = course.id
        WHERE student_id=:student_id;");
            $statement->bindParam(":student_id", $student_id);
            $statement->execute();
            $result = $statement->fetchAll();
            foreach ($result as $row) {
                $quiz_name = $row['quiz_name'];
                $mark = $row['mark'];
                $course_name = $row['course_name'];
                $course_level = $row['course_level'];
                $course_language = $row['course_language'];
                $course_duration = $row['course_duration'];
                ?>
                <div class="courses-filter">
                    <div class="column">
                        <div class="col-md-6 col-lg-6 course-box">
                            <div class="course-name" style="cursor: pointer;">
                                <?php echo $course_name; ?>
                                <style>
                                    .arrow {
                                        position: absolute;
                                        right: 0;
                                        font-size: 1.3em;
                                        transition: all 1s;
                                    }
                                </style>
                                <span class="arrow"><i class="fa fa-caret-down"></i></span> <!-- Down arrow -->
                            </div>
                            <ul class="course-features" style="display: none;">
                                <li><i class="ti-book"></i> <span class="label">Course Name</span>
                                    <span class="value"><?php echo $course_name; ?></span>
                                </li>
                                <li><i class="ti-help-alt"></i> <span class="label">Quizzes</span>
                                    <span class="value"><?php echo $quiz_name; ?></span>
                                </li>
                                <li><i class="ti-flag"></i> <span class="label">Mark</span>
                                    <span class="value"><?php echo $mark; ?></span>
                                </li>
                                <li><i class="ti-time"></i> <span class="label">Duration</span>
                                    <span class="value"><?php echo $course_duration; ?></span>
                                </li>
                                <li><i class="ti-stats-up"></i> <span class="label">Skill level</span>
                                    <span class="value"><?php echo $course_level; ?></span>
                                </li>
                                <li><i class="ti-smallcap"></i> <span class="label">Language</span>
                                    <span class="value"><?php echo $course_language; ?></span>
                                </li>
                            </ul>
                            <hr> <!-- Bottom dividing line -->
                        </div>
                    </div>
                </div>
                <?php
            } ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.course-name').click(function () {
            var $features = $(this).next('.course-features');
            $features.slideToggle(500);

            // Toggle the caret direction
            var $arrow = $(this).find('.arrow i');
            if ($arrow.hasClass('fa-caret-down')) {
                $arrow.removeClass('fa-caret-down').addClass('fa-caret-up');
            } else {
                $arrow.removeClass('fa-caret-up').addClass('fa-caret-down');
            }
        });
    });
</script>