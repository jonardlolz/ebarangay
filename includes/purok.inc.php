<?php
    include_once "dbh.inc.php";
    include_once "functions.inc.php";
?>

<?php
    if(isset($_GET["id"])):
        $id = $_GET['id'];
        $qry = $conn->query("SELECT * FROM purok where PurokID = {$_GET['id']}")->fetch_array();
        foreach($qry as $k => $v){
            $$k= $v;
        }
?>
<div class="container-fluid">
    <form action="includes/purok_func.inc.php?id=<?php echo $id ?>" class="user" method="post"> 
        <div class="form-group">
            <div class="col-sm-6">
                <label>Barangay Name: </label>
                <select name="BarangayName" id="BarangayName" class="form-control form-control-sm form-select d-inline">
                    <?php 
                        $brgy = $conn->query("SELECT * FROM barangay");
                        while($row=$brgy->fetch_assoc()):
                    ?>
                        <?php if($BarangayName == $row["BarangayName"]): ?>
                            <option value="<?php echo $BarangayName ?>" selected><?php echo $BarangayName ?></option>
                        <?php continue; ?>
                        <?php endif; ?>
                            <option value="<?php echo $row["BarangayName"] ?>"><?php echo $row["BarangayName"] ?></option>
                        <?php endwhile; ?>
                </select>
            </div>
            <div class="col-sm-6">
                <label>Purok Name: </label>
                <input type="text" class="form-control form-control-sm" id="PurokName"
                    name="PurokName" placeholder="Purok Name" value="<?php echo $PurokName ?>">
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
    <form action="includes/purok_func.inc.php" class="user" method="post"> 
        <div class="form-group row">
            <div class="col-sm-6">
                <select name="BarangayName" id="BarangayName" class="form-control form-control-sm form-select d-inline">
                    <?php if(!isset($_GET["id"])): ?>
                        <option value="none" selected hidden>Barangay</option>
                    <?php endif; ?>
                    <?php 
                        $brgy = $conn->query("SELECT * FROM barangay");
                        while($row=$brgy->fetch_assoc()):
                    ?>
                        <?php if($BarangayName == $row["BarangayName"]): ?>
                            <option value="<?php echo $BarangayName ?>" selected><?php echo $BarangayName ?></option>
                        <?php continue; ?>
                        <?php endif; ?>
                        <option value="<?php echo $row["BarangayName"] ?>"><?php echo $row["BarangayName"] ?></option>
                        <?php endwhile; ?>
                </select>
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-sm" id="PurokName"
                    name="PurokName" placeholder="Purok Name">
            </div>
        </div>
    </form>

<?php endif; ?>