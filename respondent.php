<?php include 'header.php'; ?>

<!-- Begin Page Content -->
<div class="col d-flex flex-column px-4">

<!-- Page Heading --> 
<div class="d-sm-flex align-items-center justify-content-between">  
    <h3 class="font-weight-bold text-dark">Respondent </h3> 
</div>

<!-- Content Row -->
<div class="container p-4">
    <?php if($_SESSION["barangayPos"] != "None"): ?>
        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Respondent</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th>eReklamo ID</th>
                                <th>Name</th>
                                <th>Reklamo Type</th>
                                <th>Details</th>
                                <th>Street Address</th>
                                <th>House Number</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                <td><?php echo $row["ReklamoID"] ?></td>
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
                                <td><?php echo $row["userAddress"] ?></td>
                                <td><?php echo $row["userHouseNum"] ?></td>
                                <td><?php if($row["status"] != NULL){echo $row["status"];} else{echo "Pending";} ?></td>
                                <!-- <td><a href="includes/ereklamo.inc.php?resolvedID=<?php echo $row["ReklamoID"] ?>&usersID=<?php echo $row['UsersID'] ?>"><i class="fas fa-check fa-2x"></i></a></td> -->
                                <td><a href="includes/sendrespondent.inc.php?respond=<?php echo $row['ReklamoID'] ?>"><button type="button" class="btn btn-success" href=""><i class="fas fa-check"></i> Respond to eReklamo</button></a></td>
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
    <?php endif; ?>