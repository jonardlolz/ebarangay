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
    <form action="includes/edit_account.inc.php?id=<?php echo $id ?>" class="user" method="post">
        <div class="form-group row">    <!--Nmae-->
            <div class="col-sm-4 col-md-4 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-sm" id="FirstName"
                    name="Firstname" placeholder="First Name" value="<?php echo $Firstname ?>">
            </div>
            <div class="col-sm-4 col-md-4">
                <input type="text" class="form-control form-control-sm" id="MiddleName"
                    name="Middlename" placeholder="Middle Name" value="<?php echo $Middlename ?>">
            </div>
            <div class="col-sm-4 col-md-4">
                <input type="text" class="form-control form-control-sm" id="LastName"
                    name="Lastname" placeholder="Last Name" value="<?php echo $Lastname ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <input type="date" class="form-control form-control-sm" placeholder="Birthdate" 
                name="userDOB" id="userDOB" value="<?php echo $dateofbirth ?>"></input>
            </div>
        </div>
        
        <div class="form-group row"><!--Civil status-->
            <div class="col-sm-6">
                <select name="userCivilStat" id="userCivilStat" class="form-control form-control-sm form-select d-inline">
                    <option value="<?php echo $civilStat ?>" hidden selected><?php echo $civilStat ?></option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                </select>
            </div>
            <div class="col-sm-6">
                <select class="form-control form-control-sm form-select d-inline" id="userGender" placeholder="Gender" name="userGender" required>
                    <option value="<?php echo $userGender ?>" hidden selected><?php echo $userGender ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <select class="form-control form-control-sm form-select d-inline" name="userBrgy" onChange="changecat(this.value);"  id="userBrgy">
                    <option value="<?php echo $userBarangay ?>" hidden selected><?php echo $userBarangay ?></option>
                    <?php $barangay = $conn->query("SELECT * FROM barangay WHERE Active='True'");
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
            <div class="col-lg-6 col-sm-6">
                <input type="text" class="form-control form-control-sm" name="userAddress" id="userAddress" placeholder="Street Address" value="<?php echo $userAddress ?>" required></input>
            </div>
            <div class="col-lg-6">
                <input type="text" class="form-control form-control-sm" name="userHouseNum" id="userHouseNum" placeholder="House #" value="<?php echo $userHouseNum ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-sm-6">
                <input type="email" class="form-control form-control-sm" name="emailAdd" id="emailAdd" placeholder="Email Address" value="<?php echo $emailAdd ?>"></input>
            </div>
            <div class="col-lg-6 col-sm-6">
                <select class="form-control form-control-sm form-select d-inline" name="userType" id="userType">
                    <option value="<?php echo $userType ?>" hidden selected><?php echo $userType ?></option>
                    <option value="Resident">Resident</option>
                    <option value="Captain">Barangay Captain</option>
                    <option value="Treasurer">Treasurer</option>
                    <option value="Secretary">Secretary</option>
                    <option value="Purok Leader">Purok Leader</option>
                </select>
            </div>
        </div>
    </form>
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

<?php elseif(isset($_GET['addOfficer'])): ?>
<div class="container-fluid">
    <form action="includes/edit_account.inc.php?postAddOfficer" class="user" method="post">
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

<?php elseif(isset($_GET['postAddOfficer'])): 
    
?>
    

<?php elseif(isset($_GET['add'])): ?> 
<div class="container-fluid">
    <form id="form" action="includes/edit_account.inc.php" class="user" method="post">
        <!-- <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="natID"
                    placeholder="National ID (e.g. XXXX-XXXX-XXXX-XXXX)" name="natID" maxlength="19" required>
        </div> -->
        <div class="form-group row">    <!--Nmae-->
            <div class="col-sm-4 col-md-4 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-sm" id="FirstName"
                    name="Firstname" placeholder="First Name">
            </div>
            <div class="col-sm-4 col-md-4">
                <input type="text" class="form-control form-control-sm" id="MiddleName"
                    name="Middlename" placeholder="Middle Name">
            </div>
            <div class="col-sm-4 col-md-4">
                <input type="text" class="form-control form-control-sm" id="LastName"
                    name="Lastname" placeholder="Last Name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <input type="date" class="form-control form-control-sm" placeholder="Birthdate" name="userDOB" id="userDOB"></input>
            </div>
        </div>
        
        <div class="form-group row"><!--Civil status-->
            <div class="col-sm-6">
                <select name="userCivilStat" id="userCivilStat" class="form-control form-control-sm form-select d-inline">
                    <option value="none" hidden selected disabled>Civil Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                </select>
            </div>
            <div class="col-sm-6">
                <select class="form-control form-control-sm form-select d-inline" id="userGender" placeholder="Gender" name="userGender" required>
                    <option value="none" disabled hidden selected>Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <select class="form-control form-control-sm form-select d-inline" name="userBrgy" onChange="changecat(this.value);"  id="userBrgy">
                    <option value="" hidden selected>Barangay</option>
                    <?php $barangay = $conn->query("SELECT * FROM barangay WHERE Active='True'");
                    while($brow = $barangay->fetch_assoc()): ?>  
                        <option value="<?php echo $brow['BarangayName'] ?>"><?php echo $brow['BarangayName'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-sm-6">
                <select class="form-control form-control-sm form-select d-inline" name="userPurok" id="userPurok">
                    <option value="" disabled selected hidden>Purok</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-sm-6">
                <input type="text" class="form-control form-control-sm" name="userAddress" id="userAddress" placeholder="Street Address" required></input>
            </div>
            <div class="col-lg-6">
                <input type="text" class="form-control form-control-sm" name="userHouseNum" id="userHouseNum" placeholder="House #" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-sm-6">
                <input type="email" class="form-control form-control-sm" name="emailAdd" id="emailAdd" placeholder="Email Address"></input>
            </div>
            <div class="col-lg-6 col-sm-6">
                <select class="form-control form-control-sm form-select d-inline" name="userType" id="userType">
                    <option value="none" hidden selected>User Type</option>
                    <option value="Resident">Resident</option>
                    <option value="Captain">Barangay Captain</option>
                    <option value="Treasurer">Treasurer</option>
                    <option value="Secretary">Secretary</option>
                    <option value="Purok Leader">Purok Leader</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-sm-6">
                <input type="text" class="form-control form-control-sm" name="username" id="username" placeholder="Username" required></input>
            </div>
            <div class="col-lg-6">
                <input type="password" class="form-control form-control-sm" name="userPw" id="userPw" placeholder="Password" required>
            </div>
        </div>
    </form>
</div>

<?php endif; ?>

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

</script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>