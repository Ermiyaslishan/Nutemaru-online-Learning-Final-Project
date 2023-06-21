<?php
// insert_course.php
include_once '../dbconnection.php';
// Include the necessary files and establish database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["course_id"])) {
        $courseId = $_POST["course_id"];

        // Set the flag value to 1
        $flag = 1;

        // Insert the course ID and flag into the check_value table
        $insertSql = "INSERT INTO check_value (course_id, flag) VALUES ('$courseId', '$flag')";
        $insertResult = $conn->query($insertSql);

        if ($insertResult) {
            // Course ID and flag inserted successfully
            // Redirect to watchcourse.php with the inserted course ID
            header("Location: watchcourse.php?course_id=$courseId");
            exit();
        } else {
            // Error inserting the course ID and flag
            // You can display an error message or handle the error as needed
            echo "Error inserting course ID and flag";
        }
    }
}
?>
