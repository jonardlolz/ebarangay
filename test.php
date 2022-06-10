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
        
        
        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon/favicon.ico">
        <link rel="icon" type="image/gif" href="img/favicon/favicon-32x32.png">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

        <script type="text/javascript" src="node_modules/form-validation/lib/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="node_modules/form-validation/dist/jquery.validate.js"></script>
        <script src="node_modules/Visual-Password-Strength-Indicator-Plugin-For-jQuery-Passtrength-js/src/jquery.passtrength.js"></script>
        <link rel="stylesheet" href="node_modules/Visual-Password-Strength-Indicator-Plugin-For-jQuery-Passtrength-js/src/passtrength.css">
        
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
                                <form id="signupForm" method="post" autocomplete="off" class="form-horizontal" action="includes/signup.inc.php">
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
                                                id="userMiddlename" placeholder="Middle name" name="userMiddlename">
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
                                            <select class="custom-select" id="userCivilStat" placeholder="Civil Status" name="userCivilStat" required>
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
                                            <select class="custom-select" id="userGender" placeholder="Gender" name="userGender" required>
                                                <option value="" hidden selected>Gender</option>
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
                                            <select name="userBarangay" id="userBarangay" class="custom-select" onfocus="changecat(this.value);" onChange="changecat(this.value);" required>
                                                <option value="" hidden selected>Barangay</option>
                                                <?php $barangay = $conn->query("SELECT * FROM barangay WHERE Status='Active'");
                                                while($brow = $barangay->fetch_assoc()): ?>  
                                                <option value="<?php echo $brow['BarangayName'] ?>"><?php echo $brow['BarangayName'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <select class="custom-select" id="userPurok" placeholder="Purok" name="userPurok" required>
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
                                                placeholder="Username" name="userName">
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="email" class="form-control form-control-user" id="userEmail"
                                            placeholder="Email Address" name="userEmail">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user"
                                                id="userPwd" placeholder="Password" name="userPwd">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user"
                                                id="userRptPwd" placeholder="Repeat Password" name="userRptPwd">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <select class="custom-select" name="secretQuestion" id="privateQuestion" required>
                                                <option value="" hidden>Secret Question</option>
                                                <option>What is your mother's maiden name?</option>
                                                <option>What is your first pet's name?</option>
                                                <option>What's the name of your first bestfriend?</option>
                                                <option>What's the name of the school you first went to?</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="secretAnswer" class="form-control form-control-user" placeholder="Private answer" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row pr-5 pl-5">
                                        <input class="form-check-input" type="checkbox" id="agree" name="agree">
                                        <label class="form-check-label">I hereby declare that the information provided is true and correct. I also understand that any willful
                                        dishonesty may render for refusal of this registration. I also understand I am entitled to update and correct the above information.</label>
                                    </div>
                                    <hr>

                                    <div class="form-group row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary btn-user btn-block" name="submit">Sign up</button>
                                        </div>
                                    </div>
                                </form>
                                <script>
                                    
                                </script>
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

        
    </body>
    
    <script type="text/javascript">

        $.validator.setDefaults( {
            submitHandler: function () {
                $("form#signupForm").submit()
            }
        } );

        $( document ).ready( function () {
            $( "#signupForm" ).validate( {
                rules: {
                    userHouseNum: {
                        required: true,
                        numbersonly: true
                    },
                    userName: {
                        required: true,
                        minlength: 5,
                        remote: {
                            url: "includes/validation.inc.php?userExist",
                            type: "post",
                            data:{
                                username: function(){
                                    return $( "#userName" ).val();
                                }
                            }
                        }
                    },
                    userPwd: {
                        required: true,
                        strong_password: true,
                        minlength: 8
                    },
                    userRptPwd: {
                        required: true,
                        equalTo: "#userPwd"
                    },
                    userEmail: {
                        required: true,
                        email: true,
                        remote: {
                            url: "includes/validation.inc.php?emailExist",
                            type: "post",
                            data:{
                                userEmail: function(){
                                    return $( "#userEmail" ).val();
                                }
                            }
                        }
                    },
                    agree: "required"
                },
                messages: {
                    userHouseNum: {
                        numbersonly: "Please enter numbers only"
                    },
                    userName: {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 5 characters",
                        remote: "Username is already in use"
                    },
                    userPwd: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    userRptPwd: {
                        required: "Please repeat the password",
                        equalTo: "Please enter the same password as above"
                    },
                    userEmail: {
                        email: "Please enter a valid email address",
                        remote: "Email is already in use"
                    },
                    agree: "Please accept our policy"
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
            } );

            $.validator.addMethod("strong_password", function (value, element) {
                let password = value;
                if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&?])(.{8,20}$)/.test(password))) {
                    return false;
                }
                return true;
            }, function (value, element) {
                let password = $(element).val();
                if (!(/^(.{8,20}$)/.test(password))) {
                    return 'Password must be between 8 to 20 characters long.';
                }
                else if (!(/^(?=.*[A-Z])/.test(password))) {
                    return 'Password must contain at least one uppercase.';
                }
                else if (!(/^(?=.*[a-z])/.test(password))) {
                    return 'Password must contain at least one lowercase.';
                }
                else if (!(/^(?=.*[0-9])/.test(password))) {
                    return 'Password must contain at least one digit.';
                }
                else if (!(/^(?=.*[!@#$%^&?])/.test(password))) {
                    return "Password must contain special characters from @#$%&.";
                }
                return false;
            });
            $.validator.addMethod("numbersonly", function (value, element) {
                let password = value;
                if (!(/^[0-9]+$/i.test(password))) {
                    return false;
                }
                return true;
            }); 

        } );
        
        $("#userPwd").passtrength({
            passwordToggle:true,
            eyeImg:"img/svg/eye.svg"
        });

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

</html>