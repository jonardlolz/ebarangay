<?php
    session_start();
    include 'dbh.inc.php';
    extract($_POST);
    if(isset($_POST["submit"]))
    {
        $id=$_GET["id"];
        $sql = "UPDATE users SET Firstname=?, Middlename=?, Lastname=?, userGender=?, 
        dateofbirth=?, userPurok=?, userBarangay=?, userCity=?, 
        phoneNum=?, teleNum=?, emailAdd=?, userAddress=?, userHouseNum=?, civilStat=? WHERE UsersID=?";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../profile.php?error=stmtfailedcreatepost");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sssssssssssssss", $Firstname, $Middlename, $Lastname, $userGender,
        $userDOB, $userPurok, $userBrgy, $userCity, $phoneNum, $teleNum, $emailAdd, $userAddress, $userHouseNum, $userCivilStat, $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        $_SESSION["Firstname"] = $Firstname;
        $_SESSION["Middlename"] = $Middlename;
        $_SESSION["Lastname"] = $Lastname;
        $_SESSION["userGender"] = $userGender;
        $_SESSION["dateofbirth"] = $userDOB;
        $_SESSION["currentAdd"] = $currentAdd;
        $_SESSION["userPurok"] = $userPurok;
        $_SESSION['civilStat'] = $userCivilStat;
        $_SESSION["userBarangay"] = $userBrgy;
        $_SESSION["userCity"] = $userCity;
        $_SESSION["phoneNum"] = $phoneNum;
        $_SESSION["teleNum"] = $teleNum;
        $_SESSION["emailAdd"] = $emailAdd;
        $_SESSION['userAddress'] = $userAddress;
        $_SESSION['userHouseNum'] = $userHouseNum;
        header("location: ../profile.php?error=none");
        exit();
    }
if(isset($_GET['viewReklamo'])): ?>
<div class="container-fluid">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Respondents sent</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Resolved</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                            $requests = $conn->query("SELECT * FROM ereklamo WHERE UsersID={$_SESSION['UsersID']} AND status='Pending'");
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
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                            $requests = $conn->query("SELECT * FROM ereklamo WHERE UsersID={$_SESSION['UsersID']} AND status='Respondents sent'");
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
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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
                            $requests = $conn->query("SELECT * FROM ereklamo WHERE UsersID={$_SESSION['UsersID']} AND status='Resolved'");
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
    </div>
</div>
<?php elseif(isset($_GET['viewRequest'])): ?>
    <div class="container-fluid">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Approved</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="paid-tab" data-toggle="tab" href="#paid" role="tab" aria-controls="paid" aria-selected="false">Paid</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="released-tab" data-toggle="tab" href="#released" role="tab" aria-controls="released" aria-selected="false">Claimed</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th scope="col">Document</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date Requested</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                $requests = $conn->query("SELECT * FROM request WHERE UsersID={$_SESSION['UsersID']} AND status='Pending'");
                                while($row=$requests->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $row["documentType"] ?></td>
                                <td><?php echo $row["purpose"] ?></td>
                                <td><?php echo $row["amount"] ?></td>
                                <td><?php echo date("M d,Y h:i a", strtotime($row['requestedOn'])); ?></td>
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
            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th scope="col">Document</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date Requested</th>
                                <th scope="col">Date Approved</th>
                                <th scope="col">Approved By</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                $requests = $conn->query("SELECT * FROM request WHERE UsersID={$_SESSION['UsersID']} AND status='Approved'");
                                while($row=$requests->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $row["documentType"] ?></td>
                                <td><?php echo $row["purpose"] ?></td>
                                <td><?php echo $row["amount"] ?></td>
                                <td><?php echo date("M d,Y h:i a", strtotime($row['requestedOn'])); ?></td>
                                <td><?php if($row['approvedOn'] != NULL){ echo date("M d,Y h:i a", strtotime($row['approvedOn']));} else{ echo "N/A"; } ?></td>
                                <td><?php echo $row["approvedBy"] ?></td>
                                <td>
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
            <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th scope="col">Document</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date Requested</th>
                                <th scope="col">Date Paid</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                $requests = $conn->query("SELECT * FROM request WHERE UsersID={$_SESSION['UsersID']} AND status='Paid'");
                                while($row=$requests->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $row["documentType"] ?></td>
                                <td><?php echo $row["purpose"] ?></td>
                                <td><?php echo $row["amount"] ?></td>
                                <td><?php echo date("M d,Y h:i a", strtotime($row['requestedOn'])); ?></td>
                                <td><?php if($row['approvedOn'] != NULL){ echo date("M d,Y h:i a", strtotime($row['approvedOn']));} else{ echo "N/A"; } ?></td>
                                <td>
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
            <div class="tab-pane fade" id="released" role="tabpanel" aria-labelledby="released-tab">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th scope="col">Document</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date Requested</th>
                                <th scope="col">Date Claimed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                $requests = $conn->query("SELECT * FROM request WHERE UsersID={$_SESSION['UsersID']} AND status='Released'");
                                while($row=$requests->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $row["documentType"] ?></td>
                                <td><?php echo $row["purpose"] ?></td>
                                <td><?php echo $row["amount"] ?></td>
                                <td><?php echo date("M d,Y h:i a", strtotime($row['requestedOn'])); ?></td>
                                <td><?php if($row['approvedOn'] != NULL){ echo date("M d,Y h:i a", strtotime($row['approvedOn']));} else{ echo "N/A"; } ?></td>
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

<?php elseif(isset($_GET['viewHistory'])): ?>
    <style>
        #uni_modal .modal-footer{
            display: none;
        }
    </style>
    <div class="container-fluid">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-ereklamo-tab" data-toggle="tab" href="#nav-ereklamo" role="tab" aria-controls="nav-ereklamo" aria-selected="true">eReklamo</a>
                <a class="nav-item nav-link" id="nav-erequest-tab" data-toggle="tab" href="#nav-erequest" role="tab" aria-controls="nav-erequest" aria-selected="false">eRequest</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-ereklamo" role="tabpanel" aria-labelledby="nav-ereklamo-tab">
                <div class="table-responsive">
                    <table id="dataTable1" class="table table-bordered text-center text-dark display" 
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
                                $accounts = $conn->query("SELECT * FROM report WHERE ReportType='eReklamo' AND UsersID='{$_GET['UsersID']}' AND userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}' ORDER BY created_on DESC");
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
            <div class="tab-pane fade show" id="nav-erequest" role="tabpanel" aria-labelledby="nav-erequest-tab">
                <div class="table-responsive">
                    <table id="dataTable2" class="table table-bordered text-center text-dark display" 
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
                                $accounts = $conn->query("SELECT * FROM report WHERE ReportType='Request' AND UsersID='{$_GET['UsersID']}' AND userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}' ORDER BY created_on DESC");
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
    </div>

<?php elseif(isset($_GET['editProfile'])): ?>

<?php endif; ?>

<script>
    $(document).ready(function() {
        $('#dataTable1').DataTable();
    } );
    $(document).ready(function() {
        $('#dataTable2').DataTable();
    } );
</script>