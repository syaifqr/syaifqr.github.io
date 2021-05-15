<?php
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
</head>
<body>
	<h1>Selamat datang</h1>
	<a href="logout.php">Logout</a>
</body>
</html>