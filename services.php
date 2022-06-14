<?php include 'header.php'; ?>
                            
    <?php $userData=$conn->query("SELECT * FROM users WHERE UsersID={$_SESSION['UsersID']}")->fetch_assoc(); ?>
    <!-- Begin Page Content -->
    <div class="col d-flex flex-column px-4">
        <div class="card shadow mb-4 m-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Services</h6>
            </div>
        
            <div class="card-body" style="font-size: 75%">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="document-tab" data-toggle="tab" href="#document" role="tab" aria-controls="document" aria-selected="true">Request Document</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="released-tab" data-toggle="tab" href="#released" role="tab" aria-controls="approved" aria-selected="false">eReklamo services</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane show active" id="document" role="tabpanel" aria-labelledby="document-tab">
                        <div class="container p-4">
                            <button class="btn btn-primary add_document" data-id="<?php echo $_SESSION['userBarangay'] ?>"><i class="fas fa-plus"></i> New Document</button>
                            <?php $i = 0;
                                $documents = $conn->query("SELECT * FROM documenttype WHERE barangayName='{$_SESSION['userBarangay']}'"); ?>
                            <?php while($i < mysqli_num_rows($documents)): ?>
                            <div class="row" style="margin: 25px">
                                <?php while($documentRow = $documents->fetch_assoc()): ?>
                                <div class="col-sm-4">
                                    <?php if($documentRow['status'] == 'Active'): ?>
                                    <div class="card" style="min-height: 100px; border-color: green">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <div class="row">
                                                    <div class="col">
                                                        <?php echo $documentRow['documentName'] ?>
                                                    </div>
                                                    <div class="col-sm-3" style="text-align: right;">
                                                    <div class="dropdown no-arrow" style="margin-left: auto;">
                                                        <a type="button" class="btn-sm dropdown-toggle btn m-0 btn-circle"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v fw" aria-hidden="true"></i>
                                                        </a>
                                                        <div class="dropdown-menu shadow"
                                                            aria-labelledby="userDropdown">
                                                            <a class="dropdown-item document_edit" data-id="<?php echo $documentRow['DocumentID'] ?>" data-docu="<?php echo $documentRow['documentName'] ?>" href="javascript:void(0)">
                                                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-600"></i> Options
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item delete_document" data-id="<?php echo $documentRow['DocumentID'] ?>" href="javascript:void(0)">
                                                                <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-600"></i> Hide
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </h5>
                                            <p class="card-text"><?php if(isset($documentRow['documentdesc'])){echo $documentRow['documentdesc'];} ?></p>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="card" style="min-height: 100px; border-color: red">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <div class="row">
                                                    <div class="col">
                                                        <?php echo $documentRow['documentName'] ?>
                                                    </div>
                                                    <div class="col-sm-3" style="text-align: right;">
                                                    <div class="dropdown no-arrow" style="margin-left: auto;">
                                                        <a type="button" class="btn-sm dropdown-toggle btn m-0 btn-circle"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v fw" aria-hidden="true"></i>
                                                        </a>
                                                        <div class="dropdown-menu shadow"
                                                            aria-labelledby="userDropdown">
                                                            <a class="dropdown-item document_edit" data-id="<?php echo $documentRow['DocumentID'] ?>" data-docu="<?php echo $documentRow['documentName'] ?>" href="javascript:void(0)">
                                                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-600"></i> Options
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item active_document" data-id="<?php echo $documentRow['DocumentID'] ?>" href="javascript:void(0)">
                                                                <i class="fas fa-chevron-up fa-sm fa-fw mr-2 text-gray-600"></i> Activate
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </h5>
                                            <p class="card-text"><?php if(isset($documentRow['documentdesc'])){echo $documentRow['documentdesc'];} ?></p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php $i++; if($i % 3 == 0){ break; } endwhile; ?>
                            </div>
                            <?php endwhile; ?>
                            <?php if(isset($_GET['error'])): ?> 
                                <?php if($_GET['error'] == 'documentduplicate'): ?>
                                    <div class="alert alert-danger">
                                        <h3>That document already exists!</h3>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="released" role="tabpanel" aria-labelledby="released-tab">
                        <div class="container p-4">
                            <button class="btn btn-primary add_ereklamoCat" data-id="<?php echo $_SESSION['userBarangay'] ?>"><i class="fas fa-plus"></i> New Reklamo Category</button>
                            <?php $i = 0;
                            $reklamo = $conn->query("SELECT * FROM ereklamocategory WHERE reklamoCatBrgy='{$_SESSION['userBarangay']}'"); ?>
                            <?php while($i < mysqli_num_rows($reklamo)): ?>
                            <div class="row" style="margin: 25px">
                                <?php while($reklamoRow = $reklamo->fetch_assoc()): ?>
                                <div class="col-sm-4">
                                    <?php if($reklamoRow['status'] == 'Active'): ?>
                                    <div class="card" style="min-height: 100px; border-color: green">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <div class="row">
                                                    <div class="col">
                                                        <?php echo $reklamoRow['reklamoCatName'] ?>
                                                    </div>
                                                    <div class="col-sm-3" style="text-align: right;">
                                                    <div class="dropdown no-arrow" style="margin-left: auto;">
                                                        <a type="button" class="btn-sm dropdown-toggle btn m-0 btn-circle"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v fw" aria-hidden="true"></i>
                                                        </a>
                                                        <div class="dropdown-menu shadow"
                                                            aria-labelledby="userDropdown">
                                                            <a class="dropdown-item document_edit" data-id="<?php echo $reklamoRow['reklamoCatID'] ?>" data-docu="<?php echo $reklamoRow['reklamoCatName'] ?>" href="javascript:void(0)">
                                                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-600"></i> Options
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item delete_document" data-id="<?php echo $reklamoRow['reklamoCatID'] ?>" href="javascript:void(0)">
                                                                <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-600"></i> Hide
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </h5>
                                            <hr>
                                            <p class="card-text">
                                                <div class="row">
                                                    <div class="col">
                                                        Test
                                                    </div>
                                                    <div class="col">
                                                        <i class="fas fa-cog"></i>
                                                    </div>
                                                </div>
                                            </p>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="card" style="min-height: 100px; border-color: red">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <div class="row">
                                                    <div class="col">
                                                        <?php echo $documentRow['documentName'] ?>
                                                    </div>
                                                    <div class="col-sm-3" style="text-align: right;">
                                                    <div class="dropdown no-arrow" style="margin-left: auto;">
                                                        <a type="button" class="btn-sm dropdown-toggle btn m-0 btn-circle"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v fw" aria-hidden="true"></i>
                                                        </a>
                                                        <div class="dropdown-menu shadow"
                                                            aria-labelledby="userDropdown">
                                                            <a class="dropdown-item document_edit" data-id="<?php echo $documentRow['DocumentID'] ?>" data-docu="<?php echo $documentRow['documentName'] ?>" href="javascript:void(0)">
                                                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-600"></i> Options
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item active_document" data-id="<?php echo $documentRow['DocumentID'] ?>" href="javascript:void(0)">
                                                                <i class="fas fa-chevron-up fa-sm fa-fw mr-2 text-gray-600"></i> Activate
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </h5>
                                            <p class="card-text"><?php if(isset($documentRow['documentdesc'])){echo $documentRow['documentdesc'];} ?></p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php $i++; if($i % 3 == 0){ break; } endwhile; ?>
                            </div>
                            <?php endwhile; ?>
                            <?php if(isset($_GET['error']) == 'duplicate'): ?> 
                            <div class="alert alert-danger">
                                <h3>That document already exists!</h3>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- <div class="col m-4">
                                <div class="card" style="min-height: 200px">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col">
                                                <strong>
                                                    Major
                                                </strong>
                                            </div>
                                            <div class="col-sm-2" style="text-align: right;">
                                                <a class="add_ereklamoCat" data-priority="Major" href="javascript:void(0)"><i class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="accordion">
                                            <?php $majorSql = $conn->query("SELECT * FROM ereklamocategory WHERE reklamoCatPriority = 'Major'");
                                            $i = 0;
                                            $allRows = $majorSql->num_rows;
                                            while($majorRow = $majorSql->fetch_assoc()):
                                            ?>
                                            <div class="row">
                                                <div class="col" data-toggle="collapse" data-target="#collapse<?php echo str_replace(' ', '', $majorRow['reklamoCatName']) ?>" aria-expanded="true" aria-controls="collapse<?php echo str_replace(' ', '', $majorRow['reklamoCatName']) ?>">
                                                    <?php echo $majorRow['reklamoCatName'] ?>
                                                </div>
                                                <div class="col-sm-3" style="text-align: right;">
                                                    <a class="edit_ereklamoCat" href="javascript:void(0)" data-id="<?php echo $majorRow['reklamoCatID'] ?>" data-name="<?php echo $majorRow['reklamoCatName'] ?>"><i class="fas fa-edit"></i></a>
                                                    <a class="delete_ereklamoCat" href="javascript:void(0)" data-id="<?php echo $majorRow['reklamoCatID'] ?>" data-name="<?php echo $majorRow['reklamoCatName'] ?>"><i class="fas fa-trash"></i></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="card-body">
                                                    <div id="collapse<?php echo str_replace(' ', '', $majorRow['reklamoCatName']) ?>" class="collapse-show" aria-labelledby="heading<?php echo str_replace(' ', '', $majorRow['reklamoCatName']) ?>" data-parent="#accordion">
                                                        <div class="col">
                                                            <?php $minorType = $conn->query("SELECT * FROM ereklamotype WHERE reklamoCatID={$majorRow['reklamoCatID']}");
                                                            while($minorTypeRow = $minorType->fetch_assoc()): 
                                                            ?>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <?php echo $minorTypeRow['reklamoTypeName'] ?>
                                                                </div>
                                                                <div class="col-sm-2" style="text-align right;">
                                                                    <a class="edit_type" href="javascript:void(0)" data-id="<?php echo $minorTypeRow['reklamoTypeID'] ?>" data-name="<?php echo $minorTypeRow['reklamoTypeName'] ?>"><i class="fas fa-edit"></i></a>
                                                                    <a class="delete_type" href="javascript:void(0)" data-id="<?php echo $minorTypeRow['reklamoTypeID'] ?>" data-name="<?php echo $minorTypeRow['reklamoTypeName'] ?>"><i class="fas fa-trash"></i></a>
                                                                </div>
                                                                <hr>    
                                                            </div>
                                                            <?php endwhile; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col m-4">
                                <div class="col-sm-6 card" style="min-height: 200px">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col">
                                                <strong>
                                                    eReklamo
                                                </strong>
                                            </div>
                                            <div class="col-sm-2" style="text-align: right;">
                                                <a class="add_ereklamoCat" data-priority="Minor" href="javascript:void(0)"><i class="fas fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="accordion">
                                            <?php $minorSql = $conn->query("SELECT * FROM ereklamocategory WHERE reklamoCatBrgy='{$_SESSION['userBarangay']}' AND reklamoCatPriority = 'Minor'");
                                            $i = 0;
                                            $allRows = $minorSql->num_rows;
                                            while($minorRow = $minorSql->fetch_assoc()):
                                            ?>
                                            <div class="row">
                                                <div class="col" data-toggle="collapse" data-target="#collapse<?php echo str_replace(' ', '', $minorRow['reklamoCatName']) ?>" aria-expanded="true" aria-controls="collapse<?php echo str_replace(' ', '', $minorRow['reklamoCatName']) ?>">
                                                    <?php echo $minorRow['reklamoCatName'] ?>
                                                </div>
                                                <div class="col-sm-3" style="text-align: right;">
                                                    <a class="edit_ereklamoCat" href="javascript:void(0)" data-id="<?php echo $minorRow['reklamoCatID'] ?>" data-name="<?php echo $minorRow['reklamoCatName'] ?>"><i class="fas fa-edit"></i></a>
                                                    <a class="delete_ereklamoCat" href="javascript:void(0)" data-id="<?php echo $minorRow['reklamoCatID'] ?>" data-name="<?php echo $minorRow['reklamoCatName'] ?>"><i class="fas fa-trash"></i></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="card-body">
                                                    <div id="collapse<?php echo str_replace(' ', '', $minorRow['reklamoCatName']) ?>" class="collapse-show" aria-labelledby="heading<?php echo str_replace(' ', '', $minorRow['reklamoCatName']) ?>" data-parent="#accordion">
                                                        <div class="col">
                                                            <?php $minorType = $conn->query("SELECT * FROM ereklamotype WHERE reklamoCatID={$minorRow['reklamoCatID']}");
                                                            while($minorTypeRow = $minorType->fetch_assoc()): 
                                                            ?>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <?php echo $minorTypeRow['reklamoTypeName'] ?>
                                                                </div>
                                                                <div class="col-sm-2" style="text-align right;">
                                                                    <a class="edit_type" href="javascript:void(0)" data-id="<?php echo $minorTypeRow['reklamoTypeID'] ?>" data-name="<?php echo $minorTypeRow['reklamoTypeName'] ?>"><i class="fas fa-edit"></i></a>
                                                                    <a class="delete_type" href="javascript:void(0)" data-id="<?php echo $minorTypeRow['reklamoTypeID'] ?>" data-name="<?php echo $minorTypeRow['reklamoTypeName'] ?>"><i class="fas fa-trash"></i></a>
                                                                </div>
                                                                <hr>    
                                                            </div>
                                                            <?php endwhile; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile; ?>
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

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog" role="document" style="border-color:#384550 ;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Ready to Leave?</h5>
                        <!--<button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>-->    <!--push-->
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <a class="btn btn-outline-primary" href="login.php">Logout</a>
                        <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
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
    window.verifyInfo_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#verifyInfo .modal-title').html($title)
                    $('#verifyInfo .modal-body').html(resp)
                    if($size != ''){
                        $('#verifyInfo .modal-dialog').addClass($size)
                    }else{
                        $('#verifyInfo .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                    }
                    $('#verifyInfo').modal({
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
    window.print_modal = function($title = '' , $url='',$size=""){
        start_load()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#print_modal .modal-title').html($title)
                    $('#print_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#print_modal .modal-dialog').addClass($size)
                    }else{
                        $('#print_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-lg")
                    }
                    $('#print_modal').modal({
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
    $('.continueRequest').click(function(){
        var ddl = document.getElementById("document");
        var selectedValue = ddl.options[ddl.selectedIndex].value;
        var ddl2 = document.getElementById("purpose");
        var selectedValue2 = ddl2.options[ddl2.selectedIndex].value;
        if (selectedValue == ""){
            alert("Please select a document");
        }
        else if(selectedValue2 == ""){
            alert("Please select a valid purpose");
        }
        else{
            verifyInfo_modal("<center><b>Verify Information</b></center>","includes/request.inc.php?continueRequest&usersid="+$(this).attr("data-id") +"&docType="+$("#document").val()+"&purpose="+$("#purpose").val());
        }
    })
    $('.viewRequirement').click(function(){
        uni_modal("Requirements given","includes/request.inc.php?viewRequirement&RequestID="+$(this).attr('data-id'), "modal-lg");
    })
    $('#print').click(function(){
        print_modal("<center><b>Print</b></center></center>","brgy_clearance.php?requestID="+$(this).attr('data-id'));
    })
    $('.delete_document').click(function(){
        _conf("Are you sure you want to hide this document?","delete_document",[$(this).attr('data-id')])
    })
    $('.active_document').click(function(){
        _conf("Are you sure you want to activate this document?","active_document",[$(this).attr('data-id')])
    })
    $('.paid_request').click(function(){
        _conf("Confirm the request is paid?","paid_request",[$(this).attr('data-id')])
    })
    $('.releaseFunc').click(function(){
        _conf("Release the document?","releaseDoc",[$(this).attr('data-id')])
    })
    $('.view_profile').click(function(){
        uni_modal("<center>Profile</center>","profile_alt.php?viewProfile&UsersID="+$(this).attr('data-id'), "modal-lg");
    })
    $('.document_edit').click(function(){
        uni_modal("<center><b>Document edit for " + $(this).attr('data-docu') + "</b></center></center>","includes/document.inc.php?viewPurpose&docuName="+$(this).attr('data-docu')+"&docuType="+$(this).attr('data-id'), "modal-lg");
    })
    $('.add_document').click(function(){
        uni_modal("<center><b>New document </b></center></center>","includes/document.inc.php?addDocument&barangay="+$(this).attr('data-id'));
    })
    $('.comment-textfield').on('change keyup keydown paste cut', function (e) {
            if(this.scrollHeight <= 117)
            $(this).height(0).height(this.scrollHeight);
        })

        $('.set-schedule').click(function(){
            _conf("Change status for reklamo to be scheduled?","set_schedule",[$(this).attr('data-id'), $(this).attr('data-user')])
        })

        $('.respond').click(function(){
            uni_modal("<center><b>Repond to eReklamo</b></center></center>","includes/ereklamo.inc.php?respond&chatroomID="+$(this).attr('data-chat')+"&reklamoid="+$(this).attr('data-id')+"&usersID="+$(this).attr('data-user'), "modal-lg")
        })
        $('.confirm-schedule').click(function(){
            uni_modal("<center><b>Schedule a summon</b></center></center>","includes/schedule.inc.php?scheduleSummon="+$(this).attr('data-id')+"&usersID="+$(this).attr('data-user'))
        })
        $('.add_ereklamoCat').click(function(){
            uni_modal("<center><b>Add Reklamo Category</b></center></center>","includes/ereklamo.inc.php?ereklamoAddCat&priority="+$(this).attr('data-priority'))
        })
        $('.edit_ereklamoCat').click(function(){
            uni_modal("<center><b>Edit Reklamo Category</b></center></center>","includes/ereklamo.inc.php?ereklamoEditCat&catID="+ $(this).attr('data-id')+"&catName="+$(this).attr('data-name'))
        })
        $('.delete_ereklamoCat').click(function(){
            _conf("Are you sure you want to delete this reklamo category?", "delete_cat", [$(this).attr('data-id')])
        })
        $('.add_ereklamotype').click(function(){
            uni_modal("<center><b>Add Reklamo Type</b></center></center>","includes/ereklamo.inc.php?ereklamoAddType&catID="+ $(this).attr('data-id')+"&catName="+$(this).attr('data-name'))
        })
        $('.edit_type').click(function(){
            uni_modal("<center><b>Edit Reklamo Type</b></center></center>","includes/ereklamo.inc.php?ereklamoEditType&typeID="+ $(this).attr('data-id'))
        })
        $('.delete_type').click(function(){
            _conf("Are you sure you want to delete this reklamo type?", "delete_type", [$(this).attr('data-id')])
        })

        function delete_cat($id){
            start_load()
            $.ajax({
                url:'includes/ereklamo.inc.php?postCatDelete',
                method:'POST',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }

        function delete_type($id){
            start_load()
            $.ajax({
                url:'includes/ereklamo.inc.php?postTypeDelete',
                method:'POST',
                data:{id:$id},
                success:function(){
                    location.reload()
                }
            })
        }

    function delete_document($id){
        start_load()
        $.ajax({
            url:'includes/document.inc.php?delete_document=1',
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }
    function active_document($id){
        start_load()
        $.ajax({
            url:'includes/document.inc.php?active_document=1',
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }
    function paid_request($id){
        start_load()
        $.ajax({
            url:'includes/request.inc.php?paid='+$(this).attr('data-id'),
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }
    function releaseDoc($id){
        start_load()
        $.ajax({
            url:'includes/request.inc.php?release',
            method:'POST',
            data:{id:$id},
            success:function(){
                location.reload()
            }
        })
    }

    if('<?php echo isset($_GET['upload']) ?>' == 1){
		$('#postF').trigger('click')
	}
	if('<?php echo isset($_GET['id']) ?>' == 1){
		$('[name="content"]').trigger('keyup')
	}
	$('[name="file[]"]').change(function(){
		displayUpload(this)
	})
	function displayUpload(input){
        if(document.getElementById("requestWarning").style.display == "flex"){
            document.getElementById("requestWarning").style.display = "none";
        } 
    	if (input.files) {
		Object.keys(input.files).map(function(k){
			var reader = new FileReader();
				var t = input.files[k].type;
				var _types = ['video/mp4','image/x-png','image/png','image/gif','image/jpeg','image/jpg'];
				if(_types.indexOf(t) == -1)
					return false;
				reader.onload = function (e) {
					// $('#cimg').attr('src', e.target.result);
				var bin = e.target.result;
				var fname = input.files[k].name;
				var imgF = document.getElementById('img-clone');
					imgF = imgF.cloneNode(true);
					imgF.removeAttribute('id')
					imgF.removeAttribute('style')
					if(t == "video/mp4"){
						var img = document.createElement("video");
						}else{
						var img = document.createElement("img");
						}
						var fileinput = document.createElement("input");
						var fileinputName = document.createElement("input");
						fileinput.setAttribute('type','hidden')
						fileinputName.setAttribute('type','hidden')
						fileinput.setAttribute('name','img[]')
						fileinputName.setAttribute('name','imgName[]')
						fileinput.value = bin
						fileinputName.value = fname
						img.classList.add("imgDropped")
						img.src = bin;
						imgF.appendChild(fileinput);
						imgF.appendChild(fileinputName);
						imgF.appendChild(img);
						document.querySelector('#file-display').appendChild(imgF)
				}
			reader.readAsDataURL(input.files[k]);
			})
			rem_func()
		}
    }
	function rem_func(_this){
		_this.closest('.imgF').remove();
		if($('#drop .imgF').length <= 0){
			$('#drop').append('<span id="dname" class="text-center">Drop Files Here <br> or <br> <label for="chooseFile"><strong>Choose File</strong></label></span>')
		}
	}

    var mealsByCategory = { 
    <?php    
        $puroks = array();
        $barangay = $conn->query("SELECT * FROM documenttype WHERE barangayName='{$_SESSION['userBarangay']}'");
        while($brow = $barangay->fetch_assoc()):
    ?>
        <?php 
        echo json_encode($brow["DocumentID"]) ?> : <?php $purok = $conn->query("SELECT * FROM documentpurpose WHERE barangayDoc='{$brow['DocumentID']}'"); 
        while($prow = $purok->fetch_assoc()):
        $puroks[] = $prow["purpose"]?>
        <?php endwhile; echo json_encode($puroks). ","; $puroks = array();?>
        <?php endwhile; ?> 

    }

    var requirementsByDocument = { 
    <?php    
        $requirements = array();
        $document = $conn->query("SELECT * FROM documenttype WHERE barangayName='{$_SESSION['userBarangay']}'");
        while($drow = $document->fetch_assoc()):
    ?>
        <?php 
        echo json_encode($drow["DocumentID"]) ?> : <?php $requirementsql = $conn->query("SELECT * FROM requirementlist WHERE DocumentID='{$drow['DocumentID']}'"); 
        while($rrow = $requirementsql->fetch_assoc()):
        $requirements[] = $rrow["requirementName"]?>
        <?php endwhile; echo json_encode($requirements). ","; $requirements = array();?>
        <?php endwhile; ?> 
        
    }

    function changecat(value) {
        if (value.length == 0) document.getElementById("purpose").innerHTML = "<option>Empty</option>";
        else {
            var requirenote = $("#document").find(':selected').attr('data-id');
            var lessee = $("#document").find(':selected').attr('data-user');
            var requirements = "";
            var catOptions = "";

            additionalInput(value);

            if(mealsByCategory[value].length != 0){
                for (categoryId in mealsByCategory[value]) {
                    catOptions += "<option>" + mealsByCategory[value][categoryId] + "</option>";
                }
                document.getElementById("purpose").innerHTML = catOptions;
            }
            if(requirementsByDocument[value].length != 0){
                for (requirementID in requirementsByDocument[value]) {
                    requirements += "<li>" + requirementsByDocument[value][requirementID] + "</li>";
                }   
                if(String(lessee) == "True"){
                    if(String(requirenote) == "True"){
                        requirements += "<li>Note from your Lessor</li>";
                    }
                }
                document.getElementById("listofrequirements").innerHTML = requirements;
                document.getElementById("requirementPic").style.display = "flex";
            }
            else if(requirementsByDocument[value].length == 0){
                if(String(lessee) == "True"){
                    if(String(requirenote) == "True"){
                        requirements += "<li>Note from your Lessor</li>";
                        document.getElementById("requirementPic").style.display = "flex";
                    }
                    else if(String(requirenote) != "True"){
                        requirements += "<li>No requirements</li>";
                        document.getElementById("requirementPic").style.display = "none";
                    }
                }
                else{
                    requirements += "<li>No requirements</li>";
                    document.getElementById("requirementPic").style.display = "none";
                }
                
                document.getElementById("listofrequirements").innerHTML = requirements;
            }
            else if(mealsByCategory[value].length == 0){
                catOptions += "<option value=''>Empty</option>";
                document.getElementById("purpose").innerHTML = catOptions;
            }
        }
    }
    $(document).ready(function() {
        $('#dataTable').DataTable();
    } );
    
    $(document).ready(function() {
        $('#dataTable2').DataTable();
    } );

    
    function additionalInput($documentID){
        start_load()
        $.ajax({
            url: './includes/request.inc.php?additionalInput&DocumentID='+$documentID,
            type: 'GET',
            success: function(data){
                $("#additionalInput").html(data);
            }
        })
    }

    </script>

    <?php include 'footer.php'; ?>

    