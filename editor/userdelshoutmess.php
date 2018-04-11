<?php
session_start();
$login=$_SESSION['login'];

if(isset($_POST['login']) && isset($_POST['myid']))
{
	if($login==$_POST['login'])
	{
		include("../bd.php");
		$myid=$_POST['myid'];
		$res=mysql_query("DELETE FROM `shoutbox` WHERE `login`='$login' AND `id`='$myid'");
	}
	else die();
}
else die();
?>