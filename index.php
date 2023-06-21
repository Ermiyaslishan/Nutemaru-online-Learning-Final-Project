<!-- Start Header -->
<?php
include('./dbConnection.php');
include('./main/header.php');
?>
<!-- End Header -->
  
   <section class="content-banner" style="position: relative;">
    <img src="images\My.png" alt="" width="100%">
    <div class="overlay" style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(0, 0, 0, 0.1);"></div>
    <div class="container" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="banner-con text-center">
                    <!-- <p class="first-title" style="color: white; font-size: 25px; margin-left: 30px;">Welcome &amp; Subscribe</p>
                    <p class="banner-des text-uppercase" style="color: white; margin-left: 30px; ">ትምህርትን በማንኛውም ሰአት እና በማንኛውም ቦታ!!!</p> -->
                    <?php
                    if(!isset($_SESSION['is_login'])){
                        echo '<a href="studentRegistration.php" class="banner-btn" style="margin-top: 450px; margin-right:20px; text-decoration: none;">Get Started</a>';
                    } else {
                        echo '<a href="student/studentProfile.php" class="btn btn-primary" style="margin-top: 420px; margin-right:90px;">My Profile</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end banner -->


<!-- Start Text banner -->
<div class="container-fluid p-3 mb-2 bg-white text-black txt-banner" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <div class="row bottom-banner">
        <div class="col-sm">
            <h5><i class="fas fa-book-open mr-1"></i> 100+ Online Courses</h5>
        </div>
        <div class="col-sm">
            <h5><i class="fas fa-user mr-1"></i> Expert Instructors</h5>
        </div>
        <div class="col-sm">
            <h5><i class="fas fa-keyboard mr-1"></i> Lifetime Access</h5>
        </div>
        <div class="col-sm">
            <h5><i class="fas fa-keyboard mr-1"></i> Local Language Support</h5>
        </div>
    </div>
</div>

<!-- end text banner -->

<!-- Start Home -->
<div id="home">
    <div style="margin-left: 80px; display: inline-block; width: 450px;">
      <h1 >ትምህርትን በማንኛውም ሰአት እና በማንኛውም ቦታ!!!</h1><br>
    <p style="color: gray; font-size: 17px;">NuTemaru Learn is a blend of Artificial Intelligence (AI), practical teaching and learning methods, which will help in overcoming the challenges of the digital teaching process due to a versatile in-house teaching talent that is rich and experienced with the presence of ed-tech veterans and the latest technology at its </p><br><br><br>
    <button style=" margin-left: 130px; margin-top: -130px;" class="banner-btn" >Enroll Now</button>
    </div>
    
    <video autoplay loop muted="" width="600px" height="550" style="margin-left: 220px; margin-top: -60px; display: inline-block;" class="ved" >
      <source src="video/onvid.mp4" type="video/mp4" >
    </video>
</div>
<!-- End Home  -->


<div class="container mt-5">
<h1 class="text-center">Popular Course</h1>
<!-- Start Most Popular Course 1st Card Deck -->
<div class="row row-cols-1 row-cols-md-4 g-4 mt-4">
<?php
$sql = "SELECT * FROM course LIMIT 4";
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $course_id = $row['course_id'];
        echo '<div class="col">
            <a href="#" class="text-decoration-none text-dark">
                <div class="card h-100">
                    <img src="'.str_replace('..','.',$row['course_img']).'" class="card-img-top" alt="" />
                    <div class="card-body">
                        <h5 class="card-title">' . $row['course_name']. '</h5>
                        <p class="card-text">'.$row['course_desc'].'</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text-d-inline">Price: <del>Birr '.$row['course_original_price'].' </del> <span class="font-weight-bold">Birr '.$row['course_price'].' <span></p>
                        <a class="btn btn-primary text-white font-weight-bold float-end" href="coursedetails.php?course_id='.$course_id.'">Enroll</a>
                    </div>
                </div>
            </a>
        </div>';
    }
}
?>
</div>
</div>

<div class="text-center">
  <a class="banner-btn mt-3 btn-lg" href="course.php" style="text-decoration: none;">View All Course</a>
  </div>

<!-- start Contact Us -->
<?php
include('./contact.php');
?>
<!-- end of contact -->








<!-- Footer -->
<?php
include('./main/footer.php')
?>
<!-- Footer -->





   

</body>
</html>