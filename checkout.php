<?php
session_start();
require_once './dbConnection.php';

if (!isset($_SESSION['stuLogEmail'])) {
    header("Location: studentRegistration.php");
    exit();
}

$stuEmail = $_SESSION['stuLogEmail'];

$sql ="SELECT * FROM student WHERE stu_email = '$stuEmail'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <title>Checkout</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 jumbotron">
                <h3 class="mb-5">Welcome to NuTemaru Payment Page</h3>
                <form method="post" action="./paymentdone.php">
                    <div class="form-group row">
                        <label for="ORDER_ID" class="col-sm-4 col-form-label">Order ID</label>
                        <div class="col-sm-8">
                            <input id="ORDER_ID" class="form-control" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo "ORDS" . rand(10000, 99999999) ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="CUST_ID" class="col-sm-4 col-form-label">Student Email</label>
                        <div class="col-sm-8">
                            <input id="CUST_ID" class="form-control" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $stuEmail; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="TXN_AMOUNT" class="col-sm-4 col-form-label">Amount</label>
                        <div class="col-sm-8">
                            <input title="TXN_AMOUNT" class="form-control" tabindex="10" type="text" name="TXN_AMOUNT" value="<?php if (isset($_POST['id'])) { echo $_POST['id']; } ?>" readonly>
                        </div>
                    </div>

                    

                    <div class="text-center">
                                          <!-- Add the following HTML code to your page where you want the PayPal button to appear -->
    <div id="paypal-button-container"></div>
                        
                        <div class="d-grid col-25">
             <a href="./course.php" class="btn btn-primary" style="margin-left: -2px">Cancel</a>
                   </div>
                    </div>
                </form>
                <small class="form-text text-muted">Note: Complete Payment by Clicking Checkout Button</small>

            </div>
        </div>
    </div>

    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <script src="https://www.paypal.com/sdk/js?client-id=AdH8FHGF-P3XU-1LgS09jvfd3gStbOSEuR2NN2M2ujwd9fjg1zqr_U2j5Et4lqz9xHooCPTZcbfX0C56&currency=USD"></script>



    <!-- Jquery and Boostrap JavaScript -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- Font Awesome JS -->
    <script type="text/javascript" src="js/all.min.js"></script>
    <!-- Custom JavaScript -->
    <script type="text/javascript" src="js/custom.js"></script>
    <script>
        // Set up the transaction
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $_POST['id']; ?>'
                        }
                    }]
                });
            },
            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    alert('Transaction completed by ' + details.payer.name.given_name + '!');
                    document.querySelector('form').submit();
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>





