<?php
$student_id = 1; // Make sure this ID exists in the database

$message = '';

if (isset($_POST['submit'])) {
    $current_password = $_POST['current_password'];
    $new_password_1 = $_POST['new_password_1'];
    $new_password_2 = $_POST['new_password_2'];

    // Fetch the current password for the student
    $statement = $pdo->prepare("SELECT password FROM student WHERE id = :student_id");
    $statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $password = $row['password'];

        // Verify the current password using md5
        if ($password !== md5($current_password)) {
            $message = 'Current password does not match.';
        } else {
            // Check for new password mismatch
            if ($new_password_1 !== $new_password_2) {
                $message = "New password mismatch!";
            } else {
                // Hash the new password using md5
                $new_password = md5($new_password_1);

                // Update the password in the database
                $update_statement = $pdo->prepare("UPDATE student SET password = :password WHERE id = :student_id");
                $update_statement->bindParam(':student_id', $student_id, PDO::PARAM_INT);
                $update_statement->bindParam(':password', $new_password);
                $success = $update_statement->execute();

                if ($success) {
                    $message = 'Password changed successfully!';
                    // echo '<script>window.location="/course";</script>';
                    exit();
                } else {
                    $message = 'Unable to change password. Something went wrong!';
                }
            }
        }
    } else {
        $message = 'No user found.';
    }
}

// Display message in an alert box
if ($message) {
    echo "<script>alert('$message');</script>";
}
?>

<div class="tab-pane" id="change-password">
    <div class="profile-head">
        <h3>Change Password</h3>
    </div>
    <form class="edit-profile" method="post">
        <div class="">
            <div class="form-group row">
                <div class="col-12 col-sm-8 col-md-8 col-lg-9 ml-auto">
                    <h3>Password</h3>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-12 col-sm-4 col-md-4 col-lg-3 col-form-label">Current Password</label>
                <div class="col-12 col-sm-8 col-md-8 col-lg-7">
                    <input class="form-control" type="password" name="current_password" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-12 col-sm-4 col-md-4 col-lg-3 col-form-label">New Password</label>
                <div class="col-12 col-sm-8 col-md-8 col-lg-7">
                    <input class="form-control" type="password" name="new_password_1" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-12 col-sm-4 col-md-4 col-lg-3 col-form-label">Re-type New Password</label>
                <div class="col-12 col-sm-8 col-md-8 col-lg-7">
                    <input class="form-control" type="password" name="new_password_2" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-4 col-md-4 col-lg-3"></div>
            <div class="col-12 col-sm-8 col-md-8 col-lg-7">
                <button type="submit" class="btn">Save changes</button>
                <button type="reset" class="btn-secondary">Cancel</button>
            </div>
        </div>
    </form>
</div>
