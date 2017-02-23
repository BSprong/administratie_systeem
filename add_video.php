<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once('connect.php');
require_once('class_foto_video.php');
$database = new Database();
 
if(isset($_FILES['file'])){
   $fileupload = new FotoVideo($database);
$fileupload->UploadVideo();

    if($fileupload -> uploadfileVideo()){
        echo 'Bestand is geüpload';
    }
}

/*
if (isset($_POST["submit"])) {
    $naam = $_POST['name'];
    //$filepath = $_POST['file'];
    $beschrijving = $_POST['description'];
    
    $fileupload = new FotoVideo($database);
    $fileupload -> VoegFotoInDatabase($naam,$beschrijving);
    //echo 'data toegevoegd';
}*/
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Video toevoegen</title>
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
<h1>Uploaden van video</h1>

<p>Alleen bestanden mp4 worden geüpload</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    Blader naar video
    Select upload file: <input type="file" name="file" required="yes"  />
    <br /><br />
    <h3>Naam:</h3> 
    <input type="text" name="naam" /><br />
    <h3>Beschrijving</h3>
    <!--<textarea rows="4" cols="50" name="beschrijving"></textarea>-->
    <?php $text="<textarea class='ckeditor' name='beschrijving'></textarea>"; htmlspecialchars($text); echo $text;?>
    <br /><br />
   <input type="submit" name="submit" value="Verstuur" />
</form>
</body>
</html>
