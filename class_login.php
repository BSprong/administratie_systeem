<?php
class Login{

 private $database;
  
  public function __construct($database)
  {
	$this->database = $database;
  }
  
  
  
  public function Inloggen($username, $password){
	  session_start();
    $stmt = $this->database->prepare("SELECT * FROM admin WHERE naam = ? && wachtwoord = ? LIMIT 1");
      $stmt->bind_param('ss', $username, $password);
      $stmt->execute();
      $stmt->bind_result($username, $password);
      $stmt->store_result();
      if($stmt->num_rows > 0) {
        while($stmt->fetch()) {
          $_SESSION['username'] = $username;
          header("Location: dashboard.php");
        }
      } 

      else{
        $stmt = $this->database->prepare("SELECT * FROM ledenlijst WHERE naam = ? && wachtwoord = ? LIMIT 1");
      $stmt->bind_param('ss', $username, $password);
      $stmt->execute();
      $stmt->bind_result($username, $password);
      $stmt->store_result();
      if($stmt->num_rows > 0) {
        while($stmt->fetch()) {
          $_SESSION['username'] = $username;
          header("Location: user.php");
        }
      } 
      else {
            echo "U heeft een verkeerd gebruikersnaam of wachtwoord ingevoerd";
            die();
          return false;
      }
      
      }
      
      $stmt->close();
      $stmt->free_result();
      
  }









}

?>