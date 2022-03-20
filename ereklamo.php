<?php include 'header.php'; ?>

<!-- Begin Page Content -->
<div class="col d-flex flex-column px-4">

<!-- Page Heading --> 
<div class="d-sm-flex align-items-center justify-content-between">  
    <h3 class="font-weight-bold text-dark">eReklamo </h3> 
</div>

<!-- Content Row -->
<div class="container p-4">

        <?php if($_SESSION["userType"] === "Resident"): ?>
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
                                <option value="Kuryente">Kuryente</option>
                                <option value="Tubig">Tubig</option>
                                <option value="Kalsada">Kalsada</option>
                                <option value="Resident">Resident</option> 
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
                        <label>Specify your concern.</label>
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
                    <a class="nav-item nav-link active" id="nav-pending-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Pending</a>
                    <a class="nav-item nav-link" id="nav-resolved-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Resolved</a>
                </div>
                </nav>
                    <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th scope="col">Name</th>
                                <th scope="col">Reklamo Type</th>
                                <th scope="col">Detail</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Status</th>
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
                                <td><?php echo $row["comment"] ?></td>
                                <td><?php if($row["status"] != NULL){echo $row["status"];} else{echo "Pending";} ?></td>
                                <td><?php echo $row["createdDate"] ?></td>
                                <!-- <td><a href="includes/ereklamo.inc.php?resolvedID=<?php echo $row["ReklamoID"] ?>&usersID=<?php echo $row['UsersID'] ?>"><i class="fas fa-check fa-2x"></i></a></td> -->
                                <td><a href="includes/sendrespondent.inc.php?reklamoid=<?php echo $row['ReklamoID'] ?>"><button type="button" class="btn btn-success" href=""><i class="fas fa-check"></i> Send Respondents</button></a></td>
                                <!--Right Options-->
                            </tr>
                            <?php endwhile; ?>
                            <!--Row 1-->
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- End of Card Body-->
        </div>                   
        <!--End of Card--> 

        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Resolved</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
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
            <!-- End of Card Body-->
        </div>                   
        <!--End of Card--> 
        <?php elseif($_SESSION["userType"] == "Secretary"): ?>
            <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">eReklamo</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable" width="100%" cellspacing="0" cellpadding="0">
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
                                <th scope="col">Manage</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                as checkedDate, users.userType, users.profile_pic 
                                FROM ereklamo 
                                INNER JOIN users 
                                ON ereklamo.UsersID=users.UsersID 
                                WHERE ereklamo.status='To be scheduled' AND ereklamo.complaintLevel='Major' AND ereklamo.barangay='{$_SESSION['userBarangay']}'");
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
            <!-- End of Card Body-->
        </div>                   
        <!--End of Card--> 

        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Resolved</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
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
            <!-- End of Card Body-->
        </div>                   
        <!--End of Card--> 

        <?php elseif($_SESSION["userType"] == "Captain"): ?>
            <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">eReklamo</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable" width="100%" cellspacing="0" cellpadding="0">
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
                                <th scope="col">Manage</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                as checkedDate, users.userType, users.profile_pic 
                                FROM ereklamo 
                                INNER JOIN users 
                                ON ereklamo.UsersID=users.UsersID 
                                WHERE ereklamo.status='Pending' AND ereklamo.complaintLevel='Major' AND ereklamo.barangay='{$_SESSION['userBarangay']}'");
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
                                <td>
                                    <a class="set-schedule" href="javascript:void(0)" data-user="<?php echo $row["UsersID"] ?>" data-id="<?php echo $row["ReklamoID"] ?>" ><button type="button" class="btn btn-success" href=""><i class="fas fa-calendar"></i> Set for schedule</button></a>
                                    <a href="includes/sendrespondent.inc.php?reklamoid=<?php echo $row['ReklamoID'] ?>"><button type="button" class="btn btn-success" href=""><i class="fas fa-check"></i> Send Tanod</button></a>
                                </td>
                                <!--Right Options-->
                            </tr>
                            <?php endwhile; ?>
                            <!--Row 1-->
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- End of Card Body-->
        </div>                   
        <!--End of Card--> 

        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Resolved</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
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
            <!-- End of Card Body-->
        </div>       
        <?php endif; ?>

                                                                   
</div>
<!-- End of Begin Page Content -->

<script>
    var problemsByCategory = {
        Kuryente: ["No electricity in the area", "Power outtages", "Others"],
        Tubig: ["No water in the area", "Leakage", "Others"],
        Kalsada: ["No roads in the area", "Broken roads", "Others"],
        Resident: ["Noise", "Disregard of trashes", "Abusive", "Others"]
    }

    function changecat(value) {
        if (value.length == 0) document.getElementById("specific").innerHTML = "<option></option>";
        else {
            var catOptions = "";
            for (categoryId in problemsByCategory[value]) {
                catOptions += "<option>" + problemsByCategory[value][categoryId] + "</option>";
            }
            document.getElementById("specific").innerHTML = catOptions;
            if(value == "Resident"){
                $("#inputArea").append(
                "<label for='resident' id='label'>Resident name: </label><select name='resident'" +
                "id='resident' class='form-control w-75 form-control-md' required />"+ 
                "<datalist id='Resident'>" + "<option value=''>Select</option>" +
                <?php 
                    $posts = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users WHERE userBarangay='{$_SESSION['userBarangay']}' AND userPurok='{$_SESSION['userPurok']}'");
                    while($row=$posts->fetch_assoc()):
                        if($row["UsersID"] == $_SESSION["UsersID"]){
                            continue;
                        }
                ?>
                "<option value='<?php echo $row["UsersID"] ?>'><?php echo $row["name"] ?></option>" +
                <?php endwhile; ?>
                "</datalist>"
                );
            }
            else{
                $("#resident").remove();
                $("#label").remove();
            }
        }
    }
    $(document).ready(function() {
        $('#dataTable2').DataTable();
    } );

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
        $('.confirm-schedule').click(function(){
            uni_modal("<center><b>Schedule a summon</b></center></center>","includes/schedule.inc.php?scheduleSummon="+$(this).attr('data-id')+"&usersID="+$(this).attr('data-user'))
        })
        $('#confirm-schedule').click(function(){
            uni_modal("<center><b>Schedule a summon</b></center></center>","includes/create_post.inc.php?id="+$(this).attr('data-id'))
        })
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

        $(document).ready(function() {
        $('#dataTable').DataTable();
        } );
        
        $(document).ready(function() {
            $('#dataTable2').DataTable();
        } );
</script>

<?php include 'footer.php'; ?>