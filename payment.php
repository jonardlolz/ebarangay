<?php include 'header.php'; ?>

<div class="col d-flex flex-column px-4">
    <div class="card shadow mb-4 m-4">
        <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Payments (<?php echo $_SESSION['userBarangay'] ?>)</h6>
        </div>
        
        <div class="card-body" style="font-size: 75%">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="erequest-tab" data-toggle="tab" href="#erequest" role="tab" aria-controls="erequest" aria-selected="true">eRequest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ereklamo-tab" data-toggle="tab" href="#ereklamo" role="tab" aria-controls="ereklamo" aria-selected="false">eReklamo</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="erequest" role="tabpanel" aria-labelledby="erequest-tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending payments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="paid-tab" data-toggle="tab" href="#paid" role="tab" aria-controls="paid" aria-selected="false">Paid</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="false">Request Form</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark" 
                                    id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th>Request ID</th>
                                            <th>Requester</th>
                                            <th>Document Type</th>
                                            <th>Amount</th>
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
                                            <td><?php echo $row["RequestID"] ?></td>
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
                                                <?php echo $row["name"]; ?>
                                            </td>
                                            <td><?php echo $row["documentType"] ?></td>
                                            <td><?php echo $row['amount'] ?></td>
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
                        <div class="tab-pane fade" id="paid" role="tabpanel" aria-labelledby="paid-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark" 
                                    id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th>Requester</th>
                                            <th>Document Type</th>
                                            <th>Amount</th>
                                            <th>Date Paid</th>
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
                                            WHERE request.status='Paid' 
                                            AND request.userPurok='{$_SESSION['userPurok']}' 
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
                                            <td><?php echo $row['amount'] ?></td>
                                            <td><?php echo $row['approvedOn'] ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">
                            <div class="container-fluid">
                                <section>
                                    <strong>Request Document</strong>
                                    <div class="row p-2">
                                        <div class="col-lg-6 m-1">
                                            <label>Choose document:</label>
                                            <select name="document" id="document" class="form-control w-75 form-control-md form-select" onChange="changecat(this.value);" required>
                                                <option value="" hidden selected>Select</option>
                                                <?php $requestSql = $conn->query("SELECT * FROM documenttype WHERE barangayName='{$_SESSION['userBarangay']}'");
                                                while($documents = $requestSql->fetch_assoc()): ?>
                                                <option value="<?php echo $documents['DocumentID'] ?>"><?php echo $documents['documentName'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-5 m-1">
                                            <label>Purpose:</label>
                                            <select name="purpose" id="purpose" class="form-control w-75 form-control-md form-select" required>
                                                <option value="" hidden selected>Select</option>
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
                                    <button class="btn btn-primary border continueRequest" data-id="<?php echo $_SESSION['UsersID']; ?>" >Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="ereklamo" role="tabpanel" aria-labelledby="ereklamo-tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="forpayment-tab" data-toggle="tab" href="#forpayment" role="tab" aria-controls="forpayment" aria-selected="true">For payment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reklamopaid-tab" data-toggle="tab" href="#reklamopaid" role="tab" aria-controls="reklamopaid" aria-selected="true">Paid</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="forpayment" role="tabpanel" aria-labelledby="forpayment-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark" 
                                    id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th>Complainant</th>
                                            <th>Reklamo</th>
                                            <th>Amount</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $requests = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM ereklamo INNER JOIN users ON users.UsersID=ereklamo.UsersID WHERE ereklamo.status='To be paid'");
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
                                            <td><?php echo $row["reklamoType"] ?></td>
                                            <td><?php echo $row['reklamoFee'] ?></td>
                                            <td>
                                                <button class="btn btn-success paid_reklamo" data-id="<?php echo $row['ReklamoID'] ?>"><i class="fas fa-check"></i> Paid</button>
                                                <a target="_blank" href="<?php echo $row["paymenturl"]?>"><button class="btn btn-primary"><i class="fas fa-money-check"></i> Gcash link</button></a>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reklamopaid" role="tabpanel" aria-labelledby="reklamopaid-tab">
                        <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark" 
                                    id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th>Complainant</th>
                                            <th>Reklamo</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $requests = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM ereklamo INNER JOIN users ON users.UsersID=ereklamo.UsersID WHERE ereklamo.status='To Captain'");
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
                                            <td><?php echo $row["reklamoType"] ?></td>
                                            <td><?php echo $row['reklamoFee'] ?></td>
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
        <!-- End of Card Body-->              
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
    window.verifyInfo_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#verifyInfo .modal-title').html($title)
                    $('#verifyInfo .modal-body').html(resp)
                    if($size != ''){
                        $('#verifyInfo .modal-dialog').addClass($size)
                    }else{
                        $('#verifyInfo .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                    }
                    $('#verifyInfo').modal({
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
    window.print_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#print_modal .modal-title').html($title)
                    $('#print_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#print_modal .modal-dialog').addClass($size)
                    }else{
                        $('#print_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-lg")
                    }
                    $('#print_modal').modal({
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

    $('.paid_request').click(function(){
        _conf("Confirm this is paid?","paid_request",[$(this).attr('data-id')])
    })
    function paid_request($id){
        start_load()
        $.ajax({
            url:'includes/request.inc.php?paid='+$(this).attr('data-id'),
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }

    $('.paid_reklamo').click(function(){
        _conf("Confirm this reklamo is paid?","paid_reklamo",[$(this).attr('data-id')])
    })
    function paid_reklamo($id){
        start_load()
        $.ajax({
            url:'includes/ereklamo.inc.php?paid&reklamoid='+$(this).attr('data-id'),
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }
</script>

<?php include 'footer.php'; ?>