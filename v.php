<?php
if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
	die("Hacking!");
}
$myid=$_GET['id'];
$myid=trim(strip_tags(htmlspecialchars($myid)));

include("bd.php");
$res=mysql_query("SELECT * FROM `postcards` WHERE `id`='$myid' ");
$data=mysql_fetch_array($res);

$name=$data['postcard'];
$result=mysql_query("SELECT * FROM `templates` WHERE `postcard`='$name' ");
$temp_data=mysql_fetch_array($result);

$fon=$temp_data['postcard'];
$text=htmlspecialchars_decode($data['text']);
$text=preg_replace("/\~\[\[odKav\~/","\'",$text);

$martop=$data['top'];
$marleft=$data['left'];
$color=$data['color'];
$shadx=$data['shadx'];
$shady=$data['shady'];
$shadrad=$data['shadrad'];
$vl=$data['vl'];
$vp=$data['vp'];
$np=$data['np'];
$nl=$data['nl'];
$card_id=$data['post_id'];

$q='"';
$r=mysql_query("SELECT * FROM `images` WHERE `card_id`='$card_id' ");
$images_code='';
while($c=mysql_fetch_array($r))
{
	$images_code .="<div style='width:".$c['width']."px;height:".$c['height']."px;position:absolute;background-size:cover;background-image:url(".$q."user_images/".$c['img'].$q.");margin-top:".$c['top']."; margin-left:".$c['left'].";'> </div>";
}


$htmlcode=file_get_contents("temps/index.php");
$htmlcode=str_replace("{images}",$images_code,$htmlcode);
$htmlcode=str_replace("{text}",$text,$htmlcode);
$htmlcode=str_replace("{martop}",$martop,$htmlcode);
$htmlcode=str_replace("{marleft}",$marleft,$htmlcode);
$htmlcode=str_replace("{color}",$color,$htmlcode);
$htmlcode=str_replace("{shadx}",$shadx,$htmlcode);
$htmlcode=str_replace("{shady}",$shady,$htmlcode);
$htmlcode=str_replace("{shadrad}",$shadrad,$htmlcode);
$htmlcode=str_replace("{vl}",$vl,$htmlcode);
$htmlcode=str_replace("{vp}",$vp,$htmlcode);
$htmlcode=str_replace("{np}",$np,$htmlcode);
$htmlcode=str_replace("{nl}",$nl,$htmlcode);
?>
<style>
body
{
	background-image:url("temps/postcards/<?php echo $fon;?>");
	background-size:cover;
}
</style>
<?php
echo $htmlcode;
?>