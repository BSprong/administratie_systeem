<?php
require_once("connect.php");
require_once("class_leden.php");
$database = new Database();
$update = new Leden($database);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Update en verwijderen van leden</title>
	<script>
	function del_id(id)
	{
	if(confirm('Sure to delete this record ?'))
	{
	window.location='delete_data.php?delete_id='+id
	}
	}
	
	function edit_id(id)
{
  window.location='edit_data.php?edit_id='+id
}
	</script>
	
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
<table>
<tr>
    <th>Voornaam</th>
    <th>Achternaam</th>
    <th>Straat</th>
    <th>Postcode</th>
    <th>Woonplaats</th>
    <th>E-mailadres</th>
    <th colspan="2">edit/delete</th>
    </tr>
    <?php
    $sql = "SELECT * FROM ledenlijst";
        $result = $database->query($sql);
 while($row = mysqli_fetch_row($result))
 {
   ?>
            <tr>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php echo $row[3]; ?></td>
            <td><?php echo $row[4]; ?></td>
            <td><?php echo $row[5]; ?></td>
            <td><?php echo $row[6]; ?></td>
            
            <td align="center"><a href="javascript:edit_id(<?php echo $row[0]; ?>)">Edit</a></td>
            <td align="center"><a href="javascript:del_id(<?php echo $row[0]; ?>)"> Delete</a></td>
            </tr>
            <?php
 }
 ?>
</table>

<a href="dashboard.php">Klik hier om terug tegaan</a>
</body>
</html>
