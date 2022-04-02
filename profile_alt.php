<?php 
    if(!isset($_GET['viewProfile'])){
        include_once 'header.php';
    }
    else{
        session_start();
        include 'includes/dbh.inc.php';
    }

    $profile = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM users WHERE UsersID='{$_GET['UsersID']}'");
    $row=$profile->fetch_assoc();
?>

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
                    <a href="javascript:void(0)"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editProfileModal" data-backdrop="static"></i></a>
                    <!--<button title="oas&#10;djaosjdsoajdjaosdj\nasdasdasdasdasd" type="button" class="btn m-0 btn-circle" onclick="openForm()">
                        <i class="fas fa-comments fw"></i>
                    </button>-->
                    <?php if($_SESSION['userType'] == "Resident"): ?>
                    <a href="javascript:void(0)"><i class="fas fa-file fa-lg" data-toggle="modal" data-target="#requestHistoryModal" data-backdrop="static"></i></a>
                    
                    <?php else: ?>
                    <a href="javascript:void(0)"><i class="fas fa-history fa-lg" data-toggle="modal" data-target="#reportHistory" data-backdrop="static"></i></a>
                    
                    <?php endif; ?>
                </div>
            </div>
            <!--End of Card-Header-->
            <!--Card-Body-->
            <div class="card-body text-dark">
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-2">
                            <div>
                                <strong>Personal Information</strong><hr>
                            </div>
                            <label class="labels">Name</label>
                            <input type="text" class="form-control w-75" placeholder="Fname Mname Lname" value="<?php echo "{$_SESSION['Lastname']}, {$_SESSION['Firstname']} {$_SESSION['Middlename']}"?>" readonly>
                            <label class="labels">Gender</label>
                            <input type="text" class="form-control w-75" placeholder="Gender" value="<?php echo $_SESSION["userGender"] ?>" readonly>
                            <label class="labels">Birthdate</label>
                            <input type="date" class="form-control w-75" placeholder="Birthdate" value="<?php echo $_SESSION["dateofbirth"] ?>" readonly>
                        </div>
                        <div class="p-2">
                            <div>
                                <strong>Address Information</strong><hr>
                            </div>
                            <div class="row-md-4 row-sm-4">
                                <label class="labels">Purok</label>
                                <input type="text" class="form-control w-75" placeholder="Barangay" value="<?php echo $_SESSION["userPurok"] ?>" readonly>
                            </div>
                            <div class="row-md-4 row-sm-4">
                                <label class="labels">Barangay</label>
                                <input type="text" class="form-control w-75" placeholder="Barangay" value="<?php echo $_SESSION["userBarangay"] ?>" readonly>
                                <label class="labels">Municipality/City</label>
                                <input type="text" class="form-control w-75" placeholder="City" value="<?php echo $_SESSION["userCity"] ?>" readonly>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-2">
                            <div>
                                <strong>Contact Information</strong><hr>
                            </div>
                            <label class="labels">Phone Number</label>
                            <input type="text" class="form-control w-75" value="<?php if($_SESSION['phoneNum'] == NULL){ echo "None"; }else{ echo $_SESSION["phoneNum"]; }?>" readonly>
                            <label class="labels">Telephone Number</label>
                            <input type="text" class="form-control w-75" value="<?php if($_SESSION['teleNum'] == NULL){ echo "None"; }else{ echo $_SESSION["teleNum"]; }?>" readonly>
                            <label class="labels">Email Address</label>
                            <input type="email" class="form-control w-75" placeholder="@email" value="<?php echo $_SESSION["emailAdd"] ?>" readonly>
                        </div>
                        <div class="p-2">
                            <strong>Address Information</strong><hr>
                            <label class="labels">Street Address</label>
                            <input type="text" class="form-control w-75" value="<?php if($_SESSION['phoneNum'] == NULL){ echo "None"; }else{ echo $_SESSION["userAddress"]; }?>" readonly>
                            <label class="labels">House Number</label>
                            <input type="text" class="form-control w-75" value="<?php if($_SESSION['teleNum'] == NULL){ echo "None"; }else{ echo $_SESSION["userHouseNum"]; }?>" readonly>
                            <label class="labels">Is renting?</label>
                            <input type="email" class="form-control w-75" placeholder="@email" value="<?php echo $_SESSION["isRenting"] ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <!--End of Card-Body-->

<?php if(!isset($_GET['viewProfile'])){
    include_once 'footer.php'; 
    }
?>