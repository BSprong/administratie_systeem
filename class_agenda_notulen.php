<?php

class Agenda{

    private $database;
    
     //upload agenda
    private $src = "agenda/";
    private $tmp;
    private $filename;
    private $type;
    private $uploadfile;
    
    //upload notulen
    private $srcNotulen = "notulen/";
    private $tmpNotulen;
    private $filenameNotulen;
    private $typeNotulen;
    private $uploadfileNotulen;
    
     public function __construct($database)
  {
	$this->database = $database;
  }
  
  
    public function SelecteerAgenda(){
    $sql = "SELECT * FROM agenda";
		if($pre = $this->database->prepare($sql)){
			//$pre->bind_param('i');
			$pre->execute();
			$result = $pre->get_result();
		if ($result->num_rows > 0) {
		echo "<table><tr><th>naam</th><th>Agenda</th><th>beschrijving</th></tr>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
		 $naam = $row['naam'];
		 $doc = $row['agenda'];
		 $beschrijving = $row['beschrijving'];
		 echo '<tr>';
         echo "<td> $naam </td> <td><a href='$doc'>Agenda</a></td> <td>$beschrijving</td>";
         echo '</tr>';
			}
		echo "</table>";
	} else {
		echo "0 results";
	}
	
	$pre -> close();
	
		
		
        	}
  
  }
  
  public function UploadAgenda(){
        $this -> filename = $_FILES["file"]["name"];
        $this -> tmp = $_FILES["file"]["tmp_name"];
        $this -> uploadfile = $this -> src . basename($this -> filename);
        
       
    }
    public function uploadfile(){
        if(move_uploaded_file($this -> tmp, $this -> uploadfile)){
            return true;
        }
    }
    
    public function VoegAgendaInDatabase($naam,$beschrijving){
        $filepath = $this->src . $this->filename= $_FILES["file"]["name"];
        $stmt = $this->database->prepare("INSERT INTO agenda(naam,agenda,beschrijving) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $naam,$filepath ,$beschrijving );
		$naam = $_POST['name'];
        $beschrijving = $_POST['description'];
        $stmt->execute(); 
        $stmt->close();
    }
    
    
    public function SelecteerNotulen(){
    $sql = "SELECT * FROM notulen";
		if($pre = $this->database->prepare($sql)){
			//$pre->bind_param('i');
			$pre->execute();
			$result = $pre->get_result();
		if ($result->num_rows > 0) {
		echo "<table><tr><th>naam</th><th>Notulen</th><th>beschrijving</th></tr>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
		 $naam = $row['naam'];
		 $doc = $row['notulen'];
		 $beschrijving = $row['beschrijving'];
		 echo '<tr>';
         echo "<td> $naam </td> <td><a href='$doc'>Notulen</a></td> <td>$beschrijving</td>";
         echo '</tr>';
			}
		echo "</table>";
	} else {
		echo "0 results";
	}
	
	$pre -> close();
	
		
		
        	}
  
  }


   public function UploadNotulen(){
        $this -> filenameNotulen = $_FILES["file"]["name"];
        $this -> tmpNotulen = $_FILES["file"]["tmp_name"];
        $this -> uploadfileNotulen = $this -> srcNotulen . basename($this -> filenameNotulen);
        
       
    }
    public function uploadfileNotulen(){
        if(move_uploaded_file($this -> tmp, $this -> uploadfile)){
            return true;
        }
    }
    
    public function VoegNotulenInDatabase($naam,$beschrijving){
        $filepath = $this->srcNotulen . $this->filenameNotulen= $_FILES["file"]["name"];
        $stmt = $this->database->prepare("INSERT INTO notulen(naam,notulen,beschrijving) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $naam,$filepath ,$beschrijving );
		$naam = $_POST['name'];
        $beschrijving = $_POST['description'];
        $stmt->execute(); 
        $stmt->close();
    }



}

?>