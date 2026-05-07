<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $language = $_POST['language'] ?? '';
    $code = $_POST['code'] ?? '';

    // Example code saving logic — you can modify it
    // Save code to DB or file...

    // Then set a flag in session
    $_SESSION['code_saved'] = true;

    // Redirect back to new_code.php
    header("Location: new_code.php");
    exit();
}
?>
