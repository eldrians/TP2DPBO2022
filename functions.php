<?php
function pdo_connect_mysql()
{
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'phpcrud';
	try {
		return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
	} catch (PDOException $exception) {
		// If there is an error with the connection, stop the script and display the error.
		exit('Failed to connect to database!');
	}
	$connection= mysqli_connect("localhost", "root", "", "phpcrud");
}

function template_header($title)
{
	echo <<<EOT
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>$title</title>
			<link rel="stylesheet" href="assets/style/style.css">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		</head>
		<body>
		<nav class="navtop">
			<div>
				<img src = "assets/images/upiT.png">
				<a href="index.php"><i class="fas fa-home"></i>Home</a>
				<a href="divisi/readDivisi.php">Data Organisasi</a>
			</div>
		</nav>

		<div class="titleO">
			<h1>DAFTAR ANGGOTA BEM INDONESIA</h1>
		</div>
	EOT;
}

function template_header_review($title)
{
	echo <<<EOT
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>$title</title>
			<link rel="stylesheet" href="assets/style/style.css">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		</head>
		<body>
		<nav class="navtop">
			<div>
				<img src = "assets/images/upiT.png">
				<a href="index.php"><i class="fas fa-home"></i>Home</a>
				<a href="divisi/readDivisi.php">Data Organisasi</a>
			</div>
		</nav>
	EOT;
}

function template_header_divisi($title)
{
	echo <<<EOT
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>$title</title>
			<link rel="stylesheet" href="../assets/style/style.css">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		</head>
		<body>
		<nav class="navtop">
			<div>
				<img src = "../assets/images/upiT.png">
				<a href="../index.php"><i class="fas fa-home"></i>Home</a>
				<a href="readDivisi.php">Data Organisasi</a>
			</div>
		</nav>
	EOT;
}

function template_header_bidang($title)
{
	echo <<<EOT
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>$title</title>
			<link rel="stylesheet" href="../assets/style/style.css">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		</head>
		<body>
		<nav class="navtop">
			<div>
				<img src = "../assets/images/upiT.png">
				<a href="../index.php"><i class="fas fa-home"></i>Home</a>
				<a href="../divisi/readDivisi.php">Data Organisasi</a>
			</div>
		</nav>
	EOT;
}

function template_header_pengurus($title)
{
	echo <<<EOT
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>$title</title>
			<link rel="stylesheet" href="../assets/style/style.css">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		</head>
		<body>
		<nav class="navtop">
			<div>
				<img src = "../assets/images/upiT.png">
				<a href="../index.php"><i class="fas fa-home"></i>Home</a>
				<a href="../divisi/readDivisi.php">Data Organisasi</a>
			</div>
		</nav>
	EOT;
}

function template_footer()
{
	echo <<<EOT
    </body>
</html>
EOT;
}
