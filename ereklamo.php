<?php include 'header.php'; ?>

<!-- Begin Page Content -->
<div class="col d-flex flex-column px-4">

<!-- Page Heading --> 
<div class="d-sm-flex align-items-center justify-content-between">  
    <h3 class="font-weight-bold text-dark">eReklamo </h3> 
</div>

<!-- Content Row -->
<div class="container-fluid">

        <?php if($_SESSION["userType"] === "Resident"): 
            if($_SESSION['VerifyStatus'] == "Pending" || $_SESSION['VerifyStatus'] == "Unverified"): 
        ?>
            <div class='alert alert-danger' role='alert' style="text-align: center">
                You're still unverified!
            </div>
            
        <?php else: ?>
        <!--EReklamo Content-->
        <div class="shadow p-4 border border-4" style="border-color: #3c4a56;">    
            <form class="form-group" action="includes/ereklamo.inc.php" method="POST">
                <section>
                    <strong>Concerns</strong>
                    <div class="row p-2">
                        <div class="col-lg-6 m-1">
                            <label>Problem:</label>
                            <select class="form-control w-75 form-control-md form-select" 
                            name="reklamotype" onChange="changecat(this.value);" required>
                                <option selected value="" hidden>Select</option>
                                <optgroup label="Minor">
                                    <?php 
                                    $ereklamoCat = $conn->query("SELECT * FROM ereklamocategory WHERE reklamoCatBrgy='{$_SESSION['userBarangay']}' AND reklamoCatPriority='Minor'"); 
                                    while($categoryRow = $ereklamoCat->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $categoryRow['reklamoCatName'] ?>"><?php echo $categoryRow['reklamoCatName'] ?></option>
                                    <?php endwhile; ?>
                                </optgroup>
                                <optgroup label="Major">
                                <?php 
                                    $ereklamoCat = $conn->query("SELECT * FROM ereklamocategory WHERE reklamoCatBrgy='{$_SESSION['userBarangay']}' AND reklamoCatPriority='Major'"); 
                                    while($categoryRow = $ereklamoCat->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $categoryRow['reklamoCatName'] ?>"><?php echo $categoryRow['reklamoCatName'] ?></option>
                                    <?php endwhile; ?>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-lg-5 m-1">
                            <label>Specific:</label>
                            <select id="specific" name="detail" class="form-control w-75 form-control-md form-select" required>
                                <option value="" hidden selected>Select</option>
                            </select>
                        </div>
                        <div class="col-lg-5 m-1" id="inputArea">
                        </div>
                    </div>
                </section>
                <br>
                <section>
                    <strong>Comments</strong>
                    <div class="row p-2">
                        <label>Additional details:</label>
                        <textarea name="comment" class="form-control" rows="3" style="resize:none;"></textarea>
                    </div>
                    <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "none"){
                                echo "<div class='alert alert-success' role='alert'>
                                Your reklamo has been submitted! 
                                </div>";
                            }
                            if($_GET["error"] == "pendingRek"){
                                echo "<div class='alert alert-warning' role='alert'>
                                You still have a pending reklamo! 
                                </div>";
                            }
                            if($_GET["error"] == "noResident"){
                                echo "<div class='alert alert-danger' role='alert'>
                                You did not included a resident in your reklamo!
                                </div>";
                            }
                        }
                    ?>
                </section>

                <div class="m-3 p-3 text-right">
                <button name="submit" type="submit" class="btn btn-primary border" data-toggle="modal" data-target="#reklamoModal">Continue</button>
                
            </div>
            </form>
            <?php endif; ?>
        </div>
        <!--End of EReklamo Content-->
        <?php elseif($_SESSION["userType"] == "Purok Leader"): ?>
            <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">eReklamo</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-major-tab" data-toggle="tab" href="#nav-major" role="tab" aria-controls="nav-major" aria-selected="false">Major</a>
                        <a class="nav-item nav-link" id="nav-minor-tab" data-toggle="tab" href="#nav-minor" role="tab" aria-controls="nav-minor" aria-selected="true">Minor</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-major" role="tabpanel" aria-labelledby="nav-major-tab">
                        <div class="m-4">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-majorpending-tab" data-toggle="tab" href="#nav-majorpending" role="tab" aria-controls="nav-majorpending" aria-selected="true">Pending</a>
                                    <a class="nav-item nav-link" id="nav-majorongoing-tab" data-toggle="tab" href="#nav-majorongoing" role="tab" aria-controls="nav-majorongoing" aria-selected="false">Ongoing</a>
                                    <a class="nav-item nav-link" id="nav-tocapt-tab" data-toggle="tab" href="#nav-tocapt" role="tab" aria-controls="nav-tocapt" aria-selected="false">To Captain</a>
                                    <a class="nav-item nav-link" id="nav-majorresolved-tab" data-toggle="tab" href="#nav-majorresolved" role="tab" aria-controls="nav-majorresolved" aria-selected="false">Resolved</a>
                                </div>
                            </nav>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-majorpending" role="tabpanel" aria-labelledby="nav-majorpending-tab">
                                <div class="container fluid">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center text-dark" 
                                            id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                            <thead >
                                                <tr class="bg-gradient-secondary text-white">
                                                    <th scope="col">Complainant</th>
                                                    <th>Complainee</th>
                                                    <th scope="col">Reklamo Category</th>
                                                    <th scope="col">Reklamo Type</th>
                                                    <th scope="col">Date Submitted</th>
                                                    <th scope="col">Manage</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <!--Row 1-->
                                                <?php 
                                                    $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                                    as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                                    DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                                    as checkedDate, users.userType, users.profile_pic, users.userAddress, users.userHouseNum, concat(a.Firstname, ' ', a.Lastname) as complainee, a.userType as complaineeType, a.profile_pic as complaineeProfile
                                                    FROM ereklamo 
                                                    INNER JOIN users 
                                                    ON ereklamo.UsersID=users.UsersID
                                                    INNER JOIN users a
                                                    ON ereklamo.complainee=a.UsersID
                                                    WHERE ereklamo.complaintLevel='Major' 
                                                    AND ereklamo.status='Pending'
                                                    AND ereklamo.barangay='{$_SESSION['userBarangay']}' 
                                                    AND ereklamo.purok='{$_SESSION['userPurok']}'");
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
                                                    <td>
                                                        <img class="img-profile rounded-circle <?php 
                                                            if($row["complaineeType"] == "Resident"){
                                                                echo "img-res-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Purok Leader"){
                                                                echo "img-purokldr-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Captain"){
                                                                echo "img-capt-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Secretary"){
                                                                echo "img-sec-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Treasurer"){
                                                                echo "img-treas-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Admin"){
                                                                echo "img-admin-profile";
                                                            }
                                                        ?>" src="img/<?php echo $row["complaineeProfile"] ?>" width="40" height="40"/>
                                                        <br>
                                                        <?php echo $row["complainee"] ?>
                                                    </td>
                                                    <td><?php echo $row["reklamoType"] ?></td>
                                                    <td><?php echo $row["detail"] ?></td>
                                                    <td><?php $date = date_create($row["createdDate"]); 
                                                        echo date_format($date, "F d, Y"); ?></td>
                                                    <td>
                                                        <a href="includes/ereklamo.inc.php?accept&reklamoid=<?php echo $row['ReklamoID'] ?>&usersID=<?php echo $row['UsersID'] ?>"><button type="button" class="btn btn-success"><i class="fas fa-check"></i> Accept</button></a>
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
                            <div class="tab-pane fade" id="nav-majorongoing" role="tabpanel" aria-labelledby="nav-majorongoing-tab">
                                <div class="container fluid">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center text-dark" 
                                            id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                                            <thead >
                                                <tr class="bg-gradient-secondary text-white">
                                                    <th scope="col">Complainant</th>
                                                    <th>Complainee</th>
                                                    <th scope="col">Reklamo Category</th>
                                                    <th scope="col">Reklamo Type</th>
                                                    <th scope="col">Date Submitted</th>
                                                    <th scope="col">Manage</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <!--Row 1-->
                                                <?php 
                                                    $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                                    as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                                    DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                                    as checkedDate, users.userType, users.profile_pic, users.userAddress, users.userHouseNum, concat(a.Firstname, ' ', a.Lastname) as complainee, a.userType as complaineeType, a.profile_pic as complaineeProfile, chatroom.chatroomID
                                                    FROM ereklamo 
                                                    INNER JOIN users 
                                                    ON ereklamo.UsersID=users.UsersID
                                                    INNER JOIN users a
                                                    ON ereklamo.complainee=a.UsersID
                                                    INNER JOIN chatroom
                                                    ON ereklamo.ReklamoID=chatroom.idreference  
                                                    WHERE ereklamo.complaintLevel='Major' 
                                                    AND ereklamo.status='Ongoing'
                                                    AND ereklamo.barangay='{$_SESSION['userBarangay']}' 
                                                    AND ereklamo.purok='{$_SESSION['userPurok']}'");
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
                                                    <td>
                                                        <img class="img-profile rounded-circle <?php 
                                                            if($row["complaineeType"] == "Resident"){
                                                                echo "img-res-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Purok Leader"){
                                                                echo "img-purokldr-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Captain"){
                                                                echo "img-capt-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Secretary"){
                                                                echo "img-sec-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Treasurer"){
                                                                echo "img-treas-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Admin"){
                                                                echo "img-admin-profile";
                                                            }
                                                        ?>" src="img/<?php echo $row["complaineeProfile"] ?>" width="40" height="40"/>
                                                        <br>
                                                        <?php echo $row["complainee"] ?>
                                                    </td>
                                                    <td><?php echo $row["reklamoType"] ?></td>
                                                    <td><?php echo $row["detail"] ?></td>
                                                    <td><?php $date = date_create($row["createdDate"]); 
                                                        echo date_format($date, "F d, Y"); ?></td>
                                                    <td>
                                                        <a class="respond" href="javascript:void(0)" data-id="<?php echo $row['ReklamoID'] ?>" data-user="<?php echo $row['UsersID'] ?>" data-chat="<?php echo $row['chatroomID'] ?>"><i class="fas fa-envelope fa-2x"></i></a>
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
                            <div class="tab-pane fade" id="nav-tocapt" role="tabpanel" aria-labelledby="nav-tocapt-tab">
                                <div class="container fluid">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center text-dark" 
                                            id="dataTable3" width="100%" cellspacing="0" cellpadding="0">
                                            <thead >
                                                <tr class="bg-gradient-secondary text-white">
                                                    <th scope="col">Complainant</th>
                                                    <th>Complainee</th>
                                                    <th scope="col">Reklamo Category</th>
                                                    <th scope="col">Reklamo Type</th>
                                                    <th scope="col">Date Submitted</th>
                                                    <th scope="col">Manage</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <!--Row 1-->
                                                <?php 
                                                    $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                                    as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                                    DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                                    as checkedDate, users.userType, users.profile_pic, users.userAddress, users.userHouseNum, concat(a.Firstname, ' ', a.Lastname) as complainee, a.userType as complaineeType, a.profile_pic as complaineeProfile, chatroom.chatroomID
                                                    FROM ereklamo 
                                                    INNER JOIN users 
                                                    ON ereklamo.UsersID=users.UsersID
                                                    INNER JOIN users a
                                                    ON ereklamo.complainee=a.UsersID
                                                    INNER JOIN chatroom
                                                    ON ereklamo.ReklamoID=chatroom.idreference  
                                                    WHERE ereklamo.complaintLevel='Major' 
                                                    AND ereklamo.status='To Captain'
                                                    AND ereklamo.barangay='{$_SESSION['userBarangay']}' 
                                                    AND ereklamo.purok='{$_SESSION['userPurok']}'");
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
                                                    <td>
                                                        <img class="img-profile rounded-circle <?php 
                                                            if($row["complaineeType"] == "Resident"){
                                                                echo "img-res-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Purok Leader"){
                                                                echo "img-purokldr-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Captain"){
                                                                echo "img-capt-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Secretary"){
                                                                echo "img-sec-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Treasurer"){
                                                                echo "img-treas-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Admin"){
                                                                echo "img-admin-profile";
                                                            }
                                                        ?>" src="img/<?php echo $row["complaineeProfile"] ?>" width="40" height="40"/>
                                                        <br>
                                                        <?php echo $row["complainee"] ?>
                                                    </td>
                                                    <td><?php echo $row["reklamoType"] ?></td>
                                                    <td><?php echo $row["detail"] ?></td>
                                                    <td><?php $date = date_create($row["createdDate"]); 
                                                        echo date_format($date, "F d, Y"); ?></td>
                                                    <td>
                                                        <a class="respond" href="javascript:void(0)" data-id="<?php echo $row['ReklamoID'] ?>" data-user="<?php echo $row['UsersID'] ?>" data-chat="<?php echo $row['chatroomID'] ?>"><i class="fas fa-envelope fa-2x"></i></a>
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
                            <div class="tab-pane fade" id="nav-majorresolved" role="tabpanel" aria-labelledby="nav-majorresolved-tab">
                                <div class="container fluid">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center text-dark" 
                                            id="dataTable4" width="100%" cellspacing="0" cellpadding="0">
                                            <thead >
                                                <tr class="bg-gradient-secondary text-white">
                                                    <th scope="col">Complainant</th>
                                                    <th>Complainee</th>
                                                    <th scope="col">Reklamo Category</th>
                                                    <th scope="col">Reklamo Type</th>
                                                    <th scope="col">Date Submitted</th>
                                                    <th scope="col">Manage</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <!--Row 1-->
                                                <?php 
                                                    $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                                    as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                                    DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                                    as checkedDate, users.userType, users.profile_pic, users.userAddress, users.userHouseNum, concat(a.Firstname, ' ', a.Lastname) as complainee, a.userType as complaineeType, a.profile_pic as complaineeProfile, chatroom.chatroomID
                                                    FROM ereklamo 
                                                    INNER JOIN users 
                                                    ON ereklamo.UsersID=users.UsersID
                                                    INNER JOIN users a
                                                    ON ereklamo.complainee=a.UsersID
                                                    INNER JOIN chatroom
                                                    ON ereklamo.ReklamoID=chatroom.idreference  
                                                    WHERE ereklamo.complaintLevel='Major' 
                                                    AND ereklamo.status='Resolved'
                                                    AND ereklamo.barangay='{$_SESSION['userBarangay']}' 
                                                    AND ereklamo.purok='{$_SESSION['userPurok']}'");
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
                                                    <td>
                                                        <img class="img-profile rounded-circle <?php 
                                                            if($row["complaineeType"] == "Resident"){
                                                                echo "img-res-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Purok Leader"){
                                                                echo "img-purokldr-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Captain"){
                                                                echo "img-capt-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Secretary"){
                                                                echo "img-sec-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Treasurer"){
                                                                echo "img-treas-profile";
                                                            }
                                                            elseif($row["complaineeType"] == "Admin"){
                                                                echo "img-admin-profile";
                                                            }
                                                        ?>" src="img/<?php echo $row["complaineeProfile"] ?>" width="40" height="40"/>
                                                        <br>
                                                        <?php echo $row["complainee"] ?>
                                                    </td>
                                                    <td><?php echo $row["reklamoType"] ?></td>
                                                    <td><?php echo $row["detail"] ?></td>
                                                    <td><?php $date = date_create($row["createdDate"]); 
                                                        echo date_format($date, "F d, Y"); ?></td>
                                                    <td>
                                                        <a class="respond" href="javascript:void(0)" data-id="<?php echo $row['ReklamoID'] ?>" data-user="<?php echo $row['UsersID'] ?>" data-chat="<?php echo $row['chatroomID'] ?>"><i class="fas fa-envelope fa-2x"></i></a>
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
                    <div class="tab-pane fade" id="nav-minor" role="tabpanel" aria-labelledby="nav-minor-tab">
                        <div class="m-4">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-minorpending-tab" data-toggle="tab" href="#nav-minorpending" role="tab" aria-controls="nav-minorpending" aria-selected="true">Pending</a>
                                    <a class="nav-item nav-link" id="nav-ongoing-tab" data-toggle="tab" href="#nav-ongoing" role="tab" aria-controls="nav-ongoing" aria-selected="false">Ongoing</a>
                                    <a class="nav-item nav-link" id="nav-respondentsent-tab" data-toggle="tab" href="#nav-respondentsent" role="tab" aria-controls="nav-respondentsent" aria-selected="false">Respondent Sent</a>
                                    <a class="nav-item nav-link" id="nav-incoming-tab" data-toggle="tab" href="#nav-incoming" role="tab" aria-controls="nav-incoming" aria-selected="false">Incoming</a>
                                    <a class="nav-item nav-link" id="nav-resolved-tab" data-toggle="tab" href="#nav-resolved" role="tab" aria-controls="nav-resolved" aria-selected="false">Resolved</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-minorpending" role="tabpanel" aria-labelledby="nav-minorpending-tab">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center text-dark" 
                                            id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                            <thead >
                                                <tr class="bg-gradient-secondary text-white">
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Reklamo Category</th>
                                                    <th scope="col">Reklamo Type</th>
                                                    <th scope="col">Details</th>
                                                    <th scope="col">Date Submitted</th>
                                                    <th scope="col">Manage</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <!--Row 1-->
                                                <?php 
                                                    $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                                    as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                                    DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                                    as checkedDate, users.userType, users.profile_pic, users.userAddress, users.userHouseNum
                                                    FROM ereklamo 
                                                    INNER JOIN users 
                                                    ON ereklamo.UsersID=users.UsersID 
                                                    WHERE ereklamo.status='Pending'  
                                                    AND ereklamo.complaintLevel='Minor' 
                                                    AND ereklamo.barangay='{$_SESSION['userBarangay']}' 
                                                    AND ereklamo.purok='{$_SESSION['userPurok']}'");
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
                                                    <td><?php echo $row["reklamoType"] ?></td>
                                                    <td><?php echo $row["detail"] ?></td>
                                                    <td><?php if($row["comment"] != "" || $row["comment"] != NULL){ echo $row["comment"]; }else{ echo "No comment given"; } ?></td>
                                                    <td><?php $date = date_create($row["createdDate"]); 
                                                        echo date_format($date, "F d, Y"); ?></td>
                                                    <td>
                                                        <a href="includes/ereklamo.inc.php?accept&reklamoid=<?php echo $row['ReklamoID'] ?>&usersID=<?php echo $row['UsersID'] ?>"><button type="button" class="btn btn-success"><i class="fas fa-check"></i> Accept</button></a>
                                                    </td>
                                                    <!--Right Options-->
                                                </tr>
                                                <?php endwhile; ?>
                                                <!--Row 1-->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-ongoing" role="tabpanel" aria-labelledby="nav-ongoing-tab">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center text-dark" 
                                            id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                                            <thead >
                                                <tr class="bg-gradient-secondary text-white">
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Reklamo Category</th>
                                                    <th scope="col">Reklamo Type</th>
                                                    <th scope="col">Date Submitted</th>
                                                    <th scope="col">Manage</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <!--Row 1-->
                                                <?php 
                                                    $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                                    as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                                    DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                                    as checkedDate, users.userType, users.profile_pic, users.userAddress, users.userHouseNum, chatroom.chatroomID
                                                    FROM ereklamo 
                                                    INNER JOIN users 
                                                    ON ereklamo.UsersID=users.UsersID 
                                                    LEFT JOIN chatroom
                                                    ON ereklamo.ReklamoID=chatroom.idreference
                                                    AND type='ereklamo'
                                                    WHERE ereklamo.status='Ongoing'  
                                                    AND ereklamo.complaintLevel='Minor' 
                                                    AND ereklamo.barangay='{$_SESSION['userBarangay']}' 
                                                    AND ereklamo.purok='{$_SESSION['userPurok']}'");
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
                                                    <td><?php echo $row["reklamoType"] ?></td>
                                                    <td><?php echo $row["detail"] ?></td>
                                                    <td><?php $date = date_create($row["createdDate"]); 
                                                        echo date_format($date, "F d, Y"); ?></td>
                                                    <td>
                                                        <a class="respond" href="javascript:void(0)" data-id="<?php echo $row['ReklamoID'] ?>" data-user="<?php echo $row['UsersID'] ?>" data-chat="<?php echo $row['chatroomID'] ?>"><i class="fas fa-envelope fa-2x"></i></a>
                                                    </td>
                                                    <!--Right Options-->
                                                </tr>
                                                <?php endwhile; ?>
                                                <!--Row 1-->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-respondentsent" role="tabpanel" aria-labelledby="nav-respondentsent-tab">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center text-dark" 
                                            id="dataTable3" width="100%" cellspacing="0" cellpadding="0">
                                            <thead >
                                                <tr class="bg-gradient-secondary text-white">
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Reklamo Category</th>
                                                    <th scope="col">Reklamo Type</th>
                                                    <th scope="col">Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!--Row 1-->
                                                <?php 
                                                    $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                                    as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                                    DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                                    as checkedDate, users.userType, users.profile_pic, users.userAddress, users.userHouseNum, chatroom.chatroomID
                                                    FROM ereklamo 
                                                    INNER JOIN users 
                                                    ON ereklamo.UsersID=users.UsersID 
                                                    LEFT JOIN chatroom
                                                    ON ereklamo.ReklamoID=chatroom.idreference
                                                    AND type='ereklamo'
                                                    WHERE ereklamo.status='Respondents sent'  
                                                    AND ereklamo.complaintLevel='Minor' 
                                                    AND ereklamo.barangay='{$_SESSION['userBarangay']}' 
                                                    AND ereklamo.purok='{$_SESSION['userPurok']}'");
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
                                                    <td><?php echo $row["reklamoType"] ?></td>
                                                    <td><?php echo $row["detail"] ?></td>
                                                    <td>
                                                        <a class="respond" href="javascript:void(0)" data-id="<?php echo $row['ReklamoID'] ?>" data-user="<?php echo $row['UsersID'] ?>" data-chat="<?php echo $row['chatroomID'] ?>"><i class="fas fa-envelope fa-2x"></i></a>
                                                    </td>
                                                </tr>
                                                <?php endwhile; ?>
                                                <!--Row 1-->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-incoming" role="tabpanel" aria-labelledby="nav-incoming-tab">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center text-dark" 
                                            id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                                            <thead >
                                                <tr class="bg-gradient-secondary text-white">
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Reklamo Category</th>
                                                    <th scope="col">Reklamo Type</th>
                                                    <th scope="col">Date Submitted</th>
                                                    <th scope="col">Manage</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <!--Row 1-->
                                                <?php 
                                                    $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                                    as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                                    DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                                    as checkedDate, users.userType, users.profile_pic, users.userAddress, users.userHouseNum, chatroom.chatroomID
                                                    FROM ereklamo 
                                                    INNER JOIN users 
                                                    ON ereklamo.UsersID=users.UsersID 
                                                    LEFT JOIN chatroom
                                                    ON ereklamo.ReklamoID=chatroom.idreference
                                                    AND type='ereklamo'
                                                    WHERE ereklamo.status='Incoming'  
                                                    AND ereklamo.complaintLevel='Minor' 
                                                    AND ereklamo.barangay='{$_SESSION['userBarangay']}' 
                                                    AND ereklamo.purok='{$_SESSION['userPurok']}'");
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
                                                    <td><?php echo $row["reklamoType"] ?></td>
                                                    <td><?php echo $row["detail"] ?></td>
                                                    <td><?php $date = date_create($row["createdDate"]); 
                                                        echo date_format($date, "F d, Y"); ?></td>
                                                    <td>
                                                        <a class="respond" href="javascript:void(0)" data-id="<?php echo $row['ReklamoID'] ?>" data-user="<?php echo $row['UsersID'] ?>" data-chat="<?php echo $row['chatroomID'] ?>"><i class="fas fa-envelope fa-2x"></i></a>
                                                    </td>
                                                    <!--Right Options-->
                                                </tr>
                                                <?php endwhile; ?>
                                                <!--Row 1-->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-resolved" role="tabpanel" aria-labelledby="nav-resolved-tab">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center text-dark" 
                                            id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                                            <thead >
                                                <tr class="bg-gradient-secondary text-white">
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Reklamo Category</th>
                                                    <th scope="col">Reklamo Type</th>
                                                    <th scope="col">Date Submitted</th>
                                                    <th scope="col">Managed By</th>
                                                    <th scope="col">Date Managed</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <!--Row 1-->
                                                <?php 
                                                    $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname) as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                                    as checkedDate, users.userType, users.profile_pic FROM ereklamo INNER JOIN users ON ereklamo.UsersID=users.UsersID WHERE ereklamo.status='Resolved';");
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
                                                    <td><?php echo $row["reklamoType"] ?></td>
                                                    <td><?php echo $row["detail"] ?></td>
                                                    <td><?php echo $row["createdDate"] ?></td>
                                                    <td><?php if($row["checkedBy"] != NULL){echo $row["checkedBy"];} else{echo "None";} ?></td>
                                                    <td><?php if($row["checkedDate"] != NULL){echo $row["checkedDate"];} else{echo "None";} ?></td>
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
                </div>
            </div>
            <!-- End of Card Body-->
        </div>                   
        <!--End of Card--> 
        <?php elseif($_SESSION["userType"] == "Secretary"): ?>
            <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">eReklamo</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="true">For scheduling</a>
                        <a class="nav-item nav-link" id="nav-scheduled-tab" data-toggle="tab" href="#nav-scheduled" role="tab" aria-controls="nav-scheduled" aria-selected="false">Scheduled</a>
                        <a class="nav-item nav-link" id="nav-resolved-tab" data-toggle="tab" href="#nav-resolved" role="tab" aria-controls="nav-resolved" aria-selected="false">Resolved</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-dark" 
                                id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                <thead >
                                    <tr class="bg-gradient-secondary text-white">
                                            <th scope="col">Complainant</th>
                                            <th>Complainee</th>
                                            <th scope="col">Reklamo Type</th>
                                            <th scope="col">Detail</th>
                                            <th scope="col">Manage</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <!--Row 1-->
                                    <?php 
                                        $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                        as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                        DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                        as checkedDate, users.userType, users.profile_pic, users.userAddress, users.userHouseNum, concat(a.Firstname, ' ', a.Lastname) as complainee, a.userType as complaineeType, a.profile_pic as complaineeProfile
                                        FROM ereklamo 
                                        INNER JOIN users 
                                        ON ereklamo.UsersID=users.UsersID
                                        INNER JOIN users a
                                        ON ereklamo.complainee=a.UsersID
                                        WHERE ereklamo.complaintLevel='Major' 
                                        AND (ereklamo.status='To Captain' OR
                                        ereklamo.status='Reschedule')
                                        AND ereklamo.barangay='{$_SESSION['userBarangay']}' 
                                        AND ereklamo.purok='{$_SESSION['userPurok']}'");
                                        while($row=$requests->fetch_assoc()):
                                            if($row["userType"] == "Admin"){
                                                continue;
                                            }
                                    ?>
                                    <tr>
                                        <td>
                                            <img class="img-profile rounded-circle <?php 
                                                if($row["reklamoUser"] == "Resident"){
                                                    echo "img-res-profile";
                                                }
                                                elseif($row["reklamoUser"] == "Purok Leader"){
                                                    echo "img-purokldr-profile";
                                                }
                                                elseif($row["reklamoUser"] == "Captain"){
                                                    echo "img-capt-profile";
                                                }
                                                elseif($row["reklamoUser"] == "Secretary"){
                                                    echo "img-sec-profile";
                                                }
                                                elseif($row["reklamoUser"] == "Treasurer"){
                                                    echo "img-treas-profile";
                                                }
                                                elseif($row["reklamoUser"] == "Admin"){
                                                    echo "img-admin-profile";
                                                }
                                            ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                            <br>
                                            <?php echo $row["name"] ?>
                                        </td>
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
                                            <?php echo $row["complainee"] ?>
                                        </td>
                                        <td><?php echo $row["reklamoType"] ?></td>
                                        <td><?php echo $row["detail"] ?></td>
                                        <td>
                                            <a class="confirm-schedule" href="javascript:void(0)" data-user="<?php echo $row["UsersID"] ?>" data-id="<?php echo $row["ReklamoID"] ?>" ><button type="button" class="btn btn-success" href=""><i class="fas fa-calendar"></i> Set schedule</button></a>
                                        </td>
                                        <!--Right Options-->
                                    </tr>
                                    <?php endwhile; ?>
                                    <!--Row 1-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-scheduled" role="tabpanel" aria-labelledby="nav-scheduled-tab">
                        <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark" 
                                id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                <theads>
                                    <tr class="bg-gradient-secondary text-white">
                                            <th scope="col">Complainant</th>
                                            <th>Complainee</th>
                                            <th scope="col">Reklamo Type</th>
                                            <th scope="col">Detail</th>
                                            <th scope="col">Date Scheduled</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <!--Row 1-->
                                    <?php 
                                        $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                        as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                        DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                        as checkedDate, users.userType, users.profile_pic, users.userAddress, users.userHouseNum, concat(a.Firstname, ' ', a.Lastname) as complainee, a.userType as complaineeType, a.profile_pic as complaineeProfile
                                        FROM ereklamo 
                                        INNER JOIN users 
                                        ON ereklamo.UsersID=users.UsersID
                                        INNER JOIN users a
                                        ON ereklamo.complainee=a.UsersID
                                        WHERE ereklamo.complaintLevel='Major' 
                                        AND ereklamo.status='Scheduled'
                                        AND ereklamo.barangay='{$_SESSION['userBarangay']}' 
                                        AND ereklamo.purok='{$_SESSION['userPurok']}'");
                                        while($row=$requests->fetch_assoc()):
                                            if($row["userType"] == "Admin"){
                                                continue;
                                            }
                                    ?>
                                    <tr>
                                        <td>
                                            <img class="img-profile rounded-circle <?php 
                                                if($row["reklamoUser"] == "Resident"){
                                                    echo "img-res-profile";
                                                }
                                                elseif($row["reklamoUser"] == "Purok Leader"){
                                                    echo "img-purokldr-profile";
                                                }
                                                elseif($row["reklamoUser"] == "Captain"){
                                                    echo "img-capt-profile";
                                                }
                                                elseif($row["reklamoUser"] == "Secretary"){
                                                    echo "img-sec-profile";
                                                }
                                                elseif($row["reklamoUser"] == "Treasurer"){
                                                    echo "img-treas-profile";
                                                }
                                                elseif($row["reklamoUser"] == "Admin"){
                                                    echo "img-admin-profile";
                                                }
                                            ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                            <br>
                                            <?php echo $row["name"] ?>
                                        </td>
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
                                            <?php echo $row["complainee"] ?>
                                        </td>
                                        <td><?php echo $row["reklamoType"] ?></td>
                                        <td><?php echo $row["detail"] ?></td>
                                        <td><?php echo $row["scheduledSummon"]?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                    <!--Row 1-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-resolved" role="tabpanel" aria-labelledby="nav-resolved-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center text-dark" 
                                id="dataTable3" width="100%" cellspacing="0" cellpadding="0">
                                <thead >
                                    <tr class="bg-gradient-secondary text-white">
                                        <th scope="col">Name</th>
                                        <th scope="col">Reklamo Type</th>
                                        <th scope="col">Detail</th>
                                        <th scope="col">Comment</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date Submitted</th>
                                        <th scope="col">Managed By</th>
                                        <th scope="col">Date Managed</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    <!--Row 1-->
                                    <?php 
                                        $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname) as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                        as checkedDate, users.userType, users.profile_pic FROM ereklamo INNER JOIN users ON ereklamo.UsersID=users.UsersID WHERE ereklamo.status='Resolved';");
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
                                        <td><?php echo $row["reklamoType"] ?></td>
                                        <td><?php echo $row["detail"] ?></td>
                                        <td><?php echo $row["comment"] ?></td>
                                        <td><?php if($row["status"] != NULL){echo $row["status"];} else{echo "Pending";} ?></td>
                                        <td><?php echo $row["createdDate"] ?></td>
                                        <td><?php if($row["checkedBy"] != NULL){echo $row["checkedBy"];} else{echo "None";} ?></td>
                                        <td><?php if($row["checkedDate"] != NULL){echo $row["checkedDate"];} else{echo "None";} ?></td>
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

        <?php elseif($_SESSION["userType"] == "Captain"): ?>
            <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">eReklamo</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-ereklamo-tab" data-toggle="tab" href="#nav-ereklamo" role="tab" aria-controls="nav-ereklamo" aria-selected="true">eReklamo</a>
                        <a class="nav-item nav-link" id="nav-scheduled-tab" data-toggle="tab" href="#nav-scheduled" role="tab" aria-controls="nav-scheduled" aria-selected="false">Scheduled</a>
                        <a class="nav-item nav-link" id="nav-resolved-tab" data-toggle="tab" href="#nav-resolved" role="tab" aria-controls="nav-resolved" aria-selected="false">Resolved</a>
                    </div>
                </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-ereklamo" role="tabpanel" aria-labelledby="nav-ereklamo-tab">
                            <div class="row">
                                <div class="col m-4">
                                    <div class="card" style="min-height: 200px">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col">
                                                    <strong>
                                                        Major
                                                    </strong>
                                                </div>
                                                <div class="col-sm-2" style="text-align: right;">
                                                    <a class="add_ereklamoCat" data-priority="Major" href="javascript:void(0)"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="accordion">
                                                <?php $majorSql = $conn->query("SELECT * FROM ereklamocategory WHERE reklamoCatPriority = 'Major'");
                                                $i = 0;
                                                $allRows = $majorSql->num_rows;
                                                while($majorRow = $majorSql->fetch_assoc()):
                                                ?>
                                                <div class="row">
                                                    <div class="col" data-toggle="collapse" data-target="#collapse<?php echo str_replace(' ', '', $majorRow['reklamoCatName']) ?>" aria-expanded="true" aria-controls="collapse<?php echo str_replace(' ', '', $majorRow['reklamoCatName']) ?>">
                                                        <?php echo $majorRow['reklamoCatName'] ?>
                                                    </div>
                                                    <div class="col-sm-3" style="text-align: right;">
                                                        <a class="edit_ereklamoCat" href="javascript:void(0)" data-id="<?php echo $majorRow['reklamoCatID'] ?>" data-name="<?php echo $majorRow['reklamoCatName'] ?>"><i class="fas fa-edit"></i></a>
                                                        <a class="delete_ereklamoCat" href="javascript:void(0)" data-id="<?php echo $majorRow['reklamoCatID'] ?>" data-name="<?php echo $majorRow['reklamoCatName'] ?>"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="card-body">
                                                        <div id="collapse<?php echo str_replace(' ', '', $majorRow['reklamoCatName']) ?>" class="collapse-show" aria-labelledby="heading<?php echo str_replace(' ', '', $majorRow['reklamoCatName']) ?>" data-parent="#accordion">
                                                            <div class="col">
                                                                <?php $minorType = $conn->query("SELECT * FROM ereklamotype WHERE reklamoCatID={$majorRow['reklamoCatID']}");
                                                                while($minorTypeRow = $minorType->fetch_assoc()): 
                                                                ?>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <?php echo $minorTypeRow['reklamoTypeName'] ?>
                                                                    </div>
                                                                    <div class="col-sm-2" style="text-align right;">
                                                                        <a class="edit_type" href="javascript:void(0)" data-id="<?php echo $minorTypeRow['reklamoTypeID'] ?>" data-name="<?php echo $minorTypeRow['reklamoTypeName'] ?>"><i class="fas fa-edit"></i></a>
                                                                        <a class="delete_type" href="javascript:void(0)" data-id="<?php echo $minorTypeRow['reklamoTypeID'] ?>" data-name="<?php echo $minorTypeRow['reklamoTypeName'] ?>"><i class="fas fa-trash"></i></a>
                                                                    </div>
                                                                    <hr>    
                                                                </div>
                                                                <?php endwhile; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endwhile; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col m-4">
                                    <div class="card" style="min-height: 200px">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col">
                                                    <strong>
                                                        Minor
                                                    </strong>
                                                </div>
                                                <div class="col-sm-2" style="text-align: right;">
                                                    <a class="add_ereklamoCat" data-priority="Minor" href="javascript:void(0)"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="accordion">
                                                <?php $minorSql = $conn->query("SELECT * FROM ereklamocategory WHERE reklamoCatPriority = 'Minor'");
                                                $i = 0;
                                                $allRows = $minorSql->num_rows;
                                                while($minorRow = $minorSql->fetch_assoc()):
                                                ?>
                                                <div class="row">
                                                    <div class="col" data-toggle="collapse" data-target="#collapse<?php echo str_replace(' ', '', $minorRow['reklamoCatName']) ?>" aria-expanded="true" aria-controls="collapse<?php echo str_replace(' ', '', $minorRow['reklamoCatName']) ?>">
                                                        <?php echo $minorRow['reklamoCatName'] ?>
                                                    </div>
                                                    <div class="col-sm-3" style="text-align: right;">
                                                        <a class="edit_ereklamoCat" href="javascript:void(0)" data-id="<?php echo $minorRow['reklamoCatID'] ?>" data-name="<?php echo $minorRow['reklamoCatName'] ?>"><i class="fas fa-edit"></i></a>
                                                        <a class="delete_ereklamoCat" href="javascript:void(0)" data-id="<?php echo $minorRow['reklamoCatID'] ?>" data-name="<?php echo $minorRow['reklamoCatName'] ?>"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="card-body">
                                                        <div id="collapse<?php echo str_replace(' ', '', $minorRow['reklamoCatName']) ?>" class="collapse-show" aria-labelledby="heading<?php echo str_replace(' ', '', $minorRow['reklamoCatName']) ?>" data-parent="#accordion">
                                                            <div class="col">
                                                                <?php $minorType = $conn->query("SELECT * FROM ereklamotype WHERE reklamoCatID={$minorRow['reklamoCatID']}");
                                                                while($minorTypeRow = $minorType->fetch_assoc()): 
                                                                ?>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <?php echo $minorTypeRow['reklamoTypeName'] ?>
                                                                    </div>
                                                                    <div class="col-sm-2" style="text-align right;">
                                                                        <a class="edit_type" href="javascript:void(0)" data-id="<?php echo $minorTypeRow['reklamoTypeID'] ?>" data-name="<?php echo $minorTypeRow['reklamoTypeName'] ?>"><i class="fas fa-edit"></i></a>
                                                                        <a class="delete_type" href="javascript:void(0)" data-id="<?php echo $minorTypeRow['reklamoTypeID'] ?>" data-name="<?php echo $minorTypeRow['reklamoTypeName'] ?>"><i class="fas fa-trash"></i></a>
                                                                    </div>
                                                                    <hr>    
                                                                </div>
                                                                <?php endwhile; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endwhile; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-scheduled" role="tabpanel" aria-labelledby="nav-scheduled-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark" 
                                    id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th scope="col">Complainee</th>
                                            <th>Complainant</th>
                                            <th scope="col">Reklamo Type</th>
                                            <th scope="col">Detail</th>
                                            <th scope="col">Date Scheduled</th>
                                            <th>Manage</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                            as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                            DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                            as checkedDate, users.userType, users.profile_pic, users.userAddress, users.userHouseNum, concat(a.Firstname, ' ', a.Lastname) as complainee, a.userType as complaineeType, a.profile_pic as complaineeProfile, chatroom.chatroomID
                                            FROM ereklamo 
                                            INNER JOIN chatroom
                                            ON ereklamo.ReklamoID=chatroom.idreference
                                            INNER JOIN users 
                                            ON ereklamo.UsersID=users.UsersID
                                            INNER JOIN users a
                                            ON ereklamo.complainee=a.UsersID
                                            WHERE ereklamo.complaintLevel='Major' 
                                            AND ereklamo.status='Scheduled'
                                            AND ereklamo.barangay='{$_SESSION['userBarangay']}' 
                                            AND ereklamo.purok='{$_SESSION['userPurok']}'");
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
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["complaineeType"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["complaineeType"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["complaineeType"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["complaineeType"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["complaineeType"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["complaineeType"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/<?php echo $row["complaineeProfile"] ?>" width="40" height="40"/>
                                                <br>
                                                <?php echo $row["complainee"] ?>
                                            </td>
                                            <td><?php echo $row["reklamoType"] ?></td>
                                            <td><?php echo $row["detail"] ?></td>
                                            <td><?php echo $row["scheduledSummon"] ?></td>
                                            <td>
                                                <a class="respond" href="javascript:void(0)" data-id="<?php echo $row['ReklamoID'] ?>" data-user="<?php echo $row['UsersID'] ?>" data-chat="<?php echo $row['chatroomID'] ?>"><i class="fas fa-envelope fa-2x"></i></a>
                                            </td>
                                            <!--Right Options-->
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-resolved" role="tabpanel" aria-labelledby="nav-resolved-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark" 
                                    id="dataTable3" width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th scope="col">Name</th>
                                            <th scope="col">Reklamo Type</th>
                                            <th scope="col">Detail</th>
                                            <th scope="col">Comment</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date Submitted</th>
                                            <th scope="col">Managed By</th>
                                            <th scope="col">Date Managed</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname) as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                            as checkedDate, users.userType, users.profile_pic FROM ereklamo INNER JOIN users ON ereklamo.UsersID=users.UsersID WHERE ereklamo.status='Resolved';");
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
                                            <td><?php echo $row["reklamoType"] ?></td>
                                            <td><?php echo $row["detail"] ?></td>
                                            <td><?php echo $row["comment"] ?></td>
                                            <td><?php if($row["status"] != NULL){echo $row["status"];} else{echo "Pending";} ?></td>
                                            <td><?php echo $row["createdDate"] ?></td>
                                            <td><?php if($row["checkedBy"] != NULL){echo $row["checkedBy"];} else{echo "None";} ?></td>
                                            <td><?php if($row["checkedDate"] != NULL){echo $row["checkedDate"];} else{echo "None";} ?></td>
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
            <!-- End of Card Body-->
        </div>                   
        <!--End of Card--> 

        <?php endif; ?>

                                                                   
</div>
<!-- End of Begin Page Content -->

<script>
    $(".delete_ereklamoCat").on('click', function (e) { e.stopPropagation(); })
    $(".edit_ereklamoCat").on('click', function (e) { e.stopPropagation(); })
    $(".add_ereklamotype").on('click', function (e) { e.stopPropagation(); })

    var problemsByCategory = {
        <?php 
            $puroks = array();
            $barangay = $conn->query("SELECT * FROM ereklamocategory WHERE reklamoCatBrgy='{$_SESSION['userBarangay']}'");
            while($brow = $barangay->fetch_assoc()):
        ?>
            <?php 
            echo json_encode($brow["reklamoCatName"]) ?> : <?php $purok = $conn->query("SELECT * FROM ereklamotype WHERE reklamoCatID='{$brow['reklamoCatID']}'"); 
            while($prow = $purok->fetch_assoc()):
            $puroks[] = $prow["reklamoTypeName"]?>
            <?php endwhile; echo json_encode($puroks). ","; $puroks = array();?>
            <?php endwhile; ?>
    }

    function changecat(value) {
        if (value.length == 0) document.getElementById("specific").innerHTML = "<option></option>";
        else {
            var catOptions = "";
            for (categoryId in problemsByCategory[value]) {
                catOptions += "<option>" + problemsByCategory[value][categoryId] + "</option>";
            }
            document.getElementById("specific").innerHTML = catOptions;
            if(value == "Resident" || value == "Residents"){
                $("#inputArea").append(
                "<label for='resident' id='label'>Resident name: </label><select name='resident'" +
                "id='resident' class='resident-select form-control w-75 form-control-md' required />"+ 
                "<datalist id='Resident'>" + "<option value=''>Select</option>" +
                <?php 
                    $posts = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name 
                    FROM users WHERE userBarangay='{$_SESSION['userBarangay']}' 
                    AND userPurok='{$_SESSION['userPurok']}' 
                    AND userType='Resident'");
                    while($row=$posts->fetch_assoc()):
                        if($row["UsersID"] == $_SESSION["UsersID"]){
                            continue;
                        }
                ?>
                "<option value='<?php echo $row["UsersID"] ?>'><?php echo $row["name"] ?></option>" +
                <?php endwhile; ?>
                "</datalist>"
                );
                $('.resident-select').select2();
                // $("#inputArea").show();
            }
            else{
                // $("#inputArea").hide();
                $('.resident-select').select2('destroy');
                $("#resident").remove();
                $("#label").remove();
                
            }
        }
    }
    $(document).ready(function() {
        $('#dataTable2').DataTable();
    } );
    $(document).ready(function() {
        $('#dataTable3').DataTable();
    } );

    $(document).ready(function() {
        $('.resident-select').select2();
    });
    

    $("#position").change(function () {
    var numInputs = $(this).val();
    if(numInputs == "Purok Leader"){
        $("#inputArea").append(
            '<select name="purokArea" id="purok" class="form-control form-control-sm" />');
    }
    else{
        $("#purok").remove();
    }
    });
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
        $('.comment-textfield').on('change keyup keydown paste cut', function (e) {
            if(this.scrollHeight <= 117)
            $(this).height(0).height(this.scrollHeight);
        })
        $('.set-schedule').click(function(){
            _conf("Change status for reklamo to be scheduled?","set_schedule",[$(this).attr('data-id'), $(this).attr('data-user')])
        })
        $('.respond').click(function(){
            uni_modal("<center><b>Repond to eReklamo</b></center></center>","includes/ereklamo.inc.php?respond&chatroomID="+$(this).attr('data-chat')+"&reklamoid="+$(this).attr('data-id')+"&usersID="+$(this).attr('data-user'), "modal-md")
        })
        $('.confirm-schedule').click(function(){
            uni_modal("<center><b>Schedule a summon</b></center></center>","includes/schedule.inc.php?scheduleSummon="+$(this).attr('data-id')+"&usersID="+$(this).attr('data-user'))
        })
        $('.add_ereklamoCat').click(function(){
            uni_modal("<center><b>Add Reklamo Category</b></center></center>","includes/ereklamo.inc.php?ereklamoAddCat&priority="+$(this).attr('data-priority'))
        })
        $('.edit_ereklamoCat').click(function(){
            uni_modal("<center><b>Edit Reklamo Category</b></center></center>","includes/ereklamo.inc.php?ereklamoEditCat&catID="+ $(this).attr('data-id')+"&catName="+$(this).attr('data-name'))
        })
        $('.delete_ereklamoCat').click(function(){
            _conf("Are you sure you want to delete this reklamo category?", "delete_cat", [$(this).attr('data-id')])
        })
        $('.add_ereklamotype').click(function(){
            uni_modal("<center><b>Add Reklamo Type</b></center></center>","includes/ereklamo.inc.php?ereklamoAddType&catID="+ $(this).attr('data-id')+"&catName="+$(this).attr('data-name'))
        })
        $('.edit_type').click(function(){
            uni_modal("<center><b>Edit Reklamo Type</b></center></center>","includes/ereklamo.inc.php?ereklamoEditType&typeID="+ $(this).attr('data-id'))
        })
        $('.delete_type').click(function(){
            _conf("Are you sure you want to delete this reklamo type?", "delete_type", [$(this).attr('data-id')])
        })

        function delete_cat($id){
            start_load()
            $.ajax({
                url:'includes/ereklamo.inc.php?postCatDelete',
                method:'POST',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }

        function delete_type($id){
            start_load()
            $.ajax({
                url:'includes/ereklamo.inc.php?postTypeDelete',
                method:'POST',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }
        
        $('.content-field').each(function(){
            var dom = $(this)[0]
            var divHeight = dom.offsetHeight
            if(divHeight > 117){
                $(this).addClass('truncate-5')
                $(this).parent().children('.show-content').removeClass('d-none')
            }
        })
        function set_schedule($id, $user){
                start_load()
                $.ajax({
                    url:'includes/ereklamo.inc.php?respondID',
                    method:'POST',
                    data:{id:$id, user:$user},
                    success:function(){
                        location.reload()
                    }
                })
            }
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

        
</script>

<?php include 'footer.php'; ?>