<?php 
include 'includes/dbh.inc.php';
session_start(); 

$sql = $conn->query("SELECT * FROM users WHERE UsersID={$_GET['UsersID']}");
$userCheck = $sql->fetch_assoc();

session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>eBarangay - Unverified</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <!-- Custom styles for this template-->
        <link rel="stylesheet" href="css/multistepform.css">
        <link href="css/sb-admin-2.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon/favicon.ico">
        <link rel="icon" type="image/gif" href="img/favicon/favicon-32x32.png">

        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script type="text/javascript" src="node_modules/form-validation/lib/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="node_modules/form-validation/dist/jquery.validate.js"></script>
        <script src="node_modules/Visual-Password-Strength-Indicator-Plugin-For-jQuery-Passtrength-js/src/jquery.passtrength.js"></script>
        <link rel="stylesheet" href="node_modules/Visual-Password-Strength-Indicator-Plugin-For-jQuery-Passtrength-js/src/passtrength.css">

        <style>
            #progressbar li {
                list-style-type: none;
                font-size: 15px;
                width: 33.33%;
                float: left;
                position: relative;
                font-weight: 400;
            }
        </style>
    </head>

    <body>

        <div class="container-fluid">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
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
                                            <h1 class="mb-4 text-capitalize">Unverified Account!</h1>
                                        </div>
                                        <div class="alert alert-danger">
                                            Your account was unverified by your local Purok Leader for the specified reason:
                                            <br>
                                            <br>
                                            <b>
                                            <?php $report = $conn->query("SELECT * FROM userreport  WHERE barangay='{$userCheck['userBarangay']}' AND reportStatus='Unverify' AND purok='{$userCheck['userPurok']}' AND UsersID={$_GET['UsersID']} LIMIT 1 "); 
                                            $reportMessage = $report->fetch_assoc();
                                            echo $reportMessage['reportMessage'];
                                            ?>
                                            </b>
                                            <br>
                                            <br>
                                            Please resubmit your registration and requirement as requested.
                                        </div>
                                        <form id="msform" method="post" autocomplete="off" class="form-horizontal" action="includes/signup.inc.php?update&UsersID=<?php echo $userCheck['UsersID'] ?>" enctype="multipart/form-data">
                                            <ul id="progressbar">
                                                <li class="active" id="personal"><strong>Personal</strong></li>
                                                <li id="address"><strong>Address</strong></li>
                                                <li id="verification"><strong>Verification</strong></li>
                                            </ul>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <br>
                                            <fieldset>
                                                <div class="form-card">
                                                    <div>
                                                        <strong>Personal Information</strong>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control form-control-user"
                                                                id="userFirstname" value="<?php echo $userCheck['Firstname'] ?>" placeholder="First name" name="userFirstname" required>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control form-control-user"
                                                                id="userMiddlename" value="<?php echo $userCheck['Middlename'] ?>" placeholder="Middle name" name="userMiddlename">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control form-control-user"
                                                                id="userLastname" value="<?php echo $userCheck['Lastname'] ?>" placeholder="Last name" name="userLastname" required>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control form-control-user"
                                                                id="userSuffix" placeholder="Suffix" name="userSuffix" list="suffixList" value="<?php echo $userCheck['userSuffix'] ?>">
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
                                                            <input type="text" onchange="dateResideChange(this.value)" max="<?php echo date('Y-m-d') ?>" class="form-control form-control-user" placeholder="Birthdate" id="userDOB" name="userDOB" onblur="(this.type='text')" value="<?php echo $userCheck['dateofbirth'] ?>" onfocus="(this.type='date')" required>
                                                        </div>
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <select class="custom-select" id="userCivilStat" placeholder="Civil Status" name="userCivilStat" required>
                                                                <option value="<?php echo $userCheck['userGender'] ?>" hidden selected><?php echo $userCheck['userGender'] ?></option>
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
                                                                <option value="<?php echo $userCheck['userGender'] ?>" hidden selected><?php echo $userCheck['userGender'] ?></option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="col">
                                                            <select class="custom-select" onchange="voterchange(this.value)" id="isvoter" name="isvoter" required>
                                                                <option value="<?php echo $userCheck['IsVoter'] ?>" hidden selected><?php if($userCheck['IsVoter'] == "True"){ echo "Yes"; }else{ echo "No"; } ?></option>
                                                                <option value="True">Yes</option>
                                                                <option value="False">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="d-flex flex-row-reverse">
                                                    <input type="button" name="next" class="btn btn-lg m-2 btn-primary next" value="Next"/>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card">
                                                    <div>
                                                        <strong>Address Information</strong>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <select name="userBarangay" id="userBarangay" class="custom-select" onfocus="changecat(this.value);" onChange="changecat(this.value);" required>
                                                                <option value="<?php echo $userCheck['userBarangay'] ?>" hidden selected><?php echo $userCheck['userBarangay'] ?></option>
                                                                <?php $barangay = $conn->query("SELECT * FROM barangay WHERE Status='Active'");
                                                                while($brow = $barangay->fetch_assoc()): ?>
                                                                <option value="<?php echo $brow['BarangayName'] ?>"><?php echo $brow['BarangayName'] ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <select class="custom-select" id="userPurok" placeholder="Purok" name="userPurok" required>
                                                                <option value="<?php echo $userCheck['userPurok'] ?>" selected hidden><?php echo $userCheck['userPurok'] ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <input type="text" value="<?php echo $userCheck['userHouseNum'] ?>" class="form-control form-control-user" id="userHouseNum"
                                                                placeholder="House #" name="userHouseNum" required>
                                                        </div>
                                                        <div class="col">
                                                            <input type="text" value="<?php echo $userCheck['startedLiving'] ?>" max="<?php echo date('Y-m-d') ?>" class="form-control form-control-user" placeholder="Date Resided" id="userDateReside" name="userDateReside" onblur="(this.type='text')" onfocus="(this.type='date')" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <select class="custom-select" onchange="lesseechange(this.value)" id="islessee" name="islessee" required>
                                                                <option value="<?php echo $userCheck['isRenting'] ?>" hidden selected><?php if($userCheck['isRenting'] == "True"){ echo "Yes"; }else{ echo "No"; } ?></option>
                                                                <option value="True">Yes</option>
                                                                <option value="False">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="d-flex flex-row-reverse">
                                                    <input type="button" name="next" class="btn btn-lg m-2 btn-primary next" value="Next"/>
                                                    <input type="button" name="previous" class="btn btn-lg m-2 btn-secondary previous" value="Previous"/>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-card">
                                                    <div>
                                                        <strong>Verification</strong>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label for="customFile">Attach your profile picture</label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="custom-file">
                                                                <input type="file" class="form-control" id="userPicture" name="userPicture" accept="image/*" placeholder="Attach your profile picture" required>
                                                            </div>
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
                                                    <hr class="mt-4">
                                                    <div class="form-group row pl-4">
                                                        <input class="form-check-input" type="checkbox" id="agree" name="agree">
                                                        <label class="form-check-label">I hereby declare that the information provided is true and correct. I also understand that any willful
                                                        dishonesty may render for refusal of this registration. I also understand I am entitled to update and correct the above information.</label>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="d-flex flex-row-reverse">
                                                    <input type="submit" name="submit" class="btn btn-lg m-2 btn-success" value="Submit"/>
                                                    <input type="button" name="previous" class="btn btn-lg m-2 btn-secondary previous" value="Previous"/>
                                                </div>
                                            </fieldset>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="login.php">Already have an account? Login!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <!-- End of Outer Row-->
            </div>

        </div>
        <!--End of Container-->

        <!-- Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto text-dark">
                    <span>Copyright &copy; EBARANGAY 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
        <script type="text/javascript">

            function dateResideChange(value){
                document.getElementById("userDateReside").setAttribute("min", value);
            }

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
            

            $.validator.setDefaults( {
                submitHandler: function () {
                    $("form#msform").submit()
                }
            } );

            $( document ).ready( function () {
                var current_fs, next_fs, previous_fs; //fieldsets
                var opacity;
                var current = 1;
                var steps = $("fieldset").length;

                setProgressBar(current);
                // $("#msform").valid()
                $(".next").click(function(){
                    if($("#msform").valid()){
                        current_fs = $(this).parent().parent();
                        next_fs = $(this).parent().parent().next();
                        
                        //Add Class Active
                        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                        
                        //show the next fieldset
                        next_fs.show(); 
                        //hide the current fieldset with style
                        current_fs.animate({opacity: 0}, {
                            step: function(now) {
                                // for making fielset appear animation
                                opacity = 1 - now;

                                current_fs.css({
                                    'display': 'none',
                                    'position': 'relative'
                                });
                                next_fs.css({'opacity': opacity});
                            }, 
                            duration: 500
                        });
                        setProgressBar(++current);
                    }
                });

                $(".previous").click(function(){
                    
                    current_fs = $(this).parent().parent();
                    previous_fs = $(this).parent().parent().prev();
                    
                    //Remove class active
                    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                    
                    //show the previous fieldset
                    previous_fs.show();

                    //hide the current fieldset with style
                    current_fs.animate({opacity: 0}, {
                        step: function(now) {
                            // for making fielset appear animation
                            opacity = 1 - now;

                            current_fs.css({
                                'display': 'none',
                                'position': 'relative'
                            });
                            previous_fs.css({'opacity': opacity});
                        }, 
                        duration: 500
                    });
                    setProgressBar(--current);
                });

                function setProgressBar(curStep){
                    var percent = parseFloat(100 / steps) * curStep;
                    percent = percent.toFixed();
                    $(".progress-bar")
                    .css("width",percent+"%")   
                }

                $(".submit").click(function(){
                    return false;
                })

                //Validation section
                $( "#msform" ).validate( {
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
                        userMiddlename: {
                            required: true
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
                        userMiddlename: {
                            required: "Please enter '-' if no middle name"
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

            function displayUpload(input){
                if (input.files) {
                Object.keys(input.files).map(function(k){
                    var reader = new FileReader();
                        var t = input.files[k].type;
                        var _types = ['video/mp4','image/x-png','image/png','image/gif','image/jpeg','image/jpg'];
                        if(_types.indexOf(t) == -1)
                            return false;
                        reader.onload = function (e) {
                            // $('#cimg').attr('src', e.target.result);
                        var bin = e.target.result;
                        var fname = input.files[k].name;
                        var imgF = document.getElementById('img-clone');
                            imgF = imgF.cloneNode(true);
                            imgF.removeAttribute('id')
                            imgF.removeAttribute('style')
                            if(t == "video/mp4"){
                                var img = document.createElement("video");
                                }else{
                                var img = document.createElement("img");
                                }
                                var fileinput = document.createElement("input");
                                var fileinputName = document.createElement("input");
                                fileinput.setAttribute('type','hidden')
                                fileinputName.setAttribute('type','hidden')
                                fileinput.setAttribute('name','img[]')
                                fileinputName.setAttribute('name','imgName[]')
                                fileinput.value = bin
                                fileinputName.value = fname
                                img.classList.add("imgDropped")
                                img.classList.add("img-fluid")
                                img.classList.add("rounded")
                                img.src = bin;
                                imgF.appendChild(fileinput);
                                imgF.appendChild(fileinputName);
                                imgF.appendChild(img);
                                document.querySelector('#file-display').appendChild(imgF)
                        }
                    reader.readAsDataURL(input.files[k]);
                    })
                    rem_func()
                }
            }
            function rem_func(_this){
                _this.closest('.imgF').remove();
                if($('#drop .imgF').length <= 0){
                    $('#drop').append('<span id="dname" class="text-center">Drop Files Here <br> or <br> <label for="chooseFile"><strong>Choose File</strong></label></span>')
                }
            }
        </script>
        
    </body>

</html>