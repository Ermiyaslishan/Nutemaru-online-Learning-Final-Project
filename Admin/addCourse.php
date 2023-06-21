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

if (isset($_REQUEST['courseSubmitBtn'])) {
    // Checking for Empty Fields
    if (
        ($_REQUEST['course_name'] == "") ||
        ($_REQUEST['course_desc'] == "") ||
        ($_REQUEST['course_author'] == "") ||
        ($_REQUEST['course_duration'] == "") ||
        ($_REQUEST['course_price'] == "") ||
        ($_REQUEST['course_original_price'] == "")
    ) {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
    } else {
        $course_name = $_REQUEST['course_name'];
        $course_desc = $_REQUEST['course_desc'];
        $course_author = $_REQUEST['course_author'];
        $course_duration = $_REQUEST['course_duration'];
        $course_price = $_REQUEST['course_price'];
        $course_original_price = $_REQUEST['course_original_price'];
        $course_image = $_FILES['course_img']['name'];
        $course_image_temp = $_FILES['course_img']['tmp_name'];
        $img_folder = '../images/courseimg/' . $course_image;
        move_uploaded_file($course_image_temp, $img_folder);

        // Insert the course into the courses table
        $sql = "INSERT INTO course (course_name, course_desc, course_author, course_img, course_duration, course_price, course_original_price) VALUES ('$course_name', '$course_desc', '$course_author', '$img_folder', '$course_duration', '$course_price', '$course_original_price')";
        $conn->query($sql);

        // Retrieve the course_id of the newly added course
        $courseId = $conn->insert_id;

        // Update the course_id in the quiz_questions table
        $sql = "UPDATE quiz_questions SET course_id = $courseId";
        $conn->query($sql);

        $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Course Added Successfully</div>';
    }
}
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add New Course</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- Rest of your form code -->
        <div class="form-group">
           <label for="course_name">Course Name</label>
             <input type="text" class="form-control" id="course_name" name="course_name">
          </div>
<div class="form-group">
    <label for="course_desc">Course Description</label>
    <textarea class="form-control" id="course_desc" name="course_desc" row=2></textarea>
</div>
<div class="form-group">
    <label for="course_author">Author</label>
    <input type="text" class="form-control" id="course_author" name="course_author">
</div>
<div class="form-group">
     <label for="course_duration">Course Duration</label>
     <input type="text" class="form-control" id="course_duration" name="course_duration">
</div>
<div class="form-group">
      <label for="course_original_price">Course Original Price</label>
      <input type="text" class="form-control" id="course_original_price" name="course_original_price">
</div>
<div class="form-group">
      <label for="course_price">Course Selling Price</label>
      <input type="text" class="form-control" id="course_price" name="course_price">
</div>
<div class="form-group">
      <label for="course_img">Course Image</label>
      <input type="file" class="form-control-file" id="course_img" name="course_img">
</div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="courseSubmitBtn" name="courseSubmitBtn">Submit</button>
            <a href="courses.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if (isset($msg)) {
            echo $msg;
        } ?>
    </form>
</div>

<?php
include('./admininclude/footer.php');
?>
