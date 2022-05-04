<?php
    session_start();
    extract($_POST);
    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    if(isset($_GET["id"])){
        $checkLeader = $conn->query("SELECT * FROM purok WHERE PurokID='{$_GET['id']}'");
        $row = $checkLeader->fetch_assoc();
        if($row['purokLeader'] != NULL || $row['purokLeader'] == "None"){
            $leaderID = $row['purokLeader'];
            $rmvLdr = $conn->prepare("UPDATE users SET userType='Resident' WHERE UsersID=?"); 
            $rmvLdr->bind_param("s", $leaderID);
            $rmvLdr->execute();
        }
        $id = $_GET["id"];
        mysqli_begin_transaction($conn);

        $sql = "UPDATE purok SET BarangayName=?, PurokName=?, Active=?, purokLeader=? WHERE PurokID=?";

        if($row['purokLeader'] != "None" && $purokLeader != "None"){
            $a1 = mysqli_query($conn, "UPDATE purok SET BarangayName='$BarangayName', PurokName='$PurokName', Active='$Active', purokLeader=$purokLeader WHERE PurokID=$id");
            $a2 = mysqli_query($conn, "UPDATE users SET userType='Purok Leader' WHERE UsersID=$purokLeader");
        }
        elseif($purokLeader == "None"){
            $a1 = mysqli_query($conn, "UPDATE purok SET BarangayName='$BarangayName', PurokName='$PurokName', Active='$Active', purokLeader=NULL WHERE PurokID=$id");
            $a2 = mysqli_query($conn, "SELECT * FROM purok");
        }
        
        
        
        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../purok.php?error=none");
            exit();
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }
    }

    elseif(isset($_GET['addPurok'])){
        $sql = "INSERT INTO purok(PurokName, BarangayName) VALUES(?, ?)";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../purok.php?error=stmtfailedcreatepost");
            exit();
        }
        $BarangayName = $_GET['barangayName'];
        mysqli_stmt_bind_param($stmt, "ss", $PurokName, $BarangayName); 
        if(!mysqli_stmt_execute($stmt)){
            echo("Error description: " . mysqli_error($conn));
            exit();
        }
        mysqli_stmt_close($stmt);
        
        header("location: ../purok.php?error=none");
        exit();
    }
?>