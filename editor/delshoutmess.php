<?php
session_start();
include("../bd.php");
$login=$_SESSION['login'];
$r=mysql_query("SELECT `status` FROM `users` WHERE `login`='$login'");


$stat=mysql_fetch_array($r);
if($stat['status']!='admin')
{
	die();
}

if(isset($_POST['myid']))
{
	$myid=$_POST['myid'];

	$myid=trim(htmlspecialchars(strip_tags($myid)));

	$res=mysql_query("DELETE FROM `shoutbox` WHERE `id`='$myid'");
}

?>