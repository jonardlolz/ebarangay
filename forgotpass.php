<?php 
include 'includes/dbh.inc.php';
session_start(); 
session_unset();
session_destroy();
?>

<?php if(isset($_POST['secretAnswer'])){

    $sqlAnswer = $conn->query("SELECT * FROM users WHERE username='{$_GET['username']}'");
    $sqlData = $sqlAnswer->fetch_assoc();

    if($sqlData['secretAnswer'] == $_POST['secretAnswer']){
        header("location: forgotpass.php?changePass&UsersID={$sqlData['UsersID']}");
    }
    else{
        header("location: forgotpass.php?wrong&username={$_GET['username']}");
    }
}
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

        <div class="container-fluid">
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
                                        <?php 
                                        if(isset($_GET['username'])):
                                            $sql = $conn->query("SELECT * FROM users WHERE username='{$_GET['username']}'"); 
                                            $row_cnt = $sql->num_rows;?>
                                            <div class="text-center">
                                                <h1 class="text-dark-900 mb-4 text-dark">Forgot Password</h1>
                                            </div>
                                            <?php if($row_cnt <= 0): ?>
                                                <div class="row">
                                                    <p class="h-2">Please enter your username below: </p>
                                                </div>
                                                <form action="forgotpass.php" class="user" method="GET" autocomplete="off">
                                                    <div class="form-group" style="margin-botton: 500px;">
                                                        <input type="text" class="form-control form-control-user"
                                                            id="Username" name="username" aria-describedby="emailHelp"
                                                            placeholder="Enter Username" required>
                                                    </div>
                                                    <?php if($row_cnt <= 0): ?>
                                                    <div class="alert alert-danger">Account does not exist</div>
                                                    <?php endif; ?>
                                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    Submit
                                                    </button>
                                                </form>
                                                <?php else: ?>
                                                <?php $data = $sql->fetch_assoc(); ?>
                                                    <div class="row">
                                                        <p class="h-2"><strong><?php echo $data['secretQuestion'] ?></strong></p>
                                                    </div>
                                                    <form action="forgotpass.php?secretAnswer&username=<?php echo $_GET['username'] ?>" class="user" method="POST" autocomplete="off">
                                                        <div class="form-group" style="margin-botton: 500px;">
                                                            <input type="text" class="form-control form-control-user"
                                                                id="secretAnswer" name="secretAnswer" aria-describedby="secretAnswer"
                                                                placeholder="Secret Answer" required>
                                                        </div>
                                                        <?php if(isset($_GET['wrong'])): ?>
                                                        <div class="alert alert-danger">Wrong answer</div>
                                                        <?php endif; ?>
                                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                                        Submit
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                        <?php elseif(isset($_GET['changePass'])):?>
                                            <div class="text-center">
                                                <h1 class="text-dark-900 mb-4 text-dark">Forgot Password</h1>
                                            </div>
                                            <div class="row">
                                                <p class="h-2">Please enter a new password: </p>
                                            </div>
                                            <form id="changepass" action="includes/edit_account.inc.php?changePassPost=<?php echo $_GET['UsersID'] ?>" class="user" method="POST" autocomplete="off">
                                                <div class="form-group row" style="margin-botton: 500px;">
                                                    <input type="password" class="form-control form-control-user"
                                                    id="password" name="userPwd" placeholder="Enter Password" required>
                                                </div>
                                                <div class="form-group row" style="margin-botton: 500px;">
                                                    <input type="password" class="form-control form-control-user"
                                                    id="confirmPass" onkeyup="" name="userRptPwd" placeholder="Confirm Password" required>
                                                </div>
                                                <div id="alert" class="alert alert-danger" style="display: none;">Passwords do not match</div>
                                                <button type="button" onclick="checksame()" class="btn btn-primary btn-user btn-block">
                                                    Submit
                                                </button>
                                            </form>
                                            <script>
                                                function checksame(){
                                                    $pwd = $("#password").val();
                                                    $userRptPwd = $("#confirmPass").val();
                                                    if($pwd != $userRptPwd){
                                                        document.getElementById("alert").style.display="block";
                                                    }
                                                    else{
                                                        document.getElementById("alert").style.display="none";
                                                        $('#changepass').submit()
                                                    }
                                                }
                                            </script>
                                        <?php else: ?>
                                            <div class="text-center">
                                                <h1 class="text-dark-900 mb-4 text-dark">Forgot Password</h1>
                                            </div>
                                            <div class="row">
                                                <p class="h-2">Please enter your username below: </p>
                                            </div>
                                            <form action="forgotpass.php" class="user" method="GET" autocomplete="off">
                                                <div class="form-group" style="margin-botton: 500px;">
                                                    <input type="text" class="form-control form-control-user"
                                                        id="Username" name="username" aria-describedby="emailHelp"
                                                        placeholder="Enter Username" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Submit
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="login.php">Back to login</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="signup.php">Create an Account</a>
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