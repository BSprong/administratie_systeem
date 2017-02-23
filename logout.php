<?php
require_once('connect.php');
require_once('class_leden.php');
$database = new Database();
$logout = new Leden($database);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
</head>

<body>
<?php
$logout->Uitloggen();
?>
</body>
</html>
