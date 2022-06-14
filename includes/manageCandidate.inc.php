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
    elseif(isset($_GET['acceptNomination'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE candidates SET status='Accepted' WHERE UsersID=$id ORDER BY created_at DESC LIMIT 1");
        if($a1){
            mysqli_commit($conn);
            header("location: ../election.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }
    }
    elseif(isset($_GET['declineNomination'])){
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE candidates SET status='Declined' WHERE UsersID=$id ORDER BY created_at DESC LIMIT 1");
        if($a1){
            mysqli_commit($conn);
            header("location: ../election.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }
    }
    else{
        echo($resident);
        $id = $_POST['resident'];
        $position = "Purok Leader";
        $sql = "INSERT INTO candidates(UsersID, lastname, firstname, position, electionID, platform, purok)
                SELECT $id, Lastname, Firstname, '$position', '$electionTerm', '$platform', userPurok
                FROM users
                WHERE UsersID=$id";

        mysqli_begin_transaction($conn);

        $checkedBy = $_SESSION['Firstname'].' '.$_SESSION['Lastname'];

        $a1 = mysqli_query($conn, "INSERT INTO candidates(UsersID, lastname, firstname, position, electionID, platform, purok)
                SELECT $id, Lastname, Firstname, '$position', '$electionTerm', '$platform', userPurok
                FROM users
                WHERE UsersID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, UsersID, type, position) VALUES('You have been nominated to run as Purok Leader by your Captain! Please click here to accept or decline the nomination!', $id, 'nomination', 'Resident')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../election.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }
    }
?>

