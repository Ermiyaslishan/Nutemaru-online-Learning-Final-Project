<!-- Start Header -->
<?php
include('./main/header.php');
if (!isset($_SESSION)) {
    session_start();
}
include_once './dbConnection.php';

if (isset($_SESSION['is_login'])) {
    $stuLogEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>
<!-- End Header -->

<!-- Start Course Page Banner -->
<div class="container-fluid bg-dark">
    <div class="row">
        <img src="images\My.png" alt="payment" style="height:500px; width: 100%; object-fit:cover; box-shadow:10px;" />
    </div>
</div>
<!-- End Course Page Banner -->

<!-- Start Main Content -->
<div class="container">
    <h2 class="text-center my-4">Payment Status</h2>
    <form method="post" action="">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="order-id" class="form-label">Order ID:</label>
                    <input type="text" class="form-control" id="order-id" name="order-id">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" style="margin-left:260px;">View</button>
                </div>
            </div>
        </div>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $order_id = $_POST['order-id'];

       
        $conn = new mysqli($db_host,$db_user,$db_password,$db_name);

        
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        
        $stmt = $conn->prepare('SELECT order_id, stu_email, amount, order_date FROM courseorder WHERE order_id = ?');
        $stmt->bind_param('s', $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        
        if ($result->num_rows > 0) {
            
            echo '<div class="row justify-content-center mt-4">';
            echo '<div class="col-md-6">';
            echo '<table class="table">';
            echo '<thead><tr><th>Order ID</th><th>Student Email</th><th>Amount</th><th>Order Date</th></tr></thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['order_id'] . '</td>';
                echo '<td>' . $row['stu_email'] . '</td>';
                echo '<td>' . $row['amount'] . '</td>';
                echo '<td>' . $row['order_date'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody></table>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="row justify-content-center mt-4">';
            echo '<div class="col-md-6">';
            echo '<p>No order found with the provided ID.</p>';
            echo '</div>';
            echo '</div>';
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
    ?>
</div>

<!-- Start Contact Us -->
<?php
include('./contact.php');
?>
<!-- End Contact Us -->

<!-- Footer -->
<?php
include('./main/footer.php')
?>
<!-- Footer -->
