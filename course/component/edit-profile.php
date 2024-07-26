<?php
$message = '';
$student_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

if (isset($_POST['submit'])) {
    // Collect form data with checks
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $number = isset($_POST['number']) ? $_POST['number'] : '';
    $avatar = isset($_POST['avatar']) ? $_POST['avatar'] : '';
    $birth_day = isset($_POST['birth_day']) ? $_POST['birth_day'] : '';
    $linkedin = isset($_POST['linkedin']) ? $_POST['linkedin'] : '';
    $facebook = isset($_POST['facebook']) ? $_POST['facebook'] : '';
    $x = isset($_POST['x']) ? $_POST['x'] : '';
    $github = isset($_POST['github']) ? $_POST['github'] : '';

    // Prepare SQL statement with positional parameters
    $statement = $pdo->prepare("UPDATE student 
        SET name=?, number=?, avatar=?, birth_day=?, linkedin=?, facebook=?, x=?, github=? 
        WHERE id=?");

    // Bind the parameters
    $statement->bindValue(1, $name);
    $statement->bindValue(2, $number);
    $statement->bindValue(3, $avatar);
    $statement->bindValue(4, $birth_day);
    $statement->bindValue(5, $linkedin);
    $statement->bindValue(6, $facebook);
    $statement->bindValue(7, $x);
    $statement->bindValue(8, $github);
    $statement->bindValue(9, $student_id, PDO::PARAM_INT);
    
    // Execute and check if the update was successful
    if ($statement->execute()) {
        $message = 'Successfully Updated';
        echo '<script>window.location="/course";</script>';
        exit(); // Stop further script execution
    } else {
        $message = 'Cannot update. Please try again.';
    }
}

// Fetch current student data
if ($student_id) {
    $statement = $pdo->prepare("SELECT * FROM student WHERE id = :id");
    $statement->bindParam(':id', $student_id, PDO::PARAM_INT);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if a row was found
    if ($row) {
        $name = $row['name'];
        $number = $row['number'];
        $avatar = $row['avatar'];
        $birth_day = $row['birth_day'];
        $linkedin = $row['linkedin'];
        $facebook = $row['facebook'];
        $x = $row['x'];
        $github = $row['github'];
    } else {
        // Handle case when no student is found
        $message = 'Student not found.';
    }
} else {
    $message = 'User ID is not set.';
}
?>

<div class="tab-pane" id="edit-profile">
    <div class="profile-head">
        <h3>Edit Profile</h3>
    </div>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form class="edit-profile" method="post">
        <div class="">
            <div class="form-group row">
                <div class="col-12 col-sm-9 col-md-9 col-lg-10 ml-auto">
                    <h3>1. Personal Details</h3>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Full Name</label>
                <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                    <input class="form-control" type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Phone No.</label>
                <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                    <input class="form-control" type="number" name="number" minlength="9" maxlength="10" value="<?php echo htmlspecialchars($number); ?>" required>
                    <span class="help">This must be a WhatsApp number because we contact you with this phone number.</span>
                </div>
            </div>

            <div class="separator"></div>

            <div class="form-group row">
                <div class="col-12 col-sm-9 col-md-9 col-lg-10 ml-auto">
                    <h3>2. Other Information</h3>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Avatar</label>
                <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                    <input class="form-control" type="url" name="avatar" value="<?php echo htmlspecialchars($avatar); ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Birth Day</label>
                <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                    <input class="form-control" type="date" name="birth_day" value="<?php echo htmlspecialchars($birth_day); ?>" required>
                </div>
            </div>

            <div class="m-form__separator m-form__separator--dashed m-form__separator--space-2x"></div>

            <div class="form-group row">
                <div class="col-12 col-sm-9 col-md-9 col-lg-10 ml-auto">
                    <h3 class="m-form__section">3. Social Links</h3>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">LinkedIn</label>
                <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                    <input class="form-control" type="url" name="linkedin" value="<?php echo htmlspecialchars($linkedin); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">Facebook</label>
                <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                    <input class="form-control" type="url" name="facebook" value="<?php echo htmlspecialchars($facebook); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">X</label>
                <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                    <input class="form-control" type="url" name="x" value="<?php echo htmlspecialchars($x); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-12 col-sm-3 col-md-3 col-lg-2 col-form-label">GitHub</label>
                <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                    <input class="form-control" type="url" name="github" value="<?php echo htmlspecialchars($github); ?>">
                </div>
            </div>
        </div>
        <div class="">
            <div class="">
                <div class="row">
                    <div class="col-12 col-sm-3 col-md-3 col-lg-2"></div>
                    <div class="col-12 col-sm-9 col-md-9 col-lg-7">
                        <button type="submit" class="btn" name="submit">Save changes</button>
                        <button type="reset" class="btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
