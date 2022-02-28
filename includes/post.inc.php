<?php
    session_start();
    extract($_POST);

    if(isset($_POST["submit"]))
    {
        $usersID = $_SESSION["UsersID"];
        $username = $_SESSION["username"];
        $userType = $_SESSION["userType"];
        $postContent = $_POST["postContent"];
        
        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        if(emptyInputPost($username, $postContent, $userType, $usersID) !== false)
        {
            header("location: ../index.php?error=emptyContent");
            exit();
        }
        
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $sql = "UPDATE post SET postMessage=? WHERE PostID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location: ../index.php?error=stmtfailedcreatepost");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ss", $postContent, $id); 
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if(isset($img)){
                $id = mysqli_insert_id($conn);
                echo $id;
				mkdir('../img/'.$id);
				for($i = 0 ; $i< count($img);$i++){
					list($type, $img[$i]) = explode(';', $img[$i]);
					list(, $img[$i])      = explode(',', $img[$i]);
					$img[$i] = str_replace(' ', '+', $img[$i]);
					$img[$i] = base64_decode($img[$i]);
					$fname = strtotime(date('Y-m-d H:i'))."_".$imgName[$i];
					$upload = file_put_contents('../img/'.$id.'/'.$fname,$img[$i]);
					$data = " file_path = '".$fname."' ";
				}
            }
            
            header("location: ../index.php?error=none");
            exit();
        }
        else{
            $sql = "INSERT INTO post(UsersID, username, userType, postMessage) VALUES(?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location: ../index.php?error=stmtfailedcreatepost");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ssss", $usersID, $username, $userType, $postContent); 
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            
            
            if(isset($img)){
                $id = mysqli_insert_id($conn);
                echo $id;
				mkdir('../img/'.$id);
				for($i = 0 ; $i< count($img);$i++){
					list($type, $img[$i]) = explode(';', $img[$i]);
					list(, $img[$i])      = explode(',', $img[$i]);
					$img[$i] = str_replace(' ', '+', $img[$i]);
					$img[$i] = base64_decode($img[$i]);
					$fname = strtotime(date('Y-m-d H:i'))."_".$imgName[$i];
					$upload = file_put_contents('../img/'.$id.'/'.$fname,$img[$i]);
					$data = " file_path = '".$fname."' ";
				}
            }

            header("location: ../index.php?error=none");
            exit();
        }
        
    }


?>