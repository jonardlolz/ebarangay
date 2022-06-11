<?php 
    if(!isset($_GET['viewProfile'])){
        include_once 'header.php';
        
    }
    else{
        session_start();
        include 'includes/dbh.inc.php';
    }

    $profile = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname, ' ', COALESCE(users.userSuffix,'')) as name FROM users WHERE UsersID='{$_GET['UsersID']}'");
    $row=$profile->fetch_assoc();
?>

<link rel="stylesheet" href="css/cb2.css">

<div class="col d-flex flex-column px-4">
    <div class="card rounded shadow" style="background-color: #dcdce4;">
        <!--Card-header-->
        <div class="card-header">
            <div class="text-center text-dark">
                <div class="user-avatar w-100 d-flex justify-content-center">
                    <span class="position-relative">
                        <img src="img/users/<?php echo $row['UsersID'] ?>/profile_pic/<?php echo $row["profile_pic"]; ?>" alt="Maxwell Admin" class="img-fluid img-thumbnail rounded-circle <?php 
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
                        ?>" style="width:150px; height:150px">
                        <?php if(!isset($_GET['viewProfile'])): ?>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#ppModal" class="text-dark position-absolute rounded-circle img-thumbnail d-flex justify-content-center align-items-center" style="top:75%;left:75%;width:30px;height: 30px">
                                <i class="fas fa-camera"></i>
                            </a>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="mt-2">
                    <h5 class="font-weight-bold"><?php echo $row['name'] ?></h5>
                    <h6 readonly><?php echo $row["emailAdd"]; ?></h6>
                </div>
            </div>
            <?php if(!isset($_GET['viewProfile'])): ?>
            <div class="text-center">
                <!--Trigger Button Chat-->
                <?php if($row['VerifyStatus'] == 'Verified'): ?>
                    <i class="fas fa-user-check fa-lg" alt="Verified" style="color: #0ca678"></i>
                <?php elseif($row['VerifyStatus'] == 'Unverified'): ?>  
                    <i class="fas fa-user-slash fa-lg" alt="Unverified" style="color: #e63d2e"></i>
                <?php elseif($row['VerifyStatus'] == 'Pending'): ?>
                    <i class="fas fa-user fa-lg" alt="Pending verification"></i>
                <?php endif; ?>
                <a class="edit_account" href="javascript:void(0)" data-id="<?php echo $_GET['UsersID'] ?>"><i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editProfileModal" data-backdrop="static"></i></a>
                <a class="edit_password" href="javascript:void(0)" data-id="<?php echo $_GET['UsersID'] ?>"><i class="fas fa-key fa-lg"></i></a>
                <?php if($row['userType'] == "Resident"): ?>
                <a class="view_requests" href="javascript:void(0)"><i class="fas fa-file fa-lg"></i></a>
                <a class="view_reklamos" href="javascript:void(0)"><i class="fas fa-exclamation-triangle fa-lg"></i></a>
                <?php else: ?>
                <a class="view_report" data-id="<?php echo $_GET['UsersID'] ?>" href="javascript:void(0)"><i class="fas fa-history fa-lg"></i></a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="text-center">
                <h6 class="m-2">
                    <?php $detail="";
                    if($row['IsVoter'] == "True"){
                        $detail .= "Voter";
                    }
                    if($row['IsVoter'] == "False"){
                        $detail .= "Non-Voter";
                    }
                    if($row['isRenting'] == "True"){
                        $detail .= ", Renter";
                    }
                    if($row['IsLandlord'] == "True"){
                        $detail .= ", Landlord";
                    }
                    if($row['IsLandlord'] == "False" && $row['isRenting'] == "False"){
                        $detail .= ", Resident";
                    }
                
                    echo $detail;
                    ?>
                </h6>
            </div>
        </div>
        <!--End of Card-Header-->
        <!--Card-Body-->
        <div class="card-body text-dark">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-2">
                        <div>
                            <strong>Personal Information</strong><hr>
                        </div>
                        <label class="labels">Name</label>
                        <input type="text" class="form-control w-75" placeholder="Fname Mname Lname" value="<?php echo "{$row['Firstname']} {$row['Middlename']} {$row['Lastname']} {$row['userSuffix']}"?>" readonly>
                        <label class="labels">Gender</label>
                        <input type="text" class="form-control w-75" placeholder="Gender" value="<?php echo $row["userGender"] ?>" readonly>
                        <label class="labels">Birthdate</label>
                        <input type="date" class="form-control w-75" placeholder="Birthdate" value="<?php echo $row["dateofbirth"] ?>" readonly>
                        <label class="labels">Civil Status</label>
                        <input type="text" class="form-control w-75" placeholder="Birthdate" value="<?php echo $row["civilStat"] ?>" readonly>
                        <label class="labels">Date Resides</label>
                        <input type="date" class="form-control w-75" placeholder="Birthdate" value="<?php echo $row["startedLiving"] ?>" readonly>
                    </div>
                    <div class="p-2">
                        <div>
                            <strong>Address Information</strong><hr>
                        </div>
                        <div class="row-md-4 row-sm-4">
                            <label class="labels">House Number</label>
                            <input type="text" class="form-control w-75" value="<?php if($row['teleNum'] == NULL){ echo "None"; }else{ echo $row["userHouseNum"]; }?>" readonly>
                            <label class="labels">Purok</label>
                            <input type="text" class="form-control w-75" placeholder="Barangay" value="<?php echo $row["userPurok"] ?>" readonly>
                            <label class="labels">Barangay</label>
                            <input type="text" class="form-control w-75" placeholder="Barangay" value="<?php echo $row["userBarangay"] ?>" readonly>
                            <label class="labels">Municipality/City</label>
                            <input type="text" class="form-control w-75" placeholder="City" value="<?php echo $row["userCity"] ?>" readonly>
                        </div>
                        
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-2">
                        <div>
                            <strong>Contact Information</strong><hr>
                        </div>
                        <label class="labels">Phone Number</label>
                        <input type="text" class="form-control w-75" value="<?php if($row['phoneNum'] == NULL){ echo "None"; }else{ echo $row["phoneNum"]; }?>" readonly>
                        <label class="labels">Telephone Number</label>
                        <input type="text" class="form-control w-75" value="<?php if($row['teleNum'] == NULL){ echo "None"; }else{ echo $row["teleNum"]; }?>" readonly>
                        <label class="labels">Email Address</label>
                        <input type="email" class="form-control w-75" placeholder="@email" value="<?php echo $row["emailAdd"] ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Card-Body-->
    </div>
    <div class="modal fade" id="ppModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
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
                            <img src="img/<?php echo $_SESSION["profile_pic"]; ?>" alt="" id="profile" class="img-fluid img-thumbnail rounded-circle" style="max-width: calc(50%)">
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
    $(".col").parent().siblings(".modal-footer").remove();
   
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }
    
    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }

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
    window.secondary_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#secondary_modal .modal-title').html($title)
                    $('#secondary_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#secondary_modal .modal-dialog').addClass($size)
                    }else{
                        $('#secondary_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                    }
                    $('#secondary_modal').modal({
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
    $('.view_reklamos').click(function(){
        uni_modal("<center><b>View Reklamos</b></center></center>","includes/profileupdate.inc.php?viewReklamo&UsersID="+$(this).attr('data-id'), 'modal-lg')
    })
    $('.view_requests').click(function(){
        uni_modal("<center><b>View Requests</b></center></center>","includes/profileupdate.inc.php?viewRequest&UsersID="+$(this).attr('data-id'), 'modal-lg')
    })
    $('.view_report').click(function(){
        uni_modal("<center><b>View Report</b></center></center>","includes/profileupdate.inc.php?viewHistory&UsersID="+ $(this).attr('data-id'), "modal-lg")
    })
    $('.add_account').click(function(){
        uni_modal("<center><b>Add Account</b></center></center>","includes/account.inc.php")
    })
    $('.edit_account').click(function(){
        uni_modal("<center><b>Edit Account</b></center></center>","includes/account.inc.php?edit="+$(this).attr('data-id'))
    })
    $('.edit_password').click(function(){
        uni_modal("<center><b>Change Password</b></center></center>","includes/account.inc.php?changePass="+$(this).attr('data-id'))
    })
    
    $('.delete_reklamo').click(function(){
    _conf("Are you sure want to cancel this reklamo?","cancelReklamo",[$(this).attr('data-id')])
    })
    function cancelRequest($id){
            start_load()
            $.ajax({
                url:'includes/deleteRequest.inc.php',
                method:'POST',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }
    function cancelReklamo($id){
        start_load()
        $.ajax({
            url:'includes/deleteReklamo.inc.php',
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
    $('#dataTable').DataTable();
    } );

    $(document).ready(function() {
    $('#dataTable2').DataTable();
    } );

    var mealsByCategory = {
    <?php 
        $puroks = array();
        $barangay = $conn->query("SELECT * FROM barangay");
        while($brow = $barangay->fetch_assoc()):
    ?>
        <?php 
        echo json_encode($brow["BarangayName"]) ?> : <?php $purok = $conn->query("SELECT * FROM purok WHERE BarangayName='{$brow['BarangayName']}'"); 
        while($prow = $purok->fetch_assoc()):
        $puroks[] = $prow["PurokName"]?>
    <?php endwhile; echo json_encode($puroks). ","; $puroks = array();?>
    <?php endwhile; ?>
    }

    function changecat(value) {
        if (value.length == 0) document.getElementById("userPurok").innerHTML = "<option></option>";
        else {
            var catOptions = "";
            for (categoryId in mealsByCategory[value]) {
                catOptions += "<option>" + mealsByCategory[value][categoryId] + "</option>";
            }
            document.getElementById("userPurok").innerHTML = catOptions;
        }
    }
</script>

<?php if(!isset($_GET['viewProfile'])){
    include_once 'footer.php'; 
    }
?>