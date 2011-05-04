<?php
class DBManager{
	private $DBConnection = null;
	
	
	function __construct(){
	
	}
	
	function setupDB(){
		if(is_null($this->DBConnection)){
			$connectionString = "";
			$connection = mysql_connect($connection_string);
			$this->DBConnection = $connection;
		}
	}
	
	//search by recipe name 
	//input 
	//output:  array(row) of arrays(col),  the result of recipes 
	function find_by_recipe_name($recipe_name){
		$query = "SELECT * WHERE ";
		$result = mysql_query($query,$this->DBConnection);
		while ($row = mysql_fetch_assoc($result)){
			// 
			echo $row[];
		}
		//return array of arrays
	}
	
	//search by ingredient name 
	function find_by_ingredient_name($ingredient_name){
		$query = "SELECT";
		$result = mysql_query($query,$this->DBConnection);
			while ($row = mysql_fetch_assoc($result)){
			// 
			echo $row[];
		}
		//return array of arrays 
	}


}