<!-- Start Header -->
<?php
include('./dbConnection.php');
include('./main/header.php');

?>
<!-- End Header -->

<!-- Start Course Page Banner -->
<div class="container-fluid bg-dark">
<div class="row">
<img src="images\My.png" alt="courses"
style="height:500px; width: 100%; object-fit:cover;
box-shadow:10px;" />
</div>
</div>
<!-- End Course Page Banner -->

<!-- start main content -->
<!-- Start Main Content -->
  <div class="container mt-5">
    <?php 
    if(isset($_GET['course_id'])){
     $course_id = $_GET['course_id'];
     $_SESSION['course_id'] = $course_id;
     $sql ="SELECT * FROM course WHERE course_id = '$course_id'";
     $result = $conn->query($sql);
     $row = $result->fetch_assoc();
    }
    ?>
<div class="row">
<div class="col-md-4">
<img src="<?php echo str_replace('..', '.', $row['course_img']) ?>" class="card-img-top" alt="" />
</div>
<div class="col-md-8">
<div class="card-body">
<h5 class="card-title">Course Name: <?php echo $row
['course_name'] ?></h5>
<p class="card-text"> Description: <?php echo $row
['course_desc'] ?></p>
<p class="card-text"> Duration: <?php echo $row
['course_duration'] ?></p>
<form action="checkout.php" method="post">
<p class="card-text d-inline">Price: <small> <del>Birr <?php echo $row
['course_original_price'] ?></
del></small> <span class="font-weight-bolder">Birr
<?php echo $row
['course_price'] ?><span></p>
<input type="hidden" name="id" value="<?php echo $row
['course_price']?>">
<button type="submit" class="btn btn-primary text-white font-weight-bolder
float-right" name="buy">Buy Now</button>

</form>
</div>
</div>
</div> 
<div class="container">
<div class="row">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th scope="col">Lesson No.</th>
<th scope="col">Lesson Name</th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM lesson";
$result = $conn->query($sql);
if($result->num_rows > 0) {
  $num = 0;
while ($row = $result->fetch_assoc()){
  if($course_id == $row['course_id']){
    $num++;
  echo '<tr>
  <th scope="row">'.$num.'</th>
  <td>'.$row['lesson_name'].'</td></tr>';
  }
}
}
?>
</tbody>
</table>
</div>
</div>



<?php
include('./main/footer.php')
?>
<!-- Footer -->