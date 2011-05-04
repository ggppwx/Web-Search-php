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


<title>web search engine </title>
<?php 


?>

</head>

<body>



<h1>my search engine</h1>
<div id="fm">
<p>
<a>item1</a>
<a>item2</a>
<a>item3</a>

</p>


<div id="searchform">
<form name="form1"  action="result.php" method="post">

<input type="text" name="input" size="20" maxlength="300" id="search" class="input_text">

<p>
<input type="radio" name="smethod" value="byrecipe" checked="checked">search by recipe name
<input type="radio" name="smethod" value="byingredient">search by ingredients
</p>
<input type="submit" value="search" class="input_submit">
&nbsp;&nbsp;
<input type="reset" value="reset" class="input_submit">
</form>

</div>


</div>



</body>
</html>