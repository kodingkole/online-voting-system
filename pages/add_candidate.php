<?php
include "../config.php";

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['admin'])){
    header("Location: admin.php");
    exit;
}

if(isset($_POST['add'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $party = $_POST['party'];
  $status = "approved";

  $stmt = $conn->prepare("INSERT INTO candidates (name, email, party, status) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $party, $status);
  $stmt->execute();

  header("Location: candidates_info.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Candidate</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
  <h2>Add New Candidate</h2>

  <form method="POST">
    <input name="name" placeholder="Candidate Name" required>
    <input name="email" placeholder="Candidate Email" required>
    <input name="party" placeholder="Party Name" required>
    <button name="add">Add Candidate</button>
  </form>

  <br>
  <button onclick="location.href='admin_dashboard.php'">Back</button>
</div>

</body>
</html>
