<?php 
if(!isset($_SESSION)) {
    session_start();
}

include('./admininclude/header.php');
include('../dbConnection.php');

if(isset($_SESSION['is_admin_login'])){
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

// Update
if(isset($_POST['requpdateCourse'])) {
    // Checking for Empty Fields
    if(empty($_POST['course_id']) || empty($_POST['course_name']) || empty($_POST['course_desc']) || empty($_POST['course_author']) || empty($_POST['course_duration']) || empty($_POST['course_original_price']) || empty($_POST['course_price'])){
        // message displayed if required field missing
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
    } else {
        // Assigning User Values to Variables
        $cid = $_POST['course_id'];
        $cname = $_POST['course_name'];
        $cdesc = $_POST['course_desc'];
        $cauthor = $_POST['course_author'];
        $cduration = $_POST['course_duration'];
        $corigprice = $_POST['course_original_price'];
        $cprice = $_POST['course_price'];
        
        // Check if an image is uploaded
        if ($_FILES['course_img']['name'] != "") {
            $cimg = '../images/course/'. $_FILES['course_img']['name'];
            // Upload the image to the desired location
            move_uploaded_file($_FILES['course_img']['tmp_name'], $cimg);
        } else {
            // Use the existing image if no new image is uploaded
            $cimg = $_POST['course_img_existing'];
        }
        
        $sql = "UPDATE course SET course_name = '$cname', course_desc = '$cdesc', course_author = '$cauthor', course_duration = '$cduration', course_original_price = '$corigprice', course_price = '$cprice', course_img = '$cimg' WHERE course_id = '$cid'";

        if($conn->query($sql) == TRUE){
            // message displayed on success
            $msg= '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
        } else {
            // message displayed on failure
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
        }
    }
}

?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Course Details</h3>

    <?php
    if(isset($_REQUEST['view']) && isset($_REQUEST['id'])){
        $sql ="SELECT * FROM course WHERE course_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
        } else {
            echo "<div class='alert alert-danger col-sm-6 ml-5 mt-2' role='alert'> No Record Found! </div>";
        }
    }
    ?>

<form action="" method="POST" enctype="multipart/form-data">
<div class="form-group">
     <label for="course_id">Course ID</label>
     <input type="text" class="form-control" id="course_id" name="course_id" value="<?php if(isset($row['course_id'])){echo $row['course_id']; }?>" readonly>
</div>
<div class="form-group">
    <label for="course_name">Course Name</label>
    <input type="text" class="form-control" id="course_name" name="course_name" value="<?php if(isset($row['course_name'])){echo $row['course_name']; } ?>">
</div>
<div class="form-group">
    <label for="course_desc">Course Description</label>
    <textarea class="form-control" id="course_desc" name="course_desc" row=2><?php if(isset($row['course_desc'])){echo $row['course_desc']; } ?></textarea>
</div>
<div class="form-group">
    <label for="course_author">Author</label>
    <input type="text" class="form-control" id="course_author" name="course_author" value="<?php if(isset($row['course_author'])){echo $row['course_author']; } ?>">
</div>
<div class="form-group">
     <label for="course_duration">Course Duration</label>
     <input type="text" class="form-control" id="course_duration" name="course_duration"value="<?php if(isset($row['course_duration'])){echo $row['course_duration']; } ?>">
</div>
<div class="form-group">
      <label for="course_original_price">Course Original Price</label>
      <input type="text" class="form-control" id="course_original_price" name="course_original_price"value="<?php if(isset($row['course_original_price'])){echo $row['course_original_price']; } ?>">
</div>
<div class="form-group">
      <label for="course_price">Course Selling Price</label>
      <input type="text" class="form-control" id="course_price" name="course_price"value="<?php if(isset($row['course_price'])){echo $row['course_price']; } ?>">
</div>
<div class="form-group">
      <label for="course_img">Course Image</label>
      <img src="<?php if(isset($row['course_img'])) {echo $row['course_img']; } ?>" alt=""  class="img-thumbnail">
      <input type="file" class="form-control-file" id="course_img" name="course_img">
      <input type="hidden" name="course_img_existing" value="<?php if(isset($row['course_img'])) {echo $row['course_img']; } ?>">
</div>
<div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdateCourse" name="requpdateCourse">Update</button>
      <a href="courses.php" class="btn btn-secondary">Close</a>
</div>
<?php if(isset($msg)) {echo $msg;} ?>
</form>
</div>

<?php 
include('./admininclude/footer.php');
?>
