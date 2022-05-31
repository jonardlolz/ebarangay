<?php 
session_start(); 
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

        <title>eBarangay - Login</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link href="css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body>

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block">
                                    <div class="p-5 d-flex justify-content-center align-items-center">
                                        <img src="img/eb-logo.png" alt="EBARANGAY LOGO">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="text-dark-900 mb-4 text-dark">Welcome to EBARANGAY!</h1>
                                        </div>
                                        <form action="includes/login.inc.php" class="user" method="post" autocomplete="off">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user"
                                                    id="Username" name="username" aria-describedby="emailHelp"
                                                    placeholder="Enter Username" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user"
                                                    id="Password" placeholder="Password" required>
                                            </div>
                                            <?php
                                            if(isset($_GET["error"])){
                                                if($_GET["error"] == "none"){
                                                echo "<div class='alert alert-success' role='alert'>
                                                    You have signed up!
                                                    </div>";
                                                }
                                            }
                                            if(isset($_GET["error"])){
                                                if($_GET["error"] == "wrongpassword"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                    Wrong password!
                                                    </div>";
                                                }
                                            }
                                            if(isset($_GET["error"])){
                                                if($_GET["error"] == "wronglogin"){
                                                echo "<div class='alert alert-danger' role='alert'>
                                                    Username does not exist!
                                                    </div>";
                                                }
                                            }
                                            ?>
                                            <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                            </button>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="signup.php">Create an Account!</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="forgotpass.php">Forgot your password?</a>
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

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

    </body>

</html>