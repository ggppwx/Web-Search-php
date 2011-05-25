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
<title>result page</title>

    <?php
		include 'logic.php';
		include 'validate.php';
		$select_radio = $_POST['smethod'];
		//print $select_radio;
		$v = new validate();
		$input_text[] = $v->validate_intput($_POST['input1']);
		$input_text[] = $v->validate_intput($_POST['input2']);
		$input_text[] = $v->validate_intput($_POST['input3']);
		$input_text[] = $v->validate_intput($_POST['input4']);
//		$input_text[] = $_POST['input1'];
//		$input_text[] = $_POST['input2'];
//		$input_text[] = $_POST['input3'];
//		$input_text[] = $_POST['input4'];
		print nl2br("process the input...\n");
		foreach ($input_text as $text){
			if($text){
				$input_list[] = $text;
			}
		}
		$engine_class = new Engine();
//		$input_list = $engine_class -> process_string($input_text);
		
		$engine_class->search_by_ingredient($input_list);
		$dish_info_list = $engine_class->dish_info_list();
//		print nl2br("-----break-------\n");
//		print nl2br("----dish info----\n");
//		foreach ($dish_info_list as $dish_info){
//			print_r($dish_info);
//			print nl2br("\n");
//		}
		
		function show_result($dish_info_list, $class_tag){
			$index = 1;
			foreach ($dish_info_list as $dish_info){ 
				if ($index > 50){
					break;
				}
				if(!$dish_info){
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
		
				echo "<p><b>dish name: </b>" . $dish_info[1] . "</p>"; //dish name
				echo "<p><b>snatch:</b> " . $dish_info[4] . "</p>";  //snatch
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

	$dish_info_list = $engine_class -> dish_info_list(); // get the dish informarion 
	if ($dish_info_list != null){
		echo "<h3>";
		echo "the ricipes: ";
		echo "</h3>";
		show_result($dish_info_list, "result1");
	}else {
		echo "<h3>";
		echo "we cannt find recipes";
		echo "</h3>";
	}
	
	?>
	
	<a href="/WebSearchEngine/index1.php">return main page</a>

</body>





</html>