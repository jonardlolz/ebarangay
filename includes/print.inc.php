<?php 
include 'dbh.inc.php';
session_start();
?>

<?php if(isset($_GET['resident'])): ?>
<div class="container-fluid">
    <form action="./pdf.php" method="GET">
        <div class="col">
            <div class="form-group row">
                <div class="col">
                    Choose:
                </div>
                <div class="col">
                    <select name="residentPrint" class="custom-select" required>
                        <option value="" hidden selected>Select</option>
                        <option value="Resident">Resident</option>
                        <?php
                        $categorysql = $conn->query("SELECT * FROM residentcategory WHERE Barangay='{$_SESSION['userBarangay']}'");
                        while($categoryRow = $categorysql->fetch_assoc()):
                        ?>
                        <option value="<?php echo $categoryRow['residentCatName'] ?>"><?php echo $categoryRow['residentCatName'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Purok:
                </div>
                <div class="col">
                    <select class="custom-select" name="purok" id="purokSelect" required>
                        <option value="All">All</option>
                        <?php
                        $puroksql = $conn->query("SELECT * FROM purok WHERE BarangayName='{$_SESSION['userBarangay']}'");
                        while($purokRow = $puroksql->fetch_assoc()):
                        ?>
                        <option value="<?php echo $purokRow['PurokName'] ?>"><?php echo $purokRow['PurokName'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex flex-row-reverse">
            <button class="btn btn-primary"><i class="fas fa-print"></i> Generate PDF</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $(".container-fluid").parent().siblings(".modal-footer").remove();

        $('.select2').select2({
            dropdownParent: '#uni_modal',
            width: 'resolve'
        });
    });
</script>
<?php elseif(isset($_GET['reportType'])): ?>
<div class="container-fluid">
    <form action="./pdf.php" method="GET">
        <div class="col">
            <div class="form-group row">
                <div class="col">
                    Choose:
                </div>
                <div class="col">
                    <select name="reportType" class="custom-select" required>
                        <option value="" hidden selected>Select</option>
                        <option value="ereklamoReport">eReklamo</option>
                        <option value="userReport">User</option>
                        <option value="requestReport">eRequest</option>
                        <option value="paymentReport">Payment</option>
                        <option value="electionReport">Election</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    Purok:
                </div>
                <div class="col">
                    <select class="custom-select" name="purok" id="purokSelect" required>
                        <option value="All">All</option>
                        <?php
                        $puroksql = $conn->query("SELECT * FROM purok WHERE BarangayName='{$_SESSION['userBarangay']}'");
                        while($purokRow = $puroksql->fetch_assoc()):
                        ?>
                        <option value="<?php echo $purokRow['PurokName'] ?>"><?php echo $purokRow['PurokName'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex flex-row-reverse">
            <button class="btn btn-primary"><i class="fas fa-print"></i> Generate PDF</button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $(".container-fluid").parent().siblings(".modal-footer").remove();

        $('.select2').select2({
            dropdownParent: '#uni_modal',
            width: 'resolve'
        });
    });
</script>
<?php endif; ?>