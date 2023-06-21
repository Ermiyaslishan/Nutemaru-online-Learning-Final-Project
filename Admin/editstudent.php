<?php
if (!isset($_SESSION)) {
    session_start();
}

include('./admininclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

// Update
if (isset($_REQUEST['NewStuSubmitBtn'])) {
    // Checking for Empty Fields
    if (empty($_REQUEST['stu_id']) || empty($_REQUEST['stu_name']) || empty($_REQUEST['stu_email']) ||
        empty($_REQUEST['stu_pass']) || empty($_REQUEST['stu_occ'])) {
        // msg displayed if required field missing
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
    } else {
        // Assigning User Values to Variables
        $stuId = $_REQUEST['stu_id'];
        $stuName = $_REQUEST['stu_name'];
        $stuEmail = $_REQUEST['stu_email'];
        $stuPass = $_REQUEST['stu_pass'];
        $stuOcc = $_REQUEST['stu_occ'];

        $sql = "UPDATE student SET stu_name='$stuName', stu_email='$stuEmail', stu_pass='$stuPass', stu_occ='$stuOcc' WHERE stu_id='$stuId'";

        if ($conn->query($sql) === TRUE) {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
        } else {
            // below msg display on form submit failed
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
        }
    }
}
?>

<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <?php
    if (isset($_REQUEST['view'])) {
        $sql = "SELECT * FROM student WHERE stu_id={$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
    <h3 class="text-center">Update Student Detail</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="stu_ID">ID</label>
            <input type="text" class="form-control" id="stu_id" name="stu_id" value="<?php if (isset($row['stu_id'])) {
                                                                                            echo $row['stu_id'];
                                                                                        } ?>" readonly>
        </div>
        <div class="form-group">
            <label for="stu_name">Name</label>
            <input type="text" class="form-control" id="stu_name" name="stu_name" value="<?php if (isset($row['stu_name'])) {
                                                                                                echo $row['stu_name'];
                                                                                            } ?>">
        </div>
        <div class="form-group">
            <label for="stu_email">Email</label>
            <input type="text" class="form-control" id="stu_email" name="stu_email" value="<?php if (isset($row['stu_email'])) {
                                                                                                echo $row['stu_email'];
                                                                                            } ?>">
        </div>
        <div class="form-group">
            <label for="stu_pass">Password</label>
            <input type="text" class="form-control" id="stu_pass" name="stu_pass" value="<?php if (isset($row['stu_pass'])) {
                                                                                                echo $row['stu_pass'];
                                                                                            } ?>">
        </div>
        <div class="form-group">
            <label for="stu_occ">Occupation</label>
            <input type="text" class="form-control" id="stu_occ" name="stu_occ" value="<?php if (isset($row['stu_occ'])) {
                                                                                            echo $row['stu_occ'];
                                                                                        } ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="updateStuSubmitBtn" name="NewStuSubmitBtn">Submit</button>
            <a href="students.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if (isset($msg)) {
            echo $msg;
        } ?>
    </form>
</div>

<?php
include('./admininclude/footer.php');
?>
