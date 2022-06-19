<?php
session_start();
include "dbh.inc.php";
?>
<?php 
if(isset($_GET['edit'])):
	$id = $_GET['edit'];
	$qry = $conn->query("SELECT * FROM users where UsersID = $id")->fetch_array();
    foreach($qry as $k => $v){
		$$k= $v;
	}
?>
<div class="container-fluid">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-account-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-account" aria-selected="true">Account</a>
            <?php if($userType == 'Resident'): ?>
            <a class="nav-item nav-link" id="nav-deactivation-tab" data-toggle="tab" href="#nav-deactivation" role="tab" aria-controls="nav-deactivation" aria-selected="false">Deactivation</a>
            <?php endif; ?>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab">
            <form action="includes/edit_account.inc.php?id=<?php echo $id ?>" class="user" method="post">
                <div class="m-2">
                    <strong>Personal Information</strong>
                </div>
                <div class="form-group row">    <!--Nmae-->
                    <div class="col-sm-3">
                        <input type="text" class="form-control form-control-sm" id="FirstName"
                            name="Firstname" placeholder="First Name" value="<?php echo $Firstname ?>">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control form-control-sm" id="MiddleName"
                            name="Middlename" placeholder="Middle Name" value="<?php echo $Middlename ?>">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control form-control-sm" id="LastName"
                            name="Lastname" placeholder="Last Name" value="<?php echo $Lastname ?>">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control form-control-sm" id="suffixName"
                            name="suffixName" list="suffix" placeholder="Suffix" value="">
                        <datalist id="suffix">
                            <option value="Jr"></option>
                            <option value="Sr"></option>
                            <option value="I"></option>
                            <option value="II"></option>
                            <option value="III"></option>
                            <option value="IV"></option>
                            <option value="V"></option>
                        </datalist>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="date" class="form-control form-control-sm" placeholder="Birthdate" 
                        name="userDOB" id="userDOB" value="<?php echo $dateofbirth ?>"></input>
                    </div>
                    <div class="col-sm-6">
                        <select name="userCivilStat" id="userCivilStat" class="form-control form-control-sm form-select d-inline">
                            <option value="<?php echo $civilStat ?>" hidden selected><?php echo $civilStat ?></option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row"><!--Civil status-->
                    <div class="col-sm-6">
                        <select class="form-control form-control-sm form-select d-inline" id="userGender" placeholder="Gender" name="userGender" required>
                            <option value="<?php echo $userGender ?>" hidden selected><?php echo $userGender ?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="m-2">
                    <strong>Contact Information</strong>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-sm-6">
                        <input type="text" class="form-control form-control-sm" name="phoneNum" id="phoneNum" placeholder="Mobile Number" value="<?php echo $phoneNum ?>"></input>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <input type="text" class="form-control form-control-sm" name="teleNum" id="teleNum" placeholder="Telephone Number" value="<?php echo $teleNum ?>"></input>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-sm-6">
                        <input type="email" class="form-control form-control-sm" name="emailAdd" id="emailAdd" placeholder="Email Address" value="<?php echo $emailAdd ?>"></input>
                    </div>
                </div>
                <?php if($_SESSION['userType'] == 'Resident'): ?>
                <div class="m-2">
                    <strong>Address Information</strong>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <select class="form-control form-control-sm form-select d-inline" name="userBrgy" onChange="changecat(this.value);"  id="userBrgy" readonly>
                            <option value="<?php echo $userBarangay ?>" hidden selected><?php echo $userBarangay ?></option>
                            <?php $barangay = $conn->query("SELECT * FROM barangay WHERE Status='Active'");
                            while($brow = $barangay->fetch_assoc()): ?>  
                                <option value="<?php echo $brow['BarangayName'] ?>"><?php echo $brow['BarangayName'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control form-control-sm form-select d-inline" name="userPurok" id="userPurok">
                            <option value="<?php echo $userPurok ?>" selected hidden><?php echo $userPurok ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <input type="text" class="form-control form-control-sm" name="userHouseNum" id="userHouseNum" placeholder="House #" value="<?php echo $userHouseNum ?>" required>
                    </div>
                </div>
                <?php endif; ?>
                <hr>
                <div class="d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                </div>
            </form>
        </div>
        <?php if($userType == 'Resident'): ?>
        <div class="tab-pane fade" id="nav-deactivation" role="tabpanel" aria-labelledby="nav-deactivation-tab">
            <div class="d-flex justify-content-center m-4">
                <button class="btn btn-danger deactivate_account" data-id="<?php echo $id ?>"><i class="fas fa-danger"></i> Deactivate Account</button>
            </div>
            <div class="d-flex justify-content-center m-4">
                <section>
                    <i style="color: #c41508;">Your account will be disabled. Your comments and posts will be hidden from other users. This is only temporary and you can reactivate again.</i>
                </section>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <script>
        
        $('.deactivate_account').click(function(){
            _conf("Are you sure you want to deactivate your account?","deactivateAccount",[$(this).attr('data-id')])
        })
        $(".container-fluid").parent().siblings(".modal-footer").remove();
        function deactivateAccount($id){
        start_load()
            $.ajax({
                url:'includes/account.inc.php?deactivateAccount',
                method:'POST',
                data:{id:$id},
                success:function(){
                    location.replace("login.php");
                }
            })
        }
    </script>
</div>

<?php elseif(isset($_GET['changePosition'])):
	$id = $_GET['changePosition'];
	$qry = $conn->query("SELECT * FROM users where UsersID = $id")->fetch_array();
?>
<div class="container-fluid">
    <form action="includes/edit_account.inc.php?changePosition=<?php echo $id ?>" class="user" method="post">
        <div class="form-group row">    <!--Nmae-->
            <div class="col-sm-4 col-md-4 mb-3 mb-sm-0">
                <select class="form-control form-control-sm form-select d-inline" name="position" id="position">
                    <option value="<?php echo $qry['userType'] ?>" hidden selected><?php echo $qry['userType'] ?></option>
                    <option value="Secretary">Secretary</option>
                    <option value="Treasurer">Treasurer</option>
                    <option value="Resident">Resident</option>
                </select>
            </div>
        </div>
    </form>
</div>

<?php elseif(isset($_GET['addCategory'])): ?>

    <div class="container-fluid">
        <form action="includes/account.inc.php?addCategoryPost" class="user" method="post">
            <div class="form-group row">    
                <div class="col">
                    <label>Category Name: </label>
                </div>
                <div class="col-sm-7">
                    <input name="catName" id="catName" placeholder="Category Name" class="form-control form-control-sm d-inline" type="text">
                </div>
            </div>
        </form>
    </div>

<?php elseif(isset($_GET['optionsCategory'])): ?>
<div class="container-fluid">
    <?php $sql = $conn->query("SELECT * FROM residentcategory WHERE residentCatID={$_GET['id']}");
    $result = $sql->fetch_assoc(); ?>
    <?php if($_SESSION['userType'] == 'Captain'): ?>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-options-tab" data-toggle="tab" href="#nav-options" role="tab" aria-controls="nav-options" aria-selected="false">Options</a>
            <a class="nav-item nav-link" id="nav-residents-tab" data-toggle="tab" href="#nav-residents" role="tab" aria-controls="nav-residents" aria-selected="true">Residents </a>
        </div>
    </nav>
    <?php endif; ?>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade <?php if($_SESSION['userType'] == 'Captain'){ echo 'show active'; } ?>" id="nav-options" role="tabpanel" aria-labelledby="nav-options-tab">
            <div class="m-2">
                <form action="includes/account.inc.php?optionsCategoryPost&residentCatID=<?php echo $_GET['id'] ?>" class="user" method="post">
                    <div class="form-group row">
                        <div class="col">
                            <label>Category Name: </label>
                        </div>
                        <div class="col-sm-7">
                            <input name="catName" id="catName" placeholder="Category Name" class="form-control form-control-sm d-inline" type="text" value="<?php echo $result['residentCatName'] ?>">
                        </div>
                    </div>
                    <hr>
                    <div class="footer d-flex flex-row-reverse">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button type="button" class="btn btn-danger deleteCategory" data-id="<?php echo $_GET['id'] ?>">Delete</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade <?php if($_SESSION['userType'] != 'Captain'){ echo 'show active'; } ?>" id="nav-residents" role="tabpanel" aria-labelledby="nav-residents-tab">
            <form action="includes/account.inc.php?addResidentList&residentCatID=<?php echo $_GET['id'] ?>" method="POST">
                <div class="m-2">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label>Resident:</label>
                            </div>
                            <div class="col-sm-8">
                                <select class="select-multiple" name="residentList[]" id="residentList" multiple="multiple" style="width: 100%;">
                                    <?php $residentSql = $conn->query("SELECT *, users.UsersID as residentID ,concat(users.Firstname, ' ', users.Lastname) as name FROM members RIGHT JOIN users ON users.UsersID = members.UsersID AND residentCatID={$_GET['id']} WHERE membersID IS NULL AND userBarangay='{$_SESSION['userBarangay']}' AND userPurok='{$_SESSION['userPurok']}'");
                                        while($residentList = $residentSql->fetch_assoc()):
                                            if($residentList["userType"] == "Admin"){
                                                    continue;
                                                }
                                    ?>
                                    <option value="<?php echo $residentList['residentID'] ?>"><?php echo $residentList['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="footer d-flex flex-row-reverse">
                    <button class="btn btn-primary">Add Resident to List</button>
                </div>
            </form>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    
    $(document).ready(function() {
        $('#residentList').select2({
            dropdownParent: $('#uni_modal')
        });
    });

    $(".container-fluid").parent().siblings(".modal-footer").remove();
    
    window._conf = function($msg='',$func='',$params = []){
        $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
        $('#confirm_modal .modal-body').html($msg)
        $('#confirm_modal').modal('show')
    }
    $('.deleteCategory').click(function(){
        _conf("Delete category?","deleteCat",[$(this).attr('data-id')])
    })
    


    function deleteCat($id){
        start_load()
        $.ajax({
            url:'includes/account.inc.php?postCatDelete',
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }
</script>

<?php elseif(isset($_GET['changePass'])): ?>
<div class="container-fluid">
    <style>
        #uni_modal .modal-footer{
            display: none;
        }
        #uni_modal .modal-footer.display{
            display: flex !important; 
        }
    </style>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false">Password</a>
            <a class="nav-item nav-link" id="nav-secret-tab" data-toggle="tab" href="#nav-secret" role="tab" aria-controls="nav-secret" aria-selected="true">Secret Question</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade m-3 show active" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
            <form action="includes/edit_account.inc.php?changePassPost=<?php echo $_GET['changePass'] ?>" class="user" method="post">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-sm"
                            id="userPwd" placeholder="Password" name="userPwd" required>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-sm"
                            id="userRptPwd" placeholder="Repeat Password" name="userRptPwd" required>
                    </div>
                </div>
                <div class="row" style="display: flex; justify-content: flex-end;">
                    <div class="modal-footer display">
                        <button type="submit" class="btn btn-outline-primary" name="submit" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>        
                </div>
            </form>
        </div>
        <div class="tab-pane fade m-3" id="nav-secret" role="tabpanel" aria-labelledby="nav-secret-tab">
            <form action="includes/edit_account.inc.php?changeSecret=<?php echo $_GET['changePass'] ?>" class="user" method="post">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <select class="form-control form-control-sm form-select d-inline" name="secretQuestion" id="secretQuestion">
                            <option value="" hidden>Secret Question</option>
                            <option>What is your mother's maiden name?</option>
                            <option>What is your first pet's name?</option>
                            <option>What's the name of your first bestfriend?</option>
                            <option>What's the name of the school you first went to?</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-sm"
                            id="secretAnswer" placeholder="Secret Answer" name="secretAnswer" required>
                    </div>
                </div>
                <div class="row" style="display: flex; justify-content: flex-end;">
                    <div class="modal-footer display">
                        <button type="submit" class="btn btn-outline-primary" name="submit" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>        
                </div>
            </form>
        </div>
        
    </div>
    
</div>

<?php elseif(isset($_GET['addOfficer'])): ?>
<div class="container-fluid">
    <form action="includes/account.inc.php?postAddOfficer" class="user" method="post">
        <div class="form-group row">    <!--Nmae-->
            <div class="col-md-5">
                <select class="form-control form-control-sm form-select d-inline" name="name" id="name" required>
                    <option value="" hidden selected>Name</option>
                    <?php 
                        $qry = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users 
                        WHERE userType='Resident'");
                        while($row = $qry->fetch_array()):
                    ?>
                    <option value="<?php echo $row['UsersID'] ?>"><?php echo $row['name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-5">
                <select class="form-control form-control-sm form-select d-inline" name="position" id="position" required>
                    <option value="" hidden selected>Position</option>
                    <option value="Secretary">Secretary</option>
                    <option value="Treasurer">Treasurer</option>
                    <option value="Resident">Resident</option>
                </select>
            </div>
        </div>
    </form>
</div>

<?php elseif(isset($_GET['addleader'])): ?>
<div class="container-fluid">
    <form action="includes/account.inc.php?postAddLeader" class="user" method="post">
        <div class="form-group row">    <!--Nmae-->
            <div class="col-md-5">
                <select class="form-control form-control-sm form-select d-inline" name="name" id="name" required>
                    <option value="" hidden selected>Name</option>
                    <?php 
                        $qry = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users 
                        WHERE userType='Resident'");
                        while($row = $qry->fetch_array()):
                    ?>
                    <option value="<?php echo $row['UsersID'] ?>"><?php echo $row['name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
    </form>
</div>

<?php elseif(isset($_GET['postAddLeader'])): 
    $id = $_GET["changePosition"];
    extract($_POST);
    mysqli_begin_transaction($conn);
    $a1 = mysqli_query($conn, "UPDATE users SET userType='Purok Leader' WHERE UsersID='$name'");

    if($a1){
        mysqli_commit($conn);
        header("location: ../residents.php?error=none");
        exit();
    }
    else{
        echo("Error description: ".mysqli_error($conn));
        mysqli_rollback($conn);
    }
        
?>


<?php elseif(isset($_GET['postAddOfficer'])): 
    $id = $_GET["changePosition"];
    extract($_POST);
    mysqli_begin_transaction($conn);
    $a1 = mysqli_query($conn, "UPDATE users SET userType='$position' WHERE UsersID=$id");

    if($a1){
        mysqli_commit($conn);
        header("location: ../residents.php?error=none");
        exit();
    }
    else{
        echo("Error description: ".mysqli_error($conn));
        mysqli_rollback($conn);
    }
?>
    

<?php elseif(isset($_GET['add'])): ?> 
    <script type="text/javascript" src="node_modules/form-validation/lib/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="node_modules/form-validation/dist/jquery.validate.js"></script>
    
    <div class="container-fluid">
        <?php if($_SESSION['userType'] != "Admin"): ?>
            <?php if($_SESSION['userType'] == "Captain"): ?>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="addresident-tab" data-toggle="tab" href="#addresident" role="tab" aria-controls="addresident" aria-selected="true">Resident</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="addcategory-tab" data-toggle="tab" href="#addcategory" role="tab" aria-controls="addcategory" aria-selected="true">Category</a>
                </li>
            </ul>
            <?php endif; ?>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="addresident" role="tabpanel" aria-labelledby="addresident-tab">
                    <!-- <form id="form" action="includes/edit_account.inc.php?addAccount" class="user" method="post">
                        <div class="col">
                            <div class="m-4" id="accountDetails">
                                <div class='form-group row'>
                                    <div class='col-sm-4 col-md-4 mb-3 mb-sm-0'>
                                        <input type='text' class='form-control form-control-sm' id='FirstName'
                                            name='Firstname' placeholder='First Name'>
                                    </div>
                                    <div class='col-sm-4 col-md-4'>
                                        <input type='text' class='form-control form-control-sm' id='MiddleName'
                                            name='Middlename' placeholder='Middle Name'>
                                    </div>
                                    <div class='col-sm-4 col-md-4'>
                                        <input type='text' class='form-control form-control-sm' id='LastName'
                                            name='Lastname' placeholder='Last Name'>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <div class='col'>
                                        <input type='date' class='form-control form-control-sm' placeholder='Birthdate' max="<?php echo date('Y-m-d') ?>" name='userDOB' id='userDOB'></input>
                                    </div>
                                    <div class='col'>
                                        <select name='userCivilStat' id='userCivilStat' class='form-control form-control-sm form-select d-inline'>
                                            <option value='none' hidden selected disabled>Civil Status</option>
                                            <option value='Single'>Single</option>
                                            <option value='Married'>Married</option>
                                            <option value='Widowed'>Widowed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <div class='col'>
                                        <select class='form-control form-control-sm form-select d-inline' id='userGender' placeholder='Gender' name='userGender' required>
                                            <option value='none' disabled hidden selected>Gender</option>
                                            <option value='Male'>Male</option>
                                            <option value='Female'>Female</option>
                                        </select>
                                    </div>
                                    <div class='col'>
                                        <select class='form-control form-control-sm form-select d-inline' name='userPurok' id='userPurok'>
                                            <?php if($_SESSION['userType'] == 'Captain'): ?>
                                                <option value='' selected hidden>Purok</option>
                                                <?php $purokSql = $conn->query("SELECT * FROM purok WHERE BarangayName='{$_SESSION['userBarangay']}'"); 
                                                while($purokData = $purokSql->fetch_assoc()):
                                                ?>
                                                <option value='<?php echo $purokData['PurokName'] ?>'><?php echo $purokData['PurokName'] ?></option>
                                                <?php endwhile; ?>
                                            <?php elseif($_SESSION['userType'] == 'Purok Leader'): ?>
                                                <option value='<?php echo $_SESSION['userPurok'] ?>' selected hidden><?php echo $_SESSION['userPurok'] ?></option>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <div class='col'>
                                        <input type='text' class='form-control form-control-sm' name='userHouseNum' id='userHouseNum' placeholder='House #' required>
                                    </div>
                                    <div class='col'>
                                        <input type='email' class='form-control form-control-sm' name='emailAdd' id='emailAdd' placeholder='Email Address'></input>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <div class='col'>
                                        <input type='text' class='form-control form-control-sm' name='username' id='username' placeholder='Username' required></input>
                                    </div>
                                    <div class='col'>
                                        <input type='password' class='form-control form-control-sm' name='userPwd' id='userPwd' placeholder='Password' required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="footer d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </form> -->
                    <form action="includes/edit_account.inc.php?addAccount" id='addAccount' autocomplete="off" class="user" method="post" enctype="multipart/form-data">
                        <div class="m-2">
                            <strong>Personal Information</strong>
                        </div>
                        <div class="form-group row">   
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" id="FirstName"
                                    name="Firstname" placeholder="First Name" required>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" id="MiddleName"
                                    name="Middlename" placeholder="Middle Name" required>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" id="LastName"
                                    name="Lastname" placeholder="Last Name" required>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" id="suffixName"
                                    name="suffixName" list="suffix" placeholder="Suffix">
                                <datalist id="suffix">
                                    <option value="Jr"></option>
                                    <option value="Sr"></option>
                                    <option value="I"></option>
                                    <option value="II"></option>
                                    <option value="III"></option>
                                    <option value="IV"></option>
                                    <option value="V"></option>
                                </datalist>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm" placeholder="Birthdate" 
                                name="userDOB" max="<?php echo date('Y-m-d') ?>" onblur="(this.type='text')" onfocus="(this.type='date')" id="userDOB" required></input>
                            </div>
                            <div class="col-sm-6">
                                <select name="userCivilStat" id="userCivilStat" class="custom-select" required>
                                    <option value="" hidden selected>Civil Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row"><!--Civil status-->
                            <div class="col-sm-6">
                                <select class="custom-select" id="userGender" placeholder="Gender" name="userGender" required>
                                    <option value="" hidden selected>Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm" placeholder="Date Resided" 
                                name="userDateResides" max="<?php echo date('Y-m-d') ?>" onblur="(this.type='text')" onfocus="(this.type='date')" id="userDateResides" required></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <select class="custom-select" name="IsVoter" id="IsVoter" onchange='voterchange(this.value)' required>
                                    <option value="" selected hidden>Is resident a voter?</option>
                                    <option value="True">Yes</option>
                                    <option value="False">No</option>
                                </select>
                            </div>
                            <div class="col" id="lesseeSection">
                                <div class="row">
                                    <div class="col">
                                        <select class="custom-select" name="IsLessee" id="IsLessee" onchange='lesseechange(this.value)' required>
                                            <option value="" selected hidden>Is resident a lessee?</option>
                                            <option value="True">Yes</option>
                                            <option value="False">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-2">
                            <strong>Contact Information</strong>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-6">
                                <input type="text" class="form-control form-control-sm" name="phoneNum" id="phoneNum" placeholder="Mobile Number"></input>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <input type="text" class="form-control form-control-sm" name="teleNum" id="teleNum" placeholder="Telephone Number"></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-6">
                                <input type="email" class="form-control form-control-sm" name="emailAdd" id="emailAdd" placeholder="Email Address" required></input>
                            </div>
                        </div>
                        <div class="m-2">
                            <strong>Address Information</strong>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6" <?php if($_SESSION['userType'] == 'Purok Leader'): ?> style="display: none;" <?php endif; ?>>
                                <select class="form-control form-control-sm form-select d-inline" name="userPurok" id="userPurok" required>
                                    <option value="" selected hidden>Purok</option>
                                    <?php $purokSql = $conn->query("SELECT * FROM purok WHERE BarangayName='{$_SESSION['userBarangay']}'"); 
                                    while($purokRow = $purokSql->fetch_assoc()):
                                    ?>
                                    <option value="<?php echo $purokRow['PurokName']?>"><?php echo $purokRow['PurokName']?></option>
                                    <?php endwhile; ?>
                                    
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control form-control-sm" name="userHouseNum" id="userHouseNum" placeholder="House #" required>
                            </div>
                        </div>
                        <div class="m-2">
                            <strong>Account Information</strong>
                        </div>
                        <div class="form-group row">
                            <div class='col'>
                                <input type='text' class='form-control form-control-sm' name='username' id='username' placeholder='Username' required></input>
                            </div>
                            <div class='col'>
                                <input type='password' class='form-control form-control-sm' name='userPwd' id='userPwd' placeholder='Password' required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profile_pic">Profile Picture: </label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="userPicture" name="userPicture" accept="image/*" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label for="customFile">Attach your Valid ID</label>
                            </div>
                            <div class="row">
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="uservalidid" name="uservalidid" accept="image/*" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="voterssection" style="display: none;">
                            <div class="row">
                                <label for="customFile">Attach your voter's ID</label>
                            </div>
                            <div class="row">
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="votersid" name="uservoterid" accept="image/*" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="lesseesection" style="display: none;">
                            <div class="row">
                                <label for="customFile">Attach your Lessor's note</label>
                            </div>
                            <div class="row">
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="lessornote" name="userlessornote" accept="image/*" required>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="footer d-flex flex-row-reverse">
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="addcategory" role="tabpanel" aria-labelledby="addcategory-tab">
                    <div class="container-fluid">
                        <form action="includes/account.inc.php?addCategoryPost" class="user" method="post">
                            <div class="form-group row">    
                                <div class="col">
                                    <label>Category Name: </label>
                                </div>
                                <div class="col-sm-7">
                                    <input name="catName" id="catName" placeholder="Category Name" class="form-control form-control-sm d-inline" type="text">
                                </div>
                            </div>
                            <div class="footer d-flex flex-row-reverse">
                                <button name="captsubmit" type="submit" class="btn btn-success">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <form id="form" action="includes/edit_account.inc.php?addCapt" autocomplete="off" class="user" method="post" enctype="multipart/form-data">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <label for="">Barangay: </label>
                        </div>
                        <div class="col">
                            <select name="barangay" id="barangay" onchange="checkCaptain(this.value)">
                                <option value="">Select Barangay</option>
                                <?php $brgySql = $conn->query("SELECT * FROM barangay");
                                while($brgyList = $brgySql->fetch_assoc()): ?>
                                <option value="<?php echo $brgyList['BarangayName'] ?>"><?php echo $brgyList['BarangayName'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="barangayDetails">
            
                    </div>
                    <div id="accountDetails" style="display: none;">
                        <div class="m-2">
                            <strong>Personal Information</strong>
                        </div>
                        <div class="form-group row">   
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" id="FirstName"
                                    name="Firstname" placeholder="First Name" required>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" id="MiddleName"
                                    name="Middlename" placeholder="Middle Name" required>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" id="LastName"
                                    name="Lastname" placeholder="Last Name" required>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" id="suffixName"
                                    name="suffixName" list="suffix" placeholder="Suffix">
                                <datalist id="suffix">
                                    <option value="Jr"></option>
                                    <option value="Sr"></option>
                                    <option value="I"></option>
                                    <option value="II"></option>
                                    <option value="III"></option>
                                    <option value="IV"></option>
                                    <option value="V"></option>
                                </datalist>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm" placeholder="Birthdate" 
                                name="userDOB" max="<?php echo date('Y-m-d') ?>" onblur="(this.type='text')" onfocus="(this.type='date')" id="userDOB" required></input>
                            </div>
                            <div class="col-sm-6">
                                <select name="userCivilStat" id="userCivilStat" class="form-control form-control-sm form-select d-inline" required>
                                    <option value="" hidden selected>Civil Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <select class="form-control form-control-sm form-select d-inline" id="userGender" placeholder="Gender" name="userGender" required>
                                    <option value="" hidden selected>Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm" placeholder="Date Resided" 
                                name="userDateResides" max="<?php echo date('Y-m-d') ?>" onblur="(this.type='text')" onfocus="(this.type='date')" id="userDateResides" required></input>
                            </div>
                        </div>
                        <div class="m-2">
                            <strong>Contact Information</strong>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-6">
                                <input type="text" class="form-control form-control-sm" name="phoneNum" id="phoneNum" placeholder="Mobile Number"></input>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <input type="text" class="form-control form-control-sm" name="teleNum" id="teleNum" placeholder="Telephone Number"></input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-sm-6">
                                <input type="email" class="form-control form-control-sm" name="emailAdd" id="emailAdd" placeholder="Email Address" required></input>
                            </div>
                        </div>
                        <div class="m-2">
                            <strong>Address Information</strong>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <select class="form-control form-control-sm form-select d-inline" name="userPurok" id="userPurok" required>
                                    <option value="" selected hidden>Purok</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control form-control-sm" name="userHouseNum" id="userHouseNum" placeholder="House #" required>
                            </div>
                        </div>
                        <div class="m-2">
                            <strong>Account Information</strong>
                        </div>
                        <div class="form-group row">
                            <div class='col'>
                                <input type='text' class='form-control form-control-sm' name='username' id='username' placeholder='Username' required></input>
                            </div>
                            <div class='col'>
                                <input type='password' class='form-control form-control-sm' name='userPwd' id='userPwd' placeholder='Password' required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profile_pic">Profile Picture: </label>
                            <div class="custom-file">
                                <input type="file" class="form-control" id="userPicture" name="userPicture" accept="image/*" required>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="footer d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        <?php endif; ?>

        <script>
            $(".container-fluid").parent().siblings(".modal-footer").remove();
            function voterchange(value){
                if(value == 'True'){
                    $("#voterssection").css('display', 'block');
                }
                else{
                    $("#voterssection").css('display', 'none');
                }
            }

            function lesseechange(value){
                if(value == 'True'){
                    $("#lesseesection").css('display', 'block');
                }
                else{
                    $("#lesseesection").css('display', 'none');
                }
            }

            $( "form" ).validate({
                rules:{
                    Middlename:{
                        required: true
                    }
                },
                messages:{
                    Middlename:{
                        required: "Please enter '-' if no middle name"
                    }
                },
                errorElement: "em",
                errorPlacement: function ( error, element ) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass( "invalid-feedback" );

                    if ( element.prop( "type" ) === "checkbox" ) {
                        error.insertAfter( element.next( "label" ) );
                    } else {
                        error.insertAfter( element );
                    }
                },
                highlight: function ( element, errorClass, validClass ) {
                    $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
                },
                unhighlight: function (element, errorClass, validClass) {
                    $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
                }
            });
        </script>
    </div>


<?php 
    elseif(isset($_GET['getCapt'])):
        if(isset($_GET['response'])){
            $captainSql = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as cptName FROM barangay LEFT JOIN users ON brgyCaptain = UsersID WHERE BarangayName='{$_GET['response']}'"); 
            $captainName = $captainSql -> fetch_assoc();
            if($captainName['cptName'] != NULL || $captainName['cptName'] != "" || $captainName['cptName'] != 0){
                echo "<div class='col'>";
                echo "<label for=''>Barangay Captain: </label>";
                echo "</div>";
                echo "<div class='col'>";
                echo "<label data-id=" . $captainName['brgyCaptain'] . ">" . $captainName['cptName'] . "</label>";
                echo "<input name='existingCapt' value=". $captainName['brgyCaptain'] ." type='hidden'>";
                echo "</div>";
            }    
            else{
                echo "<div class='col'>";
                echo "<label for=''>Barangay Captain: </label>";
                echo "</div>";
                echo "<div class='col'>";
                echo "<label data-id=0>None</label>";
                echo "<input name='existingCapt' value=0 type='hidden'>";
                echo "</div>";
            }   
        }
?>
<?php endif; ?>

<?php if(isset($_GET['addCategoryPost'])){
    extract($_POST);
    mysqli_begin_transaction($conn);
    if(isset($_POST['captsubmit'])){
        $a1 = mysqli_query($conn, "INSERT INTO residentcategory(residentCatName, Barangay, Purok) VALUES('$catName', '{$_SESSION['userBarangay']}', 'All')");

        if($a1){
            mysqli_commit($conn);
            header("location: ../residents.php?error=none");
            exit();
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
        }  
    }
    else{
        $a1 = mysqli_query($conn, "INSERT INTO residentcategory(residentCatName, Barangay, Purok) VALUES('$catName', '{$_SESSION['userBarangay']}', '{$_SESSION['userPurok']}')");

        if($a1){
            mysqli_commit($conn);
            header("location: ../residents.php?error=none");
            exit();
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
        }  
    }
}

?>

<?php if(isset($_GET['deactivateAccount'])){
    extract($_POST);
    mysqli_begin_transaction($conn);
    
    $a1 = mysqli_query($conn, "UPDATE users SET status='Deactivated' WHERE UsersID=$id");
 
    if($a1){
        mysqli_commit($conn);
        header("location: ../login.php");
        exit();
    }
    else{
        echo("Error description: ".mysqli_error($conn));
        mysqli_rollback($conn);
    }  
}
?>

<?php if(isset($_GET['activateAccount'])){
    extract($_POST);
    mysqli_begin_transaction($conn);
    
    $a1 = mysqli_query($conn, "UPDATE users SET status='Active' WHERE UsersID={$_GET['UsersID']}");
    
    if($a1){
        mysqli_commit($conn);
        header("location: ../index.php");
        exit();
    }
    else{
        echo("Error description: ".mysqli_error($conn));
        mysqli_rollback($conn);
    }  
}

?>

<?php if(isset($_GET['optionsCategoryPost'])){
    extract($_POST);
    mysqli_begin_transaction($conn);
    $a1 = mysqli_query($conn, "UPDATE residentcategory SET residentCatName='$catName' WHERE residentCatID={$_GET['residentCatID']}");

    if($a1){
        mysqli_commit($conn);
        header("location: ../residents.php?error=none");
        exit();
    }
    else{
        echo("Error description: ".mysqli_error($conn));
        mysqli_rollback($conn);
    } 
}

?>

<?php if(isset($_GET['removeResidentList'])){
    extract($_POST);
    mysqli_begin_transaction($conn);
    $a1 = mysqli_query($conn, "DELETE FROM members WHERE UsersID=$id");

    if($a1){
        mysqli_commit($conn);
        header("location: ../residents.php?error=none");
        exit();
    }
    else{
        echo("Error description: ".mysqli_error($conn));
        mysqli_rollback($conn);
    }  
} ?>

<?php if(isset($_GET['postCatDelete'])){
    extract($_POST);
    mysqli_begin_transaction($conn);
    $a1 = mysqli_query($conn, "DELETE FROM residentcategory WHERE residentCatID=$id");

    if($a1){
        mysqli_commit($conn);
        header("location: ../residents.php?error=none");
        exit();
    }
    else{
        echo("Error description: ".mysqli_error($conn));
        mysqli_rollback($conn);
    }  
}

?>
<?php if(isset($_GET['addResidentList'])){
    extract($_POST);

    foreach($_POST['residentList'] as $selectedOption){
        mysqli_begin_transaction($conn);
        $a1 = mysqli_query($conn, "INSERT INTO members(UsersID, residentCatID) VALUES($selectedOption, {$_GET['residentCatID']})");

        if($a1){
            mysqli_commit($conn);
        }
        else{
            echo("Error description: ".mysqli_error($conn));
            mysqli_rollback($conn);
        } 
    }

    header("location: ../residents.php?error=none");
    
}

?>


<script>    
(function($, undefined) {

"use strict";

// When ready.
$(function() {
  
  var $form = $( "#form" );
  var $input = $form.find( "#natID" );

  $input.on( "keyup", function( event ) {
    
    
    // When user select text in the document, also abort.
    var selection = window.getSelection().toString();
    if ( selection !== '' ) {
      return;
    }
    
    // When the arrow keys are pressed, abort.
    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
      return;
    }
    
    var $this = $(this);
    var input = $this.val();
        input = input.replace(/[\W\s\._\-]+/g, '');
      
      var split = 4;
      var chunk = [];

      for (var i = 0, len = input.length; i < len; i += split) {
        chunk.push( input.substr( i, split ) );
      }

      $this.val(function() {
        return chunk.join("-").toUpperCase();
      });
  
  } );
  
});
})(jQuery);

var mealsByCategory = {
<?php 
    $puroks = array();
    $barangay = $conn->query("SELECT * FROM barangay");
    while($brow = $barangay->fetch_assoc()):
?>
    <?php 
    echo json_encode($brow["BarangayName"]) ?> : <?php $purok = $conn->query("SELECT * FROM purok WHERE BarangayName='{$brow['BarangayName']}' AND Active='True'"); 
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

function checkCaptain(str){
    var brgy = document.getElementById('barangayDetails');
    if(str.length == 0){
        brgy.innerHTML = "";
        document.getElementById('accountDetails').style.display = "none";   
    }
    else{
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function(){
            brgy.innerHTML = this.responseText; 
            changecat(str);
            document.getElementById('accountDetails').style.display = "block";
        }
        xmlhttp.open("GET", "includes/account.inc.php?getCapt&response="+str);
        xmlhttp.send();
    }
}

</script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>