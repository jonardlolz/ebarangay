<?php
    include_once "dbh.inc.php";
    include_once "functions.inc.php";
?>

<?php
    if(isset($_GET["id"])):
        $id = $_GET['id'];
        $qry = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM barangay LEFT JOIN users ON barangay.brgyCaptain = users.UsersID where BarangayID = {$_GET['id']}")->fetch_array();
        foreach($qry as $k => $v){
            $$k= $v;
        }
?>
<div class="container-fluid">
    <form action="includes/barangay_func.inc.php?id=<?php echo $id ?>" class="user" method="post"> 
        <div class="form-group">
            <div class="col-sm-6">
                <label>City: </label>
                <input type="text" class="form-control form-control-sm" id="City"
                    name="City" placeholder="City" value="<?php echo $City ?>">
            </div>
            <div class="col-sm-6">
                <label>Barangay Name: </label>
                <input type="text" class="form-control form-control-sm" id="BarangayName"
                    name="BarangayName" placeholder="Barangay Name" value="<?php echo $BarangayName ?>">
            </div>
            <div class="col-sm-6">
                <label>Active: </label>
                <select name="Active" id="Active" class="form-control form-control-sm form-select d-inline">
                    <option value="<?php echo $Active ?>" hidden selected><?php echo $Active ?></option>
                    <option value="True">True</option>
                    <option value="False">False</option>
                </select>
            </div>
            <div class="col-sm-6">
                <label>Barangay Captain: </label>
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
    </form>
</div>

<?php else: ?>
    <form action="includes/barangay_func.inc.php" class="user" method="post"> 
        <div class="form-group row">
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm" id="City"
                    name="City" placeholder="City">
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm" id="BarangayName"
                    name="BarangayName" placeholder="Barangay Name">
            </div>
        </div>
    </form>

<?php endif; ?>