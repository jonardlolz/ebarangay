<?php include 'includes/dbh.inc.php' ?>
<?php include 'header.php' ?>

<div class="col d-flex flex-column">

<?php if($_SESSION["userType"] == "Resident"): ?>
    <?php 
        $notif = $conn->query("SELECT * FROM votes INNER JOIN election ON election.electionID = votes.electionID WHERE UsersID={$_SESSION['UsersID']} AND electionStatus='Ongoing'");
        $row_cnt = mysqli_num_rows($notif);
        if($row_cnt <= 0):
    ?>
<!-- Content Row -->
<div class="row">
    <div class="col">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Election</h1>
            </div>

            <?php 
                $posts = $conn->query("SELECT * FROM election WHERE electionStatus='Ongoing' AND barangay='{$_SESSION['userBarangay']}' AND purok='{$_SESSION['userPurok']}'");
                $row_cnt = mysqli_num_rows($posts);
                if($row_cnt > 0):
                    while($row=$posts->fetch_assoc()):
            ?>
            <form action="includes/vote.inc.php?electionID=<?php echo $row['electionID'] ?>" class="user" method="post">
                <div class="card shadow mb-3">
                    <div class="card-header m-0 p-1">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"><?php echo $row["electionTitle"]; ?></h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php 
                            $i = 0;
                            $posi = array("Purok Leader");
                            while($i < count($posi)):
                        ?>
                        <div class="card shadow mb-3">
                            <div class="card-header m-0 p-1">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800"><?php echo $posi[$i] ?></h1>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php 
                                    $cands = $conn->query("SELECT candidates.*, users.profile_pic FROM candidates 
                                    INNER JOIN users ON users.UsersID=candidates.UsersID 
                                    INNER JOIN election ON election.electionID = candidates.electionID
                                    WHERE position='{$posi[$i]}' AND election.electionStatus='Ongoing' AND election.barangay='{$_SESSION['userBarangay']}' AND election.purok='{$_SESSION['userPurok']}'");
                                    while($crow=$cands->fetch_assoc()):
                                        $crow["position"] = str_replace(" ", "", $crow["position"]);
                                    ?>
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <input type="radio" class="flat-red" name="<?php echo $crow["position"] ?>" value="<?php echo $crow["candidateID"] ?>" style="position: absolute;">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">
                                                            <b><?php echo $crow["lastname"]. ", " . $crow["firstname"] ?></b></div>
                                                        <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">
                                                            Running for:  <b><?php echo $crow["position"] ?></b></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <img src="img/<?php echo $crow["profile_pic"] ?>" alt="EBARANGAY LOGO" width="70rem" height="80rem">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                        <?php $i++; endwhile; ?>
                    </div>
                    <div class="card-footer" style="margin-left: auto;">
                        <button type="submit" class="btn btn-primary" name="submit" id='submit'>Save</button>
                    </div>
                </div>
                <?php endwhile; ?>
            </form>

            <?php else: ?>

                <div class='alert alert-warning' role='alert' style="text-align: center">
                    No election is currently running!
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php else: ?>

<div class="row">
    <div class="col">
        <div class="container-fluid">  
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Election</h1>
            </div>

            <div class='alert alert-success' role='alert'>
               Your vote has already been submitted! Thanks for voting!
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<?php elseif($_SESSION["userType"] == "Captain"): ?>

<div class="container p-4">

<!--Residents Requests-->
<div class="card shadow mb-4 m-4">
    <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-dark">Elections</h6>
            <a class="fas fa-plus fa-lg mr-2 text-gray-600 add_election" href="javascript:void(0)"></a>
    </div>
    
    <div class="card-body" style="font-size: 75%">
        <div class="table-responsive">
            <table class="table table-bordered text-center text-dark" 
                id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                <thead >
                    <tr class="bg-gradient-secondary text-white">
                        <th scope="col">Election Title</th>
                        <th scope="col">Purok</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Candidates</th>
                        <th scope="col">Status</th>
                        <th scope="col">Manage</th>
                    </tr>
                    
                </thead>
                <tbody>
                    <!--Row 1-->
                    <?php 
                        $election = $conn->query("SELECT election.*, 
                        concat(users.Firstname, ' ', users.Lastname) as name,
                        users.profile_pic, 
                        users.userType FROM election 
                        INNER JOIN users ON election.created_by = users.UsersID 
                        WHERE barangay='{$_SESSION['userBarangay']}'");
                        while($row=$election->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $row["electionTitle"] ?></td>
                        <td><?php echo $row["purok"] ?></td>
                        <td><?php echo date("M d,Y", strtotime($row['created_at'])); ?></td>
                        <td><button class="btn btn-primary btn-sm view_candidate btn-flat" data-electionid="<?php echo $row["electionID"] ?>" data-id="<?php echo $row['purok'] ?>"><i class="fas fa-user"></i> Candidates</button></td>
                        <td>
                            <?php echo $row["electionStatus"] ?>
                        </td>
                        <td>
                            <?php if($row['electionStatus'] == "Paused"): ?>
                                <button class="btn btn-success btn-sm start_election btn-flat" data-id="<?php echo $row['electionID'] ?>" <?php if($row['electionStatus'] == "Finish"){ echo 'disabled'; }?>>Start</button>
                            <?php elseif($row['electionStatus'] == "Ongoing"): ?>
                                <button class="btn btn-success btn-sm finish_election btn-flat" data-id="<?php echo $row['electionID'] ?>"><i class="fas fa-check"></i> Finish</button>
                            <?php elseif($row['electionStatus'] == "Finished"): ?>
                                <button class="btn btn-success btn-sm results_election btn-flat" data-id="<?php echo $row['electionID'] ?>"><i class="fas fa-check"></i> Results</button>
                            <?php endif; ?>
                            
                            <button class="btn btn-primary btn-sm edit_election btn-flat" data-id="<?php echo $row['electionID'] ?>" <?php if($row['electionStatus'] == "Finish"){ echo 'disabled'; }?>><i class="fas fa-edit"></i> Edit</button>
                            <button class="btn btn-warning btn-sm delete_election btn-flat" data-id="<?php echo $row['electionID'] ?>" <?php if($row['electionStatus'] == "Finish"){ echo 'disabled'; }?>><i class="fas fa-trash"></i> Delete</button>
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
<!--Residents Requests-->
</div>
</div>
<!--row-->
</div>
<!--Content-wrapper-->

<?php endif; ?>

<div class="modal fade" id="manageCandidate" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="">
    <div class="modal-dialog modal-xl" role="document" style="border-color:#384550 ;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Candidates for </h5> 
                <?php 
                    $cands = $conn->query("SELECT * FROM election");
                    $crow=$cands->fetch_assoc();
                        
                ?>
                <button class="btn btn-primary btn-sm btn-flat add_candidate ml-3" href="javascript:void(0)" disabled><i class="fas fa-plus"></i> Add candidate</a>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
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
                            as name, users.profile_pic, users.userType, election.electionTitle 
                            FROM candidates 
                            INNER JOIN users 
                            on users.UsersID = candidates.UsersID 
                            INNER JOIN election 
                            ON election.electionID = candidates.electionID");
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
                                <button class="btn btn-success btn-sm edit_candidate btn-flat" data-id="<?php echo $row['candidateID'] ?>"><i class="fas fa-edit"></i>Edit</button>
                                <button class="btn btn-danger btn-sm delete_candidate btn-flat" data-id="<?php echo $row['candidateID'] ?>"><i class="fas fa-trash"></i>Delete</button>
                            </td>
                            
                            <!--Right Options-->
                        </tr>
                        <?php endwhile; ?>
                        <!--Row 1-->
                    </tbody>
                </table> 
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Close</button> 
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".manage_candidates", function () {
        var electionID = $(this).attr('data-electionid');
        var purok = $(this).attr('data-id');
        $(".modal-dialog .add_candidate").attr( 'data-electionid', electionID );
        $(".modal-dialog .add_candidate").attr( 'data-id', purok );
        document.getElementById('exampleModalLabel').innerHTML = "Manage candidates for Purok " + purok;
        
    });


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
        $('.comment-textfield').on('change keyup keydown paste cut', function (e) {
            if(this.scrollHeight <= 117)
            $(this).height(0).height(this.scrollHeight);
        })
        $('.view_candidate').click(function(){
            view_modal("<center><b>Manage Candidates for " + $(this).attr('data-id') + "</b></center></center>","includes/view_candidate.inc.php?electionID="+ $(this).attr('data-electionid') + "&purok="+$(this).attr('data-id'))
        })
        $('.edit_candidate').click(function(){
            uni_modal("<center><b>Edit Candidate</b></center></center>","includes/addCandidate.inc.php?id="+$(this).attr('data-id'))
        })
        $('.add_election').click(function(){
            uni_modal("<center><b>Add Election</b></center></center>","includes/addElection.inc.php?add")
        })
        $('.edit_election').click(function(){
            uni_modal("<center><b>Add Election</b></center></center>","includes/addElection.inc.php?edit="+$(this).attr('data-id'))
        })
        $('.results_election').click(function(){
            uni_modal("<center><b>Results</b></center></center>","includes/addElection.inc.php?result="+$(this).attr('data-id'))
        })
        $('.delete_candidate').click(function(){
        _conf("Are you sure to delete this candidate?","deleteCandidate",[$(this).attr('data-id')])
        })
        $('.delete_election').click(function(){
        _conf("Are you sure to delete this election? <br> All candidates and votes that has been submitted to this election will be removed.","deleteElection",[$(this).attr('data-id')])
        })
        $('.start_election').click(function(){
        _conf("Once election starts, you cannot change the listed candidates anymore. <br> Do you want to continue? ","startElection",[$(this).attr('data-id')])
        })
        $('.finish_election').click(function(){
        _conf("Finishing election cannot be undone. <br> Do you want to continue? ","finishElection",[$(this).attr('data-id')])
        })
        function startElection($id){
                start_load()
                $.ajax({
                    url:'includes/finishElection.inc.php?start',
                    method:'POST',
                    data:{id:$id},
                    success:function(){
                        location.reload()
                    }
                })
            }
        function finishElection($id){
                start_load()
                $.ajax({
                    url:'includes/finishElection.inc.php?finish',
                    method:'POST',
                    data:{id:$id},
                    success:function(){
                        location.reload()
                    }
                })
            }
        function deleteCandidate($id){
                start_load()
                $.ajax({
                    url:'includes/deleteCandidate.inc.php',
                    method:'POST',
                    data:{id:$id},
                    success:function(){
                        location.reload()
                    }
                })
            }
        function deleteElection($id){
            start_load()
            $.ajax({
                url:'includes/deleteElection.inc.php',
                method:'POST',
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
            $('#dataTable2').DataTable();
        } );
    </script>


<?php include 'footer.php' ?>