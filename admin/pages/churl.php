<html>
<title>Адрес сайта</title>
<head>
</head>
<?php
include ("../bd.php");
$res=mysql_query("SELECT * FROM `config`");
$data=mysql_fetch_array($res);

$url=$data['site_url'];
echo "Текущий адрес сайта: <b>".$url."</b>";
?>
<form action="pages/actions/changeurl.php" method="POST"><br><br>
Новый адрес:<br><br>
<input type="text" name="newurl">
<br><br>
<input type="submit" value="Сменить">
</form>
</html>