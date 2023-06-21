<?php
if (!isset($_SESSION)) {
    session_start();
}
include './stuInclude/header.php';
include_once '../dbconnection.php';
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $_SESSION['course_id'] = $course_id;
} else {
    exit;
}
if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];

    
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
</head>

<body style="background: black">
    <main>
        <div class="container" >
            <h2 style="color:white;">Quiz</h2>
            <form action="" method="post">
                <div class="row">
                    <?php
                    $totalQuestions = 0;
                    $sql = "SELECT * FROM quiz_questions WHERE course_id = $course_id";
                    
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $questionNumber = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $questionText = $row['question_text'];
                            $option1 = $row['option1'];
                            $option2 = $row['option2'];
                            $option3 = $row['option3'];
                            $option4 = $row['option4'];
                            $correctAnswer = $row['correct_answer'];
                            $totalQuestions++;
                    ?>
                      
                      <div >
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Question <?php echo $questionNumber; ?></h5>
                                        <p class="card-text"><?php echo $questionText; ?></p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer<?php echo $questionNumber; ?>" id="option1<?php echo $questionNumber; ?>" value="a">
                                            <label class="form-check-label" for="option1<?php echo $questionNumber; ?>">
                                                <?php echo $option1; ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer<?php echo $questionNumber; ?>" id="option2<?php echo $questionNumber; ?>" value="b">
                                            <label class="form-check-label" for="option2<?php echo $questionNumber; ?>">
                                                <?php echo $option2; ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer<?php echo $questionNumber; ?>" id="option3<?php echo $questionNumber; ?>" value="c">
                                            <label class="form-check-label" for="option3<?php echo $questionNumber; ?>">
                                                <?php echo $option3; ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer<?php echo $questionNumber; ?>" id="option4<?php echo $questionNumber; ?>" value="d">
                                            <label class="form-check-label" for="option4<?php echo $questionNumber; ?>">
                                                <?php echo $option4; ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                            $questionNumber++;
                        }
                    }
                    ?>
                </div>
                <div class=" mt-4">
                    <button class="btn btn-primary" type="button" id="submitQuiz">Submit</button>
                </div>
            </form>
        </div>

        <!-- Result Modal -->
        <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resultModalLabel">Quiz Result</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span id="quizResultMessage"></span>
                        <button class="btn btn-primary mt-3" id="downloadCertificateButton" style="display: none;" onclick="generateCertificate()">Download Certificate</button>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Function to handle quiz submission
        document.getElementById('submitQuiz').addEventListener('click', function() {
            var correctCount = 0;
            var totalQuestions = <?php echo $totalQuestions; ?>;

            // Loop through each question and check the user's answer
            for (var i = 1; i <= totalQuestions; i++) {
                var selectedAnswer = document.querySelector('input[name="answer' + i + '"]:checked');
                if (selectedAnswer && selectedAnswer.value === '<?php echo $correctAnswer; ?>') {
                    correctCount++;
                }
            }

            // Update the quiz result message
            var quizResultMessage = '';
            if (correctCount < totalQuestions) {
                quizResultMessage = 'You have answered ' + correctCount + ' out of ' + totalQuestions + ' questions correctly. Please retake the quiz to improve your score.';
            } else {
                quizResultMessage = 'Congratulations! You have answered all ' + totalQuestions + ' questions correctly. You can now download your certificate.';
                // Show the download button
                document.getElementById('downloadCertificateButton').style.display = 'block';
            }

            // Update the modal body content with the quiz result message
            document.getElementById('quizResultMessage').innerHTML = quizResultMessage;

            // Show the result modal
            var modal = new bootstrap.Modal(document.getElementById('resultModal'));
            modal.show();
        });


function generateCertificate() {
  // Retrieve the course_id from the URL query parameters
  var urlParams = new URLSearchParams(window.location.search);
  var course_id = urlParams.get('course_id');

  if (!course_id) {
    console.log('course_id parameter is missing in the URL.');
    return;
  }

  // Construct the URL with the course_id parameter
  var url = "generate_certificate.php?course_id=" + course_id;

  // Make the AJAX request using fetch
  fetch(url)
    .then(function(response) {
      if (response.ok) {
        return response.blob();
      }
      throw new Error('Network response was not OK.');
    })
    .then(function(blob) {
      // Create a download link for the generated certificate
      var link = document.createElement('a');
      link.href = URL.createObjectURL(blob);
      link.download = 'generated_certificate.pdf';

      // Programmatically trigger a click event on the link to start the download
      link.click();

      // Clean up the URL object
      URL.revokeObjectURL(link.href);
    })
    .catch(function(error) {
      console.log('Error:', error);
    });
}


    </script>
</body>

</html>

<?php include './stuInclude/footer.php'; ?>
