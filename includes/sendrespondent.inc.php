<?php

    session_start();
    include 'dbh.inc.php';
    $id = NULL;
    extract($_POST);

    if(isset($_GET['reklamoid'])){

        $id = $_GET['reklamoid'];
        $sql = "UPDATE ereklamo SET status=?, checkedBy=?, checkedOn=CURRENT_TIMESTAMP WHERE reklamoID=?";
        $status = "Respondents sent";
        $checkedBy = $_SESSION['Firstname'].' '.$_SESSION['Lastname'];

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../ereklamo.php?error=stmtfailedcreatepost");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sss", $status, $checkedBy, $id); 
        if(!mysqli_stmt_execute($stmt)){
            header("location: ../ereklamo.php?error=sqlExecError");
            exit();
        }
        mysqli_stmt_close($stmt);
        
        header("location: ../ereklamo.php?error=none");
        exit();
    }
    if(isset($_GET['add'])){
        
    }
    if(isset($_GET['edit'])){?>
        <div class="container-fluid">
            <form action="includes/sendrespondent.inc.php?postedit=<?php echo $_GET['edit'] ?> " class="user" method="post">
                <?php   $sql = $conn->query("SELECT * FROM users WHERE '{$_GET['edit']}'");
                        $row=$sql->fetch_assoc(); 
                ?>
                <select class="form-select form-select-lg" id="barangayPos" placeholder="barangayPos" name="barangayPos" required>
                    <option value="none" disabled hidden selected>Respondent type</option>
                    <option value="Tanod">Tanod</option>
                    <option value="Electrician">Electrician</option>
                    <option value="Plumber">Plumber</option>
                    <option value="Construction">Construction</option>
                </select>
            </form>
        </div>

    <?php }
    if($id != NULL){
        $sql = "UPDATE users SET barangayPos='None' WHERE UsersID=$id";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../respondent.php?error=stmtfailedcreatepost");
            exit();
        }

        if(!mysqli_stmt_execute($stmt)){
            header("location: ../respondent.php?error=sqlExecError");
            exit();
        }
        mysqli_stmt_close($stmt);
        header("location: ../respondent.php?error=none"); //no errors were made
        exit();
    }
    if(isset($_GET['postedit'])){
        $id = $_GET['postedit'];
        $sql = "UPDATE users SET barangayPos='{$_POST['barangayPos']}' WHERE UsersID='{$_GET['postedit']}'";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../respondent.php?error=stmtfailedcreatepost");
            exit();
        }

        if(!mysqli_stmt_execute($stmt)){
            header("location: ../respondent.php?error=sqlExecError");
            exit();
        }
        mysqli_stmt_close($stmt);
        
        header("location: ../respondent.php?error=none");
        exit();
    }

?>

