<?php

include ('header.php');
include ('component/nav.php');
include ('component/slide-navbar.php');

$total_score = 0;
$quiz_questions = [];
$already_submitted = false;
$student_id = 1; // Example student ID, should be dynamic based on logged-in user

// Check if the user has already submitted the quiz
$submission_check = $pdo->prepare('SELECT * FROM submissions WHERE student_id = ?');
$submission_check->execute([$student_id]);
$submission_exists = $submission_check->fetch();

if ($submission_exists) {
	$already_submitted = true;
} else if (isset($_POST['submit'])) {
	$statement = $pdo->prepare('SELECT * FROM quiz');
	$statement->execute();
	$quiz_questions = $statement->fetchAll();

	$total_score = calculate_score($quiz_questions);

	// Insert submission into database
	$submission = $pdo->prepare('INSERT INTO submissions (assessment_id, student_id, submitted_at, score, feedback) VALUES (1, ?, NOW(), ?, ?)');
	$feedback = generate_feedback($total_score);
	$submission->execute([$student_id, $total_score, $feedback]);
} else {
	$statement = $pdo->prepare('SELECT * FROM quiz');
	$statement->execute();
	$quiz_questions = $statement->fetchAll();
}

?>

<!--Main container start -->
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">My Quiz</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="index.php"><i class="fa fa-home"></i>Home</a></li>
				<li>My Quiz</li>
			</ul>
		</div>
		<div>
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h4>Quizzes</h4>
						</div>
						<?php if ($already_submitted): ?>
							<p>You have already submitted the quiz.</p>
						<?php else: ?>
							<form method="post" class="contact-bx col-lg-12">
								<?php foreach ($quiz_questions as $question): ?>
									<div class="form-group">
										<!-- Multiple Choice -->
										<label><?php echo htmlspecialchars($question['quiz_text']); ?></label><br>
										<?php if ($question['quiz_type'] == 'Multiple Choice'): ?>
											<?php $options = explode(',', $question['options']); ?>
											<?php foreach ($options as $option): ?>
												<input type="radio" name="answer<?php echo $question['quiz_id']; ?>"
													value="<?php echo htmlspecialchars(trim($option)); ?>">
												<?php echo htmlspecialchars(trim($option)); ?><br>
											<?php endforeach; ?>

											<!-- True/False -->
										<?php elseif ($question['quiz_type'] == 'True/False'): ?>
											<input type="radio" name="answer<?php echo $question['quiz_id']; ?>" value="True">
											True<br>
											<input type="radio" name="answer<?php echo $question['quiz_id']; ?>" value="False">
											False<br>

											<!-- Short Answer -->
										<?php elseif ($question['quiz_type'] == 'Short Answer'): ?>
											<input type="text" name="answer<?php echo $question['quiz_id']; ?>"><br>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
								<button type="submit" name="submit" class="btn btn-primary">Submit</button>
							</form>
							<?php if (isset($_POST['submit'])): ?>
								<h4>Your total score: <?php echo $total_score; ?></h4>
								<div class="results">
									<?php display_results($quiz_questions); ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h4>Submissions</h4>
						</div>
						<?php
						// Fetch all submissions for display
						$submission_statement = $pdo->prepare('
    SELECT *, assessments.title , student.name
    FROM submissions
    INNER JOIN assessments ON submissions.assessment_id = assessments.assessment_id
    INNER JOIN student ON submissions.student_id = student.id
    WHERE student_id = :student_id
');
						$submission_statement->bindParam(':student_id', $student_id);
						$submission_statement->execute();
						$submissions = $submission_statement->fetchAll(PDO::FETCH_ASSOC);
						?>

						<div class="table-responsive">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Assessment Title</th>
										<th>Student ID</th>
										<th>Submitted At</th>
										<th>Score</th>
										<th>Feedback</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($submissions as $submission): ?>
										<tr>
											<td><?php echo htmlspecialchars($submission['title']); ?></td>
											<td><?php echo htmlspecialchars($submission['name']); ?></td>
											<td><?php echo htmlspecialchars($submission['submitted_at']); ?></td>
											<td><?php echo htmlspecialchars($submission['score']); ?></td>
											<td><?php echo htmlspecialchars($submission['feedback']); ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>
</main>
<div class="ttr-overlay"></div>
<?php
include ('footer.php');

function calculate_score($quiz_questions)
{
	$total_score = 0;
	foreach ($quiz_questions as $question) {
		if (isset($_POST['answer' . $question['quiz_id']])) {
			$user_answer = $_POST['answer' . $question['quiz_id']];
			if ($question['quiz_type'] == 'Multiple Choice' || $question['quiz_type'] == 'True/False') {
				if ($user_answer == $question['correct_answer']) {
					$total_score += $question['score'];
				}
			} elseif ($question['quiz_type'] == 'Short Answer') {
				if (strtolower(trim($user_answer)) == strtolower(trim($question['correct_answer']))) {
					$total_score += $question['score'];
				}
			}
		}
	}
	return $total_score;
}

function display_results($quiz_questions)
{
	echo '<div class="row">';
	foreach ($quiz_questions as $question) {
		if (isset($_POST['answer' . $question['quiz_id']])) {
			$user_answer = $_POST['answer' . $question['quiz_id']];
			$is_correct = false;

			if ($question['quiz_type'] == 'Multiple Choice' || $question['quiz_type'] == 'True/False') {
				$is_correct = ($user_answer == $question['correct_answer']);
			} elseif ($question['quiz_type'] == 'Short Answer') {
				$is_correct = (strtolower(trim($user_answer)) == strtolower(trim($question['correct_answer'])));
			}

			$answer_class = $is_correct ? 'text-success' : 'text-danger';

			echo '<div class="col-lg-12">';
			echo '<p>Question: ' . htmlspecialchars($question['quiz_text']) . '</p>';
			echo '<p>Your Answer: <span class="' . $answer_class . '">' . htmlspecialchars($user_answer) . '</span></p>';
			echo '<p>Correct Answer: ' . htmlspecialchars($question['correct_answer']) . '</p>';
			echo '</div>';
		}
	}
	echo '</div>';
}

function generate_feedback($total_score)
{
	// Generate feedback based on score, this is just an example
	if ($total_score > 90) {
		return "Excellent work!";
	} elseif ($total_score > 75) {
		return "Good job!";
	} else {
		return "You can do better.";
	}
}
?>