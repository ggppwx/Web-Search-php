<?php
class DBManager{
	private $DBConnection = null;
	
	
	function __construct(){
	
	}
	
	//establish the connection to a given database 
	function setupDB(){
		if(is_null($this->DBConnection)){
			$db_server = "localhost";
			$db_port = "5432";
			$db_name = "wse-db";
			$db_user = "postgres";
			$db_password = "123456";
			$connection = pg_connect("host=$db_server port=$db_port dbname=$db_name user=$db_user password=$db_password");
			if (!$connection){
				die("could not connect" . pg_errormessage($connection));
			}
			echo nl2br("Connected successfully\n");
			
//			$db_selected = pg_($db_name,$connection);
//			if (!$db_selected){
//				die("Can't use \"$db_name\" : " . mysql_error());
//			}
			echo nl2br("Selected successfully\n");
			
			$this->DBConnection = $connection;
		}
	}
	
	
	
	//search by recipe name 
	//input a recipe name 
	//output:  array(row) of arrays(col),  the result of recipes
	//if no match return null 
	function find_by_recipe_name($recipe_name){
		if (!$recipe_name){
			return null;
		}
//		print "into find_by_recipe_name-----";  //test ok
		$output = array();
		$query = "SELECT * FROM dish_info WHERE dish_name='$recipe_name'";
		$result = pg_query($this->DBConnection,$query);
		if (!$result){
			echo "An error occured in find_by_recipe_name.\n";
  			exit;
		}
		while ($row = pg_fetch_array($result)){
			/*
			print nl2br("\n");
			print "find_by_recipe_name--";
			print $row[0]; //dish_id
			print $row[1]; //dish_name
			print $row[2]; //dish_recipe_id
			print $row[3]; //url_id
			print $row[4]; //pseudo_dish_id
			print nl2br("\n");
			*/
			$output[] = $row;
		}
		//return array of arrays
		return $output;
	}
	
	//find by url id
	//input a url id
	//output a queried row, return null if no match
	function find_by_urlid_in_urlinfo($url_id){
		if (!$url_id){
			return null;
		}
		$query = "SELECT * FROM url_info WHERE url_id='$url_id'";
		$result = pg_query($this->DBConnection,$query);
		if (!$result){
			echo "An error occured in find_by_urlid_in_urlinfo.\n";
  			exit;
		}
		$row = pg_fetch_array($result);
		/*
/		print nl2br("\n");
/		print "find_by_urlid_in_urlinfo--------";
/		print $row[0]; 
/		print $row[1]; 
/		print $row[2]; 
/		print $row[3]; 
/		print nl2br("\n");
 		*/
		return $row;
	}
	
	//find by pseudo_dish_id
	//input pseudo_dish_id
	//output a queried row in the table 
	function find_by_pseudoid_in_pseudodish($pseudo_dish_id){
		if (!$pseudo_dish_id){
			return null;
		}
		$query = "SELECT * FROM pseudo_dish WHERE pseudo_dish_id='$pseudo_dish_id'";
		$result = pg_query($this->DBConnection,$query);
		if (!$result){
			echo "An error occured in find_by_pseudoid_in_pseudodish.\n";
  			exit;
		}
		$row = pg_fetch_array($result);
		if ($row){
			/*
			print nl2br("\n");
			print "find_by_pseudoid_in_pseudodish--";
			print $row[0]; //pseudo_dish_id
			print $row[1]; //standard_material_list
			print $row[2]; //dish_ids
			print $row[3]; //link_relative_pd_ids
			print $row[4]; //similar_dish_ids
			print nl2br("\n");
			*/
			
		}
		return $row;
	}
	
	//find by dish_id
	//input a dish_id
	//output a queried row 
	function find_by_dishid_in_dishinfo($dish_id){
		if (!$dish_id){
			return null;
		}
		$query = "SELECT * FROM dish_info WHERE dish_id='$dish_id'";
		$result = pg_query($this->DBConnection,$query);
		if (!$result){
			echo "An error occured find_by_dishid_in_dishinfo.\n";
  			exit;
		}
		$row = pg_fetch_array($result);
		if ($row){
			/*
			print nl2br("\n");
			print "find_by_dishid_in_dishinfo--";
			print $row[0]; //dish_id
			print $row[1]; //dish_name
			print $row[2]; //dish_recipe_id
			print $row[3]; //url_id
			print $row[4]; //pseudo_dish_id
			print nl2br("\n");
			*/
		}
		return $row;
	}
	
	
	
	//search by ingredient name in material alias 
	//input a ingredient name 
	//output: a row has the material name
	function find_by_mname_in_ma($ingredient_name){
		if (!$ingredient_name){
			return null;
		}
		$query = "SELECT * FROM material_alias WHERE material_name='$ingredient_name'";
		$result = pg_query($this->DBConnection,$query);
		if (!$result){
			echo "An error occured in find_by_mname_in_ma.\n";
  			exit;
		}
		$row = pg_fetch_array($result);
		if ($row){
			/*
			print nl2br("\n");
			print "find_by_mname_in_ma--";
			print $row[0]; //material_name_id
			print $row[1]; //material_name
			print $row[2]; //material_id
			print nl2br("\n");
			*/
		}
		return $row;
	}
	
	//find by material id in material info
	//input a material_id
	//output a queried row 
	function find_by_mid_in_mi($material_id){
		if (!$material_id){
			return null;
		}
		$query = "SELECT * FROM material_info WHERE material_id='$material_id'";
		$result = pg_query($this->DBConnection,$query);
		if (!$result){
			echo "An error occured in find_by_mid_in_mi.\n";
  			exit;
		}
		$row = pg_fetch_array($result);
		if ($row){
			/*
			print nl2br("\n");
			print "find_by_mid_in_mi--";
			print $row[0]; //material_id
			print $row[1]; //material_common_name
			print $row[2]; //belong_to_recipe_list
			print nl2br("\n");
			*/
		}
		return $row;
	}
	
	//find by dish_recipe_id in dish_info
	//input a dish_recipe_id
	//return a set of rows
	function find_by_dri_in_di($dish_recipe_id){
		if (!$dish_recipe_id){
			return null;
		}
		$output = array();
		$query = "SELECT * FROM dish_info WHERE dish_recipe_id='$dish_recipe_id'";
		$result = pg_query($this->DBConnection,$query);
		if (!$result){
			echo "An error occured in find_by_dri_in_di.\n";
  			exit;
		}
		while ($row = pg_fetch_array($result)){
			/*
			print nl2br("\n");
			print "find_by_recipe_name--";
			print $row[0]; //dish_id
			print $row[1]; //dish_name
			print $row[2]; //dish_recipe_id
			print $row[3]; //url_id
			print $row[4]; //pseudo_dish_id
			print nl2br("\n");
			*/
			$output[] = $row;
		}
		//return array of arrays
		return $output;
	}

}