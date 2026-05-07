<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM saved_codes WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $code_data = mysqli_fetch_assoc($result);

    if ($code_data) {
        $_SESSION['edit_code_id'] = $code_data['id'];
        $_SESSION['edit_title'] = $code_data['title'];
        $_SESSION['edit_language'] = $code_data['language'];
        $_SESSION['edit_code'] = $code_data['code'];
        header("Location: new_code.php?edit=true");
        exit();
    } else {
        echo "Code not found.";
    }
} else {
    echo "Invalid request.";
}
?>
