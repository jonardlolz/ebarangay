<?php

session_start();
include_once 'dbh.inc.php';

if(isset($_POST["submit"]))
{
    
    $notif = $conn->query("SELECT * FROM request WHERE UsersID={$_SESSION['UsersID']} AND status='Pending'");
    $row_cnt = mysqli_num_rows($notif);
    if($row_cnt >= 1){
        header("location: ../request.php?error=pendingReq");
        exit();
    }
                

    $document = $_POST["document"];
    $purpose = $_POST["purpose"];
    $modeofPayment = $_POST["modeofPayment"];
    $amount = 0;
    if($document == "Barangay Clearance"){
        $userType = "Secretary";
    }
    else if($document == "Cedula"){
        $userType = "Purok Leader";
    }
    mysqli_begin_transaction($conn);

    $a1 = mysqli_query($conn, "INSERT INTO request (UsersID, userBarangay, userPurok, documentType, paymentMode, purpose, amount, userType)
    SELECT {$_SESSION['UsersID']}, userBarangay, userPurok, '$document', '$modeofPayment', '$purpose', $amount, '$userType'
    FROM users
    WHERE users.UsersID = {$_SESSION['UsersID']};");
    $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('A resident has requested a $document', 'request', '$userType')");

    if($a2 && $a1){
        mysqli_commit($conn);
        header("location: ../request.php?error=none"); 
        exit();
    }
    else{
        mysqli_rollback($conn);
        header("location: ../request.php?error=error"); 
        exit();
    }
    /*$sql = "INSERT INTO request (UsersID, userBarangay, userPurok, documentType, paymentMode, purpose, amount, userType)
    SELECT ?, userBarangay, userPurok, ?, ?, ?, ?, ?
    FROM users
    WHERE users.UsersID = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailedcreatepost");
        exit(); 
    }

    mysqli_stmt_bind_param($stmt, "sssssss", $_SESSION["UsersID"], $document, $modeofPayment, $purpose, $amount, $userType, $_SESSION["UsersID"]); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../request.php?error=none"); //no errors were made
    exit();*/
}
elseif(isset($_GET["approveID"])){
    $id = $_GET["approveID"];

    $approvedBy = "'".$_SESSION['Lastname']. ', ' . $_SESSION['Firstname']."'";
    if($_SESSION['userType'] == 'Purok Leader'){
        $userType = "Purok Leader";
        $status = "Approved";
        $paymentStatus = 'Not Paid';
    }
    else if($_SESSION['userType'] == 'Secretary'){
        $userType = "Treasurer";
        $status = "Approved";
        $paymentStatus = 'Not Paid';
    }
    else if($_SESSION['userType'] == 'Treasurer'){
        $userType = "Treasurer";
        $status = "Released";
        $paymentStatus = "Paid";
    }
    /*$sql = "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy=$approvedBy, status='{$status}', request.userType='{$userType}', paymentStatus='{$paymentStatus}' WHERE RequestID=$id";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }
 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../request.php?error=none"); //no errors were made
    exit();*/

    mysqli_begin_transaction($conn);

    $reportMessage = "Treasurer ". $_SESSION['Lastname'] . "," . $_SESSION['Firstname'] . " has released the RequestID#".$id;

    $a1 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('Request', '{$reportMessage}', '{$_SESSION['UsersID']}', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}');");
    $a2 = mysqli_query($conn, "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy=$approvedBy, status='{$status}', request.userType='{$userType}', paymentStatus='{$paymentStatus}' WHERE RequestID=$id");

    if($a1 && $a2){
        mysqli_commit($conn);
        header("location: ../request.php?error=none"); //no errors were made
        exit();
    }
    else{
        mysqli_rollback($conn);
        header("location: ../request.php?error=error"); //no errors were made
        exit();
    }
}
elseif(isset($_GET["declineID"])){
    $id = $_GET["declineID"];

    $approvedBy = "'".$_SESSION['Lastname']. ', ' . $_SESSION['Firstname']."'";
    
    $sql = "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy=$approvedBy, status='Declined' WHERE RequestID=$id";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }
 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../request.php?error=none"); //no errors were made
    exit();

    
}

?>