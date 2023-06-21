<?php
if (!isset($_SESSION)) {
    session_start();
}
include('./admininclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];

    if (isset($_POST['submit'])) {
        $questionText = htmlentities(mysqli_real_escape_string($conn, $_POST['question']));
        $option1 = htmlentities(mysqli_real_escape_string($conn, $_POST['choice1']));
        $option2 = htmlentities(mysqli_real_escape_string($conn, $_POST['choice2']));
        $option3 = htmlentities(mysqli_real_escape_string($conn, $_POST['choice3']));
        $option4 = htmlentities(mysqli_real_escape_string($conn, $_POST['choice4']));
        $correctAnswer = mysqli_real_escape_string($conn, $_POST['answer']);
        $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);

        $checkqsn = "SELECT * FROM quiz_questions";
        $runcheck = mysqli_query($conn, $checkqsn) or die(mysqli_error($conn));
        $qno = mysqli_num_rows($runcheck) + 1;

        $sql = "INSERT INTO quiz_questions (qno, question_text, option1, option2, option3, option4, correct_answer, course_id) VALUES ($qno, '$questionText', '$option1', '$option2', '$option3', '$option4', '$correctAnswer', '$course_id')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Question successfully added');</script>";
        } else {
            echo "<script>alert('Error, try again!');</script>";
        }
    }
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>

<div class="col-sm-6 mt-5 mx-auto jumbotron">
                <h2>Add a question...</h2>
                <form method="post" action="">

                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <input type="text" name="question" id="question" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="choice1" class="form-label">Choice #1</label>
                        <input type="text" name="choice1" id="choice1" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="choice2" class="form-label">Choice #2</label>
                        <input type="text" name="choice2" id="choice2" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="choice3" class="form-label">Choice #3</label>
                        <input type="text" name="choice3" id="choice3" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="choice4" class="form-label">Choice #4</label>
                        <input type="text" name="choice4" id="choice4" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">Correct answer</label>
                        <select name="answer" id="answer" class="form-select">
                            <option value="a">Choice #1</option>
                            <option value="b">Choice #2</option>
                            <option value="c">Choice #3</option>
                            <option value="d">Choice #4</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Select Course</label>
						<select name="course_id" id="course_id" class="form-select" required>
								<?php
								$sql = "SELECT * FROM course";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										echo '<option value="' . $row['course_id'] . '">' . $row['course_name'] . '</option>';
									}
								} else {
									echo '<option value="">No courses found</option>';
								}
								?>
							</select>

                    </div>
                    <div class="mb-3">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>

<?php
include('./admininclude/footer.php');
?>
