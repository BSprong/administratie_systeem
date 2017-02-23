<?php
require_once("connect.php");
require_once("class_leden.php");

$database = new Database();
$insert =new Leden($database);
if (isset($_POST["submit"])) {
	
	$naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];
    $straat = $_POST['straat'];
    $postcode = $_POST['postcode'];
    $woonplaats = $_POST['plaats'];
    $email = $_POST['email'];
    
    $insert -> InvoerenLeden($naam, $achternaam, $straat, $postcode, $woonplaats, $email);
    
    header('Location: toevoegen_new_lid_gelukt.php');
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Nieuw lid toevoegen</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<link href="style_menu.css" type="text/css" rel="stylesheet">
</head>

<body>
<nav>
<ul id="menu">
    <li><a href="dashboard.php">Home</a></li>
    <li>
        <a href="#">Administratie</a>
        <ul>
            <li><a href="ledenlijst.php">Ledenlijst</a></li>
            <li><a href="new_lid.php">Toevoegen nieuw lid</a></li>
            <li><a href="edit_delete_lid.php">Wijzigen/verwijderen lid</a></li>
        </ul>
    </li>
    <li><a href="#">Foto/video</a>
    	<ul>
    	    <li><a href="foto.php">Alle fotos</a></li>
    	    <li><a href="video.php">Alle videos</a></li>
    		<li><a href="add_foto.php">Toevoegen foto</a></li>
    		<li><a href="add_video.php">Toevoegen video</a></li>
            <li><a href="delete_foto.php">Verwijderen foto</a></li>
            <li><a href="delete_video.php">Verwijderen video</a></li>
    		
    	</ul>

    </li>
	
	<li><a href="#">Notulen/agenda</a>
	    <ul>
	        <li><a href="agenda.php">Alle agendas</a></li>
	        <li><a href="notulen.php">Alle notulen</a></li>
	        <li><a href="add_agenda.php">Toevoegen agenda</a></li>
	        <li><a href="add_notulen.php">Toevoegen notulen</a></li>
	        <li><a href="delete_agenda.php">Verwijderen agenda</a></li>
	        <li><a href="delete_notulen.php">Verwijderen notulen</a></li>
	    </ul>
    </li>
    
    <li>
  
	   <form method="post" action="#" ><input type="submit" name="exportToExcel" value="Export to Excel" /></form>
    </li>
    
</ul>
</nav>

<div id="welkom">
<?php 
echo "<p>welkom, "  .$_SESSION ['username']  ." <a href='logout.php' onclick='return confirm(\"Weet u zeker dat u wilt uitloggen?\")'>uitloggen</a></p>";
if(!empty($_SESSION['username']) ) { 
}
else {
  header('Location: index.php'); 
}
	
?>

<form method="post" action="">
    <br />
    <input type="text" name="naam" placeholder="naam"/><br /><br />
     <br />
    <input type="text" name="achternaam" placeholder="achternaam" /><br /><br />
     <br />
    <input type="text" name="straat" placeholder="straatnaam" /><br /><br />
     <br />
    <input type="text" name="postcode" placeholder="postcode" /><br /><br />
     <br />
    <input type="text" name="plaats" placeholder="plaats" /><br /><br />
     <br />
    <input type="text" name="email" placeholder="E-mailadres" /><br /><br />
    <input type="submit" name="submit" value="Verstuur" /><br /><br />
    <a href="dashboard.php">Klik hier om terug te gaan</a>
    
</form>
</body>
</html>
