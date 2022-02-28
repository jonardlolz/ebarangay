<?php
    session_start();
    include 'dbh.inc.php';

    $usersID = $_SESSION["UsersID"];
    extract($_POST);
    $postID = $post_id;
    $finComment = $comment;
    $sql = "INSERT INTO comments(UsersID, PostID, comment) VALUES ($usersID, $postID, '$finComment')";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailedcreatepost");
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }
    mysqli_stmt_close($stmt);
    
    
    header("location: ../index.php?test=1"); //redirects to main page after successful login
    exit();

?>