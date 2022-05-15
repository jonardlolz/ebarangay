<?php
    include_once "dbh.inc.php";
    session_start();
    extract($_POST);

    if(isset($_POST["submit"])){        
        $postsql = $conn->query("SELECT * FROM ereklamocategory WHERE reklamoCatName='{$_POST['reklamotype']}' AND reklamoCatBrgy='{$_SESSION['userBarangay']}'");
        $postreklamo = $postsql->fetch_assoc();
        if($postreklamo['reklamoCatPriority'] == "Minor"){
            mysqli_begin_transaction($conn);

            $a1 = mysqli_query($conn, "INSERT INTO ereklamo(UsersID, reklamoType, detail, status, comment, complainee, complaintLevel, barangay, purok) VALUES({$_SESSION["UsersID"]}, '{$_POST['reklamotype']}', '{$_POST['detail']}', 'Pending', '{$_POST['comment']}', 'N/A', '{$postreklamo['reklamoCatPriority']}', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");
            $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('Resident {$_SESSION['Lastname']}, {$_SESSION['Firstname']} has sent a reklamo!', 'ereklamo', 'Purok Leader')");

            if($a1 && $a2){
                mysqli_commit($conn);
                header("location: ../ereklamo.php?error=none"); 
                exit();
            }
            else{
                echo("Error description: " . mysqli_error($conn));
                mysqli_rollback($conn);
                exit();
            }
        }
        else if($postreklamo['reklamoCatPriority'] == "Major"){
            mysqli_begin_transaction($conn);

            $a1 = mysqli_query($conn, "INSERT INTO ereklamo(UsersID, reklamoType, detail, status, comment, complainee, complaintLevel, barangay, purok) VALUES({$_SESSION['UsersID']}, '{$_POST['reklamotype']}', '{$_POST['detail']}', 'Pending', '{$_POST['comment']}', '{$_POST['resident']}', '{$postreklamo['reklamoTypePriority']}', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");
            $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('Resident {$_SESSION['Lastname']}, {$_SESSION['Firstname']} has sent a reklamo!', 'ereklamo', 'Purok Leader')");

            if($a1 && $a2){
                mysqli_commit($conn);
                header("location: ../ereklamo.php?error=none"); 
                exit();
            }
            else{
                echo("Error description: " . mysqli_error($conn));
                mysqli_rollback($conn);
                exit();
            }
        }
    }

    else if(isset($_GET["resolvedID"])){
        $id = $_GET["resolvedID"];
        $usersID = $_GET['usersID'];
        $currentUser = $_SESSION['UsersID'];
        $userType = $_SESSION['userType'];
        $Firstname = $_SESSION['Firstname'];
        $userBarangay = $_SESSION['userBarangay'];
        $userPurok = $_SESSION['userPurok'];

        $managedBy = "'".$_SESSION['Lastname']. ', ' . $_SESSION['Firstname']."'";

        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
        status='Resolved' WHERE ReklamoID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position, UsersID) VALUES(
  	    'Your eReklamo#$id has been resolved by $userType $Firstname.', 'ereklamo', 'Resident', $usersID);");
        $a3 = mysqli_query($conn, "INSERT INTO report(reportType, reportMessage, UsersID, userBarangay, userPurok) VALUES(
  	    'eReklamo','$userType $Firstname has resolved ereklamo#$id', '$currentUser', '$userBarangay',
          '$userPurok');");

        if($a1 && $a2 && $a3){
            mysqli_commit($conn);
            if($_SESSION['barangayPos'] != "None"){
                header("location: ../respondent.php?error=none"); 
                exit();
            }
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
        }
    }
    else if(isset($_GET['accept'])){
        $id = $_GET["reklamoid"];
        $usersID = $_GET['usersID'];
        $currentUser = $_SESSION['UsersID'];
        $userType = $_SESSION['userType'];
        $Firstname = $_SESSION['Firstname'];
        $userBarangay = $_SESSION['userBarangay'];
        $userPurok = $_SESSION['userPurok'];

        $managedBy = "'".$_SESSION['Lastname']. ', ' . $_SESSION['Firstname']."'";

        $ereklamosql=$conn->query("SELECT * FROM ereklamo WHERE ReklamoID=$id");
        $ereklamodata=$ereklamosql->fetch_assoc();


        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
        status='Accepted' WHERE ReklamoID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position, UsersID) VALUES(
  	    'Your eReklamo#$id has been accepted by $Firstname.', 'ereklamo', 'Resident', $usersID);");
        $a3 = mysqli_query($conn, "INSERT INTO report(reportType, reportMessage, UsersID, userBarangay, userPurok) VALUES(
  	    'eReklamo','$userType $Firstname has accepted ereklamo#$id', '$currentUser', '$userBarangay',
          '$userPurok');");
        $a4 = mysqli_query($conn, "INSERT INTO chatroom(roomName, type, idreference) VALUES('ereklamo#$id', 'ereklamo', $id)");
        $a5 = mysqli_query($conn, "INSERT INTO chat(UsersID, chatroomID, message) VALUES({$_GET['usersID']}, LAST_INSERT_ID(), '{$ereklamodata['comment']}')");

        if($a1 && $a2 && $a3 && $a4 && $a5){
            mysqli_commit($conn);
            if($_SESSION['barangayPos'] != "None"){
                header("location: ../respondent.php?error=none"); 
                exit();
            }
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
        }
    }
    else if(isset($_GET["sendtoHigher"])){
        $id = $_GET["sendtoHigher"];
        $usersID = $_GET['usersID'];
        $currentUser = $_SESSION['UsersID'];
        $userType = $_SESSION['userType'];
        $Firstname = $_SESSION['Firstname'];
        $userBarangay = $_SESSION['userBarangay'];
        $userPurok = $_SESSION['userPurok'];

        $managedBy = "'".$_SESSION['Lastname']. ', ' . $_SESSION['Firstname']."'";

        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
        status='Send to Higher', rescheduleCounter = 0 WHERE ReklamoID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position, UsersID) VALUES(
  	    'Your eReklamo#$id has been send to higher by $userType $Firstname.', 'ereklamo', 'Resident', $usersID);");
        $a3 = mysqli_query($conn, "INSERT INTO report(reportType, reportMessage, UsersID, userBarangay, userPurok) VALUES(
  	    'eReklamo','$userType $Firstname has sent ereklamo#$id to higher', '$currentUser', '$userBarangay',
          '$userPurok');");
        $a4 = mysqli_query($conn, "DELETE FROM schedule WHERE ereklamoID=$id");

        if($a1 && $a2 && $a3 && $a4){
            mysqli_commit($conn);
            if($_SESSION['barangayPos'] != "None"){
                header("location: ../respondent.php?error=none"); 
                exit();
            }
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            header("location: ../respondent.php?error=error"); 
            exit();
        }

        header("location: ../ereklamo.php?error=none"); //no errors were made
        exit();
    }
    
    else if(isset($_GET["rescheduleID"])){
        $id = $_GET["rescheduleID"];
        $usersID = $_GET['usersID'];
        $currentUser = $_SESSION['UsersID'];
        $userType = $_SESSION['userType'];
        $Firstname = $_SESSION['Firstname'];
        $userBarangay = $_SESSION['userBarangay'];
        $userPurok = $_SESSION['userPurok'];

        $managedBy = "'".$_SESSION['Lastname']. ', ' . $_SESSION['Firstname']."'";

        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
        status='Reschedule', rescheduleCounter = rescheduleCounter+1 WHERE ReklamoID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position, UsersID) VALUES(
  	    'Your eReklamo#$id has been rescheduled by $userType $Firstname.', 'ereklamo', 'Resident', $usersID);");
        $a3 = mysqli_query($conn, "INSERT INTO report(reportType, reportMessage, UsersID, userBarangay, userPurok) VALUES(
  	    'eReklamo','$userType $Firstname has rescheduled ereklamo#$id', '$currentUser', '$userBarangay',
          '$userPurok');");
        $a4 = mysqli_query($conn, "DELETE FROM schedule WHERE ereklamoID=$id");

        if($a1 && $a2 && $a3 && $a4){
            mysqli_commit($conn);
            if($_SESSION['barangayPos'] != "None"){
                header("location: ../respondent.php?error=none"); 
                exit();
            }
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            header("location: ../respondent.php?error=error"); 
            exit();
        }

        header("location: ../ereklamo.php?error=none"); //no errors were made
        exit();
    }

    else if(isset($_GET["scheduleID"])){
        $id = $_GET["scheduleID"];
        $usersID = $_GET['usersID'];
        $currentUser = $_SESSION['UsersID'];
        $userType = $_SESSION['userType'];
        $Firstname = $_SESSION['Firstname'];
        $userBarangay = $_SESSION['userBarangay'];
        $userPurok = $_SESSION['userPurok'];

        $schedule = date('Y-m-d', strtotime($_POST['schedule']));
        
        $managedBy = "'".$_SESSION['Lastname']. ', ' . $_SESSION['Firstname']."'";

        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
        status='Scheduled', scheduledSummon='$schedule' WHERE ReklamoID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position, UsersID) VALUES(
  	    'Your eReklamo has been scheduled on $schedule', 'ereklamo', 'Resident', $usersID);");
        $a3 = mysqli_query($conn, "INSERT INTO report(reportType, reportMessage, UsersID, userBarangay, userPurok) VALUES(
  	    'eReklamo','$userType $Firstname has scheduled ereklamo#$id on $schedule', '$currentUser', '$userBarangay',
        '$userPurok');");
        $a4 = mysqli_query($conn, "INSERT INTO schedule(scheduleDate, ereklamoID, UsersID, complainee, scheduleTitle) 
                                    SELECT '$schedule', $id, UsersID, complainee, '{$_POST['scheduleTitle']}'
                                    FROM ereklamo 
                                    WHERE ReklamoID=$id;");

        if($a1 && $a2 && $a3 && $a4){
            mysqli_commit($conn);
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            echo($schedule);
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../ereklamo.php?error=none"); //no errors were made
        exit();
    }

    else if(isset($_GET["respondID"])){
        if($id == NULL){
            $id = $_GET["respondID"];
            $usersID = $_GET['usersID'];
        }
        else{
            $usersID = $user;
        }
        
        $currentUser = $_SESSION['UsersID'];
        $userType = $_SESSION['userType'];
        $Firstname = $_SESSION['Firstname'];
        $userBarangay = $_SESSION['userBarangay'];
        $userPurok = $_SESSION['userPurok'];

        $managedBy = "'".$_SESSION['Lastname']. ', ' . $_SESSION['Firstname']."'";

        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
        status='To be scheduled' WHERE ReklamoID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position, UsersID) VALUES(
  	    'Your eReklamo#$id has been responded by $userType $Firstname.', 'ereklamo', 'Resident', $usersID);");
        $a3 = mysqli_query($conn, "INSERT INTO report(reportType, reportMessage, UsersID, userBarangay, userPurok) VALUES(
  	    'eReklamo','$userType $Firstname has resolved ereklamo#$id', '$currentUser', '$userBarangay',
          '$userPurok');");

        if($a2){
            mysqli_commit($conn);
            if($_SESSION['barangayPos'] != "None"){
                header("location: ../respondent.php?error=none"); 
                exit();
            }
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        /*$sql = "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
        status='Resolved' WHERE ReklamoID=$id";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo("Error description: " . mysqli_error($conn));
            exit();
        }
        
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        */

        header("location: ../ereklamo.php?error=none"); //no errors were made
        exit();
    }
    if(isset($_GET['ereklamoAddCat'])):?>
        <div class="container-fluid">
            <form action="includes/ereklamo.inc.php?postCatAdd&priority=<?php echo $_GET['priority'] ?>" class="user" method="post">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Category name: </label>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Category Name" name="catName">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    
    <?php
    elseif(isset($_GET['ereklamoEditCat'])):?>
        <style>
            .modal-footer{
                display: none;
            }
        </style>
        <div class="container-fluid">
            <?php
            $ereklamoCat = $conn->query("SELECT * FROM ereklamocategory WHERE reklamoCatID={$_GET['catID']}");
            $ereklamoRow = $ereklamoCat->fetch_assoc();
            ?>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-category-tab" data-toggle="tab" href="#nav-category" role="tab" aria-controls="nav-category" aria-selected="true">Category name</a>
                    <a class="nav-item nav-link" id="nav-types-tab" data-toggle="tab" href="#nav-types" role="tab" aria-controls="nav-types" aria-selected="false">Types</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-category" role="tabpanel" aria-labelledby="nav-category-tab">
                    <form action="includes/ereklamo.inc.php?postCatEdit&catID=<?php echo $_GET['catID'] ?>" class="user" method="post">
                        <div class="m-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Category name: </label>
                                    </div>
                                    <div class="col">
                                        <input type="text" value="<?php echo $ereklamoRow['reklamoCatName'] ?>" placeholder="Category Name" name="catName">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="footer">
                            <div class="d-flex flex-row-reverse">
                                <button class="btn btn-primary" type="submit" name="submit" id='submit' style="margin: 0.25rem;">Save</button>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal" style="margin: 0.25rem;">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="nav-types" role="tabpanel" aria-labelledby="nav-types-tab">
                    <form action="includes/ereklamo.inc.php?postTypeAdd&catID=<?php echo $_GET['catID']?>&catName=<?php echo $_GET['catName'] ?>" class="user" method="post">
                        <div class="form-group m-4">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Type name: </label>
                                </div>
                                <div class="col">
                                    <input type="text" placeholder="Type Name" name="typeName" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="footer">
                            <div class="d-flex flex-row-reverse">
                                <button class="btn btn-primary" type="submit" name="submit" id='submit' style="margin: 0.25rem;">Save</button>
                                <button class="btn btn-secondary" type="button" data-dismiss="modal" style="margin: 0.25rem;">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
    <?php
    elseif(isset($_GET['ereklamoAddType'])):?>
        <div class="container-fluid">
            <form action="includes/ereklamo.inc.php?postTypeAdd&catID=<?php echo $_GET['catID']?>&catName=<?php echo $_GET['catName'] ?>" class="user" method="post">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Type name: </label>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Type Name" name="typeName" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Priority: </label>
                        </div>
                        <div class="col">
                            <select name="typePriority" id="typePriority">
                                <option value="Minor" selected>Minor</option>
                                <option value="Major">Major</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php
    elseif(isset($_GET['ereklamoEditType'])):?>
        <div class="container-fluid">
            <form action="includes/ereklamo.inc.php?postTypeEdit&typeID=<?php echo $_GET['typeID']?>" class="user" method="post">
                <?php 
                    $ereklamoType = $conn->query("SELECT * FROM ereklamotype WHERE reklamoTypeID = {$_GET['typeID']}");
                    $ereklamo = $ereklamoType->fetch_assoc();
                ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Type name: </label>
                        </div>
                        <div class="col">
                            <input value="<?php echo $ereklamo['reklamoTypeName'] ?>" type="text" placeholder="Type Name" name="typeName">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php
    endif;
    if(isset($_GET['postCatAdd'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "INSERT INTO ereklamocategory(reklamoCatName, reklamoCatBrgy, reklamoCatPriority) VALUES('$catName', '{$_SESSION['userBarangay']}', '{$_GET['priority']}')");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Captain has entered a new reklamo category type: $catName', {$_SESSION['UsersID']}, '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../ereklamo.php?error=none"); //no errors were made
        exit();
    }
    else if(isset($_GET['postCatEdit'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE ereklamocategory SET reklamoCatName='$catName' WHERE reklamoCatID={$_GET['catID']}");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Captain has modified reklamo category #{$_GET['catID']}', {$_SESSION['UsersID']}, '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../ereklamo.php?error=none"); //no errors were made
        exit();
    }
    else if(isset($_GET['postCatDelete'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "DELETE FROM ereklamocategory WHERE reklamoCatID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Captain has deleted the reklamo type #{$_GET['typeID']}', {$_SESSION['UsersID']} ,'{$_SESSION['userBarangay']}' ,'{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../ereklamo.php?error=none"); //no errors were made
        exit();
    }
    else if(isset($_GET['postTypeAdd'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "INSERT INTO ereklamotype(reklamoTypeName, reklamoCatID) VALUES('$typeName', {$_GET['catID']})");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Captain has entered a new reklamo type for category type: {$_GET['catName']}', {$_SESSION['UsersID']}, '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../ereklamo.php?error=none"); //no errors were made
        exit();
    }
    else if(isset($_GET['postTypeEdit'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE ereklamotype SET reklamoTypeName='{$_POST['typeName']}' WHERE reklamoTypeID={$_GET['typeID']}");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Captain has modified the reklamo type #{$_GET['typeID']}', {$_SESSION['UsersID']} ,'{$_SESSION['userBarangay']}' ,'{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../ereklamo.php?error=none"); //no errors were made
        exit();
    }
    else if(isset($_GET['postTypeDelete'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "DELETE FROM ereklamoType WHERE reklamoTypeID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Captain has deleted the reklamo type #{$_GET['typeID']}', {$_SESSION['UsersID']} ,'{$_SESSION['userBarangay']}' ,'{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../ereklamo.php?error=none"); //no errors were made
        exit();
    }
    else if(isset($_GET['respond'])):
?>
    <style>
        .modal-footer{
            display: none;
        }
    </style>
    <div class="container-fluid">
        <div class="messaging">
            <div class="inbox_msg">
                <div class="mesgs">
                    <div class="msg_history" id="msg_history">
                        
                    </div>
                    <div class="type_msg m-2">
                        <div class="input_msg_write">
                            <input type="text" class="write_msg" id="message" placeholder="Type a message" />
                            <button class="msg_send_btn" type="button"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var input = document.getElementById("message");

        input.addEventListener("keypress", function(event){
            if(event.key === "Enter"){
                enterChat("test");
            }
        });

        $(document).ready(function(){
            showChat();
        });
        
        function showChat(){
            $.ajax({
                url: './includes/chat.inc.php?showchat&reklamoid='+<?php echo $_GET['reklamoid'] ?>,
                type: 'GET',
                success: function(data){
                    $("#msg_history").html(data);
                }
            })
        }

        function enterChat($message){
            $.ajax({
                url: './includes/chat.inc.php?sendchat&chatroomID='+<?php echo $_GET['chatroomID'] ?>+'&reklamoid='+<?php echo $_GET['reklamoid'] ?>,
                method: 'POST',
                data:{$postmessage:$message},
                success: function(data){
                    showChat();
                }
            })
        }
    </script>
<?php endif; ?>