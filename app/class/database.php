<?php

class db {

	function connect($config_db=""){
		if(!empty($config_db)){
				global $config_db;
				$connection	= mysqli_connect($config_db['host'], $config_db['user'], $config_db['pass']);
		} else {
				global $config;
				$connection	= mysqli_connect($config['host'], $config['user'], $config['pass']);
		}

		if (! $connection) {
			echo "Connection Error !"; mysqli_error();
		}
		$connection->select_db($config['dbs']) or die ("Database not Found".mysqli_error());
		return $connection;
	}

	function globals(){
		$this->execute(" SET GLOBAL sql_mode=''; ");
	}

	function sql($field, $table, $where) {
		$sql = "SELECT $field FROM $table $where";
		return $sql;
	}

	function query($field, $table, $where) {
		$connection = $this->connect();
		$sql = "SELECT $field FROM $table $where";
		$return = mysqli_query($connection, $sql);
		return $return;
	}

	function execute($sql) { // execute
		$connection = $this->connect();
		$data = mysqli_query($connection, $sql);
		return $data;
	}

	function insert($table, $field, $value) { // insert
		if ($field == "") {
			$sql="INSERT INTO $table SET $value";
		}else{
			$sql="INSERT INTO $table($field) VALUES($value)";
		}
		$this->execute($sql);
	}

	function update($table, $fieldAndValue, $where) { // update
		$connection = $this->connect();
		$sql = mysqli_query($connection, "UPDATE $table SET $fieldAndValue $where");
		$this->execute($sql);
	}

	function delete($table, $primary, $value, $child, $parent_row) { // delete
		$this->execute("DELETE FROM {$table} WHERE {$primary}='".$value."'");

		if(is_array($child)){
			foreach ($variable as $key => $value) {
				$this->execute("DELETE FROM {$value} WHERE {$parent_row[$key]}='".$value."'");
			}
		} else {
			$this->execute("DELETE FROM {$child} WHERE {parent_row}='".$value."'");
		}
	}

	function count($field, $table, $where) { // count row
		$query = $this->query($field, $table, $where);
		$data = mysqli_num_rows($query);
		return $data;
	}

	function all($field, $table, $where) { // show array
		$array = array();
		if ($this->row($field, $table, $where)<1) {
			return $array;
		}else{
			$query=$this->query($field, $table, $where);
			while ($array = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
				$data[] = $array;
			}
		return $data;
		}
	}

	function get($field, $table, $where) { // value
		$query = $this->query($field, $table, $where);
		$value = mysqli_fetch_array($query);
		if($field=="*"){
			$data = $value;
		} elseif(preg_match("/,/", $field)){
			$data = $value;
		} else {
			$data = $value[$field];
		}
		return $data;
	}

	function xxs($string) { // anti xxs
		$value = stripslashes(strip_tags(htmlspecialchars($string, ENT_QUOTES)));
		return $value;
	}

	function injection($string) { // injection
		$connection = $this->connect();
		$value = mysqli_real_escape_string($connection, $string);
		return $value;
	}

	function last($table, $value="id") {
		if($value!="" || $value!="id"){
			$this->value($table, $value, "DESC LLIMIT 0,1");
		} else {
			$sql = mysqli_query("SHOW TABLE STATUS WHERE `Name`='$table'");
			$data = mysqli_fetch_assoc($sql);
			return $data['Auto_increment'];
		}
	}

	function tableExists($table){
		$cekTable = $this->execute("SHOW TABLES LIKE '".$table."'");
		if($cekTable){
			return true;
		} else {
			return false;
		}
	}
}

$db = new db();
$db->connect();
$db->globals(); //darurat jika servernya sqlnya gak global

foreach ($_GET as $key => $value) {
	$_GET[$key] = $db->xxs($db->injection($value));
}

foreach ($_POST as $key => $value) {
	$_POST[$key] = $value;
}
?>
