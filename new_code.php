<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$show_alert = false;
if (isset($_SESSION['code_saved']) && $_SESSION['code_saved']) {
    $show_alert = true;
    unset($_SESSION['code_saved']);
}
$user_id=$_SESSION['user_id'];
$user_name = $_SESSION['user_name'] ?? 'User';
$profile_photo = $_SESSION['profile_photo'] ?? 'default.jpg';

$title = $_SESSION['edit_title'] ?? '';
$language = $_SESSION['edit_language'] ?? '';
$code = $_SESSION['edit_code'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Code - CodeGuru</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: rgb(254, 254, 254);
            color: blue;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header .user-info {
            display: flex;
            align-items: center;
        }
        .header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            border: 2px solid white;
        }
        .main-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            max-width: 1200px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .code-container {
            width: 50%;
            padding-right: 20px;
        }
        .output-container {
            width: 50%;
            background: #eaeaea;
            padding: 15px;
            border-radius: 5px;
            text-align: left;
            min-height: 350px;
            white-space: pre-wrap;
        }
        select, textarea, input[type="text"], button {
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
        button {
            background: linear-gradient(to right, #6dc2e9, #2884e6);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
            width: 48%;
        }
        button:hover {
            background: linear-gradient(to right, #0056b3, #003f7f);
        }
    </style>
    <script>
        function loadSampleCode() {
            var language = document.getElementById("language").value;
            var codeEditor = document.getElementById("codeEditor");

            var samples = {
                "Python": "print('Hello, World!')",
                "Java": "public class Main {\n    public static void main(String[] args) {\n        System.out.println(\"Hello, World!\");\n    }\n}",
                "C": "#include <stdio.h>\nint main() {\n    printf(\"Hello, World!\\n\");\n    return 0;\n}",
                "JavaScript": "console.log('Hello, World!');",
                "C++": "#include <iostream>\nusing namespace std;\nint main() {\n    cout << \"Hello, World!\\n\";\n    return 0;\n}",
                "PHP": "<?php\necho 'Hello, World!';\n?>",
                "Swift": "import Swift\nprint(\"Hello, World!\")",
                "Ruby": "puts 'Hello, World!'",
                "Kotlin": "fun main() {\n    println(\"Hello, World!\")\n}",
                "Go": "package main\nimport \"fmt\"\nfunc main() {\n    fmt.Println(\"Hello, World!\")\n}"
            };

            codeEditor.value = samples[language] || "";
        }

        function runCode() {
            var language = document.getElementById("language").value;
            var code = document.getElementById("codeEditor").value;
            var outputContainer = document.getElementById("output");

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "run_code.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    outputContainer.innerText = xhr.responseText;
                }
            };
            xhr.send("language=" + encodeURIComponent(language) + "&code=" + encodeURIComponent(code));
        }
    </script>
</head>
<body>
    <div class="header">
        <h2>CodeGuru</h2>
        <div class="user-info">
            <img src="<?php echo $profile_photo; ?>" alt="Profile Photo">
            <span><?php echo htmlspecialchars($user_name); ?></span>
        </div>
    </div>

    <div class="main-container">
        <div class="code-container">
            <h2>Create New Code</h2>
            <form method="POST" action="save_code.php">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" placeholder="Enter code title..." required>

                <label for="language">Select Language:</label>
                <select id="language" name="language" onchange="loadSampleCode()">
                    <option value="Python">Python</option>
                    <option value="Java">Java</option>
                    <option value="C">C</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="C++">C++</option>
                    <option value="PHP">PHP</option>
                    <option value="Swift">Swift</option>
                    <option value="Ruby">Ruby</option>
                    <option value="Kotlin">Kotlin</option>
                    <option value="Go">Go</option>
                </select>

                <label for="codeEditor">Your Code:</label>
                <textarea id="codeEditor" name="code" rows="10" placeholder="Write your code here..." required></textarea>

                <div class="button-container">
                    <button type="submit">Save Code</button>
                    <button type="button" onclick="runCode()">Run Code</button>
                </div>
            </form>
        </div>

        <div class="output-container" id="output">
            Output will be displayed here...
        </div>
    </div>

<?php if ($show_alert): ?>
<script>
    alert("Code saved successfully!");
</script>
<?php 
    include 'db.php'; // ✅ Add this line to connect to DB
    $userId = $_SESSION['user_id'];
    $query = "UPDATE users SET score = score + 10 WHERE id = $userId";
    if (!mysqli_query($conn, $query)) {
        echo "Error updating score: " . mysqli_error($conn);
    }
?>
<?php endif; ?>
</body>
</html>
