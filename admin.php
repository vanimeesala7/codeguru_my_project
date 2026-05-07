<?php
session_start();
include 'db.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all users
$user_query = "SELECT id, username, email FROM users";
$user_result = $conn->query($user_query);

// Fetch all code snippets
$code_query = "SELECT user_id, language FROM code_snippets";
$code_result = $conn->query($code_query);

// Prepare stats
$user_stats = [];

while ($row = $code_result->fetch_assoc()) {
    $uid = $row['user_id'];
    $lang = $row['language'];

    if (!isset($user_stats[$uid])) {
        $user_stats[$uid] = ['code_count' => 0, 'languages' => [], 'score' => 0];
    }

    $user_stats[$uid]['code_count'] += 1;
    $user_stats[$uid]['score'] += 5; // assuming 5 pts per code
    $user_stats[$uid]['languages'][$lang] = true;
}

// Function to get language icon
function getLangIcon($lang) {
    $icons = [
        'Python' => '🐍',
        'C' => '🅲',
        'C++' => '➕➕',
        'Java' => '☕',
        'PHP' => '🐘',
        'JavaScript' => '🟨',
        'Go' => '🐹',
        'Ruby' => '💎',
        'Kotlin' => '🔷',
        'Swift' => '🦅'
    ];
    return $icons[$lang] ?? '💻';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - CodeGuru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f7;
            padding: 20px;
        }
        h2 {
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background: #007bff;
            color: white;
        }
        .logout {
            float: right;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<a href="logout.php" class="logout">Logout</a>
<h2>Admin Dashboard - User Overview</h2>

<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Codes Run</th>
        <th>Score</th>
        <th>Languages Used</th>
    </tr>

    <?php while ($user = $user_result->fetch_assoc()): 
        $uid = $user['id'];
        $stats = $user_stats[$uid] ?? ['code_count' => 0, 'score' => 0, 'languages' => []];
    ?>
    <tr>
        <td><?= htmlspecialchars($user['username']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= $stats['code_count'] ?></td>
        <td><?= $stats['score'] ?></td>
        <td>
            <?php foreach ($stats['languages'] as $lang => $_): ?>
                <?= getLangIcon($lang) ?> <?= htmlspecialchars($lang) ?>&nbsp;
            <?php endforeach; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
