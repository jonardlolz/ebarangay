<?php include_once "header.php" ?>

<div class="col d-flex flex-column">
<!--Begin Page-->
<div class="container p-4">

<!--Residents Requests-->
<?php if($_SESSION["userType"] == "Purok Leader"): ?>
<div class="card shadow mb-4 m-4">
    <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Residents</h6>
    </div>
    
    <div class="card-body" style="font-size: 75%">
        <div class="table-responsive">
            <table class="table table-bordered text-center text-dark display" 
                width="100%" cellspacing="0" cellpadding="0">
                <thead >
                    <!-- <tr class="bg-gradient-warning">
                        <th colspan="5">Resident</th>
                        <th colspan ="2">Address</th>
                        <th colspan="2">Contacts</th>
                        <th colspan="1">Options</th>                   
                    </tr> -->
                    <tr class="bg-gradient-secondary text-white">
                        <th scope="col">Name</th>
                        <th scope="col">Birthdate</th>
                        <th scope="col">Civil Status</th>
                        <th scope="col">User Type</th>
                        <th scope="col">Purok</th>
                        <th scope="col">Barangay</th>
                        <th scope="col">Email Address</th>
                        <!-- <th scope="col">Phone Number</th> -->
                        <th scope="col">Manage</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <!--Row 1-->
                    <?php 
                        $accounts = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users WHERE VerifyStatus = 'Pending' AND userBarangay = '{$_SESSION['userBarangay']}' AND userPurok = '{$_SESSION['userPurok']}'");
                        while($row=$accounts->fetch_assoc()):
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
                            </br>
                            <?php echo $row["name"] ?>
                        </td>
                        <td><?php echo $row["dateofbirth"] ?></td>
                        <td><?php echo $row["civilStat"] ?></td>
                        <td><?php echo $row["userType"] ?></td>
                        <td><?php echo $row["userPurok"] ?></td>
                        <td><?php echo $row["userBarangay"] ?></td>
                        <td><name@email class="com"><?php echo $row["emailAdd"] ?></name@email></td>
                        <!-- <td><?php echo $row["phoneNum"] ?></td> -->
                        <td>
                            <button class="btn btn-success btn-sm btn-flat verify_user" data-id="<?php echo $row['UsersID'] ?>"><i class="fas fa-check"></i> Verify</button>
                            <button class="btn btn-danger btn-sm btn-flat unverify_user" data-id="<?php echo $row['UsersID'] ?>"><i class="fas fa-times"></i> Unverify</button>
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
<?php else: ?>

<div class="card shadow mb-4 m-4">
<div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-dark"><?php echo $_SESSION["userBarangay"] ?> Residents</h6>
        <a class="fas fa-plus fa-lg mr-2 text-gray-600 add_account" href="javascript:void(0)"></a>
</div>


<div class="card-body" style="font-size: 75%">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="home" aria-selected="true">All</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="residents-tab" data-toggle="tab" href="#residents" role="tab" aria-controls="profile" aria-selected="false">Residents</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="purokleaders-tab" data-toggle="tab" href="#purokleaders" role="tab" aria-controls="contact" aria-selected="false">Purok Leaders</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="officers-tab" data-toggle="tab" href="#officers" role="tab" aria-controls="contact" aria-selected="false">Officers</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="respondents-tab" data-toggle="tab" href="#respondents" role="tab" aria-controls="contact" aria-selected="false">Respondents</a>
    </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <div class="table-responsive">
                <table class="table table-bordered text-center text-dark display" 
                    width="100%" cellspacing="0" cellpadding="0">
                    <thead >
                        <tr class="bg-gradient-secondary text-white">
                            <th scope="col">Name</th>
                            <th scope="col">User Type</th>
                            <th scope="col">Barangay</th>
                            <th scope="col">Purok</th>
                            <th scope="col">Email Address</th>
                            <!-- <th scope="col">Phone Number</th>
                            <th scope="col">Manage</th> -->
                        </tr>
                        
                    </thead>
                    <tbody>
                        <!--Row 1-->
                        <?php 
                            $accounts = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users WHERE VerifyStatus = 'Pending' AND userBarangay = '{$_SESSION['userBarangay']}' ORDER BY FIELD(userType, 'Captain', 'Purok Leader', 'Secretary', 'Treasurer', 'Resident');");
                            while($row=$accounts->fetch_assoc()):
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
                                </br>
                                <?php echo $row["name"] ?>
                            </td>
                            <td><?php echo $row["userType"] ?></td>
                            <td><?php echo $row["userBarangay"] ?></td>
                            <td><?php echo $row["userPurok"] ?></td>
                            <td><name@email class="com"><?php echo $row["emailAdd"] ?></name@email></td>
                            <!-- <td><?php echo $row["phoneNum"] ?></td>
                            <td>
                                <button class="btn btn-success btn-sm btn-flat edit_account" data-id="<?php echo $row['UsersID'] ?>"><i class="fas fa-edit"></i> Edit</button>
                            </td> -->
                            
                            <!--Right Options-->
                        </tr>
                        <?php endwhile; ?>
                        <!--Row 1-->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="residents" role="tabpanel" aria-labelledby="residents-tab">
            <div class="table-responsive">
                <table class="table table-bordered text-center text-dark display" 
                    width="100%" cellspacing="0" cellpadding="0">
                    <thead >
                        <tr class="bg-gradient-secondary text-white">
                            <th scope="col">Name</th>
                            <th scope="col">User Type</th>
                            <th scope="col">Barangay</th>
                            <th scope="col">Purok</th>
                            <th scope="col">Email Address</th>
                            <!-- <th scope="col">Phone Number</th>
                            <th scope="col">Manage</th> -->
                        </tr>
                        
                    </thead>
                    <tbody>
                        <!--Row 1-->
                        <?php 
                            $accounts = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users WHERE VerifyStatus = 'Pending' AND userType='Resident' AND userBarangay='{$_SESSION['userBarangay']}'");
                            while($row=$accounts->fetch_assoc()):
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
                                </br>
                                <?php echo $row["name"] ?>
                            </td>
                            <td><?php echo $row["userType"] ?></td>
                            <td><?php echo $row["userBarangay"] ?></td>
                            <td><?php echo $row["userPurok"] ?></td>
                            <td><name@email class="com"><?php echo $row["emailAdd"] ?></name@email></td>
                            <!-- <td><?php echo $row["phoneNum"] ?></td>
                            <td>
                                <button class="btn btn-success btn-sm btn-flat edit_account" data-id="<?php echo $row['UsersID'] ?>"><i class="fas fa-edit"></i> Edit</button>
                            </td> -->
                            
                            <!--Right Options-->
                        </tr>
                        <?php endwhile; ?>
                        <!--Row 1-->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="purokleaders" role="tabpanel" aria-labelledby="purokleaders-tab">
            <div class="row">
                <div class="col">
                    
                </div>
                <div class="col">
                    
                </div>
                <div class="col">
                    
                </div>
                <div class="col">
                    
                </div>
                <div class="col">
                    <button class="btn btn-primary add_officer">Add Purok Leader</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-center text-dark display" 
                    width="100%" cellspacing="0" cellpadding="0">
                    <thead >
                        <tr class="bg-gradient-secondary text-white">
                            <th scope="col">Name</th>
                            <th scope="col">User Type</th>
                            <th scope="col">Purok</th>
                            <th>Street Address</th>
                            <th>House #</th>
                            <th scope="col">Username</th>
                            <th scope="col">Action</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <!--Row 1-->
                        <?php 
                            $accounts = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users WHERE Status='Active' AND userType='Purok Leader'");
                            while($row=$accounts->fetch_assoc()):
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
                            <td><?php echo $row["userType"] ?></td>
                            <td><?php echo $row["userPurok"] ?></td>
                            <td><?php echo $row["userAddress"] ?></td>
                            <td><?php echo $row["userHouseNum"] ?></td>
                            <td><?php echo $row["username"] ?></td>
                            <td>
                                <button class="btn btn-danger removeleader" data-id="<?php echo $row['UsersID'] ?>"><i class="fas fa-trash fa-md"></i> Remove Leader</button>
                                
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <!--Row 1-->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="officers" role="tabpanel" aria-labelledby="officers-tab">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col">
                
            </div>
            <div class="col">
                
            </div>
            <div class="col">
                
            </div>
            <div class="col">
                <button class="btn btn-primary add_officer">Add officer</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-center text-dark display" 
                    width="100%" cellspacing="0" cellpadding="0">
                    <thead >
                        <tr class="bg-gradient-secondary text-white">
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Barangay</th>
                            <th scope="col">Purok</th>
                            <th>Manage</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <!--Row 1-->
                        <?php 
                            $accounts = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users 
                            WHERE (userType = 'Purok Leader' 
                            OR userType = 'Treasurer' 
                            OR userType = 'Secretary')
                            AND userBarangay = '{$_SESSION["userBarangay"]}';");
                            while($row=$accounts->fetch_assoc()):
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
                                </br>
                                <?php echo $row["name"] ?>
                            </td>
                            <td><?php echo $row["userType"] ?></td>
                            <td><?php echo $row["userBarangay"] ?></td>
                            <td><?php echo $row["userPurok"] ?></td>
                            <td>
                                <button class="btn btn-success btn-sm btn-flat changePosition" data-id="<?php echo $row['UsersID'] ?>"><i class="fas fa-edit"></i> Change Position</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <!--Row 1-->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="respondents" role="tabpanel" aria-labelledby="respondents-tab">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col">
                
            </div>
            <div class="col">
                
            </div>
            <div class="col">
                
            </div>
            <div class="col">
                <button class="btn btn-primary add_respondent">+ Add Respondent</button>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered text-center text-dark display" 
                    width="100%" cellspacing="0" cellpadding="0">
                    <thead >
                        <tr class="bg-gradient-secondary text-white">
                            <th>Name</th>
                            <th>Respondent Type</th>
                            <th>Barangay</th>
                            <th>Purok</th>
                            <th>Action</th>
                        </tr>
                        
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

</div>
<!-- End of Card Body-->

<?php endif; ?>                 
<!--End of Card-->  
<!--Residents Requests-->
</div>
</div>
<!--row-->
</div>
<!--Content-wrapper-->
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

        $('.comment-textfield').on('keypress', function (e) {
            if(e.which == 13 && e.shiftKey == false){
                if($('#preload2').length <= 0){
                    start_load();
                }else{
                    return false;
                }
                var post_id = $(this).attr('data-id')
                var comment = $(this).val()
                $(this).val('')
                $.ajax({
                    url:'ajax.php?action=save_comment',
                    method:'POST',
                    data:{post_id:post_id,comment:comment},
                    success:function(resp){
                        if(resp){
                            resp = JSON.parse(resp)
                            if(resp.status == 1){
                                var cfield = $('#comment-clone .card-comment').clone()
                                cfield.find('.img-circle').attr('src','assets/uploads/'+resp.data.profile_pic)
                                cfield.find('.uname').text(resp.data.name)
                                cfield.find('.comment').html(resp.data.comment)
                                cfield.find('.timestamp').text(resp.data.timestamp)
                            $('.post-card[data-id="'+post_id+'"]').find('.card-comments').append(cfield)
                            var cc = $('.post-card[data-id="'+post_id+'"]').find('.comment-count').text();
                                cc = cc.replace(/,/g,'');
                                cc = parseInt(cc) + 1
                            $('.post-card[data-id="'+post_id+'"]').find('.comment-count').text(cc)
                            }else{
                                alert_toast("An error occured","danger")
                            }
                            end_load()
                        }
                    }
                })
                return false;
            }
        })
        $('.comment-textfield').on('change keyup keydown paste cut', function (e) {
            if(this.scrollHeight <= 117)
            $(this).height(0).height(this.scrollHeight);
        })
        $('.add_respondent').click(function(){
            uni_modal("<center><b>Add Respondent</b></center></center>","includes/sendrespondent.inc.php?add");
        })
        $('.add_officer').click(function(){
            uni_modal("<center><b>Add Officer</b></center></center>","includes/account.inc.php?addOfficer");
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
        $('.add_account').click(function(){
            uni_modal("<center><b>Add Account</b></center></center>","includes/account.inc.php?add")
        })
        $('.edit_account').click(function(){
            uni_modal("<center><b>Edit Account</b></center></center>","includes/account.inc.php?edit="+$(this).attr('data-id'))
        })
        $('.changePosition').click(function(){
            uni_modal("<center><b>Change Position</b></center></center>","includes/account.inc.php?changePosition="+$(this).attr('data-id'))
        })
        $('.verify_user').click(function(){
        _conf("Are you sure you want to verify this user?","verify_user",[$(this).attr('data-id')])
        })
        $('.unverify_user').click(function(){
        _conf("Are you sure you want to unverify this user?","unverify_user",[$(this).attr('data-id')])
        })
        $('.removeleader').click(function(){
        _conf("Are you sure to remove this Purok Leader?","removeLeader",[$(this).attr('data-id')])
        })
        function removeLeader($id){
            start_load()
            $.ajax({
                url:'includes/edit_account.inc.php?removeLeader',
                method:'POST',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }
        function verify_user($id){
            start_load()
            $.ajax({
                url:'includes/verify.inc.php?verify=' + $id,
                method:'GET',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }
        function unverify_user($id){
            start_load()
            $.ajax({
                url:'includes/verify.inc.php?unverify=' + $id,
                method:'GET',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }
        $('#upload_post').click(function(){
            uni_modal("<center><b>Create Post</b></center></center>","includes/create_post.inc.php?upload=1")
        })
        $('.content-field').each(function(){
            var dom = $(this)[0]
            var divHeight = dom.offsetHeight
            if(divHeight > 117){
                $(this).addClass('truncate-5')
                $(this).parent().children('.show-content').removeClass('d-none')
            }
        })
        $('.show-content').click(function(){
            var txt = $(this).text()
            if(txt == "Show More"){
                $(this).parent().children('.content-field').removeClass('truncate-5')
                $(this).text("Show Less")
            }else{
                $(this).parent().children('.content-field').addClass('truncate-5')
                $(this).text("Show More")
            }
        })
        $('.lightbox-items').click(function(e){
            e.preventDefault()
            uni_modal("","view_attach.php?id="+$(this).attr('data-id'),"large")
        })
        $('.view_more').click(function(e){
            e.preventDefault()
            uni_modal("","view_attach.php?id="+$(this).attr('data-id'),"large")
        })
        $('.like').click(function(){
            var _this = $(this)
            $.ajax({
                url:'ajax.php?action=like',
                method:'POST',
                data:{post_id:$(this).attr('data-id')},
                success:function(resp){
                    if(resp == 1){
                        _this.addClass('text-primary')
                        var lc = _this.siblings('.counts').find('.like-count').text();
                                lc = lc.replace(/,/g,'');
                                lc = parseInt(lc) + 1
                        _this.siblings('.counts').find('.like-count').text(lc)
                    }else if(resp==0){
                        _this.removeClass('text-primary')
                        var lc = _this.siblings('.counts').find('.like-count').text();
                                lc = lc.replace(/,/g,'');
                                lc = parseInt(lc) - 1
                        _this.siblings('.counts').find('.like-count').text(lc)
                    }
                }
            })
        })
        $(document).ready(function() {
            $('table.display').DataTable({
                "pageLength" : 4
            });
        } );
    </script>

<?php include_once "footer.php" ?>