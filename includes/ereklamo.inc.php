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
            $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('Resident {$_SESSION['Lastname']}, {$_SESSION['Firstname']} has sent a minor reklamo!', 'ereklamo', 'Purok Leader')");

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

            $a1 = mysqli_query($conn, "INSERT INTO ereklamo(UsersID, reklamoType, detail, status, comment, complainee, complaintLevel, barangay, purok) VALUES({$_SESSION['UsersID']}, '{$_POST['reklamotype']}', '{$_POST['detail']}', 'Pending', '{$_POST['comment']}', '{$_POST['resident']}', '{$postreklamo['reklamoCatPriority']}', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");
            $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('Resident {$_SESSION['Lastname']}, {$_SESSION['Firstname']} has sent a major reklamo!', 'ereklamo', 'Purok Leader')");

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
        status='Ongoing' WHERE ReklamoID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position, UsersID) VALUES(
        'Your eReklamo#$id is now being processed by $Firstname.', 'ereklamo', 'Resident', $usersID);");
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
    if(isset($_GET['sendRespondent'])){

        $id = $_GET['reklamoid'];
        $usersID = $_GET['usersID'];
        mysqli_begin_transaction($conn);

        $checkedBy = $_SESSION['Firstname'].' '.$_SESSION['Lastname'];

        $a1 = mysqli_query($conn, "UPDATE ereklamo SET status='Respondents sent', checkedBy='$checkedBy', checkedOn=CURRENT_TIMESTAMP WHERE reklamoID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, UsersID, type, position) VALUES('Respondents has been sent for your ReklamoID#$id', $usersID, 'ereklamo', 'Resident')");

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

        if($a1 && $a2 && $a3){
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

    else if(isset($_GET["scheduleID"])){
        $id = $_GET["scheduleID"];
        $usersID = $_GET['complainant'];
        $currentUser = $_SESSION['UsersID'];
        $userType = $_SESSION['userType'];
        $Firstname = $_SESSION['Firstname'];
        $userBarangay = $_SESSION['userBarangay'];
        $userPurok = $_SESSION['userPurok'];

        $schedule = date('Y-m-d', strtotime($_POST['schedule']));
        
        $managedBy = "'".$_SESSION['Lastname']. ', ' . $_SESSION['Firstname']."'";

        mysqli_begin_transaction($conn);
        $scheduleSQL = $conn->query("SELECT * FROM schedule WHERE ereklamoID=$id");
        $scheduleResult = $scheduleSQL->row_cnt;
        
        if($scheduleResult == 0){
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
            $a5 = mysqli_query($conn, "INSERT INTO notifications(message, type, position, UsersID) 
            SELECT 'Your eReklamo has been scheduled on $schedule', 'ereklamo', 'Resident', complainee
            FROM ereklamo
            WHERE ReklamoID=$id;");
            $a6 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES(
            'An eReklamo has been scheduled on $schedule', 'ereklamo', 'Captain');");
            if($a1 && $a2 && $a3 && $a4 && $a5 && $a6){
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
        }
        else if($scheduleResult > 0){
            $a1 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
            status='Scheduled', scheduledSummon='$schedule' WHERE ReklamoID=$id");
            $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position, UsersID) VALUES(
            'Your eReklamo has been scheduled on $schedule', 'ereklamo', 'Resident', $usersID);");
            $a3 = mysqli_query($conn, "INSERT INTO report(reportType, reportMessage, UsersID, userBarangay, userPurok) VALUES(
            'eReklamo','$userType $Firstname has scheduled ereklamo#$id on $schedule', '$currentUser', '$userBarangay',
            '$userPurok');");
            $a4 = mysqli_query($conn, "UPDATE schedule SET scheduleDate='$schedule', scheduleTitle='{$_POST['scheduleTitle']}' WHERE ereklamoID=$id;");
            $a5 = mysqli_query($conn, "INSERT INTO notifications(message, type, position, UsersID) 
            SELECT 'Your eReklamo has been scheduled on $schedule', 'ereklamo', 'Resident', complainee
            FROM ereklamo
            WHERE ReklamoID=$id;");
            $a6 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES(
            'An eReklamo has been scheduled on $schedule', 'ereklamo', 'Captain');");
            
            if($a1 && $a2 && $a3 && $a4 && $a5 && $a6){
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
                    <?php if($_GET['priority'] == 'Major'): ?>
                    <div class="row">
                        <div class="col">
                            <label>Fee: </label>
                        </div>
                        <div class="col">
                            <input type="text" placeholder="Fee" name="reklamoFee">
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col">
                        <hr>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse footer">
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </form>
            <script>
                $(".container-fluid").parent().siblings(".modal-footer").remove();
            </script>
        </div>
    
    <?php
    elseif(isset($_GET['ereklamoEditCat'])):?>
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
                                <?php if($ereklamoRow['reklamoCatPriority']=='Major'): ?>
                                <div class="row">
                                    <div class="col">
                                        <label>Fee: </label>
                                    </div>
                                    <div class="col">
                                        <input type="text" value="<?php echo $ereklamoRow['reklamoFee'] ?>" placeholder="Fee" name="reklamoFee">
                                    </div>
                                </div>
                                <?php endif; ?>
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
            <script>
                $(".container-fluid").parent().siblings(".modal-footer").remove();
            </script>
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

        $a1 = mysqli_query($conn, "INSERT INTO ereklamocategory(reklamoCatName, reklamoCatBrgy, reklamoCatPriority, reklamoFee) VALUES('$catName', '{$_SESSION['userBarangay']}', '{$_GET['priority']}', '$reklamoFee')");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Captain has entered a new reklamo category type: $catName', {$_SESSION['UsersID']}, '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../services.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../services.php?error=none"); //no errors were made
        exit();
    }
    else if(isset($_GET['postCatEdit'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE ereklamocategory SET reklamoCatName='$catName', reklamoFee='$reklamoFee' WHERE reklamoCatID={$_GET['catID']}");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Captain has modified reklamo category #{$_GET['catID']}', {$_SESSION['UsersID']}, '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../services.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../services.php?error=none"); //no errors were made
        exit();
    }
    else if(isset($_GET['postCatDelete'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "DELETE FROM ereklamocategory WHERE reklamoCatID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Captain has deleted the reklamo type #{$_GET['typeID']}', {$_SESSION['UsersID']} ,'{$_SESSION['userBarangay']}' ,'{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../services.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../services.php?error=none"); //no errors were made
        exit();
    }
    else if(isset($_GET['postTypeAdd'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "INSERT INTO ereklamotype(reklamoTypeName, reklamoCatID) VALUES('$typeName', {$_GET['catID']})");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Captain has entered a new reklamo type for category type: {$_GET['catName']}', {$_SESSION['UsersID']}, '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../services.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../services.php?error=none"); //no errors were made
        exit();
    }
    else if(isset($_GET['postTypeEdit'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE ereklamotype SET reklamoTypeName='{$_POST['typeName']}' WHERE reklamoTypeID={$_GET['typeID']}");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Captain has modified the reklamo type #{$_GET['typeID']}', {$_SESSION['UsersID']} ,'{$_SESSION['userBarangay']}' ,'{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../services.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../services.php?error=none"); //no errors were made
        exit();
    }
    else if(isset($_GET['reportPost'])){
        extract($_POST);
        mysqli_begin_transaction($conn);
        $id = $_GET['ReklamoID'];
        $managedBy = "'".$_SESSION['Firstname']." ".$_SESSION['Lastname']. "'";

        

        if($_SESSION['barangayPos'] != "None"){
            $a1 = mysqli_query($conn, "INSERT INTO ereklamoreport(ReklamoID, respondentID, reportMessage, reportStatus) VALUES($id, {$_SESSION['UsersID']}, '$reportMessage', '$reportStatus')");
            $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('A responder has sent a report for ereklamo#$id', 'ereklamo', 'Purok Leader')");
            $a3 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
            status='Incoming' WHERE ReklamoID=$id");

            if($a1){
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
        elseif($_SESSION['userType'] == 'Purok Leader'){
            if($reportStatus == 'Resolved'){
                $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID, position) SELECT 'Purok Leader has resolved your ereklamo#$id', 'ereklamo', UsersID, 'Resident' FROM ereklamo WHERE ReklamoID=$id");
                $a3 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
                status='Resolved' WHERE ReklamoID=$id");
                $a1 = mysqli_query($conn, "INSERT INTO ereklamoreport(ReklamoID, respondentID, reportMessage, reportStatus) VALUES($id, {$_SESSION['UsersID']}, '$reportMessage', '$reportStatus')");
            }
            elseif($reportStatus == 'Forward to Captain'){
                $requestSql = $conn->query("SELECT *, ereklamo.UsersID as complaineeID, concat(users.Firstname, ' ', users.Lastname) as name, ereklamocategory.reklamoFee as amount FROM ereklamo INNER JOIN ereklamocategory ON ereklamo.reklamotype=ereklamocategory.reklamoCatName INNER JOIN users ON users.UsersID=ereklamo.UsersID WHERE ReklamoID=$id");
                $requestData = $requestSql->fetch_assoc();

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
                    'customername' => $requestData['name'],
                    'customeremail' => $requestData['emailAdd'],
                    'customermobile' => $requestData['phoneNum']
                ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);

                $resData = json_decode($response, true, 4);

                echo $resData["data"]["checkouturl"];
                $paymenturl = $resData["data"]["checkouturl"];
                print_r($resData);

                $a2 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
                status='To be paid', reklamoFee='{$requestData['amount']}', paymenturl='$paymenturl' WHERE ReklamoID=$id");
                $a3 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Purok Leader has forwarded reklamo#$id to Captain', {$_SESSION['UsersID']} ,'{$_SESSION['userBarangay']}' ,'{$_SESSION['userPurok']}')");
                $a4 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID) VALUES('Your ereklamo#$id has been forwarded to Capt. Please process the payment.', 'ereklamo', {$requestData['complaineeID']})");
                $a5 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID) VALUES('The complainant has forward your ereklamo to Captain, please await for your schedule.', 'ereklamo', {$requestData['complaineeID']})");
            }

            if($a2 && $a3 && $a1){
                if(isset($img)){
                    $id = $id;
                    mkdir('../img/ereklamo/reports/'.$id);
                    for($i = 0 ; $i< count($img);$i++){
                        list($type, $img[$i]) = explode(';', $img[$i]);
                        list(, $img[$i])      = explode(',', $img[$i]);
                        $img[$i] = str_replace(' ', '+', $img[$i]);
                        $img[$i] = base64_decode($img[$i]);
                        $fname = strtotime(date('Y-m-d H:i'))."_".$imgName[$i];
                        $upload = file_put_contents('../img/ereklamo/reports/'.$id.'/'.$fname,$img[$i]);
                        $data = " file_path = '".$fname."' ";
                    }
                }
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
        elseif($_SESSION['userType'] == 'Captain'){
            if($reportStatus == 'Resolved'){
                $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID, position) SELECT 'Captain has resolved your ereklamo#$id', 'ereklamo', UsersID, 'Resident' FROM ereklamo WHERE ReklamoID=$id");
                $a3 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
                status='Resolved' WHERE ReklamoID=$id");

                if($a1 && $a2 && $a3){
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
            elseif($reportStatus == 'Reschedule'){
                $a2 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
                status='Reschedule', rescheduleCounter = rescheduleCounter+1 WHERE ReklamoID=$id");
                $a3 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID, position) SELECT 'Captain rescheduled your ereklamo#$id', 'ereklamo', UsersID, 'Resident' FROM ereklamo WHERE ReklamoID=$id");
                $a4 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID, position) SELECT 'Captain rescheduled your ereklamo#$id', 'ereklamo', complainee, 'Resident' FROM ereklamo WHERE ReklamoID=$id");
                $a5 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) SELECT 'Captain has requested a rescheduling for ereklamo#$id', 'ereklamo', 'Secretary' FROM ereklamo WHERE ReklamoID=$id");

                if($a1 && $a2 && $a3 && $a4 && $a5){
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
            elseif($reportStatus == 'Forward to LUPON'){
                $a1 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
                status='Send to LUPON', rescheduleCounter = 0 WHERE ReklamoID=$id");
                $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID, position) SELECT 'Captain has forward your reklamo#$id to the LUPON', 'ereklamo', UsersID, 'Resident' FROM ereklamo WHERE ReklamoID=$id");
                $a3 = mysqli_query($conn, "DELETE FROM schedule WHERE ereklamoID=$id"); 
                $a4 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID, position) SELECT 'Captain has forward your reklamo#$id to the LUPON', 'ereklamo', complainee, 'Resident' FROM ereklamo WHERE ReklamoID=$id");

                if($a1 && $a2 && $a3 && $a4){
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
        
    }
    else if(isset($_GET['sendtocaptPOST'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $managedBy = "'".$_SESSION['Firstname']." ".$_SESSION['Lastname']. "'";

        $requestSql = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name, ereklamocategory.reklamoFee as amount FROM ereklamo INNER JOIN ereklamocategory ON ereklamo.reklamotype=ereklamocategory.reklamoCatName INNER JOIN users ON users.UsersID=ereklamo.UsersID WHERE ReklamoID={$_GET['reklamoid']}");
        $requestData = $requestSql->fetch_assoc();

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
            'customername' => $requestData['name'],
            'customeremail' => $requestData['emailAdd'],
            'customermobile' => $requestData['phoneNum']
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $resData = json_decode($response, true, 4);

        echo $resData["data"]["checkouturl"];
        $paymenturl = $resData["data"]["checkouturl"];
        print_r($resData);

        $a1 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
        status='To be paid', reklamoFee='{$requestData['amount']}', paymenturl='$paymenturl' WHERE ReklamoID={$_GET['reklamoid']}");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Purok Leader has forwarded reklamo#{$_GET['reklamoid']} to Captain', {$_SESSION['UsersID']} ,'{$_SESSION['userBarangay']}' ,'{$_SESSION['userPurok']}')");
        $a3 = mysqli_query($conn, "INSERT INTO ereklamoreport(ReklamoID, respondentID, reportMessage) VALUES({$_GET['reklamoid']}, {$_SESSION['UsersID']}, '$reportMessage')");
        $a4 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID) VALUES('Your ereklamo#{$_GET['reklamoid']} has been forwarded to Capt. Please process the payment.', 'ereklamo', {$_GET['complainantid']})");
        $a5 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID) VALUES('The complainant has forward your ereklamo to Captain, please await for your schedule.', 'ereklamo', {$_GET['complaineeid']})");

        if($a1 && $a2 && $a3 && $a4 && $a5){
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
    else if(isset($_GET['paid'])){
        $id = $_GET['reklamoid'];
        extract($_POST);
        mysqli_begin_transaction($conn);

        $requestSql = $conn->query("SELECT * FROM ereklamo WHERE ReklamoID=$id");
        $requestData = $requestSql->fetch_assoc();

        $managedBy = "'".$_SESSION['Firstname']." ".$_SESSION['Lastname']."'";

        $a1 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
        status='To Captain' WHERE ReklamoID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Treasurer {$_SESSION['Firstname']} {$_SESSION['Lastname']} has confirmed the payment of ereklamo#$id', {$_SESSION['UsersID']} ,'{$_SESSION['userBarangay']}' ,'{$_SESSION['userPurok']}')");
        $a3 = mysqli_query($conn, "INSERT INTO notifications(type, message, position) VALUES('eReklamo', 'An ereklamo is ready for scheduling!', 'Secretary')");
        $a4 = mysqli_query($conn, "INSERT INTO notifications(type, message, UsersID, position) VALUES('eReklamo', 'Your payment for the ereklamo#$id has been confirmed by the Treasurer! Please await for your schedule', {$requestData['UsersID']}, 'Resident')");

        if($a1 && $a2 && $a3 && $a4){
            mysqli_commit($conn);
            header("location: ../payment.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }
    }
    else if(isset($_GET['postTypeDelete'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "DELETE FROM ereklamoType WHERE reklamoTypeID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO report(ReportType, reportMessage, UsersID, userBarangay, userPurok) VALUES('eReklamo', 'Captain has deleted the reklamo type #{$_GET['typeID']}', {$_SESSION['UsersID']} ,'{$_SESSION['userBarangay']}' ,'{$_SESSION['userPurok']}')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../services.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

        header("location: ../services.php?error=none"); //no errors were made
        exit();
    }
    else if(isset($_GET['respond'])):
    $respondSql = $conn->query("SELECT * FROM ereklamo WHERE ReklamoID={$_GET['reklamoid']}");
    $respondResult = $respondSql->fetch_assoc();
?>
    
    <div class="container-fluid" id="respond">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-chat-tab" data-toggle="tab" href="#nav-chat" role="tab" aria-controls="nav-chat" aria-selected="true">Chat</a>
                <a class="nav-item nav-link" id="nav-report-tab" data-toggle="tab" href="#nav-report" role="tab" aria-controls="nav-report" aria-selected="false">Report</a>
                <?php if($respondResult['status'] == 'Resolved'): ?>
                <a class="nav-item nav-link" id="nav-documentation-tab" data-toggle="tab" href="#nav-documentation" role="tab" aria-controls="nav-documentation" aria-selected="false">Documentation</a>
                <?php endif; ?>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-chat" role="tabpanel" aria-labelledby="nav-chat-tab">
                <div class="container-fluid">
                    <div class="messaging">
                        <div class="inbox_msg">
                            <div class="mesgs">
                                <div class="msg_history" id="msg_history">
        
                                </div>
                                <div class="type_msg m-2">
                                    <div class="input_msg_write">
                                        <?php if($respondResult['status'] != 'Resolved'): ?>
                                            <input type="text" autocomplete="off" class="write_msg" id="message" placeholder="Type a message" style="width: 100%; resize: none; word-wrap: break-word;"></input>
                                        <?php else: ?>
                                            <input type="text" autocomplete="off" class="write_msg" id="message" placeholder="Reklamo has been resolved. You cant chat anymore." style="width: 100%; resize: none; word-wrap: break-word;" readonly></input>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-report" role="tabpanel" aria-labelledby="nav-report-tab">
                <div class="table-responsive" style="overflow-y: overlay; max-height: 400px;">
                    <table class="table table-chatreport table-bordered text-center text-dark" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th scope="col">Respondent Name</th>
                                <th>Status</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php
                                $requests = $conn->query("SELECT ereklamoreport.*, concat(users.Firstname, ' ', users.Lastname) as name, users.userType, users.profile_pic FROM ereklamoreport JOIN users ON respondentID=users.UsersID WHERE ReklamoID={$_GET['reklamoid']} ORDER BY date DESC");
                                while($row=$requests->fetch_assoc()):
                                    if($row["userType"] == "Admin"){
                                        continue;
                                    }
                                    $date = date_create($row['date']);
                            ?>
                            <tr>
                                <td>
                                    <img class="img-profile rounded-circle <?php
                                        if($row["userType"] == "Resident"){
                                            echo "img-res-profile";
                                        }
                                        elseif($row["userType"] == "Purok Leader"){
                                            echo "img-purokldr-profile";
                                        }
                                        elseif($row["userType"] == "Captain"){
                                            echo "img-capt-profile";
                                        }
                                        elseif($row["userType"] == "Secretary"){
                                            echo "img-sec-profile";
                                        }
                                        elseif($row["userType"] == "Treasurer"){
                                            echo "img-treas-profile";
                                        }
                                        elseif($row["userType"] == "Admin"){
                                            echo "img-admin-profile";
                                        }
                                    ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                    <br>
                                    <?php echo $row["name"] ?>
                                </td>
                                <th><?php echo $row['reportStatus'] ?></th>
                                <td><?php echo $row["reportMessage"] ?></td>
                                <td><?php echo date_format($date, "m-d-Y") ?></td>
                                <!--Right Options-->
                            </tr>
                            <?php endwhile; ?>
                            <!--Row 1-->
                        </tbody>
                    </table>
                </div>
                <?php if(($_SESSION['userType'] != 'Resident' && $_SESSION['userType'] != 'Captain') && $respondResult['status'] != 'To Captain' && $respondResult['status'] != 'Resolved'):?>
                <hr>
                <div class="footer">
                    <div class="d-flex flex-row-reverse">
                        <button class="btn btn-primary report" data-id="<?php echo $_GET['reklamoid'] ?>" data-id style="margin: 0.25rem;"><i class="fas fa-user"></i> Send Report</button>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php if($respondResult['status'] == 'Resolved'): ?>
                <div class="tab-pane fade" id="nav-documentation" role="tabpanel" aria-labelledby="nav-documentation-tab">
                    <?php 
                    $gal = scandir('../img/ereklamo/reports/'.$_GET['reklamoid']);
                    unset($gal[0]);
                    unset($gal[1]);
                    $count =count($gal);
                    $i = 0;
                    ?>
                    <style>
                        .slide img,.slide video{
                            max-width:100%;
                            max-height:100%;
                        }
                        #uni_modal .modal-footer{
                            display:none
                        }
                    </style>
                    <div class="container-fluid" style="height:75vh">
                        <div class="row h-100">
                            <div class="col bg-dark h-100">
                                <div class="d-flex h-100 w-100 position-relative justify-content-between align-items-center">
                                    <a href="javascript:void(0)" id="prev" class="position-absolute d-flex justify-content-center align-items-center" style="left:0;width:calc(15%);z-index:1"><h4><div class="fa fa-angle-left"></div></h4></a>
                                    <?php
                                        foreach($gal as $k => $v):
                                            $mime = mime_content_type('../img/ereklamo/reports/'.$_GET['reklamoid'].'/'.$v);
                                            $i++;
                                    ?>
                                    <div class="slide w-100 h-100 <?php echo ($i == 1) ? "d-flex" : 'd-none' ?> align-items-center justify-content-center" data-slide="<?php echo $i ?>">
                                    <?php if(strstr($mime,'image')): ?>
                                        <img src="./img/ereklamo/reports/<?php echo $_GET['reklamoid'].'/'.$v ?>" class="" alt="Image 1">
                                    <?php else: ?>
                                        <video controls class="">
                                                <source src="./img/ereklamo/reports/<?php echo $_GET['reklamoid'].'/'.$v ?>" type="<?php echo $mime ?>">
                                        </video>
                                    <?php endif; ?>
                                    </div>
                                    <?php endforeach; ?>
                                    <a href="javascript:void(0)" id="next" class="position-absolute d-flex justify-content-center align-items-center" style="right:0;width:calc(15%);z-index:1"><h4><div class="fa fa-angle-right"></div></h4></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $("#respond").parent().siblings(".modal-footer").remove();
        <?php if($respondResult['status'] == 'Resolved'): ?>
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
        <?php endif; ?>
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

    </script>

    <?php elseif(isset($_GET['promptSchedule'])): ?>
    <div class="container-fluid">
        <div class="col">
            <div class="row">
                <p>Your schedule will be on May 25, 2022. Please confirm your attendance.</p>
            </div>
        </div>
        <hr>
        <div class="d-flex flex-row-reverse footer">
            <button class="btn btn-sm btn-success"><i class="fas fa-check"></i> Will attend</button>
            <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Will not attend</button>
        </div>
    </div>
    <script>
        $(".container-fluid").parent().siblings(".modal-footer").remove();
    </script>
<?php endif; ?>

<?php 
    if(isset($_GET['report'])): ?>
    <div class="container-fluid">
        <?php $dataSql = $conn->query("SELECT * FROM ereklamo WHERE ReklamoID={$_GET['reklamoid']}");
        $dataResult = $dataSql->fetch_assoc();
        ?>    
        <form action="includes/ereklamo.inc.php?reportPost&ReklamoID=<?php echo $_GET['reklamoid'] ?>" id="reklamoForm" method="POST">
            <div class="row" style="margin-bottom: 10px">
                <div class="col">Status</div>
                <div class="col-sm-8">
                    <select name="reportStatus" id="reportStatus" onchange="checkStatus()">
                        <option value="">Select</option>
                        <option value="Resolved">Resolved</option>
                        <?php if($_SESSION['userType'] == 'Purok Leader'): ?>
                            <?php if($dataResult['complaintLevel'] == 'Minor'): ?>
                                
                            <?php elseif($dataResult['complaintLevel'] == 'Major'): ?>
                                <option value="Forward to Captain">Forward to Captain</option>
                            <?php endif; ?>
                        <?php elseif($_SESSION['userType'] == 'Captain'): ?>
                            <option value="Forward to LUPON">Forward to LUPON</option>
                            <?php if($dataResult['rescheduleCounter'] < 3): ?>
                            <option value="Reschedule">Reschedule</option>
                            <?php endif; ?>
                        <?php elseif($_SESSION['barangayPos'] != 'None'): ?>
                            <option value="Unresolved">Unresolved</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom: 10px">
                <div class="col">
                    <p>Report Message: </p>
                </div>
                <div class="col-sm-8">
                    <textarea name="reportMessage" id="reportMessage" class="form-control" rows="3" style="resize:none;" required></textarea>
                </div>
            </div>
            <div class="row" id="reportPicture" style="display: none;">
                <div class="col">
                    Photo:
                </div>
                <div class="col-sm-8">
                    <input type="file" name="file[]" multiple="multiple" onchange="" id="postF" onchange="displayUpload(this)" class="d-none" accept="image/*" required>
                    <button id="requirementPic" onclick="$('#postF').trigger('click')" type="button" class="btn btn-success"><i class="fas fa-photo-video"></i> Upload</button>
                </div>
            </div>
            <div class="row">
                <div id="file-display" class="d-flex flex-row m-2">
                    <?php 
                    if(isset($id)):
                        if(is_dir('../img/'.$id)):
                        $gal = scandir('../img/'.$PostID);
                        unset($gal[0]);
                        unset($gal[1]);
                        foreach($gal as $k=>$v):
                            $mime = mime_content_type('../img/'.$PostID.'/'.$v);
                            $img = file_get_contents('../img/'.$PostID.'/'.$v); 
                            $data = base64_encode($img); 
                        ?>
                            <div class="imgF">
                                <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                                <input type="hidden" name="img[]" value="<?php echo $data ?>">
                                <input type="hidden" name="imgName[]" value="<?php echo $v ?>">
                                <?php if(strstr($mime,'image')): ?>
                                <img class="imgDropped" style="width: 200px; height: 200px;" src="img/<?php echo $PostID.'/'.$v ?>">
                                <?php else: ?>
                                <video src="img/<?php echo $row['file_path'] ?>"></video>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row" id="alert" style="margin-top: 5px;">
                <div class='col'>
                    <div class='alert alert-danger'>Please fill the required fields</div>
                </div>
            </div>
            <div class="imgF" style="display: none " id="img-clone">
                <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
            </div>
            <hr>
            <div class="d-flex flex-row-reverse">
                <button class="btn btn-primary confirm" type="button" data-id="<?php echo $_GET['reklamoid'] ?>" onclick="checkEmpty($('#reportMessage').val())">Send</button> 
            </div>
        </form>
        <script>
            document.getElementById("alert").style.display = "none";
            $(".container-fluid").parent().siblings(".modal-footer").remove();
            function checkEmpty($message){
                var ddl = document.getElementById("reportStatus");
                var selectedValue = ddl.options[ddl.selectedIndex].value;
                if($("#reportMessage").val() == '' || selectedValue == ''){
                    document.getElementById("alert").style.display = "block";
                }
                else{
                    if(document.getElementById("reportPicture").style.display == "flex"){
                        if($("#postF").get(0).files.length === 0){
                            document.getElementById("alert").style.display = "block";
                        }
                        else{
                            $('#secondary_modal form').submit();
                        }
                    }
                    else{
                        $('#secondary_modal form').submit();
                    }
                }
            }  

            function checkStatus(){
                d = document.getElementById('reportStatus').value;
                if(d == 'Resolved'){
                    document.getElementById("reportPicture").style.display = "flex";
                }
                else{
                    document.getElementById("reportPicture").style.display = "none";
                }
            }

            function confirmReport($message, $id, $status){
                start_load()
                $.ajax({
                    url:'includes/ereklamo.inc.php?reportPost',
                    method:'POST',
                    data:{
                        id:$id, 
                        reportMessage: $message,
                        reportStatus: $status    
                    },
                    success:function(){
                        location.reload()
                    }
                })
            }

            $('[name="file[]"]').change(function(){
                displayUpload(this)
            })
            function displayUpload(input){
                if (input.files) {
                Object.keys(input.files).map(function(k){
                    var reader = new FileReader();
                        var t = input.files[k].type;
                        var _types = ['video/mp4','image/x-png','image/png','image/gif','image/jpeg','image/jpg'];
                        if(_types.indexOf(t) == -1)
                            return false;
                        reader.onload = function (e) {
                            // $('#cimg').attr('src', e.target.result);
                        var bin = e.target.result;
                        var fname = input.files[k].name;
                        var imgF = document.getElementById('img-clone');
                            imgF = imgF.cloneNode(true);
                            imgF.removeAttribute('id')
                            imgF.removeAttribute('style')
                            if(t == "video/mp4"){
                                var img = document.createElement("video");
                                }else{
                                var img = document.createElement("img");
                                }
                                var fileinput = document.createElement("input");
                                var fileinputName = document.createElement("input");
                                fileinput.setAttribute('type','hidden')
                                fileinputName.setAttribute('type','hidden')
                                fileinput.setAttribute('name','img[]')
                                fileinputName.setAttribute('name','imgName[]')
                                fileinput.value = bin
                                fileinputName.value = fname
                                img.classList.add("imgDropped")
                                img.classList.add("img-fluid")
                                img.classList.add("rounded")
                                img.src = bin;
                                imgF.appendChild(fileinput);
                                imgF.appendChild(fileinputName);
                                imgF.appendChild(img);
                                document.querySelector('#file-display').appendChild(imgF)
                        }
                    reader.readAsDataURL(input.files[k]);
                    })
                    rem_func()
                }
            }
            function rem_func(_this){
                _this.closest('.imgF').remove();
                if($('#drop .imgF').length <= 0){
                    $('#drop').append('<span id="dname" class="text-center">Drop Files Here <br> or <br> <label for="chooseFile"><strong>Choose File</strong></label></span>')
                }
            }
        </script>
    </div>
<?php elseif(isset($_GET['sendtocapt'])): ?>
    <div class="container-fluid">
        <form action="includes/ereklamo.inc.php?sendtocaptPOST&reklamoid=<?php echo $_GET['reklamoid'] ?>&complainantid=<?php echo $_GET['complainantid'] ?>&complaineeid=<?php echo $_GET['complaineeid'] ?>" method="POST">
            <div class="row">
                <div class="col">
                    <p>Report Message: </p>
                </div>
                <div class="col">
                    <textarea name="reportMessage" class="form-control" rows="3" style="resize:none;"></textarea>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>
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
        window._conf = function($msg='',$func='',$params = []){
            $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
            $('#confirm_modal .modal-body').html($msg)
            $('#confirm_modal').modal('show')
        }

        $('.report').click(function(){
            secondary_modal("<center><b>Report to Purok Leader</b></center></center>","includes/ereklamo.inc.php?report&chatroomID=<?php echo $_GET['chatroomID'] ?>&reklamoid="+$(this).attr('data-id'), "modal-md")
        })
        $('.forwardtocapt').click(function(){
            secondary_modal("<center><b>Forward to Captain</b></center></center>","includes/ereklamo.inc.php?sendtocapt&reklamoid="+$(this).attr('data-id')+"&complainantid="+$(this).attr('data-complainant')+"&complaineeid="+$(this).attr('data-complainee'), "modal-md")
        })

        var input = document.getElementById("message");

        input.addEventListener("keypress", function(event){
            if(event.key === "Enter"){
                if(input.value != ''){
                    enterChat($("#message").val());
                    input.value = '';
                }
            }
        });

        $(document).ready(function(){
            showChat();
        });
        
        function showChat(){
            start_load()
            $.ajax({
                url: './includes/chat.inc.php?showchat&reklamoid='+<?php echo $_GET['reklamoid'] ?>,
                type: 'GET',
                success: function(data){
                    $("#msg_history").html(data);
                    $("#msg_history").animate({ scrollTop: 20000000 }, "slow");
                }
            })
        }

        function enterChat($message){
            start_load()
            $.ajax({
                url: './includes/chat.inc.php?sendchat&chatroomID='+<?php echo $_GET['chatroomID'] ?>+'&reklamoid='+<?php echo $_GET['reklamoid'] ?>,
                method: 'POST',
                data:{postmessage:$message},
                success: function(data){
                    showChat();
                }
            })
        }
        
    </script>