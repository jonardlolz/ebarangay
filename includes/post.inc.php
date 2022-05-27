
<?php
    include 'dbh.inc.php';
    session_start();
    extract($_POST);

    if(isset($_POST["submit"]))
    {
        $usersID = $_SESSION["UsersID"];
        $username = $_SESSION["username"];
        $userType = $_SESSION["userType"];
        $postContent = $_POST["postContent"];
        
        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        if(emptyInputPost($username, $postContent, $userType, $usersID) !== false)
        {
            header("location: ../index.php?error=emptyContent");
            exit();
        }
        
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $sql = "UPDATE post SET postMessage=? WHERE PostID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location: ../index.php?error=stmtfailedcreatepost");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ss", $postContent, $id); 
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if(isset($img)){
                $id = mysqli_insert_id($conn);
                echo $id;
				mkdir('../img/posts/'.$id);
				for($i = 0 ; $i< count($img);$i++){
					list($type, $img[$i]) = explode(';', $img[$i]);
					list(, $img[$i])      = explode(',', $img[$i]);
					$img[$i] = str_replace(' ', '+', $img[$i]);
					$img[$i] = base64_decode($img[$i]);
					$fname = strtotime(date('Y-m-d H:i'))."_".$imgName[$i];
					$upload = file_put_contents('../img/posts/'.$id.'/'.$fname,$img[$i]);
					$data = " file_path = '".$fname."' ";
				}
            }
            
            header("location: ../index.php?error=none");
            exit();
        }
        else{
            $sql = "INSERT INTO post(UsersID, username, userType, postMessage, barangay) VALUES(?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location: ../index.php?error=stmtfailedcreatepost");
                exit();
            }
            $barangay = $_SESSION['userBarangay'];
            mysqli_stmt_bind_param($stmt, "sssss", $usersID, $username, $userType, $postContent, $barangay); 
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            
            
            if(isset($img)){
                $id = mysqli_insert_id($conn);
                echo $id;
				mkdir('../img/posts/'.$id);
				for($i = 0 ; $i< count($img);$i++){
					list($type, $img[$i]) = explode(';', $img[$i]);
					list(, $img[$i])      = explode(',', $img[$i]);
					$img[$i] = str_replace(' ', '+', $img[$i]);
					$img[$i] = base64_decode($img[$i]);
					$fname = strtotime(date('Y-m-d H:i'))."_".$imgName[$i];
					$upload = file_put_contents('../img/posts/'.$id.'/'.$fname,$img[$i]);
					$data = " file_path = '".$fname."' ";
				}
            }

            header("location: ../index.php?error=none");
            exit();
        }
        
    }
    if(isset($_GET['viewAttach'])): 
    $posts = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM post INNER JOIN users ON post.UsersID=users.UsersID WHERE PostID={$_GET['id']}");
    foreach($posts->fetch_array() as $k => $v){
        $$k = $v;
    }
    $gal = scandir('../img/posts/'.$_GET['id']);
    unset($gal[0]);
    unset($gal[1]);
    $count =count($gal);
    $i = 0;
    ?>
    <style>
        .slide img,.slide video{
            max-width:100%;
            max-height:100%;
        }
        #uni_modal .modal-footer{
            display:none
        }
    </style>
    <script src="./vendor/ekko-lightbox/ekko-lightbox.min.js"></script>
    <div class="container-fluid" style="height:75vh">
        <div class="row h-100">
            <div class="col-md-7 bg-dark h-100">
                <div class="d-flex h-100 w-100 position-relative justify-content-between align-items-center">
                    <a href="javascript:void(0)" id="prev" class="position-absolute d-flex justify-content-center align-items-center" style="left:0;width:calc(15%);z-index:1"><h4><div class="fa fa-angle-left"></div></h4></a>
                    <?php
                        foreach($gal as $k => $v):
                            $mime = mime_content_type('../img/posts/'.$_GET['id'].'/'.$v);
                            $i++;
                    ?>
                    <div class="slide w-100 h-100 <?php echo ($i == 1) ? "d-flex" : 'd-none' ?> align-items-center justify-content-center" data-slide="<?php echo $i ?>">
                    <?php if(strstr($mime,'image')): ?>
                        <img src="./img/posts/<?php echo $_GET['id'].'/'.$v ?>" class="" alt="Image 1">
                    <?php else: ?>
                        <video controls class="">
                                <source src="./img/posts/<?php echo $_GET['id'].'/'.$v ?>" type="<?php echo $mime ?>">
                        </video>
                    <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                    <a href="javascript:void(0)" id="next" class="position-absolute d-flex justify-content-center align-items-center" style="right:0;width:calc(15%);z-index:1"><h4><div class="fa fa-angle-right"></div></h4></a>
                </div>
            </div>
            <div class="col-md-5 h-100" style="overflow:auto">
                <div class="card card-widget post-card" data-id="<?php echo $id ?>">
                    <div class="card-header">
                        <div style="float: left;" class="user-block w-100">
                            <img style="float: left;" class="img-res-profile rounded-circle img-capt-profile" width="40" height="40" src="./img/<?php echo $profile_pic ?>" alt="User Image">
                            <span style="display: block;margin-left: 50px;font-size: 16px;font-weight: 600;margin-top: -1px;" class="username"><a href="#"><?php echo $name ?></a></span>
                            <span style="display: block;margin-left: 50px;color: #6c757d;font-size: 13px;margin-top: -3px;" class="description">Posted - <?php echo date("M d,Y h:i a",strtotime($date_created)) ?></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p id="content-field"><?php echo $postMessage ?></p>
                        <br>
                    </div>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
    </div>
</div>
<script>
    $('#next').click(function(){
        var cslide = $('.slide:visible').attr('data-slide')
        if(cslide == '<?php echo $i ?>'){
            return false;
        }
        $('.slide:visible').removeClass('d-flex').addClass("d-none")
        $('.slide[data-slide="'+(parseInt(cslide) + 1)+'"]').removeClass('d-none').addClass('d-flex')
    })
    $('#prev').click(function(){
        var cslide = $('.slide:visible').attr('data-slide')
        if(cslide == 1){
            return false;
        }
        $('.slide:visible').removeClass('d-flex').addClass("d-none")
        $('.slide[data-slide="'+(parseInt(cslide) - 1)+'"]').removeClass('d-none').addClass('d-flex')
    })
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
</script>


<?php endif; ?>