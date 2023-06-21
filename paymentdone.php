<?php
include('./dbconnection.php');
session_start();

if (!isset($_SESSION['stuLogEmail'])) {
    echo "<script> location.href='loginorsignup.php'; </script>";
} else {
    if (isset($_POST['ORDER_ID']) && isset($_POST['TXN_AMOUNT'])) {
        $order_id = $_POST['ORDER_ID'];
        $stu_email = $_SESSION['stuLogEmail'];
        $course_id = $_SESSION['course_id'];
        $amount = $_POST['TXN_AMOUNT'];
        date_default_timezone_set('Asia/Kolkata');
        $order_date = date('Y-m-d H:i:s');

        // Validate and sanitize the data received from PayPal
        $order_id = mysqli_real_escape_string($conn, $order_id);
        $stu_email = mysqli_real_escape_string($conn, $stu_email);
        $course_id = mysqli_real_escape_string($conn, $course_id);
        $amount = mysqli_real_escape_string($conn, $amount);
        $order_date = mysqli_real_escape_string($conn, $order_date);

        // Insert the payment data into the database
        $sql = "INSERT INTO courseorder (order_id, stu_email, course_id, amount, order_date)
                VALUES ('$order_id', '$stu_email', '$course_id', '$amount', '$order_date')";

        if ($conn->query($sql) === TRUE) {


            echo "<script>setTimeout(() => {
                window.location.href = './student/myCourse.php';
            },0);</script>";

            exit();
        } else {
            echo "Error inserting payment data: " . $conn->error;
        }
    } else {
        echo "Payment not completed.";
    }
}
?>
