
<?php
session_start();
// ���������, ����� �� ���������� ������ � id ������������
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    // ���� �����, �� �� �� ������� ������
    echo '���� �������� ������� ���������������!!!';
}
else 
{
echo '

<html>
<head>
<link rel="stylesheet" type="text/css" href="stylesheets/main.css">
</head>
<body>

<table width=100% height=10% bgcolor=4196ff>
 <tr>
<td width=55%>
�� ������� ����� ���

 <p class="header">
';

$login=$_SESSION['login']; 

echo $login;
echo '<br>
<a href="reg/exit.php">�����!</a>
</p>


</td>
<td align="right">
</form>
</td>
<td width=5%>
</td>
</tr>
</table>
<table width=100% height=58%>
<tr>
</tr>
</table>
<table width=100% bgcolor=4196ff height=2%>
<tr>
<td align=center>
<p class="see"><b>������� ����� �����:</b></p>
</td>
</tr>
</table>
<table width=100% bgcolor=4196ff height=28% cellspacing=40%>
<tr>

<td align=left width=10% bgcolor=#3366ff>
</td>

<td align=center width=10% bgcolor=#3366ff>
</td>

<td align=right width=10% bgcolor=#3366ff>
</td>

<td align=right width=10% bgcolor=#3366ff>
</td>

<td align=right width=10% bgcolor=#3366ff>
</td>
</tr>
</table>


</body>
</html>';

}
