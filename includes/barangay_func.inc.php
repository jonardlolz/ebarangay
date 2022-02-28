<?php
    session_start();
    extract($_POST);
    require_once "dbh.inc.php";
    require_once "functions.inc.php";

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "UPDATE barangay SET City=?, BarangayName=?, Active=? WHERE BarangayID=?";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../barangay.php?error=stmtfailedcreatepost");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssss", $City, $BarangayName, $Active, $id); 
        if(!mysqli_stmt_execute($stmt)){
            echo("Error description: " . mysqli_error($conn));
            exit();
        }
        else{
            mysqli_stmt_close($stmt);
            header("location: ../barangay.php?error=none");
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