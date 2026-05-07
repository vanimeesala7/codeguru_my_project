<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_name = $_SESSION['username'] ?? 'User';
$profile_photo = $_SESSION['profile_photo'] ?? 'default.jpg';
$score = 0;

$query = "SELECT score FROM users WHERE username = '$user_name'";
$result = mysqli_query($conn, $query);
if ($row = mysqli_fetch_assoc($result)) {
    $score = $row['score'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CodeGuru</title>
    <link rel="stylesheet" href="mystyles.css">
</head>
<body>
    <div class="header">
        <h2>CodeGuru</h2>
        <div class="user-info">
            <?php echo $_SESSION['username']; ?><strong>-<?php echo $score; ?></strong>&#x1FA99;</p>
            <img src="<?php echo $profile_photo; ?>" alt="Profile Photo">
            <a href="logout.php">logout</a>
        </div>
    </div>
    <div class="main-container">
        <div class="content">
            <h2>Welcome to CodeGuru</h2>
            <p>Your go-to platform for writing, saving, and managing your code efficiently.</p>
        </div>
        <div class="container">
            <div class="sidebar">
                <a href="new_code.php" class="btn">+New Code</a>
                <a href="save.php" class="btn saved-btn">Saved Codes</a>
                <a href="update.php" class="btn"><span style='font-size:20px;'>&#8593;</span> Update Profile</a>
                <a href="score.php" class="btn">View Score</a>
            </div>
            <div class="image-container">
                <img src="https://i.pinimg.com/736x/fd/0f/46/fd0f469de747c3998582d1a499b2d1a1.jpg" alt="Code Editor Preview">
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Developed by Code Captain</p>
    </div>
</body>
</html>
