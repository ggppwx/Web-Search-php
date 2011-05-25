<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=MacRoman">
<style type="text/css">
body
{
background-color:#b0c4de;
}

</style>
<title>result page </title>
    <?php
    	include 'logic.php';
    	include 'validate.php';
		$select_radio = $_POST['smethod'];
		//print $select_radio;
		$input_text = $_POST['input'];
		$v = new validate();
		$input_text = $v->validate_intput($input_text);
		$input_text = $input_text;
//		print ">-----".$input_text."-------<<<";
		//process the input 
		print nl2br("process the input...\n");
		$engine_class = new Engine();
		$input_list = $engine_class -> process_string($input_text);
		
		$engine_class -> search_by_recipe($input_text);
		
		$dish_info_list = $engine_class -> dish_info_list();
//		print nl2br("-----break-------\n");
//		print nl2br("----dish info----\n");
//		foreach ($dish_info_list as $dish_info){
//			print_r($dish_info);
//			print nl2br("\n");
//		}
		
//		print nl2br("\n");
//		print nl2br("same recipe dish-----\n");
		$dish_info_list_si = $engine_class -> dish_info_list_si();
//		foreach ($dish_info_list_si as $dish_info){
//			print_r($dish_info);
//			print nl2br("\n");
//		}
		
//		print nl2br("\n");
//		print nl2br("relative dish-----\n");
		$dish_info_list_rl = $engine_class -> dish_info_list_rl();
//		foreach ($dish_info_list_rl as $dish_info){
//			print_r($dish_info);
//			print nl2br("\n");
//		}
		
//		print nl2br("\n");
//		print nl2br("similar recipe dish-----\n");
		$dish_info_list_sd = $engine_class -> dish_info_list_sd();
//		foreach ($dish_info_list_sd as $dish_info){
//			print_r($dish_info);
//			print nl2br("\n");
//		}
		
		function show_result($dish_info_list, $class_tag){
			$index = 1;
			foreach ($dish_info_list as $dish_info){ 
				if ($index > 50){
					break;
				}
				if(!$dish_info[1]){
					continue;
				}
				echo "<li class='result' id='". $index ."'>";
				echo "<div>";
				echo "<span>";
				echo "<h4>";
				echo "<a href='http://{$dish_info[2]}'>{$dish_info[3]}</a>";  //dish_title
				echo "</h4>";
				echo "</span>";
				echo "<div>";
		
				echo "<p><b>dish name:</b> " . $dish_info[1] . "</p>"; //dish name
				echo "<p><b>snatch: </b>" . $dish_info[4] . "</p>";  //snatch
				echo "<p><font color='red'>url: " . $dish_info[2] . "</font></p>";
		
				echo "</div>";
				echo "</div>";
				echo "<br>";
				echo "</li>";
				$index++;
			}
		}
		
		
	?>

</head>

<body>
<?php 
//	echo "<h3>";
//	echo "the dish recipe";
//	echo "</h3>";
	$dish_info_list = $engine_class -> dish_info_list(); // get the dish informarion
	if($dish_info_list != null){
		echo "<h3>";
		echo "the dish recipe";
		echo "</h3>";
		show_result($dish_info_list, "result");
		
		echo "<h3>";
		echo "dish with the same ingredients";
		echo "</h3>";
		$dish_info_list_si = $engine_class -> dish_info_list_si();
		show_result($dish_info_list_si, "result");
		
		echo "<h3>";
		echo "relavant links";
		echo "</h3>";
		$dish_info_list_rl = $engine_class -> dish_info_list_rl();
		show_result($dish_info_list_rl, "result");
		
		echo "<h3>";
		echo "similar dishes";
		echo "</h3>";
		$dish_info_list_sd = $engine_class -> dish_info_list_sd();
		show_result($dish_info_list_sd, "result");
		
	}else {
		echo "<h3>";
		echo "<p>unfortunately we can find the dish</p>";
		echo "<p>however, we give some recommended dish you may want</p>";
		echo "</h3>";
		
		$engine_class->search_by_ingredient($input_list);
		$dish_info_list_re = $engine_class->dish_info_list();
		if ($dish_info_list_re != null){
			echo "<h3>";
			echo "the ricipes: ";
			echo "</h3>";
			show_result($dish_info_list_re, "result");
		}else {
			echo "<h3>";
			echo "can't find recipes";
			echo "</h3>";
		}
		
		
	}
//	show_result($dish_info_list, "result1");

	

?>






<a href="/WebSearchEngine/Index.php">return main page</a>
</body>
</html>