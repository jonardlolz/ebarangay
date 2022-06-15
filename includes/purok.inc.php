<?php
    include_once "dbh.inc.php";
    include_once "functions.inc.php";
    session_start();
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
    <form action="includes/purok_func.inc.php?id=<?php echo $id ?>&barangayName=<?php echo $_GET['barangayName']?>" class="user" method="post"> 
        <div class="form-group col">
            <div class="row">
                <div class="col">
                    <input type="hidden" name="BarangayName" style="width: 50%;" value="<?php echo $_GET['barangayName'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label>Purok Name: </label>
                </div>
                <div class="col">
                    <input type="text" class="form-control form-control-sm" id="PurokName"
                        name="PurokName" placeholder="Purok Name" value="<?php echo $PurokName ?>">
                </div>
            </div>
            <?php if($_SESSION['userType'] != "Admin"): ?>
            <div class="row">
                <div class="col-sm-6">
                    <label>Purok Leader: </label>
                </div>
                <div class="col">
                    <select name="purokLeader" id="purokLeader" class="form-control form-control-sm form-select d-inline js-select" style="width: 100%;">
                        <?php if($purokLeader != NULL): ?>
                            <option value="<?php echo $purokLeader ?>" hidden selected><?php echo $name ?></option>
                        <?php else:?>
                            <option value="" hidden selected>None</option>
                        <?php endif; ?>
                        <?php $purok = $conn->query("SELECT *, concat(Firstname, ' ', Lastname) as name FROM users WHERE userType='Resident' AND userBarangay='{$_GET['barangayName']}' AND userPurok='$PurokName' AND VerifyStatus='Verified'");
                            while($purokRow = $purok->fetch_assoc()): ?>
                            <option value="<?php echo $purokRow["UsersID"] ?>"><?php echo $purokRow["name"]; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-sm-6">
                    <label>Active: </label>
                </div>
                <div class="col">
                    <select name="Active" id="Active" class="form-control form-control-sm form-select d-inline">
                        <option value="<?php echo $Active ?>" hidden selected><?php echo $Active ?></option>
                        <option value="True">True</option>
                        <option value="False">False</option>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="footer d-flex flex-row-reverse">
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </div>
    </form>
</div>

<?php elseif(isset($_GET['addPurok'])): ?>
    <div class="container-fluid">
        <?php if($_SESSION['userType'] != 'Admin'): ?>
            <form action="includes/purok_func.inc.php?addPurok&barangayID=<?php echo $_GET['barangayID'] ?>&barangayName=<?php echo $_GET['barangayName'] ?>" class="user" method="post">
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
                                name="PurokName" placeholder="Purok Name" style="width: 75%;" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="footer d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                </div>
            </form>
        <?php else: ?>
            <form action="includes/purok_func.inc.php?addPurok" autocomplete="off" class="user" method="post">
                <div class="form-group col">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Barangay: </label>
                        </div>
                        <div class="col">
                            <select name="barangayName" id="barangayName" style="width: 50%;" required>
                                <option value="">None</option>
                                <?php $puroksql = $conn->query("SELECT * FROM barangay");
                                while($purokrow = $puroksql->fetch_assoc()):?>
                                <option value="<?php echo $purokrow['BarangayName'] ?>"><?php echo $purokrow['BarangayName'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Purok Name: </label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" id="PurokName"
                                name="PurokName" placeholder="Purok Name" style="width: 75%;" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="footer d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        <?php endif; ?>
    </div>

<?php endif; ?>

<script>
    $(".container-fluid").parent().siblings(".modal-footer").remove();
    $(document).ready(function() {
        $('#barangayName').select2({
        dropdownParent: $('#uni_modal'),
        width: 'resolve'
    });
    });
</script>