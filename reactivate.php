<?php 
    include 'includes/dbh.inc.php';
    ini_set('display_errors', true);
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();

    $userSql=$conn->query("SELECT * FROM users WHERE UsersID={$_SESSION['UsersID']}")->fetch_assoc();
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
                                            <h1 class="text-dark-900 mb-4 text-dark">Welcome back to EBARANGAY!</h1>
                                        </div>
                                        <div class="alert alert-warning">
                                            <p><b>Your account has been previously deactivated.</b></p>
                                            <p>To reactivate your account, please press the reactivate account button. Afterwards, you will be able to use the site like you used to.</p>
                                        </div>
                                        <div class="footer" style="margin-top: 10px;">
                                            <div class="d-flex flex-row-reverse">
                                                <a href="includes/account.inc.php?activateAccount&UsersID=<?php echo $userSql['UsersID'] ?>">
                                                    <button class="btn btn-success btn-sm">Reactivate my account</button>
                                                </a>
                                            </div>
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