<?php
//this is service logic layer
include 'po.php';


class Engine{
	//property
	private $db;
	private $dish_info_list;
	private $dish_info_list_si; //same ingredients
	private $dish_info_list_rl; //relative links
	private $dish_info_list_sd; //similar dish
	
	//constructor  
	function __construct(){
		$this->db = new DBManager();
		$this->db->setupDB();
		$this->dish_info_list = array();
		$this->dish_info_list_si = array();
		$this->dish_info_list_rl = array();
		$this->dish_info_list_sd = array();
//		print "ok_constructor ";
	}
	
	//convert a string of ids to a array of int
	private function process_ids($ids){
		$out_int_array = array();
		$string_list = explode("|", $ids);
		foreach ($string_list as $value){
			if($value){
				$out_int_array[] = intval($value);	
			}
		}
//		print_r($out_int_array);
		return $out_int_array;
	} 
	
	
	//search by recipe name 
	//input: a string of input text ; 
	//output:  a list of recipe information
	function search_by_recipe($input_text){
		//$dish_info_list = array();
		
		//parse the recipe name 
		$string_array = $this->process_string($input_text);
		
		//get the dish 
		$recipe_name = $input_text . " recipe"; #test
		$dish_list = $this->db->find_by_recipe_name($recipe_name);
		foreach ($dish_list as $dish){
			$dish_id_o = $dish[0];
			$dish_name = $dish[1];
			$url_id = $dish[3];
			//get from url table
			$url = $this->db->find_by_urlid_in_urlinfo($url_id);  
			$dish_url = $url[1];  //get the dish url
			$dish_title = $url[2];
			$dish_snatch = $url[3];
			$dish_info = array($dish_id_o, $dish_name,$dish_url,$dish_title,$dish_snatch);
//			print_r($dish_info);
			$this->dish_info_list[] = $dish_info;
			
			//get from pseudo_dish_table
			$pseudo_dish_id = $dish[4];
			$pseudo_dish =  $this->db->find_by_pseudoid_in_pseudodish($pseudo_dish_id);
			
			//get dish with the same recipe
			//$dish_ids = $pseudo_dish[2];
			$dish_ids = $this->process_ids($pseudo_dish[2]);
			foreach ($dish_ids as $dish_id){
				$dish_in_pseudo = $this->db->find_by_dishid_in_dishinfo($dish_id);
				$dish_name_s = $dish_in_pseudo[1];
				$url_id_s = $dish_in_pseudo[3];
				//get from url table
				$url_s = $this->db->find_by_urlid_in_urlinfo($url_id_s);  
				$dish_url_s = $url_s[1];  //get the dish url
				$dish_title_s = $url_s[2];
				$dish_snatch_s = $url_s[3];
				$dish_info_s = array($dish_id, $dish_name_s,$dish_url_s,$dish_title_s,$dish_snatch_s);
				$this->dish_info_list_si[] = $dish_info_s;
			}
			
//			print "@@@@@@@@@@@@@@@@@@@@@@@";
			//get the relative dish
			//$dish_link_ids = $pseudo_dish[3];
			$dish_link_ids = $this->process_ids($pseudo_dish[3]);
			foreach ($dish_link_ids as $p_dish_id){
				$p_dish = $this->db->find_by_pseudoid_in_pseudodish($p_dish_id);  //find other pseudo dish
				$dish_ids_new = $this->process_ids($p_dish[2]);
				foreach ($dish_ids_new as $dish_id){
					$dish_in_pseudo = $this->db->find_by_dishid_in_dishinfo($dish_id);
					$dish_name_s = $dish_in_pseudo[1];
					$url_id_s = $dish_in_pseudo[3];
					//get from url table
					$url_s = $this->db->find_by_urlid_in_urlinfo($url_id_s);  
					$dish_url_s = $url_s[1];  //get the dish url
					$dish_title_s = $url_s[2];
					$dish_snatch_s = $url_s[3];
					$dish_info_s = array($dish_id, $dish_name_s,$dish_url_s,$dish_title_s,$dish_snatch_s);
					$this->dish_info_list_rl[] = $dish_info_s;
				}
			}

			
//			print "@@@@@@@@@@@@@@@@@@@@@@@@";
			//get the similar dish
			//$dish_similar_ids = $pseudo_dish[4];
			$dish_similar_ids = $this->process_ids($pseudo_dish[4]);
			foreach ($dish_similar_ids as $dish_id){
				$dish_in_pseudo = $this->db->find_by_dishid_in_dishinfo($dish_id);
				$dish_name_s = $dish_in_pseudo[1];
				$url_id_s = $dish_in_pseudo[3];
				//get from url table
				$url_s = $this->db->find_by_urlid_in_urlinfo($url_id_s);  
				$dish_url_s = $url_s[1];  //get the dish url
				$dish_title_s = $url_s[2];
				$dish_snatch_s = $url_s[3];
				$dish_info_s = array($dish_id, $dish_name_s,$dish_url_s,$dish_title_s,$dish_snatch_s);
				$this->dish_info_list_sd[] = $dish_info_s;
			}
			
			
			
		}
		
		
		
		//output is a list 
		//[dish_name, title, url, snatch]
		
		
		
		//get the similar dish
		
	}
	
	
	//search by ingredient name
	//input:  a string of input text 
	//output:  a list of recipe information 
	function search_by_ingredient($input_list){
		$array_inter = array();
		$index = 0;
		$dish_map = array();  //key: dish number, value: priority
		foreach ($input_list as $materal_name){
			$dish_ids = $this->get_recipes_by_material($materal_name);   //get the dish ids by the same ingredient
			foreach ($dish_ids as $dish_id){
				if (!$dish_map[$dish_id]){
					$dish_map[$dish_id] = 1;
				}else {
					$dish_map[$dish_id] =$dish_map[$dish_id] + 1;
				}
			}
			/*
			if($index == 0){
				$array_inter[0] = $dish_ids;
			}else {
				$array_inter_temp = array_intersect($dish_ids, $array_inter[$index-1]);
				if (!$array_inter_temp){
					break;
				}else {
					$array_inter[$index] = $array_inter_temp;
				}
			}
			$index += 1;
			*/
		}
//		echo "original dish_map is: ";
//		print_r($dish_map);
//		echo "<br>";
		arsort($dish_map);   //high to low
//		echo "dish_map is: ";
//		print_r($dish_map);
//		echo "<br>";
		$dish_in_rank = array_keys($dish_map);
//		print_r($dish_in_rank);
//		echo "<br>";
		
		foreach ($dish_in_rank as $dish_id){
				$dish_in_pseudo = $this->db->find_by_dishid_in_dishinfo($dish_id);
				$dish_name_ = $dish_in_pseudo[1];
				$url_id_ = $dish_in_pseudo[3];
				//get from url table
				$url_ = $this->db->find_by_urlid_in_urlinfo($url_id_);  
				$dish_url_ = $url_[1];  //get the dish url
				$dish_title_ = $url_[2];
				$dish_snatch_ = $url_[3];
				$dish_info_ = array($dish_id, $dish_name_,$dish_url_,$dish_title_,$dish_snatch_);
				$this->dish_info_list[] = $dish_info_;
		}
		/*
		$remember_dish_ids = array();
		for($i = count($array_inter); $i >=0; $i--){
			//intersection of dish_ids
			$dish_ids = $array_inter[$i];
			foreach ($dish_ids as $dish_id){
				//if the dish_id has appeared
				if (in_array($dish_id, $remember_dish_ids)){
					continue;
				}else {
					$remember_dish_ids[] = $dish_id;
				}
				$dish_in_pseudo = $this->db->find_by_dishid_in_dishinfo($dish_id);
				$dish_name_ = $dish_in_pseudo[1];
				$url_id_ = $dish_in_pseudo[3];
				//get from url table
				$url_ = $this->db->find_by_urlid_in_urlinfo($url_id_);  
				$dish_url_ = $url_[1];  //get the dish url
				$dish_title_ = $url_[2];
				$dish_snatch_ = $url_[3];
				$dish_info_ = array($dish_id, $dish_name_,$dish_url_,$dish_title_,$dish_snatch_);
				$this->dish_info_list[] = $dish_info_;
			}
			
		}
		//$this->dish_info_list = array_unique($this->dish_info_list);
		*/
	}
	
	
	//search all recipes by one material
	//input  material name 
	//return all unique dish_ids 
	function get_recipes_by_material($material_name){
		$dish_ids_output = array();
		$material_alias = $this->db->find_by_mname_in_ma($material_name);  
		$material_id = $material_alias[2];  //get the material id

		$material_info = $this->db->find_by_mid_in_mi($material_id);
		$belong_to_recipe_list = $this->process_ids($material_info[2]);  //recipe_list
		foreach ($belong_to_recipe_list as $dish_recipe_id){
			$dish_info_array = $this->db->find_by_dri_in_di($dish_recipe_id);
			foreach ($dish_info_array as $dish_info){
				$dish_id = $dish_info[0];
				$dish_ids_output[] = $dish_id;
			}
		}
		$dish_ids_output = array_unique($dish_ids_output);
		
		return $dish_ids_output;
	}
	
	
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
		return $out_string_array;
	}
	
	
	//getter
	//dish info:  dish_id, dish_name, dish_url, dish_title, dish_snatch
	function dish_info_list(){
		return $this->dish_info_list;
	}
	
	function dish_info_list_si(){
		return $this->dish_info_list_si;
	}
	
	function dish_info_list_rl(){
		return $this->dish_info_list_rl;
	}
	
	function dish_info_list_sd(){
		return $this->dish_info_list_sd;
	}
	
}
