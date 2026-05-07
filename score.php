<?php
session_start();
include 'db.php';

$query = "SELECT username, email, score FROM users ORDER BY score DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard - CodeGuru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            padding: 40px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 15px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #eef;
        }
    </style>
</head>
<body>
    <h2>🏆 CodeGuru Leaderboard</h2>
    <table>
        <tr>
            <th>Rank</th>
            <th>Username</th>
            <th>Email</th>
            <th>Score</th>
        </tr>
        <?php
        $rank = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$rank}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['score']}</td>
                  </tr>";
            $rank++;
        }
        ?>
    </table>
</body>
</html>
