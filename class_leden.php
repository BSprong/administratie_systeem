<?php

session_start();

class Leden{

private $database;
  
  public function __construct($database)
  {
	$this->database = $database;
  }
  
  public function SelecteerLeden(){
    $sql = "SELECT * FROM ledenlijst";
		if($pre = $this->database->prepare($sql)){
			//$pre->bind_param('i');
			$pre->execute();
			$result = $pre->get_result();
		if ($result->num_rows > 0) {
		echo "<table><tr><th>Voornaam</th><th>Achternaam</th><th>Straat</th><th>postcode</th><th>woonplaats</th><th>E-mailadres</th></tr>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["naam"]."</td><td>".$row["achternaam"]."</td> <td>".$row["straatnaam"]."</td><td>".$row["postcode"]."</td><td>".$row["woonplaats"]."</td><td>".$row["email"]."</td> </tr>";
			}
		echo "</table>";
	} else {
		echo "0 results";
	}
	
	$pre -> close();
	
		
		
        	}
  
  }
  
  public function InvoerenLeden($naam, $achternaam, $straat, $postcode, $woonplaats, $email){
     $stmt = $this->database->prepare("INSERT INTO ledenlijst(naam,achternaam,straatnaam, postcode, woonplaats, email) VALUES (?, ?, ?, ?, ? ,?)");
        $stmt->bind_param('ssssss', $naam, $achternaam, $straat, $postcode, $woonplaats, $email);
		$naam = $_POST['naam'];
        $achternaam = $_POST['achternaam'];
        $straat = $_POST['straat'];
        $postcode = $_POST['postcode'];
        $woonplaats = $_POST['plaats'];
        $email = $_POST['email'];
        $stmt->execute(); 
        $stmt->close();
  }
  
  public function UpdateLeden($vname,$aname,$straat, $postcode, $plaats, $email,$id){
     $stmt = $this->database->prepare("UPDATE ledenlijst SET naam = ?, achternaam = ?, straatnaam = ?, postcode = ?, woonplaats = ?, email = ? WHERE id = ?");
    $stmt->bind_param('ssssssi',$vname,$aname,$straat, $postcode, $plaats, $email,$id);
    $id = $_POST['id'];
    $vname = $_POST['naam'];
    $aname = $_POST['achternaam'];
    $straat = $_POST['straatnaam'];
    $postcode = $_POST['postcode'];
    $plaats = $_POST['woonplaats'];
    $email = $_POST['email'];
    $stmt->execute(); 
    $stmt->close();
  }
  
  public function Delete($id){
    $stmt = $this->database->prepare("DELETE FROM ledenlijst WHERE id = ?");
    $stmt->bind_param('i', $id);
    $id = $_GET['delete_id'];
    $stmt->execute(); 
    $stmt->close();
  }
  
  public function Uitloggen(){
    session_destroy ();
    return header("Location: index.php");exit();
  }


}

?>