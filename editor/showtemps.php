<?php
header('Content-Type: text/html; charset=cp1251');
include("../bd.php");
session_start();
if(isset($_POST['cat']))
{
	$_POST['cat'] = iconv("utf-8", "cp1251",$_POST['cat']);
	$getcat=$_POST['cat'];
	$result=mysql_query("SELECT `category` FROM `cats` WHERE `category`='$getcat'");
	
	$data=mysql_fetch_array($result);
	if(empty($data['category']))
	{
		die("����� ��������� �� ����������!<br>");
	}
	else
	{
		echo "�� �������������� ��������� <b>".$data['category']."</b><br><table><tr>";
		$res=mysql_query("SELECT * FROM `templates` WHERE `category`='$getcat' ");
		$nt=0;
		$q="'";
		$q2='"';
		$catik=$data['category'];
		while($r=mysql_fetch_array($res))
		{
			if($nt%2==0)echo "</tr><tr>";
			$nt++;
			echo
			'
			<td>
			<div id="mypost">
			';
			if($_SESSION['status']=="admin")
			{
				echo '<a id="pointer" onClick="deltemplate('.$q.$r["id"].$q.');">
				<img src="img/delete.png" width="12">
				</a>';
			}
			 echo '
			<a href="startdo.php?id='.$r["id"].'" target="_blank" ><img src="temps/small/'.$r["postcard"].'" /></a>
			';
			echo '
			</div>
			</td>
			';
		}
		echo "</tr></table>";
		if($nt==0)die("<i>������������� ��� �� ������� ���� �������� � ��� ���������</i>");
	}
}
else
{
	die("��� ������!");
}
?>