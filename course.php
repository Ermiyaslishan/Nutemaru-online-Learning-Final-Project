<!-- Start Header -->
<?php
include('./dbConnection.php');
include('./main/header.php');

?>
<!-- End Header -->
<body>
    
<!-- Start Course Page Banner -->
<div class="container-fluid bg-dark">
<div class="row">
<img src="images\My.png" alt="courses"
style="height:500px; width: 100%; object-fit:cover;
box-shadow:10px;" />
</div>
</div>
<!-- End Course Page Banner -->



<div class="container mt-5">
  <h1 class="text-center">All Course</h1>
  <div class="row mt-4">
    <?php
    $sql = "SELECT * FROM course";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $course_id = $row['course_id'];
        ?>
        <div class="col-md-3 mb-4">
          <a href="coursedetails.php?course_id=<?php echo $course_id; ?>" class="text-decoration-none">
            <div class="card">
              <img src="<?php echo str_replace('..', '.', $row['course_img']); ?>" class="card-img-top" alt="Course Image">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['course_name']; ?></h5>
                <p class="card-text"><?php echo $row['course_desc']; ?></p>
              </div>
              <div class="card-footer bg-white border-top-0">
                <p class="card-text mb-0"><small class="text-muted"><del>Birr <?php echo $row['course_original_price']; ?></del></small></p>
                <p class="card-text fw-bold mb-0">Birr <?php echo $row['course_price']; ?></p>
                <a href="coursedetails.php?course_id=<?php echo $course_id; ?>" class="btn btn-primary float-end">Enroll</a>
              </div>
            </div>
          </a>
        </div>
        <?php
      }
    } else {
      echo "No courses found.";
    }
    ?>
  </div>
</div>





<?php
include('./main/footer.php')
?>
<!-- Footer -->

</body>
</html>