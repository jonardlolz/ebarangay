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
        <div class="col">
            <div class="row">
                <label for="schedule">Date: </label>
                <input name="schedule" type="date" min="<?php $date = date("Y-m-d"); $date1 = str_replace('-', '/', $date); $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days")); echo $tomorrow; ?>" value="<?php echo $tomorrow; ?>" required>
            </div>
            <div class="row">
                <label for="scheduleTitle">Title: </label>
                <input name="scheduleTitle" id="scheduleTitle" type="text" required>
            </div>
        </div>
    </form>
</div>

<?php endif; ?>