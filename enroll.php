<?php
// Include necessary files
include_once ('header.php');
include ('pages/nav.php');

// Initialize message variable
$message = '';

// Check if course_id is provided in the URL query string
if (isset($_GET['course_id'])) {
    $requested_course_id = $_GET['course_id'];

    try {
        // Set PDO to throw exceptions on error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch course details for the requested course_id
        $statement = $pdo->prepare('
            SELECT 
                course.id AS course_id, course.name AS course_name, course.price AS course_price, 
                course.image AS course_image, course.language AS course_language, 
                batch.current_student AS batch_current_student, batch.id AS batch_id, 
                batch.intake_student AS intake_student
            FROM course
            LEFT JOIN batch ON course.id = batch.course_id
            WHERE course.id = :requested_course_id
        ');
        $statement->bindValue(':requested_course_id', $requested_course_id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $course_id = $result['course_id'];
            $course_name = $result['course_name'];
            $course_price = $result['course_price'];
            $course_language = $result['course_language'];
            $batch_id = $result['batch_id'];
            $batch_current_student = $result['batch_current_student'];
            $batch_intake_student = $result['intake_student'];
        } else {
            // Handle case where course_id is not found
            $message = 'Course not found.';
        }

    } catch (PDOException $e) {
        // Handle PDO exceptions
        echo 'Error: ' . $e->getMessage();
    }
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $valid = true;

        // Validate and sanitize inputs
        $email = isset($_POST['student_email']) ? strip_tags($_POST['student_email']) : '';
        $password = isset($_POST['student_password']) ? strip_tags($_POST['student_password']) : '';
        $language = isset($_POST['language']) ? $_POST['language'] : '';

        // Check if required fields are empty
        if (empty($email) || empty($password) || empty($language)) {
            $message = 'Email, Password, and Language cannot be empty<br>';
            $valid = false;
        }

        // Proceed if inputs are valid
        if ($valid) {
            try {
                // Check if email exists and password matches
                $statement = $pdo->prepare("SELECT * FROM student WHERE email=? AND status='Active'");
                $statement->execute(array($email));
                $total = $statement->rowCount();
                $result = $statement->fetch(PDO::FETCH_ASSOC);

                if ($total == 0) {
                    $message .= 'Email Address does not match or Login<br>';
                    echo '<script>window.location="login.php";</script>';
                } else {
                    $row_password = $result['password'];
                    $student_id = $result['id'];

                    // Verify password
                    if ($row_password != md5($password)) {
                        $message .= 'Password does not match<br>';
                    } else {
                        // Check if batch can accept more students
                        if ($batch_current_student < $batch_intake_student) {
                            try {
                                // Check if the student is already enrolled in the course
                                $check_statement = $pdo->prepare("SELECT * FROM student_course WHERE student_id = ? AND course_id = ?");
                                $check_statement->execute([$student_id, $course_id]);
                                $existing_enrollment = $check_statement->fetch(PDO::FETCH_ASSOC);

                                if ($existing_enrollment) {
                                    $message = 'You are already enrolled in this course.';
                                } else {
                                    // Insert enrollment record into student_course table
                                    $insert_statement = $pdo->prepare("INSERT INTO student_course (student_id, course_id, batch_id) VALUES (?, ?, ?)");
                                    $insert_statement->execute([$student_id, $course_id, $batch_id]);

                                    // Update batch current_student count
                                    $update_statement = $pdo->prepare("UPDATE batch SET current_student = current_student + 1 WHERE id = ?");
                                    $update_statement->execute([$batch_id]);

                                    $message = 'Successfully registered!';
                                }
                            } catch (PDOException $e) {
                                // Handle PDO exceptions
                                echo 'Error: ' . $e->getMessage();
                            }
                        } else {
                            $message = 'Student intake is over! Please contact tutor for more information.';
                        }

                    }
                }
            } catch (PDOException $e) {
                // Handle PDO exceptions
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Enroll for Course</title>
    <!-- Add your CSS and other meta tags here -->
</head>

<body>
    <div>
        <div class="page-banner ovbl-dark" style="background-image:url(assets/images/banner/banner3.jpg);">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Enroll for Course</h1>
                </div>
            </div>
        </div>
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li>Course Name: —</li>
                    <li><a href="#"><?php echo htmlspecialchars($course_name); ?></a></li>
                </ul>
            </div>
        </div>
        <div class="course-details">
            <div class="row">
                <div class="col-md-6 col-lg-5 col-sm-6 m-b30 m-l100">
                    <div class="cours-box">
                        <div class="action-box">
                            <img src="assets/images/courses/pic1.jpg" alt="" style="border-radius: 5px 25px 25px 5px;">
                        </div>
                        <div class="info-bx ml-2">
                            <h4><?php echo htmlspecialchars($course_name); ?></h4>
                        </div>
                        <div class="price ml-2">
                            <h5><?php echo $currency . htmlspecialchars($course_price); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 col-sm-6 m-b30">
                    <form class="form-box" method="post">
                        <input type="email" name="student_email" placeholder="Email" required value="<?php
                        if (isset($_COOKIE['user_mail'])) {
                            echo $_COOKIE['user_mail'];
                        }
                        ?>"><br /><br />
                        <input type="password" name="student_password" placeholder="Password" required><br /><br />
                        <select name="language" required>
                            <option value="eng" <?php if ($course_language == 'Sinhala')
                                echo 'disabled'; ?>>English
                            </option>
                            <option value="sin" <?php if ($course_language == 'English')
                                echo 'disabled'; ?>>Sinhala
                            </option>
                        </select><br /><br />
                        <button class="course-buy-now text-center btn radius-xl text-uppercase"
                            name="submit">Submit</button>
                    </form><br /><br /><br />
                    <div class="message text-center">
                        <h4 id="messageBox"><?php echo $message; ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const messageBox = document.getElementById('messageBox');
        setTimeout(() => {
            messageBox.innerHTML = '';
        }, 4000);
    </script>
    <?php include ('footer.php'); ?>