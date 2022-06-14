<?php
    include 'dbh.inc.php';
    session_start();
?>
<script src="node_modules/chart.js/dist/Chart.js"></script>
<?php if(isset($_GET["add"])): ?>
<div class="container-fluid">
    <form action="includes/manageElection.inc.php" autocomplete="off" class="user" method="post">
        <div class="form-group row">
            <div class="col-sm-4">
                <label for="electionTitle">Election Title</label>
            </div>
            <div class="col">
                <input type="text" class="form-control" id="electionTitle"
                name="electionTitle" placeholder="Election Title" value="">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-4">
                <label for="electionTitle">Purok</label>
            </div>
            <div class="col">
                <select name="electionPurok" id="electionPurok" class="custom-select">
                    <option value="" hidden selected>Purok</option>
                    <?php $barangay = $conn->query("SELECT * FROM purok WHERE BarangayName='{$_SESSION['userBarangay']}'");
                    while($brow = $barangay->fetch_assoc()): ?>  
                    <option value="<?php echo $brow['PurokName'] ?>"><?php echo $brow['PurokName'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
        <hr>
        <div class="footer d-flex flex-row-reverse">
            <button class="btn btn-sm btn-flat btn-primary">Create</button>
        </div>
    </form>
</div>

<?php elseif(isset($_GET["edit"])): ?>
<div class="container-fluid">
    <?php 
        $id = $_GET["edit"];
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

<?php elseif(isset($_GET['result'])): ?>
    <div class="container-fluid">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>

    <script>
        $(".container-fluid").parent().siblings(".modal-footer").remove();
        <?php
            $elections = $conn->query("SELECT concat(candidates.firstname, ' ', candidates.lastname) as name, votes.candidateID, count(votes.candidateID) as numberofVotes FROM votes INNER JOIN candidates ON candidates.candidateID=votes.candidateID WHERE votes.electionID={$_GET['result']} GROUP BY votes.candidateID;");

            // $elections = $conn->query("SELECT * FROM candidates");
        ?>
        function render_chart(){
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php foreach($elections as $row){ echo "'".$row['name']."',"; } ?>],
                    datasets: [{
                        label: '# of Votes',
                        data: [<?php foreach($elections as $row){ echo $row['numberofVotes'].","; } ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        render_chart();
    </script>
<?php endif; ?>

 <script>
     $(".container-fluid").parent().siblings(".modal-footer").remove();
 </script>