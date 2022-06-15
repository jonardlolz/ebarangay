<?php
    session_start();
    extract($_POST);
    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    if(isset($_GET["id"])){
        if($_SESSION['userType'] != "Admin"){
            $checkLeader = $conn->query("SELECT * FROM purok WHERE PurokID='{$_GET['id']}'");
            while($row = $checkLeader->fetch_assoc()){
                if($row['purokLeader'] != NULL || $row['purokLeader'] == "None"){
                    $leaderID = $row['purokLeader'];
                    $rmvLdr = $conn->prepare("UPDATE users SET userType='Resident' WHERE UsersID=?"); 
                    $rmvLdr->bind_param("s", $leaderID);
                    $rmvLdr->execute();
                }
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
        }
        else{
            $id = $_GET["id"];
            $a1 = mysqli_query($conn, "UPDATE purok SET BarangayName='$BarangayName', PurokName='$PurokName', Active='$Active', purokLeader=NULL WHERE PurokID=$id");
            $a2 = mysqli_query($conn, "SELECT * FROM purok");
            
            if($a1 && $a2){
                mysqli_commit($conn);
                header("location: ../purok.php");
                exit();
            }
            else{
                echo("Error description: ".mysqli_error($conn));
                mysqli_rollback($conn);
                exit();
            }
        }
    }

    elseif(isset($_GET['addPurok'])){
        $PurokName = $_POST['PurokName'];
        mysqli_begin_transaction($conn);
        if($_SESSION['userType'] == 'Admin'){
            $duplicateCheck = $conn->query("SELECT * FROM purok WHERE PurokName='$PurokName' AND BarangayName='{$_POST['barangayName']}'");
        }
        else{
            $duplicateCheck = $conn->query("SELECT * FROM purok WHERE PurokName='$PurokName' AND BarangayName='{$_SESSION['userBarangay']}'");
        }
        
        $row_cnt = $duplicateCheck->num_rows;
        if($row_cnt > 0){
            if($_SESSION['userType'] == 'Admin'){
                 header("location: ../purok.php?"."error=purokduplicate");
                exit();
            }
            else{
                header("location: ../barangay_alt.php?barangayID=" . $_GET['barangayID']."&error=purokduplicate");
                exit();
            }
        }


        
        if(isset($_GET['barangayName'])){
            $BarangayName = $_GET['barangayName'];
        }
        else{
            $BarangayName = $_POST['barangayName'];
        }
        
        $a1 = mysqli_query($conn, "INSERT INTO purok(PurokName, BarangayName) VALUES('$PurokName', '$BarangayName')");

        if($a1){
            mysqli_commit($conn);
            if($_SESSION['userType'] != 'Admin'){
                header("location: ../barangay_alt.php?barangayID=" . $_GET['barangayID']);
                exit();
            }
            else{
                header("location: ../purok.php");
                exit();
            }
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }
        
        
    }
?>