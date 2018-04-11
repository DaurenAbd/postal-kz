<?php

header("Content-type: text/plain; charset=windows-1251");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

session_start();

$login=$_POST['login'];
$password=$_POST['password'];
$repassword=$_POST['repassword'];

$login=trim(strip_tags(htmlspecialchars($login)));
$password=trim(strip_tags(htmlspecialchars($password)));
$repassword=trim(strip_tags(htmlspecialchars($repassword)));


//Проверка на пустоту строки с капчей
if(empty($_POST['cap']) || $_POST['cap']=='')
{
	die("Введите символы!");
}

//Проверка на ввод капчи
if($_POST['cap']!=$_SESSION['code'])
{
	die("Неверный ввод с картинки!");
}

//Проверка на заполнение полей
if(empty($login) || empty($password))
{
	die("Все поля необходимо заполнить");
}

//Проверка на уникальность логина
include_once("../bd.php");

$res=mysql_query("SELECT `login` FROM `users` WHERE `login`='$login'");
$result=mysql_fetch_array($res);
if(!empty($result['login']))
{
	die("Пользователь с таким <br>логином уже существует");
}

//Если пароли не совпадают
if($repassword!=$password)
{
	die("Введенные Вами пароли не совпадают");
}

//Длина пароля меньше 6 символов
if(strlen($password)<6)
{
	die("Длина пароля меньше 6 символов!");
}

//Если все ок, то шифруем пароль и сохраняем нового пользователя 
$password=md5($password);
$saveuser=mysql_query("INSERT INTO `users` (`login`,`password`) VALUES ('$login','$password')");
if($saveuser)
{
	die("Успешная регистрация! <br>Теперь можете войти на сайт.");
}
else
{
	die("Ошибка при сохранении <br>в базу данных. <br> Пожалуйста, сообщите администратору!");
}

?>