<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

class ExportToExcel{
    
    private $database;
    private $filename = 'Ledenlijst.xls';
    
     public function __construct($database)
  {
	$this->database = $database;
  }

    public function queryToExcel() {
    $output = null;
        	$sql = "SELECT * FROM ledenlijst ORDER BY achternaam";
	$result = $this->database->query($sql);
	
	if ($result->num_rows > 0) {
		$output .= '
			<table class="table" bordered="1">
				<tr>
					
					<th>Klant voornaam</th>
					<th>Klant achternaam</th>	
				</tr>
		
			
		';
		
		while($row = mysqli_fetch_array($result))
		{
			$output .= '
			 <tr>
			 	
			 	<td>'.$row["naam"].'</td>
			 	<td>'.$row["achternaam"].'</td>
			 </tr>
			 ';
		}
		
		$output .= '</table';
		header ("Content-Type: application/xls");
		header ("Content-Disposition:attachment; filename= $this->filename");
		echo $output;
		exit();
	}
    
    }
    
    }
    

?>