<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $language = $_POST['language'] ?? '';
    $code = $_POST['code'] ?? '';
    $user_id = $_SESSION['user_id'];
    $title = $_SESSION['title']; // you can let user set title later

    if (!empty($language) && !empty($code)) {
        $stmt = $conn->prepare("INSERT INTO code_snippets (user_id, language, content, title) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $language, $code, $title);
        $stmt->execute();

        $_SESSION['code_saved'] = true;
    }
    header("Location: new_code.php");
    exit();
}
?>
