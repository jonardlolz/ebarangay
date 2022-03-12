<?php include_once "header.php" ?>

<!--Begin Page-->
<div class="container p-4">

<!--Residents Requests-->
<div class="card shadow mb-4 m-4">
    <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-dark">Accounts: Purok Leaders</h6>
            <a class="fas fa-plus fa-lg mr-2 text-gray-600 add_account" href="javascript:void(0)"></a>
    </div>
    
    <div class="card-body" style="font-size: 75%">
        <div class="table-responsive">
            <table class="table table-bordered text-center text-dark" 
                id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                <thead >
                    <!-- <tr class="bg-gradient-warning">
                        <th colspan="5">Resident</th>
                        <th colspan = "2">Address</th>
                        <th colspan="3">Contacts</th>
                        <th colspan="2">Options</th>                   
                    </tr> --> 
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
                            
                            <?php echo $row["name"] ?>
                        </td>
                        <td><?php echo $row["userType"] ?></td>
                        <td><?php echo $row["userPurok"] ?></td>
                        <td><?php echo $row["userAddress"] ?></td>
                        <td><?php echo $row["userHouseNum"] ?></td>
                        <td><?php echo $row["username"] ?></td>
                        <td>
                            <a class="fas fa-trash fa-md mr-2 text-gray-600 deactivate_account" data-id="<?php echo $row['UsersID'] ?>" href="javascript:void(0)"></a>
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
<!--Residents Requests-->
</div>
</div>
<!--row-->
</div>
<!--Content-wrapper-->

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
        $('.add_account').click(function(){
            uni_modal("<center><b>Add Account</b></center></center>","includes/account.inc.php")
        })
        $('.edit_account').click(function(){
            uni_modal("<center><b>Edit Account</b></center></center>","includes/account.inc.php?id="+$(this).attr('data-id'))
        })
        $('.deactivate_account').click(function(){
        _conf("Are you sure to deactivate this account?","deactivate_account",[$(this).attr('data-id')])
        })
        function deactivate_account($id){
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

    </script>

<?php include_once "footer.php" ?>