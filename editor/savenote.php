<?php
header('Content-Type: text/html; charset=cp1251');
session_start();
include("../bd.php");

if(isset($_POST['note']))
{
	$login=$_SESSION['login'];
	foreach ($_POST as $key => $string)
	{
			$_POST[$key] = iconv("utf-8", "cp1251", $string);
	}
	$note=trim(strip_tags($_POST['note']));
	$res=mysql_query("SELECT * FROM `notes` WHERE `login`='$login'");
	$e=mysql_num_rows($res);
	
	if($e==0)
	{
		$ins=mysql_query("INSERT INTO `notes` (`login`,`note`) VALUES ('$login','$note')");
	}
	else
	{
		$ins=mysql_query("UPDATE `notes` SET `note`='$note',`login`='$login' WHERE `login`='$login'");
	}
	if($ins)
	{
		echo "<script>showgood();</script>";
	}
	else
	{
		echo "<script>showbad();</script>";
	}
}
else die();
?>