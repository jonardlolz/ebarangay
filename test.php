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
                                <form id="signupForm" method="post" class="form-horizontal" action="">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="firstname">First name</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="lastname">Last name</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="username">Username</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="email">Email</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="password">Password</label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="confirm_password">Confirm password</label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 offset-sm-4">
                                            <div class="form-check">
                                                <input type="checkbox" id="agree" name="agree" value="agree" class="form-check-input"/>
                                                <label class="form-check-label">Please agree to our policy</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-4">
                                            <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Sign up</button>
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
                alert( "submitted!" );
            }
        } );

        $( document ).ready( function () {
            $( "#signupForm" ).validate( {
                rules: {
                    firstname: "required",
                    lastname: "required",
                    username: {
                        required: true,
                        minlength: 2
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    agree: "required"
                },
                messages: {
                    firstname: "Please enter your firstname",
                    lastname: "Please enter your lastname",
                    username: {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 2 characters"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    confirm_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    },
                    email: "Please enter a valid email address",
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

        } );
        
        $("#password").passtrength({
            passwordToggle:true,
            eyeImg:"img/svg/eye.svg"
        });
    </script>

</html>