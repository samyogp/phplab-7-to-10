<?php
$filename = "note.txt";

if (file_exists($filename)) {
    $content = file_get_contents($filename);

    if (trim($content) === "") {
        echo "<p><strong>File is empty.</strong></p>";
    } else {
        echo "<h3>Note Content:</h3>";
        echo "<pre>$content</pre>";
    }
} else {
    echo "<p><strong>File does not exist.</strong></p>";
}
?>
