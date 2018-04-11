<?php


	session_start();
	include("../bd.php");

	
	function get_extension($filename)
	{
		return array_pop(explode(".",$filename));
	}
	
	$login=$_SESSION['login'];
	$iname=rand(111111,999999);
	$iname .=".".get_extension($_FILES['ufile']['name']);

	$res=mysql_query("INSERT INTO `images` (`login`,`img`,`card_id`,`width`,`height`) VALUES ('$login','$iname','-1','100','100') ");
	$rty=mysql_query("SELECT `id` FROM `images` WHERE `img`='$iname' ");
	$id_arr=mysql_fetch_array($rty);
	$myid=$id_arr['id'];
	
	if(move_uploaded_file($_FILES['ufile']['tmp_name'],"../user_images/".$iname) && $res==true)
	{
		echo "Успешно загружено!";
		echo "<script>add_div_image('".$iname."','".$myid."')</script>";
	}

?>