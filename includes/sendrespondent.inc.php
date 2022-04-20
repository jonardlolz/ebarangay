<?php

    session_start();
    include 'dbh.inc.php';
    $id = NULL;
    extract($_POST);

    if(isset($_GET['reklamoid'])){

        $id = $_GET['reklamoid'];
        $usersID = $_GET['usersID'];
        // $sql = "UPDATE ereklamo SET status=?, checkedBy=?, checkedOn=CURRENT_TIMESTAMP WHERE reklamoID=?";
        // $status = "Respondents sent";
        // $checkedBy = $_SESSION['Firstname'].' '.$_SESSION['Lastname'];

        // $stmt = mysqli_stmt_init($conn);
        // if(!mysqli_stmt_prepare($stmt, $sql)){
        //     header("location: ../ereklamo.php?error=stmtfailedcreatepost");
        //     exit();
        // }

        // mysqli_stmt_bind_param($stmt, "sss", $status, $checkedBy, $id); 
        // if(!mysqli_stmt_execute($stmt)){
        //     header("location: ../ereklamo.php?error=sqlExecError");
        //     exit();
        // }
        // mysqli_stmt_close($stmt);
        
        // header("location: ../ereklamo.php?error=none");
        // exit();
        mysqli_begin_transaction($conn);

        $checkedBy = $_SESSION['Firstname'].' '.$_SESSION['Lastname'];

        $a1 = mysqli_query($conn, "UPDATE ereklamo SET status='Respondents sent', checkedBy='$checkedBy', checkedOn=CURRENT_TIMESTAMP WHERE reklamoID=$id");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, UsersID, type, position) VALUES('Respondents has been sent for your ReklamoID#$id', $usersID, 'ereklamo', 'Resident')");

        if($a1 && $a2){
            mysqli_commit($conn);
            header("location: ../ereklamo.php?error=none"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }

    }
    if(isset($_GET['add'])){?>
        <div class="container-fluid">
            <form action="includes/sendrespondent.inc.php?postadd" class="user" method="post">
                <select class="form-select form-select-lg" id="users" placeholder="users" name="users" required>
                    <option value="none" disabled hidden selected>Name</option>
                    <?php   $sql = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name 
                            FROM users WHERE userBarangay='{$_SESSION['userBarangay']}' AND userPurok='{$_SESSION['userPurok']}'
                            AND barangayPos='None' AND VerifyStatus='Verified' AND userType='Resident'");
                            while($row=$sql->fetch_assoc()): 
                    ?>
                    <option value="<?php echo $row['UsersID'] ?>"><?php echo $row['name'] ?></option>
                    <?php endwhile; ?>
                </select>

                <select class="form-select form-select-lg" id="barangayPos" placeholder="barangayPos" name="barangayPos" required>
                    <option value="none" disabled hidden selected>Respondent type</option>
                    <option value="Tanod">Tanod</option>
                    <option value="Electrician">Electrician</option>
                    <option value="Plumber">Plumber</option>
                    <option value="Construction">Construction</option>
                </select>
            
            <div class="modal-footercustom">
                <button type="submit" class="btn btn-primary" name="submit" id="submit">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
        <style>
            #uni_modal .modal-footer{
                display: none;
            }
            #uni_modal .modal-footer.display{
                display: block !important;
            }

            .modal-footercustom {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: flex-end;
                padding: 0.75rem;
                border-top: 1px solid #e3e6f0;
                border-bottom-right-radius: calc(0.3rem - 1px);
                border-bottom-left-radius: calc(0.3rem - 1px);
            }

            .modal-footercustom > * {
                margin: 0.25rem;
            }
        </style>
    <?php }
    if(isset($_POST['submit'])){
        extract($_POST);
        echo($barangayPos. ' '. $users);
        $sql = "UPDATE users SET barangayPos='$barangayPos' WHERE UsersID=$users";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../residents.php?error=stmtfailedcreatepost");
            echo("Error description: " . $mysqli -> error);
            exit();
        }
        if(!mysqli_stmt_execute($stmt)){
            header("location: ../residents.php?error=sqlExecError");
            echo("Error description: " . $mysqli -> error);
            exit();
        }
        mysqli_stmt_close($stmt);
        header("location: ../residents.php?error=none"); //no errors were made
        exit();
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
            header("location: ../residents.php?error=stmtfailedcreatepost");
            exit();
        }

        if(!mysqli_stmt_execute($stmt)){
            header("location: ../residents.php?error=sqlExecError");
            exit();
        }
        mysqli_stmt_close($stmt);
        header("location: ../residents.php?error=none"); //no errors were made
        exit();
    }
    if(isset($_GET['postedit'])){
        $id = $_GET['postedit'];
        $sql = "UPDATE users SET barangayPos='{$_POST['barangayPos']}' WHERE UsersID='{$_GET['postedit']}'";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../residents.php?error=stmtfailedcreatepost");
            exit();
        }

        if(!mysqli_stmt_execute($stmt)){
            header("location: ../residents.php?error=sqlExecError");
            exit();
        }
        mysqli_stmt_close($stmt);
        
        header("location: ../residents.php?error=none");
        exit();
    }

?>

<style>
	
</style>