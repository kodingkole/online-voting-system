<?php
include "../config.php";

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['admin'])){
    header("Location: admin.php");
    exit;
}

if(isset($_POST['delete'])){

  $candidate_id = $_POST['candidate_id'];
  $candidate_name = $_POST['candidate_name'];
  $reason = $_POST['reason'];

  // 1) Save reason
  $stmt = $conn->prepare("INSERT INTO candidate_delete_log (candidate_id, candidate_name, reason) VALUES (?, ?, ?)");
  $stmt->bind_param("iss", $candidate_id, $candidate_name, $reason);
  $stmt->execute();

  // 2) Delete candidate
  $stmt = $conn->prepare("DELETE FROM candidates WHERE id = ?");
  $stmt->bind_param("i", $candidate_id);
  $stmt->execute();

  header("Location: candidates_info.php");
  exit;
}
?>
