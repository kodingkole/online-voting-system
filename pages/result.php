<?php
include "../config.php";
$result = $conn->query("SELECT name, votes FROM candidates WHERE status='approved'");
$labels = [];
$data = [];
while($row = $result->fetch_assoc()){
  $labels[] = $row['name'];
  $data[] = $row['votes'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Result</title>
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="top">
  <button onclick="location.href='../index.php'">Back</button>
</div>

<div class="container">
  <h2>Result</h2>
  <canvas id="resultChart"></canvas>
</div>

<script>
const labels = <?php echo json_encode($labels); ?>;
const data = <?php echo json_encode($data); ?>;

new Chart(document.getElementById('resultChart'), {
  type: 'pie',
  data: {
    labels: labels,
    datasets: [{ data: data }]
  }
});
</script>

</body>
</html>
