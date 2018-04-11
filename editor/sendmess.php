<?php
header('Content-Type: text/html; charset=cp1251');
if(isset($_POST['mess']) && !empty($_POST['mess']))
{
	include("../bd.php");
	session_start();
	foreach ($_POST as $key => $string)
	{
			$_POST[$key] = iconv("utf-8", "cp1251", $string);
	}
	$login=$_SESSION['login'];

	
	$t=mysql_query("SELECT `last_mess` FROM `users` WHERE (NOW()-`last_mess` > 10) AND (`login`='$login')");
	$d=mysql_fetch_array($t);
	
	if(empty($d['last_mess']))
	{
			die("<script>showmess('¬ы можете оставл€ть<br>1 сообщение в <br>10 секунд')</script>");
	}
	
	$message=trim(htmlspecialchars($_POST['mess']));
	$date=date("d.m.Y h:i:s");
	$res=mysql_query("INSERT INTO `shoutbox` (`login`,`date`,`message`)
	VALUES
	('$login','$date','$message')
	");
	$r=mysql_query("UPDATE `users` SET `last_mess`= NOW() WHERE `login`='$login' ");
}
?>