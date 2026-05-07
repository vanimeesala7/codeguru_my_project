<form method="POST" action="save_code.php">
    <label for="title">Code Title:</label>
    <input type="text" id="title" name="title" placeholder="Enter title..." required>

    <label for="language">Select Language:</label>
    <select id="language" name="language" onchange="loadSampleCode()">
        ...
    </select>

    <textarea id="codeEditor" name="code" rows="10" placeholder="Write your code here..."></textarea>

    <div class="button-container">
        <button type="submit">Save Code</button>
        <button type="button" onclick="runCode()">Run Code</button>
    </div>
</form>
