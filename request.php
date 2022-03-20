<?php include 'header.php'; ?>
                            
    <!-- Begin Page Content -->
    <div class="col d-flex flex-column px-4">
    <?php if($_SESSION["userType"] === "Resident"): ?>
        <!-- Page Heading --> 
        <div class="d-sm-flex align-items-center justify-content-between">  
            <h3 class="font-weight-bold text-dark">Request Form </h3> 
            
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md">
                <div class="container-fluid">
                <div class="shadow p-4 border border-4" style="border-color: #3c4a56;">    
                    <form class="form-group" action="includes/request.inc.php" method="POST" >
                        <section>
                            <strong>Request Document</strong>
                            <div class="row p-2">
                                <div class="col-lg-6 m-1">
                                    <label>Choose document:</label>
                                    <select name="document" id="document" class="form-control w-75 form-control-md form-select" onChange="changecat(this.value);" name="document" required>
                                        <option value="" hidden selected>Select</option>
                                        <option value="Cedula">Cedula</option>
                                        <option value="Barangay Clearance">Barangay Clearance</option>
                                    </select>
                                </div>
                                <div class="col-lg-5 m-1">
                                    <label>Purpose:</label>
                                    <select name="purpose" id="purpose" class="form-control w-75 form-control-md form-select" required>
                                        <option value="" hidden selected>Select</option>
                                    </select>
                                </div>
                                <div class="col-lg-5 m-1">
                                    <label>Mode of Payment</label>
                                    <select name="modeofPayment" id="modeofPayment" class="form-control w-75 form-control-md form-select" required>
                                        <option value="" hidden selected>Select</option>
                                        <option value="Cash on Claim">Cash on Claim</option>
                                        <option value="Cash on Delivery">Cash on Delivery</option>
                                    </select>
                                </div>
                            </div>
                            <?php
                                if(isset($_GET["error"])){
                                    if($_GET["error"] == "none"){
                                        echo "<div class='alert alert-success' role='alert'>
                                        Your request has been submitted! You can check the status of your 
                                        request on your profile.
                                        </div>";
                                    }
                                    if($_GET["error"] == "pendingReq"){
                                        echo "<div class='alert alert-danger' role='alert'>
                                        Your request has been denied! You still have a pending document 
                                        in queue.
                                        </div>";
                                    }
                                }
                            ?>
                        </section>
                        <br>

                        <div class="m-3 p-3 text-right">
                            <button name="submit" class="btn btn-primary border" type="submit">Continue</button>
                        </div>
                    </form>

                    
                </div>
                </div>
                <!-- End of Nonvoter - Request Form -->
            </div>
        </div>
        <!--End of Content Row-->
                                        
    </div>

    <?php elseif($_SESSION["userType"] == "Treasurer"): ?>
        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Requests - Pending(<?php echo $_SESSION['userBarangay'] ?>)</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th>Requester</th>
                                <th>Document Type</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                $requests = $conn->query("SELECT request.*, concat(users.Firstname, ' ', users.Lastname) as name, 
                                DATE_FORMAT(requestedOn, '%m/%d/%Y %h:%i %p') as requestedDate, 
                                DATE_FORMAT(approvedOn, '%m/%d/%Y %h:%i %p') as approvedDate, 
                                users.userType, users.profile_pic 
                                FROM request 
                                INNER JOIN users 
                                ON request.UsersID=users.UsersID 
                                WHERE request.status='Releasing' 
                                AND request.userPurok='{$_SESSION['userPurok']}' 
                                AND request.userBarangay='{$_SESSION['userBarangay']}' 
                                AND request.userType='{$_SESSION['userType']}'");
                                while($row=$requests->fetch_assoc()):
                                    if($row["userType"] == "Admin"){
                                        continue;
                                    }
                            ?>
                            <tr>
                                <td>
                                    <img class="img-profile rounded-circle <?php 
                                        if($row["userType"] == "Resident"){
                                            echo "img-res-profile";
                                        }
                                        elseif($row["userType"] == "Purok Leader"){
                                            echo "img-purokldr-profile";
                                        }
                                        elseif($row["userType"] == "Captain"){
                                            echo "img-capt-profile";
                                        }
                                        elseif($row["userType"] == "Secretary"){
                                            echo "img-sec-profile";
                                        }
                                        elseif($row["userType"] == "Treasurer"){
                                            echo "img-treas-profile";
                                        }
                                        elseif($row["userType"] == "Admin"){
                                            echo "img-admin-profile";
                                        }
                                    ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                    <br>
                                    <?php echo $row["name"] ?>
                                </td>
                                <td><?php echo $row["documentType"] ?></td>
                                <td><?php echo $row['amount'] ?></td>
                                <td><?php if($row["status"] != NULL){echo $row["status"];} else{echo "Pending";} ?></td>
                                <td>
                                    <button class="btn btn-success paid_request" data-id="<?php echo $row['RequestID'] ?>"><i class="fas fa-check"></i> Paid</button>
                                    <a target="_blank" href="<?php echo $row["requesturl"]?>"><button class="btn btn-primary"><i class="fas fa-money-check"></i> Gcash link</button></a>
                                </td>
                                <!--Right Options-->
                            </tr>
                            <?php endwhile; ?>
                            <!--Row 1-->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End of Card Body-->              
        </div>
    <!-- End of Begin Page Content -->
    <?php elseif($_SESSION["userType"] == "Secretary"): ?>
        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Requests - Pending(<?php echo $_SESSION['userBarangay'] ?>)</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th scope="col">Name</th>
                                <th scope="col">Document Type</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Date Requested</th>
                                <th scope="col">Status</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                $requests = $conn->query("SELECT request.*, concat(users.Firstname, ' ', users.Lastname) as name, 
                                DATE_FORMAT(requestedOn, '%m/%d/%Y %h:%i %p') as requestedDate, 
                                DATE_FORMAT(approvedOn, '%m/%d/%Y %h:%i %p') as approvedDate, users.userType, 
                                users.profile_pic 
                                FROM request 
                                INNER JOIN users 
                                ON request.UsersID=users.UsersID 
                                WHERE request.status='Approved' 
                                AND request.userPurok='{$_SESSION['userPurok']}' 
                                AND request.userBarangay='{$_SESSION['userBarangay']}' 
                                AND request.userType='{$_SESSION['userType']}'");
                                while($row=$requests->fetch_assoc()):
                                    if($row["userType"] == "Admin"){
                                        continue;
                                    }
                            ?>
                            <tr>
                                <td>
                                    <img class="img-profile rounded-circle <?php 
                                        if($row["userType"] == "Resident"){
                                            echo "img-res-profile";
                                        }
                                        elseif($row["userType"] == "Purok Leader"){
                                            echo "img-purokldr-profile";
                                        }
                                        elseif($row["userType"] == "Captain"){
                                            echo "img-capt-profile";
                                        }
                                        elseif($row["userType"] == "Secretary"){
                                            echo "img-sec-profile";
                                        }
                                        elseif($row["userType"] == "Treasurer"){
                                            echo "img-treas-profile";
                                        }
                                        elseif($row["userType"] == "Admin"){
                                            echo "img-admin-profile";
                                        }
                                    ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                    <br>
                                    <?php echo $row["name"] ?>
                                </td>
                                <td><?php echo $row["documentType"] ?></td>
                                <td><?php echo $row["purpose"] ?></td>
                                <td><?php echo $row["requestedDate"] ?></td>
                                <td><?php if($row["status"] != NULL){echo $row["status"];} else{echo "Pending";} ?></td>
                                <td>
                                    <a href="includes/request.inc.php?release=<?php echo $row["RequestID"] ?>">
                                        <button class="btn btn-success"><i class="fas fa-check"></i> Release</button>
                                        <button class="btn btn-warning"><i class="fas fa-check"></i> Print</button>
                                    </a>
                                </td>
                                <!--Right Options-->
                            </tr>
                            <?php endwhile; ?>
                            <!--Row 1-->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End of Card Body-->
        </div>                   
        <!--End of Card--> 
        <div class="card shadow mb-4 m-4">
        <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Requests - Approved</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th scope="col">Name</th>
                                <th scope="col">Document Type</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Date Requested</th>
                                <th scope="col">Status</th>
                                <th scope="col">Managed By</th>
                                <th scope="col">Date Managed</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                $requests = $conn->query("SELECT request.*, concat(users.Firstname, ' ', users.Lastname) 
                                as name, DATE_FORMAT(requestedOn, '%m/%d/%Y %h:%i %p') as requestedDate, 
                                DATE_FORMAT(approvedOn, '%m/%d/%Y %h:%i %p') as approvedDate, users.userType, 
                                users.profile_pic FROM request INNER JOIN users ON request.UsersID=users.UsersID 
                                WHERE request.status='Approved' AND request.userPurok='{$_SESSION['userPurok']}' 
                                AND request.userBarangay='{$_SESSION['userBarangay']}'");
                                while($row=$requests->fetch_assoc()):
                                    if($row["userType"] == "Admin"){
                                        continue;
                                    }
                            ?>
                            <tr>
                                <td>
                                    <img class="img-profile rounded-circle <?php 
                                        if($row["userType"] == "Resident"){
                                            echo "img-res-profile";
                                        }
                                        elseif($row["userType"] == "Purok Leader"){
                                            echo "img-purokldr-profile";
                                        }
                                        elseif($row["userType"] == "Captain"){
                                            echo "img-capt-profile";
                                        }
                                        elseif($row["userType"] == "Secretary"){
                                            echo "img-sec-profile";
                                        }
                                        elseif($row["userType"] == "Treasurer"){
                                            echo "img-treas-profile";
                                        }
                                        elseif($row["userType"] == "Admin"){
                                            echo "img-admin-profile";
                                        }
                                    ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                    <br>
                                    <?php echo $row["name"] ?>
                                </td>
                                <td><?php echo $row["documentType"] ?></td>
                                <td><?php echo $row["purpose"] ?></td>
                                <td><?php echo $row["requestedDate"] ?></td>
                                <td><?php if($row["status"] != NULL){echo $row["status"];} else{echo "Pending";} ?></td>
                                <td><?php if($row["approvedBy"] != NULL){echo $row["approvedBy"];} else{echo "None";} ?></td>
                                <td><?php if($row["approvedOn"] != NULL){echo $row["approvedDate"];} else{echo "None";} ?></td>
                                <!--Right Options-->
                            </tr>
                            <?php endwhile; ?>
                            <!--Row 1-->
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- End of Card Body-->
        </div>      
    </div>       

    <?php elseif($_SESSION["userType"] != "Resident"): ?>
        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Requests - Pending(<?php echo $_SESSION['userBarangay'] ?>)</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th scope="col">Name</th>
                                <th scope="col">Document Type</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Date Requested</th>
                                <th scope="col">Status</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                $requests = $conn->query("SELECT request.*, concat(users.Firstname, ' ', users.Lastname) as name, 
                                DATE_FORMAT(requestedOn, '%m/%d/%Y %h:%i %p') as requestedDate, 
                                DATE_FORMAT(approvedOn, '%m/%d/%Y %h:%i %p') as approvedDate, users.userType, 
                                users.profile_pic 
                                FROM request 
                                INNER JOIN users 
                                ON request.UsersID=users.UsersID 
                                WHERE request.status='Pending' 
                                AND request.userPurok='{$_SESSION['userPurok']}' 
                                AND request.userBarangay='{$_SESSION['userBarangay']}' 
                                AND request.userType='{$_SESSION['userType']}'");
                                while($row=$requests->fetch_assoc()):
                                    if($row["userType"] == "Admin"){
                                        continue;
                                    }
                            ?>
                            <tr>
                                <td>
                                    <img class="img-profile rounded-circle <?php 
                                        if($row["userType"] == "Resident"){
                                            echo "img-res-profile";
                                        }
                                        elseif($row["userType"] == "Purok Leader"){
                                            echo "img-purokldr-profile";
                                        }
                                        elseif($row["userType"] == "Captain"){
                                            echo "img-capt-profile";
                                        }
                                        elseif($row["userType"] == "Secretary"){
                                            echo "img-sec-profile";
                                        }
                                        elseif($row["userType"] == "Treasurer"){
                                            echo "img-treas-profile";
                                        }
                                        elseif($row["userType"] == "Admin"){
                                            echo "img-admin-profile";
                                        }
                                    ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                    <br>
                                    <?php echo $row["name"] ?>
                                </td>
                                <td><?php echo $row["documentType"] ?></td>
                                <td><?php echo $row["purpose"] ?></td>
                                <td><?php echo $row["requestedDate"] ?></td>
                                <td><?php if($row["status"] != NULL){echo $row["status"];} else{echo "Pending";} ?></td>
                                <td><a href="includes/request.inc.php?approveID=<?php echo $row["RequestID"] ?>">
                                <i class="fas fa-check fa-2x"></i></a>/ 
                                <a href="includes/request.inc.php?declineID=<?php echo $row["RequestID"] ?>">
                                <i class="fas fa-times fa-2x"></i></a></td>
                                <!--Right Options-->
                            </tr>
                            <?php endwhile; ?>
                            <!--Row 1-->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End of Card Body-->
        </div>                   
        <!--End of Card--> 
        <div class="card shadow mb-4 m-4">
        <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Requests - Approved</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th scope="col">Name</th>
                                <th scope="col">Document Type</th>
                                <th scope="col">Purpose</th>
                                <th scope="col">Date Requested</th>
                                <th scope="col">Status</th>
                                <th scope="col">Managed By</th>
                                <th scope="col">Date Managed</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                $requests = $conn->query("SELECT request.*, concat(users.Firstname, ' ', users.Lastname) 
                                as name, DATE_FORMAT(requestedOn, '%m/%d/%Y %h:%i %p') as requestedDate, 
                                DATE_FORMAT(approvedOn, '%m/%d/%Y %h:%i %p') as approvedDate, users.userType, 
                                users.profile_pic FROM request INNER JOIN users ON request.UsersID=users.UsersID 
                                WHERE request.status='Approved' AND request.userPurok='{$_SESSION['userPurok']}' 
                                AND request.userBarangay='{$_SESSION['userBarangay']}'");
                                while($row=$requests->fetch_assoc()):
                                    if($row["userType"] == "Admin"){
                                        continue;
                                    }
                            ?>
                            <tr>
                                <td>
                                    <img class="img-profile rounded-circle <?php 
                                        if($row["userType"] == "Resident"){
                                            echo "img-res-profile";
                                        }
                                        elseif($row["userType"] == "Purok Leader"){
                                            echo "img-purokldr-profile";
                                        }
                                        elseif($row["userType"] == "Captain"){
                                            echo "img-capt-profile";
                                        }
                                        elseif($row["userType"] == "Secretary"){
                                            echo "img-sec-profile";
                                        }
                                        elseif($row["userType"] == "Treasurer"){
                                            echo "img-treas-profile";
                                        }
                                        elseif($row["userType"] == "Admin"){
                                            echo "img-admin-profile";
                                        }
                                    ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                    <br>
                                    <?php echo $row["name"] ?>
                                </td>
                                <td><?php echo $row["documentType"] ?></td>
                                <td><?php echo $row["purpose"] ?></td>
                                <td><?php echo $row["requestedDate"] ?></td>
                                <td><?php if($row["status"] != NULL){echo $row["status"];} else{echo "Pending";} ?></td>
                                <td><?php if($row["approvedBy"] != NULL){echo $row["approvedBy"];} else{echo "None";} ?></td>
                                <td><?php if($row["approvedOn"] != NULL){echo $row["approvedDate"];} else{echo "None";} ?></td>
                                <!--Right Options-->
                            </tr>
                            <?php endwhile; ?>
                            <!--Row 1-->
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- End of Card Body-->
        </div>      
        </div>       
        
    <?php endif; ?>
    

</div>
<!-- End of Row -->
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog" role="document" style="border-color:#384550 ;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-dark" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>


    <script>

    window.start_load = function(){
	    $('body').prepend('<div id="preloader2"></div>')
        }
        window.end_load = function(){
            $('#preloader2').fadeOut('fast', function() {
                $(this).remove();
            })
        }
        window.viewer_modal = function($src = ''){
            start_load()
            var t = $src.split('.')
            t = t[1]
            if(t =='mp4'){
            var view = $("<video src='"+$src+"' controls autoplay></video>")
            }else{
            var view = $("<img src='"+$src+"' />")
            }
            $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
            $('#viewer_modal .modal-content').append(view)
            $('#viewer_modal').modal({
                    show:true,
                    backdrop:'static',
                    keyboard:false,
                    focus:true
                })
                end_load()  
	}
	window.uni_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#uni_modal .modal-title').html($title)
                    $('#uni_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#uni_modal .modal-dialog').addClass($size)
                    }else{
                        $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                    }
                    $('#uni_modal').modal({
                        show:true,
                        backdrop:'static',
                        keyboard:false,
                        focus:true
                    })
                    end_load()
                }
            }
        })
    }
    window._conf = function($msg='',$func='',$params = []){
        $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
        $('#confirm_modal .modal-body').html($msg)
        $('#confirm_modal').modal('show')
    }
    window.alert_toast= function($msg = 'TEST',$bg = 'success' ,$pos=''){
        var Toast = Swal.mixin({
        toast: true,
        position: $pos || 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
        Toast.fire({
        icon: $bg,
        title: $msg
        })
    }

    $('.paid_request').click(function(){
        _conf("Confirm the request is paid?","paid_request",[$(this).attr('data-id')])
    })
    function paid_request($id){
        start_load()
        $.ajax({
            url:'includes/request.inc.php?paid',
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }
    
    var mealsByCategory = {
        Cedula: ["Employment", "Work", "Registering a new business", 
                "Filing Income Tax Returns", "License", "Receipts", 
                "Proof of Residency", "Others"],
        "Barangay Clearance": ["Employment", "Scholarship", "Financial Assistance",
                                "Educational Assistance", "Work", "For business permit",
                                "Postal ID", "Solo Parent ID", "Others"],
    }

    function changecat(value) {
        if (value.length == 0) document.getElementById("purpose").innerHTML = "<option></option>";
        else {
            var catOptions = "";
            for (categoryId in mealsByCategory[value]) {
                catOptions += "<option>" + mealsByCategory[value][categoryId] + "</option>";
            }
            document.getElementById("purpose").innerHTML = catOptions;
        }
    }
    $(document).ready(function() {
        $('#dataTable').DataTable();
    } );
    
    $(document).ready(function() {
        $('#dataTable2').DataTable();
    } );

    
    </script>

    <?php include 'footer.php'; ?>

    