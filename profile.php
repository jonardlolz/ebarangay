<?php include_once 'header.php' ?>
<?php 
    $profile = $conn->query("SELECT * FROM users WHERE UsersID='{$_SESSION['UsersID']}'");
    while($row=$profile->fetch_assoc()):
?>
<!-- Begin Page Content -->
<div class="col d-flex flex-column px-4">
    <div class="m-4 p-4"> 
        <div class="card rounded shadow" style="background-color: #dcdce4;">
            <!--Card-header-->
            <div class="card-header">
                <div class="text-center text-dark">
                    <div class="user-avatar w-100 d-flex justify-content-center">
                        <span class="position-relative">
                            <img src="img/<?php echo $_SESSION["profile_pic"]; ?>" alt="Maxwell Admin" class="img-fluid rounded-circle <?php 
                                if($_SESSION["userType"] == "Resident"){
                                    echo "img-res-profile";
                                }
                                elseif($_SESSION["userType"] == "Purok Leader"){
                                    echo "img-purokldr-profile";
                                }
                                elseif($_SESSION["userType"] == "Captain"){
                                    echo "img-capt-profile";
                                }
                                elseif($_SESSION["userType"] == "Secretary"){
                                    echo "img-sec-profile";
                                }
                                elseif($_SESSION["userType"] == "Treasurer"){
                                    echo "img-treas-profile";
                                }
                                elseif($_SESSION["userType"] == "Admin"){
                                    echo "img-admin-profile";
                                }
                            ?>" style="width:150px; height:150px">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#ppModal" class="text-dark position-absolute rounded-circle img-thumbnail d-flex justify-content-center align-items-center" style="top:75%;left:75%;width:30px;height: 30px">
                                <i class="fas fa-camera"></i>
                            </a>
                        </span>
                    </div>
                    <div class="mt-2">
                        <h5 class="font-weight-bold"><?php echo $name ?></h5>
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
                            <label class="labels">Civil Status</label>
                            <input type="text" class="form-control w-75" placeholder="Civil Status" value="">
                            <label class="labels">Birthdate</label>
                            <input type="date" class="form-control w-75" placeholder="Birthdate" value="<?php echo $_SESSION["dateofbirth"] ?>" readonly>
                            <label class="labels">Birthplace</label>    <!--push-->
                            <input type="text" class="form-control w-75" placeholder="Birthplace" value="" readonly>   <!--push-->
                            

                        </div>
                        <div class="p-2">
                            <div>
                                <strong>Address Information</strong><hr>
                            </div>
                            <div class="row-md-4 row-sm-4">
                                <label class="labels">House Number</label>  <!--push-->
                                <input type="text" class="form-control w-75" value="<?php if($_SESSION['teleNum'] == NULL){ echo "None"; }else{ echo $_SESSION["userHouseNum"]; }?>" readonly>
                                <label class="labels">Purok</label>
                                <input type="text" class="form-control w-75" placeholder="Barangay" value="<?php echo $_SESSION["userPurok"] ?>" readonly>
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
                            <strong>Additional Information</strong><hr> <!--push-->
                            <label class="labels">Is student?</label>   
                            <input type="email" class="form-control w-75" placeholder="@email" value="<?php echo $_SESSION["isRenting"] ?>" readonly>
                            <label class="labels">Is employed?</label>
                            <input type="email" class="form-control w-75" placeholder="@email" value="<?php echo $_SESSION["isRenting"] ?>" readonly>
                            <label class="labels">Is unemployed?</label>
                            <input type="email" class="form-control w-75" placeholder="@email" value="<?php echo $_SESSION["isRenting"] ?>" readonly>
                            <label class="labels">Is person with dissability (PWD)?</label>
                            <input type="email" class="form-control w-75" placeholder="@email" value="<?php echo $_SESSION["isRenting"] ?>" readonly>
                            <label class="labels">Is senior citizen?</label>
                            <input type="email" class="form-control w-75" placeholder="@email" value="<?php echo $_SESSION["isRenting"] ?>" readonly>
                            <label class="labels">Is renting?</label>
                            <input type="email" class="form-control w-75" placeholder="@email" value="<?php echo $_SESSION["isRenting"] ?>" readonly>

                        </div>
                    </div>
                </div>
            </div>
            <!--End of Card-Body-->
        </div>
    </div>

    <!-- dynamic modal -->
    <div class="modal fade" id="uni_modal" role="dialog">
        <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><b>&times;</b></span>
            </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </div>
        </div>
    </div>
    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Edit Profile Modal-->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="">
        <div class="modal-dialog modal-dialog-scrollable border border-0" role="document" style="border-color:#384550 ;">
            <form action="includes/profileupdate.inc.php?id=<?php echo $_SESSION["UsersID"] ?>" class="user" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile Information     </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!--modal-body-->
                <div class="modal-body">
                    <div class="form-group row">    <!--Name-->
                        <div class="col-sm-4 col-md-4 mb-3 mb-sm-0">
                        <label class="labels">Firstname:</label>
                            <input type="text" class="form-control form-control-sm" id="FirstName"
                                name="Firstname" placeholder="First Name" value="<?php echo $row['Firstname'] ?>">
                        </div>
                        <div class="col-sm-4 col-md-4">
                        <label class="labels">Middlename:</label>
                            <input type="text" class="form-control form-control-sm" id="MiddleName"
                                name="Middlename" placeholder="Middle Name" value="<?php echo $_SESSION['Middlename'] ?>">
                        </div>
                        <div class="col-sm-4 col-md-4">
                        <label class="labels">Lastname:</label>
                            <input type="text" class="form-control form-control-sm" id="LastName"
                                name="Lastname" placeholder="Last Name" value="<?php echo $_SESSION['Lastname'] ?>">
                        </div>
                    </div>

                    <div class="form-group row"><!--Civil status-->
                        
                        <div class="col-sm-6">
                            <label class="labels">Gender:</label>
                            <select class="form-control form-control-sm form-select d-inline" id="userGender" placeholder="Gender" name="userGender" required>
                                <option value="<?php echo $_SESSION['userGender'] ?>" hidden selected><?php echo $_SESSION['userGender'] ?></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        
                        <div class="col-sm-6">
                        <label class="labels">Civil Status:</label>
                            <select name="userCivilStat" id="userCivilStat"  class="form-control form-control-sm form-select d-inline">
                                <option value="<?php echo $_SESSION['civilStat'] ?>" hidden selected disabled><?php echo $_SESSION['civilStat'] ?></option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label class="labels">Birthdate:</label>
                            <input type="date" class="form-control form-control-sm" placeholder="Birthdate" 
                            name="userDOB" id="userDOB" value="<?php echo $_SESSION['dateofbirth'] ?>"></input>
                        </div>

                        <div class="col-sm-6">
                        <label class="labels">Birthplace:</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Birthdate"> </input>
                        </div>
                        
                    </div>
                    <hr><!--CONTACT INFORMATION-->
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-6">
                            <label class="labels">Phone Number:</label>
                            <input type="num" class="form-control form-control-sm" name="" id="" placeholder="xxxxx" value=""></input>
                        </div>
                        
                        <div class="col-lg-6 col-sm-6">
                            <label class="labels">Telephone Number:</label>
                            <input type="num" class="form-control form-control-sm" name="" id="" placeholder="xxxxxx" value=""></input>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <label class="labels">Email Address:</label>
                            <input type="email" class="form-control form-control-sm" name="emailAdd" id="emailAdd" placeholder="Email Address" value="<?php echo $_SESSION['emailAdd'] ?>"></input>
                        </div>
                    </div>

                    <hr><!--ADDRESS-->
                    <div class="form-group row">
                       <div class="col-lg-6 col-sm-6" >
                            <label class="labels">House Number:</label>
                            <input type="text" class="form-control form-control-sm" name="userHouseNum" id="userHouseNum" placeholder="House #" value="<?php echo $_SESSION['userHouseNum'] ?>" required>
                        </div>

                        <div class="col-sm-6 col-lg-6">
                            <label class="labels">Purok:</label>
                            <select class="form-control form-control-sm form-select d-inline" name="userPurok" id="userPurok">
                                <option value="<?php echo $_SESSION['userPurok'] ?>" selected hidden><?php echo $_SESSION['userPurok'] ?></option>
                            </select>
                        </div> 
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label class="labels">Barangay:</label>
                            <select class="form-control form-control-sm form-select d-inline" name="userBrgy" onChange="changecat(this.value);"  id="userBrgy">
                                <option value="<?php echo $_SESSION['userBarangay'] ?>" hidden selected><?php echo $_SESSION['userBarangay'] ?></option>
                                <?php $barangay = $conn->query("SELECT * FROM barangay WHERE Active='True'");
                                while($brow = $barangay->fetch_assoc()): ?>  
                                    <option value="<?php echo $brow['BarangayName'] ?>"><?php echo $brow['BarangayName'] ?></option>
                                <?php endwhile; ?>  <!--brgy name must be set-->
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-6">
                            <label class="labels">Position:</label>
                            <select class="form-control form-control-sm form-select d-inline" name="userType" id="userType">
                                <option value="<?php echo $userType ?>" hidden selected><?php echo $_SESSION['userType'] ?></option>
                                <option value="Resident">Resident</option>
                                <option value="Captain">Barangay Captain</option>
                                <option value="Treasurer">Treasurer</option>
                                <option value="Secretary">Secretary</option>
                                <option value="Purok Leader">Purok Leader</option>
                            </select>
                        </div>
                    </div>

                    <hr><!--ARE YOU?-->
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-6">
                            <label class="labels">Is a student?</label>
                            <select class="form-control form-control-sm form-select d-inline" name="" id="">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <label class="labels">Is a PWD?</label>
                            <select class="form-control form-control-sm form-select d-inline" name="" id="">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <label class="labels">Is employed?</label>
                            <select class="form-control form-control-sm form-select d-inline" name="" id="">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <label class="labels">Is unemployed?</label>
                            <select class="form-control form-control-sm form-select d-inline" name="" id="">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <label class="labels">Is a senior citizen?</label>
                            <select class="form-control form-control-sm form-select d-inline" name="" id="">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <label class="labels">Is renting?</label>
                            <select class="form-control form-control-sm form-select d-inline" name="" id="">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                

                </div>
                <!--end of modal body-->
                
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-primary" name="submit">Save Changes</button>
                </div>
            </div>
            <?php endwhile; ?>
            </form>
        </div>
    </div>

    <div class="modal fade" id="reportHistory" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="">
        <div class="modal-dialog modal-xl" role="document" style="border-color:#384550 ;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Report</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!--modal-body-->
                <div class="modal-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-dark display" 
                                width="100%" cellspacing="0" cellpadding="0">
                                <thead >
                                    <tr class="bg-gradient-secondary text-white">
                                        <th scope="col">Report Type</th>
                                        <th scope="col">Content</th>
                                        <th scope="col">From</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    <!--Row 1-->
                                    <?php 
                                        $accounts = $conn->query("SELECT * FROM report WHERE userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}' ORDER BY created_on DESC");
                                        while($row=$accounts->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td><?php echo $row["ReportType"] ?></td>
                                        <td><?php echo $row["reportMessage"] ?></td>
                                        <td><?php echo $row["UsersID"] ?></td>
                                        <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                        
                                        <!--Right Options-->
                                    </tr>
                                    <?php endwhile; ?>
                                    <!--Row 1-->
                                </tbody>
                            </table>
                        </div>
                </div>
                </div>
                <!--end of modal body-->
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
            
        </div>
    </div>

    <div class="modal fade" id="requestHistoryModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="">
        <div class="modal-dialog modal-xl" role="document" style="border-color:#384550 ;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">eReklamos and eRequests</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!--modal-body-->
                <div class="modal-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-ereklamo-tab" data-toggle="tab" href="#nav-ereklamo" role="tab" aria-controls="nav-ereklamo" aria-selected="true">eReklamo</a>
                            <a class="nav-item nav-link" id="nav-erequest-tab" data-toggle="tab" href="#nav-erequest" role="tab" aria-controls="nav-erequest" aria-selected="false">eRequest</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-ereklamo" role="tabpanel" aria-labelledby="nav-ereklamo-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark" 
                                    id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th scope="col">Reklamo Type</th>
                                            <th scope="col">Detail</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Comment</th>
                                            <th scope="col">Submitted on</th>
                                            <th scope="col">Checked By</th>
                                            <th scope="col">Checked On</th>
                                            <th scope="col">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $requests = $conn->query("SELECT * FROM ereklamo WHERE UsersID={$_SESSION['UsersID']}");
                                            while($row=$requests->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td><?php echo $row["reklamoType"] ?></td>
                                            <td><?php echo $row["detail"] ?></td>
                                            <td><?php echo $row["status"] ?></td>
                                            <td><?php echo $row["comment"] ?></td>
                                            <td><?php echo date("M d,Y h:i a", strtotime($row['CreatedOn'])); ?></td>
                                            <td><?php if($row['checkedOn'] != NULL){ echo date("M d,Y h:i a", strtotime($row['checkedOn']));} else{ echo "N/A"; } ?></td>
                                            <td><?php echo $row["checkedBy"] ?></td>
                                            <td>
                                                <button class="btn btn-danger btn-sm btn-flat delete_reklamo" data-id="<?php echo $row['ReklamoID'] ?>" data-toggle="modal" data-target="#confirm_modal" 
                                                data-backdrop="static"
                                                <?php if($row['status'] != 'Pending'){ echo 'disabled';} 
                                                else{echo '';} ?>><i class="fas fa-trash"></i> Delete</button>
                                                
                                            </td>
                                            
                                            <!--Right Options-->
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-erequest" role="tabpanel" aria-labelledby="nav-erquest-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark" 
                                    id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th scope="col">Document</th>
                                            <th scope="col">Purpose</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Date Requested</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date Approved</th>
                                            <th scope="col">Approved By</th>
                                            <th scope="col">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $requests = $conn->query("SELECT * FROM request WHERE UsersID={$_SESSION['UsersID']}");
                                            while($row=$requests->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td><?php echo $row["documentType"] ?></td>
                                            <td><?php echo $row["purpose"] ?></td>
                                            <td><?php echo $row["amount"] ?></td>
                                            <td><?php echo date("M d,Y h:i a", strtotime($row['requestedOn'])); ?></td>
                                            <td><?php echo $row["status"] ?></td>
                                            <td><?php if($row['approvedOn'] != NULL){ echo date("M d,Y h:i a", strtotime($row['approvedOn']));} else{ echo "N/A"; } ?></td>
                                            <td><?php echo $row["approvedBy"] ?></td>
                                            <td>
                                                
                                                <button class="btn btn-danger btn-sm btn-flat delete_request" data-id="<?php echo $row['RequestID'] ?>" data-toggle="modal" data-target="#confirm_modal" 
                                                data-backdrop="static"
                                                <?php if($row['status'] != 'Pending'){ echo 'disabled';} 
                                                else{echo '';} ?>><i class="fas fa-trash"></i> Delete</button>
                                                <?php if($row['status'] != 'Pending'): ?>
                                                <a target="_blank" href="<?php echo $row['requesturl'] ?>"><img src="https://getpaid.gcash.com/assets/img/paynow.png"></a>
                                                <?php endif;?>
                                            </td>
                                            
                                            <!--Right Options-->
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!--end of modal body-->
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-sm-down border border-0" role="document" style="border-color:#384550 ;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-dark" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <div class="modal-body">
                    <div id="delete_content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Profile Pic Modal-->
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

<script>

    function openForm() {
          document.getElementById("myForm").style.display = "block";
        }
        
        function closeForm() {
          document.getElementById("myForm").style.display = "none";
        }

    function displayImgProfile(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#profile').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
    window.start_load = function(){
	    $('body').prepend('<div id="preloader2"></div>')
	  }
	  window.end_load = function(){
	    $('#preloader2').fadeOut('fast', function() {
	        $(this).remove();
	      })
	  }
	 window.viewer_modal = function($src = ''){
	    start_load()
	    var t = $src.split('.')
	    t = t[1]
	    if(t =='mp4'){
	      var view = $("<video src='"+$src+"' controls autoplay></video>")
	    }else{
	      var view = $("<img src='"+$src+"' />")
	    }
	    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
	    $('#viewer_modal .modal-content').append(view)
	    $('#viewer_modal').modal({
	            show:true,
	            backdrop:'static',
	            keyboard:false,
	            focus:true
	          })
	          end_load()  

	}
	  window.uni_modal = function($title = '' , $url='',$size=""){
	      start_load()
	      $.ajax({
	          url:$url,
	          error:err=>{
	              console.log()
	              alert("An error occured")
	          },
	          success:function(resp){
	              if(resp){
	                  $('#uni_modal .modal-title').html($title)
	                  $('#uni_modal .modal-body').html(resp)
	                  if($size != ''){
	                      $('#uni_modal .modal-dialog').addClass($size)
	                  }else{
	                      $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
	                  }
	                  $('#uni_modal').modal({
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
	  window._conf = function($msg='',$func='',$params = []){
	     $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
	     $('#confirm_modal .modal-body').html($msg)
	     $('#confirm_modal').modal('show')
	  }
	   window.alert_toast= function($msg = 'TEST',$bg = 'success' ,$pos=''){
	   	 var Toast = Swal.mixin({
	      toast: true,
	      position: $pos || 'top-end',
	      showConfirmButton: false,
	      timer: 5000
	    });
	      Toast.fire({
	        icon: $bg,
	        title: $msg
	      })
	  }

        $('.comment-textfield').on('keypress', function (e) {
            if(e.which == 13 && e.shiftKey == false){
                if($('#preload2').length <= 0){
                    start_load();
                }else{
                    return false;
                }
                var post_id = $(this).attr('data-id')
                var comment = $(this).val()
                $(this).val('')
                $.ajax({
                    url:'ajax.php?action=save_comment',
                    method:'POST',
                    data:{post_id:post_id,comment:comment},
                    success:function(resp){
                        if(resp){
                            resp = JSON.parse(resp)
                            if(resp.status == 1){
                                var cfield = $('#comment-clone .card-comment').clone()
                                cfield.find('.img-circle').attr('src','assets/uploads/'+resp.data.profile_pic)
                                cfield.find('.uname').text(resp.data.name)
                                cfield.find('.comment').html(resp.data.comment)
                                cfield.find('.timestamp').text(resp.data.timestamp)
                            $('.post-card[data-id="'+post_id+'"]').find('.card-comments').append(cfield)
                            var cc = $('.post-card[data-id="'+post_id+'"]').find('.comment-count').text();
                                cc = cc.replace(/,/g,'');
                                cc = parseInt(cc) + 1
                            $('.post-card[data-id="'+post_id+'"]').find('.comment-count').text(cc)
                            }else{
                                alert_toast("An error occured","danger")
                            }
                            end_load()
                        }
                    }
                })
                return false;
            }
        })
        $('.comment-textfield').on('change keyup keydown paste cut', function (e) {
            if(this.scrollHeight <= 117)
            $(this).height(0).height(this.scrollHeight);
        })
        $('.add_account').click(function(){
            uni_modal("<center><b>Add Account</b></center></center>","includes/account.inc.php")
        })
        $('.edit_account').click(function(){
            uni_modal("<center><b>Edit Account</b></center></center>","includes/account.inc.php?id="+$(this).attr('data-id'))
        })
        $('.delete_request').click(function(){
        _conf("Are you sure want to cancel this request?","cancelRequest",[$(this).attr('data-id')])
        })
        $('.delete_reklamo').click(function(){
        _conf("Are you sure want to cancel this reklamo?","cancelReklamo",[$(this).attr('data-id')])
        })
        function cancelRequest($id){
                start_load()
                $.ajax({
                    url:'includes/deleteRequest.inc.php',
                    method:'POST',
                    data:{id:$id},
                    success:function(){
                        location.reload()
                    }
                })
            }
        function cancelReklamo($id){
            start_load()
            $.ajax({
                url:'includes/deleteReklamo.inc.php',
                method:'POST',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }
        $('#upload_post').click(function(){
            uni_modal("<center><b>Create Post</b></center></center>","includes/create_post.inc.php?upload=1")
        })
        $('.content-field').each(function(){
            var dom = $(this)[0]
            var divHeight = dom.offsetHeight
            if(divHeight > 117){
                $(this).addClass('truncate-5')
                $(this).parent().children('.show-content').removeClass('d-none')
            }
        })
        $('.show-content').click(function(){
            var txt = $(this).text()
            if(txt == "Show More"){
                $(this).parent().children('.content-field').removeClass('truncate-5')
                $(this).text("Show Less")
            }else{
                $(this).parent().children('.content-field').addClass('truncate-5')
                $(this).text("Show More")
            }
        })
        $('.lightbox-items').click(function(e){
            e.preventDefault()
            uni_modal("","view_attach.php?id="+$(this).attr('data-id'),"large")
        })
        $('.view_more').click(function(e){
            e.preventDefault()
            uni_modal("","view_attach.php?id="+$(this).attr('data-id'),"large")
        })
        $('.like').click(function(){
            var _this = $(this)
            $.ajax({
                url:'ajax.php?action=like',
                method:'POST',
                data:{post_id:$(this).attr('data-id')},
                success:function(resp){
                    if(resp == 1){
                        _this.addClass('text-primary')
                        var lc = _this.siblings('.counts').find('.like-count').text();
                                lc = lc.replace(/,/g,'');
                                lc = parseInt(lc) + 1
                        _this.siblings('.counts').find('.like-count').text(lc)
                    }else if(resp==0){
                        _this.removeClass('text-primary')
                        var lc = _this.siblings('.counts').find('.like-count').text();
                                lc = lc.replace(/,/g,'');
                                lc = parseInt(lc) - 1
                        _this.siblings('.counts').find('.like-count').text(lc)
                    }
                }
            })
        })
        $(document).ready(function() {
        $('#dataTable').DataTable();
        } );

        $(document).ready(function() {
        $('#dataTable2').DataTable();
        } );

        var mealsByCategory = {
        <?php 
            $puroks = array();
            $barangay = $conn->query("SELECT * FROM barangay");
            while($brow = $barangay->fetch_assoc()):
        ?>
            <?php 
            echo json_encode($brow["BarangayName"]) ?> : <?php $purok = $conn->query("SELECT * FROM purok WHERE BarangayName='{$brow['BarangayName']}'"); 
            while($prow = $purok->fetch_assoc()):
            $puroks[] = $prow["PurokName"]?>
        <?php endwhile; echo json_encode($puroks). ","; $puroks = array();?>
        <?php endwhile; ?>
        }

        function changecat(value) {
            if (value.length == 0) document.getElementById("userPurok").innerHTML = "<option></option>";
            else {
                var catOptions = "";
                for (categoryId in mealsByCategory[value]) {
                    catOptions += "<option>" + mealsByCategory[value][categoryId] + "</option>";
                }
                document.getElementById("userPurok").innerHTML = catOptions;
            }
        }
</script>


<?php include 'footer.php' ?>