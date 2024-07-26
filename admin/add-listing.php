<?php
ob_start();
include('header.php');
include('pages/nav.php');
include('pages/slide-navbar.php');

$message = '';

if (isset($_POST['course_add'])) {
    $valid = true;
    $message = '';

    // Validation
    if (empty($_POST['category'])) {
        $valid = false;
        $message .= "You must select a category.<br>";
    }
    if (empty($_POST['course_name'])) {
        $valid = false;
        $message .= "Name cannot be empty.<br>";
    }
    if (empty($_POST['course_short_name'])) {
        $valid = false;
        $message .= "Course short name cannot be empty.<br>";
    }
    if (empty($_POST['course_price'])) {
        $valid = false;
        $message .= "Course price cannot be empty.<br>";
    }
    if (empty($_POST['course_teacher'])) {
        $valid = false;
        $message .= "Course teacher cannot be empty.<br>";
    }
    if (empty($_POST['course_duration'])) {
        $valid = false;
        $message .= "Course duration cannot be empty.<br>";
    }
    if (empty($_POST['session'])) {
        $valid = false;
        $message .= "Session cannot be empty.<br>";
    }
    if (empty($_POST['description'])) {
        $valid = false;
        $message .= "Description cannot be empty.<br>";
    }
    if (empty($_POST['short_description'])) {
        $valid = false;
        $message .= "Short description cannot be empty.<br>";
    }
    if (empty($_POST['students'])) {
        $valid = false;
        $message .= "Students cannot be empty.<br>";
    }
    if (empty($_POST['certifications'])) {
        $valid = false;
        $message .= "Certifications cannot be empty.<br>";
    }
    if (empty($_POST['outcomes'])) {
        $valid = false;
        $message .= "Outcomes cannot be empty.<br>";
    }
    if (empty($_POST['curriculum'])) {
        $valid = false;
        $message .= "Curriculum cannot be empty.<br>";
    }
    if (empty($_POST['level'])) {
        $valid = false;
        $message .= "Level cannot be empty.<br>";
    }
    if (empty($_POST['course_language'])) {
        $valid = false;
        $message .= "Course language cannot be empty.<br>";
    }
    if (empty($_POST['course_start_date'])) {
        $valid = false;
        $message .= "Course start date cannot be empty.<br>";
    }
    if (empty($_POST['course_price_per'])) {
        $valid = false;
        $message .= "Course price per cannot be empty.<br>";
    }
    if (!isset($_POST['quizzes'])) {
        $_POST['quizzes'] = 0;
    }
    if (!isset($_POST['assessments'])) {
        $_POST['assessments'] = 0;
    }

    if ($valid) {
        try {

            $statement = $pdo->prepare("
                INSERT INTO course 
                (cat_id, name, short_name, price, teacher_id, duration, sessions, description, short_description, students, certification, outcomes, curriculum, level, language, start, price_per, quizzes, assessments, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $statement->execute([
                $_POST['category'],
                $_POST['course_name'],
                $_POST['course_short_name'],
                $_POST['course_price'],
                $_POST['course_teacher'],
                $_POST['course_duration'],
                $_POST['session'],
                $_POST['description'],
                $_POST['short_description'],
                $_POST['students'],
                $_POST['certifications'],
                $_POST['outcomes'],
                $_POST['curriculum'],
                $_POST['level'],
                $_POST['course_language'],
                $_POST['course_start_date'],
                $_POST['course_price_per'],
                $_POST['quizzes'],
                $_POST['assessments'],
                'Active'
            ]);

            $message = 'Course added successfully.';
        } catch (Exception $e) {
            $message = 'Error: ' . $e->getMessage();
        }
    }
}

ob_end_flush();
?>

<!-- Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Add Course</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li>Add Course</li>
            </ul>
            <div><?php echo $message; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="wc-title">
                        <h4>Add Course</h4>
                    </div>
                    <div class="widget-inner">
                        <form class="edit-profile m-b30" method="post" action="">
                            <div class="row">
                                <div class="form-group col-12">
                                    <h3 class="required">Category</h3>
                                    <div class="col-sm-4">
                                        <select name="category" class="form-control select2" required>
                                            <option value="">Select Category</option>
                                            <?php
                                            try {
                                                $statement = $pdo->prepare("SELECT * FROM category ORDER BY name ASC");
                                                $statement->execute();
                                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($result as $row) {
                                                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                                                }
                                            } catch (Exception $e) {
                                                echo '<option value="">Error loading categories</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="ml-auto">
                                        <h3>1. Basic Info</h3>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label required">Course Name</label>
                                    <div>
                                        <input class="form-control" type="text" name="course_name" placeholder="Web Development Crash Course" required>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label required">Course Short Name</label>
                                    <div>
                                        <input class="form-control" type="text" name="course_short_name" placeholder="web_dev" required>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label required">Course Price</label>
                                    <div>
                                        <input class="form-control" type="number" name="course_price" placeholder="Rs. 1000" required>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label required">Course Instructor</label>
                                    <div>
                                        <input class="form-control" type="text" name="course_teacher" required>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label required">Course Duration</label>
                                    <div>
                                        <input class="form-control" type="number" name="course_duration" required>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label required">Course Sessions</label>
                                    <div>
                                        <input type="number" name="session" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label class="col-form-label required">Course Max Students</label>
                                    <div>
                                        <input type="number" name="students" class="form-control" required>
                                    </div>
                                </div>
                                <div class="seperator"></div>
                                <div class="col-12 m-t20">
                                    <div class="ml-auto m-b5">
                                        <h3>2. Description</h3>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label required">Course Description</label>
                                    <div>
                                        <textarea class="form-control" name="description" required></textarea>
                                    </div><br>
                                    <label class="col-form-label required">Course Short Description</label>
                                    <div>
                                        <textarea class="form-control" name="short_description" maxlength="255" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12 m-t20">
                                    <div class="ml-auto m-b5">
                                        <h3>3. Other Information</h3>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label required">Certifications</label>
                                    <div>
                                        <input type="text" name="certifications" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label required">Outcomes</label>
                                    <div>
                                        <input type="text" name="outcomes" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label required">Curriculum</label>
                                    <div>
                                        <input type="text" name="curriculum" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label required">Level</label>
                                    <div>
                                        <!-- <input type="text" name="level" class="form-control" required> -->
										<select name="level">
											<option value="Beginner">Beginner</option>
											<option value="Intermediate">Intermediate</option>
											<option value="Advanced">Advanced</option>
										</select>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label required">Course Language</label>
                                    <div>
                                        <!-- <input type="text" name="course_language" class="form-control" required> -->
										<select name="course_language">
											<option value="Sinhala">Sinhala</option>
											<option value="English">English</option>
										</select>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label required">Course Start Date</label>
                                    <div>
                                        <input type="date" name="course_start_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label required">Course Price Per</label>
                                    <div>
                                        <!-- <input type="text" name="course_price_per" class="form-control" required> -->
										<select name="course_price_per">
											<option value="Monthly">Monthly</option>
											<option value="Yearly">Yearly</option>
											<option value="Per Course">Per Course</option>
											<option value="Per Session">Per Session</option>
										</select>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">Quizzes</label>
                                    <div>
                                        <!-- <input type="number" name="quizzes" class="form-control"> -->
										<select name="quizzes">
											<option value="1">Yes</option>
											<option value="0">No</option>
										</select>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="col-form-label">Assessments</label>
                                    <div>
                                        <!-- <input type="number" name="assessments" class="form-control"> -->
										<select name="assessments">
											<option value="1">Yes</option>
											<option value="0">No</option>
										</select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary" name="course_add">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Main container end -->

<?php include('footer.php'); ?>
