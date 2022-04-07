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

</div>
<?php elseif(isset($_GET['viewRequest'])): ?>
    <div class="container-fluid">

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