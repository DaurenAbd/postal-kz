<?php

header("Content-type: text/plain; charset=windows-1251");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);


$login=$_POST['login'];
$password=$_POST['password'];

$login=trim(strip_tags(htmlspecialchars($login)));
$password=trim(strip_tags(htmlspecialchars($password)));

if(empty($login) || empty($password))
{
	die("��� ���� ���������� ���������");
}

//�������� �� �������������
include_once("../bd.php");

$res=mysql_query("SELECT * FROM `users` WHERE `login`='$login' ");
$userdata=mysql_fetch_array($res);

if(empty($userdata['login']))
{
	die("������ ������������ �� ����������!");
}

//�������� �� ������������ ������
if(md5($password)!=$userdata['password'])
{
	die("�� ����� �������� ������. ���������� ��� ���.");
}

//���� ��� ��������, ��������� ������ :)
if(md5($password)==$userdata['password'])
{
	session_start();
	$_SESSION['login']=$userdata['login'];
	$_SESSION['id']=$userdata['id'];
	$_SESSION['status']=$userdata['status'];
	echo '<Meta http-equiv="Refresh" content="0; URL=home.php">';
?>
      	<script type="text/javascript">
		location.replace("home.php");
	</script> 
<?php
}
?>