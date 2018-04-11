<?php
header('Content-Type: text/html; charset=cp1251');
session_start();
if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['from']) && isset($_POST['birthday']))
{
	foreach ($_POST as $key => $string)
	{
			$_POST[$key] = iconv("utf-8", "cp1251", $string);
	}
	include("../bd.php");
	$login=$_SESSION['login'];
	$name=htmlspecialchars(trim($_POST['name']));
	$surname=htmlspecialchars(trim($_POST['surname']));
	$from=htmlspecialchars(trim($_POST['from']));
	$birthday=htmlspecialchars(trim($_POST['birthday']));
	
	$res=mysql_query("UPDATE `users` SET 
	`name`='$name',`surname`='$surname',`from`='$from',`birthday`='$birthday' WHERE `login`='$login'");
	
	if($res)
	{
		echo "<script>good();</script>";
	}
	else
	{
		echo "<script>bad();</script>";
	}
}
?>