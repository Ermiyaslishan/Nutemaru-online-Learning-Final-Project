<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NuTemaru</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nav.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <style>
        /* Reduce header height and adjust logo */
        .navbar {
            padding-top: 5px;
            padding-bottom: 5px;
            height: 80px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-family: 'Ubuntu', sans-serif;
            font-size: 1.5rem;
            color: black;
        }

        .navbar-nav .nav-link {
            color: black;
            
        }

        .navbar-nav .nav-link:hover {
            border-bottom: 2px solid #00c16e;
        }

        /* Horizontal display of navbar links on small screens */
    @media (max-width: 991px) {
    .navbar-nav {
        flex-direction: row;
        justify-content: flex-end;
    }

    .navbar-nav .nav-link {
        padding: 0.5rem 1rem;
    }

    .navbar {
        height: 80px;
        padding-top: 15px;
        padding-bottom: 15px;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
}

    </style>
</head>
<body>
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-sm navbar-white bg-white fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/Capture.PNG" style="border-radius: 10%;" width="50" height="50" alt="Logo">
                NuTemaru
            </a>
            <button class="navbar-toggler ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link" href="index.php" id="e">Home</a>
                    <a class="nav-link" href="course.php">Course</a>
                   
                    <?php
                    session_start();
                    if (isset($_SESSION['is_login'])) {
                        echo '<a class="nav-link" href="student/studentProfile.php">My Profile</a>
                        <a class="nav-link" href="paymentstatus.php">Payment</a>
                        <a class="nav-link" href="logout.php">Logout</a>';
                    } else {
                        echo '<a class="nav-link" href="Studentlogin.php">Login</a>
                        <a class="nav-link" href="studentRegistration.php">Signup</a>';
                    }
                    ?>
                    <a class="nav-link" href="student\stufeedback.php">Feedback</a>
                    <a class="nav-link" href="compiler\compiler.php">Online Compiler</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navigation -->

    <!-- JavaScript files -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
