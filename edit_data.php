<?php

include_once 'connect.php';
include_once 'class_leden.php';
$database = new Database();
$update = new Leden($database);
//$table = "users";

//if(isset($_GET['edit_id']))
//{
 //$sql=mysqli_query("SELECT * FROM users WHERE user_id=".$_GET['edit_id']);
 $query = "SELECT * FROM ledenlijst WHERE id=" . $_GET['edit_id'];
 $result = $database->query($query);
 $row = mysqli_fetch_assoc($result);
 //$result=mysqli_fetch_array($sql);
//}

// data update code starts here.
if(isset($_POST['submit']))
{
 $id = $_POST['id'];
 $vname = $_POST['naam'];
 $aname = $_POST['achternaam'];
 $straat = $_POST['straatnaam'];
 $postcode = $_POST['postcode'];
 $plaats = $_POST['woonplaats'];
 $email = $_POST['email'];
 
 //$id=$_GET['edit_id'];
 $res=$update->UpdateLeden($vname,$aname,$straat, $postcode, $plaats, $email,$id);
 
 if(!$res)
 {
  ?>
  <script>
  alert('Record updated...');
        window.location='ledenlijst.php'
        </script>
  <?php
 }
 else
 {
  ?>
  <script>
  alert('error updating record...');
        window.location='edit_delete_lid.php'
        </script>
  <?php
 }
}

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
</head>

<body>
<form method="post">
    <table>
    <tr>
    <td><input type="text" name="id" placeholder="id" value="<?php echo $row['id']; ?>"  /></td>
    </tr>
    <tr>
    <td><input type="text" name="naam" placeholder="First Name" value="<?php echo $row['naam']; ?>"  /></td>
    </tr>
    <tr>
    <td><input type="text" name="achternaam" placeholder="Last Name" value="<?php echo $row['achternaam']; ?>" /></td>
    </tr>
    <tr>
    <td><input type="text" name="straatnaam" placeholder="City" value="<?php echo $row['straatnaam']; ?>" /></td>
    </tr>
    <tr>
    <td><input type="text" name="postcode" placeholder="City" value="<?php echo $row['postcode']; ?>" /></td>
    </tr>
    <tr>
    <td><input type="text" name="woonplaats" placeholder="City" value="<?php echo $row['woonplaats']; ?>" /></td>
    </tr>
    <tr>
    <td><input type="text" name="email" placeholder="City" value="<?php echo $row['email']; ?>" /></td>
    </tr>
    <tr>
    <td>
    <input type="submit" name="submit" name="update" value="Update"/></td>
    </tr>
    </table>
    </form>
</body>
</html>
