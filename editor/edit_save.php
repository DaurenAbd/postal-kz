<?php
if(isset($_POST['text']))
{
	header('Content-Type: text/html; charset=cp1251');
	include("../bd.php");
	session_start();
	foreach ($_POST as $key => $string)
	{
			$_POST[$key] = iconv("utf-8", "cp1251", $string);
	}
	
	$_POST['text']=preg_replace("/\[\{\~\~\}\]/", "&", $_POST['text']);
	$myid=$_POST['myid'];
	
	$res=mysql_query("SELECT * FROM `postcards` WHERE `id`='$myid' ");
	$data=mysql_fetch_array($res);
	
	$login=$_SESSION['login'];
	$postcard=$data['postcard'];
	$text=$_POST['text'];
	$category=$data['category'];
	$left=$_POST['left'];
	$top=$_POST['top'];
	$color=$_POST['color'];
	$shadx=$_POST['shadx'];
	$shady=$_POST['shady'];
	$shadrad=$_POST['shadrad'];
	$vl=$_POST['vl'];
	$vp=$_POST['vp'];
	$np=$_POST['np'];
	$nl=$_POST['nl'];
	$len = $_POST['sizeparam'];
	
	$text=preg_replace("/\'/",'~[[odKav~',$text);
	
	for ($i = 0; $i < $len; ++$i)
	{
	    $curtop = $_POST['top'.$i];
		$curleft = $_POST['left'.$i];
		$curid = $_POST['id'.$i];
		$curheight = $_POST['height'.$i];
		$curwidth = $_POST['width'.$i];
		
		$checker = mysql_query ("SELECT * FROM `images` WHERE `id` = '$curid'");
		$nextcheck = mysql_fetch_array ($checker);
		if ($nextcheck['card_id'] != -1)
		 $updateing = mysql_query ("UPDATE `images` SET `top` = '$curtop', `left`='$curleft', `width`='$curwidth', `height`='$curheight' WHERE `id` = '$curid'");
		else
		{
			$takefrompostcards = mysql_query ("SELECT `post_id` FROM `postcards` WHERE `id` = '$myid'");
			$taken = mysql_fetch_array ($takefrompostcards);
			$takenid = $taken['post_id'];
			$takenimg = $nextcheck['img'];
			$insertintoimg = mysql_query ("INSERT INTO `images` (`login`, `img`, `card_id`, `top`, `left`,`width`,`height`) VALUES ('$login', '$takenimg', '$takenid', '$curtop', '$curleft','$curwidth','$curheight')");
			$nextid = mysql_insert_id();
			echo '<script> up_ides ("'.$curid.'","'.$nextid.'"); </script>';
		}
    }
	
	
	if(!is_numeric($shadx) || !is_numeric($shady) || !is_numeric($shadrad))
	{
		die('<script type="text/javascript">showstickerbad();</script>');
	}
	
	$insert=mysql_query
	("UPDATE
	`postcards` SET `login`='$login',`text`='$text',`category`='$category',
	`left`='$left',`top`='$top',`color`='$color',`shadx`='$shadx',`shady`='$shady',
	`shadrad`='$shadrad',`postcard`='$postcard', `vl`='$vl', `vp`='$vp', `np`='$np', `nl`='$nl'
	WHERE `id`='$myid'");
	
	if($insert)
	{
		echo 
		'<script type="text/javascript">showstickergood();</script>';
	}
	else
	{
		echo '<script type="text/javascript">showstickerbad();</script>';
	}
}
?>