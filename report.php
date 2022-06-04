<?php include_once 'header.php' ?>
<?php if($_SESSION['userType'] == 'Captain'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" 
                                    width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th scope="col">Content</th>
                                            <th scope="col">Users</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $accounts = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM report INNER JOIN users ON users.UsersID=report.UsersID WHERE report.userBarangay = '{$_SESSION['userBarangay']}' AND report.userPurok = '{$_SESSION['userPurok']}' AND ReportType='eReklamo' ORDER BY created_on DESC");
                                            while($row=$accounts->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td><?php echo $row["reportMessage"] ?></td>
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
                                                    elseif($row["userType"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["userType"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['UsersID'] ?>"><?php echo $row["name"] ?></a> 
                                            </td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                            
                                            <!--Right Options-->
                                        </tr>
                                        <?php endwhile; ?>
                                        <!--Row 1-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" 
                                    width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th scope="col">Content</th>
                                            <th scope="col">Users</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $accounts = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM report INNER JOIN users ON users.UsersID=report.UsersID WHERE report.userBarangay = '{$_SESSION['userBarangay']}' AND report.userPurok = '{$_SESSION['userPurok']}' AND ReportType='Request' ORDER BY created_on DESC");
                                            while($row=$accounts->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td><?php echo $row["reportMessage"] ?></td>
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
                                                    elseif($row["userType"] == "Councilor"){
                                                        echo "img-councilor-profile";
                                                    }
                                                    elseif($row["userType"] == "Admin"){
                                                        echo "img-admin-profile";
                                                    }
                                                ?>" src="img/<?php echo $row["profile_pic"] ?>" width="40" height="40"/>
                                                </br>
                                                <a href="javascript:void(0)" class="view_profile" data-id="<?php echo $row['UsersID'] ?>"><?php echo $row["name"] ?></a> 
                                            </td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                            
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
                <!-- End of Card Body-->
            </div>                   
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                orderCellsTop: true,
                dom: 'lBfrtip',
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
<?php elseif($_SESSION['userType'] == 'Purok Leader'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">

                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark display" 
                            width="100%" cellspacing="0" cellpadding="0">
                            <thead >
                                <tr class="bg-gradient-secondary text-white">
                                    <th scope="col">Report Type</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Date</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <!--Row 1-->
                                <?php 
                                    $accounts = $conn->query("SELECT * FROM report WHERE userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}'");
                                    while($row=$accounts->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row["ReportType"] ?></td>
                                    <td><?php echo $row["reportMessage"] ?></td>
                                    <td><?php echo $row["UsersID"] ?></td>
                                    <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                    
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
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                orderCellsTop: true,
                dom: 'lBfrtip',
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
<?php elseif($_SESSION['userType'] == 'Secretary'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">

                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark display" 
                            width="100%" cellspacing="0" cellpadding="0">
                            <thead >
                                <tr class="bg-gradient-secondary text-white">
                                    <th scope="col">Report Type</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Date</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <!--Row 1-->
                                <?php 
                                    $accounts = $conn->query("SELECT * FROM report WHERE userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}'");
                                    while($row=$accounts->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row["ReportType"] ?></td>
                                    <td><?php echo $row["reportMessage"] ?></td>
                                    <td><?php echo $row["UsersID"] ?></td>
                                    <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                    
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
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                orderCellsTop: true,
                dom: 'lBfrtip',
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
<?php elseif($_SESSION['userType'] == 'Treasurer'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center text-dark display" 
                                    width="100%" cellspacing="0" cellpadding="0">
                                    <thead >
                                        <tr class="bg-gradient-secondary text-white">
                                            <th scope="col">Report Type</th>
                                            <th scope="col">Content</th>
                                            <th scope="col">From</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <!--Row 1-->
                                        <?php 
                                            $accounts = $conn->query("SELECT * FROM report WHERE userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}' AND reportType='Request'");
                                            while($row=$accounts->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td><?php echo $row["ReportType"] ?></td>
                                            <td><?php echo $row["reportMessage"] ?></td>
                                            <td><?php echo $row["UsersID"] ?></td>
                                            <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                            
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
                <!-- End of Card Body-->
            </div>                   
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                orderCellsTop: true,
                dom: 'lBfrtip',
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
<?php elseif($_SESSION['userType'] == 'Councilor'): ?>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">

                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark display" 
                            width="100%" cellspacing="0" cellpadding="0">
                            <thead >
                                <tr class="bg-gradient-secondary text-white">
                                    <th scope="col">Report Type</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Date</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <!--Row 1-->
                                <?php 
                                    $accounts = $conn->query("SELECT * FROM report WHERE userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}'");
                                    while($row=$accounts->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row["ReportType"] ?></td>
                                    <td><?php echo $row["reportMessage"] ?></td>
                                    <td><?php echo $row["UsersID"] ?></td>
                                    <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                    
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
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                orderCellsTop: true,
                dom: 'lBfrtip',
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
    <div class="col d-flex flex-column">
        <div class="container-fluid">
            <div class="card shadow mb-4 m-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Report</h6>
                </div>
                
                <div class="card-body" style="font-size: 75%">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="reklamo-tab" data-toggle="tab" href="#reklamo" role="tab" aria-controls="reklamo" aria-selected="true">eReklamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="request" aria-selected="true">eRequest</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reklamo" role="tabpanel" aria-labelledby="reklamo-tab">

                        </div>
                        <div class="tab-pane fade" id="request" role="tabpanel" aria-labelledby="request-tab">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center text-dark display" 
                            width="100%" cellspacing="0" cellpadding="0">
                            <thead >
                                <tr class="bg-gradient-secondary text-white">
                                    <th scope="col">Report Type</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Date</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <!--Row 1-->
                                <?php 
                                    $accounts = $conn->query("SELECT * FROM report WHERE userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}'");
                                    while($row=$accounts->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row["ReportType"] ?></td>
                                    <td><?php echo $row["reportMessage"] ?></td>
                                    <td><?php echo $row["UsersID"] ?></td>
                                    <td><?php echo date("M d,Y h:i A",strtotime($row['created_on'])) ?></td>
                                    
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
    </div>
    <script>
        $(document).ready(function() {
            $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
                $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
            } );

            $('table.display').DataTable({
                "responsive": true,
                orderCellsTop: true,
                dom: 'lBfrtip',
                "scrollY": "400px",
                "scrollCollapse": true,
                "paging": false,
                "ordering": false,
                initComplete: function(){
                    
                }
            });
        });
    </script>
<?php endif; ?>

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
    window.continue_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#continue_modal .modal-title').html($title)
                    $('#continue_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#continue_modal .modal-dialog').addClass($size)
                    }else{
                        $('#continue_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                    }
                    $('#continue_modal').modal({
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

      $('.view_profile').click(function(){
            uni_modal("<center>Profile</center>","profile_alt.php?viewProfile&UsersID="+$(this).attr('data-id'), "modal-lg");
        })
</script>
<?php include_once 'footer.php' ?>