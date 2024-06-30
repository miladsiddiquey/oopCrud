
<?php

class Database{
	private $db_host = "localhost";
	private $db_user = "root";
	private $db_pass = "";
	private $db_name = "myoop";

	private $mysqli = "";
	private $result = array();
	private $conn = false;

public function __construct(){
	if(!$this->conn){
	$this->mysqli = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
	$this->conn = true;
	if($this->mysqli->connect_error){
	array_push($this->result, $this->mysqli->connect_error);
	return false;
}

}else{
	return true;
}
}
//Function to insert into the database
public function insert($table, $params=array()){
	if($this->tableExists($table)){
		$table_columns = implode(', ', array_keys($params));
		$table_value = implode("', '", $params);

		$sql = "INSERT INTO $table ($table_columns) VALUES ('$table_value')";
		if($this->mysqli->query($sql)){
			array_push($this->result, $this->mysqli->insert_id);
			return true;
		}else{
			array_push($this->result, $this->mysqli->error);
			return false;
		}

	}else{
		return false;
	}

}

//Function to update row in database
public function update(){

}

//Function to delete table or row from database
public function delete(){

}

//Function to select from the database
public function select(){

}

private function tableExists($table){
	$sql = "SHOW TABLES FROM $this->db_name LIKE '$table' ";
	$tableInDb = $this->mysqli->query($sql);
	if($tableInDb){
		if($tableInDb->num_rows == 1){
			return true;
		}else{
			array_push($this->result, $table." does not exist in this database");
			return false;
		}
	}
}

public function getResult(){
	$val = $this->result;
	$this->result = array();
	return $val;
}

//Close Function
public function __destruct(){
 if($this->conn){
	if($this->mysqli->close()){
	$this->conn = false;
	return true;
}

}else{
 return false;
}

}

}
?>