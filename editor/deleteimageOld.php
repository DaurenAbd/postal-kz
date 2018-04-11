<?php
    include ("../bd.php");
	session_start ();
	
	$login = $_SESSION['login'];
	$id = $_POST['myid'];
	
	$a1 = mysql_query ("SELECT * FROM `images` WHERE `id`='$id'");
	$b1 = mysql_fetch_array ($a1);
	$imglogin = $b1['login'];
	
	if ($imglogin != $login)
	{
	    die ("Access denied!!!");
    }
	
	$a2 = mysql_query ("DELETE FROM `images` WHERE `id`='$id'");
?>