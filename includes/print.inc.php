<?php 
include 'dbh.inc.php';
session_start();
?>

<div class="container-fluid">
    <div class="table-responsive">
        <table id="printTable" class="table table-bordered text-center text-dark display" cellspacing="0" cellpadding="0">
            <thead >
                <tr class="bg-gradient-secondary text-white">
                    <?php $headerSql = $conn->query("DESCRIBE ereklamoreport"); 
                        while($headerRow = $headerSql->fetch_assoc()):
                    ?>
                    <th><?php echo $headerRow['Field'] ?></th>
                    <?php endwhile; ?>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>