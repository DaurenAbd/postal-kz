<?php
header('Content-Type: text/html; charset=cp1251');
session_start();
foreach ($_POST as $key => $string)
{
			$_POST[$key] = iconv("utf-8", "cp1251", $string);
}
if(isset($_POST['login']))
{
	$login=$_POST['login'];
	include("../bd.php");
	if($_SESSION['login']!=$login)
	{
		die("Это не ваши открытки!");
	}
	$res=mysql_query("SELECT * FROM `postcards` WHERE `login`='$login' ");
	$urlquery=mysql_query("SELECT * FROM `config`");
	$config=mysql_fetch_array($urlquery);
	$url=$config['site_url'];
	
	echo "<table>";
	$o=0;
	while($data=mysql_fetch_array($res))
	{
		$name=$data['postcard'];
		$result=mysql_query("SELECT * FROM `templates` WHERE `postcard`='$name' ");
		$temp_data=mysql_fetch_array($result);

		$avatar=$temp_data['postcard'];
		$category=$temp_data['category'];
		$idi=$data['id'];
		$q="'";
		if($o%2==0)
		{
			echo "</tr><tr>";
		}
		echo 
		'
		<td id="mypost">
		<a href="'.$data["id"].'" target="_blank"><img src="temps/small/'.$avatar.'"></img></a>
		<br>
		<b>Категория: </b>'.$category.'
		<br>
		<a id="pointer" href="edit.php?id='.$data["id"].'" target="_blank">
		<img src="img/edit.png" width="23" /></a>
		&nbsp;&nbsp;
		<a id="pointer" onClick="del('.$q.$idi.$q.');" >
		<img src="img/delete.png" width="20"> 
		</a>
		<br>
		<b>Ссылка: </b><br><input type="text" readonly onClick="this.select();" value="http://'.$url.'/'.$data["id"].'">
		</td>
		';
		$o++;
	}
	echo "</table>";
	if($o==0)die("Вы еще никого не поздравляли :(<br>Для изготовления онлайн-открытки нажмите 'Создать открытку' в левом меню");
}
else
{
	die("Данные о пользователе не переданы!");
}
?>