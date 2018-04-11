<?php
include("../bd.php");
header('Content-Type: text/html; charset=cp1251');
$res=mysql_query("SELECT * FROM `cats`");
$t=0;
echo "<table><tr>";
while($c=mysql_fetch_array($res))
{
	if($t%4==0)
	{
		echo "</tr><tr>";
	}
	$cat=$c['category'];
	$q="'";
	echo 
	'
	<td>
	<a onClick="show_temps('.$q.$cat.$q.');"><p id="menulink">'.$cat.'</p></a>
	</td>
	';
	$t++;
}
echo "</tr></table>";
?>