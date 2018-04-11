<?php
if(isset($_POST['text']))
{
	header('Content-Type: text/html; charset=cp1251');
	include("../bd.php");
	session_start();
	
	
	
	$_POST['text']=preg_replace("/\[\{\~\~\}\]/", "&", $_POST['text']);
	$myid=$_POST['myid'];
	$text=htmlspecialchars($_POST['text']);
	
	$text=iconv("utf-8","windows-1251",$text);
	
	$text=preg_replace("/\'/",'~[[odKav~',$text);
	
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
	$size=$_POST['size'];
	
	$img_names;
	$img_left;
	$img_top;
	$img_width;
	$img_height;

	for($i=1; $i<=$size; $i++)
	{
		$img_names[$i]=$_POST["img".$i];	
		$img_top[$i]=$_POST['img'.$i.'top'];
		$img_left[$i]=$_POST['img'.$i.'left'];
		$img_height[$i]=$_POST['img'.$i.'height'];
		$img_width[$i]=$_POST['img'.$i.'width'];
	}
	
	$result=mysql_query("SELECT * FROM `templates` WHERE `id`='$myid'");
	$tempdata=mysql_fetch_array($result);
	
	$postcard=$tempdata['postcard'];
	$category=$tempdata['category'];
	$login=$_SESSION['login'];
	
	$post=mysql_query("SELECT `post_id` FROM `config` WHERE `id`='1' ");
	$postas=mysql_fetch_array($post);
	$post_id=$postas['post_id'];

	$insert=mysql_query
	("INSERT INTO `postcards`
	(`login`,`text`,`category`,`left`,`top`,`color`,`shadx`,`shady`,`shadrad`,`postcard`,`vl`,`vp`,`np`,`nl`,`post_id`) 
	VALUES
	('$login','$text','$category','$left','$top','$color','$shadx','$shady','$shadrad','$postcard','$vl','$vp','$np','$nl','$post_id')
	");


	for($i=1; $i<=$size; $i++)
	{
		$img = $img_names[$i];
		$left = $img_left[$i];
		$top = $img_top[$i];
		$height = $img_height[$i];
		$width = $img_width[$i];
		
		$img_insert=mysql_query
		(
			"INSERT INTO `images` (`login`,`img`,`left`,`top`,`card_id`,`width`,`height`) VALUES ('$login','$img','$left','$top','$post_id','$width','$height')"
		);
	}

	$post_id++;
	$asd=mysql_query("UPDATE `config` SET `post_id`='$post_id' WHERE `id`=1 ");

	if($insert)
	{
		echo 
		'<script type="text/javascript">showstickergood();</script>';
	}
	else
	{
		echo '<script type="text/javascript">showstickerbad();</script>';
	}
	echo mysql_error();
}
?>