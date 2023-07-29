<?php
require_once 'config.php';
require_once 'DirectoryHandler.php';

$homeDirectory = $_GET['home_directory'] ?? '';
$directoryHandler = new DirectoryHandler($homeDirectory);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Directory Viewer</title>
</head>
<body>

<h1>Directory Viewer</h1>

<form action="/">
    <input type="text" name="home_directory">
    <button type="submit" >Set home directory</button>
</form>

<?php if ($homeDirectory): ?>

<p>Current Directory: <?php echo $directoryHandler->getAbsolutePath(); ?></p>

<ul>
    <?php foreach ($directoryHandler->scanDirectory() as $item) : ?>
        <li><?php echo htmlspecialchars($item); ?></li>
    <?php endforeach; ?>
</ul>

<a href="?back">Back to Start Directory</a>

<?php endif; ?>

</body>
</html>