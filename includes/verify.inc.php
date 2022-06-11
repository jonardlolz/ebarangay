<?php
    include 'dbh.inc.php';
    session_start();
    extract($_POST);

    if(isset($_GET['verify'])){

        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE users SET VerifyStatus='Verified' WHERE UsersID='{$_GET['verify']}'");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID) VALUES('Your account verification has been approved!', 'Resident', '{$_GET['verify']}');");
        $a3 = mysqli_query($conn, "INSERT INTO userreport(UsersID, OfficerID, reportMessage, reportStatus, barangay, purok) VALUES({$_GET['verify']}, {$_SESSION['UsersID']}, 'Purok Leader has verified this account.', 'Verify', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");

        if($a1 && $a2 && $a3){
            mysqli_commit($conn);
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
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
<?php if(isset($_GET['viewUser'])): ?>
    <?php 
        $profile = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname, ' ', COALESCE(users.userSuffix,'')) as name FROM users WHERE UsersID='{$_GET['UsersID']}'");
        $row=$profile->fetch_assoc();
    ?>

    <div class="container-fluid">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="nav-user" aria-selected="true">User</a>
                <a class="nav-item nav-link" id="nav-requirements-tab" data-toggle="tab" href="#nav-requirements" role="tab" aria-controls="nav-requirements" aria-selected="true">Submitted Requirements</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
                <link rel="stylesheet" href="css/cb2.css">
                <div class="col d-flex flex-column px-4">
                    <div class="card rounded shadow" style="background-color: #dcdce4;">
                        <!--Card-header-->
                        <div class="card-header">
                            <div class="text-center text-dark">
                                <div class="user-avatar w-100 d-flex justify-content-center">
                                    <span class="position-relative">
                                        <img src="img/users/<?php echo $row['UsersID'] ?>/profile_pic/<?php echo $row["profile_pic"]; ?>" alt="Maxwell Admin" class="img-fluid img-thumbnail rounded-circle <?php 
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
                                            elseif($row["userType"] == "Councilor"){
                                                echo "img-councilor-profile";
                                            }
                                            elseif($row["userType"] == "Admin"){
                                                echo "img-admin-profile";
                                            }
                                        ?>" style="width:150px; height:150px">
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <h5 class="font-weight-bold"><?php echo $row['name'] ?></h5>
                                    <h6 readonly><?php echo $row["emailAdd"]; ?></h6>
                                </div>
                            </div>
                            <div class="text-center">
                                <h6 class="m-2">
                                    <?php $detail="";
                                    if($row['IsVoter'] == "True"){
                                        $detail .= "Voter";
                                    }
                                    if($row['IsVoter'] == "False"){
                                        $detail .= "Non-Voter";
                                    }
                                    if($row['isRenting'] == "True"){
                                        $detail .= ", Renter";
                                    }
                                    if($row['IsLandlord'] == "True"){
                                        $detail .= ", Landlord";
                                    }
                                    if($row['IsLandlord'] == "False" && $row['isRenting'] == "False"){
                                        $detail .= ", Resident";
                                    }
                                
                                    echo $detail;
                                    ?>
                                </h6>
                            </div>
                        </div>
                        <!--End of Card-Header-->
                        <!--Card-Body-->
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="p-2">
                                        <div>
                                            <strong>Personal Information</strong><hr>
                                        </div>
                                        <label class="labels">Name</label>
                                        <input type="text" class="form-control w-75" placeholder="Fname Mname Lname" value="<?php echo "{$row['Firstname']} {$row['Middlename']} {$row['Lastname']} {$row['userSuffix']}"?>" readonly>
                                        <label class="labels">Gender</label>
                                        <input type="text" class="form-control w-75" placeholder="Gender" value="<?php echo $row["userGender"] ?>" readonly>
                                        <label class="labels">Birthdate</label>
                                        <input type="date" class="form-control w-75" placeholder="Birthdate" value="<?php echo $row["dateofbirth"] ?>" readonly>
                                        <label class="labels">Civil Status</label>
                                        <input type="text" class="form-control w-75" placeholder="Birthdate" value="<?php echo $row["civilStat"] ?>" readonly>
                                        <label class="labels">Date Resides</label>
                                        <input type="date" class="form-control w-75" placeholder="Birthdate" value="<?php echo $row["startedLiving"] ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-2">
                                        <div>
                                            <strong>Address Information</strong><hr>
                                        </div>
                                        <div class="row-md-4 row-sm-4">
                                            <label class="labels">House Number</label>
                                            <input type="text" class="form-control w-75" value="<?php echo $row["userHouseNum"] ?>" readonly>
                                            <label class="labels">Purok</label>
                                            <input type="text" class="form-control w-75" placeholder="Purok" value="<?php echo $row["userPurok"] ?>" readonly>
                                            <label class="labels">Barangay</label>
                                            <input type="text" class="form-control w-75" placeholder="Barangay" value="<?php echo $row["userBarangay"] ?>" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="p-2">
                                        <div>
                                            <strong>Contact Information</strong><hr>
                                        </div>
                                        <label class="labels">Phone Number</label>
                                        <input type="text" class="form-control w-75" value="<?php if($row['phoneNum'] == NULL){ echo "None"; }else{ echo $row["phoneNum"]; }?>" readonly>
                                        <label class="labels">Telephone Number</label>
                                        <input type="text" class="form-control w-75" value="<?php if($row['teleNum'] == NULL){ echo "None"; }else{ echo $row["teleNum"]; }?>" readonly>
                                        <label class="labels">Email Address</label>
                                        <input type="email" class="form-control w-75" placeholder="@email" value="<?php echo $row["emailAdd"] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End of Card-Body-->
                    </div>
                    <div class="modal fade" id="ppModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-dialog modal-fullscreen-sm-down border border-0" role="document" style="border-color:#384550 ;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Manage Profile Picture</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="pp" accept="image/*" onchange="displayImgProfile(this,$(this))">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group d-flex justify-content-center rounded-circle">
                                            <img src="img/<?php echo $_SESSION["profile_pic"]; ?>" alt="" id="profile" class="img-fluid img-thumbnail rounded-circle" style="max-width: calc(50%)">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-dark" name="submit" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-requirements" role="tabpanel" aria-labelledby="nav-requirements-tab">
                <?php 
                if(file_exists('../img/users/'.$_GET['UsersID'].'/verification')):
                $gal = scandir('../img/users/'.$_GET['UsersID'].'/verification');
                unset($gal[0]);
                unset($gal[1]);
                $count =count($gal);
                $i = 0;
                ?>
                    <style>
                        .slide img,.slide video{
                            max-width:100%;
                            max-height:100%;
                        }
                    </style>
                    <div class="container-fluid" style="height:75vh">
                        <div class="row h-100">
                            <div class="col-lg-7 bg-dark h-100">
                                <div class="d-flex h-100 w-100 position-relative justify-content-between align-items-center">
                                    <a href="javascript:void(0)" id="prev" class="position-absolute d-flex justify-content-center align-items-center" style="left:0;width:calc(15%);z-index:1"><h4><div class="fa fa-angle-left"></div></h4></a>
                                    <?php
                                        foreach($gal as $k => $v):
                                            $mime = mime_content_type('../img/users/'.$_GET['UsersID'].'/verification/'.$v);
                                            $i++;
                                    ?>
                                    <div class="slide w-100 h-100 <?php echo ($i == 1) ? "d-flex" : 'd-none' ?> align-items-center justify-content-center" data-slide="<?php echo $i ?>">
                                    <?php if(strstr($mime,'image')): ?>
                                        <img src="./img/users/<?php echo $_GET['UsersID'].'/verification/'.$v ?>" class="" alt="Image 1">
                                    <?php else: ?>
                                        <video controls class="">
                                                <source src="./img/users/<?php echo $_GET['UsersID'].'/verification/'.$v ?>" type="<?php echo $mime ?>">
                                        </video>
                                    <?php endif; ?>
                                    </div>
                                    <?php endforeach; ?>
                                    <a href="javascript:void(0)" id="next" class="position-absolute d-flex justify-content-center align-items-center" style="right:0;width:calc(15%);z-index:1"><h4><div class="fa fa-angle-right"></div></h4></a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="d-flex flex-row">
                                    Requirements needed: 
                                </div>
                                <div class="d-flex flex-row">
                                    <ul>
                                        <li>Valid ID</li>
                                        <li>Lessor's Note</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="container-fluid">
                        <div class="alert alert-danger m-2">
                            <h3>User has not submitted requirements!</h1>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <hr>
        <div class="footer d-flex flex-row-reverse">
            <button class="btn btn-flat btn-success verify_user" data-id="<?php echo $_GET['UsersID'] ?>"><i class="fas fa-check"></i> Verify</button>
            <button class="btn btn-flat btn-danger unverify_report"><i class="fas fa-times"></i> Unverify</button>
        </div>
    </div>
    <script>
        $('.verify_user').click(function(){
            _conf("Are you sure you want to verify this user?","verify_user",[$(this).attr('data-id')])
        })
        $('.unverify_report').click(function(){
            secondary_modal("<center><b>Report</b></center></center>","includes/verify.inc.php?unverifyReport&UsersID="+$(this).attr('data-id'), "modal-md")
        })
        $(".container-fluid").parent().siblings(".modal-footer").remove();
        <?php if(file_exists('../img/users/'.$_GET['UsersID'].'/verification')): ?>
        $('#next').click(function(){
            var cslide = $('.slide:visible').attr('data-slide')
            if(cslide == '<?php echo $i ?>'){
                return false;
            }
            $('.slide:visible').removeClass('d-flex').addClass("d-none")
            $('.slide[data-slide="'+(parseInt(cslide) + 1)+'"]').removeClass('d-none').addClass('d-flex')
        })
        $('#prev').click(function(){
            var cslide = $('.slide:visible').attr('data-slide')
            if(cslide == 1){
                return false;
            }
            $('.slide:visible').removeClass('d-flex').addClass("d-none")
            $('.slide[data-slide="'+(parseInt(cslide) - 1)+'"]').removeClass('d-none').addClass('d-flex')
        })
        function verify_user($id){
            start_load()
            $.ajax({
                url:'includes/verify.inc.php?verify=' + $id,
                method:'GET',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }
        <?php endif; ?>
    </script>

<?php elseif(isset($_GET['unverifyReport'])): ?>

<div class="container-fluid">
    <form action="">
        <div class="row">
            <div class="col">
                <p>Report Message: </p>
            </div>
            <div class="col-sm-8">
                <textarea name="reportMessage" id="reportMessage" class="form-control" rows="3" style="resize:none;" required></textarea>
            </div>
        </div>
        <hr>
        <div class="footer d-flex flex-row-reverse">
            <button class="btn btn-primary">Send Report</button>
        </div>
    </form>
</div>
<script>
    $(".container-fluid").parent().siblings(".modal-footer").remove();
</script>

<?php elseif(isset($_GET['viewVerify'])): ?>
    <style>
        #continue_modal .modal-footer{
            display: none;
        }
        #continue_modal .modal-footer.display{
            display: block !important;
        }

    </style>
    <div class="container-fluid">  
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
                    <label for="">Lessee</label>
                </div>
                <div class="col">
                    <input type="radio" id="landlord" value="landlord" name="residentStat" 
                    onclick="ShowHideDiv()">
                    <label for="">Lessor</label>
                </div>
            </div>
            <div class="row" id="renterStat" style="display: none">
                <hr>
                <div class="col">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Lessor's Name: </label>
                        </div>
                        <div class="col-sm-4">
                            <select class="landlordName" name="landlordName" id="landlordName" required>
                                <option value="">Landlord's name</option>
                                <?php 
                                    $landlord = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM users WHERE userBarangay='{$_SESSION['userBarangay']}' AND userPurok='{$_SESSION['userPurok']}' AND IsLandlord='True'");
                                    while($landlordRow = $landlord->fetch_assoc()):
                                ?>
                                <option value="<?php echo $landlordRow['UsersID'] ?>"><?php echo $landlordRow['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <script>
                            $('.landlordName').select2();
                        </script>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Date resides: </label>    
                        </div>
                        <div class="col-sm-4">
                            <input type="date" name="date" id="dateRenter" max="<?php echo date("Y-m-d") ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Voter: </label>    
                        </div>
                        <div class="col-sm-4">
                            <input type="checkbox" name="IsRenterVoter" id="IsRenterVoter">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="landlordStat" style="display: none">
                <hr>
                <div class="col">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Date resides: </label>    
                        </div>
                        <div class="col-sm-4">
                            <input type="date" name="date" id="dateLandlord" max="<?php echo date("Y-m-d") ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Voter: </label>    
                        </div>
                        <div class="col-sm-4">
                            <input type="checkbox" name="IsLandlordVoter" id="IsLandlordVoter">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="residentStat" style="display: none">
                <hr>
                <div class="col">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Date resides: </label>    
                        </div>
                        <div class="col-sm-4">
                            <input type="date" name="date" id="dateResident" max="<?php echo date("Y-m-d") ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Voter: </label>    
                        </div>
                        <div class="col-sm-4">
                            <input type="checkbox" name="IsResidentVoter" id="IsResidentVoter">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer display py-1 px-1" style="float:right;">
        <div class="d-block w-100">
            <button type="button" class="continue_verify btn btn-primary" data-id="<?php echo $_GET['viewVerify'] ?>" >Continue</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </div>
    <script>
        $('.continue_verify').click(function(){
            var renter = document.getElementById("renter");
            var landlord = document.getElementById("landlord");
            var resident = document.getElementById("resident");
            var landlordName = document.getElementById("landlordName");
            if(renter.checked){
                var date = document.getElementById("dateRenter");
                if(!date.value){
                    alert("Date is empty!");
                }
                else if(landlordName.value == ""){
                    alert("Landlord name is empty!");
                }
                else{
                    if($("#IsRenterVoter").is(":checked")){
                        uni_modal("<center><b>Confirm Information</b></center></center>","includes/verify.inc.php?continueVerify&renter&usersID="+$(this).attr('data-id')+"&date="+date.value.toString()+"&landlord="+landlordName.value+"&IsVoter=True","modal-lg");
                    }
                    else{
                        uni_modal("<center><b>Confirm Information</b></center></center>","includes/verify.inc.php?continueVerify&renter&usersID="+$(this).attr('data-id')+"&date="+date.value.toString()+"&landlord="+landlordName.value+"&IsVoter=False","modal-lg");
                    }
                }
            }
            else if(landlord.checked){
                var date = document.getElementById("dateLandlord");
                if(!date.value){
                    alert("Date is empty!");
                }
                else{
                    if($("#IsLandlordVoter").is(":checked")){
                        uni_modal("<center><b>Confirm Information</b></center></center>","includes/verify.inc.php?continueVerify&landlord&usersID="+$(this).attr('data-id')+"&date="+date.value.toString()+"&IsVoter=True","modal-lg")
                    }
                    else{
                        uni_modal("<center><b>Confirm Information</b></center></center>","includes/verify.inc.php?continueVerify&landlord&usersID="+$(this).attr('data-id')+"&date="+date.value.toString()+"&IsVoter=False","modal-lg")
                    }
                }
            }
            else if(resident.checked){
                var date = document.getElementById("dateResident");
                if(!date.value){
                    alert("Date is empty!");
                }
                else{
                    if($("#IsResidentVoter").is(":checked")){
                        uni_modal("<center><b>Confirm Information</b></center></center>","includes/verify.inc.php?continueVerify&resident&usersID="+$(this).attr('data-id')+"&date="+date.value.toString()+"&IsVoter=True","modal-lg")
                    }
                    else{
                        uni_modal("<center><b>Confirm Information</b></center></center>","includes/verify.inc.php?continueVerify&resident&usersID="+$(this).attr('data-id')+"&date="+date.value.toString()+"&IsVoter=False","modal-lg")
                    }
                }
            }
        })
    </script>
<?php elseif(isset($_GET['continueVerify'])): ?>
    <style>
        #uni_modal .modal-footer{
            display: none;
        }
        #uni_modal .modal-footer.display{
            display: block !important;
        }

    </style>
    <?php 
        $profile = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM users WHERE UsersID='{$_GET['usersID']}'");
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
                                                    <label for=""><b><?php echo $row["userGender"] ?></b></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="labels">Civil Status:</label>
                                                </div>
                                                <div class="col">
                                                    <label for=""><b><?php echo $row["civilStat"] ?></b></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="labels">Birthdate:</label>
                                                </div>
                                                <div class="col">
                                                    <label for=""><b><?php echo date_format(date_create($row["dateofbirth"]), "m/d/Y") ?></b></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="col d-flex flex-column px-4">
                        <div class="card rounded shadow">
                            <div class="card-body text-dark">
                                <div class="row">
                                    <div class="col">
                                        <div class="p-2">
                                            <div>
                                                <strong>Address Information</strong><hr>
                                            </div>
                                            <div class="row">
                                                <div class="col-7">
                                                    <label class="labels">House #:</label>
                                                </div>
                                                <div class="col">
                                                    <label for=""><b><?php echo $row["userHouseNum"] ?></b></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-7">
                                                    <label class="labels">Purok:</label>
                                                </div>
                                                <div class="col">
                                                    <label for=""><b><?php echo $row["userPurok"] ?></b></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-7">
                                                    <label class="labels">Barangay:</label>
                                                </div>
                                                <div class="col">
                                                    <label for=""><b><?php echo $row['userBarangay'] ?></b></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-7">
                                                    <label class="labels">Municipality/City:</label>
                                                </div>
                                                <div class="col">
                                                    <label for=""><b><?php echo $row['userCity'] ?></b></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="p-2">
                                            <div>
                                                <strong>Additional Info</strong><hr>
                                            </div>
                                            <?php if(isset($_GET["renter"])): ?>
                                                <?php $sql = $conn->query("SELECT concat(Firstname, ' ', Lastname) as name FROM users WHERE UsersID='{$_GET['landlord']}'");
                                                    $landlordname = $sql->fetch_assoc();
                                                ?>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="">Renter </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="">Landlord: </label>
                                                    </div>
                                                    <div class="col">
                                                        <label for=""><?php echo $landlordname['name'] ?> </label>
                                                    </div>
                                                </div>
                                            <?php elseif(isset($_GET["landlord"])): ?>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="">Landlord </label>
                                                    </div>
                                                </div>
                                            <?php elseif(isset($_GET["resident"])): ?>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="">Resident </label>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">Started living: </label>
                                                </div>
                                                <div class="col">
                                                    <?php echo date_format(date_create($_GET["date"]), "F d,Y") ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="">Voter: </label>
                                                </div>
                                                <div class="col">
                                                    <?php echo $_GET['IsVoter'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer display py-1 px-1" style="float:right;">
            <div class="d-block w-100">
                <?php if(isset($_GET["resident"])): ?>
                    <a href="includes/verify.inc.php?postVerify&resident=<?php echo $row['UsersID'] ?>&date=<?php echo $_GET['date'] ?>&isvoter=<?php echo $_GET['IsVoter'] ?>">
                        <button type="button" class="continue_verify btn btn-primary" data-id="">Verify</button>
                    </a>
                <?php elseif(isset($_GET["renter"])): ?>
                    <a href="includes/verify.inc.php?postVerify&renter=<?php echo $_GET['landlord'] ?>&renter=<?php echo $row['UsersID'] ?>&date=<?php echo $_GET['date'] ?>&isvoter=<?php echo $_GET['IsVoter'] ?>">
                        <button type="button" class="continue_verify btn btn-primary" data-id="">Verify</button>
                    </a>
                <?php elseif(isset($_GET["landlord"])): ?>
                    <a href="includes/verify.inc.php?postVerify&landlord=<?php echo $row['UsersID'] ?>&date=<?php echo $_GET['date'] ?>&isvoter=<?php echo $_GET['IsVoter'] ?>">
                        <button type="button" class="continue_verify btn btn-primary" data-id="">Verify</button>
                    </a>
                <?php endif; ?>
                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>   
    </div>
    <script>
        ShowHideDiv();
        function ShowHideDiv(){
            var renter = document.getElementById("renter");
            var landlord = document.getElementById("landlord");
            var resident = document.getElementById("resident");
            document.getElementById("renterStat").style.display = renter.checked ? "block" : "none";
            document.getElementById("landlordStat").style.display = landlord.checked ? "block" : "none";
            document.getElementById("residentStat").style.display = resident.checked ? "block" : "none";
        }
    </script>
    
<?php endif; ?>

<?php

if(isset($_GET['postVerify'])){
    mysqli_begin_transaction($conn);

    if(isset($_GET['resident'])){
        $a1 = mysqli_query($conn, "UPDATE users SET VerifyStatus='Verified', startedLiving='{$_GET['date']}', isLandlord='False', isRenting='False', IsVoter='{$_GET['isvoter']}' WHERE UsersID='{$_GET['resident']}'");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID) VALUES('Your account verification has been approved!', 'Resident', '{$_GET['resident']}');");
    }
    elseif(isset($_GET['renter'])){
        $a1 = mysqli_query($conn, "UPDATE users SET VerifyStatus='Verified', landlordName='{$_GET['landlord']}', isLandlord='False', isRenting='True',startedLiving='{$_GET['date']}', IsVoter='{$_GET['isvoter']}' WHERE UsersID='{$_GET['renter']}'");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID) VALUES('Your account verification has been approved!', 'Resident', '{$_GET['renter']}');");
    }
    elseif(isset($_GET['landlord'])){
        $a1 = mysqli_query($conn, "UPDATE users SET VerifyStatus='Verified', startedLiving='{$_GET['date']}', isLandlord='True', isRenting='False', IsVoter='{$_GET['isvoter']}' WHERE UsersID='{$_GET['landlord']}'");
        $a2 = mysqli_query($conn, "INSERT INTO notifications(message, type, UsersID) VALUES('Your account verification has been approved!', 'Resident', '{$_GET['landlord']}');");
    }

    if($a1 && $a2){
        mysqli_commit($conn);
        header("location: ../residents.php");
    }
    else{
        mysqli_rollback($conn);
        echo("Error description: " . mysqli_error($conn));
    }
} 

?>

<script>
    window.secondary_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#secondary_modal .modal-title').html($title)
                    $('#secondary_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#secondary_modal .modal-dialog').addClass($size)
                    }else{
                        $('#secondary_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                    }
                    $('#secondary_modal').modal({
                    show:true,
                    backdrop:'static',
                    keyboard:false,
                    focus:true
                    })
                    end_load()
                }
            }
        })
    }
</script>

