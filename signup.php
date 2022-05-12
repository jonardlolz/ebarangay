<?php include_once "includes/dbh.inc.php"; ?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>EBARANGAY - Register Account</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link href="css/sb-admin-2.css" rel="stylesheet">
    </head>

    <body>
        <!-- Container -->
        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block">
                            <div class="p-5 d-flex justify-content-center align-items-center">
                                <img src="img/eb-logo.png" alt="EBARANGAY LOGO">
                            </div>
                        </div>
                        <div class="col-lg-7 text-dark">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="mb-4 text-capitalize">Create an Account!</h1>
                                </div>
                                <form id="form" action="includes/signup.inc.php" class="user" method="post">
                                    <div>
                                        <strong>Personal Information</strong>
                                        <hr>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-user"
                                                id="userFirstname" placeholder="First name" name="userFirstname" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-user"
                                                id="userMiddlename" placeholder="Middle name" name="userMiddlename" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-user"
                                                id="userLastname" placeholder="Last name" name="userLastname" required>
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-user"
                                                    id="userSuffix" placeholder="Suffix" name="userSuffix" list="suffixList" value="">
                                            <datalist id="suffixList">
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
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" max="<?php echo date('Y-m-d') ?>" class="form-control form-control-user" placeholder="Birthdate" id="userDOB" name="userDOB" onblur="(this.type='text')" onfocus="(this.type='date')" required>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <select class="form-select form-select-lg" id="userCivilStat" placeholder="Civil Status" name="userCivilStat" required>
                                                <option value="none" disabled hidden selected>Civil Status</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widow">Widow</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <select class="form-select form-select-lg" id="userGender" placeholder="Gender" name="userGender" required>
                                                <option value="none" disabled hidden selected>Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>Address Information</strong>
                                        <hr>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <select name="userBarangay" id="userBarangay" class="form-select form-select-lg" onfocus="changecat(this.value);" onChange="changecat(this.value);">
                                                <option value="" hidden selected>Barangay</option>
                                                <?php $barangay = $conn->query("SELECT * FROM barangay WHERE Status='Active'");
                                                while($brow = $barangay->fetch_assoc()): ?>  
                                                <option value="<?php echo $brow['BarangayName'] ?>"><?php echo $brow['BarangayName'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <select class="form-select form-select-lg" id="userPurok" placeholder="Purok" name="userPurok" required>
                                                <option value="none" disabled selected hidden>Purok</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="userHouseNum"
                                                placeholder="House #" name="userHouseNum" required>
                                        </div>        
                                    </div>
                                    <div>
                                        <strong>Account Information</strong>
                                        <hr>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="userName"
                                                placeholder="Username" name="userName" required>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="email" class="form-control form-control-user" id="userEmail"
                                            placeholder="Email Address" name="userEmail" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user"
                                                id="userPwd" placeholder="Password" name="userPwd" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user"
                                                id="userRptPwd" placeholder="Repeat Password" name="userRptPwd" required>
                                        </div>
                                    </div>
                                    
    
                                    <?php
                                        if(isset($_GET["error"])){
                                            if($_GET["error"] == "emptyinput"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                Please fill in all the fields!
                                                </div>";
                                            }
                                        }
                                        if(isset($_GET["error"])){
                                            if($_GET["error"] == "invalidUser"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                Username is invalid!
                                                </div>";
                                            }
                                        }
                                        if(isset($_GET["error"])){
                                            if($_GET["error"] == "invalidEmail"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                Email is invalid!
                                                </div>";
                                            }
                                        }
                                        if(isset($_GET["error"])){
                                            if($_GET["error"] == "invpwd"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                Passwords don't match!
                                                </div>";
                                            }
                                        }
                                        if(isset($_GET["error"])){
                                            if($_GET["error"] == "emptyinput"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                Input is empty!
                                                </div>";
                                            }
                                        }
                                        if(isset($_GET["error"])){
                                            if($_GET["error"] == "userExists"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                User already exists!
                                                </div>";
                                            }
                                        }
                                        if(isset($_GET["error"])){
                                            if($_GET["error"] == "stmtfailed"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                Something went wrong. Try again!
                                                </div>";
                                            }
                                        }
                                        if(isset($_GET["error"])){
                                            if($_GET["error"] == "emptyinput"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                Input is empty!
                                                </div>";
                                            }
                                        }
                                        if(isset($_GET["error"])){
                                            if($_GET["error"] == "invbrgy"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                Please enter a barangay!
                                                </div>";
                                            }
                                        }
                                        if(isset($_GET["error"])){
                                            if($_GET["error"] == "invpurok"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                Please enter a purok!
                                                </div>";
                                            }
                                        }
                                        if(isset($_GET["error"])){
                                            if($_GET["error"] == "natIDexists"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                National ID is already in use!
                                                </div>";
                                            }
                                        }
                                        if(isset($_GET["error"])){
                                            if($_GET["error"] == "none"){
                                               echo "<div class='alert alert-success' role='alert'>
                                                You have signed up!
                                                </div>";
                                            }
                                        }
                                    ?>
                                    <hr>
                                    <section>
                                        <input type="checkbox" required> 
                                        <i style="color: #c41508;">I hereby declare that the information provided is true and correct. I also understand that any willful
                                        dishonesty may render for refusal of this registration. I also understand I am entitled to update and correct the above information.</i>
                                    </section>
                                    
                                    <hr>
                                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                        Register Account
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="login.php">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Nested Row within Card Body -->
                </div>
            </div>
            
        </div>
        <!-- End of Container -->

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

    </body>
    
    <script>

    function showLandlord(){
        var chbox = document.getElementById("isRenting");
        if(!chbox.checked){
            var vis = "none";
            document.getElementById("landlord").style.display = vis;
            document.getElementById("landlordContact").required = false;
        document.getElementById("landlordName").required = false;
            return;
        }
        
        var vis = "flex";
        document.getElementById("landlord").style.display = vis;
        document.getElementById("landlordContact").required = true;
        document.getElementById("landlordName").required = true;
    }

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

</html>