<?php
    ini_set('display_errors', true);
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    include 'includes/dbh.inc.php';
    if(isset($_SESSION["UsersID"]) == NULL)
    {
        header("location: login.php");//return to login.php if error
        exit();     //stop the script
    }
    $userCheck = $conn->query("SELECT * FROM users WHERE UsersID={$_SESSION['UsersID']}")->fetch_assoc();
    if($userCheck['Status'] == 'Deactivated'){
        header("location: reactivate.php");
    }
    if($userCheck['VerifyStatus'] == 'Pending' || $userCheck['VerifyStatus'] == 'Reverify'){
        header("location: login.php?error=pending");
    }
    if($userCheck['VerifyStatus'] == 'Unverified'){
        header("location: invaliduser.php?UsersID={$_SESSION['UsersID']}");
    }
    else{
        $profile_pic = $_SESSION["profile_pic"];
        $firstname = $_SESSION["Firstname"];
        $lastname = $_SESSION["Lastname"];
        $name = "$firstname $lastname";
        $sql = $conn->query("SELECT * FROM users WHERE UsersID={$_SESSION['UsersID']}");
        $dataDateDiff = $sql->fetch_assoc();
        
        if($dataDateDiff['startedLiving'] != NULL){
            $date1 = $dataDateDiff['startedLiving'];
            $date2 = date("Y-m-d");

            $date1 = strtotime($date1);
            $date2 = strtotime($date2);

            $year1 = date("Y", $date1);
            $year2 = date("Y", $date2);

            $month1 = date('m', $date1);
            $month2 = date('m', $date2);

            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> EBARANGAY </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <!--EB CSS-->
    <link href="css/cb2.css" rel="stylesheet">
    <link href="css/chat-css.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/ekko-lightbox/ekko-lightbox.min.js"></script>
    <script src="node_modules/print-js/dist/print.js"></script>
    <link rel="stylesheet" href="node_modules/print-js/dist/print.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/r-2.3.0/sb-1.3.3/sp-2.0.1/datatables.min.css"/>
    
    
    
    <style>
    @media screen and (max-width: 768px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }

    .sidebar .nav-item {
        float: left;
    }

    div.content {
        margin-left: 0;
    }

    /*#sidebarToggleTop {display: none;}*/
    .sidebar {
            position: fixed; width: 190px;
        }  

        #accordionSidebar {
            position: absolute;
        }

        #sidebar-area { 
            position: relative; z-index: 3000; 
        }    /*area keeps all sidebar options above with z-index*/
    }
    
    @media screen and (max-width: 400px) {
        .sidebar .nav-item {
            text-align: center;
            float: none;
            }
        }
        @media screen {
        #printSection {
            display: none;
        }
    }

    @media print {
        body * {
            visibility:hidden;
        }
        #printSection, #printSection * {
            visibility:visible;
        }
        #printSection {
            position:absolute;
            left:0;
            top:0;
        }
    }



    </style>
</head>

<body id="page-top">

<!-- Topbar -->
<nav class="navbar navbar-expand topbar static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<a class="navbar-brand" href="about.php">    <!-- about the website page-->
    <img src="img/eb-logo.png" alt="EBARANGAY LOGO" width="70" height="65">
</a>
<!-- Not visible in Xl-->
<h1 class="navbar-text font-weight-bold d-none d-sm-block d-md-block text-white" 
    style= "font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    text-shadow: -1px 0px black, 3px 4px black, 5px 0 black, 0 -1px black;">
    EBARANGAY 
</h1>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <?php if($_SESSION['userType'] != "Admin"): ?>
    <?php if(isset($_SESSION["UsersID"]) != NULL) : ?>
    <!-- Nav Item - Alerts -->
    <?php if($_SESSION['userType'] == "Purok Leader" || $_SESSION['userType'] == "Resident" || $_SESSION['userType'] == "Councilor" || $_SESSION['barangayPos'] != "None"): ?>
    <li class="nav-item dropdown no-arrow mx-1" id="chatbox" onclick="notificationRead()" data-id="<?php echo $_SESSION["UsersID"] ?>">
        <a class="nav-link dropdown-toggle" href="#" id="chatboxDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="chatboxDropdown">
            <h6 class="dropdown-header">
                Chats
            </h6>
            
            <div id="chatbox" style="overflow-y:overlay; max-height:30vh;">
                <?php 
                
                if($_SESSION['userType'] == 'Resident'){
                    $chatSql = $conn->query("SELECT *, chat.UsersID as userchat, latest_chat, concat(users.Firstname, ' ', users.Lastname) as name FROM (SELECT chatroomID, MAX(chat.mesgdate) as latest_chat FROM chat GROUP BY chatroomID) max_chat
                    INNER JOIN chat 
                    ON max_chat.latest_chat=chat.mesgdate
                    INNER JOIN chatroom
                    ON chat.chatroomID=chatroom.chatroomID
                    INNER JOIN ereklamo
                    ON ereklamo.ReklamoID=chatroom.idreference AND chatroom.type='ereklamo'
                    INNER JOIN users
                    ON chat.UsersID=users.UsersID
                    WHERE (ereklamo.UsersID={$_SESSION['UsersID']} OR 
                    ereklamo.complainee={$_SESSION['UsersID']}) AND
                    ereklamo.status='Ongoing' OR
                    ereklamo.status='Respondents sent'
                    ORDER BY mesgdate DESC");
                }
                elseif($_SESSION['barangayPos'] != 'None'){
                    $chatSql = $conn->query("SELECT *, chat.UsersID as userchat, latest_chat, concat(users.Firstname, ' ', users.Lastname) as name FROM (SELECT chatroomID, MAX(chat.mesgdate) as latest_chat FROM chat GROUP BY chatroomID) max_chat
                    INNER JOIN chat 
                    ON max_chat.latest_chat=chat.mesgdate
                    INNER JOIN chatroom
                    ON chat.chatroomID=chatroom.chatroomID
                    INNER JOIN ereklamo
                    ON ereklamo.ReklamoID=chatroom.idreference AND chatroom.type='ereklamo'
                    INNER JOIN users
                    ON chat.UsersID=users.UsersID
                    WHERE ereklamo.status='Respondents sent'
                    ORDER BY mesgdate DESC");
                }
                else{
                    $chatSql = $conn->query("SELECT *, chat.UsersID as userchat, latest_chat, concat(users.Firstname, ' ', users.Lastname) as name FROM (SELECT chatroomID, MAX(chat.mesgdate) as latest_chat FROM chat GROUP BY chatroomID) max_chat
                    INNER JOIN chat 
                    ON max_chat.latest_chat=chat.mesgdate
                    INNER JOIN chatroom
                    ON chat.chatroomID=chatroom.chatroomID
                    INNER JOIN ereklamo
                    ON ereklamo.ReklamoID=chatroom.idreference AND chatroom.type='ereklamo'
                    INNER JOIN users
                    ON chat.UsersID=users.UsersID
                    WHERE ereklamo.status='Ongoing' OR
                    ereklamo.status='Respondents sent'
                    ORDER BY mesgdate DESC");
                }
                $rowsCount = $chatSql->num_rows;
                if($rowsCount > 0):
                while($chatRow = $chatSql->fetch_assoc()):
                $date=date_create($chatRow['latest_chat']);
                ?>
                <a class="respond dropdown-item d-flex align-items-center" href="javascript:void(0)" data-id="<?php echo $chatRow['ReklamoID'] ?>" data-user="<?php echo $chatRow['UsersID'] ?>" data-chat="<?php echo $chatRow['chatroomID']?>">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <span class="font-weight-bold"><?php echo $chatRow['roomName'] ?></span>
                        <?php if($chatRow['userchat'] != $_SESSION['UsersID']): ?>
                        <div class="medium text-black-500"><?php echo $chatRow['name'] ?> : <?php echo mb_strimwidth($chatRow['message'], 0, 10, "...") ?></div>
                        <?php else: ?>
                        <div class="medium text-black-500">You : <?php echo mb_strimwidth($chatRow['message'], 0, 10, "...") ?></div>
                        <?php endif; ?>
                        <div class="small text-grey-300"><?php echo date_format($date, 'h:i A') ?> | <?php echo date_format($date, 'M d') ?></div>
                        
                    </div>
                </a>
                <?php endwhile; ?>
                <?php elseif($rowsCount <= 0): ?>
                    <p class="dropdown-item text-center small text-gray-500" href="#">No open chats right now!</p>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <?php endif; ?>
    <li class="nav-item dropdown no-arrow mx-1" id="notifications" onclick="notificationRead()" data-id="<?php echo $_SESSION["UsersID"] ?>">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter"><?php 
                    $notif = $conn->query("SELECT * FROM notifications WHERE (UsersID={$_SESSION['UsersID']} 
                    OR position='{$_SESSION['userType']}') AND status='Not Read' 
                    ORDER BY NotificationID ASC;");
                    
                    $row_cnt = mysqli_num_rows($notif);
                    if($row_cnt > 0){
                        echo $row_cnt;
                    }
                ?></span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Alerts Center
            </h6>
            <div id="notifications" style="overflow-y:overlay; max-height:30vh;">
            <?php if(false): ?>
            <a class="dropdown-item d-flex align-items-center promptSchedule" href="javascript:void(0)">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">May 23,2022 04:23 AM</div>
                    <span class="font-weight-bold">Captain has scheduled your meeting, please confirm your attendance.</span>
                </div>
            </a>
            <?php endif; ?>
            <?php 
            if($_SESSION['userType'] == 'Resident'){
                $query = "SELECT * FROM notifications WHERE (UsersID={$_SESSION['UsersID']}) ORDER BY NotificationID DESC LIMIT 10;";
            }
            else{
                $query = "SELECT * FROM notifications WHERE (UsersID={$_SESSION['UsersID']} OR position='{$_SESSION['userType']}') ORDER BY NotificationID DESC LIMIT 10;";
            }
            $results = mysqli_query($conn, $query);
            $numResults = mysqli_num_rows($results);
            if($numResults > 0):
                while($nrow = mysqli_fetch_assoc($results)):
            ?>
            
            <a class="dropdown-item d-flex align-items-center" href="
            <?php 
            if($nrow['type'] == 'request'){
                echo 'request.php';
            } 
            if($nrow['type'] == 'ereklamo'){
                echo 'ereklamo.php';
            } 
            
            ?>">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500"><?php echo date("M d,Y h:i A",strtotime($nrow['created_at'])) ?></div>
                    <span class="font-weight-bold"><?php echo $nrow['message'] ?></span>
                </div>
            </a>
            
            <?php endwhile; ?>
            </div>
            <?php else: ?>
                <a class="dropdown-item text-center small text-gray-500" href="#">You're all caught up!</a>
            <?php endif; ?>
            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
        </div>
    </li>
    <?php endif; ?>
    <?php endif; ?>
     
    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
    
    <?php if(isset($_SESSION["UsersID"]) != NULL) : ?>
    <a class="nav-link dropdown-toggle" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-dark small"><?php if($_SESSION["userType"] == "Admin"){echo "Admin";} else{echo $name;} ?></span>
        <img class="img-profile rounded-circle <?php 
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
            elseif($_SESSION["userType"] == "Councilor"){
                echo "img-councilor-profile";
            }
            elseif($_SESSION["userType"] == "Treasurer"){
                echo "img-treas-profile";
            }
            elseif($_SESSION["userType"] == "Admin"){
                echo "img-admin-profile";
            }
        ?>" src="img/users/<?php echo $_SESSION['UsersID'] ?>/profile_pic/<?php echo $_SESSION["profile_pic"]; ?> "/>
    </a>

    <div class="dropdown-menu dropdown-menu-sm-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <a class="dropdown-item" href="profile_alt.php?UsersID=<?php echo $_SESSION['UsersID']; ?>">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-600"></i>
                Profile
            </a>
            <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="login.html" data-toggle="modal" data-target="#logoutModal" data-backdrop="static"> <!-- data-toggle="modal" data-target="#logoutModal"-->
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-600"></i>
                Logout
            </a>
    </div>

        <?php elseif(isset($_SESSION["UsersID"]) == NULL) : ?>
           
        <a class="nav-link dropdown-toggle" href="login.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-600"></i>
            <span class="mr-2 d-none d-lg-inline text-dark small">Login</span>
        </a>
        <?php endif; ?>
    </li>
    
    
 
</ul>
<!-- End of Topbar Navbar -->
</nav>

<!-- Content Wrapper -->
<div class="content-wrapper" >
<div class="row">
    
    <?php if(isset($_SESSION["UsersID"]) && !empty($_SESSION["UsersID"])) : ?>
    <?php $brgySql = $conn->query("SELECT * FROM barangay WHERE BarangayName='{$_SESSION['userBarangay']}'");
        $brgyData = $brgySql->fetch_assoc();
    ?>
    <!--Sidebar-->
    <div id="sidebar-area" style="width: 18%;">
    <ul class="navbar-nav sidebar sidebar-dark accordion px-2" id="accordionSidebar" style="background: rgb(70, 87, 101);">
        <?php if($_SESSION["userType"] == "Admin") : ?>      
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "account.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "account.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="account.php">
                    <span>Captains</span>
                </a>
            </li>
            
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "barangay.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "barangay.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="barangay.php">
                    <span>Barangay</span>
                </a>
            </li>
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "purok.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "purok.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="purok.php">
                    <span>Purok</span>
                </a>
            </li>
        <?php elseif($_SESSION["userType"] == "Resident") : ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "index.php"): ?> <?php echo "active"; endif; ?> ">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "index.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="index.php">eBulletin</a>
            </li>
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "barangay_alt.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "barangay_alt.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="barangay_alt.php?barangayID=<?php echo $brgyData['BarangayID'] ?>" aria-expanded="true">
                    Barangay
                </a>
            </li>
            <!-- Nav Item - Request -->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "request.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "request.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="request.php">Request</a>
            </li>

            <!-- Nav Item - eReklamo-->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "ereklamo.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "ereklamo.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="ereklamo.php">eReklamo</a>
            </li>
            <!-- Nav Item - eReklamo-->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "election.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "election.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="election.php">Vote</a>
            </li>
            <?php if($_SESSION['barangayPos'] != 'None'): ?>
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "respondent.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "respondent.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="respondent.php">Respondent</a>
            </li>                     
            <?php endif; ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        <?php elseif($_SESSION["userType"] == "Captain") : ?>
            <!-- Nav Item - Dashboard -->
            <!-- <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "dashboard.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "dashboard.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="dashboard.php">Dashboard</a>
            </li> -->
            <!-- Nav Item - Home -->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "index.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "index.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="index.php">eBulletin</a>
            </li>        
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "barangay_alt.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "barangay_alt.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="barangay_alt.php?barangayID=<?php echo $brgyData['BarangayID'] ?>" aria-expanded="true">
                    Barangay
                </a>
            </li>
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "services.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "services.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="services.php">Services</a>
            </li>
            <!-- Nav Item - Request -->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "request.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "request.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="request.php">Request</a>
            </li>
            <!-- Nav Item - eReklamo-->
            <!-- <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "ereklamo.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "ereklamo.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="ereklamo.php">eReklamo</a>
            </li> -->
            <!-- Nav Item - residents-->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "residents.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "residents.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="residents.php">Residents</a>
            </li>  
            <!-- Nav Item - election-->      
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "election.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "election.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="election.php">Election</a>
            </li>
            <!-- Nav Item - report-->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "report.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "report.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="report.php">Report</a>
            </li>               
            <!-- Nav Item - Officials-->
            <!-- <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "officials.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "officials.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="officials.php">Officers</a>
            </li> -->
            <!-- Nav Item - Officials-->
            <!-- <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "respondent.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "respondent.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="respondent.php">Respondents</a>
            </li> -->
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        
        
        <?php elseif($_SESSION["userType"] == "Secretary") : ?>                  
            <!-- Nav Item - Dashboard -->
            <!-- <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "dashboard.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "dashboard.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="dashboard.php">Dashboard</a>
            </li> -->
            <!-- Nav Item - eBulletin -->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "index.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "index.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="index.php">eBulletin</a>
            </li>
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "barangay_alt.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "barangay_alt.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="barangay_alt.php?barangayID=<?php echo $brgyData['BarangayID'] ?>" aria-expanded="true">
                    Barangay
                </a>
            </li>
            <!-- Nav Item - Request -->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "request.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "request.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="request.php">Request</a>
            </li>
            
            <!-- Nav Item - eReklamo-->
            <!-- <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "ereklamo.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "ereklamo.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="ereklamo.php">eReklamo</a>
            </li> -->
            
            <!-- Nav Item - residents-->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "residents.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "residents.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="residents.php">Residents</a>
            </li>
                                            
            <!-- Nav Item - report-->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "report.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "report.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="report.php">Report</a>
            </li>
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "election.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "election.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="election.php">Vote</a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


            <?php elseif($_SESSION["userType"] == "Treasurer") : ?>
            <!-- Nav Item - Dashboard -->
            <!-- <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "dashboard.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "dashboard.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="dashboard.php">Dashboard</a>
            </li> -->
            <!-- Nav Item - Home -->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "index.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "index.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="index.php">eBulletin</a>
            </li>        
            <!-- Nav Item - Request -->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "payment.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "payment.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="payment.php">Payment</a>
            </li>
            <!-- Nav Item - eReklamo-->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "report.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "report.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="report.php">Report</a>
            </li>
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "election.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "election.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="election.php">Vote</a>
            </li>
            

        <?php elseif($_SESSION["userType"] == "Purok Leader") : ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "index.php"): ?> <?php echo "active"; endif; ?> ">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "index.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="index.php">eBulletin</a>
            </li>
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "barangay_alt.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "barangay_alt.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="barangay_alt.php?barangayID=<?php echo $brgyData['BarangayID'] ?>" aria-expanded="true">
                    Barangay
                </a>
            </li>
            <!-- Nav Item - Request -->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "request.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "request.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="request.php">Request</a>
            </li>

            <!-- Nav Item - eReklamo-->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "ereklamo.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "ereklamo.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="ereklamo.php">eReklamo</a>
            </li>
            
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "residents.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "residents.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="residents.php">Residents</a>
            </li>
                                    
            <!-- Nav Item - report-->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "report.php"): ?> <?php echo "active"; endif; ?>">
            <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "report.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="report.php">Report</a>
            </li>
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "election.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "election.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="election.php">Vote</a>
            </li>
                                    

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        <?php elseif($_SESSION["userType"] == "Councilor") : ?>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "index.php"): ?> <?php echo "active"; endif; ?> ">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "index.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="index.php">eBulletin</a>
            </li>
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "barangay_alt.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "barangay_alt.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="barangay_alt.php?barangayID=<?php echo $brgyData['BarangayID'] ?>" aria-expanded="true">
                    Barangay
                </a>
            </li>
            <!-- Nav Item - Request -->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "request.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "request.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="request.php">Request</a>
            </li>

            <!-- Nav Item - eReklamo-->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "ereklamo.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "ereklamo.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="ereklamo.php">eReklamo</a>
            </li>
            
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "residents.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "residents.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="residents.php">Residents</a>
            </li>
                                    
            <!-- Nav Item - report-->
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "report.php"): ?> <?php echo "active"; endif; ?>">
            <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "report.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="report.php">Report</a>
            </li>
            <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "election.php"): ?> <?php echo "active"; endif; ?>">
                <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) === "election.php"): ?> <?php echo "bg-secondary"; endif; ?>" href="election.php">Vote</a>
            </li>
                                    

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        
        <?php endif; ?>
    <?php endif; ?>
    </ul>
    </div>
    <!-- End of Sidebar -->

    

                        