<?php
class validate{
	//validate the query text from the user
	//execute serveral validating procedure 
	function validate_intput($input){
		if ($input == null){
			return NULL;
		}
		$out = $this->escape($input);
		$out = $this->con_to_lower($out);
		$out = $this->del_space($out);
//		print "------" . $out ."----------------";
		return $out;
	}
	
	//delete the space on two sides of the input 
	function del_space($input){
		if ($input == NULL){
			return  NULL;
		}
		$beg = 0;
		$end = strlen($input)-1;
		for (;$beg<$end;$beg++){
			if ($input[$beg] != ' '){
				break;
			}
		} //get the begin of the text
		for (;$end>=0;$end--){
			if ($input[$end] != ' '){
				break;
			}
		}
		if ($beg > $end){
			return NULL;
		}else {
		 	return substr($input, $beg, $end - $beg +1);
		}
	}
	
	//convert to lower case 
	function con_to_lower($input){
		if ($input == null){
			return NULL;
		}
		return strtolower($input);
	}
	
	//escape the input text, for security issue 
	function escape($input){
		if ($input == null){
			return NULL;
		}
		$out = htmlspecialchars($input);
		return $out;
	}
}