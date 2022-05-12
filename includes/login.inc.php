<!-- handles the script for logging in -->

<?php
    if(isset($_POST["submit"])){

        $username = $_POST["username"];
        $password = $_POST["password"];

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        if(emptyInputLogin($username, $password) !== false){ //check if all inputs aren't empty
            header("location: ../login.php?error=emptyinput"); //return to login.php with an error msg
            exit();    //stop the script
        }

        loginUser($conn, $username, $password);

    }
    else{
        header("location: ../login.php?error=error");
        exit();
    }

?>