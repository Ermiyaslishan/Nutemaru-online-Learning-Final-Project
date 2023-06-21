<?php
include_once('../dbconnection.php');

if(!isset($_SESSION)) {
session_start();
}

if(isset($_SESSION['is_login'])){
$stuLogEmail = $_SESSION['stuLogEmail'];
}
// else {
// echo "<script> location.href='../index.php'; </script>";
// }
if(isset($stuLogEmail)) {
$sql = "SELECT stu_img FROM student WHERE stu_email = '$stuLogEmail' ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$stu_img = $row['stu_img'];
}
?>

<!DOCTYPE html>
<html Lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,
initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Profile</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="../css/all.min.css">
<!-- Google Font -->
<link
href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
<!-- cutomer css -->
<link rel="stylesheet" href="../css/stustyle.css">

</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="../index.php">
     <span style="color:Black"> NuTemaru </span>
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
 <li class="nav-item">
<a class="nav-link" href="studentProfile.php">
<i class="fas fa-user"></i>
Profile <span class="sr-only">(current)</span>
</a>
</li>
     
<li class="nav-item">
<a class="nav-link" href="myCourse.php">
<i class="fab fa-accessible-icon"></i>
My Courses
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="stufeedback.php">
<i class="fab fa-accessible-icon"></i>
Feedback
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="studentChangePass.php">

<i class="fas fa-key"></i>
Change Password
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="../logout.php">
<i class="fas fa-sign-out-alt"></i>
Logout
</a>
</li>

      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Avatar -->
      <div class="dropdown">
          <img
            src="<?php echo $stu_img ?>"
            class="rounded-circle"
            height="40"
            alt=""
            loading="lazy"
          />
        </a>
        
      </div>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->