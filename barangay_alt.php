<?php 
include_once "header.php";
$sql = $conn->query("SELECT * FROM ");

?>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card shadow m-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-dark">Barangay Paknaan</h6>
                </div>
                <div class="card-body">
                    <div class="text-center text-dark">
                        <div class="user-avatar w-100 d-flex justify-content-center">
                            <span class="position-relative">
                                <img src="img/<?php echo $_SESSION["profile_pic"]; ?>" alt="Maxwell Admin" class="img-fluid img-thumbnail rounded-circle <?php 
                                    if($_SESSION["userType"] == "Resident"){
                                        echo "img-res-profile";
                                    }
                                    elseif($_SESSION["userType"] == "Purok Leader"){
                                        echo "img-purokldr-profile";
                                    }
                                    elseif($_SESSION["userType"] == "Captain"){
                                        echo "img-capt-profile";
                                    }
                                    elseif($_SESSION["userType"] == "Secretary"){
                                        echo "img-sec-profile";
                                    }
                                    elseif($_SESSION["userType"] == "Treasurer"){
                                        echo "img-treas-profile";
                                    }
                                    elseif($_SESSION["userType"] == "Admin"){
                                        echo "img-admin-profile";
                                    }
                                ?>" style="width:150px; height:150px">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#ppModal" class="text-dark position-absolute rounded-circle img-thumbnail d-flex justify-content-center align-items-center" style="top:75%;left:75%;width:30px;height: 30px">
                                    <i class="fas fa-camera"></i>
                                </a>
                            </span>
                        </div>
                        <div class="mt-2">
                            <h5 class="font-weight-bold"><?php echo $name ?></h5>
                            <h6 readonly><?php echo $_SESSION["emailAdd"]; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow m-4">
                <div class="card-header">
                    test
                </div>
                <div class="card-body">
                    test
                </div>
                <div class="card-footer">
                    test
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "footer.php" ?>