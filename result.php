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
		$select_radio = $_POST['smethod'];
		//print $select_radio;
		$input_text = $_POST['input'];
		
		//process the input 
		echo "process the input...\n";
		$engine_class = new Engine();
		$input_list = $engine_class -> process_string($input_text);
		
	?>

</head>

<body>
    

</body>
</html>