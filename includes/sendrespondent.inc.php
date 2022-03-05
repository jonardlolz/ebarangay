<?php

    session_start();
    include 'dbh.inc.php';

    if(isset($_GET['reklamoid'])){

        $id = $_GET['reklamoid'];
        $sql = "UPDATE ereklamo SET status=?, checkedBy=?, checkedOn=CURRENT_TIMESTAMP WHERE reklamoID=?";
        $status = "Respondents sent";
        $checkedBy = $_SESSION['Firstname'].' '.$_SESSION['Lastname'];

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../ereklamo.php?error=stmtfailedcreatepost");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sss", $status, $checkedBy, $id); 
        if(!mysqli_stmt_execute($stmt)){
            header("location: ../ereklamo.php?error=sqlExecError");
            exit();
        }
        mysqli_stmt_close($stmt);
        
        header("location: ../ereklamo.php?error=none");
        exit();
    }

?>

