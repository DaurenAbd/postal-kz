<?php
header('Content-Type: text/html; charset=cp1251');
if(isset($_POST['user']))
{
	function is_empty($s)
	{
		if(empty($s))return "�� �������";
		else return $s;
	}
	$user=trim(htmlspecialchars($_POST['user']));
	include("../bd.php");
	$r=mysql_query("SELECT * FROM `users` WHERE `login`='$user' ");
	$data=mysql_fetch_array($r);
	
	$htmlcode="<b>���:</b><br>".is_empty($data['name'])."<br><b>�������:</b><br>".is_empty($data['surname'])."
	<br><b>���� ��������:</b><br>".is_empty($data['birthday'])."<br><b>��:</b><br>".is_empty($data['from'])."<br>";
	echo $htmlcode; 
}
?>