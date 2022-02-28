<?php
    include_once "dbh.inc.php";
    include_once "functions.inc.php";
?>

<?php
    if(isset($_GET["id"])):
        $id = $_GET['id'];
        $qry = $conn->query("SELECT * FROM barangay where BarangayID = {$_GET['id']}")->fetch_array();
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