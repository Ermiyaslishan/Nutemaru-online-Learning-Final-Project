<?php
if (!isset($_SESSION)) {
    session_start();
}

include('./admininclude/header.php');
include_once('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href='../index.php';</script>";
}

if (isset($_REQUEST['adminPassUpdatebtn'])) {
    $oldPass = $_REQUEST['oldPass']; // Get the entered old password

    // Retrieve the current admin password from the database
    $sql = "SELECT admin_pass FROM admin WHERE admin_email='$adminEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $adminPass = $row['admin_pass'];

        if ($adminPass != $oldPass) {
            // Display error message if old password doesn't match
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Old password does not match.</div>';
        } else {
            // Update the admin's password in the database
            $newPass = $_REQUEST['newPass'];
            $sql = "UPDATE admin SET admin_pass = '$newPass' WHERE admin_email = '$adminEmail'";

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

<div class="col-sm mt-5">
    <div class="row">
        <div class="col-sm-6">
            <form class="mt-5 mx-5" method="POST">
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" value="<?php echo $adminEmail ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="inputOldPassword">Old Password</label>
                    <input type="password" class="form-control" id="inputOldPassword" placeholder="Enter Old Password" name="oldPass">
                </div>

                <div class="form-group">
                    <label for="inputNewPassword">New Password</label>
                    <input type="password" class="form-control" id="inputNewPassword" placeholder="Enter New Password" name="newPass">
                </div>

                <button type="submit" class="btn btn-danger mr-4 mt-4" name="adminPassUpdatebtn">Update</button>
                <button type="reset" class="btn btn-secondary mt-4" name="adminPassResetbtn">Reset</button>

                <?php if (isset($passmsg)) {
                    echo $passmsg;
                } ?>
            </form>
        </div>
    </div>
</div>

<?php
include('./admininclude/footer.php');
?>
