<?php 
include_once "header.php";
$sql = $conn->query("SELECT barangay.*, concat(users.Firstname, ' ', users.Lastname) as 
CaptainName FROM barangay JOIN users ON barangay.brgyCaptain = users.UsersID WHERE BarangayName = '{$_SESSION['userBarangay']}'");
$row = $sql->fetch_assoc();

?>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card shadow m-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-dark">
                        <div class="text-center text-dark">
                            <div class="user-avatar w-100 d-flex justify-content-center">
                                <span class="position-relative">
                                    <img src="img/<?php echo $row["barangay_pic"]; ?>" class="img-fluid img-thumbnail rounded-circle" style="width:150px; height:150px">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#ppModal" class="text-dark position-absolute rounded-circle img-thumbnail d-flex justify-content-center align-items-center" style="top:75%;left:75%;width:30px;height: 30px">
                                        <i class="fas fa-camera"></i>
                                    </a>
                                </span>
                            </div>
                            <div class="mt-2">
                                <h5 class="font-weight-bold">Barangay <?php echo $row['BarangayName'] ?></h5>
                            </div>
                        </div>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <b><label>Captain: </label></b>
                        </div>
                        <div class="col" style="text-align: right">
                            <label><?php echo $row['CaptainName'] ?></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <b><label>Municipality: </label></b>
                        </div>
                        <div class="col" style="text-align: right">
                            <label><?php echo $row['City'] ?></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <b><label>Province: </label></b>
                        </div>
                        <div class="col" style="text-align: right">
                            <label><?php echo $row['Province'] ?></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <b><label>Telephone: </label></b>
                        </div>
                        <div class="col" style="text-align: right">
                            <label><?php echo $row['brgyTelephone'] ?></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <b><label>Cellphone: </label></b>
                        </div>
                        <div class="col" style="text-align: right">
                            <label><?php echo $row['brgyCell'] ?></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <b><label>Email: </label></b>
                        </div>
                        <div class="col" style="text-align: right">
                            <label><?php echo $row['brgyEmail'] ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow m-4">
                <div class="card-header">
                    <b><label>Barangay Details</label></b>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="officials-tab" data-toggle="tab" href="#officials" role="tab" aria-controls="officials" aria-selected="true">Officials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="purok-tab" data-toggle="tab" href="#purok" role="tab" aria-controls="purok" aria-selected="false">Purok</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="officials" role="tabpanel" aria-labelledby="officials-tab">
                            <?php $i = 0; 
                                $officials = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users 
                                WHERE (userType='Captain' 
                                OR userType='Secretary' 
                                OR userType='Purok Leader'
                                OR userType='Treasurer')
                                AND userBarangay='{$_SESSION['userBarangay']}'"); ?>
                            <?php while($i < mysqli_num_rows($officials)): ?>
                            <div class="row">
                                <?php while($officalRow = $officials->fetch_assoc()): ?>
                                <div class="col-sm-4">
                                    <div class="card m-2">
                                        <div class="card-header">
                                            <div class="user-avatar w-100 d-flex justify-content-center">
                                                <span class="position-relative">
                                                    <img class="img-fluid rounded-circle <?php 
                                                    if($officalRow["userType"] == "Resident"){
                                                        echo "img-res-profile";
                                                    }
                                                    elseif($officalRow["userType"] == "Purok Leader"){
                                                        echo "img-purokldr-profile";
                                                    }
                                                    elseif($officalRow["userType"] == "Captain"){
                                                        echo "img-capt-profile";
                                                    }
                                                    elseif($officalRow["userType"] == "Secretary"){
                                                        echo "img-sec-profile";
                                                    }
                                                    elseif($officalRow["userType"] == "Treasurer"){
                                                        echo "img-treas-profile";
                                                    }
                                                    elseif($officalRow["userType"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/<?php echo $officalRow['profile_pic'] ?>" style="width:100px; height:100px">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center">
                                            <h4 class="card-title"><?php echo $officalRow['name'] ?></h4>
                                            <p class="card-text"><?php echo $officalRow['userType'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; if($i % 3 == 0){ break; } endwhile; ?>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <div class="tab-pane fade" id="purok" role="tabpanel" aria-labelledby="purok-tab">
                            <div class="card m-2">
                                <div class="card-header">
                                    <b><label>Puroks in Barangay <?php echo $_SESSION['userBarangay'] ?></label></b>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center text-dark" 
                                            id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                            <thead>
                                                <tr class="bg-gradient-secondary text-white">
                                                    <th scope="col">Purok</th>
                                                    <th scope="col">Active</th> 
                                                    <th>Purok Leader</th>
                                                    <th scope="col">Edit</th>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <!--Row 1-->
                                                <?php 
                                                    $purok = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name from purok LEFT JOIN users ON purok.purokLeader = users.UsersID WHERE BarangayName='{$_SESSION['userBarangay']}'");
                                                    while($row=$purok->fetch_assoc()):
                                                ?>
                                                <tr>
                                                    <td><?php echo $row["PurokName"] ?></td>
                                                    <td><?php echo $row["Active"] ?></td>
                                                    <td><?php if($row['name'] != NULL){echo $row['name'];}else{ echo "None"; } ?></td>
                                                    <td>
                                                        <a class="fas fa-edit fa-md mr-2 text-gray-600 edit_purok" data-id="<?php echo $row['PurokID'] ?>" href="javascript:void(0)"></a>
                                                    </td>
                                                    
                                                    <!--Right Options-->
                                                </tr>
                                                <?php endwhile; ?>
                                                <!--Row 1-->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ppModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="includes/upload.inc.php?brgyPic" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog modal-fullscreen-sm-down border border-0" role="document" style="border-color:#384550 ;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Manage Profile Picture</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="pp" accept="image/*" onchange="displayImgProfile(this,$(this))">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group d-flex justify-content-center rounded-circle">
                            <img src="img/<?php echo $row["barangay_pic"]; ?>" alt="" id="profile" class="img-fluid img-thumbnail rounded-circle" style="max-width: calc(50%)">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-dark" name="submit" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function displayImgProfile(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#profile').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
</script>

<?php include_once "footer.php" ?>