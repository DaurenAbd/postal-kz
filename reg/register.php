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


//�������� �� ������� ������ � ������
if(empty($_POST['cap']) || $_POST['cap']=='')
{
	die("������� �������!");
}

//�������� �� ���� �����
if($_POST['cap']!=$_SESSION['code'])
{
	die("�������� ���� � ��������!");
}

//�������� �� ���������� �����
if(empty($login) || empty($password))
{
	die("��� ���� ���������� ���������");
}

//�������� �� ������������ ������
include_once("../bd.php");

$res=mysql_query("SELECT `login` FROM `users` WHERE `login`='$login'");
$result=mysql_fetch_array($res);
if(!empty($result['login']))
{
	die("������������ � ����� <br>������� ��� ����������");
}

//���� ������ �� ���������
if($repassword!=$password)
{
	die("��������� ���� ������ �� ���������");
}

//����� ������ ������ 6 ��������
if(strlen($password)<6)
{
	die("����� ������ ������ 6 ��������!");
}

//���� ��� ��, �� ������� ������ � ��������� ������ ������������ 
$password=md5($password);
$saveuser=mysql_query("INSERT INTO `users` (`login`,`password`) VALUES ('$login','$password')");
if($saveuser)
{
	die("�������� �����������! <br>������ ������ ����� �� ����.");
}
else
{
	die("������ ��� ���������� <br>� ���� ������. <br> ����������, �������� ��������������!");
}

?>