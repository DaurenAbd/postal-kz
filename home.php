<?php
session_start();
$login=$_SESSION['login'];
if(isset($_GET['act']) && $_GET['act']=='close')
{
	die("<script>window.close();</script>");
}
?>
<html>
<title>Postcard</title>
<head>

<meta name="keywords" content="что подарить, что подарить на новый год, подарок на день рождения, подарки, универсальный подарок, креативный подарок, интересный подарок на новый годы"> 
<meta name="description" content="креативный универсальный подарок на праздники"> 

<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/main.css">
<!-- Подключаем jquery!-->


<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
	
<script type="text/javascript" src="js/jquery.stickr.min.js"></script>

<script type="text/javascript" src="js/home.js"></script>
	
	
<?php
if(isset($_GET['user']))
{
	include_once("bd.php");
	$user=trim(htmlspecialchars($_GET['user']));
	$y=mysql_query("SELECT `login` FROM `users` WHERE `login`='$user' ");
	$data=mysql_fetch_array($y);
	$user=$data['login'];
	echo "<script>showprof('".$user."');</script>";
}
else
{
?>
	<script>
	showindex();
	</script>
<?php
}
?>
</head>

<body>

<div id="wrapper">

<div id="header">
<div class="ribbon"><div class="ribbon-stitches-top"></div><strong class="ribbon-content"><h1><i>Postal.kz</i></h1></strong><div class="ribbon-stitches-bottom"></div>
</div>
</div>

<div id="leftcolumn">
<input type="hidden" value="<?php echo $login;?>" id="namelogin">
<input type="hidden" id="nowcat">
<div id="menu">
<a onClick="showindex();"><p id="menulink">Главная</p></a>
<a onClick="showprof(<?php echo "'".$login."'";?>);"><p id="menulink">Профиль</p></a>
<a onClick="myposts(<?php echo "'".$login."'";?>);"><p id="menulink">Мои открытки</p></a>
<a onClick="showcats();"><p id="menulink">Создать открытку</p></a>
<?php
if($_SESSION['status']=="admin")
{
	?>
	<a href="admin" target="_blank" style="text-decoration:none; color:#696969;"><p id="menulink">Панель<br>управления</p></a>
	<?php
}
?>
<a href="reg/exit.php" id="nodec"><p id="menulink">Выход</p></a>
</div>

<div id="messes">
</div>

<div id="miniprofile" style="margin-top:15px; float:left;padding:3;">
</div>

<div id="helpes" style=" float:left;padding:3; margin-top: 2px;">
</div>

<div id="wait"></div>
</div>

<div id="homecontent">
<div id="result"></div>
<div id="cats">
</div>
<br>


<div id="temps_content">
</div>


<div id="images">
</div>
</div>

</div>

<div id="betweenfooterandwrapper">
</div>

<div id="footer">
<div class="ribbon1"><div class="ribbon1-stitches-top"></div><strong class="ribbon1-content"><h1>2012 Postcard team</h1></strong><div class="ribbon1-stitches-bottom"></div>
</div>
</div>

</body>
</html>
















