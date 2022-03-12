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
    else{
        $id = $UsersID;
        $position = "Purok Leader";
        $sql = "INSERT INTO candidates(UsersID, lastname, firstname, position, electionID, platform, purok)
                SELECT $id, Lastname, Firstname, '$position', '$electionTerm', '$platform', userPurok
                FROM users
                WHERE UsersID=$id";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../election.php?error=stmtfailedcreatepost");
            exit();
        }
 
        if(!mysqli_stmt_execute($stmt)){
            header("location: ../election.php?error=sqlExecError");
            exit();
        }
        else{
            header("location: ../election.php?error=test");
            exit();
        }

        mysqli_stmt_close($stmt);
        
        

    }
?>

