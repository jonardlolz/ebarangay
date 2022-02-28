<?php
    include 'dbh.inc.php';
    session_start();
    extract($_POST);

    if(isset($_POST["submit"])){
        $usersID = $_SESSION["UsersID"];
        $Captain = $_POST["Captain"];
        $Secretary = $_POST["Secretary"];
        $Treasurer = $_POST["Treasurer"];
        $PurokLeader = $_POST["PurokLeader"];
        $electionID = $_GET["electionID"];

        if(count($_POST) > 4){
            mysqli_begin_transaction($conn);

            $a1 = mysqli_query($conn, "INSERT INTO votes(candidateID, electionID, UsersID, position) VALUES($Captain, $electionID, $usersID, 'Captain');");
            $a2 = mysqli_query($conn, "INSERT INTO votes(candidateID, electionID, UsersID, position) VALUES($Secretary, $electionID, $usersID, 'Secretary');");
            $a3 = mysqli_query($conn, "INSERT INTO votes(candidateID, electionID, UsersID, position) VALUES($Treasurer, $electionID, $usersID, 'Purok Leader');");
            $a4 = mysqli_query($conn, "INSERT INTO votes(candidateID, electionID, UsersID, position) VALUES($PurokLeader, $electionID, $usersID, 'Treasurer');");
            
            if($a1 && $a2 && $a3 && $a4){
                mysqli_commit($conn);
                header("location: ../election.php?error=error");
            }
            else{
                echo("Error description: " . mysqli_error($conn));
                mysqli_rollback($conn);
            }
            /*$sql = "INSERT INTO votes(candidateID, UsersID, position) VALUES($Captain, $usersID, 'Captain');
            INSERT INTO votes(candidateID, UsersID, position) VALUES($Secretary, $usersID, 'Secretary');
            INSERT INTO votes(candidateID, UsersID, position) VALUES($Treasurer, $usersID, 'Purok Leader');
            INSERT INTO votes(candidateID, UsersID, position) VALUES($PurokLeader, $usersID, 'Treasurer');";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                echo("Error description: " . mysqli_error($conn));
            }
            else{
            header("location: ../request.php?error=none"); //no errors were made
            exit();
            }*/
        }
        else{
            header("location: ../election.php?error=error");
            exit();
        }
    }
?>