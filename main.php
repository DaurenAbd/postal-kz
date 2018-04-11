
<?php
session_start();
// Проверяем, пусты ли переменные логина и id пользователя
if (empty($_SESSION['login']) or empty($_SESSION['id'])) {
    // Если пусты, то мы не выводим ссылку
    echo 'ееее братишка сначала зарегистрируйся!!!';
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
Вы успешно вошли как

 <p class="header">
';

$login=$_SESSION['login']; 

echo $login;
echo '<br>
<a href="reg/exit.php">Выйти!</a>
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
<p class="see"><b>ПРИМЕРЫ НАШИХ РАБОТ:</b></p>
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
