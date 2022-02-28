<?php
session_start();
include "dbh.inc.php";
?>
<?php 
if(isset($_GET['id'])):
	$id = $_GET['id'];
	$qry = $conn->query("SELECT * FROM candidates WHERE candidateID = $id")->fetch_array();
?>

<div class="container-fluid">
    <p><?php echo $qry["platform"] ?></p>
</div>

<?php endif;?>