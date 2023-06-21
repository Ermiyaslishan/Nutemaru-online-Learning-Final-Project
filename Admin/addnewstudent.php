<?php
session_start();

if (!isset($_SESSION['is_admin_login'])) {
    header("Location: ../index.php");
    exit();
}

require_once './admininclude/header.php';
require_once '../dbConnection.php';

$msg = '';

if (isset($_POST['newStuSubmitBtn'])) {
    $stu_name = $_POST['stu_name'];
    $stu_email = $_POST['stu_email'];
    $stu_pass = $_POST['stu_pass'];
    $stu_occ = $_POST['stu_occ'];

    if (empty($stu_name) || empty($stu_email) || empty($stu_pass) || empty($stu_occ)) {
        $msg = '<div class="alert alert-warning alert-dismissible fade show col-sm-6 mx-auto mt-2" role="alert">
                  Please fill all fields.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
    } else {
        $sql = "INSERT INTO student (stu_name, stu_email, stu_pass, stu_occ) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $stu_name, $stu_email, $stu_pass, $stu_occ);

        if ($stmt->execute()) {
            $msg = '<div class="alert alert-success alert-dismissible fade show col-sm-6 mx-auto mt-2" role="alert">
                      Student added successfully!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
        } else {
            $msg = '<div class="alert alert-danger alert-dismissible fade show col-sm-6 mx-auto mt-2" role="alert">
                      Unable to add student.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
        }

        $stmt->close();
    }
}

?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add New Student</h3>
    <form method="post">
        <div class="form-group">
            <label for="stu_name">Name</label>
            <input type="text" class="form-control" id="stu_name" name="stu_name">
        </div>
        <div class="form-group">
            <label for="stu_email">Email</label>
            <input type="email" class="form-control" id="stu_email" name="stu_email">
        </div>
        <div class="form-group">
            <label for="stu_pass">Password</label>
            <input type="password" class="form-control" id="stu_pass" name="stu_pass">
        </div>
        <div class="form-group">
            <label for="stu_occ">Occupation</label>
            <input type="text" class="form-control" id="stu_occ" name="stu_occ">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" name="newStuSubmitBtn">Submit</button>
            <a href="students.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if ($msg) { echo $msg; } ?>
    </form>
</div






<?php 
include('./admininclude/footer.php');
?>


