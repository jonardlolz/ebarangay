<?php
    include 'dbh.inc.php';
    session_start();
    extract($_POST);

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "UPDATE candidates SET electionID=?, position=?, platform=? WHERE candidateID = ?";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../account.php?error=stmtfailedcreatepost");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ssss", $electionTerm, $position, $platform, $id); 
        if(!mysqli_stmt_execute($stmt)){
            header("location: ../election.php?error=sqlExecError");
            exit();
        }
        mysqli_stmt_close($stmt);
        
        header("location: ../election.php?error=none");
        exit();

    }
    elseif(!isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "INSERT INTO candidates(UsersID, lastname, firstname, position, electionID, platform, purok)
                SELECT ?, Lastname, Firstname, ?, ?, ?, userPurok
                FROM users
                WHERE UsersID=?";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../account.php?error=stmtfailedcreatepost");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sssss", $UsersID, $position, $electionTerm, $platform, $UsersID); 
        if(!mysqli_stmt_execute($stmt)){
            header("location: ../election.php?error=sqlExecError");
            exit();
        }
        mysqli_stmt_close($stmt);
        
        header("location: ../election.php?error=none");
        exit();

    }
?>

