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
        #continue_modal .modal-footer{
            display: none;
        }
        #continue_modal .modal-footer.display{
            display: block !important;
        }

    </style>
    <div class="container-fluid">  
        <form action="includes/verify.inc.php?continueVerify">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <input type="radio" id="resident" value="resident" name="residentStat"
                        onclick="ShowHideDiv()" checked>
                        <label for="">Resident</label>
                    </div>
                    <div class="col">
                        <input type="radio" id="renter" value="renter" name="residentStat"
                        onclick="ShowHideDiv()">
                        <label for="">Renter</label>
                    </div>
                    <div class="col">
                        <input type="radio" id="landlord" value="landlord" name="residentStat" onclick="ShowHideDiv()">
                        <label for="">Landlord</label>
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
                                <select name="landlordName" id="landlordName" required>
                                    <option value="">Landlord's name</option>
                                    <?php 
                                        $landlord = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM users WHERE userBarangay='{$_SESSION['userBarangay']}' AND userPurok='{$_SESSION['userPurok']}' AND IsLandlord='True'");
                                        while($landlordRow = $landlord->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $landlordRow['UsersID'] ?>"><?php echo $landlordRow['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="">Date rented: </label>    
                            </div>
                            <div class="col-sm-4">
                                <input type="date" name="date" id="date" max="<?php echo date("Y-m-d") ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="landlordStat" style="display: none">

                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer display py-1 px-1" style="float:right;">
        <div class="d-block w-100">
            <button type="button" class="continue_verify btn btn-primary" data-id="<?php echo $_GET['viewVerify'] ?>" >Continue</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        
    </div>

    
    <script>
        $('.continue_verify').click(function(){
            uni_modal("<center><b>Confirm Information</b></center></center>","includes/verify.inc.php?continueVerify="+$(this).attr('data-id'),"modal-lg")
        })
    </script>
<?php elseif(isset($_GET['continueVerify'])): ?>
    <?php 
        $profile = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM users WHERE UsersID='{$_GET['continueVerify']}'");
        $row=$profile->fetch_assoc();
    ?>
    <div class="container-fluid">
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="col d-flex flex-column px-4">
                        <div class="card rounded shadow" style="background-color: #dcdce4;">
                            <!--Card-header-->
                            <div class="card-header">
                                <div class="text-center text-dark">
                                    <div class="user-avatar w-100 d-flex justify-content-center">
                                        <span class="position-relative">
                                            <img src="img/<?php echo $row["profile_pic"]; ?>" alt="Maxwell Admin" class="img-fluid img-thumbnail rounded-circle <?php 
                                                if($row["userType"] == "Resident"){
                                                    echo "img-res-profile";
                                                }
                                                elseif($row["userType"] == "Purok Leader"){
                                                    echo "img-purokldr-profile";
                                                }
                                                elseif($row["userType"] == "Captain"){
                                                    echo "img-capt-profile";
                                                }
                                                elseif($row["userType"] == "Secretary"){
                                                    echo "img-sec-profile";
                                                }
                                                elseif($row["userType"] == "Treasurer"){
                                                    echo "img-treas-profile";
                                                }
                                                elseif($row["userType"] == "Admin"){
                                                    echo "img-admin-profile";
                                                }
                                            ?>" style="width:150px; height:150px">
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#ppModal" class="text-dark position-absolute rounded-circle img-thumbnail d-flex justify-content-center align-items-center" style="top:75%;left:75%;width:30px;height: 30px">
                                                <i class="fas fa-camera"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <div class="mt-2">
                                        <h5 class="font-weight-bold"><?php echo $row['name'] ?></h5>
                                        <h6 readonly><?php echo $_SESSION["emailAdd"]; ?></h6>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <!--Trigger Button Chat-->
                                    <?php if($row['VerifyStatus'] == 'Verified'): ?>
                                        <i class="fas fa-user-check fa-lg" alt="Verified" style="color: #0ca678"></i>
                                    <?php elseif($row['VerifyStatus'] == 'Unverified'): ?>  
                                        <i class="fas fa-user-slash fa-lg" alt="Unverified" style="color: #e63d2e"></i>
                                    <?php elseif($row['VerifyStatus'] == 'Pending'): ?>
                                        <i class="fas fa-user fa-lg" alt="Pending verification"></i>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!--End of Card-Header-->
                            <!--Card-Body-->
                            <div class="card-body text-dark">
                                <div class="row">
                                    <div class="col">
                                        <div class="p-2">
                                            <div>
                                                <strong>Personal Information</strong><hr>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="labels">Gender:</label>
                                                </div>
                                                <div class="col">
                                                    <label for=""><?php echo $row["userGender"] ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="labels">Civil Status:</label>
                                                </div>
                                                <div class="col">
                                                    <label for=""><?php echo $row["civilStat"] ?></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="labels">Birthdate:</label>
                                                </div>
                                                <div class="col">
                                                    <label for=""><?php echo date_format(date_create($row["dateofbirth"]), "m/d/Y") ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2">
                                            <div>
                                                <strong>Address Information</strong><hr>
                                            </div>
                                            <div class="row-md-4 row-sm-4">
                                                <label class="labels">House Number</label>
                                                <input type="text" class="form-control w-75" placeholder="houseNum" value="<?php echo $row["userHouseNum"] ?>" readonly>
                                                <label class="labels">Purok</label>
                                                <input type="text" class="form-control w-75" placeholder="Barangay" value="<?php echo $row["userPurok"] ?>" readonly>
                                                <label class="labels">Barangay</label>
                                                <input type="text" class="form-control w-75" placeholder="Barangay" value="<?php echo $row["userBarangay"] ?>" readonly>
                                                <label class="labels">Municipality/City</label>
                                                <input type="text" class="form-control w-75" placeholder="City" value="<?php echo $row["userCity"] ?>" readonly>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End of Card-Body-->
                        </div>
                    </div>
                </div>
                <div class="col">
                    test
                </div>
            </div>
        </div>
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