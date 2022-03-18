<?php
    include 'dbh.inc.php';
    session_start();
?>

<?php if(isset($_GET["add"])): ?>
<div class="container-fluid">
    <form action="includes/manageElection.inc.php" class="user" method="post">
        <div class="form-group">
            <div class="col-sm-7">
                <label for="electionTitle">Election Title</label>
                <input type="text" class="form-control form-control-user" id="electionTitle"
                name="electionTitle" placeholder="Election Title" value="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-7">
                <label for="electionTitle">Purok</label>
                <select name="electionPurok" id="electionPurok" class="form-select form-select-lg">
                    <option value="" hidden selected>Purok</option>
                    <?php $barangay = $conn->query("SELECT * FROM purok WHERE BarangayName='{$_SESSION['userBarangay']}'");
                    while($brow = $barangay->fetch_assoc()): ?>  
                    <option value="<?php echo $brow['PurokName'] ?>"><?php echo $brow['PurokName'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
    </form>
</div>

<?php elseif(isset($_GET["edit"])): ?>
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

<?php elseif(isset($_GET['result'])): ?>
    <div class="container-fluid">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>

    <script src="vendor/chart.js/Chart.js"></script>
    <script>
        <?php
            $elections = $conn->query("SELECT electionID, UsersID, candidateID, MAX(voteResults) as voteResults, position, concat(Firstname, ' ', Lastname) as name
            FROM (SELECT candidates.UsersID, votes.candidateID, COUNT(votes.candidateID) as voteResults, votes.position, votes.electionID, users.Firstname, users.Lastname
            FROM votes INNER 
            JOIN candidates ON candidates.candidateID = votes.candidateID
            JOIN users ON users.UsersID = candidates.UsersID
            GROUP BY candidateID) as results
            WHERE electionID={$_GET['result']}
            GROUP BY position;");

            // $elections = $conn->query("SELECT * FROM candidates");
            
        ?>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php while($row=$elections->fetch_assoc()){ echo "'". $row['name'] ."', ";} ?>],
                datasets: [{
                    label: '# of Votes',
                    <?php
                        $elections = $conn->query("SELECT electionID, UsersID, candidateID, MAX(voteResults) as voteResults, position, concat(Firstname, ' ', Lastname) as name
                        FROM (SELECT candidates.UsersID, votes.candidateID, COUNT(votes.candidateID) as voteResults, votes.position, votes.electionID, users.Firstname, users.Lastname
                        FROM votes INNER 
                        JOIN candidates ON candidates.candidateID = votes.candidateID
                        JOIN users ON users.UsersID = candidates.UsersID
                        GROUP BY candidateID) as results
                        WHERE electionID={$_GET['result']}
                        GROUP BY position;");

                        // $elections = $conn->query("SELECT * FROM candidates");
                        
                    ?>
                    data: [<?php while($rows=$elections->fetch_assoc()){ echo $rows['voteResults'] .", ";} ?>],
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
    </script>

<?php endif; ?>