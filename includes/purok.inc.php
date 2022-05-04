<?php
    include_once "dbh.inc.php";
    include_once "functions.inc.php";
?>

<?php
    if(isset($_GET["id"])):
    $id = $_GET['id'];
    $qry = $conn->query("SELECT *, concat(users.Firstname, ' ', users.Lastname) as name FROM purok LEFT JOIN users ON purok.purokLeader = users.UsersID where PurokID = {$_GET['id']}")->fetch_array();
    foreach($qry as $k => $v){
        $$k= $v;
    }
?>
<div class="container-fluid">
    <form action="includes/purok_func.inc.php?id=<?php echo $id ?>" class="user" method="post"> 
        <div class="form-group">
            <div class="col-sm-6">
                <label>Barangay Name: </label>
                <select name="BarangayName" id="BarangayName" class="js-select form-control form-control-sm form-select d-inline">
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
            <div class="col-sm-6">
                <label>Purok Leader: </label>
                <select name="purokLeader" id="purokLeader" class="form-control form-control-sm form-select d-inline">
                    <?php if($purokLeader != NULL): ?>
                        <option value="<?php echo $purokLeader ?>" hidden selected><?php echo $name ?></option>
                    <?php else:?>
                        <option value="None" hidden selected>None</option>
                    <?php endif; ?>
                    <option value="None">None</option>
                    <?php $purok = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users WHERE userType='Resident'");
                        while($purokRow = $purok->fetch_assoc()): ?>
                        <option value="<?php echo $purokRow["UsersID"] ?>"><?php echo $purokRow["name"]; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
    </form>
</div>

<?php elseif(isset($_GET['addPurok'])): ?>
    <form action="includes/purok_func.inc.php?addPurok&barangayName=<?php echo $_GET['barangayName'] ?>" class="user" method="post"> 
        <div class="form-group col">
            <div class="row">
                <div class="col-sm-4">
                    <label for="">Barangay: </label>
                </div>
                <div class="col">
                    <label for=""><?php echo $_GET['barangayName'] ?></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <label for="">Purok Name: </label>
                </div>
                <div class="col">
                    <input type="text" class="form-control form-control-sm" id="PurokName"
                        name="PurokName" placeholder="Purok Name" style="width: 75%;">
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