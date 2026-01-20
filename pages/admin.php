<?php
include "../config.php";

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_POST['login'])){

  $email = trim($_POST['email']);
  $pass = trim($_POST['password']);

  $stmt = $conn->prepare("SELECT * FROM admin WHERE email=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $admin = $stmt->get_result()->fetch_assoc();

  // 🔥 SIMPLE LOGIN (NO HASH)
  if($admin && $pass == "admin123"){
    $_SESSION['admin'] = $email;
    header("Location: admin_dashboard.php");
    exit;
  } else {
    echo "<script>alert('Invalid admin login'); window.location.href='admin.php';</script>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
  <h2>Admin Login</h2>
  <form method="POST">
    <input name="email" placeholder="Email" required>
    <input name="password" placeholder="Password" type="password" required>
    <button name="login">Login</button>
  </form>
</div>

</body>
</html>
