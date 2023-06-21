<?php
if (!isset($_SESSION)) {
    session_start();
}
include('../dbConnection.php');
if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script>location.href='../index.php';</script>";
}

$resources = []; // Array to store lesson resources

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $sql = "SELECT * FROM lesson WHERE course_id ='$course_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $lesson = [
                'video' => $row['lesson_link'],
                'resource' => $row['file_upload']
            ];
            $resources[] = $lesson;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Watch Course</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/stustyle.css">
    <!-- Custom course CSS -->
    <link rel="stylesheet" href="../css/course.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <!-- A grey horizontal navbar that becomes vertical on small screens -->
    <nav class="navbar navbar-expand-sm bg-light">

        <div class="container-fluid">
            <!-- Links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <h3>Welcome to NuTemaru</h3>
                </li>

                <li class="nav-item">
                    <?php if (isset($course_id)) { ?>
                        <a class="btn btn-danger" href="./myCourse.php">My Courses</a>
                    <?php } ?>
                </li>
            </ul>
        </div>

    </nav>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-lg-10 mx-auto">
                <div id="videoarea"></div>
                <div id="resourceContainer" class="hidden"></div>
                <button id="completedBtn" class="btn btn-success hidden">Completed</button>
                <button id="backBtn" class="btn btn-primary hidden">&larr; Back</button>
            </div>
        </div>
    </div>

    <!-- Jquery and Boostrap JavaScript -->
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <!-- Font Awesome JS -->
    <script type="text/javascript" src="../js/all.min.js"></script>

    <script>
        $(document).ready(function () {
            var lessons = <?php echo json_encode($resources); ?>; // Retrieve the lesson resources from PHP as JSON

            var lessonLinks = $('#playlist a');
            var videoPlayer = $('#videoarea');
            var resourceContainer = $('#resourceContainer');
            var completedBtn = $('#completedBtn');
            var backBtn = $('#backBtn');

            function playVideo(videoUrl) {
                var videoPlayerHtml = '<video id="videoarea" src="' + videoUrl + '" class="mt-5 w-100" controls></video>';
                videoPlayer.html(videoPlayerHtml);
            }

            function displayResource(resourcePath) {
                if (resourcePath && resourcePath.trim() !== '') {
                    var resourceHtml = '<div class="mt-3 mb-3"><a href="' + resourcePath + '">Resource: Download</a></div>';
                    resourceContainer.html(resourceHtml);
                    resourceContainer.show();
                } else {
                    resourceContainer.hide();
                }
            }


            var currentVideoIndex = 0;

            function loadVideo(index) {
                var videoUrl = lessons[index].video;
                var resourcePath = lessons[index].resource;

                playVideo(videoUrl);
                displayResource(resourcePath);
            }

            // Make the video player, resource container, completed button, and back button visible
            lessonLinks.removeClass('hidden');
            videoPlayer.show();
            resourceContainer.show();
            completedBtn.show();
            backBtn.show();

            // Load the first video when the page is loaded
            loadVideo(currentVideoIndex);

            $('#completedBtn').on('click', function () {
                // Increment the video index
                currentVideoIndex++;

                if (currentVideoIndex < lessons.length) {
                    // Load the next video
                    loadVideo(currentVideoIndex);
                } else {
                    // Redirect to question.php with course_id parameter
                    var course_id = "<?php echo $course_id; ?>"; // Retrieve the course_id from PHP
                    window.location.href = "question.php?course_id=" + course_id;
                }
            });



            $('#backBtn').on('click', function () {
                // Decrement the video index
                currentVideoIndex--;

                // Check if there is a previous video
                if (currentVideoIndex >= 0) {
                    // Load the previous video
                    loadVideo(currentVideoIndex);
                } else {
                    // Handle the case when there are no previous videos (e.g., disable the back button)
                    alert('This is the first video.');
                }
            });

            lessonLinks.on('click', function () {
                // Update the current video index when a lesson link is clicked
                currentVideoIndex = lessonLinks.index(this);
                loadVideo(currentVideoIndex);
            });
        });
    </script>
</body>

</html>
