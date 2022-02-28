<?php
    include 'dbh.inc.php';
    session_start();
?>

<?php if(!isset($_GET["id"])): ?>
<div class="container-fluid">
    <form action="includes/manageElection.inc.php" class="user" method="post">
        <div class="form-group">
            <div class="col-sm-7">
                <label for="electionTitle">Election Title</label>
                <input type="text" class="form-control form-control-sm" id="electionTitle"
                name="electionTitle" placeholder="Election Title" value="">
            </div>
        </div>
    </form>
</div>

<?php elseif(isset($_GET["id"])): ?>
<div class="container-fluid">
    <?php 
        $id = $_GET["id"];
        $elections = $conn->query("SELECT * FROM election WHERE electionID=$id ");
        while($row=$elections->fetch_assoc()):
    ?>
    <form action="includes/manageElection.inc.php?id=<?php echo $id ?>" class="user" method="post">
        <div class="form-group">
            <div class="col-sm-7">
                <label for="electionTitle">Election Title</label>
                <input type="text" class="form-control form-control-sm" id="electionTitle"
                name="electionTitle" placeholder="Election Title" value="<?php echo $row['electionTitle'] ?>">
            </div>
        </div>
    </form>
        <?php endwhile; ?>
</div>

<?php endif; ?>