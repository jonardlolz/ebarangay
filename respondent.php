<?php include 'header.php'; ?>

<!-- Begin Page Content -->
<div class="col d-flex flex-column px-4">

<!-- Page Heading --> 
<div class="d-sm-flex align-items-center justify-content-between">  
    <h3 class="font-weight-bold text-dark">Respondent </h3> 
</div>

<!-- Content Row -->
<div class="container p-4">
    <?php if($_SESSION["barangayPos"] != "None"): ?>
        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Respondent</h6>
            </div>
            
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th>eReklamo ID</th>
                                <th>Name</th>
                                <th>Reklamo Type</th>
                                <th>Details</th>
                                <th>Street Address</th>
                                <th>House Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                if($_SESSION['barangayPos'] == 'Tanod'){
                                    $reklamoType = "Resident";
                                }
                                elseif($_SESSION['barangayPos'] == 'Electrician'){
                                    $reklamoType = "Kuryente";
                                }
                                elseif($_SESSION['barangayPos'] == 'Plumber'){
                                    $reklamoType = "Tubig";
                                }
                                elseif($_SESSION['barangayPos'] == 'Construction'){
                                    $reklamoType = "Kalsada";
                                }

                                $requests = $conn->query("SELECT ereklamo.*, concat(users.Firstname, ' ', users.Lastname)
                                as name, DATE_FORMAT(createdOn, '%m/%d/%Y %h:%i %p') as createdDate, 
                                DATE_FORMAT(checkedOn, '%m/%d/%Y %h:%i %p') 
                                as checkedDate, users.userType, users.profile_pic, users.userAddress, users.userHouseNum
                                FROM ereklamo 
                                INNER JOIN users 
                                ON ereklamo.UsersID=users.UsersID 
                                WHERE ereklamo.status='Respondents sent' 
                                AND ereklamo.reklamoType='{$reklamoType}'
                                AND ereklamo.barangay='{$_SESSION['userBarangay']}' 
                                AND ereklamo.purok='{$_SESSION['userPurok']}'");
                                while($row=$requests->fetch_assoc()):
                                    if($row["userType"] == "Admin"){
                                        continue;
                                    }
                            ?>
                            <tr>
                                <td><?php echo $row["ReklamoID"] ?></td>
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
                                <td><?php echo $row["detail"] ?></td>
                                <td><?php echo $row["userAddress"] ?></td>
                                <td><?php echo $row["userHouseNum"] ?></td>
                                <td><?php if($row["status"] != NULL){echo $row["status"];} else{echo "Pending";} ?></td>
                                <!-- <td><a href="includes/ereklamo.inc.php?resolvedID=<?php echo $row["ReklamoID"] ?>&usersID=<?php echo $row['UsersID'] ?>"><i class="fas fa-check fa-2x"></i></a></td> -->
                                <td><a href="includes/ereklamo.inc.php?resolvedID=<?php echo $row['ReklamoID'] ?>"><button type="button" class="btn btn-success" href=""><i class="fas fa-check"></i> Resolve</button></a>
                                    <a href="includes/ereklamo.inc.php?respondID=<?php echo $row['ReklamoID'] ?>"><button type="button" class="btn btn-warning" href=""><i class="fas fa-check"></i> For meet</button></a></td>
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

    <?php elseif($_SESSION['userType'] == 'Captain' || $_SESSION['userType'] == 'Purok Leader'): ?>
    <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Respondent</h6>
                <a class="fas fa-plus fa-lg mr-2 text-gray-600 add_respondent" href="javascript:void(0)"></a>
            </div>
            <div class="card-body" style="font-size: 75%">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-dark" 
                        id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                        <thead >
                            <tr class="bg-gradient-secondary text-white">
                                <th>UsersID</th>
                                <th>Name</th>
                                <th>Respondent Type</th>
                                <th>Barangay</th>
                                <th>Purok</th>
                                <th>Action</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <!--Row 1-->
                            <?php 
                                $requests = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname)
                                as name FROM users WHERE barangayPos != 'None' AND userBarangay='{$_SESSION['userBarangay']}'
                                AND userPurok='{$_SESSION['userPurok']}';");
                                while($row=$requests->fetch_assoc()):
                                    if($row["userType"] == "Admin"){
                                        continue;
                                    }
                            ?>
                            <tr>
                                <td><?php echo $row["UsersID"] ?></td>
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
                                <td><?php echo $row["barangayPos"] ?></td>
                                <td><?php echo $row["userBarangay"] ?></td>
                                <td><?php echo $row["userPurok"] ?></td>
                                <!-- <td><a href="includes/ereklamo.inc.php?resolvedID=<?php echo $row["ReklamoID"] ?>&usersID=<?php echo $row['UsersID'] ?>"><i class="fas fa-check fa-2x"></i></a></td> -->
                                <td>
                                    <button type="button" class="btn btn-danger remove_respondent" data-id="<?php echo $row["UsersID"] ?>"><i class="fas fa-check"></i> Remove</button>
                                    <button type="button" class="btn btn-warning edit_respondent" data-id="<?php echo $row["UsersID"] ?>"><i class="fas fa-check"></i> Edit</button></td>
                                <!--Right Options-->
                            </tr>
                        <?php endwhile; ?>
                    <!--Row 1-->
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <script>
        $(document).ready(function() {
        $('#dataTable').DataTable();
        } );
        
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
      $('.add_respondent').click(function(){
            uni_modal("<center><b>Add Respondent</b></center></center>","includes/sendrespondent.inc.php?add");
        })
      $('.edit_respondent').click(function(){
            uni_modal("<center><b>Edit Respondent</b></center></center>","includes/sendrespondent.inc.php?edit=" + $(this).attr('data-id'));
        })
      $('.remove_respondent').click(function(){
        _conf("Are you sure to remove this respondent?","remove_respondent",[$(this).attr('data-id')])
        })
        function remove_respondent($id){
                start_load()
                $.ajax({
                    url:'includes/sendrespondent.inc.php',
                    method:'POST',
                    data:{id:$id},
                    success:function(){
                        location.reload()
                    }
                })
            }
    </script>

    

    <?php include_once 'footer.php' ?>