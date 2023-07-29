<?php
$homeDirectory = isset($_GET['directory']);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Directory Viewer</title>
</head>
<body>

<h1>Directory Viewer</h1>

<form action="/">
    <input type="text" name="directory">
    <button type="submit" >Set home directory</button>
</form>

<?php if ($homeDirectory): ?>

<!-- Display the current directory -->
<p>Current Directory: E:\</p>

<!-- Display the list of files and directories in the current directory -->
<ul>
    <li>
        <a href="#">sub directory 1</a>
    </li>
</ul>

<a href="?back">Back to Start Directory</a>

<?php endif; ?>

</body>
</html>