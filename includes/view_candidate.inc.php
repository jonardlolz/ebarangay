<?php
    session_start();
    extract($_POST);
    include 'dbh.inc.php';
?>

<?php    
        $sql = $conn->query("SELECT * FROM election WHERE electionID = {$_GET['electionID']}");
        $row = $sql->fetch_assoc();
    ?>
<div>
    <button class='btn btn-primary btn-sm btn-flat add_candidate ml-3' href='javascript:void(0)' <?php if($row['electionStatus'] == 'Ongoing' || $row['electionStatus'] == 'Finished'){echo 'disabled';} ?>><i class="fas fa-plus"> Add candidate</i></button>
</div>

<div class="container-fluid">
    
    <div class="table-responsive">
        <table class="table table-bordered text-center text-dark" 
            id="dataTable2" width="100%" cellspacing="0" cellpadding="0">
            <thead >
                <tr class="bg-gradient-secondary text-white">
                    <th scope="col">UsersID</th>
                    <th scope="col">Election Term</th>
                    <th scope="col">Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Platform</th>
                    <th scope="col">Edit</th>
                </tr>
                
            </thead>
            <tbody>
                <!--Row 1-->
                <?php 
                    $candidates = $conn->query("SELECT candidates.*, concat(users.Firstname, ' ', users.Lastname) 
                    as name, users.profile_pic, users.userType, election.electionTitle, election.electionStatus
                    FROM candidates 
                    INNER JOIN users 
                    on users.UsersID = candidates.UsersID 
                    INNER JOIN election 
                    ON election.electionID = candidates.electionID
                    WHERE candidates.electionID = {$_GET['electionID']}");
                    $arrayCandidate = array();
                    while($row=$candidates->fetch_assoc()):
                        if($row["userType"] == "Admin"){
                            continue;
                        }
                ?>
                <tr>
                    <td><?php echo $row["UsersID"] ?></td>
                    <td><?php echo $row["electionTitle"] ?></td>
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
                        
                        <?php echo $row["name"] ?>
                    </td>
                    <td><?php echo $row["position"] ?></td>
                    <td><?php echo $row["platform"] ?></td>
                    <td>
                        <button class="btn btn-danger btn-sm delete_candidate btn-flat" data-id="<?php echo $row['candidateID'] ?>" <?php if($row['electionStatus'] == "Ongoing"){echo "Disabled";} ?>><i class="fas fa-trash"></i> Remove</button>
                    </td>
                    
                    <!--Right Options-->
                </tr>
                <?php 
                    array_push($arrayCandidate, $row['UsersID']);
                    endwhile; 
                    $_SESSION['arrayCandidate'] = $arrayCandidate;
                ?>
                <!--Row 1-->
            </tbody>
        </table> 
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
      window.view_modal = function($title = '' , $url='',$size=""){
	      start_load()
	      $.ajax({
	          url:$url,
	          error:err=>{
	              console.log(err)
	              alert("An error occured")
	          },
	          success:function(resp){
	              if(resp){
	                  $('#view_modal .modal-title').html($title)
	                  $('#view_modal .modal-body').html(resp)
	                  if($size != ''){
	                      $('#view_modal .modal-dialog').addClass($size)
	                  }else{
	                      $('#view_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-xl")
	                  }
	                  $('#view_modal').modal({
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
                var post_id = $(this).attr('data-id')
                var comment = $(this).val()
                $(this).val('')
                $.ajax({
                    url:'includes/comment.inc.php',
                    method:'POST',
                    data:{post_id:post_id,comment:comment},
                    success:function(){
                        location.reload();
                    }
                })
                return false;
                }
        })
        $('.delete_candidate').click(function(){
            _conf("Are you sure to delete this candidate?","deleteCandidate",[$(this).attr('data-id')])
        })
        $('.add_candidate').click(function(){
            uni_modal("<center><b>Add Candidate</b></center></center>","includes/addCandidate.inc.php?electionID=<?php echo $_GET['electionID'] ?>&purok=<?php echo $_GET['purok'] ?>")
        })
        
</script>