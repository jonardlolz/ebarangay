<?php

include 'dbh.inc.php';
session_start();
extract($_POST);

if(isset($_POST["id"])){
    $id = $_POST["id"];

    $election = $conn->query("SELECT electionID, UsersID, candidateID, MAX(voteResults), position 
    FROM (SELECT candidates.UsersID, votes.candidateID, COUNT(votes.candidateID) as voteResults, votes.position, votes.electionID
    FROM votes INNER JOIN candidates ON candidates.candidateID = votes.candidateID
    GROUP BY candidateID) as results
    WHERE electionID=$id
    GROUP BY position;");
    while($frow = $election->fetch_assoc()){
        $sql = "UPDATE users SET userType=? WHERE UsersID = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../account.php?error=stmtfailedcreatepost");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $frow["position"], $frow["UsersID"],); 
        if(!mysqli_stmt_execute($stmt)){
            header("location: ../election.php?error=sqlExecError");
            exit();
        }
    }

    
    mysqli_stmt_close($stmt);
    
    header("location: ../election.php?error=none");
    exit();

}

?>