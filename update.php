<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Assuming user data is stored in session
$user_name = $_SESSION['user_name'] ?? 'User';
$profile_photo = $_SESSION['profile_photo'] ?? 'default.jpg';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['profile_photo']['name']);
        move_uploaded_file($_FILES['profile_photo']['tmp_name'], $target_file);
        $_SESSION['profile_photo'] = $target_file;
        $profile_photo = $target_file;
    }
    $_SESSION['user_name'] = $_POST['user_name'] ?? $user_name;
    $user_name = $_SESSION['user_name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - CodeGuru</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: block;
            margin: 0 auto 20px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
        }
        button {
            background: linear-gradient(to right, #6dc2e9, #2884e6);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            transition: 0.3s;
        }
        button:hover {
            background: linear-gradient(to right, #0056b3, #003f7f);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Profile</h2>
        <img src="<?php echo $profile_photo; ?>" alt="Profile Photo">
        <form method="POST" enctype="multipart/form-data">
            <label for="user_name">Name:</label>
            <input type="text" id="user_name" name="user_name" value="<?php echo $user_name; ?>" required>
            <label for="profile_photo">Profile Photo:</label>
            <input type="file" id="profile_photo" name="profile_photo">
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>