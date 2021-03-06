<?php
    include 'dbh.inc.php';
    session_start();
    extract($_POST);

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "UPDATE election SET electionTitle='{$electionTitle}' WHERE electionID=$id";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo("Error description: " . mysqli_error($conn));
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
    elseif(!isset($_GET["id"])){
        $sql = $conn->query("SELECT * FROM election WHERE barangay='{$_SESSION['userBarangay']}' AND purok='$electionPurok' AND (electionStatus='Ongoing' OR electionStatus='Paused')");
        $row_cnt = mysqli_num_rows($sql);
        if($row_cnt <= 0){
        $id = $_SESSION["UsersID"];
        $sql = "INSERT INTO election(electionTitle, created_by, barangay, purok) 
                SELECT '{$electionTitle}', $id, users.userBarangay, '$electionPurok'
                FROM users
                WHERE UsersID=$id";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo("Error description: " . mysqli_error($conn));
            exit();
        }
        if(!mysqli_stmt_execute($stmt)){
            echo("Error description: " . mysqli_error($conn));
            header("location: ../election.php?error=sqlExecError");
            exit();
        }
        mysqli_stmt_close($stmt);
        
        header("location: ../election.php?error=none");
        exit();
        }
        else{
            header("location: ../election.php?error=alreadyExists");
            exit();
        }
    }
?>

