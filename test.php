<?php include 'includes/dbh.inc.php' ?>
<html>

<head>
  <meta charset="utf-8" />
  <title>Chart.js demo</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

  <h1>Chart.js Sample</h1>
<div style="width:400; height:400;">
  <canvas id="myChart" width="400" height="400"></canvas>
</div>
<script>
  <?php 
  $votes = $conn->query("SELECT votes.electionID, concat(candidates.firstname, ' ', candidates.lastname) as name, count(*) as votes, votes.position 
  FROM votes INNER JOIN candidates ON candidates.candidateID = votes.candidateID WHERE votes.position='Captain' GROUP BY votes.candidateID;");
  while($vrow = $votes->fetch_assoc()){
    $candidates[] = $vrow["name"];
    $voteresults[] = $vrow["votes"]; 
  }
  ?>
const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($candidates) ?>,
        datasets: [{
            label: '# of Votes',
            data: <?php echo json_encode($voteresults) ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
                
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
                
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
 
</body>
</html>