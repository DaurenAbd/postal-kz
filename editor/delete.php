<?php
header('Content-Type: text/html; charset=cp1251');
if(isset($_POST['myid']))
{
	$myid=$_POST['myid'];
	if(!is_numeric($_POST['myid']))
	{
		die('<script type="text/javascript">showmess("Нечисловое значение id!");</script>');
	}
	include("../bd.php");
	$res=mysql_query("SELECT * FROM `postcards` WHERE `id`='$myid'");
	$data=mysql_fetch_array($res);
	$post_id=$data['post_id'];
	if(empty($data['login']))
	{
		die('<script type="text/javascript">showmess("Такой открытки нет!");</script>');
	}
	session_start();
	if($data['login']!=$_SESSION['login'])
	{
		die('<script type="text/javascript">showmess("Вы не можете удалять чужие поздравления!");</script>');
	}
	$rt=mysql_query("DELETE FROM `images` WHERE `card_id`='$post_id' ");
	$result=mysql_query("DELETE FROM `postcards` WHERE `id`='$myid'");
	if($result)
	{
		echo '<script type="text/javascript">showmess("Успешно!");</script>';
	}
	else
	{
		echo '<script type="text/javascript">showmess("Ошибка!");</script>';
	}
}
?>