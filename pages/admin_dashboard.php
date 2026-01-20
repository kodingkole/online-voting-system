<?php
include "../config.php";

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['admin'])){
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-container">
  <h2>Welcome Admin</h2>

<div class="admin-buttons">
  <button onclick="location.href='voters_info.php'">Voters Info</button>
  <button onclick="location.href='candidates_info.php'">Candidates Info</button>
  <button onclick="location.href='add_candidate.php'">Add Candidate</button>
  <button onclick="location.href='admin_logout.php'">Logout</button>
</div>

</div>


</body>
</html>
