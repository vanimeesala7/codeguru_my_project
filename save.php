<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM code_snippets WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Saved Codes</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .code-box { background: #fff; padding: 15px; margin: 10px 0; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1); }
        .btn { padding: 5px 10px; border: none; border-radius: 5px; margin: 5px; cursor: pointer; }
        .btn-update { background: #28a745; color: white; }
        .btn-delete { background: #dc3545; color: white; }
    </style>
</head>
<body>

<h2>My Saved Codes</h2>

<?php while ($row = $result->fetch_assoc()): ?>
    <div class="code-box">
        <h3><?php echo htmlspecialchars($row['title']); ?> (<?php echo $row['language']; ?>)</h3>
        <pre><?php echo htmlspecialchars($row['content']); ?></pre>
        <form method="POST" action="new_code.php" style="display:inline;">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <button class="btn btn-update" type="submit">Update</button>
</form>

        <form method="POST" action="delete_code.php" style="display:inline;" onsubmit="return confirm('Are you sure to delete?')">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button class="btn btn-delete" type="submit">Delete</button>
        </form>
    </div>
<?php endwhile; ?>

<?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
<script>
    alert("Code successfully deleted.");
    window.location.href = "save.php"; // ✅ Go to save.php after OK
</script>
<?php endif; ?>


</body>
</html>

