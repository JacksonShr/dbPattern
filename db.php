<?php

class dbConnection {
	
	var $pdo;
	
    
    
    function __construct(){
        
        
        require "options/options.php";
        
        $this->db = $db;
        $this->user = $user;
        $this->host = $host;
        $this->pass = $pass;
        $this->charset = $charset;
        
		$this->dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		$this->opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
        
        $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
        
        }
    
   
	
	function query ($table, $columns, $condition, $firstRow, $numberOfRows) {
		
		//
		
		if( $firstRow == 0 ) {
		    $q = "SELECT ".$columns." FROM ".$table." WHERE ".$condition . ";";
		} else {
		    $q = "SELECT ".$columns." FROM ".$table." WHERE ".$condition." LIMIT ".$firstRow.", ".$numberOfRows.";";
		}
		
		//
		$data_arr = $this->pdo->query($q);
		return $data_arr;
		}
	
	
	function uQuery ( $q ) {
		
		$data_arr = $this->pdo->query($q)->fetchAll();
		return $data_arr;
		}
	
	function insert ($data_array ) {
				
		$length = count($data_array);
		$field_string = "(";
		$data_string = "(";
		
		
		foreach ($data_array as $key => $value ) {
			
			$key = strip_tags($key);
			//$key = $pdo->real_escape_string($key);
			$value = strip_tags($value);
			
			
			$field_string = $field_string.$key;
			$data_string = $data_string."'".$value."'";
			
			if ($length > 1 ) {
				
				$field_string = $field_string.", ";
				$data_string = $data_string.", ";
				
				}
			
			$length--;
			
			}
			
		$field_string = $field_string  . ")";
		$data_string = $data_string . ")";
		
		$q = "INSERT INTO ".$this->table." ".$field_string." VALUES ".$data_string.";";
		
		//var_dump($q);
		
		$this->pdo->query($q);
		//unset($_POST["insert_array"], $_POST["insert_array_submit"]);
		}
	
	
	
	
	
	function update ($table, $field_str, $condition) {
		
		$q = "UPDATE ".$table." SET ".$field_str." WHERE ".$condition.";";
		
		//var_dump($q);
		
		$this->pdo->query($q);
		
		}
		
		
		
		
		function special_update ($table, $data_array, $condition) {
			
		
		
				
		$field_string = "";
		
		$length = count($data_array);
		
		foreach ($data_array as $key => $value) {
			
			$field_string = $field_string.$key."='".$value . "'";
			
			if( $length > 1 ) $field_string = $field_string.", "; 
			
			$length--;
			
			}
		
		$q = "UPDATE ".$table." SET ".$field_string." WHERE ".$condition.";";
		
		var_dump($q);
		
		//$this->pdo->query($q);
			
		}
	
	
	
	
	
	function delete ($condition) {
		
		$q = "DELETE FROM ".$this->table." WHERE ".$condition.";";
		
			$this->pdo->query($q); 
		
		
		}
	
	
	}


/**/








?>
