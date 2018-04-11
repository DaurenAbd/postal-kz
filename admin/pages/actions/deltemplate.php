<?php
session_start();
header('Content-Type: text/html; charset=cp1251');
if($_SESSION['status']!='admin')
{
	die();
}
if(isset($_POST['myid']))
{
	$idi=$_POST['myid'];
	include("../../../bd.php");
	$res=mysql_query("SELECT `postcard` FROM `templates` WHERE `id`='$idi' ");
	$data=mysql_fetch_array($res);
	$file=$data['postcard'];
	
	$result=mysql_query("DELETE FROM `templates` WHERE `id`='$idi'");
	$deluserposts=mysql_query("DELETE FROM `postcards` WHERE `postcard`='$file' ");
	
	if($result && $deluserposts && unlink("../../../temps/postcards/".$file) 
	&& unlink("../../../temps/small/".$file))
	{
		echo "Успешно!";
	}
	else
	{
		echo "Ошибка!";
	}
}
else
{
	die();
}
?>