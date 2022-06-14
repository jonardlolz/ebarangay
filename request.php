<?php include 'header.php'; ?>
                            
    <?php $userData=$conn->query("SELECT * FROM users WHERE UsersID={$_SESSION['UsersID']}")->fetch_assoc(); ?>
    <!-- Begin Page Content -->
    <div class="col d-flex flex-column px-4">
        <!-- Page Heading --> 
        <div class="d-sm-flex align-items-center justify-content-between">  
            <h3 class="font-weight-bold text-dark">Request Form</h3> 
            
        </div>
        <?php if($_SESSION["userType"] === "Resident" || $_SESSION["userType"] === "Councilor"): 
            if($_SESSION['VerifyStatus'] == "Pending" || $_SESSION['VerifyStatus'] == "Unverified"): 
        ?>
            <div class='alert alert-danger' role='alert' style="text-align: center">
                You're still unverified!
            </div>
            <?php else: ?>
                <?php $userSql=$conn->query("SELECT * FROM users WHERE UsersID={$_SESSION['UsersID']}")->fetch_assoc(); ?>
                <form action="includes/request.inc.php?addRequest" id="requestForm" method="POST">
                    <div class="row">
                        <div class="col-md">
                            <div class="container-fluid">
                                <div class="shadow p-4 border border-4" style="border-color: #3c4a56;">
                                    <section>
                                        <strong>Request Document</strong>
                                        <div class="row p-2">
                                            <div class="col-lg-6 m-1">
                                                <label>Choose document:</label>
                                                <select name="document" id="document" class="form-control w-75 form-control-md form-select" onChange="changecat(this.value);" required>
                                                    <option value="" hidden selected>Select</option>
                                                    <?php $requestSql = $conn->query("SELECT * FROM documenttype WHERE barangayName='{$_SESSION['userBarangay']}'");
                                                    while($documents = $requestSql->fetch_assoc()): ?>
                                                    <?php 
                                                        if($diff <= $documents['minimumMos']){
                                                            continue;
                                                        }
                                                        if($documents['allowLessee'] == "False"){
                                                            if($userSql['isRenting'] == "True"){
                                                                continue;
                                                            }
                                                        }
                                                        if($documents['VoterRequired'] == "True"){
                                                            if($userSql['IsVoter'] != "True"){
                                                                continue;
                                                            }
                                                        }
                                                    ?>
                                                    <option data-user="<?php echo $userData['isRenting'] ?>" data-id="<?php echo $documents['requireLessorNote'] ?>" value="<?php echo $documents['DocumentID'] ?>"><?php echo $documents['documentName'] ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-5 m-1">
                                                <label>Purpose:</label>
                                                <select name="purpose" id="purpose" class="form-control w-75 form-control-md form-select" required>
                                                    <option value="" hidden selected>Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row p-2" id="requirementArea">
                                            <div class="col-lg">
                                                <label>Requirement Needed: </label>
                                                <ul id="listofrequirements">
                                                </ul>
                                                <!-- <input style="display: none;" class="form-control-file" type="file" name="requirementPic[]" id="requirementPic" accept="image/*" multiple> -->
                                                <input type="file" name="file[]" multiple="multiple" onchange="" id="postF" onchange="displayUpload(this)" class="d-none" accept="image/*" required>
                                                <button id="requirementPic" style="display: none;" onclick="$('#postF').trigger('click')" type="button" class="btn btn-success"><i class="fas fa-photo-video"></i> Upload</button>
                                            </div>
                                            <div class="col-lg m-1" id="additionalInput">
                                                
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-lg-6" id="">
                                                <div id="file-display" class="d-flex flex-row m-2">

                                                    <?php 
                                                    if(isset($id)):
                                                    if(is_dir('../img/ereklamo/'.$id)):
                                                    $gal = scandir('../img/ereklamo/'.$PostID);
                                                    unset($gal[0]);
                                                    unset($gal[1]);
                                                    foreach($gal as $k=>$v):
                                                        $mime = mime_content_type('../img/ereklamo/'.$PostID.'/'.$v);
                                                        $img = file_get_contents('../img/ereklamo/'.$PostID.'/'.$v); 
                                                        $data = base64_encode($img); 
                                                    ?>
                                                        <div class="imgF">
                                                            <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                                                            <input type="hidden" name="img[]" value="<?php echo $data ?>">
                                                            <input type="hidden" name="imgName[]" value="<?php echo $v ?>">
                                                            <?php if(strstr($mime,'image')): ?>
                                                            <img class="imgDropped" src="img/ereklamo/<?php echo $PostID.'/'.$v ?>">
                                                            <?php else: ?>
                                                            <video src="img/ereklamo/<?php echo $row['file_path'] ?>"></video>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div id="requestWarning" class="alert alert-danger" style="display: none;">
                                            
                                        </div>
                                        <?php
                                            if(isset($_GET["error"])){
                                                if($_GET["error"] == "none"){
                                                    echo "<div class='alert alert-success' role='alert'>
                                                    Your request has been submitted! You can check the status of your
                                                    request on your profile.
                                                    </div>";
                                                }
                                                if($_GET["error"] == "pendingReq"){
                                                    echo "<div class='alert alert-danger' role='alert'>
                                                    Your request has been denied! You still have a pending document
                                                    in queue.
                                                    </div>";
                                                }
                                            }
                                        ?>
                                    </section>
                                    <br>
                                    <div class="m-3 p-3 text-right">
                                        <button type="button" onclick="checkInputs()" class="btn btn-primary border" data-id="<?php echo $_SESSION['UsersID']; ?>" >Submit</button>
                                    </div>
                                    <div class="imgF" style="display: none " id="img-clone">
                                        <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Nonvoter - Request Form -->
                        </div>
                    </div>
                </form>
                <script>
                    function checkInputs(){
                        if(document.getElementById("requirementPic").style.display == "flex"){
                            if($("#postF").get(0).files.length === 0){
                                document.getElementById("requestWarning").innerHTML = "Please upload the requirements listed";
                                document.getElementById("requestWarning").style.display = "flex";
                                return;
                            }
                        } 
                        if(document.getElementById("additionalInput").innerHTML != ""){
                            if($("#monthlySalary").val() == ""){
                                document.getElementById("requestWarning").innerHTML = "Please enter a valid monthly salary";
                                document.getElementById("requestWarning").style.display = "flex";
                                return;
                            }
                        }    
                        $('#requestForm').submit();
                    }
                </script>
        <?php endif; ?>
    </div>

    <!--TREASURER-->
    <?php elseif($_SESSION["userType"] == "Treasurer"): ?>
        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Payments (<?php echo $_SESSION['userBarangay'] ?>)</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending payments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="paid-tab" data-toggle="tab" href="#paid" role="tab" aria-controls="paid" aria-selected="false">Paid</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="false">Request Form</a>
                    </li>
                </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-dark" 
                                id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                <thead >
                                    <tr class="bg-gradient-secondary text-white">
                                        <th>Request ID</th>
                                        <th>Requester</th>
                                        <th>Document Type</th>
                                        <th>Amount</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Row 1-->
                                    <?php 
                                        $requests = $conn->query("SELECT request.*, concat(users.Firstname, ' ', users.Lastname) as name, 
                                        DATE_FORMAT(requestedOn, '%m/%d/%Y %h:%i %p') as requestedDate, 
                                        DATE_FORMAT(approvedOn, '%m/%d/%Y %h:%i %p') as approvedDate, 
                                        users.userType, users.profile_pic 
                                        FROM request 
                                        INNER JOIN users 
                                        ON request.UsersID=users.UsersID 
                                        WHERE request.status='Approved' 
                                        AND request.userPurok='{$_SESSION['userPurok']}' 
                                        AND request.userBarangay='{$_SESSION['userBarangay']}' 
                                        AND request.userType='{$_SESSION['userType']}'");
                                        while($row=$requests->fetch_assoc()):
                                            if($row["userType"] == "Admin"){
                                                continue;
                                            }
                                    ?>
                                    <tr>
                                        <td><?php echo $row["RequestID"] ?></td>
                                        <td>
                                            <img class="img-profile rounded-circle <?php 
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
                                            ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                            <br>
                                            <?php echo $row["name"]; ?>
                                        </td>
                                        <td><?php echo $row["documentType"] ?></td>
                                        <td><?php echo $row['amount'] ?></td>
                                        <td>
                                            <button class="btn btn-success paid_request" data-id="<?php echo $row['RequestID'] ?>"><i class="fas fa-check"></i> Paid</button>
                                            <a target="_blank" href="<?php echo $row["requesturl"]?>"><button class="btn btn-primary"><i class="fas fa-money-check"></i> Gcash link</button></a>
                                        </td>
                                        <!--Right Options-->
                                    </tr>
                                    <?php endwhile; ?>
                                    <!--Row 1-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-dark" 
                                id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                                <thead >
                                    <tr class="bg-gradient-secondary text-white">
                                        <th>Requester</th>
                                        <th>Document Type</th>
                                        <th>Amount</th>
                                        <th>Date Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Row 1-->
                                    <?php 
                                        $requests = $conn->query("SELECT request.*, concat(users.Firstname, ' ', users.Lastname) as name, 
                                        DATE_FORMAT(requestedOn, '%m/%d/%Y %h:%i %p') as requestedDate, 
                                        DATE_FORMAT(approvedOn, '%m/%d/%Y %h:%i %p') as approvedDate, 
                                        users.userType, users.profile_pic 
                                        FROM request 
                                        INNER JOIN users 
                                        ON request.UsersID=users.UsersID 
                                        WHERE request.status='Paid' 
                                        AND request.userPurok='{$_SESSION['userPurok']}' 
                                        AND request.userBarangay='{$_SESSION['userBarangay']}'");
                                        while($row=$requests->fetch_assoc()):
                                            if($row["userType"] == "Admin"){
                                                continue;
                                            }
                                    ?>
                                    <tr>
                                        <td>
                                            <img class="img-profile rounded-circle <?php 
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
                                            ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                            <br>
                                            <?php echo $row["name"] ?>
                                        </td>
                                        <td><?php echo $row["documentType"] ?></td>
                                        <td><?php echo $row['amount'] ?></td>
                                        <td><?php echo $row['approvedOn'] ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                    <!--Row 1-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">
                        <div class="container-fluid">
                            <form action="includes/request.inc.php?addRequest" id="requestForm" method="POST">
                                <div class="row">
                                    <div class="col-md">
                                        <section>
                                            <strong>Request Document</strong>
                                            <div class="row p-2">
                                                <div class="col-lg-6 m-1">
                                                    <label>Choose document:</label>
                                                    <select name="document" id="document" class="form-control w-75 form-control-md form-select" onChange="changecat(this.value);" required>
                                                        <option value="" hidden selected>Select</option>
                                                        <?php $requestSql = $conn->query("SELECT * FROM documenttype WHERE barangayName='{$_SESSION['userBarangay']}'");
                                                        while($documents = $requestSql->fetch_assoc()): ?>
                                                        <?php 
                                                            if($diff <= $documents['minimumMos']){
                                                                continue;
                                                            }
                                                            if($documents['allowLessee'] == "False"){
                                                                if($userSql['isRenting'] == "True"){
                                                                    continue;
                                                                }
                                                            }
                                                            if($documents['VoterRequired'] == "True"){
                                                                if($userSql['IsVoter'] != "True"){
                                                                    continue;
                                                                }
                                                            }
                                                        ?>
                                                        <option data-user="<?php echo $userData['isRenting'] ?>" data-id="<?php echo $documents['requireLessorNote'] ?>" value="<?php echo $documents['DocumentID'] ?>"><?php echo $documents['documentName'] ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-5 m-1">
                                                    <label>Purpose:</label>
                                                    <select name="purpose" id="purpose" class="form-control w-75 form-control-md form-select" required>
                                                        <option value="" hidden selected>Select</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row p-2" id="requirementArea">
                                                <div class="col-lg">
                                                    <label>Requirement Needed: </label>
                                                    <ul id="listofrequirements">
                                                    </ul>
                                                    <!-- <input style="display: none;" class="form-control-file" type="file" name="requirementPic[]" id="requirementPic" accept="image/*" multiple> -->
                                                    <input type="file" name="file[]" multiple="multiple" onchange="" id="postF" onchange="displayUpload(this)" class="d-none" accept="image/*" required>
                                                    <button id="requirementPic" style="display: none;" onclick="$('#postF').trigger('click')" type="button" class="btn btn-success"><i class="fas fa-photo-video"></i> Upload</button>
                                                </div>
                                                <div class="col-lg m-1" id="additionalInput">
                                                    
                                                </div>
                                            </div>
                                            <div class="row p-2">
                                                <div class="col-lg-6" id="">
                                                    <div id="file-display" class="d-flex flex-row m-2">

                                                        <?php 
                                                        if(isset($id)):
                                                        if(is_dir('../img/'.$id)):
                                                        $gal = scandir('../img/'.$PostID);
                                                        unset($gal[0]);
                                                        unset($gal[1]);
                                                        foreach($gal as $k=>$v):
                                                            $mime = mime_content_type('../img/'.$PostID.'/'.$v);
                                                            $img = file_get_contents('../img/'.$PostID.'/'.$v); 
                                                            $data = base64_encode($img); 
                                                        ?>
                                                            <div class="imgF">
                                                                <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                                                                <input type="hidden" name="img[]" value="<?php echo $data ?>">
                                                                <input type="hidden" name="imgName[]" value="<?php echo $v ?>">
                                                                <?php if(strstr($mime,'image')): ?>
                                                                <img class="imgDropped" src="img/<?php echo $PostID.'/'.$v ?>">
                                                                <?php else: ?>
                                                                <video src="img/<?php echo $row['file_path'] ?>"></video>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="requestWarning" class="alert alert-danger" style="display: none;">
                                                
                                            </div>
                                            <?php
                                                if(isset($_GET["error"])){
                                                    if($_GET["error"] == "none"){
                                                        echo "<div class='alert alert-success' role='alert'>
                                                        Your request has been submitted! You can check the status of your
                                                        request on your profile.
                                                        </div>";
                                                    }
                                                    if($_GET["error"] == "pendingReq"){
                                                        echo "<div class='alert alert-danger' role='alert'>
                                                        Your request has been denied! You still have a pending document
                                                        in queue.
                                                        </div>";
                                                    }
                                                }
                                            ?>
                                        </section>
                                        <br>
                                        <div class="m-3 p-3 text-right">
                                            <button type="button" onclick="checkInputs()" class="btn btn-primary border" data-id="<?php echo $_SESSION['UsersID']; ?>" >Submit</button>
                                        </div>
                                        <div class="imgF" style="display: none " id="img-clone">
                                            <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                                    </div>
                                </div>
                            </form>
                            <script>
                                function checkInputs(){
                                    if(document.getElementById("requirementPic").style.display == "flex"){
                                        if($("#postF").get(0).files.length === 0){
                                            document.getElementById("requestWarning").innerHTML = "Please upload the requirements listed";
                                            document.getElementById("requestWarning").style.display = "flex";
                                            return;
                                        }
                                    } 
                                    if(document.getElementById("additionalInput").innerHTML != ""){
                                        if($("#monthlySalary").val() == ""){
                                            document.getElementById("requestWarning").innerHTML = "Please enter a valid monthly salary";
                                            document.getElementById("requestWarning").style.display = "flex";
                                            return;
                                        }
                                        
                                    }    
                                    $('#requestForm').submit();
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
        <script>
            $(document).ready(function() {
                $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                    $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
                } );

                $('table').DataTable({
                    "responsive": true,
                    orderCellsTop: true,
                    dom: 'lBfrtip',
                    "scrollY": "400px",
                    "scrollCollapse": true,
                    "paging": false,
                    "ordering": false,
                    initComplete: function(){
                        
                    }
                });
            });
        </script>
    <?php elseif($_SESSION["userType"] == "Secretary"): ?>
        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Requests (<?php echo $_SESSION['userBarangay'] ?>)</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="release-tab" data-toggle="tab" href="#release" role="tab" aria-controls="home" aria-selected="true">Paid</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="released-tab" data-toggle="tab" href="#released" role="tab" aria-controls="profile" aria-selected="false">Released</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="false">Request Form</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="release" role="tabpanel" aria-labelledby="release-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-dark" 
                                id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                <thead >
                                    <tr class="bg-gradient-secondary text-white">
                                        <th>Request ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Document Type</th>
                                        <th scope="col">Purpose</th>
                                        <th scope="col">Date Requested</th>
                                        <th scope="col">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Row 1-->
                                    <?php 
                                        $requests = $conn->query("SELECT request.*, concat(users.Firstname, ' ', users.Lastname) as name, 
                                        DATE_FORMAT(requestedOn, '%m/%d/%Y %h:%i %p') as requestedDate, 
                                        DATE_FORMAT(approvedOn, '%m/%d/%Y %h:%i %p') as approvedDate, users.userType, 
                                        users.profile_pic 
                                        FROM request 
                                        INNER JOIN users 
                                        ON request.UsersID=users.UsersID 
                                        WHERE request.status='Paid' 
                                        AND request.userPurok='{$_SESSION['userPurok']}' 
                                        AND request.userBarangay='{$_SESSION['userBarangay']}' 
                                        AND request.userType='{$_SESSION['userType']}'");
                                        while($row=$requests->fetch_assoc()):
                                        if($row["userType"] == "Admin"){
                                            continue;
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo $row['RequestID'] ?></td>
                                        <td>
                                            <img class="img-profile rounded-circle <?php 
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
                                            ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                            <br>
                                            <?php echo $row["name"] ?>
                                        </td>
                                        <td><?php echo $row["documentType"] ?></td>
                                        <td><?php echo $row["purpose"] ?></td>
                                        <td><?php echo $row["requestedDate"] ?></td>
                                        <td>
                                            <button class="btn btn-success releaseFunc" id="releaseFunc" data-id="<?php echo $row["RequestID"] ?>"><i class="fas fa-check"></i> Release</button>
                                            <!-- <?php if($row['documentType'] == 'Barangay Clearance'): ?>
                                            <button class="btn btn-primary" id="print" data-id="<?php echo $row['RequestID'] ?>"><i class="fas fa-check"></i> Print</button>
                                            <?php endif; ?> -->
                                        </td>
                                        <!--Right Options-->
                                    </tr>
                                    <?php endwhile; ?>
                                    <!--Row 1-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="released" role="tabpanel" aria-labelledby="released-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-dark" 
                                id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                                <thead >
                                    <tr class="bg-gradient-secondary text-white">
                                        <th scope="col">Name</th>
                                        <th scope="col">Document Type</th>
                                        <th scope="col">Purpose</th>
                                        <th scope="col">Date Requested</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Managed By</th>
                                        <th scope="col">Date Managed</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    <!--Row 1-->
                                    <?php 
                                        $requests = $conn->query("SELECT request.*, concat(users.Firstname, ' ', users.Lastname) 
                                        as name, DATE_FORMAT(requestedOn, '%m/%d/%Y %h:%i %p') as requestedDate, 
                                        DATE_FORMAT(approvedOn, '%m/%d/%Y %h:%i %p') as approvedDate, users.userType, 
                                        users.profile_pic FROM request INNER JOIN users ON request.UsersID=users.UsersID 
                                        WHERE request.status='Released' AND request.userPurok='{$_SESSION['userPurok']}' 
                                        AND request.userBarangay='{$_SESSION['userBarangay']}'");
                                        while($row=$requests->fetch_assoc()):
                                            if($row["userType"] == "Admin"){
                                                continue;
                                            }
                                    ?>
                                    <tr>
                                        <td>
                                            <img class="img-profile rounded-circle <?php 
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
                                            ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                            <br>
                                            <?php echo $row["name"] ?>
                                        </td>
                                        <td><?php echo $row["documentType"] ?></td>
                                        <td><?php echo $row["purpose"] ?></td>
                                        <td><?php echo $row["requestedDate"] ?></td>
                                        <td><?php if($row["status"] != NULL){echo $row["status"];} else{echo "Pending";} ?></td>
                                        <td><?php if($row["approvedBy"] != NULL){echo $row["approvedBy"];} else{echo "None";} ?></td>
                                        <td><?php if($row["approvedOn"] != NULL){echo $row["approvedDate"];} else{echo "None";} ?></td>
                                        <!--Right Options-->
                                    </tr>
                                    <?php endwhile; ?>
                                    <!--Row 1-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">
                        <div class="container-fluid">
                            <form action="includes/request.inc.php?addRequest" id="requestForm" method="POST">
                                <div class="row">
                                    <div class="col-md">
                                        <div class="container-fluid">
                                            <div class="shadow p-4 border border-4" style="border-color: #3c4a56;">
                                                <section>
                                                    <strong>Request Document</strong>
                                                    <div class="row p-2">
                                                        <div class="col-lg-6 m-1">
                                                            <label>Choose document:</label>
                                                            <select name="document" id="document" class="form-control w-75 form-control-md form-select" onChange="changecat(this.value);" required>
                                                                <option value="" hidden selected>Select</option>
                                                                <?php $requestSql = $conn->query("SELECT * FROM documenttype WHERE barangayName='{$_SESSION['userBarangay']}'");
                                                                while($documents = $requestSql->fetch_assoc()): ?>
                                                                <?php 
                                                                    if($diff <= $documents['minimumMos']){
                                                                        continue;
                                                                    }
                                                                    if($documents['allowLessee'] == "False"){
                                                                        if($userSql['isRenting'] == "True"){
                                                                            continue;
                                                                        }
                                                                    }
                                                                    if($documents['VoterRequired'] == "True"){
                                                                        if($userSql['IsVoter'] != "True"){
                                                                            continue;
                                                                        }
                                                                    }
                                                                ?>
                                                                <option data-user="<?php echo $userData['isRenting'] ?>" data-id="<?php echo $documents['requireLessorNote'] ?>" value="<?php echo $documents['DocumentID'] ?>"><?php echo $documents['documentName'] ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-5 m-1">
                                                            <label>Purpose:</label>
                                                            <select name="purpose" id="purpose" class="form-control w-75 form-control-md form-select" required>
                                                                <option value="" hidden selected>Select</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row p-2" id="requirementArea">
                                                        <div class="col-lg">
                                                            <label>Requirement Needed: </label>
                                                            <ul id="listofrequirements">
                                                            </ul>
                                                            <!-- <input style="display: none;" class="form-control-file" type="file" name="requirementPic[]" id="requirementPic" accept="image/*" multiple> -->
                                                            <input type="file" name="file[]" multiple="multiple" onchange="" id="postF" onchange="displayUpload(this)" class="d-none" accept="image/*" required>
                                                            <button id="requirementPic" style="display: none;" onclick="$('#postF').trigger('click')" type="button" class="btn btn-success"><i class="fas fa-photo-video"></i> Upload</button>
                                                        </div>
                                                        <div class="col-lg m-1" id="additionalInput">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row p-2">
                                                        <div class="col-lg-6" id="">
                                                            <div id="file-display" class="d-flex flex-row m-2">

                                                                <?php 
                                                                if(isset($id)):
                                                                if(is_dir('../img/'.$id)):
                                                                $gal = scandir('../img/'.$PostID);
                                                                unset($gal[0]);
                                                                unset($gal[1]);
                                                                foreach($gal as $k=>$v):
                                                                    $mime = mime_content_type('../img/'.$PostID.'/'.$v);
                                                                    $img = file_get_contents('../img/'.$PostID.'/'.$v); 
                                                                    $data = base64_encode($img); 
                                                                ?>
                                                                    <div class="imgF">
                                                                        <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                                                                        <input type="hidden" name="img[]" value="<?php echo $data ?>">
                                                                        <input type="hidden" name="imgName[]" value="<?php echo $v ?>">
                                                                        <?php if(strstr($mime,'image')): ?>
                                                                        <img class="imgDropped" src="img/<?php echo $PostID.'/'.$v ?>">
                                                                        <?php else: ?>
                                                                        <video src="img/<?php echo $row['file_path'] ?>"></video>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                <?php endif; ?>
                                                                <?php endif; ?>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="requestWarning" class="alert alert-danger" style="display: none;">
                                                        
                                                    </div>
                                                    <?php
                                                        if(isset($_GET["error"])){
                                                            if($_GET["error"] == "none"){
                                                                echo "<div class='alert alert-success' role='alert'>
                                                                Your request has been submitted! You can check the status of your
                                                                request on your profile.
                                                                </div>";
                                                            }
                                                            if($_GET["error"] == "pendingReq"){
                                                                echo "<div class='alert alert-danger' role='alert'>
                                                                Your request has been denied! You still have a pending document
                                                                in queue.
                                                                </div>";
                                                            }
                                                        }
                                                    ?>
                                                </section>
                                                <br>
                                                <div class="m-3 p-3 text-right">
                                                    <button type="button" onclick="checkInputs()" class="btn btn-primary border" data-id="<?php echo $_SESSION['UsersID']; ?>" >Submit</button>
                                                </div>
                                                <div class="imgF" style="display: none " id="img-clone">
                                                    <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                                            </div>
                                        </div>
                                        <!-- End of Nonvoter - Request Form -->
                                    </div>
                                </div>
                            </form>
                            <script>
                                function checkInputs(){
                                    if(document.getElementById("requirementPic").style.display == "flex"){
                                        if($("#postF").get(0).files.length === 0){
                                            document.getElementById("requestWarning").innerHTML = "Please upload the requirements listed";
                                            document.getElementById("requestWarning").style.display = "flex";
                                            return;
                                        }
                                    } 
                                    if(document.getElementById("additionalInput").innerHTML != ""){
                                        if($("#monthlySalary").val() == ""){
                                            document.getElementById("requestWarning").innerHTML = "Please enter a valid monthly salary";
                                            document.getElementById("requestWarning").style.display = "flex";
                                            return;
                                        }
                                        
                                    }    
                                    $('#requestForm').submit();
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Card Body-->
        </div>                     
    </div>       
    <?php elseif($_SESSION["userType"] == "Purok Leader"): ?>
        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Requests (<?php echo $_SESSION['userBarangay'] ?>)</h6>
            </div>
            <div class="card-body" style="font-size: 75%">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Approved</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="disapproved-tab" data-toggle="tab" href="#disapproved" role="tab" aria-controls="disapproved" aria-selected="false">Disapproved</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="false">Request Form</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-dark" 
                                id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                <thead >
                                    <tr class="bg-gradient-secondary text-white">
                                        <th scope="col">Name</th>
                                        <th scope="col">Document Type</th>
                                        <th scope="col">Purpose</th>
                                        <th scope="col">Date Requested</th>
                                        <th scope="col">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Row 1-->
                                    <?php 
                                        $requests = $conn->query("SELECT request.*, concat(users.Firstname, ' ', users.Lastname) as name, 
                                        DATE_FORMAT(requestedOn, '%m/%d/%Y %h:%i %p') as requestedDate, 
                                        DATE_FORMAT(approvedOn, '%m/%d/%Y %h:%i %p') as approvedDate, users.userType, 
                                        users.profile_pic 
                                        FROM request 
                                        INNER JOIN users 
                                        ON request.UsersID=users.UsersID 
                                        WHERE request.status='Pending' 
                                        AND request.userPurok='{$_SESSION['userPurok']}' 
                                        AND request.userBarangay='{$_SESSION['userBarangay']}' 
                                        AND request.userType='{$_SESSION['userType']}'
                                        ORDER BY requestedOn DESC");
                                        while($row=$requests->fetch_assoc()):
                                            if($row["userType"] == "Admin"){
                                                continue;
                                            }
                                    ?>
                                    <tr>
                                        <td>
                                            <img class="img-profile rounded-circle <?php 
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
                                            ?>" src="img/users/<?php echo $row['UsersID'] ?>/profile_pic/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                            <br>
                                            <?php echo $row["name"] ?>
                                        </td>
                                        <td><?php echo $row["documentType"] ?></td>
                                        <td><?php echo $row["purpose"] ?></td>
                                        <td><?php echo $row["requestedDate"] ?></td>
                                        <td>
                                            <?php if(is_dir("img/erequest/".$row['RequestID'])): ?>
                                                <button class="btn btn-primary viewRequirement" data-id="<?php echo $row['RequestID'] ?>"><i class="fas fa-eye"></i> View</button>
                                            <?php else: ?>
                                                <a href="includes/request.inc.php?approveID=<?php echo $row["RequestID"] ?>">
                                                <button class="btn btn-success approve" data-id="<?php echo $row['RequestID'] ?>"><i class="fas fa-check"></i> Approve</button>
                                                </a>
                                            <?php endif; ?>
                                            
                                        </td>
                                        <!--Right Options-->
                                    </tr>
                                    <?php endwhile; ?>
                                    <!--Row 1-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-dark" 
                                id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                <thead >
                                    <tr class="bg-gradient-secondary text-white">
                                        <th scope="col">Name</th>
                                        <th scope="col">Document Type</th>
                                        <th scope="col">Purpose</th>
                                        <th scope="col">Date Requested</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Row 1-->
                                    <?php 
                                        $requests = $conn->query("SELECT request.*, concat(users.Firstname, ' ', users.Lastname) as name, 
                                        DATE_FORMAT(requestedOn, '%m/%d/%Y %h:%i %p') as requestedDate, 
                                        DATE_FORMAT(approvedOn, '%m/%d/%Y %h:%i %p') as approvedDate, users.userType, 
                                        users.profile_pic 
                                        FROM request 
                                        INNER JOIN users 
                                        ON request.UsersID=users.UsersID 
                                        WHERE request.status='Approved' 
                                        AND request.userPurok='{$_SESSION['userPurok']}' 
                                        AND request.userBarangay='{$_SESSION['userBarangay']}' 
                                        AND request.userType='{$_SESSION['userType']}'
                                        ORDER BY requestedOn DESC");
                                        while($row=$requests->fetch_assoc()):
                                            if($row["userType"] == "Admin"){
                                                continue;
                                            }
                                    ?>
                                    <tr>
                                        <td>
                                            <img class="img-profile rounded-circle <?php 
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
                                            ?>" src="img/users/<?php echo $row['UsersID'] ?>/profile_pic/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                            <br>
                                            <?php echo $row["name"] ?>
                                        </td>
                                        <td><?php echo $row["documentType"] ?></td>
                                        <td><?php echo $row["purpose"] ?></td>
                                        <td><?php echo $row["requestedDate"] ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="disapproved" role="tabpanel" aria-labelledby="disapproved-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-dark" 
                                id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                <thead >
                                    <tr class="bg-gradient-secondary text-white">
                                        <th scope="col">Name</th>
                                        <th scope="col">Document Type</th>
                                        <th scope="col">Purpose</th>
                                        <th scope="col">Date Requested</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Row 1-->
                                    <?php 
                                        $requests = $conn->query("SELECT request.*, concat(users.Firstname, ' ', users.Lastname) as name, 
                                        DATE_FORMAT(requestedOn, '%m/%d/%Y %h:%i %p') as requestedDate, 
                                        DATE_FORMAT(approvedOn, '%m/%d/%Y %h:%i %p') as approvedDate, users.userType, 
                                        users.profile_pic 
                                        FROM request 
                                        INNER JOIN users 
                                        ON request.UsersID=users.UsersID 
                                        WHERE request.status='Disapproved' 
                                        AND request.userPurok='{$_SESSION['userPurok']}' 
                                        AND request.userBarangay='{$_SESSION['userBarangay']}' 
                                        AND request.userType='{$_SESSION['userType']}'
                                        ORDER BY requestedOn DESC");
                                        while($row=$requests->fetch_assoc()):
                                            if($row["userType"] == "Admin"){
                                                continue;
                                            }
                                    ?>
                                    <tr>
                                        <td>
                                            <img class="img-profile rounded-circle <?php 
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
                                            ?>" src="img/users/<?php echo $row['UsersID'] ?>/profile_pic/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                            <br>
                                            <?php echo $row["name"] ?>
                                        </td>
                                        <td><?php echo $row["documentType"] ?></td>
                                        <td><?php echo $row["purpose"] ?></td>
                                        <td><?php echo $row["requestedDate"] ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">
                        <div class="container-fluid">
                            <form action="includes/request.inc.php?addRequest" id="requestForm" method="POST">
                                <div class="row">
                                    <div class="col-md">
                                        <section>
                                            <strong>Request Document</strong>
                                            <div class="row p-2">
                                                <div class="col-lg-6 m-1">
                                                    <label>Choose document:</label>
                                                    <select name="document" id="document" class="form-control w-75 form-control-md form-select" onChange="changecat(this.value);" required>
                                                        <option value="" hidden selected>Select</option>
                                                        <?php $requestSql = $conn->query("SELECT * FROM documenttype WHERE barangayName='{$_SESSION['userBarangay']}'");
                                                        while($documents = $requestSql->fetch_assoc()): ?>
                                                        <?php 
                                                            if($diff <= $documents['minimumMos']){
                                                                continue;
                                                            }
                                                            if($documents['allowLessee'] == "False"){
                                                                if($userSql['isRenting'] == "True"){
                                                                    continue;
                                                                }
                                                            }
                                                            if($documents['VoterRequired'] == "True"){
                                                                if($userSql['IsVoter'] != "True"){
                                                                    continue;
                                                                }
                                                            }
                                                        ?>
                                                        <option data-user="<?php echo $userData['isRenting'] ?>" data-id="<?php echo $documents['requireLessorNote'] ?>" value="<?php echo $documents['DocumentID'] ?>"><?php echo $documents['documentName'] ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-5 m-1">
                                                    <label>Purpose:</label>
                                                    <select name="purpose" id="purpose" class="form-control w-75 form-control-md form-select" required>
                                                        <option value="" hidden selected>Select</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row p-2" id="requirementArea">
                                                <div class="col-lg">
                                                    <label>Requirement Needed: </label>
                                                    <ul id="listofrequirements">
                                                    </ul>
                                                    <!-- <input style="display: none;" class="form-control-file" type="file" name="requirementPic[]" id="requirementPic" accept="image/*" multiple> -->
                                                    <input type="file" name="file[]" multiple="multiple" onchange="" id="postF" onchange="displayUpload(this)" class="d-none" accept="image/*" required>
                                                    <button id="requirementPic" style="display: none;" onclick="$('#postF').trigger('click')" type="button" class="btn btn-success"><i class="fas fa-photo-video"></i> Upload</button>
                                                </div>
                                                <div class="col-lg m-1" id="additionalInput">
                                                    
                                                </div>
                                            </div>
                                            <div class="row p-2">
                                                <div class="col-lg-6" id="">
                                                    <div id="file-display" class="d-flex flex-row m-2">

                                                        <?php 
                                                        if(isset($id)):
                                                        if(is_dir('../img/'.$id)):
                                                        $gal = scandir('../img/'.$PostID);
                                                        unset($gal[0]);
                                                        unset($gal[1]);
                                                        foreach($gal as $k=>$v):
                                                            $mime = mime_content_type('../img/'.$PostID.'/'.$v);
                                                            $img = file_get_contents('../img/'.$PostID.'/'.$v); 
                                                            $data = base64_encode($img); 
                                                        ?>
                                                            <div class="imgF">
                                                                <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                                                                <input type="hidden" name="img[]" value="<?php echo $data ?>">
                                                                <input type="hidden" name="imgName[]" value="<?php echo $v ?>">
                                                                <?php if(strstr($mime,'image')): ?>
                                                                <img class="imgDropped" src="img/<?php echo $PostID.'/'.$v ?>">
                                                                <?php else: ?>
                                                                <video src="img/<?php echo $row['file_path'] ?>"></video>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="requestWarning" class="alert alert-danger" style="display: none;">
                                                
                                            </div>
                                            <?php
                                                if(isset($_GET["error"])){
                                                    if($_GET["error"] == "none"){
                                                        echo "<div class='alert alert-success' role='alert'>
                                                        Your request has been submitted! You can check the status of your
                                                        request on your profile.
                                                        </div>";
                                                    }
                                                    if($_GET["error"] == "pendingReq"){
                                                        echo "<div class='alert alert-danger' role='alert'>
                                                        Your request has been denied! You still have a pending document
                                                        in queue.
                                                        </div>";
                                                    }
                                                }
                                            ?>
                                        </section>
                                        <br>
                                        <div class="m-3 p-3 text-right">
                                            <button type="button" onclick="checkInputs()" class="btn btn-primary border" data-id="<?php echo $_SESSION['UsersID']; ?>" >Submit</button>
                                        </div>
                                        <div class="imgF" style="display: none " id="img-clone">
                                            <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                                    </div>
                                </div>
                            </form>
                            <script>
                                function checkInputs(){
                                    if(document.getElementById("requirementPic").style.display == "flex"){
                                        if($("#postF").get(0).files.length === 0){
                                            document.getElementById("requestWarning").innerHTML = "Please upload the requirements listed";
                                            document.getElementById("requestWarning").style.display = "flex";
                                            return;
                                        }
                                    } 
                                    if(document.getElementById("additionalInput").innerHTML != ""){
                                        if($("#monthlySalary").val() == ""){
                                            document.getElementById("requestWarning").innerHTML = "Please enter a valid monthly salary";
                                            document.getElementById("requestWarning").style.display = "flex";
                                            return;
                                        }
                                        
                                    }    
                                    $('#requestForm').submit();
                                }
                            </script>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                    $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
                } );

                var table = $('table').DataTable({
                    "scrollY": "400px",
                    "scrollCollapse": true,
                    "paging": false,
                    "ordering": false,
                    initComplete: function(){
                    }
                });
            });
        </script>
    <?php elseif($_SESSION["userType"] == "Captain"): ?>
        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Request Form</h6>
            </div>
            <div class="container-fluid">
                <form action="includes/request.inc.php?addRequest" id="requestForm" method="POST">
                    <div class="row">
                        <div class="col-md">
                            <section>
                                <div class="row p-2">
                                    <div class="col-lg-6 m-1">
                                        <label>Choose document:</label>
                                        <select name="document" id="document" class="form-control w-75 form-control-md form-select" onChange="changecat(this.value);" required>
                                            <option value="" hidden selected>Select</option>
                                            <?php $requestSql = $conn->query("SELECT * FROM documenttype WHERE barangayName='{$_SESSION['userBarangay']}'");
                                            while($documents = $requestSql->fetch_assoc()): ?>
                                            <?php 
                                                if($diff <= $documents['minimumMos']){
                                                    continue;
                                                }
                                                if($documents['allowLessee'] == "False"){
                                                    if($userSql['isRenting'] == "True"){
                                                        continue;
                                                    }
                                                }
                                                if($documents['VoterRequired'] == "True"){
                                                    if($userSql['IsVoter'] == "True"){
                                                        continue;
                                                    }
                                                }
                                            ?>
                                            <option data-user="<?php echo $userData['isRenting'] ?>" data-id="<?php echo $documents['requireLessorNote'] ?>" value="<?php echo $documents['DocumentID'] ?>"><?php echo $documents['documentName'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-5 m-1">
                                        <label>Purpose:</label>
                                        <select name="purpose" id="purpose" class="form-control w-75 form-control-md form-select" required>
                                            <option value="" hidden selected>Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row p-2" id="requirementArea">
                                    <div class="col-lg">
                                        <label>Requirement Needed: </label>
                                        <ul id="listofrequirements">
                                        </ul>
                                        <!-- <input style="display: none;" class="form-control-file" type="file" name="requirementPic[]" id="requirementPic" accept="image/*" multiple> -->
                                        <input type="file" name="file[]" multiple="multiple" onchange="" id="postF" onchange="displayUpload(this)" class="d-none" accept="image/*" required>
                                        <button id="requirementPic" style="display: none;" onclick="$('#postF').trigger('click')" type="button" class="btn btn-success"><i class="fas fa-photo-video"></i> Upload</button>
                                    </div>
                                    <div class="col-lg m-1" id="additionalInput">
                                        
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-lg-6" id="">
                                        <div id="file-display" class="d-flex flex-row m-2">

                                            <?php 
                                            if(isset($id)):
                                            if(is_dir('../img/'.$id)):
                                            $gal = scandir('../img/'.$PostID);
                                            unset($gal[0]);
                                            unset($gal[1]);
                                            foreach($gal as $k=>$v):
                                                $mime = mime_content_type('../img/'.$PostID.'/'.$v);
                                                $img = file_get_contents('../img/'.$PostID.'/'.$v); 
                                                $data = base64_encode($img); 
                                            ?>
                                                <div class="imgF">
                                                    <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                                                    <input type="hidden" name="img[]" value="<?php echo $data ?>">
                                                    <input type="hidden" name="imgName[]" value="<?php echo $v ?>">
                                                    <?php if(strstr($mime,'image')): ?>
                                                    <img class="imgDropped" src="img/<?php echo $PostID.'/'.$v ?>">
                                                    <?php else: ?>
                                                    <video src="img/<?php echo $row['file_path'] ?>"></video>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div id="requestWarning" class="alert alert-danger" style="display: none;">
                                    
                                </div>
                                <?php
                                    if(isset($_GET["error"])){
                                        if($_GET["error"] == "none"){
                                            echo "<div class='alert alert-success' role='alert'>
                                            Your request has been submitted! You can check the status of your
                                            request on your profile.
                                            </div>";
                                        }
                                        if($_GET["error"] == "pendingReq"){
                                            echo "<div class='alert alert-danger' role='alert'>
                                            Your request has been denied! You still have a pending document
                                            in queue.
                                            </div>";
                                        }
                                    }
                                ?>
                            </section>
                            <br>
                            <div class="m-3 p-3 text-right">
                                <button type="button" onclick="checkInputs()" class="btn btn-primary border" data-id="<?php echo $_SESSION['UsersID']; ?>" >Submit</button>
                            </div>
                            <div class="imgF" style="display: none " id="img-clone">
                                <span class="rem badge badge-primary" onclick="rem_func($(this))" style="cursor: pointer;"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </form>
                <script>
                    function checkInputs(){
                        if(document.getElementById("requirementPic").style.display == "flex"){
                            if($("#postF").get(0).files.length === 0){
                                document.getElementById("requestWarning").innerHTML = "Please upload the requirements listed";
                                document.getElementById("requestWarning").style.display = "flex";
                                return;
                            }
                        } 
                        if(document.getElementById("additionalInput").innerHTML != ""){
                            if($("#monthlySalary").val() == ""){
                                document.getElementById("requestWarning").innerHTML = "Please enter a valid monthly salary";
                                document.getElementById("requestWarning").style.display = "flex";
                                return;
                            }
                            
                        }    
                        $('#requestForm').submit();
                    }
                </script>
            </div>
        </div>  
    </div>
    <?php endif; ?>
    

</div>
<!-- End of Row -->
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog" role="document" style="border-color:#384550 ;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Ready to Leave?</h5>
                        <!--<button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>-->    <!--push-->
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <a class="btn btn-outline-primary" href="login.php">Logout</a>
                        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>


    <script>

    
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
    window.verifyInfo_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#verifyInfo .modal-title').html($title)
                    $('#verifyInfo .modal-body').html(resp)
                    if($size != ''){
                        $('#verifyInfo .modal-dialog').addClass($size)
                    }else{
                        $('#verifyInfo .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                    }
                    $('#verifyInfo').modal({
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
    window.print_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#print_modal .modal-title').html($title)
                    $('#print_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#print_modal .modal-dialog').addClass($size)
                    }else{
                        $('#print_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-lg")
                    }
                    $('#print_modal').modal({
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
    $('.continueRequest').click(function(){
        var ddl = document.getElementById("document");
        var selectedValue = ddl.options[ddl.selectedIndex].value;
        var ddl2 = document.getElementById("purpose");
        var selectedValue2 = ddl2.options[ddl2.selectedIndex].value;
        if (selectedValue == ""){
            alert("Please select a document");
        }
        else if(selectedValue2 == ""){
            alert("Please select a valid purpose");
        }
        else{
            verifyInfo_modal("<center><b>Verify Information</b></center>","includes/request.inc.php?continueRequest&usersid="+$(this).attr("data-id") +"&docType="+$("#document").val()+"&purpose="+$("#purpose").val());
        }
    })
    $('.viewRequirement').click(function(){
        uni_modal("Requirements given","includes/request.inc.php?viewRequirement&RequestID="+$(this).attr('data-id'), "modal-lg");
    })
    $('#print').click(function(){
        print_modal("<center><b>Print</b></center></center>","brgy_clearance.php?requestID="+$(this).attr('data-id'));
    })
    $('.delete_document').click(function(){
        _conf("Are you sure you want to delete this document?","delete_document",[$(this).attr('data-id')])
    })
    $('.paid_request').click(function(){
        _conf("Confirm the request is paid?","paid_request",[$(this).attr('data-id')])
    })
    $('.releaseFunc').click(function(){
        _conf("Release the document?","releaseDoc",[$(this).attr('data-id')])
    })
    $('.view_profile').click(function(){
        uni_modal("<center>Profile</center>","profile_alt.php?viewProfile&UsersID="+$(this).attr('data-id'), "modal-lg");
    })
    $('.document_edit').click(function(){
        uni_modal("<center><b>Document edit for " + $(this).attr('data-docu') + "</b></center></center>","includes/document.inc.php?viewPurpose&docuName="+$(this).attr('data-docu')+"&docuType="+$(this).attr('data-id'), "modal-lg");
    })
    $('.add_document').click(function(){
        uni_modal("<center><b>New document </b></center></center>","includes/document.inc.php?addDocument&barangay="+$(this).attr('data-id'));
    })
    function delete_document($id){
        start_load()
        $.ajax({
            url:'includes/document.inc.php?delete_document',
            method:'POST',
            data:{id:$id},
            
            success:function(){
                location.reload()
            }
        })
    }
    function paid_request($id){
        start_load()
        $.ajax({
            url:'includes/request.inc.php?paid='+$(this).attr('data-id'),
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }
    function releaseDoc($id){
        start_load()
        $.ajax({
            url:'includes/request.inc.php?release',
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }

    if('<?php echo isset($_GET['upload']) ?>' == 1){
		$('#postF').trigger('click')
	}
	if('<?php echo isset($_GET['id']) ?>' == 1){
		$('[name="content"]').trigger('keyup')
	}
	$('[name="file[]"]').change(function(){
		displayUpload(this)
	})
	function displayUpload(input){
        if(document.getElementById("requestWarning").style.display == "flex"){
            document.getElementById("requestWarning").style.display = "none";
        } 
    	if (input.files) {
		Object.keys(input.files).map(function(k){
			var reader = new FileReader();
				var t = input.files[k].type;
				var _types = ['video/mp4','image/x-png','image/png','image/gif','image/jpeg','image/jpg'];
				if(_types.indexOf(t) == -1)
					return false;
				reader.onload = function (e) {
					// $('#cimg').attr('src', e.target.result);
				var bin = e.target.result;
				var fname = input.files[k].name;
				var imgF = document.getElementById('img-clone');
					imgF = imgF.cloneNode(true);
					imgF.removeAttribute('id')
					imgF.removeAttribute('style')
					if(t == "video/mp4"){
						var img = document.createElement("video");
						}else{
						var img = document.createElement("img");
						}
						var fileinput = document.createElement("input");
						var fileinputName = document.createElement("input");
						fileinput.setAttribute('type','hidden')
						fileinputName.setAttribute('type','hidden')
						fileinput.setAttribute('name','img[]')
						fileinputName.setAttribute('name','imgName[]')
						fileinput.value = bin
						fileinputName.value = fname
						img.classList.add("imgDropped")
						img.src = bin;
						imgF.appendChild(fileinput);
						imgF.appendChild(fileinputName);
						imgF.appendChild(img);
						document.querySelector('#file-display').appendChild(imgF)
				}
			reader.readAsDataURL(input.files[k]);
			})
			rem_func()
		}
    }
	function rem_func(_this){
		_this.closest('.imgF').remove();
		if($('#drop .imgF').length <= 0){
			$('#drop').append('<span id="dname" class="text-center">Drop Files Here <br> or <br> <label for="chooseFile"><strong>Choose File</strong></label></span>')
		}
	}

    var mealsByCategory = { 
    <?php    
        $puroks = array();
        $barangay = $conn->query("SELECT * FROM documenttype WHERE barangayName='{$_SESSION['userBarangay']}'");
        while($brow = $barangay->fetch_assoc()):
    ?>
        <?php 
        echo json_encode($brow["DocumentID"]) ?> : <?php $purok = $conn->query("SELECT * FROM documentpurpose WHERE barangayDoc='{$brow['DocumentID']}'"); 
        while($prow = $purok->fetch_assoc()):
        $puroks[] = $prow["purpose"]?>
        <?php endwhile; echo json_encode($puroks). ","; $puroks = array();?>
        <?php endwhile; ?> 

    }

    var requirementsByDocument = { 
    <?php    
        $requirements = array();
        $document = $conn->query("SELECT * FROM documenttype WHERE barangayName='{$_SESSION['userBarangay']}'");
        while($drow = $document->fetch_assoc()):
    ?>
        <?php 
        echo json_encode($drow["DocumentID"]) ?> : <?php $requirementsql = $conn->query("SELECT * FROM requirementlist WHERE DocumentID='{$drow['DocumentID']}'"); 
        while($rrow = $requirementsql->fetch_assoc()):
        $requirements[] = $rrow["requirementName"]?>
        <?php endwhile; echo json_encode($requirements). ","; $requirements = array();?>
        <?php endwhile; ?> 
        
    }

    function changecat(value) {
        if (value.length == 0) document.getElementById("purpose").innerHTML = "<option>Empty</option>";
        else {
            var requirenote = $("#document").find(':selected').attr('data-id');
            var lessee = $("#document").find(':selected').attr('data-user');
            var requirements = "";
            var catOptions = "";

            additionalInput(value);

            if(mealsByCategory[value].length != 0){
                for (categoryId in mealsByCategory[value]) {
                    catOptions += "<option>" + mealsByCategory[value][categoryId] + "</option>";
                }
                document.getElementById("purpose").innerHTML = catOptions;
            }
            if(requirementsByDocument[value].length != 0){
                for (requirementID in requirementsByDocument[value]) {
                    requirements += "<li>" + requirementsByDocument[value][requirementID] + "</li>";
                }   
                if(String(lessee) == "True"){
                    if(String(requirenote) == "True"){
                        requirements += "<li>Note from your Lessor</li>";
                    }
                }
                document.getElementById("listofrequirements").innerHTML = requirements;
                document.getElementById("requirementPic").style.display = "flex";
            }
            else if(requirementsByDocument[value].length == 0){
                if(String(lessee) == "True"){
                    if(String(requirenote) == "True"){
                        requirements += "<li>Note from your Lessor</li>";
                        document.getElementById("requirementPic").style.display = "flex";
                    }
                    else if(String(requirenote) != "True"){
                        requirements += "<li>No requirements</li>";
                        document.getElementById("requirementPic").style.display = "none";
                    }
                }
                else{
                    requirements += "<li>No requirements</li>";
                    document.getElementById("requirementPic").style.display = "none";
                }
                
                document.getElementById("listofrequirements").innerHTML = requirements;
            }
            else if(mealsByCategory[value].length == 0){
                catOptions += "<option value=''>Empty</option>";
                document.getElementById("purpose").innerHTML = catOptions;
            }
        }
    }

    function additionalInput($documentID){
        start_load()
        $.ajax({
            url: './includes/request.inc.php?additionalInput&DocumentID='+$documentID,
            type: 'GET',
            success: function(data){
                $("#additionalInput").html(data);
            }
        })
    }

    </script>

<?php include 'footer.php'; ?>

    