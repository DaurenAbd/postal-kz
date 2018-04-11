<?php
header('Content-Type: text/html; charset=cp1251');
if(isset($_POST['request']))
{
	include("../bd.php");
	session_start();
	$login=$_SESSION['login'];
	$po=mysql_query("SELECT `status` FROM `users` WHERE `login`='$login' ");
	$e=mysql_fetch_array($po);
	$stat=$e['status'];
	$q='"';
	$w="'";
	$res=mysql_query("SELECT * FROM `shoutbox`  ORDER BY `id` ");
	$k=0;
	while($c=mysql_fetch_array($res))
	{
		$k++;
		if($k%2==0)
		{
			$color="green";
			echo "<p id='even'>";
		}
		else
		{	
			$color="orange";
			echo "<p id='odd'>";
		}
		if($stat=="admin")
		{
			echo "
			<img src='img/delete.png' 
			style='cursor:pointer;' width=15 onClick=".$q."delshoutmess(".$w.$c['id'].$w.");".$q."/>";
		}
		else
		{
			if($login==$c['login'])
			{
				echo "
				<img src='img/delete.png' 
				style='cursor:pointer;' width=15 onClick=".$q."userdelshoutmess(".$w.$c['id'].$w.",".$w.$c['login'].$w.");".$q."/>";
			}
		}
		echo "
		<font color=orange><i>".$c['date']."</i>
		</font>-<font color=".$color.">
		<b>
		<a class='toprof'onClick=".$q."showprof(".$w.$c['login'].$w.")".$q.";>
		".$c['login'].":</a> </b></font>".$c['message'];
		echo "</p>";
	}
	if($k==0)echo "<i>Нет сообщений</i>";
}
?>