<?php
if (!isset($_SESSION)) {
    session_start();
}

include 'dbConnection.php';
$msg = "";

if (isset($_GET['verification'])) {
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM student WHERE code='{$_GET['verification']}'")) > 0) {
        $query = mysqli_query($conn, "UPDATE student SET code='' WHERE code='{$_GET['verification']}'");

        if ($query) {
            $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
        }
    } else {
        header("Location: Studentlogin.php");
        exit;
    }
}

if (isset($_POST['submit'])) {
    $stuLogEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $sql = "SELECT * FROM student WHERE stu_email='$stuLogEmail' AND stu_pass='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (empty($row['code'])) {
            $_SESSION['is_login'] = true;
            $_SESSION['stuLogEmail'] = $stuLogEmail;


            header("Location: index.php");
            exit;
        } else {
            $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login Form - NuTemaru</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/login.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/styleReg.css" type="text/css" media="all" />
    <style>
        /* CSS styles */
    </style>
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="/image/image.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Login Now</h2>
                        <p>Dream Big. </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password"
                                style="margin-bottom: 2px;" required>
                            <p><a href="forgot-password.php"
                                    style="margin-bottom: 15px; display: block; text-align: right;">Forgot
                                    Password?</a></p>
                            <button name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                            <p>Create Account! <a href="studentRegistration.php">Register</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>
</body>

</html>
