<html>
<title>����� �����</title>
<head>
</head>
<?php
include ("../bd.php");
$res=mysql_query("SELECT * FROM `config`");
$data=mysql_fetch_array($res);

$url=$data['site_url'];
echo "������� ����� �����: <b>".$url."</b>";
?>
<form action="pages/actions/changeurl.php" method="POST"><br><br>
����� �����:<br><br>
<input type="text" name="newurl">
<br><br>
<input type="submit" value="�������">
</form>
</html>