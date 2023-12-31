<?php
if (!isset($_SESSION)) {
    session_start();
}

include('./stuInclude/header.php');
include_once('../dbconnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

if (isset($_REQUEST['stuPassUpdateRtn'])) {
    $oldPass = $_REQUEST['stuOldPass']; // Get the entered old password

    // Retrieve the current student password from the database
    $sql = "SELECT stu_pass FROM student WHERE stu_email='$stuEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $currentPass = $row['stu_pass'];

        if ($currentPass != $oldPass) {
            // Display error message if old password doesn't match
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Old password is incorrect.</div>';
        } else {
            // Update the student's password in the database
            $newPass = $_REQUEST['stuNewPass'];
            $sql = "UPDATE student SET stu_pass = '$newPass' WHERE stu_email = '$stuEmail'";

            if ($conn->query($sql) === TRUE) {
                // Password updated successfully
                $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Password updated successfully.</div>';
            } else {
                // Failed to update password
                $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to update password.</div>';
            }
        }
    }
}
?>

<div class="col-sm-9 col-md-10">
    <div class="row">
        <div class="col-sm-6">
            <form class="mt-5 mx-5" method="POST">
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" value="<?php echo $stuEmail ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="inputOldPassword">Old Password</label>
                    <input type="password" class="form-control" id="inputOldPassword" placeholder="Old Password" name="stuOldPass">
                </div>
                <div class="form-group">
                    <label for="inputNewPassword">New Password</label>
                    <input type="password" class="form-control" id="inputNewPassword" placeholder="New Password" name="stuNewPass">
                </div>
                <button type="submit" class="btn btn-primary mr-4 mt-4" name="stuPassUpdateRtn">Update</button>
                <button type="reset" class="btn btn-secondary mt-4"> Reset </button>
                <?php if (isset($passmsg)) {
                    echo $passmsg;
                } ?>
            </form>
        </div>
    </div>
</div>

<?php
include('./stuInclude/footer.php');
?>
