<?php
    session_start();
    extract($_POST);
    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    if(isset($_GET["id"])){
        $checkCapt = $conn->query("SELECT * FROM barangay WHERE BarangayID='{$_GET['id']}'");
        $row = $checkCapt->fetch_assoc();
        if($row['brgyCaptain'] != NULL || $row['brgyCaptain'] == "None"){
            $captID = $row['brgyCaptain'];
            $rmvCpt = $conn->prepare("UPDATE users SET userType='Resident' WHERE UsersID=?"); 
            $rmvCpt->bind_param("s", $captID);
            $rmvCpt->execute();
        }
        $id = $_GET["id"];
        mysqli_begin_transaction($conn);

        $sql = "UPDATE barangay SET City=?, BarangayName=?, Active=?, brgyCaptain=? WHERE BarangayID=?";

        if($row['brgyCaptain'] != "None" && $brgyCaptain != "None"){
            $a1 = mysqli_query($conn, "UPDATE barangay SET City='Mandaue', BarangayName='$BarangayName', Status='$Active', brgyCaptain=$brgyCaptain WHERE BarangayID=$id");
            $a2 = mysqli_query($conn, "UPDATE users SET userType='Captain' WHERE UsersID=$brgyCaptain");
        }
        elseif($brgyCaptain == "None"){
            $a1 = mysqli_query($conn, "UPDATE barangay SET City='Mandaue', BarangayName='$BarangayName', Status='$Active', brgyCaptain=NULL WHERE BarangayID=$id");
            $a2 = mysqli_query($conn, "SELECT * FROM barangay");
        }
        if($a1 && $a2){
            mysqli_commit($conn);
            $sql = $conn->query("SELECT * FROM barangay WHERE BarangayName='$BarangayName'");
            $brgyID = $sql->fetch_assoc();
            header("location: ../barangay_alt.php?barangayID={$brgyID['BarangayID']}");
            exit();
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }
        
        // $stmt = mysqli_stmt_init($conn);
        // if(!mysqli_stmt_prepare($stmt, $sql)){
        //     header("location: ../barangay.php?error=stmtfailedcreatepost");
        //     exit();
        // }

        // mysqli_stmt_bind_param($stmt, "sssss", $City, $BarangayName, $Active, $brgyCaptain, $id); 
        // if(!mysqli_stmt_execute($stmt)){
        //     echo("Error description: " . mysqli_error($conn));
        //     exit();
        // }
        // else{
        //     mysqli_stmt_close($stmt);
        //     header("location: ../barangay.php?error=none");
        //     exit();
        // }
    }
    elseif(isset($_GET['addOfficer'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE users SET userType='$userPosition' WHERE UsersID='$residents'");

        if($a1){
            mysqli_commit($conn);
            $sql = $conn->query("SELECT * FROM barangay WHERE BarangayName={$_GET['barangayName']}");
            $brgyID = $sql->fetch_assoc();
            header("location: ../barangay_alt.php?barangayID={$brgyID['BarangayID']}");
            exit();
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }
    }
    elseif(isset($_GET['removeOfficer'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE users SET userType='Resident' WHERE UsersID='$id'");

        if($a1){
            mysqli_commit($conn);
            header("location: ../barangay.php?error=none");
            exit();
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }
    }


    else{
        $sql = "INSERT INTO barangay(City, BarangayName) VALUES(?, ?)";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../barangay.php?error=stmtfailedcreatepost");
            exit();
        }
        $City = 'City';
        mysqli_stmt_bind_param($stmt, "ss", $City, $BarangayName); 
        if(!mysqli_stmt_execute($stmt)){
            echo("Error description: " . mysqli_error($conn));
            exit();
        }
        mysqli_stmt_close($stmt);
        
        header("location: ../barangay.php?error=none");
        exit();
    }
?>