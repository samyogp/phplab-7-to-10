<!DOCTYPE html>
<html>
<head>
    <title>PHP File Handling Lab</title>
</head>
<body>

<h2>📁 PHP File Handling with Random Access, Edit & Delete</h2>

<form method="post">
    <textarea name="text" rows="5" cols="50" placeholder="Enter your text here..."></textarea>
    <br><br>

    Line Number:
    <input type="number" name="line_number" min="1">
    <br><br>

    <input type="submit" name="action" value="Write">
    <input type="submit" name="action" value="Append">
    <input type="submit" name="action" value="Read">
    <input type="submit" name="action" value="Read Line">
    <input type="submit" name="action" value="Edit Line">
    <input type="submit" name="action" value="Delete Line">
</form>

<?php
$filename = "data.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST["action"];
    $text = isset($_POST["text"]) ? trim($_POST["text"]) : "";
    $line_number = isset($_POST["line_number"]) ? (int)$_POST["line_number"] : 0;

    /* WRITE (Overwrite) */
    if ($action == "Write") {
        file_put_contents($filename, $text . PHP_EOL);
        echo "<p><strong>File written successfully!</strong></p>";
    }

    /* APPEND */
    elseif ($action == "Append") {
        file_put_contents($filename, $text . PHP_EOL, FILE_APPEND);
        echo "<p><strong>Text appended successfully!</strong></p>";
    }

    /* READ FULL FILE */
    elseif ($action == "Read") {
        if (file_exists($filename)) {
            $content = file_get_contents($filename);
            echo "<h3>File Content:</h3><pre>$content</pre>";
        } else {
            echo "<p><strong>No file found.</strong></p>";
        }
    }

    /* READ SPECIFIC LINE */
    elseif ($action == "Read Line") {
        if (file_exists($filename)) {
            $lines = file($filename);

            if ($line_number >= 1 && $line_number <= count($lines)) {
                echo "<h3>Line $line_number:</h3>";
                echo "<pre>{$lines[$line_number - 1]}</pre>";
            } else {
                echo "<p><strong>Invalid line number.</strong></p>";
            }
        } else {
            echo "<p><strong>No file found.</strong></p>";
        }
    }

    /* EDIT SPECIFIC LINE */
    elseif ($action == "Edit Line") {
        if (file_exists($filename)) {
            $lines = file($filename);

            if ($line_number >= 1 && $line_number <= count($lines)) {
                $lines[$line_number - 1] = $text . PHP_EOL;
                file_put_contents($filename, implode("", $lines));
                echo "<p><strong>Line $line_number updated successfully!</strong></p>";
            } else {
                echo "<p><strong>Invalid line number.</strong></p>";
            }
        } else {
            echo "<p><strong>No file found.</strong></p>";
        }
    }

    /* DELETE SPECIFIC LINE */
    elseif ($action == "Delete Line") {
        if (file_exists($filename)) {
            $lines = file($filename);

            if ($line_number >= 1 && $line_number <= count($lines)) {
                unset($lines[$line_number - 1]);
                file_put_contents($filename, implode("", $lines));
                echo "<p><strong>Line $line_number deleted successfully!</strong></p>";
            } else {
                echo "<p><strong>Invalid line number.</strong></p>";
            }
        } else {
            echo "<p><strong>No file found.</strong></p>";
        }
    }
}
?>

</body>
</html>
