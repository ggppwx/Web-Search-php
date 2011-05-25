<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=MacRoman">
<style type="text/css">
body
{
background-color:#b0c4de;
}
h1
{
color:red;
text-align:center;
}
p
{
text-align:center;
}
#fm
{
text-align:center;
}
.input_text
{
padding:2px 8px 0pt 3px;
width:300px;
height:25px;
border:1px solid #CCC;
background-color:#FFF;
}
.input_submit
{
 border:1px solid #8b9c56; 
 height:32px; 
 font-weight:bold; 
 padding-top:2px; 
 cursor:pointer; 
 font-size:14px; 
 color:#336600;
}
</style>
<title>web search engine</title>
</head>

<body>

<h1>Food Engine</h1>

<div id="fm">

<p>
</p>


<div id="searchform">
<p>
<input type="radio" id="1" name="smethod" value="byrecipe" checked="checked" onclick="rd()">search by recipe name
<input type="radio" id="1" name="smethod" value="byingredient" checked="checked">search by ingredients
</p>

<script type="text/javascript"></script>
<?php 
	echo "<script type='text/javascript'>";
	echo "function rd(){";	
	echo "location.href='/WebSearchEngine/index.php'";
	echo "}";
	echo "</script>";
	
?>

<form name="form1"  action="result1.php" method="post">

<p><input type="text" name="input1" size="20" maxlength="300" id="search" class="input_text"></p>
<p><input type="text" name="input2" size="20" maxlength="300" id="search" class="input_text"></p>
<p><input type="text" name="input3" size="20" maxlength="300" id="search" class="input_text"></p>
<p><input type="text" name="input4" size="20" maxlength="300" id="search" class="input_text"></p>
<p>
<input type="submit" value="search" class="input_submit">
&nbsp;&nbsp;
<input type="reset" value="reset" class="input_submit">
</p>
</form>


</div>


</div>

</body>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<center>Designed by Han Song, Jingwei Gu, Zhijie Wen</center>
</html>