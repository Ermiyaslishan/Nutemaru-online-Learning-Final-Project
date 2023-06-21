<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="../css/all.min.css">
<!-- Google Font -->
<link
href="https://fonts.googleapis.com/css?family=Ubuntu"
rel="stylesheet">
<!-- Custom CSS -->
<link rel="stylesheet" href="../css/adminstyle.css">
</head>
<body>
<!-- Top Navbar -->
<nav class="navbar navbar-dark fixed-top p-0 shadow"
style="background-color:#225470;">
<a class="navbar-brand col-sm-4 col-md-2 mr-0" href="adminDashboard.php">NuTemaru
      <small class="text-white">Admin Area</small></a>
</nav>

<!-- Side Bar -->
<div class="container-fluid mb-3" style="margin-top: 30px;">
<div class="row">
    <nav class="col-sm-3 col-md-2 bg-light sidebar py-5 d-print-none">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="adminDashboard.php">
              <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                       </a>
                           </li>
                               <li class="nav-item">
                                  <a class="nav-link" href="courses.php">
                           <i class="fas fa-accessible-icon"></i>
                            Courses
                            </a>
                            </li>
                            <li class="nav-item">
                                  <a class="nav-link" href="lessons.php">
                           <i class="fas fa-accessible-icon"></i> 
                            Lesson
                            </a>
                           </li>
                            <li class="nav-item">
                                  <a class="nav-link" href="students.php">
                           <i class="fas fa-users"></i>
                            Student
                            </a>
                            </li>
                            <li class="nav-item">
                                  <a class="nav-link" href="sellReport.php">
                           <i class="fas fa-accessibe-icon"></i>
                            Sell Report
                            </a>
                            </li>
                            <li class="nav-item">
                                  <a class="nav-link" href="ViewPaymentStatus.php">
                           <i class="fas fa-accessible-icon"></i>
                            Payment Status
                            </a>
                            </li>
                            <li class="nav-item">
                                  <a class="nav-link" href="feedback.php">
                           <i class="fas fa-accessible-icon"></i>
                            FeedBack
                            </a>
                            </li>
                            <li class="nav-item">
                                  <a class="nav-link" href="adminChangePassword.php">
                           <i class="fas fa-accessible-icon"></i>
                            Change Password
                            </a>
                            </li>
                            <a class="nav-link" href="addquiz.php">
                           <i class="fas fa-accessible-icon"></i>
                            quiz
                            </a>
                            </li>
                            <li class="nav-item">
                                  <a class="nav-link" href="../logout.php">
                           <i class="fas fa-accessible-icon"></i>
                            Logout
 </a>
      </li>
      </ul>
</div>
 </nav>