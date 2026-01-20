<?php
include "../config.php";

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['admin'])){
    header("Location: admin.php");
    exit;
}

$sql = "SELECT * FROM candidates";
$result = $conn->query($sql);

if(!$result){
    die("Query failed: " . $conn->error);
}
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
      <th>Action</th>
    </tr>

    <?php 
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){ ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['party']; ?></td>
              <td><?php echo $row['status']; ?></td>
              <td>
                <!-- Delete Button -->
                <button onclick="showDeleteBox(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>')">
                  Delete
                </button>
              </td>
            </tr>
    <?php }
    } else {
        echo "<tr><td colspan='6' style='text-align:center;'>No candidates found!</td></tr>";
    }
    ?>
  </table>

  <br>
  <button onclick="location.href='admin_dashboard.php'">Back</button>
</div>

<!-- Delete Reason Box -->
<div id="deleteBox" style="display:none; position:fixed; top:20%; left:35%; background:#fff; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.3);">
  <h3>Delete Candidate</h3>
  <form method="POST" action="delete_candidate.php">
    <input type="hidden" name="candidate_id" id="candidate_id">
    <input type="hidden" name="candidate_name" id="candidate_name">
    <textarea name="reason" placeholder="Enter reason for deletion" required style="width:100%; height:80px;"></textarea>
    <br><br>
    <button type="submit" name="delete">Confirm Delete</button>
    <button type="button" onclick="closeBox()">Cancel</button>
  </form>
</div>

<script>
function showDeleteBox(id, name){
  document.getElementById('candidate_id').value = id;
  document.getElementById('candidate_name').value = name;
  document.getElementById('deleteBox').style.display = "block";
}

function closeBox(){
  document.getElementById('deleteBox').style.display = "none";
}
</script>

</body>
</html>
