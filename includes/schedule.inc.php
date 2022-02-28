<?php
    session_start();
    include 'dbh.inc.php';
?>  

<?php
    if(isset($_GET['scheduleSummon'])):
        $id = $_GET['scheduleSummon'];
?>
<div class="container-fluid">
    <form action="includes/ereklamo.inc.php?scheduleID=<?php echo $id ?>&usersID=<?php echo $_GET['usersID'] ?>" class="user" method="post">
        Date: <input name="schedule" type="date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d") ?>" required>
        
    </form>
</div>

<?php endif; ?>