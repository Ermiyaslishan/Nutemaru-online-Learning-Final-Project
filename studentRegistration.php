<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Database connection
include 'dbConnection.php';

// Error and success messages
$msg = '';
$errors = []; // Define the $errors variable

// Handle form submission
if (isset($_POST['submit'])) {
    $stuname = $_POST['name'];
    $stuemail = $_POST['email'];
    $stupass = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Validate form data
    if (empty($stuname)) {
        $errors[] = 'Name is required.';
    } elseif (!preg_match('/^[a-zA-Z]+$/', $stuname)) {
        $errors[] = 'Name should contain only alphabets.';
    }

    if (empty($stuemail)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($stuemail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (empty($stupass)) {
        $errors[] = 'Password is required.';
    } elseif (strlen($stupass) < 8) {
        $errors[] = 'Password should be at least 8 characters long.';
    } elseif ($stupass !== $confirm_password) {
        $errors[] = 'Password and confirm password do not match.';
    }

    if (count($errors) > 0) {
        $msg = '<div class="alert alert-danger">' . implode('<br>', $errors) . '</div>';
    } else {
        // Check if the email already exists
        $existingEmailQuery = "SELECT * FROM student WHERE stu_email = ?";
        $stmt = $conn->prepare($existingEmailQuery);
        $stmt->bind_param("s", $stuemail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $msg = '<div class="alert alert-danger">This email address is already registered.</div>';
        } else {
            // Insert new student record
            $insertQuery = "INSERT INTO student (stu_name, stu_email, stu_pass, code) VALUES (?, ?, ?, ?)";
            $code = md5(rand());

            $hashedPass = md5($stupass);

            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("ssss", $stuname, $stuemail, $hashedPass, $code);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // Send verification email
                try {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = '';
                    $mail->Password   = '';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port       = 465;

                    $mail->setFrom('');
                    $mail->addAddress($stuemail);

                    $mail->isHTML(true);
                    $mail->Subject = 'Email Verification from NuTemaru';
                    $mail->Body    = 'Here is the verification link: <a href="http://localhost/nutemaru/Studentlogin.php?verification=' . $code . '">Click Me</a>';

                    $mail->send();

                    $msg = '<div class="alert alert-info">A verification link has been sent to your email address.</div>';
                } catch (Exception $e) {
                    $msg = '<div class="alert alert-danger">An error occurred while sending the verification email. Please try again later.</div>';
                }
            } else {
                $msg = '<div class="alert alert-danger">Something went wrong. Please try again later.</div>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login Form - NuTemaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/styleReg.css" type="text/css" media="all" />
    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
</head>

<body>
    <section class="w3l-mockup-form">
        <div class="container">
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/image2.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Register Now</h2>
                        <p>Dream Big with NuTemaru</p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="text" class="name" name="name" placeholder="Enter Your Name"
                                value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
                            <input type="email" class="email" name="email" placeholder="Enter Your Email"
                                value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                            <input type="password" class="password" name="password" placeholder="Enter Your Password"
                                required>
                            <input type="password" class="confirm-password" name="confirm-password"
                                placeholder="Enter Your Confirm Password" required>
                            <?php if (in_array('Name should contain only alphabets.', $errors)): ?>
                                <!-- <div class="alert alert-danger">Name should contain only alphabets.</div> -->
                            <?php elseif (in_array('Password should be at least 8 characters long.', $errors)): ?>
                                <!-- <div class="alert alert-danger">Password should be at least 8 characters long.</div> -->
                            <?php elseif (in_array('Password and confirm password do not match.', $errors)): ?>
                                <!-- <div class="alert alert-danger">Password and confirm password do not match.</div> -->
                            <?php endif; ?>
                            <button name="submit" class="btn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account! <a href="Studentlogin.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function(c) {
            $('.alert-close').on('click', function(c) {
                $('.main-mockup').fadeOut('slow', function(c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>
</body>

</html>
