<?php
    session_start();
    include 'includes/dbh.inc.php';
?>

<html>
<style>
    @media print {
        #printPageButton {
            display: none;
        }
    }
    .modal-tall .modal-dialog {
        height: 90%;
    }
    .modal-tall .modal-content {
        height: 100%;
    }
    #printThis{
        font-size: 32px;
    }
</style>
</head>
<body>
<div class="container-fluid" id="printThis">
    <?php if(isset($_GET['requestID'])): 
        $request = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as captainName
        FROM (SELECT request.*, barangay.*, concat(users.Firstname, ' ', users.Lastname) as name,users.userAddress, users.userCity FROM request 
        INNER JOIN users ON users.UsersID=request.UsersID 
        INNER JOIN barangay ON barangay.BarangayName=users.userBarangay 
        WHERE RequestID={$_GET['requestID']}) 
        as stuff 
        INNER JOIN users
        ON stuff.brgyCaptain = users.UsersID
        WHERE RequestID={$_GET['requestID']};"); 
        $row=$request->fetch_assoc();   
    ?>

    <div class="d-flex justify-content-center"><span class='cls_002'>Republic of the Philippines</span></div>
    <div class="d-flex justify-content-center"><span class='cls_003'>BARANGAY <?php echo strtoupper($_SESSION['userBarangay']) ?></span></div>
    <div class="d-flex justify-content-center"><span class='cls_002'><?php echo $_SESSION['userCity'] ?> City</span></div>
    <br />
    <div class="d-flex justify-content-center"><span class='cls_005'>BARANGAY CLEARANCE</span></div>
    <br>
    <div class="d-flex justify-content-start"><span class='cls_006'>TO WHOM IT MAY CONCERN:</span></div>
    <br>
    <div class="d-flex justify-content-start">
        This is to certify that <?php echo strtoupper($row['name']) ?> with residence and postal 
        address at <?php echo $row['userAddress'] ?>, Purok <?php echo $row['userPurok'] ?>, Barangay <?php echo $row['userBarangay'] ?>, <?php echo $row['userCity'] ?> City has no derogatory record filed in our Barangay Office. 
        <br />
        The above-named individual who is a bonafide resident of this barangay is a person of good moral character, 
        peace-loving and civic minded citizen.
        <br />
        This certification/clearance is hereby issued in connection with the subject’s application for <?php echo $row['purpose'] ?> 
        and for whatever legal purpose it may serve him/her best, and is valid for six (6) from the date issued.
    </div>
    <br />
    <div class="d-flex justify-content-start"><span class='cls_006'>NOT VALID WITHOUT OFFICIAL SEAL.</span></div>
    <div class="d-flex justify-content-start"><span class='cls_004'>Given this <?php echo date("D, F j, Y"); ?></span></div>
    <br />
    <br />
    <div class="d-flex justify-content-end"><img src='signature.png' alt='signature'></div>
    <div class="d-flex justify-content-end"><u><?php echo strtoupper($row['captainName']) ?></u></div>
    <div class="d-flex justify-content-end">Barangay Captain</div>
    <?php endif; ?>
</div>

<!-- <button id="printPageButton" onClick="window.print();">Print</button> -->

</body>
</html>
