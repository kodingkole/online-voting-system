<?php
include "../config.php";
session_start();

// If not logged in, go to voter page
if (!isset($_SESSION['voter'])) {
    header("Location: voter.php");
    exit;
}

$email = $_SESSION['voter'];

// Check if voter already voted
$stmt = $conn->prepare("SELECT voted FROM voters WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$voter = $result->fetch_assoc();

if ($voter['voted'] == 1) {
    header("Location: voter_profile.php");
    exit;
}

// Voting Process
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $candidate_id = $_POST['candidate'];

    // Update candidate votes
    $stmt2 = $conn->prepare("UPDATE candidates SET votes = votes + 1 WHERE id=?");
    $stmt2->bind_param("i", $candidate_id);
    $stmt2->execute();

    // Mark voter as voted
    $stmt3 = $conn->prepare("UPDATE voters SET voted=1 WHERE email=?");
    $stmt3->bind_param("s", $email);
    $stmt3->execute();

    session_destroy();
    echo "Voted Successfully";
    exit;
}

// Get approved candidates only
$candidates = $conn->query("SELECT * FROM candidates WHERE status='approved'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vote Now</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="top">
    <button onclick="location.href='../index.php'">Home</button>
</div>

<div class="container">
    <h2>Select Candidate</h2>

    <form method="POST">
        <div class="vote-list">

            <?php while($row = $candidates->fetch_assoc()): ?>
                <div class="vote-card">
                    <!-- Candidate Image -->
                    <img src="../uploads/candidate_images/<?php echo $row['image']; ?>" width="120" alt="Candidate">


                    <input type="radio" name="candidate" value="<?= $row['id'] ?>" required>
                    <b><?= $row['name'] ?></b> <br>
                    <?= $row['party'] ?> <br>
                    <?= $row['slogan'] ?>
                </div>
            <?php endwhile; ?>

        </div>

        <button class="primary" type="submit">Confirm Vote</button>
    </form>
</div>

</body>
</html>
