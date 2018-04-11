<!-- ���������� jquery!-->


<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>

<script>
function include_page(page)
{
//������� ����������, ������ �������� �������� �����, �� ��� ������ ��������, � �� ����� ������.
  // �������� ���������
       $.ajax(
	   {
                type: "POST",
                url: "includer.php",
                data: "page="+page,
                // ������� �� ��� ������ PHP
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
		echo "������������ �������� �� �������!";
	}
}
?>
<html>
<head>
<link rel="stylesheet" href="../css/home.css">
<link rel="stylesheet" href="../css/main.css">
</head>
<title>
Postcard - ������ �����������������
</title>


<div id="wrapper">

<div id="header">
<div class="ribbon"><div class="ribbon-stitches-top"></div><strong class="ribbon-content"><h1><i>Postal.kz</i></h1></strong><div class="ribbon-stitches-bottom"></div>
</div>
</div>

<div id="leftcolumn">
<div id="menu">

<a href="../admin"><p id="menulink">�������</p></a>
<a href="?act=addcat"><p id="menulink">���������</p></a>
<a href="?act=uptemp"><p id="menulink">������ ������</p></a>
<a href="?act=churl"><p id="menulink">����� �����</p></a>
<a href="?act=users"><p id="menulink">������������</p></a>
<a href="../"><p id="menulink">������� �����</p></a>
</div>
</div>

<div id="homecontent">

<?php
if(!isset($act))
echo "
����� ���������� � ������ ����������������� <br> <b>������� ���������� ��������!</b><br><br>
��� ����������� ������ �������� ����������� ����� � ����� ����.";

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