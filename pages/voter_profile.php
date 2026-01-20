<?php
include "../config.php";
session_start();

if(!isset($_SESSION['voter'])){
  header("Location: voter.php");
  exit;
}

$email = $_SESSION['voter'];

$voter = $conn->prepare("SELECT * FROM voters WHERE email=?");
$voter->bind_param("s", $email);
$voter->execute();
$user = $voter->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Voter Profile</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="top">
  <button onclick="location.href='../index.php'">Home</button>
  <button onclick="location.href='logout.php'">Logout</button>
</div>

<div class="container">
  <h2>Voter Profile</h2>
  <div class="card">
    <p><b>Name:</b> <?php echo $user['name']; ?></p>
    <p><b>Email:</b> <?php echo $user['email']; ?></p>
    <p><b>Phone:</b> <?php echo $user['phone']; ?></p>
    <p><b>NID:</b> <?php echo $user['nid']; ?></p>
    <p><b>Voting Status:</b> <?php echo ($user['voted'] == 1) ? "Voted" : "Not Voted"; ?></p>
  </div>

  <?php if($user['voted'] == 0){ ?>
    <a class="primary" href="vote_now.php">Vote Now</a>
  <?php } else { ?>
    <p>You already voted</p>
  <?php } ?>
</div>

</body>
</html>
