<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$saved_codes = $_SESSION['saved_codes'] ?? [];

if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    unset($saved_codes[$index]);
    $_SESSION['saved_codes'] = array_values($saved_codes); // reindex array
    header("Location: saved_code.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Saved Codes</title>
</head>
<body>
    <h2>Saved Codes</h2>
    <?php if (empty($saved_codes)): ?>
        <p>No saved code yet.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($saved_codes as $index => $code): ?>
                <li>
                    <strong><?php echo htmlspecialchars($code['title'] ?? 'Untitled'); ?></strong><br>
                    Language: <?php echo htmlspecialchars($code['language']); ?><br>
                    Time: <?php echo htmlspecialchars($code['timestamp']); ?><br>
                    <pre><?php echo htmlspecialchars($code['code']); ?></pre>

                    <form method="get" action="saved_code.php" style="display:inline;">
                        <input type="hidden" name="delete" value="<?php echo $index; ?>">
                        <button type="submit">Delete</button>
                    </form>

                    <form method="post" action="update_code.php" style="display:inline;">
                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                        <button type="submit">Update</button>
                    </form>
                </li>
                <hr>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
