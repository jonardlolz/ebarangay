<?php 
include 'dbh.inc.php';
session_start();
?>

<?php if(isset($_GET['addPurpose'])): ?>
<div class="container-fluid">
    <form action="document.inc.php?add" >
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
                <label>Enter fee:</label>
            </div>
            <div class="col-sm-4">
                <input type="text" placeholder="Fee"></input>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5" style="text-align: right">
                <label>Student's Discount:</label>
            </div>
            <div class="col-sm-4">
                <input type="number" name="studentDiscount" value="0" min="0" max="100" placeholder="Fee"></input> %
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5" style="text-align: right">
                <label>Senior's Discount:</label>
            </div>
            <div class="col-sm-4">
                <input type="number" name="seniorDiscount" value="20" min="20" max="100" placeholder="Fee"></input> %
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5" style="text-align: right">
                <label>PWD's Discount:</label>
            </div>
            <div class="col-sm-4">
                <input type="number" name="pwdDiscount" value="0" min="0" max="100" placeholder="Fee"></input> %
            </div>
        </div>
    </form>
</div>
<?php elseif(isset($_GET['viewPurpose'])): ?>
<style>
    #uni_modal .modal-footer{
        display: none;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-end">
        <button class="btn btn-primary add_purpose" data-docu="<?php echo $_GET['docuType'] ?>" style="margin-bottom: 15px">Add Purpose</button>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered text-center text-dark" 
            id="dataTable" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                    <tr class="bg-gradient-secondary text-white">
                        <th>Purpose</th>
                        <th>Price</th>
                        <th>Student Discount</th>
                        <th>Senior Discount</th>
                        <th>PWD Discount</th>
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
                        <td><?php echo $row['price'] ?></td>
                        <td><?php echo $row['studentDiscount'] ?> %</td>
                        <td><?php echo $row['seniorDiscount'] ?> %</td>
                        <td><?php echo $row['pwdDiscount'] ?> %</td>
                    </tr>
                    
                    <?php 
                        $x++; endwhile; 
                        if($x <= 0):
                    ?>
                    <tr>
                        <td colspan="5" class="align-center">No data in this table.</td>
                        
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


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
</script>