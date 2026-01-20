<?php
include "../config.php";
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM voters WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
  $_SESSION['voter'] = $email;
  header("Location: voter_profile.php");
  exit;
} else {
  echo "<script>alert('Invalid login'); window.location.href='voter.php';</script>";
}
?>
