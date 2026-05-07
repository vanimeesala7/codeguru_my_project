<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Assuming user data is stored in session
$user_name = $_SESSION['user_name'] ?? 'User';
$profile_photo = $_SESSION['profile_photo'] ?? 'default.jpg';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CodeGuru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #007BFF;
            color: white;
            padding: 15px;
        }
        .header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .header .user-info {
            display: flex;
            align-items: center;
        }
        .container {
            max-width: 600px;
            margin: auto;
        }
        .btn {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .footer {
            margin-top: 50px;
            padding: 10px;
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Welcome to CodeGuru Online Editor</h2>
        <div class="user-info">
            <img src="<?php echo $profile_photo; ?>" alt="Profile Photo">
            <span><?php echo $user_name; ?></span>
        </div>
    </div>
    <div class="container">
        <p>CodeGuru is your go-to platform for writing, saving, and managing your code efficiently.</p>
        <a href="new_code.php" class="btn">New Code</a>
        <a href="saved_codes.php" class="btn">Saved Codes</a>
        <a href="update_profile.php" class="btn">Update Profile</a>
        <a href="history.php" class="btn">History</a>
    </div>
    <div class="footer">
        <p>Developed by [Your Name]</p>
    </div>
</body>
</html>