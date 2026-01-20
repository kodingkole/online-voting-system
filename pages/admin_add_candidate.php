<?php
include "../config.php";

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['admin'])){
    header("Location: admin.php");
    exit;
}

$result = $conn->query("SELECT * FROM candidates");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Candidates Info</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
  <h2>Existing Candidates List</h2>

  <table border="1" width="100%">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Party</th>
      <th>Status</th>
    </tr>

    <?php while($row = $result->fetch_assoc()){ ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['party']; ?></td>
        <td><?php echo $row['status']; ?></td>
      </tr>
    <?php } ?>

  </table>

  <br>
  <button onclick="location.href='admin_dashboard.php'">Back</button>
</div>

</body>
</html>
