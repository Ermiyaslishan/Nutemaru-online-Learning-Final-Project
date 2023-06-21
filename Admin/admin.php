<?php

if(!isset($_SESSION)){
    session_start();
}

include_once('../dbConnection.php');


//Admin login verificattion
if(!isset($_SESSION['is_admin_login'])){
if(isset($_POST['checkLogemail']) && isset($_POST['adminLogEmail']) && isset($_POST['adminLogPass'])) {
    $adminLogEmail = $_POST['adminLogEmail'];
    $adminLogPass = $_POST['adminLogPass'];
    $sql = "SELECT admin_email, admin_pass FROM admin WHERE admin_email ='".$adminLogEmail."' AND admin_pass='".$adminLogPass."'";
    $result = $conn->query($sql);

    $row = $result->num_rows;

    // if ($row === 1){
    //     echo json_encode($row);
    // } else if ($row === 0){
    //     echo json_encode($row);
    // }
    if ($row === 1){
        // $response = array('success' => true, 'message' => 'Login successful');
        
        $_SESSION['is_admin_login'] = true;
        $_SESSION['adminLogEmail'] = $adminLogEmail;
        echo json_encode($row);
    } else {
        echo json_encode($row);
        // $response = array('success' => false, 'message' => 'Invalid email or password');
    }
    // echo json_encode($response);
    
    
    }
}
?>