<!DOCTYPE html>
<html>
<body>

<form method="post">
    <textarea name="note" rows="4" cols="40"></textarea><br><br>
    <input type="submit" value="Save Note">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = trim($_POST["note"]);
    file_put_contents("note.txt", $text);
    echo "<p><strong>Note saved successfully!</strong></p>";
}
?>

</body>
</html>
