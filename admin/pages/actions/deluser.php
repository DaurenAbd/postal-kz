<?php

session_start();
if($_SESSION['status']=='admin')
{
if(isset($_GET['id']) && is_numeric($_GET['id']))
{
	$myid=$_GET['id'];
	include("../../../bd.php");
	$res=mysql_query("DELETE FROM `users` WHERE `id`='$myid'");
	if($res)
	{
		Header("Location: ../../?act=users");
	}
	else
	{
		die( "Error happened! <br>".mysql_error());
	}
}
}
else
{
	Header("Location: ../../");
}

?>