<?php
    include 'dbh.inc.php';
    session_start();
    extract($_POST);

    if(isset($_GET['verify'])){

        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE users SET VerifyStatus='Verified' WHERE UsersID='{$_GET['verify']}'");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID) VALUES('Your account verification has been approved!', 'Resident', '{$_GET['verify']}');");

        if($a1 && $a2){
            mysqli_commit($conn);
        }
        else{
            mysqli_rollback($conn);
    
        }
    }
    elseif(isset($_GET['unverify'])){
        
        mysqli_begin_transaction($conn);

            $a1 = mysqli_query($conn, "UPDATE users SET VerifyStatus='Unverified' WHERE UsersID='{$_GET['unverify']}'");
            $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID) VALUES('Your account verification has been denied!', 'Resident', '{$_GET['unverify']}');");

            if($a1 && $a2){
                mysqli_commit($conn);
            }
            else{
                mysqli_rollback($conn);
            }
        }

    /*$sql = "UPDATE users SET VerifyStatus='Verified' WHERE UsersID=$id";
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

    header("location: ../index.php?error=none"); //no errors were made
    exit();*/
    ?>

<?php if(isset($_GET['viewVerify'])): ?>
    <style>
        #uni_modal .modal-footer{
            display: none;
        }
        #uni_modal .modal-footer.display{
            display: block !important;;
        }
    </style>
    <div class="container-fluid">  
        <form action="">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <input type="radio" id="renter" value="renter" name="residentStat"
                        onclick="ShowHideDiv()">
                        <label for="">Is Renter?</label>
                    </div>
                    <div class="col">
                        <input type="radio" id="landlord" value="landlord" name="residentStat" onclick="ShowHideDiv()">
                        <label for="">Is Landlord?</label>
                    </div>
                </div>
                <div class="row" id="renterStat" style="display: none">
                    <hr>
                    <div class="col">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Landlord's Name: </label>
                            </div>
                            <div class="col-sm-4">
                                <select name="landlordName" id="landlordName">
                                    <option value="">Landlord's name</option>
                                    <?php 
                                        $landlord = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM users WHERE userBarangay='{$_SESSION['userBarangay']}' AND userPurok='{$_SESSION['userPurok']}' AND IsLandlord='True'");
                                        while($landlordRow = $landlord->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $lardlordRow['UsersID'] ?>"><?php echo $lardlordRow['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Date rented: </label>    
                            </div>
                            <div class="col-sm-4">
                                <input type="date" name="date" id="date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="landlordStat" style="display: none">

                </div>
            </div>
        </form>
    </div>
<?php endif; ?>

<script>
    function ShowHideDiv(){
        var renter = document.getElementById("renter");
        var landlord = document.getElementById("landlord");
        var divRenter = document.getElementById("renterStat");
        renterStat.style.display = renter.checked ? "block" : "none";

    }
</script>