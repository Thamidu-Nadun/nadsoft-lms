<div class="section-area section-sp1 ovpr-dark bg-fix online-cours"
    style="background-image:url(assets/images/background/bg1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center text-white">
                <h2>Online Courses To Learn</h2>
                <h5>Own Your Feature Learning New Skills Online</h5>
                <form class="cours-search" action="search-result.php" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="What do you want to learn today?	"
                            name="search">
                        <div class="input-group-append">
                            <button class="btn" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="mw800 m-auto">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="cours-search-bx m-b30">
                        <?php
                        $statement = $pdo->prepare("SELECT COUNT(id) AS students FROM student;");
                        $statement->execute();
                        $result = $statement->fetchAll();
                        $students_count = $result[0]['students'];
                        $count_short_sign = ['K', 'M'];
                        if ($students_count > 10_000_00) {
                            $count_of_students = intdiv($students_count, 10_000_00);
                        } elseif ($students_count > 1000) {
                            $count_of_students = intdiv($students_count, 1000);
                        } else {
                            $count_of_students = $students_count;
                        }
                        ?>
                        <div class="icon-box">
                            <h3><i class="ti-user"></i><span class="counter"><?php echo $count_of_students;
                            ?></span><?php
                            if ($students_count > 10_000_00) {
                                echo $count_short_sign[1];
                            } elseif ($students_count > 1000) {
                                echo $count_short_sign[0];
                            } else {
                                echo '';
                            } ?></h3>
                        </div>
                        <span class="cours-search-text">Over <?php echo $count_of_students ?> student</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="cours-search-bx m-b30">
                        <?php
                        $statement = $pdo->prepare("SELECT COUNT(id) AS courses FROM course;");
                        $statement->execute();
                        $result = $statement->fetchAll();
                        $course_count = $result[0]['courses'];
                        $count_short_sign = ['K', 'M'];
                        if ($course_count > 10_000_00) {
                            $count_of_courses = intdiv($course_count, 10_000_00);
                        } elseif ($course_count > 1000) {
                            $count_of_courses = intdiv($course_count, 1000);
                        } else {
                            $count_of_courses = $course_count;
                        }
                        ?>
                        <div class="icon-box">
                            <h3><i class="ti-book"></i><span class="counter"><?php echo $course_count;
                            ?></span><?php
                            if ($course_count > 10_000_00) {
                                echo $count_short_sign[1];
                            } elseif ($course_count > 1000) {
                                echo $count_short_sign[0];
                            } else {
                                echo '';
                            } ?></h3>
                        </div>
                        <span class="cours-search-text"><?php echo $course_count; ?> Courses.</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="cours-search-bx m-b30">
                        <?php
                        $statement = $pdo->prepare("SELECT SUM(sessions) AS sessions FROM course;");
                        $statement->execute();
                        $result = $statement->fetchAll();
                        $sessions_count = $result[0]['sessions'];
                        $count_short_sign = ['K', 'M'];
                        if ($sessions_count > 10_000_00) {
                            $count_of_sessions = intdiv($sessions_count, 10_000_00);
                        } elseif ($sessions_count > 1000) {
                            $count_of_sessions = intdiv($sessions_count, 1000);
                        } else {
                            $count_of_sessions = $sessions_count;
                        }
                        ?>
                        <div class="icon-box">
                            <h3><i class="ti-layout-list-post"></i><span class="counter"><?php echo $count_of_sessions;
                            ?></span><?php
                            if ($sessions_count > 10_000_00) {
                                echo $count_short_sign[1];
                            } elseif ($sessions_count > 1000) {
                                echo $count_short_sign[0];
                            } else {
                                echo '';
                            } ?></h3>
                        </div>
                        <span class="cours-search-text">Learn Anythink Online.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>