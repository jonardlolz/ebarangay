<?php include_once 'header.php'; ?>

<style>
       
        #map {
            height: 250px;
            width: 100%;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(2, 50%);
            grid-template-rows: repeat(2, 30vh);
            grid-gap: 3px;
            grid-row-gap: 3px;
        }
        .gallery__img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
</style>

            <!-- Begin Page Content -->
            <div class="col d-flex flex-column">

                <!-- Content Row -->
                <div class="row">
                <div class="col-8">
                    <div class="container-fluid">
                        <h1 class="font-weight-normal text-dark text-uppercase text-left">Barangay <?php echo "{$_SESSION['userBarangay']}"  ?></h1>    <!--push-->
                        <!-- Post Section -->
                        <?php if(!empty($_SESSION['UsersID']) && $_SESSION['userType'] != "Resident"): ?>
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <div class="d-flex w-100">
                                            <div class="rounded-circle mr-1" style="width: 25px;height: 25px;top:-5px;left: -40px">
                                                <img src="img/<?php echo $_SESSION['profile_pic'] ?>" class="image-fluid image-thumbnail rounded-circle <?php 
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
                                                    ?>" alt="" style="max-width: calc(100%);height: calc(100%);">
                                            </div>
                                            <button class="btn btn-default ml-4 text-left" id="write_post" type="button" style="width:calc(80%);border-radius: 50px !important;"><span>What's on your mind, <?php echo ucwords($_SESSION["Firstname"]) ?>?</span></button>
                                        </div>
                                        <hr>
                                        <div class="d-flex w-100 justify-content-center">
                                            <a href="javascript:void(0)" id="upload_post" class="text-dark post-link px-3 py-1" style="border-radius: 50px !important;"><span class="fa fa-photo-video text-success"></span> Photo/Video</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Post Section -->
                        <?php endif; ?>
                        <?php 
                            if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }
                            
                            $no_of_records_per_page = 3;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            
                            $sql = "SELECT COUNT(*) FROM post";
                            $result = mysqli_query($conn, $sql);
                            $total_rows = mysqli_fetch_array($result)[0];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);

                            $posts = $conn->query("SELECT p.*, concat(u.Firstname, ' ', u.Lastname) as name, u.profile_pic FROM post p inner join users u on u.UsersID = p.UsersID WHERE barangay='{$_SESSION['userBarangay']}'ORDER BY unix_timestamp(date_created) DESC LIMIT $offset, $no_of_records_per_page;");
                            while($row=$posts->fetch_assoc()):
                                $row['postMessage'] = str_replace("\n", "<br/>", $row['postMessage']);
                        ?>


                        <!-- News feed -->
                        <div class="col-md-12">
                            <div class="card shadow mb-3" data-id="<?php echo $row['PostID'] ?>">
                                <div class="card-header m-0 p-1">
                                <div class="row">
                                    <div class="col-auto">
                                            <img src="img/<?php echo $row["profile_pic"] ?>" class="img-res-profile rounded-circle <?php 
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
                                                    ?>"
                                            width="60" height="60">
                                        </div>
                                        <div class="col-auto">
                                            <h5 class="text-dark font-weight-bold"><?php echo $row['name'] ?> </h5>   
                                            <small class="dateTime"><?php echo date("M d,Y h:i a", strtotime($row['date_created'])); ?> </small>
                                        </div>
                                        <!--Right Options-->
                                        <?php if(!empty($_SESSION['UsersID'])) : ?>
                                            <?php if($_SESSION['UsersID'] == $row['UsersID']): ?>
                                                <div class="dropdown no-arrow" style="margin-left: auto;">
                                                    <button type="button" class="dropdown-toggle btn m-0 btn-circle" 
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v fw" aria-hidden="true"></i>
                                                    </button>
                                                    <div class="dropdown-menu shadow"
                                                        aria-labelledby="userDropdown">
                                                        <a class="dropdown-item edit_post" data-id="<?php echo $row['PostID'] ?>" href="javascript:void(0)">
                                                            <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-600"></i> Edit
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item delete_post" data-id="<?php echo $row['PostID'] ?>" href="javascript:void(0)">
                                                            <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-600"></i> Delete 
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <!--Right Options-->
                                    </div>  
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                
                                <!-- Card body -->
                                <div class="card-body">
                                    <p class="content-field"><?php echo $row['postMessage'] ?></p>
                                    
                                    <a href="javascript:void(0)" class="d-none show-content" >Show More</a>
                                    <?php if(is_dir('img/posts/'.$row['PostID'])): ?>
                                    <div class="gallery mb-2">
                                        <?php
                                        $gal = scandir('img/posts/'.$row['PostID']);
                                        unset($gal[0]);
                                        unset($gal[1]);
                                        $count =count($gal);
                                        $i = 0;
                                        foreach($gal as $k => $v):
                                            $mime = mime_content_type('img/posts/'.$row['PostID'].'/'.$v);
                                            $i++;
                                            if($i > 4)
                                            break;
                                            $style = '';
                                            if($count == 1){
                                                $style = "grid-column-start: 1;grid-column-end: 3;grid-row-start: 1;grid-row-end: 3;";
                                            }elseif($count == 2){
                                                // if($i==1)
                                                $style = "grid-column-start: {$i};grid-column-end: ".($i + 1).";grid-row-start: 1;grid-row-end: 3;";
                                            }elseif ($count == 3) {
                                                if($i == 1)
                                                $style = "grid-column-start: {$i};grid-column-end: ".($i + 1).";grid-row-start: 1;grid-row-end: 3;";
                                            }
                                        ?>
                                        <figure class="gallery__item position-relative" style="<?php echo $style ?>">
                                        <?php if($i == 4 && $count > 4): ?>
                                            <div class="position-absolute d-flex justify-content-center align-items-center h-100 w-100" style="top:0;left:0;z-index:1" >
                                                <a href="javascript:void(0)" class="text-white view_more" data-id="<?php echo $row['PostID'] ?>"><h4 class="text-white text-center"><?php echo '+ '.($count-4) ?> More</h4></a>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(strstr($mime,'image')): ?>
                                                <a href="img/posts/<?php echo $row['PostID'].'/'.$v ?>" class="lightbox-items" data-toggle="lightbox<?php echo $row['PostID'] ?>" data-slide="<?php echo $k ?>" data-title="" data-gallery="gallery"  data-id="<?php echo $row['PostID'] ?>">
                                            <img src="img/posts/<?php echo $row['PostID'].'/'.$v ?>" class="gallery__img" alt="Image 1">
                                            </a>
                                            <?php else: ?>
                                                <?php if($count > 1): ?>
                                                    <a href="img/posts/<?php echo $row['PostID'].'/'.$v ?>" class="lightbox-items" data-toggle="lightbox<?php echo $row['PostID'] ?>" data-slide="<?php echo $k ?>" data-title="" data-gallery="gallery">
                                                <?php endif; ?>
                                                <video <?php echo $count == 1 ? "controls" : '' ?> class="gallery__img">
                                                    <source src="img/posts/<?php echo $row['PostID'].'/'.$v ?>" type="<?php echo $mime ?>">
                                                </video>
                                                <?php if($count > 1): ?>
                                                </a>
                                                <a href="javascript:void(0)" class="text-white view_more" data-id="<?php echo $row['PostID'] ?>" >
                                                <div class="position-absolute d-flex justify-content-center align-items-center h-100 w-100" style="top:0;left:0;z-index:1" >
                                                <h3 class="text-white text-center rounded-circle "><i class="fa fa-play-circle "></i></h3>
                                                </div>
                                                </a>
                                                <?php endif; ?>

                                            <?php endif; ?>
                                            
                                        </figure>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                </div>
                                <!-- End of Card body -->

                                <!-- Card footer -->
                                <div class="card-footer">
                                    <form action="#" method="post">
                                        <i class="fas fa-comments fa-lg" style="float: left;"></i>
                                        <!-- .img-push is used to add margin to elements next to floating images -->
                                        <div class="img-push" style="margin-left: 2.5rem">
                                            <textarea cols="30" rows="1" class="form-control comment-textfield" style="resize:none;" placeholder="Press enter to post comment" data-id="<?php echo $row['PostID'] ?>"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <!-- End of Card footer -->
                                <div class="card-footer card-comments">
                                    <?php 
                                        $comments = $conn->query("SELECT comments.*,concat(users.Firstname,' ',users.Lastname) as name,users.profile_pic, users.userType FROM comments inner join users on users.UsersID = comments.UsersID where comments.PostID = {$row['PostID']} order by unix_timestamp(comments.date_created) desc ");
                                        while($crow = $comments->fetch_assoc()):
                                    ?>
                                    <div class="card-comment">
                                        <div class="row">
                                            <div class="col-auto">
                                                <!-- User image -->
                                                <img class="img-res-profile rounded-circle <?php 
                                                        if($crow["userType"] == "Resident"){
                                                            echo "img-res-profile";
                                                        }
                                                        elseif($crow["userType"] == "Purok Leader"){
                                                            echo "img-purokldr-profile";
                                                        }
                                                        elseif($crow["userType"] == "Captain"){
                                                            echo "img-capt-profile";
                                                        }
                                                        elseif($crow["userType"] == "Secretary"){
                                                            echo "img-sec-profile";
                                                        }
                                                        elseif($crow["userType"] == "Treasurer"){
                                                            echo "img-treas-profile";
                                                        }
                                                        elseif($crow["userType"] == "Admin"){
                                                            echo "img-admin-profile";
                                                        }
                                                    ?>" width="30" height="30" src="img/<?php echo $crow['profile_pic'] ?>"
                                                alt="User Image">
                                            </div>
                                            
                                            <div class="col-auto">
                                                <span class="username">
                                                    <span class="uname font-weight-bold text-dark"><?php echo $crow["name"] ?></span>
                                                    
                                                    <br> <!-- /.comment-text -->
                                                    <span class="comment">  
                                                        <?php echo $crow["comment"] ?> </span>
                                                    
                                                </span><!-- /.username -->
                                            </div>
                                            <div class="col-auto">
                                                <small><span class="text-mute timestamp" style="margin-left: auto;"><?php echo date("M d,Y h:i A",strtotime($crow['date_created'])) ?></span></small>
                                            </div>
                                            <?php if($_SESSION['UsersID'] == $crow['UsersID']): ?>
                                            <div class="dropdown no-arrow" style="margin-left: auto;">
                                                <button type="button" class="dropdown-toggle btn m-0 btn-circle" 
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v" aria-hidden="true"></i>
                                                </button>
                                                <div class="dropdown-menu shadow"
                                                    aria-labelledby="userDropdown">
                                                    <a class="dropdown-item edit_comment" data-id="<?php echo $crow['CommentsID'] ?>" href="javascript:void(0)">
                                                        <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-600"></i> Edit
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item delete_comment" data-id="<?php echo $crow['CommentsID'] ?>" href="javascript:void(0)">
                                                        <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-600"></i> Delete 
                                                    </a>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        <div class="d-flex justify-content-center">
                            <ul class="pagination">
                                <li class="m-3"><a href="?pageno=1"><i class="fas fa-angle-double-left fa-2x"></i></a></li>
                                <li class="m-3 <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                    <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><i class="fas fa-angle-left fa-2x"></i></a>
                                </li>
                                <li class="m-3"><?php echo $pageno, "/", $total_pages ?></li>
                                <li class="m-3 <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><i class="fas fa-angle-right fa-2x"></i></a>
                                </li>
                                <li class="m-3"><a href="?pageno=<?php echo $total_pages; ?>"><i class="fas fa-angle-double-right fa-2x "></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                    <div class="col-4">
                        <div class="row rounded mt-2 d-flex justify-content-center overflow-auto shadow">
                            <div class="calendar rounded text-white">
                                
                                <div class="month">
                                    <i class="fas fa-angle-left prev"></i>
                                    <div class="date">
                                        <h1></h1>
                                        <p></p>
                                    </div>
                                    <i class="fas fa-angle-right next"></i>
                                </div>
                
                                <div class="weekdays">
                                    <div>Sun</div>
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thu</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                </div>
                
                                <div class="days"></div>
                            </div>
                        </div> 
                        <!-- No billing account, can't use this :( -->        
                        <!-- <div class="card shadow mb-3">
                            
                            <div class="card-body">
                                <div id="map"></div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!--End of Content Row-->
                                                
            </div>
            <!-- End of Begin Page Content -->

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

    <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><b>&times;</b></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close btn-outline" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  </div>
    
    <script>
        function initMap(){
            var location = {lat: 10.316640, lng: 123.962510};
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10, 
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map 
            });
            
        }
        
    </script>

    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAY2FOL_OEWRFfi5SNvsKA0_I67P_bXviA&callback=initMap">
    </script>

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
        $('#write_post').click(function(){
            uni_modal("<center><b>Create Post</b></center></center>","includes/create_post.inc.php?add")
        })
        $('.edit_post').click(function(){
            uni_modal("<center><b>Edit Post</b></center></center>","includes/create_post.inc.php?id="+$(this).attr('data-id'))
        })
        $('.edit_comment').click(function(){
            uni_modal("<center><b>Edit Post</b></center></center>","includes/create_post.inc.php?commentedit&commentID="+$(this).attr('data-id'))
        })
        $('.delete_comment').click(function(){
            _conf("Are you sure you want to delete this comment?","delete_comment",[$(this).attr('data-id')])
        })
        $('.delete_post').click(function(){
            _conf("Are you sure you want to delete this post?","delete_post",[$(this).attr('data-id')])
        })
        function delete_post($id){
            start_load()
            $.ajax({
                url:'includes/delete_post.inc.php',
                method:'POST',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }
        function delete_comment($id){
            start_load()
            $.ajax({
                url:'includes/create_post.inc.php?commentdeletePOST',
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
            uni_modal("","includes/post.inc.php?viewAttach&id="+$(this).attr('data-id'),"modal-lg")
        })
        $('.view_more').click(function(e){
            e.preventDefault()
            uni_modal("","includes/post.inc.php?viewAttach&id="+$(this).attr('data-id'),"modal-lg")
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

    </script>

    
    
<?php include_once 'footer.php'; ?>