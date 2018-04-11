<?php
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status']!="admin")
{
	Header("Location: ../");
}

	include ("../bd.php");

	$res=mysql_query("SELECT * FROM `cats`");
	$k=0;
	
	echo "<table border=1>";
while($c=mysql_fetch_array($res))
{	
	echo "<tr><td>";	
	echo $c['category'];	
	echo "</td><td><a href=pages/actions/delcat.php?id=".$c['id'].">--X--</a></td></tr>";	
	$k++;
}
	echo "</table>";
	if($k==0)echo "Категорий нет!";
?>
<html><form action="pages/actions/insertcat.php" method="POST">
<br><br>Название категории <br>
<input type="text" name="category" id="category">
<br><br><input type="submit" value="Добавить">
</form>
</html>