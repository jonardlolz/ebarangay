<?php
    session_start();
    include 'dbh.inc.php';
?>  

<?php
    if(isset($_GET['scheduleSummon'])):
        $id = $_GET['scheduleSummon'];
?>
<div class="container-fluid">
    <form action="includes/ereklamo.inc.php?scheduleID=<?php echo $id ?>&complainant=<?php echo $_GET['usersID'] ?>" class="user" method="post">
        <div class="col">
            <div class="row">
                <div class="col-sm-4">
                    <label for="scheduleTitle">Schedule Title: </label>
                </div>
                <div class="col">
                    <input name="scheduleTitle" id="scheduleTitle" type="text" value="ereklamo#<?php echo $id ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">  
                    <label for="schedule">Date: </label>
                </div>
                <div class="col">
                    <input name="schedule" type="date" min="<?php $date = date("Y-m-d"); $date1 = str_replace('-', '/', $date); $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days")); echo $tomorrow; ?>" value="<?php echo $tomorrow; ?>" required>
                </div>
            </div>
        </div>
    </form>
</div>

<?php endif; ?>