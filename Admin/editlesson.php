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
if(isset($_REQUEST ['requpdateEditLesson'])) {
    // Checking for Empty Fields
    if ($_REQUEST['lesson_id'] == "" || $_REQUEST['lesson_name'] == "" || $_REQUEST['lesson_desc'] == "" || $_REQUEST['course_id'] == "" || $_REQUEST['course_name'] == "") {

    // msg displayed if required field missing
    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
    } else {
// Assigning User Values to Variable
$lid = $_REQUEST['lesson_id'];
$lname = $_REQUEST['lesson_name'];
$ldesc = $_REQUEST['lesson_desc'];
$cid = $_REQUEST['course_id'];
$cname = $_REQUEST['course_name'];
$llink = '../lessonvid/'. $_FILES['lesson_link']['name'];
$sql = "UPDATE lesson SET lesson_id ='$lid', lesson_name = '$lname', lesson_desc = '$ldesc', course_id='$cid',
course_name='$cname', lesson_link='$llink' WHERE lesson_id = '$lid'";

if($conn->query($sql) == TRUE){
    $msg= '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
    } else {
    // below msg display on form submit failed
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
}
}
?>


<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Update Course Details</h3>


    <?php
    if(isset($_REQUEST['view'])){
        $sql =" SELECT * FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    
    ?>


<form action="" method="POST" enctype="multipart/form-data">
<div class="form-group">
     <label for="lesson_id">Lesson ID</label>
     <input type="text" class="form-control" id="lesson_id" name="lesson_id" value="<?php if(isset($row['lesson_id'])){echo $row['lesson_id']; }?>" readonly>
</div>
<div class="form-group">
    <label for="lesson_name">Lesson Name</label> 
    <input type="text" class="form-control" id="lesson_name" name="lesson_name" value="<?php if(isset($row ['lesson_name'])) {echo $row ['lesson_name']; } ?>">
</div>
<div class="form-group">
    <label for="lesson_desc">Lesson Description</label>
    <textarea class="form-control" id="lesson_desc" name="lesson_desc" row=2><?php if(isset($row['lesson_desc'])) {echo $row ['lesson_desc']; }?></textarea>
</div>
<div class="form-group">
   <label for="course_id">Course ID</label> 
   <input type="text" class="form-control" id="course_id" name="course_id" value="<?php if(isset($row['course_id'])) {echo $row['course_id']; } ?>" readonly>
<div class="form-group">
<label for="course_name">Course Name</label>
<input type="text" class="form-control" id="course_name" name="course_name" onkeypress="isInputNumber(event)" value="<?php if(isset($row['course_name'])) {echo $row ['course_name']; } ?>" readonly>
</div>

<div class="form-group">
  <label for="lesson-link">Lesson Link</label>
  <div class="embed-responsive embed-responsive">
    <?php if (isset($row['lesson_link'])): ?>
      <video class="embed-responsive-item"  width="50%" controls>
        <source src="<?php echo $row['lesson_link']; ?>" type="video/mp4">
        <!-- Include additional <source> elements for different video formats if needed -->
        Your browser does not support the video tag.
      </video>
    <?php endif; ?>
  </div>
  <input type="text" class="form-control-file" id="lesson-link" name="lesson_link" value="<?php echo isset($row['lesson_link']) ? $row['lesson_link'] : ''; ?>">
</div>

<div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdateEditLesson" name="requpdateEditLesson">Update</button>
      <a href="lessons.php" class="btn btn-secondary">Close</a>
</div>
<?php if(isset($msg)) {echo $msg;} ?>
     </form>
</div>

 </div>

 

</div>


<?php 
include('./admininclude/footer.php');
?>
