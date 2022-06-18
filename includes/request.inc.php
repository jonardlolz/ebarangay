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
    
<?php } if(isset($_GET['disapproveReport'])){ ?>

<div class="container-fluid">
    <form action="includes/request.inc.php?disapproveID=<?php echo $_GET['RequestID'] ?>" method="POST">
        <div class="row">
            <div class="col">
                <p>Report Message: </p>
            </div>
            <div class="col-sm-8">
                <textarea name="reportMessage" id="reportMessage" class="form-control" rows="3" style="resize:none;" required></textarea>
            </div>
        </div>
        <hr>
        <div class="footer d-flex flex-row-reverse">
            <button class="btn btn-primary">Send Report</button>
        </div>
    </form>
</div>
<script>
    $(".container-fluid").parent().siblings(".modal-footer").remove();
</script>
<?php } 
if(isset($_GET["addRequest"])){
    extract($_POST);
    if($_SESSION['userType'] == 'Purok Leader' || $_SESSION['userType'] == 'Treasurer' || $_SESSION['userType'] == 'Secretary' || $_SESSION['userType'] == 'Councilor' || $_SESSION['userType'] == 'Captain' ){
        $sql = $conn->query("SELECT * FROM documenttype WHERE DocumentID=$document");
        $data = $sql->fetch_assoc();

        $userType = 'Purok Leader';
        if($data['documentName'] == 'Cedula'){
            $amount = 5 + ($monthlySalary / 1000);
        }
        else{
            $amount = $data['docPrice'];
        }
        
        mysqli_begin_transaction($conn);

        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('A new request is ready for payment', 'request', 'Treasurer')");
        $a1 = mysqli_query($conn, "INSERT INTO request (UsersID, userBarangay, userPurok, status, documentType, purpose, amount, userType)
        SELECT {$_SESSION['UsersID']}, userBarangay, userPurok, 'Approved', '{$data['documentName']}', '$purpose', $amount, 'Treasurer'
        FROM users
        WHERE users.UsersID = {$_SESSION['UsersID']};");
        

        if($a2 && $a1){
            if(isset($img)){
                $id = mysqli_insert_id($conn);
                echo $id;
                mkdir('../img/erequest/'.$id);
                for($i = 0 ; $i< count($img);$i++){
                    list($type, $img[$i]) = explode(';', $img[$i]);
                    list(, $img[$i])      = explode(',', $img[$i]);
                    $img[$i] = str_replace(' ', '+', $img[$i]);
                    $img[$i] = base64_decode($img[$i]);
                    $fname = strtotime(date('Y-m-d H:i'))."_".$imgName[$i];
                    $upload = file_put_contents('../img/erequest/'.$id.'/'.$fname,$img[$i]);
                    $data = " file_path = '".$fname."' ";
                }
            }

            mysqli_commit($conn);
            if($_SESSION['userType'] == 'Treasurer'){
                header("location: ../payment.php?error=none"); 
                exit();
            }
            header("location: ../request.php?error=none"); 
            exit();
        }
        else{
            mysqli_rollback($conn);
            header("location: ../request.php?error=error"); 
            exit();
        }
    }
    else{
        $sql = $conn->query("SELECT * FROM documenttype WHERE DocumentID=$document");
        $data = $sql->fetch_assoc();

        $userType = 'Purok Leader';
        if($data['documentName'] == 'Cedula'){
            $amount = 5 + ($monthlySalary / 1000);
        }
        else{
            $amount = $data['docPrice'];
        }
        
        mysqli_begin_transaction($conn);

        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('A resident has requested a {$data['documentName']}', 'request', '$userType')");
        $a1 = mysqli_query($conn, "INSERT INTO request (UsersID, userBarangay, userPurok, documentType, purpose, amount, userType)
        SELECT {$_SESSION['UsersID']}, userBarangay, userPurok, '{$data['documentName']}', '$purpose', $amount, 'Purok Leader'
        FROM users
        WHERE users.UsersID = {$_SESSION['UsersID']};");
        

        if($a2 && $a1){
            if(isset($img)){
                $id = mysqli_insert_id($conn);
                echo $id;
                mkdir('../img/erequest/'.$id);
                for($i = 0 ; $i< count($img);$i++){
                    list($type, $img[$i]) = explode(';', $img[$i]);
                    list(, $img[$i])      = explode(',', $img[$i]);
                    $img[$i] = str_replace(' ', '+', $img[$i]);
                    $img[$i] = base64_decode($img[$i]);
                    $fname = strtotime(date('Y-m-d H:i'))."_".$imgName[$i];
                    $upload = file_put_contents('../img/erequest/'.$id.'/'.$fname,$img[$i]);
                    $data = " file_path = '".$fname."' ";
                }
            }

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
    
}
elseif(isset($_GET["release"])){
    $id = $_POST['id'];

    $requestRes = $conn->query("
    SELECT request.*, users.Firstname, users.Lastname, users.emailAdd, users.phoneNum
    FROM request 
    INNER JOIN users 
    ON request.UsersID = users.UsersID
    WHERE requestID = {$id};
    ");
    $requestData = $requestRes->fetch_assoc();

    $userType = "Secretary";
    $status = "Released";

    $approvedBy = $_SESSION['Lastname'].', '.$_SESSION['Firstname'];

    mysqli_begin_transaction($conn);

    $reportMessage = "Secretary ". $_SESSION['Lastname'] . "," . $_SESSION['Firstname'] . " has released the RequestID#$id";
    $requestUrl = $resData["data"]["checkouturl"];
    $a1 = mysqli_query($conn, "INSERT INTO requestreport(RequestID, officerID, reportMessage, reportStatus, amount) VALUES($id, {$_SESSION['UsersID']}, '$reportMessage', 'Released', {$requestData['amount']});");
    $a2 = mysqli_query($conn, "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy='$approvedBy', status='$status', request.userType='$userType' WHERE RequestID=$id");
    $a3 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID, position) VALUES('Your request for {$requestData['documentType']} has been claimed!', 'request', {$requestData['UsersID']}, 'Resident')");

    if(1){
        mysqli_commit($conn);
        header("location: ../request.php?error=none"); //no errors were made
        exit();
    }
    else{
        echo("Error description: ".mysqli_error($conn));
        mysqli_rollback($conn);
        // header("location: ../request.php?error=error"); //no errors were made
        // exit();
    }
}
elseif(isset($_GET['additionalInput'])){
    $sql = $conn->query("SELECT * FROM documenttype WHERE DocumentID={$_GET['DocumentID']}");
    $result = "";
    $data = $sql->fetch_assoc();

    if($data['documentName'] == 'Cedula'){
        $result .= "<label>Enter annual salary: </label><input class='form-control' style='width: 75%' type='text' name='monthlySalary' id='monthlySalary' required>";
    }
    else{
        if($data['allowFee'] == 'True'){
            $result .= "<p>Price: <b>". $data['docPrice'] ."</b></p>";
        }
        else{
            $result .= "<p>Price: <b>Free</b></p>";
        }
    }
    
    echo $result;
}
elseif(isset($_GET["approveID"])){
    $id = $_POST['id'];

    $requestRes = $conn->query("
    SELECT request.*, users.Firstname, users.Lastname, users.emailAdd, users.phoneNum, users.userType
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
        $a1 = mysqli_query($conn, "INSERT INTO requestreport(RequestID, officerID, reportMessage, reportStatus, amount) VALUES($id, {$_SESSION['UsersID']}, '$reportMessage', 'Approved', {$requestData['amount']});");
        $a2 = mysqli_query($conn, "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy='{$approvedBy}', status='{$status}', request.userType='{$userType}', requesturl='{$requestUrl}' WHERE RequestID=$id");
        $a3 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID, position) VALUES('The purok leader has approved your request for {$requestData['documentType']}. Please process the payment.', 'request', '{$requestData['UsersID']}', 'Resident')");
        $a4 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('A new request is ready for payment', 'request', 'Treasurer')");

        
        if($a1 && $a2 && $a3 && $a4){
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
    else{
        mysqli_begin_transaction($conn);
        
        $userType = "Secretary";
        $status = "Paid";
        $paymentStatus = "Paid";

        $approvedBy = $_SESSION['Lastname'].', '.$_SESSION['Firstname'];

        $reportMessage = "Purok Leader ". $_SESSION['Lastname'] . "," . $_SESSION['Firstname'] . " has approved the RequestID # ". $id;
        $a1 = mysqli_query($conn, "INSERT INTO requestreport(RequestID, officerID, reportMessage, reportStatus, amount) VALUES($id, {$_SESSION['UsersID']}, '$reportMessage', 'Approved', {$requestData['amount']});");
        $a2 = mysqli_query($conn, "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy='$approvedBy', status='{$status}', request.userType='$userType' WHERE RequestID=$id");
        $a3 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID, position) VALUES('The purok leader has approved your request for {$requestData['documentType']}. It is now ready for release.', 'request', {$requestData['UsersID']},'{$requestData['userType']}')");
        $a4 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('A new request is ready for release!', 'request', 'Secretary')");

        
        if($a1 && $a2 && $a3 && $a4){
            mysqli_commit($conn);
            header("location: ../request.php?error=none"); //no errors were made
            exit();
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
            // header("location: ../request.php?error=error"); //no errors were made
            // exit();
        }
    }
}
elseif(isset($_GET["disapproveID"])){
    extract($_POST);
    $id = $_GET['disapproveID'];

    $requestRes = $conn->query("
    SELECT request.*, users.Firstname, users.Lastname, users.emailAdd, users.phoneNum
    FROM request 
    INNER JOIN users 
    ON request.UsersID = users.UsersID
    WHERE requestID = {$id};
    ");
    $requestData = $requestRes->fetch_assoc();

    $approvedBy = $_SESSION['Firstname'].' '.$_SESSION['Lastname'];

    $a1 = mysqli_query($conn, "INSERT INTO requestreport(RequestID, officerID, reportMessage, reportStatus, amount, barangay, purok) VALUES($id, {$_SESSION['UsersID']}, '$reportMessage', 'Disapproved', {$requestData['amount']}, '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}');");
    $a2 = mysqli_query($conn, "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy='{$approvedBy}', status='Disapproved', request.userType='Purok Leader' WHERE RequestID=$id");
    $a3 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID, position) VALUES('The purok leader has disapproved your request for {$requestData['documentType']}. Reason: $reportMessage', 'request', '{$requestData['UsersID']}', 'Resident')");

    
    if($a1 && $a2 && $a3){
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

    $requestRes = $conn->query("
    SELECT request.*, users.Firstname, users.Lastname, users.emailAdd, users.phoneNum
    FROM request 
    INNER JOIN users 
    ON request.UsersID = users.UsersID
    WHERE requestID = {$id};
    ");
    $requestData = $requestRes->fetch_assoc();

    $approvedBy = "'".$_SESSION['Lastname']. ', ' . $_SESSION['Firstname']."'";
    
    mysqli_begin_transaction($conn);
    $reportMessage = "Treasurer ". $_SESSION['Lastname'] . "," . $_SESSION['Firstname'] . " has confirmed the payment for RequestID# ". $id;
    $a1 = mysqli_query($conn, "INSERT INTO requestreport(RequestID, officerID, reportMessage, reportStatus, amount) VALUES($id, {$_SESSION['UsersID']}, '$reportMessage', 'Paid', {$requestData['amount']});");
    $a2 = mysqli_query($conn, "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy=$approvedBy, status='Paid', request.userType='Secretary' WHERE RequestID=$id");
    $a3 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('A new request is ready for release!', 'request', 'Secretary')");
    $a4 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID, position) VALUES('Your {$requestData['documentType']} is now ready for release! Please claim it at the barangay hall.', 'request', '{$requestData['UsersID']}','Resident')");

    if($a1 && $a2 && $a3 && $a4){
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
if(isset($_GET['unpaid'])){
    extract($_POST);

    $requestRes = $conn->query("
    SELECT request.*, users.Firstname, users.Lastname, users.emailAdd, users.phoneNum
    FROM request 
    INNER JOIN users 
    ON request.UsersID = users.UsersID
    WHERE requestID = {$id};
    ");
    $requestData = $requestRes->fetch_assoc();

    $approvedBy = "'".$_SESSION['Lastname']. ', ' . $_SESSION['Firstname']."'";
    
    mysqli_begin_transaction($conn);
    $reportMessage = "Treasurer ". $_SESSION['Lastname'] . "," . $_SESSION['Firstname'] . " has cancelled the payment for RequestID#$id due to overdue payment.";
    $a1 = mysqli_query($conn, "INSERT INTO requestreport(RequestID, officerID, reportMessage, reportStatus, amount) VALUES($id, {$_SESSION['UsersID']}, '$reportMessage', 'Unpaid', {$requestData['amount']});");
    $a2 = mysqli_query($conn, "UPDATE request SET approvedOn=CURRENT_TIMESTAMP, approvedBy=$approvedBy, status='Cancelled', request.userType='Treasurer' WHERE RequestID=$id");
    $a4 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID, position) VALUES('Your {$requestData['documentType']} is has been cancelled for not paying in time.', 'request', '{$requestData['UsersID']}', 'Resident')");

    if($a1 && $a2 && $a4){
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

if(isset($_GET['viewRequirement'])): 
    $gal = scandir('../img/erequest/'.$_GET['RequestID']);
    unset($gal[0]);
    unset($gal[1]);
    $count =count($gal);
    $i = 0;?>
        
        <style>
            .slide img,.slide video{
                max-width:100%;
                max-height:100%;
            }
            #uni_modal .modal-footer{
                display:none
            }
        </style>
        <script src="./vendor/ekko-lightbox/ekko-lightbox.min.js"></script>
        <?php 
        $documentSql=$conn->query("SELECT * FROM request INNER JOIN documenttype ON documenttype.documentName=request.documentType AND documenttype.BarangayName='{$_SESSION['userBarangay']}' WHERE RequestID={$_GET['RequestID']}")->fetch_assoc(); 
        $userSql=$conn->query("SELECT * FROM users WHERE UsersID={$documentSql['UsersID']}")->fetch_assoc();
        $requirementsSql=$conn->query("SELECT * FROM requirementlist WHERE DocumentID={$documentSql['DocumentID']}");
        ?>
        <div class="container-fluid" style="height:75vh">
            <div class="row h-100">
                <div class="col-lg-7 bg-dark h-100">
                    <div class="d-flex h-100 w-100 position-relative justify-content-between align-items-center">
                        <a href="javascript:void(0)" id="prev" class="position-absolute d-flex justify-content-center align-items-center" style="left:0;width:calc(15%);z-index:1"><h4><div class="fa fa-angle-left"></div></h4></a>
                        <?php
                            foreach($gal as $k => $v):
                                $mime = mime_content_type('../img/erequest/'.$_GET['RequestID'].'/'.$v);
                                $i++;
                        ?>
                        <div class="slide w-100 h-100 <?php echo ($i == 1) ? "d-flex" : 'd-none' ?> align-items-center justify-content-center" data-slide="<?php echo $i ?>">
                        <?php if(strstr($mime,'image')): ?>
                            <img src="./img/erequest/<?php echo $_GET['RequestID'].'/'.$v ?>" class="" alt="Image 1">
                        <?php else: ?>
                            <video controls class="">
                                    <source src="./img/erequest/<?php echo $_GET['RequestID'].'/'.$v ?>" type="<?php echo $mime ?>">
                            </video>
                        <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                        <a href="javascript:void(0)" id="next" class="position-absolute d-flex justify-content-center align-items-center" style="right:0;width:calc(15%);z-index:1"><h4><div class="fa fa-angle-right"></div></h4></a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex flex-row">
                        Requirements for 
                    </div>
                    <div class="d-flex flex-row">
                        <b><?php echo $documentSql['documentType'] ?></b>
                    </div>
                    <div class="d-flex flex=row">
                        <ul>
                            <?php if($documentSql['requireLessorNote'] == 'True'): ?>
                                <?php if($userSql['isRenting']): ?>
                                    <li>Lessor note</li>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php while($row = $requirementsSql->fetch_assoc()): ?>
                            <li><?php echo $row['requirementName'] ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php if($documentSql['status'] == 'Pending' && $_SESSION['userType'] == 'Purok Leader'): ?>
        <div class="footer d-flex flex-row-reverse">
            <button class="btn btn-sm btn-success approve_document" data-id="<?php echo $_GET['RequestID'] ?>"><i class="fas fa-check"></i> Approve</button>
            <button class="btn btn-sm btn-danger report_disapprove" data-id="<?php echo $_GET['RequestID'] ?>"><i class="fas fa-times"></i> Disapprove</button>
        </div>
        <?php endif; ?>
    </div>
    <script>
        window.secondary_modal = function($title = '' , $url='',$size=""){
            start_load()
            $.ajax({
                url:$url,
                error:err=>{
                    console.log()
                    alert("An error occured")
                },
                success:function(resp){
                    if(resp){
                        $('#secondary_modal .modal-title').html($title)
                        $('#secondary_modal .modal-body').html(resp)
                        if($size != ''){
                            $('#secondary_modal .modal-dialog').addClass($size)
                        }else{
                            $('#secondary_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                        }
                        $('#secondary_modal').modal({
                        show:true,
                        backdrop:'static',
                        keyboard:false,
                        focus:true
                        })
                        end_load()
                    }
                }
            })
        }

        $('#next').click(function(){
            var cslide = $('.slide:visible').attr('data-slide')
            if(cslide == '<?php echo $i ?>'){
                return false;
            }
            $('.slide:visible').removeClass('d-flex').addClass("d-none")
            $('.slide[data-slide="'+(parseInt(cslide) + 1)+'"]').removeClass('d-none').addClass('d-flex')
        })
        $('#prev').click(function(){
            var cslide = $('.slide:visible').attr('data-slide')
            if(cslide == 1){
                return false;
            }
            $('.slide:visible').removeClass('d-flex').addClass("d-none")
            $('.slide[data-slide="'+(parseInt(cslide) - 1)+'"]').removeClass('d-none').addClass('d-flex')
        })
        $('.comment-textfield').on('keypress', function (e) {
            if(e.which == 13 && e.shiftKey == false){
                var post_id = $(this).attr('data-id')
                var comment = $(this).val()
                $(this).val('')
                $.ajax({
                    url:'includes/comment.inc.php',
                    method:'POST',
                    data:{post_id:post_id,comment:comment},
                    success:function(){
                        location.reload();
                    }
                })
                return false;
                }
        })
        $('.comment-textfield').on('change keyup keydown paste cut', function (e) {
            if(this.scrollHeight <= 117)
            $(this).height(0).height(this.scrollHeight);
        })

        $('.approve_document').click(function(){
            _conf("Are you sure you want to approve this document?", "approve_document", [$(this).attr('data-id')])
        })

        function approve_document($id){
            start_load()
            $.ajax({
                url:'includes/request.inc.php?approveID',
                method:'POST',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }

        $('.report_disapprove').click(function(){
            secondary_modal("Requirements given","includes/request.inc.php?disapproveReport&RequestID="+$(this).attr('data-id'), "modal-md");
        })

        function report_disapprove($id){
            start_load()
            $.ajax({
                url:'includes/request.inc.php?disapproveID',
                method:'POST',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }
    </script>

<?php endif; ?>