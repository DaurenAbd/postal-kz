<?php

include ("../bd.php");

session_start();

if($_SESSION['status']!="admin" || !isset($_SESSION['status']))
{
	die();
}

$res=mysql_query("SELECT * FROM `users` ");


	echo "<table border=1>";
while($c=mysql_fetch_array($res))
{	
	echo "<tr><td>";	
	echo $c['login']."</td><td>".$c['name']."</td><td>".$c['surname']."</td><td>".$c['from'];	
	echo "</td><td><a href=pages/actions/deluser.php?id=".$c['id'].">--X--</a></td></tr>";	
	$k++;
}
	echo "</table>";
	if($k==0)echo "Пользователей нет!";

?>