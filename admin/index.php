<!-- Подключаем jquery!-->


<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>

<script>
function include_page(page)
{
//Функция бесполезна, просто хотелось добавить аякса, но так дольше работало, и ее решил убрать.
  // Отсылаем параметры
       $.ajax(
	   {
                type: "POST",
                url: "includer.php",
                data: "page="+page,
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#homecontent").empty();
					$("#homecontent").append(html);
                }
        }
	);
}
</script>

<?php

error_reporting(0);

session_start();
if(!isset($_SESSION['status']) || $_SESSION['status']!="admin")
{
	Header("Location: ../");
}
if(isset($_GET['act']))
{
	if(file_exists("pages/".$_GET['act'].".php"))
	{
		$act=$_GET['act'];
		//echo "<script>include_page('".$act."');</script>";
	}
	else
	{
		echo "Подключаемая страница не найдена!";
	}
}
?>
<html>
<head>
<link rel="stylesheet" href="../css/home.css">
<link rel="stylesheet" href="../css/main.css">
</head>
<title>
Postcard - Панель администрирования
</title>


<div id="wrapper">

<div id="header">
<div class="ribbon"><div class="ribbon-stitches-top"></div><strong class="ribbon-content"><h1><i>Postal.kz</i></h1></strong><div class="ribbon-stitches-bottom"></div>
</div>
</div>

<div id="leftcolumn">
<div id="menu">

<a href="../admin"><p id="menulink">Главная</p></a>
<a href="?act=addcat"><p id="menulink">Категории</p></a>
<a href="?act=uptemp"><p id="menulink">Залить шаблон</p></a>
<a href="?act=churl"><p id="menulink">Адрес сайта</p></a>
<a href="?act=users"><p id="menulink">Пользователи</p></a>
<a href="../"><p id="menulink">Главная сайта</p></a>
</div>
</div>

<div id="homecontent">

<?php
if(!isset($act))
echo "
Добро пожаловать в панель администрирования <br> <b>сервиса бесплатных открыток!</b><br><br>
Для продолжения работы выберите необходимый пункт в левом меню.";

else
{
	include_once("pages/".$act.".php");
}
?>
</div>

</div>

<div id="footer">
<div class="ribbon1"><div class="ribbon1-stitches-top"></div><strong class="ribbon1-content"><h1>2012 Postcard team</h1></strong><div class="ribbon1-stitches-bottom"></div>
</div>
</div>
</html>