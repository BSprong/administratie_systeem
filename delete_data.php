<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
</head>

<body>
<?php
include_once 'connect.php';
include_once 'class_leden.php';
$database = new Database();
$delete = new Leden($database);

if(isset($_GET['delete_id']))
{
 $id=$_GET['delete_id'];
 $res=$delete->Delete($id);
 if(!$res)
 {
  ?>
  <script>
  alert('Record Deleted ...')
        window.location='delete_foto.php'
        </script>
  <?php
 }
 else
 {
  ?>
  <script>
  alert('Record cant Deleted !!!')
        window.location='dashboard.php'
        </script>
  <?php
 }
}
?>
</body>
</html>
