<?php
header('Content-Type: text/html; charset=cp1251');
session_start();
$login=$_SESSION['login'];
if(isset($_POST['oldpass']) && isset($_POST['newpass']) && isset($_POST['newrepass']))
{
	$oldpass=trim(htmlspecialchars(strip_tags($_POST['oldpass'])));
	$newpass=trim(htmlspecialchars(strip_tags($_POST['newpass'])));
	$newrepass=trim(htmlspecialchars(strip_tags($_POST['newrepass'])));
	if(strlen($newpass)<6 || strlen($newrepass)<6)
	{
		die("<script>mess('Длина нового пароля меньше 6 символов!');</script>");
	}
	include("../bd.php");
	$r=mysql_query("SELECT `password` FROM `users` WHERE `login`='$login'");
	$data=mysql_fetch_array($r);
	$bdpass=$data['password'];
	if(md5($oldpass)!=$bdpass)
	{
		die("<script>mess('Пароль не верен!');</script>");
	}
	if($newpass!=$newrepass)
	{
		die("<script>mess('Новые пароли не совпадают!');</script>");
	}
	
	$newpass=md5($newpass);
	$res=mysql_query("UPDATE `users` SET `password`='$newpass' WHERE `login`='$login'");
	if($res)
	{
		die("<script>mess('Пароль успешно обновлен!');</script>");
	}
}
else
{
	die("<script>mess('Вы ввели не все данные!');</script>");
}
?>