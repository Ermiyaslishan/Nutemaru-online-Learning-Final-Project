<?php
require_once 'fpdf/fpdf.php'; // Include the FPDF library
include '../dbConnection.php';

// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['is_login'])) {
    $stuLogEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
    exit;
}

// Retrieve the course_id from the URL query parameters
$courseId = $_GET['course_id'];

// Retrieve the student_email from the session
$stuLogEmail = $_SESSION['stuLogEmail'];

if (!$courseId || !$stuLogEmail) {
    echo "Required parameters are missing.";
    exit;
}

// Prepare the SQL query to select the required data
$sql = "SELECT course.course_name, student.stu_name
        FROM courseorder
        INNER JOIN student ON courseorder.stu_email = student.stu_email
        INNER JOIN course ON courseorder.course_id = course.course_id
        WHERE courseorder.course_id = ? AND courseorder.stu_email = ?";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameters
$stmt->bind_param("ss", $courseId, $stuLogEmail);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there are any rows
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $courseName = $row["course_name"];
    $stuName = $row["stu_name"];

    // Create a new PDF object
    $pdf = new FPDF('L', 'mm', 'A4');
    
    // Add a new page to the PDF document
    $pdf->AddPage();
    
    // Set the font and font size
    $pdf->SetFont('Arial', 'I', 18);
    
    // Set the certificate template image
    $templatePath = 'certificate_template.png';
    
    // Add the certificate template image with adjusted frame size
    $pdf->Image($templatePath, 0, 0, 297, 210);
    
    // Set the text color (black)
    $pdf->SetTextColor(128, 128, 150);
    
    // Set the position and alignment for the student name
    $nameX = 60;
    $nameY = 130;
    $nameAlign = 'L';
    
    // Add the student name to the certificate
    $pdf->SetXY($nameX, $nameY);
    $pdf->Cell(0, 0, $stuName, 0, 0, $nameAlign);
    
    // Set the position and alignment for the course name
    $courseX = 30;
    $courseY = 140;
    $courseAlign = 'L';
    
    // Add the course name to the certificate
    $pdf->SetXY($courseX, $courseY);
    $pdf->Cell(0, 0, 'For Completing ' . $courseName, 0, 0, $courseAlign);    
    
    // Set the content disposition header to force download
    header('Content-type: application/pdf');
    header('Content-Disposition: attachment; filename="generated_certificate.pdf"');
    
    // Output the generated PDF to the browser
    $pdf->Output();
    
    // Free up memory
    $pdf->Close();
} else {
    echo "No data found for the given course ID and student email.";
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();

// Stop further script execution
exit;
?>
