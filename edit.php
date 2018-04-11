<!-- Подключаем jquery!-->


<link rel="stylesheet" href="css/jquery.css" />
<script src="js/fromjquerycom.js"></script>
<script src="js/fromjquerycomui.js"></script>

<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>

<?php
if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
	die("Hacking!");
}
session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['id']))header("Location: index.php");
include("bd.php");
$myid=trim(strip_tags(htmlspecialchars($_GET['id'])));

$res=mysql_query("SELECT * FROM `postcards` WHERE `id`='$myid' ");
$user_post_data=mysql_fetch_array($res);

if($user_post_data['login']!=$_SESSION['login'])
{
	die("Это не ваша открытка!");
}

$name=$user_post_data['postcard'];
$result=mysql_query("SELECT * FROM `templates` WHERE `postcard`='$name' ");
$temp_data=mysql_fetch_array($result);

$text=$user_post_data['text'];
$martop=$user_post_data['top'];
$marleft=$user_post_data['left'];
$color=$user_post_data['color'];
$shadx=$user_post_data['shadx'];
$shady=$user_post_data['shady'];
$shadrad=$user_post_data['shadrad'];
$vl=$user_post_data['vl'];
$vp=$user_post_data['vp'];
$np=$user_post_data['np'];
$nl=$user_post_data['nl'];
$card_id=$user_post_data['post_id'];

$r=mysql_query("SELECT * FROM `images` WHERE `card_id`='$card_id' ");
$images_code='';
$s='';
$q='"';
$apply = '';
while($c=mysql_fetch_array($r))
{
	$s .=$c['id']."#";
	$q = '"';
    echo '<input type = "hidden" class = "dleft'.$c["id"].'" value="'.$c["left"].'" >';
	echo '<input type = "hidden" class = "dtop'.$c["id"].'" value="'.$c["top"].'" >';
	echo '<input type = "hidden" class = "dheight'.$c["id"].'" value="'.$c["height"].'" >';
	echo '<input type = "hidden" class = "dwidth'.$c["id"].'" value="'.$c["width"].'" >';
	
	
	$images_code .="<div class = 'img".$c['id']."' onMouseMove='update_coord(".$q.$c['id'].$q.");' style='width:".$c['width']."px;height:".$c['height']."px;position:absolute;background-size:cover;background-image:url(".$q."user_images/".$c['img'].$q."); margin-top:".$c['top']."; margin-left:".$c['left'].";'><img src='img/delete.png' style='cursor:pointer;position:absolute;margin-left:-20px;' onClick = 'deleteimageOld(".$q.$c['id'].$q.")'></div>";
	$apply .= "<script>$('.img".$c['id']."').multidraggable(); $('.img".$c['id']."').resizable();</script>";
}
echo "<input type='hidden' class='ides' value='".$s."' />";


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

<html>
<title></title>
<head>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>


<input type="hidden" id="maindivcolor" value="<?php echo $color;?>"/>
<style>
body
{
	background-image:url("<?php echo "temps/postcards/".$temp_data['postcard']; ?>");
	background-size:cover;
}
#closewindow:hover
{
	cursor:pointer;
}
#editor
{
	background:E1FAB8;
	z-index:500;
	width:350;
	position:absolute;
	padding:5;
	padding-top:25;
	display:none;
	cursor:move;
}
#text
{
	position:absolute;
	z-index:500;
}
.stick
{
	background:E1FAB8;
	padding:10;
	border:solid green 1px;
}
#colorpick
{
	background:E1FAB8;
	z-index:10;
	position:absolute;
	display:none;
}
#handler
{
	height:25px;
	cursor:move;
}
#main
{
	-moz-user-select: -moz-none;
	-o-user-select: none;
	-khtml-user-select: none;
	-webkit-user-select: none;
	user-select: none;
}
#editshadow
{
	background:E1FAB8;
	z-index:10;
	position:absolute;
	display:none;
	padding:10;
	cursor:move;
}
#panelbar
{
	background:87cefa;
	position:absolute;
	padding:10;
	padding-top:20;
	z-index:0;
	cursor:move;
}
#panelbut
{
	border:1px solid silver;
	padding:3;
}
#panelbut:hover
{
	cursor:pointer;
	background:silver;
}
#editradius
{
	background:E1FAB8;
	z-index:100;
	position:absolute;
	display:none;
	padding:10;
	cursor:move;
}
</style>
<link rel="stylesheet" href="css/colorpicker.css">


<script type="text/javascript" src="js/fileuploader.js"></script>

<!-- Плагин для перетаскивания!-->
<script type="text/javascript" src="js/ui.multidraggable.js"></script>

<!-- Плагин всплывающих подсказок!-->
<script type="text/javascript" src="js/jquery.stickr.min.js"></script>

<!-- Наша функция для переноса main!-->
<script type="text/javascript" src="js/movemain.js"></script>

<!-- Плагин выбора цвета!-->
<script type="text/javascript" src="js/colorpick.js"></script>



<script>
function update_coord(myid)
{
	var left=$(".img"+myid).offset().left;
	var top=$(".img"+myid).offset().top;
	var width=$(".img"+myid).width();
	var height=$(".img"+myid).height();
	
	$("."+"dtop"+myid).val(top);
	$("."+"dleft"+myid).val(left);
	$("."+"dwidth"+myid).val(width);
	$("."+"dheight"+myid).val(height);
}
</script>

<!-- Функция создания стикера!-->
<script type="text/javascript">
function showstickergood()
{
	$.stickr({note:
	'Успешно сохранено!',className:'classic'});
}
function showstickerbad()
{
	$.stickr({note:
	'Не удалось сохранить. Обратитесь к администратору!',className:'classic error',sticked:true});
}
</script>

<!-- Функция для блока editor для перетаскивания!-->
<script type="text/javascript">
	$(function()
	{
		$("#editradius").multidraggable();
	});
	$(function()
	{
		$("#editor").multidraggable();
	});
	
	$(function()
	{
		$("#editshadow").multidraggable();
	});
	
	$(function()
	{
		$("#panelbar").multidraggable();
	});
	
	$(document).ready(function() {
    $('#colorpick').multidraggable();
	var handle = $( "#colorpick" ).multidraggable( "option", "handle" );
	$( '#colorpick' ).multidraggable( "option", "handle", '#handler' );
	});
</script>

<!-- Функция сворачивания\разворачивания блока editor!-->	
<script type="text/javascript">
function hideshowradius()
{
	$('#editradius').toggle('slow');
}

function hideshow()
{
      $('#editor').toggle('slow');
}
function hideshowcolor()
{
	$('#colorpick').toggle('slow');
}
function hideshowshadow()
{
	$('#editshadow').toggle('slow');
}
function changeradius()
{
	var vl=$("#vl").val();
	var vp=$("#vp").val();
	var np=$("#np").val();
	var nl=$("#nl").val();
	
	if(vl=='')vl=0;
	if(vp=='')vp=0;
	if(np=='')np=0;
	if(nl=='')nl=0;

	var obj= document.getElementById("main").style;
		
	obj.borderRadius=vl+"px "+vp+"px "+np+"px "+nl+"px";
	obj.MozBorderRadius=vl+"px "+vp+"px "+np+"px "+nl+"px";
	obj.WebkitBorderRadius=vl+"px "+vp+"px "+np+"px "+nl+"px";

}
function changeshadow()
{
	var x=$("#shadx").val();
	var y=$("#shady").val();
	var rad=$("#shadradius").val();
	
	if(x=='' || x==' ')x=0;
	if(y=='' || y==' ')y=0;
	if(rad=='' || rad==' ')rad=0;
	
	if(x>500)return false;
	if(y>500)return false;
	if(rad>500)return false;
	
	document.getElementById('main').style.MozBoxShadow = x+'px '+y+'px '+rad+'px '+'#969696';
	document.getElementById('main').style.BoxShadow = x+'px '+y+'px '+rad+'px '+'#969696';
	document.getElementById('main').style.WebkitBoxShadow = x+'px '+y+'px '+rad+'px '+'#969696';
}

$(document).ready(function(){
$('#shadx').keypress(function(e) {
if (!(e.which>47 && e.which<58)) return false;
});
$('#shady').keypress(function(e) {
if (!(e.which>47 && e.which<58)) return false;
});
$('#shadradius').keypress(function(e) {
if (!(e.which>47 && e.which<58)) return false;
});
});
</script>

<!-- Функция переноса текста из поля ввода в блок!-->
<script type="text/javascript">
$(function()
	{
		$('#main').mousemove(function(){
			var c=document.getElementById("main").getBoundingClientRect();
			document.getElementById("marleft").value=c.left;
			document.getElementById("martop").value=c.top;
		});
	});
</script>

<script type="text/javascript">
function save()
{
//Получаем параметры
var text = document.getElementById("main").innerHTML;
var myid = $("#myid").val();
var left = $("#marleft").val();
var top =  $("#martop").val();
var color= $(".colorpicker_hex input ").val();
var shadx= $("#shadx").val();
var shady= $("#shady").val();
var shadrad= $("#shadradius").val();
var vl=$("#vl").val();
var vp=$("#vp").val();
var np=$("#np").val();
var nl=$("#nl").val();

	var getid = $(".ides").val ();
	var arrid;
	var givestr = "";
	var topx = 0;
	var leftx = 0;
	var len = getid.length;
	var curid = 0;
	var pos = 0;
	var hg = 100;
	var	wd = 100;
	
	for (var i = 0; i < len; ++i)
	{
	    if (getid[i] == '#')
		{
		    topx = $(".dtop"+curid).val();
			topy = $(".dleft"+curid).val();
			wd = $(".dwidth"+curid).val();
			hg = $(".dheight"+curid).val();
			 
			givestr += "&id"+pos+"="+curid+"&top"+pos+"="+topx+"&left"+pos+"="+topy+"&height"+pos+"="+hg+"&width"+pos+"="+wd;
			
			++pos;
			curid = 0;
			++i;
		}
		
		curid *= 10;
		curid += getid[i] - '0';
    }


var postwidth=document.body.clientWidth;
var postheight=document.body.clientHeight;

left=(left*100)/postwidth;
top=(top*100)/postheight;

var text = text.replace( /&/g, "[{~~}]" );

if(shadx=='' || shadx==' ')shadx=0;
if(shady=='' || shady==' ')shady=0;
if(shadrad=='' || shadrad==' ')shadrad=0;
  // Отсылаем паметры
       $.ajax({
                type: "POST",
                url: "editor/edit_save.php",
                data:
	"text="+text+"&myid="+myid+"&left="+left+"&top="+top+
	"&color="+color+"&shadx="+shadx+"&shady="+shady+"&shadrad="+shadrad+"&vl="+vl+"&vp="+vp+"&np="+np+"&nl="+nl+givestr+"&sizeparam="+pos,
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#result").empty();
					$("#result").append(html);
					location.reload();
                }
        });
}


$(document).ready(function()
	{
			$('#colorpickerHolder').ColorPicker({flat: true});
	});
	
</script>
</head>
<input type="hidden" id="marleft" value="<?php echo $marleft;?>" />
<input type="hidden" id="martop" value="<?php echo $martop;?>" />
<input type="hidden" value="<?php echo $_GET['id'];?>" name="myid" id="myid" />

<div id="panelbar">

<input type="button" id="panelbut" value="Редактор текста" onClick="hideshow();">
<input type="button" id="panelbut" value="Цвет блока" onClick="hideshowcolor();">
<input type="button" id="panelbut" value="Настройки тени" onClick="hideshowshadow();">
<input type="button" id="panelbut" value="Закруглить края" onClick="hideshowradius();">
<input type="button" id="panelbut" class="upb" value="Залить картинку">
<input type="button" id="panelbut" value="Закрыть" onClick="window.close();">
<input type="button" id="panelbut" value="Сохранить" onClick="save();">


</div>

<div id="result"></div>

<!-- Блок с полем ввода текста!-->
<div id="editor">
<img id="closewindow" src = "img/delete.png" align = "right" width = "20" onClick = "hideshow();" />

<textarea name="text" id="text">
<?php
echo $text;
?>
</textarea>

<script type="text/javascript">

function deleteimage (prid)
{
	    $.ajax({
                type: "POST",
                url: "editor/deleteimageNew.php",
                data: 
				"myid="+prid,
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#result").empty();
					$("#result").append(html);
					$(".img"+prid).remove();
					var str = $(".ides").val();
					str = str.replace("#"+prid, "");
					$(".ides").val(str);
                }				
        });
}
function deleteimageOld (prid)
{
	    $.ajax({
                type: "POST",
                url: "editor/deleteimageOld.php",
                data: 
				"myid="+prid,
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#result").empty();
					$("#result").append(html);
					$(".img"+prid).remove();
					var str = $(".ides").val();
					str = str.replace("#"+prid, "");
					$(".ides").val(str);
                }				
        });
}

function up_ides(old_id,new_id)
{
	var ides2=$(".ides").val();
	ides2=ides2.replace(old_id,new_id);
	$(".ides").val(ides2);
	
	var oldtext = $(".img"+old_id).html();
	oldtext = oldtext.replace ("deleteimage","deleteimageOld");
	oldtext = oldtext.replace (old_id, new_id);
	
	var newtext = $(".system_elements").html();
	newtext = newtext.replace (old_id, new_id);
	newtext = newtext.replace (old_id, new_id);
	$(".system_elements").html(newtext);
	
	$(".img"+new_id).html(oldtext);	
}

var button = $('.upb');
      $.ajax_upload(button, {
            action : 'editor/upload_image.php',
            name : 'ufile',
            onSubmit : function(file, ext) {
            },
            onComplete : function(file, response) {
			$.stickr({note:response,className:'classic'});
            }
          });
		  
		 function add_div_image(iname,myid)
		 {
			var getcurides = $(".ides").val();
			getcurides += myid + "#";
			$(".ides").val(getcurides);
			
			$("body").append("<input type = 'hidden' class = 'dtop"+myid+"' />");
			$("body").append("<input type = 'hidden' class = 'dleft"+myid+"' />");
			$("body").append('<input type = "hidden" class = "dheight'+myid+'" value="100" >');
			$("body").append('<input type = "hidden" class = "dwidth'+myid+'" value="100" >');
			
			
			var q = '"';
			$(".system_elements").append("<div class = 'img"+myid+"' onMouseMove='update_coord("+q+myid+q+");' style='width:100px;height:100px;position:absolute;background-size:cover;background-image:url("+q+"user_images/"+iname+q+");position:absolute; margin-top:0; margin-left:0;'><img src='img/delete.png' style='cursor:pointer;position:absolute;margin-left:-20px;' onClick='deleteimage("+q+myid+q+")'></div>");
			$(".dtop"+myid).val(0);
			$(".dleft"+myid).val(0);
			$(".img"+myid).multidraggable();
			$(".img"+myid).resizable();
		 }
		  
CKEDITOR.replace( 'text',
{
toolbar:
        [
            ['Link', 'Image'],
            ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
            ['RemoveFormat','FontSize'],
			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
			['Font'],
			[ 'TextColor','BGColor' ]
        ]
}
);
//CKEDITOR.instances.object_name.getData() --> тут хранится содержимое ckeditor объекта с именем object_name
setTimeout('reload_div()', 200);
function reload_div()
            {
            //обновление информации в диве
			var text=CKEDITOR.instances.text.getData();
            document.getElementById("main").innerHTML=text;
            //рекурсивный вызов
            setTimeout('reload_div()', 200);
            }
</script>
</div>

<div id="colorpick">
<div id="handler"><img id="closewindow" src = "img/delete.png" align = "right" width = "20" onClick = "hideshowcolor();" /></div>
<div id="colorpickerHolder"></div>
</div>

<div id="editshadow">
<img id="closewindow" src = "img/delete.png" align = "right" width = "20" onClick = "hideshowshadow();" />
Сдвиг по x: <br><input type="text" style="width:40;" name="shadx" id="shadx" onKeyUp="changeshadow();" value='<?php echo $shadx;?>'><br>
Сдвиг по y:	<br><input type="text" style="width:40;"  name="shady" id="shady" onKeyUp="changeshadow();" value='<?php echo $shady;?>'><br>
Радиус размытия: <br><input type="text" style="width:40;" name="shadradius" id="shadradius" onKeyUp="changeshadow();" value='<?php echo $shadrad;?>'><br>
</div>

<div id="editradius">
<img id="closewindow" src = "img/delete.png" align = "right" width = "20" onClick = "hideshowradius();" />
Верхний левый: <br> <input type="text" id="vl" style="width:40;" onKeyUp="changeradius();" value="<?php echo $vl;?>"> <br>
Верхний правый:<br><input type="text" id="vp" style="width:40;" onKeyUp="changeradius();" value="<?php echo $vp;?>"><br>
Нижний правый:<br> <input type="text" id="np" style="width:40;" onKeyUp="changeradius();" value="<?php echo $np;?>"><br>
Нижний левый:  <br> <input type="text" id="nl" style="width:40;" onKeyUp="changeradius();" value="<?php echo $nl;?>"> <br>
</div>

<?php
echo $htmlcode;
echo $apply;
?>
<div class="system_elements">
</div>

<script>
var c=document.getElementById("main").getBoundingClientRect();
	document.getElementById("marleft").value=c.left;
	document.getElementById("martop").value=c.top;
</script>

</html>










