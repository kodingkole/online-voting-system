<?php
include "../config.php";

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$nid = $_POST['nid'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO voters (name,email,phone,nid,password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $nid, $password);
$stmt->execute();

session_start();
$_SESSION['voter'] = $email;
header("Location: voter_profile.php");
