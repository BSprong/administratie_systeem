<?php

		class Database extends mysqli {
    private $servername = "localhost";
    private $username   = "root";
    private $password   = "";
    private $dbname     = "administratie";
    
    public function __construct(){
        parent::__construct(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );
    }
    
} 

?>
