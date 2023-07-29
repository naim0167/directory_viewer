<!DOCTYPE html>
<html>
<head>
    <title>Directory Viewer</title>
</head>
<body>

<h1>Directory Viewer</h1>

<form action="GET">
    <input type="text" name="home_directory">
    <button type="submit" >Set home directory</button>
</form>

<!-- Display the current directory -->
<p>Current Directory: E:\</p>

<!-- Display the list of files and directories in the current directory -->
<ul>
    <li>
        <a href="#">sub directory 1</a>
    </li>
</ul>

<a href="?back">Back to Start Directory</a>

</body>
</html>