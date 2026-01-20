<?php
include "../config.php";
$id = $_GET['id'];
$conn->query("UPDATE candidates SET status='approved' WHERE id='$id'");
header("Location: admin.php");
