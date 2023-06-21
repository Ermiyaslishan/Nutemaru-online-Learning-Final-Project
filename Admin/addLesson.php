<?php
if (!isset($_SESSION)) {
    session_start();
}

include('./admininclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

if (isset($_REQUEST['lessonSubmitBtn'])) {
    // Checking for Empty Fields
    if (
        ($_REQUEST['lesson_name'] == "") ||
        ($_REQUEST['lesson_desc'] == "") ||
        ($_REQUEST['course_id'] == "") ||
        ($_REQUEST['course_name'] == "")
    ) {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
    } else {
        $lesson_name = $_REQUEST['lesson_name'];
        $lesson_desc = $_REQUEST['lesson_desc'];
        $course_id = $_REQUEST['course_id'];
        $course_name = $_REQUEST['course_name'];

        // File Upload
        $file_name = $_FILES['file_upload']['name'];
        $file_temp = $_FILES['file_upload']['tmp_name'];
        $lesson_link = $_FILES['lesson_link']['name'];
        $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
        $link_folder = '../lessonvid/'.$lesson_link;
        $file_folder = '../fileuploads/' . $file_name;
        move_uploaded_file($file_temp, $file_folder);
        move_uploaded_file($lesson_link_temp, $link_folder);

        // Database Insertion
        $sql = "INSERT INTO lesson (lesson_name, lesson_desc, lesson_link, course_id, course_name, file_upload) VALUES ('$lesson_name', '$lesson_desc', '$link_folder', '$course_id', '$course_name', '$file_folder')";

        if ($conn->query($sql) === TRUE) {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Lesson Added Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Add Lesson</div>';
        }
    }
}

?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add New Lesson</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="course_id" class="form-label">Course ID</label>
            <input type="text" class="form-control" id="course_id" name="course_id" value="<?php if (isset($_SESSION['course_id'])) {
                                                                                                    echo $_SESSION['course_id'];
                                                                                                } ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="course_name" class="form-label">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name" value="<?php if (isset($_SESSION['course_name'])) {
                                                                                                        echo $_SESSION['course_name'];
                                                                                                    } ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="lesson_name" class="form-label">Lesson Name</label>
            <input type="text" class="form-control" id="lesson_name" name="lesson_name">
        </div>
        <div class="mb-3">
            <label for="lesson_desc" class="form-label">Lesson Description</label>
            <textarea class="form-control" id="lesson_desc" name="lesson_desc" rows="2"></textarea>
        </div>
        <div class="mb-3">
            <label for="lesson_link" class="form-label">Lesson Video Link</label>
            <input type="file" class="form-control" id="lesson_link" name="lesson_link">
        </div>
        <div class="mb-3">
            <label for="file_upload" class="form-label">Upload File</label>
            <input type="file" class="form-control" id="file_upload" name="file_upload">
        </div>
        <div class="mb-3">
            <div class="text-center">
                <button type="submit" class="btn btn-danger" id="lessonSubmitBtn" name="lessonSubmitBtn">Submit</button>
                <a href="lesson.php" class="btn btn-secondary">Close</a>
            </div>
        </div>
        <?php if (isset($msg)) {
            echo $msg;
        } ?>
    </form>
</div>

<?php
include('./admininclude/footer.php');
?>
