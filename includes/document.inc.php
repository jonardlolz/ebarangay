<?php 
include 'dbh.inc.php';
session_start();
?>

<?php if(isset($_GET['addPurpose']) || isset($_GET['editPurpose'])): ?>
<div class="container-fluid">
    <?php if(isset($_GET['addPurpose'])): ?>
        <form action="includes/document.inc.php?add&docuType=<?php echo $_GET['docuType'] ?>" method="POST">
    <?php elseif(isset($_GET['editPurpose'])): ?>
        <form action="includes/document.inc.php?edit&docuType=<?php echo $_GET['docuType'] ?>&purposeID=<?php echo $_GET['purposeID'] ?>" method="POST">
    <?php endif; ?>
        <?php if(isset($_GET['editPurpose'])){
            $sql = $conn->query("SELECT * FROM documentpurpose WHERE purposeID='{$_GET['purposeID']}'");
            $editPurpose = $sql->fetch_assoc();
        } ?>
        <div class="form-group row">
            <div class="col-sm-5" style="text-align: right">
                <label>Document name:</label>
            </div>
            <div class="col-sm-6">
                <label><b><?php echo $_GET['docuType']?></b></label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5" style="text-align: right">
                <label>Purpose:</label>
            </div>
            <div class="col-sm-4">
                <input type="text" name="purpose" placeholder="Purpose" 
                <?php if(isset($_GET['editPurpose'])): ?> 
                    value="<?php echo $editPurpose['purpose'] ?>">
                <?php endif; ?>
                </input>
            </div>
        </div>
    </form>
</div>
<?php elseif(isset($_GET['viewPurpose'])): 
    $purposeSql = $conn->query("SELECT documentpurpose.*, documenttype.* FROM documentpurpose LEFT JOIN documenttype ON barangayDoc=documentName WHERE barangayDoc='{$_GET['docuType']}' AND barangay='{$_SESSION['userBarangay']}'");
    $purpose = $purposeSql->fetch_assoc();
?>
<style>
    #uni_modal .modal-footer{
        display: none;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-end">
        <button class="btn btn-primary add_purpose" data-docu="<?php echo $purpose['barangayDoc'] ?>" style="margin-bottom: 15px">Add Purpose</button>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered text-center text-dark" 
            id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                    <tr class="bg-gradient-secondary text-white">
                        <th>Purpose</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql=$conn->query("SELECT * FROM documentpurpose WHERE barangayDoc='{$_GET['docuType']}' AND barangay='{$_SESSION['userBarangay']}'");
                        $x = 0;
                        while($row=$sql->fetch_assoc()):
                        
                    ?>
                    <tr>
                        <td><?php echo $row['purpose'] ?></td>
                        <td>
                            <a href="javascript:void(0)" class="edit_purpose" data-id="<?php echo $row['purposeID'] ?>" data-docu="<?php echo $_GET['docuType'] ?>"><i class="fas fa-edit"></i></a>
                            <a href="javascript:void(0)" class="delete_purpose" data-id="<?php echo $row['purposeID'] ?>" data-docu="<?php echo $row['purposeID'] ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    
                    <?php 
                        $x++; endwhile; 
                        if($x <= 0):
                    ?>
                    <tr>
                        <td colspan="6" class="align-center">No data in this table.</td>
                        
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php elseif(isset($_GET['addDocument'])): ?>

<div class="container-fluid">
    <form action="includes/document.inc.php?postdocumentAdd&barangay=<?php echo $_GET['barangay'] ?>" method="POST">
        <div class="form-group col">
            <div class="row">
                <div class="col">
                    Document name:
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="text" name="documentName">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Document description:
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="text" name="documentDesc">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Include fee?
                </div>
                <div class="col">
                    <input type="checkbox" name="documentFee" id="documentFee" value="True">
                </div>
            </div>
        </div>
    </form>
</div>

<?php elseif(isset($_GET['editDocument'])): ?>

<div class="container-fluid">
    <?php $sql = $conn->query("SELECT * FROM documenttype WHERE DocumentID={$_GET['documentid']}");
    $documentinfo = $sql->fetch_assoc(); ?>
    <form action="includes/document.inc.php?postdocumentEdit&barangayid=<?php echo $documentinfo['DocumentID'] ?>" method="POST">
        <div class="form-group col">
            <div class="row">
                <div class="col">
                    Document name:
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="text" name="documentName" value="<?php echo $documentinfo['documentName'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Document description:
                </div>
                <div class="col">
                    <input class="form-control form-control-sm" type="text" name="documentDesc" value="<?php echo $documentinfo['documentDesc'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Include fee?
                </div>
                <div class="col">
                    <input type="checkbox" name="documentFee" id="documentFee" value="True" <?php if($documentinfo['allowFee']=='True'): echo 'checked'; endif; ?>>
                </div>
            </div>
        </div>
    </form>
</div>

<?php elseif(isset($_GET['delete'])):
    extract($_POST);
    $sql = $conn->query("DELETE FROM documentpurpose WHERE purposeID = $id");
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../document.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../document.php?error=none"); //no errors were made
    exit();
?>

<?php elseif(isset($_GET['add'])): 
    extract($_POST);
    $sql = "INSERT INTO documentpurpose(purpose, barangayDoc, barangay)
            VALUES('$purpose', '{$_GET['docuType']}', '{$_SESSION['userBarangay']}')";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../request.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../request.php?error=none"); //no errors were made
    exit();
    
?>
<?php elseif(isset($_GET['edit'])):
    extract($_POST);
    $sql = "UPDATE documentpurpose SET purpose='$purpose' WHERE purposeID={$_GET['purposeID']}";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../request.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../request.php?error=none"); //no errors were made
    exit();
?>
<?php elseif(isset($_GET['postdocumentAdd'])): 
    extract($_POST);
    
    if($documentFee == ''){
        $documentFee = 'False';
    }

    $sql = "INSERT INTO documenttype(documentName, barangayName, documentDesc, allowFee)
            VALUES('$documentName', '{$_GET['barangay']}', '$documentDesc', '$documentFee')";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../request.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../request.php?error=none"); //no errors were made
    exit();
    
?>
<?php elseif(isset($_GET['postdocumentEdit'])): 
    extract($_POST);
    
    if($documentFee == ''){
        $documentFee = 'False';
    }

    $sql = "UPDATE documenttype SET documentName='$documentName', allowFee='$documentFee', documentdesc='$documentDesc' WHERE DocumentID={$_GET['barangayid']}";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo("Error description: " . mysqli_error($conn));
        exit();
    }

    if(!mysqli_stmt_execute($stmt)){
        echo("Error description: " . mysqli_error($conn));
        header("location: ../request.php?error=sqlExecError");
        exit();
    }
    mysqli_stmt_close($stmt);

    header("location: ../request.php?error=none"); //no errors were made
    exit();
    
?>
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

    $('.add_purpose').click(function(){
        secondary_modal("<center><b>Add purpose for " + $(this).attr('data-docu') + "</b></center></center>","includes/document.inc.php?addPurpose&docuType="+$(this).attr('data-docu'));
    })
    $('.edit_purpose').click(function(){
        secondary_modal("<center><b>Edit purpose for " + $(this).attr('data-docu') + "</b></center></center>","includes/document.inc.php?editPurpose&docuType="+$(this).attr('data-docu')+"&purposeID="+$(this).attr('data-id'));
    })
    $('.delete_purpose').click(function(){
        _conf("Are you sure you want to delete this purpose?","deletePurpose",[$(this).attr('data-id')]);
    })
    function deletePurpose($id){
        start_load()
        $.ajax({
            url:'includes/document.inc.php?delete',
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }
</script>