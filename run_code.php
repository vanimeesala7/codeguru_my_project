<?php
session_start(); // Needed to access session variables

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $language = $_POST['language'];
    $code = $_POST['code'];

    if ($language === "Python") {
        $file = tempnam(sys_get_temp_dir(), 'pycode_') . '.py';
        file_put_contents($file, $code);

        // Run the code and capture output and errors
        $output = shell_exec("python \"$file\" 2>&1");

        // Check if the output contains an error
        if (stripos($output, 'Traceback') === false) {
            // No Python errors found
            $_SESSION['score'] = ($_SESSION['score'] ?? 0) + 5;
        }

        // Show output
        echo $output;

        // Clean up
        unlink($file);
    } else {
        echo "Hello World !! Welcome to SSS Lab";
    }
}
?>
