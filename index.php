<?php
session_start();
if(isset($_SESSION['login']) && isset($_SESSION['id']))
{
	Header("Location: home.php");
}
include("bd.php");
$res=mysql_query("SELECT * FROM `postcards` WHERE `login`='admin' ");
$p=0;
while($r=mysql_fetch_array($res))
{
	$p++;
	$idi[$p]=$r["id"];
	$img[$p]=$r["postcard"];
}
if($p==0 || $p==1)$k=3;else $k=0;
?>
<html>
<title>Postcard</title>
<head>

<meta name="keywords" content="что подарить, что подарить на новый год, подарок на день рождения, подарки, универсальный подарок, креативный подарок, интересный подарок на новый годы"> 
<meta name="description" content="креативный универсальный подарок на праздники"> 

<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/home.css">



<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>

<script type="text/javascript" src="reg/reg-log.js"></script>
<script type="text/javascript" src="js/jquery.stickr.min.js"></script>

<script type="text/javascript">
function show_res(mess)
	{
		$.stickr({note:mess,className:'classic'})
	}
</script>

<style>
#update_cap
{
	cursor:pointer;
}
</style>

<script type="text/javascript">
function load_cap()
{
		     $("#cap_div").empty();
                     $("#cap_div").append('<img src="captcha.php" /><img src="img/update_cap.png" id="update_cap" onClick="load_cap();" width="20" align="right"/>');	
}
</script>

</head>

<body>

<div id="wrapper">

<div id="header">
<div class="ribbon"><div class="ribbon-stitches-top"></div><strong class="ribbon-content"><h1><i>Postal.kz</i></h1></strong><div class="ribbon-stitches-bottom"></div>
</div>
</div>

<div id="leftcolumn">
<div id="loginform">
<form action="javascript:login();">
Логин:<br>
<input type="text" name="login" id="login" style="width:120;" /><br>
Пароль:<br>
<input type="password" name="password" id="password" style="width:120;"/><br>
<input type="submit" id="logregbutton" value="Войти" style="margin-top:10;"><br>
</form>
</div>

<div id="logresult"></div>

</div>

<div id="content">
С этим сервисом Вы сможете сделать оригинальный подарок близкому человеку на любой праздник.
<br><br>
<b>Подарите ему частичку Интернета!</b>
<br><br>
Для этого Вам нужно лишь зарегистрироваться.
<br><br>
<?php
if($k==0)
{
$rand1=1;
$rand2=1;
while($rand1==$rand2)
{
$rand1=rand(1,$p);
$rand2=rand(1,$p);
}
?>
Посмотрите, что дарят другие:<br><br>
<div id="baska_work">
<?php
echo '<center><a href="v.php?id='.$idi[$rand1].'" target="_blank"><img src="temps/small/'.$img[$rand1].'"></img></a></center>';
?>
</div>

<div id="vert_space"></div>

<div id="baska_work">
<?php
echo '<center><a href="v.php?id='.$idi[$rand2].'" target="_blank"><img src="temps/small/'.$img[$rand2].'"></img></a></center>';
?>
</div>
<?php
}
?>
</div>

<div id="rightcolumn">
<div id="registrationform">
<form action="javascript:register();" id="regform">
Логин:<br>
<input type="text" name="reglogin" id="reglogin" style="width:120;" /><br>
Пароль:<br>
<input type="password" name="regpassword" id="regpassword" style="width:120;" /><br>
Повторите пароль:
<input type="password" name="reregpassword" id="reregpassword" style="width:120;" /><br>
Введите символы:<br>
<div id="cap_div">
<img src="img/update_cap.png" id="update_cap" onClick="load_cap();" width="20" align="right"/>
</div>
<script type="text/javascript">
load_cap();
</script>
<br>
<input type "text" name="regcap" id="regcap" style="width:120;'" />
<br>

<input type="submit" id="logregbutton" value="Регистрация" style="margin-top:10;"/>
</form>
</div>
<div id="regresult"></div>
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

















