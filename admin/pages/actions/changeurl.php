<?php
session_start();
if(isset($_SESSION['status']) && $_SESSION['status']=='admin')
{
	if(isset($_POST['newurl']) && $_POST['newurl']!='' && $_POST['newurl']!=' ')
	{
		include("../../../bd.php");
		$url=$_POST['newurl'];
		$allconf=mysql_query("SELECT * FROM `config`");
		$data=mysql_fetch_array($allconf);
		$temp_count=$data['temp_count'];
		
		$res=mysql_query("UPDATE `config` SET `temp_count`='$temp_count', `site_url`='$url'
		WHERE `id`='1' ");
		
		if($res)
{
	Header("Location: ../../?act=churl");
}
else
{
	die("Error!<br>".mysql_error());
}

	}
	else
	{
		die("Впишите новый адрес!");
	}
}
else
{
	Header("Location: ../../");
}
?>