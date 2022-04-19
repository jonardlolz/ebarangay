<?php
    include_once "dbh.inc.php";
    session_start();
    extract($_POST);

    if(isset($_POST["submit"])){
        
        // $ereklamo = $conn->query("SELECT * FROM ereklamo WHERE UsersID=
        // {$_SESSION['UsersID']} AND status='Pending'");
        // $row_cnt = mysqli_num_rows($ereklamo);
        // if($row_cnt >= 1){
        //     header("location: ../ereklamo.php?error=pendingRek");
        //     exit();
        // }
        $postsql = $conn->query("SELECT * FROM (SELECT ereklamotype.*, ereklamocategory.reklamoCatName, ereklamocategory.reklamoCatBrgy FROM ereklamotype INNER JOIN ereklamocategory ON ereklamotype.reklamoCatID = ereklamocategory.reklamoCatID) as ereklamoTab WHERE reklamoTypeName='{$_POST['detail']}' AND reklamoCatName='{$_POST['reklamotype']}' AND reklamoCatBrgy = '{$_SESSION['userBarangay']}'");
        $postreklamo = $postsql->fetch_assoc();
        if($postreklamo['reklamoTypePriority'] == "Minor"){
            mysqli_begin_transaction($conn);

            $a1 = mysqli_query($conn, "INSERT INTO ereklamo(UsersID, reklamoType, detail, status, comment, complainee, complaintLevel, barangay, purok) VALUES({$_SESSION["UsersID"]}, '{$_POST['reklamotype']}', '{$_POST['detail']}', 'Pending', '{$_POST['comment']}', 'N/A', '{$postreklamo['reklamoTypePriority']}', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");
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
        else if($postreklamo['reklamoTypePriority'] == "Major"){
            echo "Major";
        }

        // $reklamotype = $_POST["reklamotype"];
        // $detail = $_POST["detail"];
        // $comment = $_POST["comment"];
        // $status = "Pending";
        // $complainee = $_POST["resident"];
        // if($reklamotype == "Resident"){
        //     if($complainee == ""){  
        //         header("location: ../ereklamo.php?error=noResident");
        //         exit();
        //     }
        //     else{
        //         $complaintLevel = "Major";
        //         $userType =  "Secretary";
        //     }
        // }
        // else{
        //     $complaintLevel = "Minor";
        //     $userType =  "Purok Leader";
        // }

        // mysqli_begin_transaction($conn);

        // $a1 = mysqli_query($conn, "INSERT INTO ereklamo(UsersID, reklamoType, detail, status, comment, complainee, complaintLevel, barangay, purok) VALUES({$_SESSION["UsersID"]}, '$reklamotype', '$detail', '$status', '$comment', '$complainee', '$complaintLevel', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");
        // $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('A resident has submitted a reklamo: $reklamotype', 'ereklamo', '$userType')");

        // if($a1 && $a2){
        //     mysqli_commit($conn);
        //     header("location: ../ereklamo.php?error=none"); 
        //     exit();
        // }
        // else{
        //     echo("Error description: " . mysqli_error($conn));
        //     mysqli_rollback($conn);
        //     exit();
        // }

        /*$sql = "INSERT INTO ereklamo(UsersID, reklamoType, detail, status, comment) VALUES(?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../index.php?error=stmtfailedcreatepost");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sssss", $_SESSION["UsersID"], $reklamotype, $detail, $status, $comment); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../ereklamo.php?error=none"); //no errors were made
        exit();*/
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
  	    'Your eReklamo#$id has been responded by $userType $Firstname.', 'ereklamo', 'Resident', $usersID);");
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
        status='Reschedule' WHERE ReklamoID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position, UsersID) VALUES(
  	    'Your eReklamo#$id has been rescheduled by $userType $Firstname.', 'ereklamo', 'Resident', $usersID);");
        $a3 = mysqli_query($conn, "INSERT INTO report(reportType, reportMessage, UsersID, userBarangay, userPurok) VALUES(
  	    'eReklamo','$userType $Firstname has rescheduled ereklamo#$id', '$currentUser', '$userBarangay',
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
            <form action="includes/ereklamo.inc.php?postCatAdd" class="user" method="post">
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
        <div class="container-fluid">
            <form action="includes/ereklamo.inc.php?postCatEdit&catID=<?php echo $_GET['catID'] ?>" class="user" method="post">
                <?php
                $ereklamoCat = $conn->query("SELECT * FROM ereklamocategory WHERE reklamoCatID={$_GET['catID']}");
                $ereklamoRow = $ereklamoCat->fetch_assoc();
                ?>
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
            </form>
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
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Priority: </label>
                        </div>
                        <div class="col">
                            <select name="typePriority" id="typePriority">
                                <option value="<?php echo $ereklamo['reklamoTypePriority']?>" hidden selected><?php echo $ereklamo['reklamoTypePriority']?></option>
                                <option value="Minor">Minor</option>
                                <option value="Major">Major</option>
                            </select>
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

        $a1 = mysqli_query($conn, "INSERT INTO ereklamocategory(reklamoCatName, reklamoCatBrgy) VALUES('$catName', '{$_SESSION['userBarangay']}')");
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

        $a1 = mysqli_query($conn, "INSERT INTO ereklamotype(reklamoTypeName, reklamoTypePriority, reklamoCatID) VALUES('$typeName', '$typePriority', {$_GET['catID']})");
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

        $a1 = mysqli_query($conn, "UPDATE ereklamotype SET reklamoTypeName='{$_POST['typeName']}', reklamoTypePriority='{$_POST['typePriority']}' WHERE reklamoTypeID={$_GET['typeID']}");
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
    
?>