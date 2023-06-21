<?php
if (!isset($_SESSION)) {
    session_start();
}
include './stuInclude/header.php';
include_once '../dbconnection.php';

if (isset($_SESSION['is_login'])) {
    $stuLogEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

$deleteMessageDisplayed = false; // Flag to track if delete message is already displayed

// Check if the delete button is clicked
if (isset($_GET['delete_course_id'])) {
    $deleteCourseId = $_GET['delete_course_id'];

    // Delete the course from the courseorder table
    $deleteSql = "DELETE FROM courseorder WHERE stu_email = '$stuLogEmail' AND course_id = '$deleteCourseId'";
    $deleteResult = $conn->query($deleteSql);

    if ($deleteResult) {
        // Course deleted successfully, redirect to the same page
        $deleteMessageDisplayed = true; // Set flag to true
        echo "<script> location.href=''; </script>";
    } else {
        // Error deleting the course
        echo "<script> alert('Failed to delete the course.'); </script>";
    }
}

// Check if the watch course form is submitted
if (isset($_POST['course_id'])) {
    $courseId = $_POST['course_id'];
    header("Location: watchcourse.php?course_id=$courseId");
    exit();
}
?>

<div class="container mt-50">
    <div class="row">
        <div class="jumbotron">
            <h4 class="text-center">All Course</h4>

            <?php
            if (isset($stuLogEmail)) {
                $sql = "SELECT co.order_id, c.course_id, c.course_name, c.course_duration, c.course_desc, c.course_img, c.course_author, c.course_original_price, c.course_price FROM courseorder AS co JOIN course AS c ON c.course_id = co.course_id WHERE co.stu_email = '$stuLogEmail'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="bg-light mb-3">
                            <h5 class="card-header"><?php echo $row['course_name']; ?></h5>
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?php echo $row['course_img']; ?>" class="card-img-top mt-4" alt="pic">
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="card-body">
                                        <p class="card-title"><?php echo $row['course_desc']; ?></p>

                                        <small class="card-text">Duration: <?php echo $row['course_duration']; ?></small><br /><br /><br /><br /><br />
                                        <small class="card-text">Instructor: <?php echo $row['course_author']; ?></small><br/><br /><br /><br /><br />
                                        <p class="card-text d-inline">Price: <small><del>Birr <?php echo $row['course_original_price'] ?></del></small>
                                            <span class="font-weight-bolder">Birr <?php echo $row['course_price'] ?></span>
                                        </p>

                                        <button class="btn btn-primary mt-3" onclick="watchCourse(<?php echo $row['course_id']; ?>);">Watch Course</button>
                                        <button class="btn btn-danger mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['course_id']; ?>">Delete Course</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Course Confirmation Modal -->
                        <div class="modal fade" id="deleteModal<?php echo $row['course_id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete the course "<?php echo $row['course_name']; ?>"?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="?delete_course_id=<?php echo $row['course_id']; ?>" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    // No courses found for the student
                    echo "<p class='text-center'>No courses found.</p>";
                }
            }
            
            // Display delete message if it is not already displayed
            if ($deleteMessageDisplayed) {
                echo "<p class='text-center'>Course deleted successfully.</p>";
            }
            ?>

            <hr>
        </div>
    </div>
</div>

<!-- Hidden form for watching course -->
<form id="watchCourseForm" method="post" action="">
    <input type="hidden" id="courseIdInput" name="course_id">
</form>

<script>
function watchCourse(courseId) {
    // Set the value of the hidden input field to the course ID
    var courseIdInput = document.getElementById("courseIdInput");
    courseIdInput.value = courseId;

    // Submit the form
    var form = document.getElementById("watchCourseForm");
    form.submit();
}
</script>

<?php
include './stuinclude/footer.php';
?>
