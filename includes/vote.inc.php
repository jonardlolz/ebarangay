<?php
    include 'dbh.inc.php';
    session_start();
    extract($_POST);

    if(isset($_POST["submit"])){
        if($_POST["PurokLeader"] == NULL){
            header("location: ../election.php?error=error");
            exit();
        }
        $usersID = $_SESSION["UsersID"];
        $PurokLeader = $_POST["PurokLeader"];
        $electionID = $_GET["electionID"];

        if(count($_POST) > 0){
            mysqli_begin_transaction($conn);

            $a4 = mysqli_query($conn, "INSERT INTO votes(candidateID, electionID, UsersID, position) VALUES($PurokLeader, $electionID, $usersID, 'Purok Leader');");
            
            if($a4){
                mysqli_commit($conn);
                header("location: ../election.php?error=none");
            }
            else{
                echo("Error description: " . mysqli_error($conn));
                mysqli_rollback($conn);
            }
            // $sql = "INSERT INTO votes(candidateID, UsersID, position) VALUES($Captain, $usersID, 'Captain');
            // INSERT INTO votes(candidateID, UsersID, position) VALUES($Secretary, $usersID, 'Secretary');
            // INSERT INTO votes(candidateID, UsersID, position) VALUES($Treasurer, $usersID, 'Purok Leader');
            // INSERT INTO votes(candidateID, UsersID, position) VALUES($PurokLeader, $usersID, 'Treasurer');";
            // $stmt = mysqli_stmt_init($conn);
            // if(!mysqli_stmt_prepare($stmt, $sql)){
            //     echo("Error description: " . mysqli_error($conn));
            // }
            // else{
            // header("location: ../request.php?error=none"); //no errors were made
            // exit();
            // }
        }
        else{
            header("location: ../election.php?error=error");
            exit();
        }
    }
?>