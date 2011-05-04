<?php
//this is service logic layer
//include 'po.php';


class Engine{
	//property
	private $db;
	
	//constructor  
	function __construct(){
		$this->db = new DBManager();
		$this->db->setupDB();
		print "ok_constructor ";
	}
	
	//search by recipe name 
	//input: a string of input text ; 
	//output:  a list of recipe information
	function search_by_recipe($input_text){
		//parse the recipe name 
		$string_array = $this->process_string($input_text);
		
		//get the dish 
		$this->db->find_by_recipe_name($recipe_name);
		
		//get the similar dish
		
	}
	
	
	//search by ingredient name
	//input:  a string of input text 
	//output:  a list of recipe information 
	function search_by_ingredient($input_text){
		$string_array = $this->process_string($input_text);
		
	}
	
	
	//get recommendations 
	//input:
	//output:
	
	
	//process the input, make it appropriate for query  
	//input: string of input text 
	//output: a list of string 
	function process_string($input_string){
		$out_string_array = array();
		$string_list = explode(" ", $input_string);
		foreach ($string_list as $value){
			if ($value !== ""){
				$out_string_array[] = $value;
			}
		}
		print "ok";
		print_r($out_string_array);
		return $out_string_array;
	}
	
	
}
