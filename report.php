<?php include_once 'header.php' ?>
<?php if($_SESSION['userType'] == 'Captain'): ?>
    
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col">
                                Minimum date:
                            </div>
                            <div class="col">
                                <input type="text" class="min" id="min" name="min">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">Maximum date:</div>
                            <div class="col"><input type="text" class="max" id="max" name="max"></div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">Document</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="true">Payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="residents-tab" data-toggle="tab" href="#residents" role="tab" aria-controls="residents" aria-selected="true">Residents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="voting-tab" data-toggle="tab" href="#voting" role="tab" aria-controls="voting" aria-selected="true">Voting</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">
                            <a target="_blank" href="pdf.php?reportType=ereklamoReport">
                                <div class="d-flex flex-row-reverse">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" width="100%" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr class="bg-gradient-secondary text-white">
                                            <th>Complainee Name</th>
                                            <th>Responder Name</th>
                                            <th scope="col">Complaint</th>
                                            <th>Specific</th>
                                            <th>Details</th>
                                            <th>Date of Complaint</th>
                                            <th>Date Resolved</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $accounts = $conn->query("SELECT ereklamoreport.*, ereklamo.*, concat(responder.Firstname, ' ', responder.Lastname) as respondername, responder.profile_pic as responderprofile, responder.userType as respondertype, concat(complainee.Firstname, ' ', complainee.Lastname) as complaineename, complainee.profile_pic as complaineeprofile, complainee.userType as complaineetype, chatroom.chatroomID 
                                            FROM ereklamoreport 
                                            INNER JOIN ereklamo on ereklamo.ReklamoID=ereklamoreport.ReklamoID 
                                            INNER JOIN users responder ON responder.UsersID=ereklamoreport.respondentID 
                                            INNER JOIN users complainee ON complainee.UsersID=ereklamo.complainee 
                                            INNER JOIN chatroom ON ereklamo.ReklamoID=chatroom.idreference AND type='ereklamo' 
                                            WHERE ereklamo.barangay='Paknaan' AND ereklamoreport.reportStatus='Resolved' 
                                            ORDER BY date DESC");
                                            while($row=$accounts->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["complaineetype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['complainee'] ?>/profile_pic/<?php echo $row["complaineeprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['complainee'] ?>"><?php echo $row["complaineename"] ?></a> 
                                            </td>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["respondertype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['respondentID'] ?>/profile_pic/<?php echo $row["responderprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['respondentID'] ?>"><?php echo $row["respondername"] ?></a> 
                                            </td>
                                            <td><?php echo $row["reklamoType"] ?></td>
                                            <td><?php echo $row["detail"] ?></td>
                                            <td><button class="respond btn btn-sm btn-primary" data-id="<?php echo $row['ReklamoID'] ?>" data-user="<?php echo $row['UsersID'] ?>" data-chat="<?php echo $row['chatroomID'] ?>">View</button></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['CreatedOn'])) ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['date'])) ?></td>
                                            
                                            <!--Right Options-->
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">
                            <a target="_blank" href="pdf.php?reportType=requestReport">
                                <div class="d-flex flex-row-reverse">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" 
                                    width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th>Resident Name</th>
                                            <th>Officer Name</th>
                                            <th>Document Name</th>
                                            <th>Purpose</th>
                                            <th>Status Report</th>
                                            <th>Report Message</th>
                                            <th>Requirements Submitted</th>
                                            <th>Date Requested</th>
                                            <th>Date Reported</th>
                                            <!-- <th scope="col">Content</th>
                                            <th scope="col">Users</th>
                                            <th>Status reported</th>
                                            <th scope="col">Date</th> -->
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $accounts = $conn->query("SELECT request.*, requestreport.*, concat(officer.Firstname, ' ', officer.Lastname) as officername, officer.UsersID as officerid, officer.userType as officertype, officer.profile_pic as officerprofile, concat(user.Firstname, ' ', user.Lastname) as requestername, user.UsersID as requesterid, user.userType as requestertype, user.profile_pic as requesterprofile FROM requestreport
                                            INNER JOIN request ON requestreport.RequestID=request.RequestID 
                                            INNER JOIN users officer ON officer.UsersID=requestreport.officerID 
                                            INNER JOIN users user ON user.UsersID=request.UsersID WHERE reportStatus!='Paid'
                                            ORDER BY date DESC");
                                            while($row=$accounts->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["requestertype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['requesterid'] ?>/profile_pic/<?php echo $row["requesterprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['requesterid'] ?>"><?php echo $row["requestername"] ?></a> 
                                            </td>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["officertype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["officertype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["officertype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["officertype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["officertype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["officertype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["officertype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['officerid'] ?>/profile_pic/<?php echo $row["officerprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['officerid'] ?>"><?php echo $row["officername"] ?></a> 
                                            </td>
                                            <td><?php echo $row['documentType'] ?></td>
                                            <td><?php echo $row['purpose'] ?></td>
                                            <td><?php echo $row['reportStatus'] ?></td>
                                            <td><?php echo $row['reportMessage'] ?></td>
                                            <td><?php if(is_dir("img/erequest/".$row['RequestID'])): ?>
                                                <button class="btn btn-primary viewRequirement" data-id="<?php echo $row['RequestID'] ?>"><i class="fas fa-eye"></i> View</button>
                                            <?php else: ?>
                                                None
                                            <?php endif; ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['requestedOn'])) ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['date'])) ?></td>
                                            <!--Right Options-->
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <a target="_blank" href="pdf.php?reportType=paymentReport">
                                <div class="d-flex flex-row-reverse">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" 
                                    width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th>Resident Name</th>
                                            <th>Officer Name</th>
                                            <th>Document Name</th>
                                            <th>Purpose</th>
                                            <th>Fee</th>
                                            <th>Status Report</th>
                                            <th>Report Message</th>
                                            <th>Requirements Submitted</th>
                                            <th>Date Requested</th>
                                            <th>Date Reported</th>
                                            <!-- <th scope="col">Content</th>
                                            <th scope="col">Users</th>
                                            <th>Status reported</th>
                                            <th scope="col">Date</th> -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">Total amount: </th>
                                            <th colspan="6">Fee</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $accounts = $conn->query("SELECT request.*, requestreport.*, concat(officer.Firstname, ' ', officer.Lastname) as officername, officer.UsersID as officerid, officer.userType as officertype, officer.profile_pic as officerprofile, concat(user.Firstname, ' ', user.Lastname) as requestername, user.UsersID as requesterid, user.userType as requestertype, user.profile_pic as requesterprofile FROM requestreport
                                            INNER JOIN request ON requestreport.RequestID=request.RequestID 
                                            INNER JOIN users officer ON officer.UsersID=requestreport.officerID 
                                            INNER JOIN users user ON user.UsersID=request.UsersID WHERE reportStatus='Paid'
                                            ORDER BY date DESC");
                                            while($row=$accounts->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["requestertype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['requesterid'] ?>/profile_pic/<?php echo $row["requesterprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['requesterid'] ?>"><?php echo $row["requestername"] ?></a> 
                                            </td>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["officertype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["officertype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["officertype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["officertype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["officertype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["officertype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["officertype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['officerid'] ?>/profile_pic/<?php echo $row["officerprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['officerid'] ?>"><?php echo $row["officername"] ?></a> 
                                            </td>
                                            <td><?php echo $row['documentType'] ?></td>
                                            <td><?php echo $row['purpose'] ?></td>
                                            <td><?php echo $row['amount'] ?></td>
                                            <td><?php echo $row['reportStatus'] ?></td>
                                            <td><?php echo $row['reportMessage'] ?></td>
                                            <td><?php if(is_dir("img/erequest/".$row['RequestID'])): ?>
                                                <button class="btn btn-primary viewRequirement" data-id="<?php echo $row['RequestID'] ?>"><i class="fas fa-eye"></i> View</button>
                                            <?php else: ?>
                                                None
                                            <?php endif; ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['requestedOn'])) ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['date'])) ?></td>
                                            <!--Right Options-->
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="residents" role="tabpanel" aria-labelledby="residents-tab">
                            <a target="_blank" href="pdf.php?reportType=userReport">
                                <div class="d-flex flex-row-reverse">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" 
                                    width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th>Resident Status</th>
                                            <th scope="col">Content</th>
                                            <th scope="col">Account ID</th>
                                            <th>Officer ID</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $accounts = $conn->query("SELECT userreport.*, 
                                            concat(resident.Firstname, ' ', resident.Lastname) as residentName, 
                                            resident.userType as residentUserType, 
                                            resident.profile_pic as residentprofile, 
                                            resident.UsersID as residentUsersID, 
                                            concat(officer.Firstname, ' ', officer.Lastname) as officerName, 
                                            officer.userType as officerUserType, 
                                            officer.profile_pic as officerprofile,
                                            officer.UsersID as officerUsersID
                                            FROM userreport 
                                            INNER JOIN users resident ON resident.UsersID=userreport.UsersID 
                                            INNER JOIN users officer ON officer.UsersID=userreport.OfficerID 
                                            WHERE barangay='{$_SESSION['userBarangay']}' AND purok='{$_SESSION['userPurok']}' 
                                            ORDER BY date DESC");
                                            while($row=$accounts->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td><?php echo $row["reportStatus"] ?></td>
                                            <td><?php echo $row["reportMessage"] ?></td>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["residentUserType"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["residentUserType"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["residentUserType"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["residentUserType"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["residentUserType"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["residentUserType"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["residentUserType"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['UsersID'] ?>/profile_pic/<?php echo $row["residentprofile"] ?>"  width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['residentUsersID'] ?>"><?php echo $row["residentName"] ?></a> 
                                            </td>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["officerUserType"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["officerUserType"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["officerUserType"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["officerUserType"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["officerUserType"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["officerUserType"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["officerUserType"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['officerUsersID'] ?>/profile_pic/<?php echo $row["officerprofile"] ?>"  width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['officerUsersID'] ?>"><?php echo $row["officerName"] ?></a> 
                                            </td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['date'])) ?></td>
                                            <!--Right Options-->
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="voting" role="tabpanel" aria-labelledby="voting-tab">
                            <a target="_blank" href="pdf.php?reportType=electionReport">
                                <div class="d-flex flex-row-reverse">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" 
                                width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th scope="col">Election Title</th>
                                            <th scope="col">Purok</th>
                                            <th scope="col">Date Created</th>
                                            <th scope="col">Winner</th>
                                            <th scope="col">Candidates</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $election = $conn->query("SELECT election.purok, election.electionTitle, election.created_at, election.electionStatus, results.electionID, results.UsersID, concat(users.Firstname, ' ', users.Lastname) as winnerName, candidateID, MAX(voteResults), position 
                                            FROM (SELECT candidates.UsersID, votes.candidateID, COUNT(votes.candidateID) as voteResults, votes.position, votes.electionID
                                            FROM votes INNER JOIN candidates ON candidates.candidateID = votes.candidateID
                                            GROUP BY candidateID) as results
                                            INNER JOIN election ON results.electionID=election.electionID
                                            INNER JOIN users ON results.UsersID=users.UsersID
                                            WHERE electionStatus='Finished'
                                            GROUP BY position;");
                                            while($row=$election->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td><?php echo $row["electionTitle"] ?></td>
                                            <td><?php echo $row["purok"] ?></td>
                                            <td><?php echo date("M d,Y", strtotime($row['created_at'])); ?></td>
                                            <td>
                                                <b><?php echo $row['winnerName'] ?></b>
                                            </td>
                                            <td><button class="btn btn-primary btn-sm view_candidate btn-flat" data-electionid="<?php echo $row["electionID"] ?>" data-id="<?php echo $row['purok'] ?>"><i class="fas fa-user"></i> Candidates</button></td>
                                            
                                            
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
    <script>
        $('.print').click(function(){
            uni_modal("<center><b>Results</b></center></center>", "includes/print.inc.php", "modal-lg")
        })
        $('.results_election').click(function(){
            uni_modal("<center><b>Results</b></center></center>","includes/addElection.inc.php?result="+$(this).attr('data-id'))
        })
        
        $(document).ready(function() {
            var minDate, maxDate;
            jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
                return this.flatten().reduce( function ( a, b ) {
                    if ( typeof a === 'string' ) {
                        a = a.replace(/[^\d.-]/g, '') * 1;
                    }
                    if ( typeof b === 'string' ) {
                        b = b.replace(/[^\d.-]/g, '') * 1;
                    }
            
                    return a + b;
                }, 0 );
            } );
            $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                    var min = minDate.val();
                    var max = maxDate.val();
                    var date = new Date( data[3] );
            
                    if (
                        ( min === null && max === null ) ||
                        ( min === null && date <= max ) ||
                        ( min <= date   && max === null ) ||
                        ( min <= date   && date <= max )
                    ) {
                        return true;
                    }
                    return false;
                }
            );

            // Create date inputs
            minDate = new DateTime($('.min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('.max'), {
                format: 'MMMM Do YYYY'
            });

            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            var table = $('table.display').DataTable({
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                order: [],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };
        
                    // Total over all pages
                    total = api
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Total over this page
                    pageTotal = api
                        .column(4, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                    $(api.column(4).footer()).html('P' + pageTotal + ' ( P' + total + ' total)');
                },
            });
            // Refilter the table
            $('.min, .max').on('change', function () {
                table.draw();
            });
        });
    </script>
    
<?php elseif($_SESSION['userType'] == 'Purok Leader'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" width="100%" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr class="bg-gradient-secondary text-white">
                                            <th>Complainee Name</th>
                                            <th>Responder Name</th>
                                            <th scope="col">Complaint</th>
                                            <th>Specific</th>
                                            <th>Details</th>
                                            <th>Date of Complaint</th>
                                            <th>Date Resolved</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $accounts = $conn->query("SELECT ereklamoreport.*, ereklamo.*, concat(responder.Firstname, ' ', responder.Lastname) as respondername, responder.profile_pic as responderprofile, responder.userType as respondertype, concat(complainee.Firstname, ' ', complainee.Lastname) as complaineename, complainee.profile_pic as complaineeprofile, complainee.userType as complaineetype, chatroom.chatroomID 
                                            FROM ereklamoreport 
                                            INNER JOIN ereklamo on ereklamo.ReklamoID=ereklamoreport.ReklamoID 
                                            INNER JOIN users responder ON responder.UsersID=ereklamoreport.respondentID 
                                            INNER JOIN users complainee ON complainee.UsersID=ereklamo.complainee 
                                            INNER JOIN chatroom ON ereklamo.ReklamoID=chatroom.idreference AND type='ereklamo' 
                                            WHERE ereklamo.barangay='Paknaan' AND ereklamoreport.reportStatus='Resolved' 
                                            ORDER BY date DESC");
                                            while($row=$accounts->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["complaineetype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['complainee'] ?>/profile_pic/<?php echo $row["complaineeprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['complainee'] ?>"><?php echo $row["complaineename"] ?></a> 
                                            </td>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["respondertype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['respondentID'] ?>/profile_pic/<?php echo $row["responderprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['respondentID'] ?>"><?php echo $row["respondername"] ?></a> 
                                            </td>
                                            <td><?php echo $row["reklamoType"] ?></td>
                                            <td><?php echo $row["detail"] ?></td>
                                            <td><button class="respond btn btn-sm btn-primary" data-id="<?php echo $row['ReklamoID'] ?>" data-user="<?php echo $row['UsersID'] ?>" data-chat="<?php echo $row['chatroomID'] ?>">View</button></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['CreatedOn'])) ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['date'])) ?></td>
                                            
                                            <!--Right Options-->
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" 
                                    width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th>Resident Name</th>
                                            <th>Officer Name</th>
                                            <th>Document Name</th>
                                            <th>Purpose</th>
                                            <th>Fee</th>
                                            <th>Status Report</th>
                                            <th>Report Message</th>
                                            <th>Requirements Submitted</th>
                                            <th>Date Requested</th>
                                            <th>Date Reported</th>
                                            <!-- <th scope="col">Content</th>
                                            <th scope="col">Users</th>
                                            <th>Status reported</th>
                                            <th scope="col">Date</th> -->
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $accounts = $conn->query("SELECT request.*, requestreport.*, concat(officer.Firstname, ' ', officer.Lastname) as officername, officer.UsersID as officerid, officer.userType as officertype, officer.profile_pic as officerprofile, concat(user.Firstname, ' ', user.Lastname) as requestername, user.UsersID as requesterid, user.userType as requestertype, user.profile_pic as requesterprofile FROM requestreport
                                            INNER JOIN request ON requestreport.RequestID=request.RequestID 
                                            INNER JOIN users officer ON officer.UsersID=requestreport.officerID 
                                            INNER JOIN users user ON user.UsersID=request.UsersID
                                            ORDER BY date DESC");
                                            while($row=$accounts->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["requestertype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['requesterid'] ?>/profile_pic/<?php echo $row["requesterprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['requesterid'] ?>"><?php echo $row["requestername"] ?></a> 
                                            </td>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["officertype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["officertype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["officertype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["officertype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["officertype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["officertype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["officertype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['officerid'] ?>/profile_pic/<?php echo $row["officerprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['officerid'] ?>"><?php echo $row["officername"] ?></a> 
                                            </td>
                                            <td><?php echo $row['documentType'] ?></td>
                                            <td><?php echo $row['purpose'] ?></td>
                                            <td><?php echo $row['amount'] ?></td>
                                            <td><?php echo $row['reportStatus'] ?></td>
                                            <td><?php echo $row['reportMessage'] ?></td>
                                            <td><?php if(is_dir("img/erequest/".$row['RequestID'])): ?>
                                                <button class="btn btn-primary viewRequirement" data-id="<?php echo $row['RequestID'] ?>"><i class="fas fa-eye"></i> View</button>
                                            <?php else: ?>
                                                None
                                            <?php endif; ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['requestedOn'])) ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['date'])) ?></td>
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
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
            $('.respond').click(function(){
                uni_modal("<center><b>eReklamo details</b></center></center>","includes/ereklamo.inc.php?respond&chatroomID="+$(this).attr('data-chat')+"&reklamoid="+$(this).attr('data-id')+"&usersID="+$(this).attr('data-user'), "modal-lg")
            })
            $('.viewRequirement').click(function(){
                uni_modal("Requirements given","includes/request.inc.php?viewRequirement&RequestID="+$(this).attr('data-id'), "modal-lg");
            })
        });
    </script>
<?php elseif($_SESSION['userType'] == 'Secretary'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">
                            <a target="_blank" href="pdf.php?reportType=ereklamoReport">
                                <div class="d-flex flex-row-reverse">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" width="100%" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr class="bg-gradient-secondary text-white">
                                            <th>Complainee Name</th>
                                            <th>Responder Name</th>
                                            <th scope="col">Complaint</th>
                                            <th>Specific</th>
                                            <th>Details</th>
                                            <th>Date of Complaint</th>
                                            <th>Date Resolved</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $accounts = $conn->query("SELECT ereklamoreport.*, ereklamo.*, concat(responder.Firstname, ' ', responder.Lastname) as respondername, responder.profile_pic as responderprofile, responder.userType as respondertype, concat(complainee.Firstname, ' ', complainee.Lastname) as complaineename, complainee.profile_pic as complaineeprofile, complainee.userType as complaineetype, chatroom.chatroomID 
                                            FROM ereklamoreport 
                                            INNER JOIN ereklamo on ereklamo.ReklamoID=ereklamoreport.ReklamoID 
                                            INNER JOIN users responder ON responder.UsersID=ereklamoreport.respondentID 
                                            INNER JOIN users complainee ON complainee.UsersID=ereklamo.complainee 
                                            INNER JOIN chatroom ON ereklamo.ReklamoID=chatroom.idreference AND type='ereklamo' 
                                            WHERE ereklamo.barangay='Paknaan' AND ereklamoreport.reportStatus='Resolved' 
                                            ORDER BY date DESC");
                                            while($row=$accounts->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["complaineetype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["complaineetype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['complainee'] ?>/profile_pic/<?php echo $row["complaineeprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['complainee'] ?>"><?php echo $row["complaineename"] ?></a> 
                                            </td>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["respondertype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["respondertype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['respondentID'] ?>/profile_pic/<?php echo $row["responderprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['respondentID'] ?>"><?php echo $row["respondername"] ?></a> 
                                            </td>
                                            <td><?php echo $row["reklamoType"] ?></td>
                                            <td><?php echo $row["detail"] ?></td>
                                            <td><button class="respond btn btn-sm btn-primary" data-id="<?php echo $row['ReklamoID'] ?>" data-user="<?php echo $row['UsersID'] ?>" data-chat="<?php echo $row['chatroomID'] ?>">View</button></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['CreatedOn'])) ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['date'])) ?></td>
                                            
                                            <!--Right Options-->
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">
                            <a target="_blank" href="pdf.php?reportType=requestReport">
                                <div class="d-flex flex-row-reverse">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </a>
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" 
                                    width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th>Resident Name</th>
                                            <th>Officer Name</th>
                                            <th>Document Name</th>
                                            <th>Purpose</th>
                                            <th>Status Report</th>
                                            <th>Report Message</th>
                                            <th>Requirements Submitted</th>
                                            <th>Date Requested</th>
                                            <th>Date Reported</th>
                                            <!-- <th scope="col">Content</th>
                                            <th scope="col">Users</th>
                                            <th>Status reported</th>
                                            <th scope="col">Date</th> -->
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $accounts = $conn->query("SELECT request.*, requestreport.*, concat(officer.Firstname, ' ', officer.Lastname) as officername, officer.UsersID as officerid, officer.userType as officertype, officer.profile_pic as officerprofile, concat(user.Firstname, ' ', user.Lastname) as requestername, user.UsersID as requesterid, user.userType as requestertype, user.profile_pic as requesterprofile FROM requestreport
                                            INNER JOIN request ON requestreport.RequestID=request.RequestID 
                                            INNER JOIN users officer ON officer.UsersID=requestreport.officerID 
                                            INNER JOIN users user ON user.UsersID=request.UsersID WHERE reportStatus!='Paid'
                                            ORDER BY date DESC");
                                            while($row=$accounts->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["requestertype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["requestertype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['requesterid'] ?>/profile_pic/<?php echo $row["requesterprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['requesterid'] ?>"><?php echo $row["requestername"] ?></a> 
                                            </td>
                                            <td>
                                                <img class="img-profile rounded-circle <?php 
                                                    if($row["officertype"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($row["officertype"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($row["officertype"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($row["officertype"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($row["officertype"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($row["officertype"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["officertype"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/users/<?php echo $row['officerid'] ?>/profile_pic/<?php echo $row["officerprofile"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['officerid'] ?>"><?php echo $row["officername"] ?></a> 
                                            </td>
                                            <td><?php echo $row['documentType'] ?></td>
                                            <td><?php echo $row['purpose'] ?></td>
                                            <td><?php echo $row['reportStatus'] ?></td>
                                            <td><?php echo $row['reportMessage'] ?></td>
                                            <td><?php if(is_dir("img/erequest/".$row['RequestID'])): ?>
                                                <button class="btn btn-primary viewRequirement" data-id="<?php echo $row['RequestID'] ?>"><i class="fas fa-eye"></i> View</button>
                                            <?php else: ?>
                                                None
                                            <?php endif; ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['requestedOn'])) ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['date'])) ?></td>
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
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
<?php elseif($_SESSION['userType'] == 'Treasurer'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request-tab">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center text-dark display" 
                                        width="100%" cellspacing="0" cellpadding="0">
                                        <thead >
                                            <tr class="bg-gradient-secondary text-white">
                                                <th>Resident Name</th>
                                                <th>Officer Name</th>
                                                <th>Document Name</th>
                                                <th>Purpose</th>
                                                <th>Fee</th>
                                                <th>Status Report</th>
                                                <th>Report Message</th>
                                                <th>Requirements Submitted</th>
                                                <th>Date Requested</th>
                                                <th>Date Reported</th>
                                                <!-- <th scope="col">Content</th>
                                                <th scope="col">Users</th>
                                                <th>Status reported</th>
                                                <th scope="col">Date</th> -->
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <!--Row 1-->
                                            <?php 
                                                $accounts = $conn->query("SELECT request.*, requestreport.*, concat(officer.Firstname, ' ', officer.Lastname) as officername, officer.UsersID as officerid, officer.userType as officertype, officer.profile_pic as officerprofile, concat(user.Firstname, ' ', user.Lastname) as requestername, user.UsersID as requesterid, user.userType as requestertype, user.profile_pic as requesterprofile FROM requestreport
                                                INNER JOIN request ON requestreport.RequestID=request.RequestID 
                                                INNER JOIN users officer ON officer.UsersID=requestreport.officerID 
                                                INNER JOIN users user ON user.UsersID=request.UsersID WHERE reportStatus='Paid'
                                                ORDER BY date DESC");
                                                while($row=$accounts->fetch_assoc()):
                                            ?>
                                            <tr>
                                                <td>
                                                    <img class="img-profile rounded-circle <?php 
                                                        if($row["requestertype"] == "Resident"){
                                                            echo "img-res-profile";
                                                        }
                                                        elseif($row["requestertype"] == "Purok Leader"){
                                                            echo "img-purokldr-profile";
                                                        }
                                                        elseif($row["requestertype"] == "Captain"){
                                                            echo "img-capt-profile";
                                                        }
                                                        elseif($row["requestertype"] == "Secretary"){
                                                            echo "img-sec-profile";
                                                        }
                                                        elseif($row["requestertype"] == "Treasurer"){
                                                            echo "img-treas-profile";
                                                        }
                                                        elseif($row["requestertype"] == "Councilor"){
                                                            echo "img-councilor-profile";
                                                        }
                                                        elseif($row["requestertype"] == "Admin"){
                                                            echo "img-admin-profile";
                                                        }
                                                    ?>" src="img/users/<?php echo $row['requesterid'] ?>/profile_pic/<?php echo $row["requesterprofile"] ?>" width="40" height="40"/>
                                                    </br>
                                                    <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['requesterid'] ?>"><?php echo $row["requestername"] ?></a> 
                                                </td>
                                                <td>
                                                    <img class="img-profile rounded-circle <?php 
                                                        if($row["officertype"] == "Resident"){
                                                            echo "img-res-profile";
                                                        }
                                                        elseif($row["officertype"] == "Purok Leader"){
                                                            echo "img-purokldr-profile";
                                                        }
                                                        elseif($row["officertype"] == "Captain"){
                                                            echo "img-capt-profile";
                                                        }
                                                        elseif($row["officertype"] == "Secretary"){
                                                            echo "img-sec-profile";
                                                        }
                                                        elseif($row["officertype"] == "Treasurer"){
                                                            echo "img-treas-profile";
                                                        }
                                                        elseif($row["officertype"] == "Councilor"){
                                                            echo "img-councilor-profile";
                                                        }
                                                        elseif($row["officertype"] == "Admin"){
                                                            echo "img-admin-profile";
                                                        }
                                                    ?>" src="img/users/<?php echo $row['officerid'] ?>/profile_pic/<?php echo $row["officerprofile"] ?>" width="40" height="40"/>
                                                    </br>
                                                    <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['officerid'] ?>"><?php echo $row["officername"] ?></a> 
                                                </td>
                                                <td><?php echo $row['documentType'] ?></td>
                                                <td><?php echo $row['purpose'] ?></td>
                                                <td><?php echo $row['amount'] ?></td>
                                                <td><?php echo $row['reportStatus'] ?></td>
                                                <td><?php echo $row['reportMessage'] ?></td>
                                                <td><?php if(is_dir("img/erequest/".$row['RequestID'])): ?>
                                                    <button class="btn btn-primary viewRequirement" data-id="<?php echo $row['RequestID'] ?>"><i class="fas fa-eye"></i> View</button>
                                                <?php else: ?>
                                                    None
                                                <?php endif; ?></td>
                                                <td><?php echo date("M d,Y h:i A",strtotime($row['requestedOn'])) ?></td>
                                                <td><?php echo date("M d,Y h:i A",strtotime($row['date'])) ?></td>
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
                <!-- End of Card Body-->
            </div>                   
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
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
<?php elseif($_SESSION['userType'] == 'Councilor'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">

                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark display" 
                            width="100%" cellspacing="0" cellpadding="0">
                            <thead >
                                <tr class="bg-gradient-secondary text-white">
                                    <th scope="col">Report Message</th>
                                    <th>Details</th>
                                    <th scope="col">Responder Name</th>
                                    <th scope="col">Date</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <!--Row 1-->
                                <?php 
                                    $accounts = $conn->query("SELECT ereklamoreport.*, ereklamo.*, concat(users.Firstname, ' ', users.Lastname) as name, users.profile_pic, users.userType, chatroom.chatroomID FROM ereklamoreport INNER JOIN ereklamo on ereklamo.ReklamoID=ereklamoreport.ReklamoID INNER JOIN users ON users.UsersID=ereklamoreport.respondentID INNER JOIN chatroom ON ereklamo.ReklamoID=chatroom.idreference AND type='ereklamo' WHERE ereklamo.barangay='{$_SESSION['userBarangay']}' AND ereklamo.purok='{$_SESSION['userPurok']}' AND ereklamoreport.reportStatus='Resolved' ORDER BY date DESC");
                                    while($row=$accounts->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row["reportMessage"] ?></td>
                                    <td><button class="respond btn btn-sm btn-primary" data-id="<?php echo $row['ReklamoID'] ?>" data-user="<?php echo $row['UsersID'] ?>" data-chat="<?php echo $row['chatroomID'] ?>"><i class="fas fa-eye"></i> View</button></td>
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
                                            elseif($row["userType"] == "Councilor"){
                                                echo "img-councilor-profile";
                                            }
                                            elseif($row["userType"] == "Admin"){
                                                echo "img-admin-profile";
                                            }
                                        ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                        </br>
                                        <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['respondentID'] ?>"><?php echo $row["name"] ?></a> 
                                    </td>
                                    <td><?php echo date("M d,Y h:i A",strtotime($row['date'])) ?></td>
                                    
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
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
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
<?php endif; ?>

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
    window.continue_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#continue_modal .modal-title').html($title)
                    $('#continue_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#continue_modal .modal-dialog').addClass($size)
                    }else{
                        $('#continue_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                    }
                    $('#continue_modal').modal({
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

      $('.view_profile').click(function(){
            uni_modal("<center>Profile</center>","profile_alt.php?viewProfile&UsersID="+$(this).attr('data-id'), "modal-lg");
        })
</script>
<?php include_once 'footer.php' ?>