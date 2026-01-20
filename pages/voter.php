<!DOCTYPE html>
<html>
<head>
  <title>Voter</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="top">
  <button onclick="location.href='../pages/voting.php'">Back</button>
</div>

<div class="container">
  <h2>Voter Registration</h2>
  <form action="voter_register.php" method="POST">
    <input name="name" placeholder="Name" required>
    <input name="email" placeholder="Email" required>
    <input name="phone" placeholder="Phone" required>
    <input name="nid" placeholder="NID" required>
    <input name="password" placeholder="Password" type="password" required>
    <button class="success" type="submit">Register</button>
  </form>

  
</div>

</body>
</html>
