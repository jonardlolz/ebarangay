<?php
    if(!isset($_GET['brgyDetails'])){
        include_once "header.php";
    } 
    session_start();
    include "includes/dbh.inc.php";
    $sql = $conn->query("SELECT barangay.*, concat(users.Firstname, ' ', users.Lastname) as 
    CaptainName FROM barangay LEFT JOIN users ON barangay.brgyCaptain = users.UsersID WHERE BarangayID = '{$_GET['barangayID']}'");
    $row = $sql->fetch_assoc();
?>

<?php 
    if(isset($_GET['brgyDetails'])):
?>
    <style>
        #uni_modal .modal-footer{
		display: none;
        }
        #uni_modal .modal-footer.display{
            display: block !important;
	    }
    </style>
<?php endif; ?>

<div class="col d-flex flex-column px-4">
    <div class="row">
        <div class="col-sm-4">
            <div class="card shadow m-4">
                <div class="position-relative">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-dark">
                            <div class="text-center text-dark">
                                <div class="user-avatar w-100 d-flex justify-content-center">
                                    <span class="position-relative">
                                        <img src="img/<?php echo $row["barangay_pic"]; ?>" class="img-fluid img-thumbnail rounded-circle" style="width:150px; height:150px">
                                        <?php if($_SESSION["userType"] == "Captain" || $_SESSION['userBarangay'] == $row['BarangayName']): ?>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#ppModal" class="text-dark position-absolute rounded-circle img-thumbnail d-flex justify-content-center align-items-center" style="top:75%;left:75%;width:30px;height: 30px">
                                            <i class="fas fa-camera"></i>
                                        </a>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="mt-2">
                                    <h5 class="font-weight-bold">Barangay <?php echo $row['BarangayName'] ?></h5>
                                </div>
                            </div>
                        </h6>
                    </div>
                    <?php if($_SESSION["userType"] == "Captain" || $_SESSION['userBarangay'] == $row['BarangayName']): ?>
                        <a href="javascript:void(0)" class="edit_brgy text-dark position-absolute rounded-circle img-thumbnail d-flex justify-content-center align-items-center" style="top:93%;left:85%;width:30px;height: 30px" data-id="<?php echo $row['BarangayID'] ?>">
                            <i class="fas fa-edit"></i>
                        </a>
                    <?php endif; ?>
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
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contacts</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="officials" role="tabpanel" aria-labelledby="officials-tab">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <button class="btn btn-primary add_officer" data-id="<?php echo $row['BarangayName'] ?>">Add Officers</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php $i = 0;
                                        $officials = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users
                                        WHERE (userType='Captain'
                                        OR userType='Secretary'
                                        OR userType='Purok Leader'
                                        OR userType='Treasurer')
                                        AND userBarangay='{$row['BarangayName']}'"); ?>
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
                            </div>
                        </div>
                        <div class="tab-pane fade" id="purok" role="tabpanel" aria-labelledby="purok-tab">
                            <div class="card m-2">
                                <div class="card-header py-3 d-flex justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-dark">Puroks in <?php echo $row['BarangayName'] ?></h6>
                                    <?php if($_SESSION["userType"] == "Captain" || $_SESSION['userBarangay'] == $row['BarangayName']): ?>
                                    <a class="fas fa-plus fa-lg mr-2 text-gray-600 add_purok" data-id="<?php echo $row['BarangayID'] ?>"></a>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center text-dark" 
                                            id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                            <thead>
                                                <tr class="bg-gradient-secondary text-white">
                                                    <th scope="col">Purok</th> 
                                                    <th>Purok Leader</th>
                                                    <th scope="col">Status</th>
                                                    <?php if($_SESSION['userType'] == 'Captain' && $_SESSION['userBarangay'] == $row['BarangayName']): ?>
                                                    <th scope="col">Edit</th>
                                                    <?php endif; ?>
                                                </tr>
                                                
                                            </thead>
                                            <tbody>
                                                <!--Row 1-->
                                                <?php 
                                                    $purok = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name from purok LEFT JOIN users ON purok.purokLeader = users.UsersID WHERE BarangayName='{$row['BarangayName']}'");
                                                    while($purokrow=$purok->fetch_assoc()):
                                                ?>
                                                <tr>
                                                    <td><?php echo $purokrow["PurokName"] ?></td>
                                                    <td><?php if($purokrow['name'] != NULL){echo $purokrow['name'];}else{ echo "None"; } ?></td>
                                                    <td><?php if($purokrow["Active"] == 'True'){ echo 'Active'; }else{ echo 'Inactive'; } ?></td>
                                                    <?php if($_SESSION['userType'] == 'Captain' && $_SESSION['userBarangay'] == $purokrow['BarangayName']): ?>
                                                    <td>
                                                        <a class="fas fa-edit fa-md mr-2 text-gray-600 edit_purok" data-id="<?php echo $purokrow['PurokID'] ?>" href="javascript:void(0)"></a>
                                                    </td>
                                                    <?php endif; ?>
                                                    
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
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="container-fluid">
                                <div class="card m-2">
                                    <div class="card-header py-3 d-flex justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-dark">Contacts in <?php echo $row['BarangayName'] ?></h6>
                                        <?php if($_SESSION["userType"] == "Captain" || $_SESSION['userBarangay'] == $row['BarangayName']): ?>
                                        <a class="fas fa-plus fa-lg mr-2 text-gray-600 add_contact" data-id="<?php echo $row['BarangayID'] ?>"></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-center text-dark" 
                                                id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                                                <thead>
                                                    <tr class="bg-gradient-secondary text-white">
                                                        <th>Contact Name</th>
                                                        <th>Contact Number</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $contacts = $conn->query("SELECT * FROM contacts WHERE BarangayID='{$_GET['barangayID']}'");
                                                        while($row=$contacts->fetch_assoc()):
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row["contactName"] ?></td>
                                                        <td><?php echo $row["contactNum"] ?></td>
                                                    </tr>
                                                    <?php endwhile; ?>
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
    $('.edit_brgy').click(function(){
        uni_modal("<center><b>Barangay Details</b></center></center>","includes/barangay.inc.php?brgyEdit&barangayID="+$(this).attr("data-id"), "modal-md")
    })
    $('.add_contact').click(function(){
        uni_modal("<center><b>Barangay Contacts</b></center></center>","includes/barangay.inc.php?addContact&barangayID="+$(this).attr("data-id"), "modal-md")
    })
    $('.add_officer').click(function(){
        uni_modal("<center><b>Add Officer</b></center></center>","includes/barangay.inc.php?addOfficer&barangayName="+$(this).attr("data-id"), "modal-md")
    })
</script>

<?php include_once "footer.php" ?>