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

?>

<div class="col-sm-9 mt-5">
    <!--Table-->
    <p class="bg-dark text-white p-2">List of Courses</p>
    <?php
    $sql = "SELECT * FROM course";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Course ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) {
                    $courseId = $row['course_id'];
                    ?>
                    <tr>
                        <th scope="row"><?php echo $courseId; ?></th>
                        <td><?php echo $row['course_name']; ?></td>
                        <td><?php echo $row['course_author']; ?></td>
                        <td>
                            <form action="editcourse.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $courseId; ?>">
                                <button type="submit" class="btn btn-info mr-3" name="view" value="View">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </form>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="d-inline" onsubmit="return confirmDelete('<?php echo $courseId; ?>')">
                                <input type="hidden" name="id" value="<?php echo $courseId; ?>">
                                <button type="submit" class="btn btn-secondary" name="delete" value="Delete">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else {
        echo "0 Result";
    }

    if (isset($_POST['delete'])) {
        $deleteId = $_POST['id'];
        $sql = "DELETE FROM course WHERE course_id = $deleteId";
        if ($conn->query($sql) === TRUE) {
            echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
        } else {
            echo "Unable to Delete Data";
        }
    }

    ?>
</div>
</div>

<script>
    function confirmDelete(courseId) {
        return confirm("Are you sure you want to delete this course?");
    }
</script>

<!-- div Row close from header -->
<div>
    <a class="btn btn-danger box" href="./addCourse.php"><i class="fas fa-plus fa-2x"></i> </a>
</div>
</div>

<?php
include('./admininclude/footer.php');
?>

