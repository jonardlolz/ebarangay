<?php
    include_once "dbh.inc.php";
    include_once "functions.inc.php";
?>

<?php
    if(isset($_GET["id"])):
        $id = $_GET['id'];
        $qry = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name, barangay.Status as brgyStatus FROM barangay LEFT JOIN users ON barangay.brgyCaptain = users.UsersID where BarangayID = {$_GET['id']}")->fetch_array();
        foreach($qry as $k => $v){
            $$k= $v;
        }
?>
<div class="container-fluid">
    <form action="includes/barangay_func.inc.php?id=<?php echo $id ?>" class="user" method="post"> 
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <label>Barangay Name: </label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-control-sm" id="BarangayName"
                        name="BarangayName" placeholder="Barangay Name" value="<?php echo $BarangayName ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Barangay Captain: </label>
                    </div>
                    <div class="col">
                        <select name="brgyCaptain" id="brgyCaptain" class="form-control form-control-sm form-select d-inline">
                            <?php if($brgyCaptain != NULL): ?>
                                <option value="<?php echo $brgyCaptain ?>" hidden selected><?php echo $name ?></option>
                            <?php else:?>
                                <option value="None" hidden selected>None</option>
                            <?php endif; ?>
                            <option value="None">None</option>
                            <?php $brgy = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users WHERE userType='Resident'");
                                while($brgyRow = $brgy->fetch_assoc()): ?>
                                <option value="<?php echo $brgyRow["UsersID"] ?>"><?php echo $brgyRow["name"]; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Status: </label>
                    </div>
                    <div class="col">
                        <select name="Active" id="Active" class="form-control form-control-sm form-select d-inline">
                            <option value="<?php echo $brgyStatus ?>" hidden selected><?php echo $brgyStatus ?></option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php elseif(isset($_GET["brgydetails"])): ?>

<div class="container-fluid">
    <div class="col">
        <div class="row">
            
        </div>
    </div>
</div>

<?php elseif(isset($_GET['addOfficer'])): ?>

<div class="container-fluid">
    <div class="col">
        <div class="row">
            <div class="col-sm-4">
                <label for="">Resident: </label>
            </div>
            <div class="col">
                <select class="js-select" name="residents" id="residents" style="width: 75%;">
                    <option value="" disabled hidden selected>Resident</option>
                    <?php $residentSql = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users WHERE userType='Resident' AND userBarangay='{$_GET['barangayName']}'");
                    while($residents = $residentSql->fetch_assoc()):
                    ?>
                    <option value="<?php echo $residents['UsersID'] ?>"><?php echo $residents['name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <label for="">Position: </label>
            </div>
            <div class="col">
                <select class="js-select" name="userPosition" id="userPosition">
                    <option value="" selected hidden disabled>Position</option>
                    <option value="Treasurer">Treasurer</option>
                    <option value="Treasurer">Secretary</option>
                </select>
            </div>
        </div>
    </div>
</div>

<?php elseif(isset($_GET['brgyEdit'])): ?>
<?php $sql = $conn->query("SELECT * FROM barangay WHERE BarangayID='{$_GET['barangayID']}'");
    $brgyDetail = $sql->fetch_assoc();
?>
<div class="container-fluid">
    <form action="includes/barangay.inc.php?postEdit&barangayID=<?php echo $brgyDetail['BarangayID'] ?>" method="post">
        <div class="col">
            <div class="row">
                <div class="col">
                    Telephone
                </div>
                <div class="col">
                    <input type="text" name="brgyTelephone" value="<?php echo $brgyDetail['brgyTelephone'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Cellphone
                </div>
                <div class="col">
                    <input type="text" name="brgyCell" value="<?php echo $brgyDetail['brgyCell'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Email
                </div>
                <div class="col">
                    <input type="text" name="brgyEmail" value="<?php echo $brgyDetail['brgyEmail'] ?>">
                </div>
            </div>
        </div>
    </form>  
</div>

<?php elseif(isset($_GET["addContact"])): ?>
    <form action="includes/barangay.inc.php?postContact&barangayID=<?php echo $_GET['barangayID'] ?>" method="post">
        <div class="col">
            <div class="row">
                <div class="col">
                    <label for="">Contact Name</label>
                </div>
                <div class="col">
                    <input type="text" name="contactName">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="">Contact Number</label>
                </div>
                <div class="col">
                    <input type="text" name="contactNumber">
                </div>
            </div>
        </div>
    </form>

<?php 
    elseif(isset($_GET["postContact"])):
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "INSERT INTO contacts(contactName, contactNum, BarangayID) VALUES('$contactName', '$contactNumber', '{$_GET['barangayID']}')");

        if($a1){
            mysqli_commit($conn);
            header("location: ../barangay_alt.php?barangayID={$_GET['barangayID']}"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }
    
    elseif(isset($_GET["postEdit"])):
        extract($_POST);
        mysqli_begin_transaction($conn);

        $a1 = mysqli_query($conn, "UPDATE barangay SET brgyEmail='{$brgyEmail}', brgyCell='{$brgyCell}', brgyTelephone='{$brgyTelephone}' WHERE BarangayID='{$_GET['barangayID']}'");

        if($a1){
            mysqli_commit($conn);
            header("location: ../barangay_alt.php?barangayID={$_GET['barangayID']}"); 
            exit();
        }
        else{
            echo("Error description: " . mysqli_error($conn));
            mysqli_rollback($conn);
            exit();
        }
    
?>
    
<?php else: ?>
    <form action="includes/barangay_func.inc.php" class="user" method="post"> 
        <div class="form-group row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        Barangay Name:
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-control-sm" id="BarangayName"
                        name="BarangayName" placeholder="Barangay Name">
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $('.js-select').select2();
    });
</script>