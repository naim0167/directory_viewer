<?php
require_once 'config.php';
require_once 'DirectoryHandler.php';

$homeDirectory = $_SESSION['home_directory'] ?? '';
if (isset($_GET['home_directory'])) {
    $homeDirectory =  $_GET['home_directory'];
}

$directoryHandler = new DirectoryHandler($homeDirectory);
$directoryHandler->handleNavigation();
$directoryHandler->back();
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
        <?php if (is_dir($directoryHandler->getAbsolutePath() . DIRECTORY_SEPARATOR . $item)) : ?>
            <li>
                <a href="?directory=<?php echo urlencode($item); ?>"><?php echo htmlspecialchars($item); ?></a>
            </li>
        <?php else : ?>
            <li><?php echo htmlspecialchars($item); ?></li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>

<a href="?back">Back to Start Directory</a>

<?php endif; ?>

</body>
</html>