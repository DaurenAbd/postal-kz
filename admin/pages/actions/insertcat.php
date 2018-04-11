<?php
session_start();
if(isset($_SESSION['status']) && $_SESSION['status']=='admin')
{

$cat=$_POST['category'];
include("../../../bd.php");

$res=mysql_query("INSERT INTO `cats` (`category`) VALUES ('$cat')");

if($res)
{
	Header("Location: ../../?act=addcat");
}
else
{
	die("Error!<br>".mysql_error());
}
}
?>