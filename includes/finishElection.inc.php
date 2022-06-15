<?php

include 'dbh.inc.php';
session_start();
extract($_POST);

if(isset($_GET['finish'])){
    $id = $_POST['id'];

    $election = $conn->query("SELECT electionID, UsersID, candidateID, MAX(voteResults), position 
    FROM (SELECT candidates.UsersID, votes.candidateID, COUNT(votes.candidateID) as voteResults, votes.position, votes.electionID
    FROM votes INNER JOIN candidates ON candidates.candidateID = votes.candidateID
    GROUP BY candidateID) as results
    WHERE electionID=$id
    GROUP BY position;");
    while($frow = $election->fetch_assoc()){
        $info = $conn->query("SELECT * FROM election WHERE electionID = $id");
        $row = $info->fetch_assoc();
        
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE users SET userType='Resident' WHERE userBarangay='{$row['barangay']}' AND userPurok='{$row['purok']}' AND userType='Purok Leader';");
        $a2 = mysqli_query($conn, "UPDATE users SET userType='{$frow["position"]}' WHERE UsersID = '{$frow["UsersID"]}';");
        $a3 = mysqli_query($conn, "UPDATE purok SET purokLeader={$frow["UsersID"]} WHERE PurokName='{$row['purok']}' AND BarangayName='{$row['barangay']}'");
        $a4 = mysqli_query($conn, "UPDATE election SET electionStatus='Finished' WHERE electionID = $id;");
        

        if($a1 && $a2 && $a3 && $a4){
            mysqli_commit($conn);
            header("location: ../election.php?error=none");
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
        }
    }

    
    mysqli_stmt_close($stmt);
    
    header("location: ../election.php?error=none");
    exit();

}

else if(isset($_GET['cancel'])){
    $sql = $conn->query("UPDATE election SET electionStatus='Cancelled' WHERE electionID=$id");

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../election.php?error=stmtfailed");
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        header("location: ../election.php?error=sqlExecError");
        exit();
    }

    mysqli_stmt_close($stmt);
    
    header("location: ../election.php?error=none");
    exit();
}

else if(isset($_GET['start'])){
    $sql = $conn->query("UPDATE election SET electionStatus='Ongoing' WHERE electionID=$id");

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../election.php?error=stmtfailed");
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        header("location: ../election.php?error=sqlExecError");
        exit();
    }

    mysqli_stmt_close($stmt);
    
    header("location: ../election.php?error=none");
    exit();
}

?>