<?php
session_start();
  require_once("connect.php");
  require_once("class_login.php");
  $database = new Database();
  
  $login = new Login($database);
  if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string ($database, $_POST ['username']);
    $password = $_POST['password'];
    $login->Inloggen($username, $password);
  }
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Inloggen administratie systeem</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	
</head>

<body>
<div id="content">
	<div id="box1">
	<h1>Inloggen</h1>
		<p>Nog geen account? <a href="register.php">Maak dit hier aan</a></p>
	<hr>
	<form action='' method='POST'>
		<label>Gebruikersnaam:</label> <input type='text' name='username' required><br /><br />
		<label>Wachtwoord: </label><input type='password' name='password' required><br />
		<input type='submit' name='login' value='log in' >
	</form>
	</div>
</div>
</body>
</html>
