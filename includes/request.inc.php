<?php

session_start();
include_once 'dbh.inc.php';

if(isset($_GET["continueRequest"])){ ?>
    <?php $sql = $conn->query("SELECT * FROM documenttype WHERE DocumentID={$_GET['docType']}"); 
        $document = $sql->fetch_assoc();
    ?>
    <form action="includes/request.inc.php?addRequest" method="POST">
        <div class="container-fluid">
            <div class="row">
                <div class="col" style="text-align: right;">
                    Document type:
                </div>
                <div class="col">
                    <b><?php echo $document['documentName'] ?></b>
                    <input type="hidden" name="document" value="<?php echo $document['documentName'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col" style="text-align: right;">
                    Purpose:
                </div>
                <div class="col">
                    <b><?php echo $_GET['purpose'] ?></b>
                    <input type="hidden" name="purpose" value="<?php echo $_GET['purpose'] ?>">
                </div>
            </div>
            <?php if($document['documentName'] == 'Cedula'): ?>
            <div class="row">
                <div class="col" style="text-align: right;">
                    Enter monthly Salary:
                </div>
                <div class="col">
                    <input type="text" name="monthlySalary" id="monthlySalary">
                </div>
            </div>
            <?php elseif($document['allowFee'] == 'True'): ?>
            <div class="row">
                <div class="col" style="text-align: right;">
                    Price:
                </div>
                <div class="col">
                    <input type="text" name="price" id="price" value="<?php echo $document['docPrice'] ?>" readonly>
                </div>
            </div>
            <?php elseif($document['allowFee'] == 'False'): ?>
            <div class="row">
                <div class="col" style="text-align: right;">
                    Price:
                </div>
                <div class="col">
                    <input type="text" name="price" id="price" value="0" readonly>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </form>
<?php } 
if(isset($_GET["addRequest"])){
    extract($_POST);
    $notif = $conn->query("SELECT * FROM request WHERE UsersID={$_SESSION['UsersID']} AND status='Pending'");
    $row_cnt = mysqli_num_rows($notif);
    if($row_cnt >= 1){
        header("location: ../request.php?error=pendingReq");
        exit();
    }
    $userType = 'Purok Leader';
    if($document == 'Cedula'){
        $amount = 5 + ($monthlySalary / 1000);
    }
    else{
        $amount = $price;
    }
    
    mysqli_begin_transaction($conn);

    $a1 = mysqli_query($conn, "INSERT INTO request (UsersID, userBarangay, userPurok, documentType, purpose, amount, userType)
    SELECT {$_SESSION['UsersID']}, userBarangay, userPurok, '$document', '$purpose', $amount, '$userType'
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
}
elseif(isset($_GET["release"])){
    $id = $_POST['id'];

    $userType = "Secretary";
    $status = "Released";

    $approvedBy = $_SESSION['Lastname'].', '.$_SESSION['Firstname'];

    mysqli_begin_transaction($conn);

    $reportMessage = "Secretary ". $_SESSION['Lastname'] . "," . $_SESSION['Firstname'] . " has released the RequestID # ". $id;
    $requestUrl = $resData["data"]["checkouturl"];
    $a1 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('Request', '{$reportMessage}', '{$_SESSION['UsersID']}', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}');");
    $a2 = mysqli_query($conn, "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy='{$approvedBy}', status='{$status}', request.userType='{$userType}' WHERE RequestID=$id");

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

// elseif(isset($_GET['release'])){
//     extract($_POST);

//     $userType = "Treasurer";
//     $status = "Releasing";
//     $paymentStatus = "Not Paid";
//     $approvedBy = $_SESSION['Lastname'].', '.$_SESSION['Firstname'];
    
//     mysqli_begin_transaction($conn);

//     $reportMessage = "Secretary ". $_SESSION['Lastname'] . "," . $_SESSION['Firstname'] . " has released the RequestID # ". $id;
//     $requestUrl = $_POST['checkouturl'];
//     if($id == NULL){
//         header('HTTP/1.1 500 Internal Server Booboo');
//         header('Content-Type: application/json; charset=UTF-8');
//         die(json_encode(array('message' => 'id is null', 'code' => 1337)));
//     }
//     if($requestUrl == NULL){
//         header('HTTP/1.1 500 Internal Server Booboo');
//         header('Content-Type: application/json; charset=UTF-8');
//         die(json_encode(array('message' => $requestUrl, 'code' => 1337)));
//     }
//     $a1 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('Request', '{$reportMessage}', '{$_SESSION['UsersID']}', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}');");
//     $a2 = mysqli_query($conn, "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy='{$approvedBy}', status='{$status}', request.userType='{$userType}', requesturl='{$requestUrl}' WHERE RequestID=$id");

//     if($a1 && $a2){
//         mysqli_commit($conn);
//         header("location: ../request.php?error=none"); //no errors were made
//         exit();
//     }
//     else{
//         mysqli_rollback($conn);
//         header("location: ../request.php?error=error"); //no errors were made
//         exit();
//     }

// }
elseif(isset($_GET['success'])){
    echo "Success!";
}

elseif(isset($_GET["approveID"])){
    $id = $_GET['approveID'];

    $requestRes = $conn->query("
    SELECT request.*, users.Firstname, users.Lastname, users.emailAdd, users.phoneNum
    FROM request 
    INNER JOIN users 
    ON request.UsersID = users.UsersID
    WHERE requestID = {$id};
    ");
    $requestData = $requestRes->fetch_assoc();

    if($requestData['amount'] > 0){
            
        $userType = "Treasurer";
        $status = "Approved";
        $paymentStatus = "Not Paid";
        if($id == NULL){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'id is null', 'code' => 1337)));
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://g.payx.ph/payment_request',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'x-public-key' => 'pk_09ccebf180b94c18cb0f400c00f6282e',
            'amount' => $requestData['amount'],
            'description' => 'Payment for services rendered',
            'customername' => $requestData['Firstname']. " " .$requestData['Lastname'],
            'customeremail' => $requestData['emailAdd'],
            'customermobile' => $requestData['phoneNum']
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $resData = json_decode($response, true, 4);

        echo $resData["data"]["checkouturl"];

        print_r($resData);

        $approvedBy = $_SESSION['Lastname'].', '.$_SESSION['Firstname'];

        mysqli_begin_transaction($conn);

        $reportMessage = "Purok Leader ". $_SESSION['Lastname'] . "," . $_SESSION['Firstname'] . " has approved the RequestID # ". $id;
        $requestUrl = $resData["data"]["checkouturl"];
        if($requestUrl == NULL){
            header('HTTP/1.1 500 Internal Server Booboo');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => $requestUrl, 'code' => 1337)));
        }
        $a1 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('Request', '{$reportMessage}', '{$_SESSION['UsersID']}', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}');");
        $a2 = mysqli_query($conn, "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy='{$approvedBy}', status='{$status}', request.userType='{$userType}', requesturl='{$requestUrl}' WHERE RequestID=$id");
    }
    else{
        mysqli_begin_transaction($conn);
        
        $userType = "Secretary";
        $status = "Paid";
        $paymentStatus = "Paid";

        $reportMessage = "Purok Leader ". $_SESSION['Lastname'] . "," . $_SESSION['Firstname'] . " has approved the RequestID # ". $id;
        $a1 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('Request', '{$reportMessage}', '{$_SESSION['UsersID']}', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}');");
        $a2 = mysqli_query($conn, "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy='{$approvedBy}', status='{$status}', request.userType='{$userType}' WHERE RequestID=$id");
    }

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
if(isset($_GET['paid'])){
    extract($_POST);

    $approvedBy = "'".$_SESSION['Lastname']. ', ' . $_SESSION['Firstname']."'";
    
    mysqli_begin_transaction($conn);
    $reportMessage = "Treasurer ". $_SESSION['Lastname'] . "," . $_SESSION['Firstname'] . " has confirmed the payment for RequestID# ". $id;
    $a1 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('Request', '{$reportMessage}', '{$_SESSION['UsersID']}', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}');");
    $a2 = mysqli_query($conn, "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy=$approvedBy, status='Paid', request.userType='Secretary' WHERE RequestID=$id");

    if($a2){
        mysqli_commit($conn);
        header("location: ../request.php?error=none"); //no errors were made
        exit();
    }
    else{
        mysqli_rollback($conn);
        header("location: ../request.php?error=error"); //no errors were made
        exit();
    }

    // $sql = "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy=$approvedBy, userType='Secretary', status='Paid' WHERE RequestID=$id";
    // $stmt = mysqli_stmt_init($conn);
    // if(!mysqli_stmt_prepare($stmt, $sql)){
    //     echo("Error description: " . mysqli_error($conn));
    //     exit();
    // }
 
    // mysqli_stmt_execute($stmt);
    // mysqli_stmt_close($stmt);

    // header("location: ../request.php?error=none"); //no errors were made
    // exit();
}

?>