<?php
include ("../bd.php");
?>

<html>
<title>������ ������</title>
<head></head>

<body>

<form action="pages/actions/uploadtemp.php" method="post" enctype="multipart/form-data">
<b>�������� ���������:</b><br>
<select name="category">
<?php
$res=mysql_query("SELECT * FROM `cats`");
while($c=mysql_fetch_array($res))
{
echo '
<option value="'.$c["category"].'">'.$c["category"].'</option>
';
}
?>
</select><br><br>
<b>���� ����(��������):</b><br>
<input type="file" name="fon" /><br><br>
<input type="submit" value="���������">

</form>

</body>
</html>















