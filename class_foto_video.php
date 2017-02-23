<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

class FotoVideo{

    private $database;
    
    //upload photo
    private $src = "images/";
    private $tmp;
    private $filename;
    private $type;
    private $uploadfile;
    
    //upload video
    private $path = "video/";
    private $tmpVideo;
    private $filenameVideo;
    private $typeVideo;
    private $uploadfileVideo;
    
  
  public function __construct($database)
  {
	$this->database = $database;
  }
  
  public function SelecteerFoto(){
    $sql = "SELECT * FROM foto";
		if($pre = $this->database->prepare($sql)){
			//$pre->bind_param('i');
			$pre->execute();
			$result = $pre->get_result();
		if ($result->num_rows > 0) {
		echo "<table border='1'><tr><th>naam</th><th>Afbeelding</th><th>beschrijving</th></tr>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
		 $naam = $row['naam'];
		 $image = $row['image'];
		 $beschrijving = $row['beschrijving'];
		 echo '<tr>';
         echo "<td> $naam </td> <td><img src='$image' width='200' title='' alt='auto' /></td> <td>$beschrijving</td>";
         echo '</tr>';
			}
		echo "</table>";
	} else {
		echo "0 results";
	}
	
	$pre -> close();
	
		
		
        	}
  
  }
  
  
  public function SelecteerVideo(){
    $sql = "SELECT * FROM video";
		if($pre = $this->database->prepare($sql)){
			//$pre->bind_param('i');
			$pre->execute();
			$result = $pre->get_result();
		if ($result->num_rows > 0) {
		echo "<table border='1'><tr><th>naam</th><th>Afbeelding</th><th>Straat</th><th>beschrijving</th></tr>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
		$naam = $row['naam'];
		 $video = $row['video'];
		 $beschrijving = $row['beschrijving'];
		  echo "<tr><td> $naam </td> <td><video width='320' height='240' controls><source src='$video' type='video/mp4'></video></td> <td>$beschrijving</td></tr>";
			}
		echo "</table>";
	} else {
		echo "0 results";
	}
	
	$pre -> close();
	
		
		
        	}
  
  }
  
  
   public function UploadFoto(){
        $this -> filename = $_FILES["file"]["name"];
        $this -> tmp = $_FILES["file"]["tmp_name"];
        $this -> uploadfile = $this -> src . basename($this -> filename);
        
       
    }
    public function uploadfile(){
        if(move_uploaded_file($this -> tmp, $this -> uploadfile)){
            return true;
        }
    }

    
    public function VoegFotoInDatabase($naam,$beschrijving){
        $filepath = $this->src . $this->filename= $_FILES["file"]["name"];
        $stmt = $this->database->prepare("INSERT INTO foto(naam,image,beschrijving) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $naam,$filepath ,$beschrijving );
		$naam = $_POST['name'];
        $beschrijving = $_POST['description'];
        $stmt->execute(); 
        $stmt->close();
    }
    
    public function UploadVideo(){
        $this -> filenameVideo = $_FILES["file"]["name"];
        $this -> tmpVideo = $_FILES["file"]["tmp_name"];
        $this -> uploadfileVideo = $this -> path . basename($this -> filenameVideo);
    }
    
    public function uploadfileVideo(){
        if(move_uploaded_file($this -> tmpVideo, $this -> uploadfileVideo)){
            return true;
        }
    }
    
    public function VoegVideoInDatabase($naam,$beschrijving){
        $filepath = $this->path . $this->filenameVideo= $_FILES["file"]["name"];
        $stmt = $this->database->prepare("INSERT INTO video(naam,video,beschrijving) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $naam,$filepath ,$beschrijving );
		$naam = $_POST['name'];
        $beschrijving = $_POST['description'];
        $stmt->execute(); 
        $stmt->close();
    }
    
      public function DeleteFoto($id){
      $id = $_GET['delete_id'];
    $name = "SELECT * FROM foto WHERE id=$id";
    $result = $this->database->query($name);
    $row = $result->fetch_assoc();
    $name1 = $row['image'];
    //print_r($name1);
    if ($stmt = $this->database->prepare("DELETE FROM foto WHERE id = ? LIMIT 1"))
    {
        
		//echo "Bestand is verwijderd";
        $stmt->bind_param("i", $id);
        $folder = 'php\oop\administratie_systeem\images';
        chown($folder,777);

        //var_dump($name1);
        unlink($_SERVER['DOCUMENT_ROOT'] . "/php/oop/administratie_systeem/$name1");

        $stmt->execute();
        $stmt->close();
    }
	else
	{
		echo 'Specified file not found:'.$name1;
		echo "Error deleting record: " ;
	}
      
  }

  public function DeleteVideo($id){
      $id = $_GET['delete_id'];
    $name = "SELECT * FROM video WHERE id=$id";
    $result = $this->database->query($name);
    $row = $result->fetch_assoc();
    $name1 = $row['video'];
    //print_r($name1);
    if ($stmt = $this->database->prepare("DELETE FROM video WHERE id = ? LIMIT 1"))
    {
        
		//echo "Bestand is verwijderd";
        $stmt->bind_param("i", $id);
        $folder = 'php\oop\administratie_systeem\video';
        chown($folder,777);

        //var_dump($name1);
        unlink($_SERVER['DOCUMENT_ROOT'] . "/php/oop/administratie_systeem/$name1");

        $stmt->execute();
        $stmt->close();
    }
	else
	{
		echo 'Specified file not found:'.$name1;
		echo "Error deleting record: " ;
	}
      
  }


}

?>