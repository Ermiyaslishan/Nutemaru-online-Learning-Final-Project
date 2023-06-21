<!-- Start Header -->
<?php 
if(!isset($_SESSION)) {
    session_start();
} 
include('./admininclude/header.php');

if(isset($_SESSION['is_admin_login'])){
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>
<!-- End Header -->

<div class="col-sm-6 mt-5 mx-auto">
    <form action="" class="mt-3 form-inline d-print-none" method="post">
        <div class="input-group">
            <input type="text" class="form-control" id="order-id" name="order-id" placeholder="Enter Order ID">
            <button type="submit" class="btn btn-danger ms-2">View</button>
        </div>
    </form>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $order_id = $_POST['order-id'];
  
    $db_host="localhost";
    $db_user="root";
    $db_password="";
    $db_name="nutemaruone";
    $conn = new mysqli($db_host,$db_user,$db_password,$db_name);

    
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    
    $stmt = $conn->prepare('SELECT order_id, stu_email, amount, order_date FROM courseorder WHERE order_id = ?');
    $stmt->bind_param('s', $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<div class="row justify-content-center mt-5">'; 
        echo '<div class="col-ms-6">';
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
        echo '<div class="row justify-content-center mb-5">'; 
        echo '<div class="col-md-s">';
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
<!-- Footer -->
<?php 
include('./admininclude/footer.php');
?>
<!-- Footer -->
