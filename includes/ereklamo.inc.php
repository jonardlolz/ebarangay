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
        $reklamotype = $_POST["reklamotype"];
        $detail = $_POST["detail"];
        $comment = $_POST["comment"];
        $status = "Pending";
        $complainee = $_POST["resident"];
        if($reklamotype == "Resident"){
            if($complainee == ""){  
                header("location: ../ereklamo.php?error=noResident");
                exit();
            }
            else{
                $complaintLevel = "Major";
                $userType =  "Secretary";
            }
        }
        else{
            $complaintLevel = "Minor";
            $userType =  "Purok Leader";
        }

        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "INSERT INTO ereklamo(UsersID, reklamoType, detail, status, comment, complainee, complaintLevel, barangay, purok) VALUES({$_SESSION["UsersID"]}, '$reklamotype', '$detail', '$status', '$comment', '$complainee', '$complaintLevel', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position) VALUES('A resident has submitted a reklamo: $reklamotype', 'ereklamo', '$userType')");

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

        if($a3){
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
        $a4 = mysqli_query($conn, "INSERT INTO schedule(scheduleDate, ereklamoID, UsersID, complainee) 
                                    SELECT '$schedule', $id, UsersID, complainee
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

        /*$sql = "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
        status='Scheduled', scheduledSummon='$schedule' WHERE ReklamoID=$id";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo("Error description: " . mysqli_error($conn));
            exit();
        }
    
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);*/

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

        // $a1 = mysqli_query($conn, "UPDATE ereklamo SET checkedOn=CURRENT_TIMESTAMP, checkedBy=$managedBy, 
        // status='To be scheduled' WHERE ReklamoID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, position, UsersID) VALUES(
  	    'Your eReklamo$#$id has been responded by $userType $Firstname.', 'ereklamo', 'Resident', $usersID);");
        // $a3 = mysqli_query($conn, "INSERT INTO report(reportType, reportMessage, UsersID, userBarangay, userPurok) VALUES(
  	    // 'eReklamo','$userType $Firstname has resolved ereklamo#$id', '$currentUser', '$userBarangay',
        //   '$userPurok');");

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
?>