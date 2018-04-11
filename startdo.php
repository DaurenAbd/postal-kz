<script>
var array = [];
</script>

<?php

session_start();
if(!isset($_SESSION['login']) || !isset($_SESSION['id']))header("Location: index.php");

//Если отсутствует id шаблона или он не является числом
if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
	die("Hacking attempt!");
}

//Вырезаем все опасное из id шаблона который нам передается
include("bd.php");
$myid=$_GET['id'];
$myid=trim(strip_tags(htmlspecialchars($myid)));

$res=mysql_query("SELECT * FROM `templates` WHERE `id`='$myid' ");
$tempdata=mysql_fetch_array($res);
$name=$tempdata['postcard'];

if(empty($name) || $name=="" || $name==" ")
{
	die("Такого шаблона не существует!");
}
?>

<html>
<title></title>
<head>



<input type="hidden" id="maindivcolor" value="87cefa"/>
<link rel="stylesheet" href="css/colorpicker.css">

<style>
body
{
	background-image:url("<?php echo "temps/postcards/".$tempdata['postcard']; ?>");
	background-size:cover;
}
#editor
{
	width:350;
	background:E1FAB8;
	z-index:100;
	position:absolute;
	padding-top:25;
	display:none;
	cursor:move;
}
#text
{
	position:absolute;
	z-index:100;
}
.stick
{
	background:E1FAB8;
	padding:10;
	border:solid green 1px;
}
#closewindow
{
  	cursor: pointer;
}
#main
{
	-moz-user-select: -moz-none;
	-o-user-select: none;
	-khtml-user-select: none;
	-webkit-user-select: none;
	user-select: none;
}
#colorpick
{
	background:E1FAB8;
	z-index:100;
	position:absolute;
	display:none;
}
#handler
{
	height:25px;
	cursor:move;
}
#editshadow
{
	background:E1FAB8;
	z-index:100;
	position:absolute;
	display:none;
	padding:10;
	cursor:move;
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
#panelbar
{
	background:87cefa;
	position:absolute;
	padding:10;
	padding-top:20;
	z-index:100;
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
</style>

<!-- Подключаем jquery!-->

<link rel="stylesheet" href="css/jquery.css" />
<script src="js/fromjquerycom.js"></script>
<script src="js/fromjquerycomui.js"></script>


<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
	
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="js/fileuploader.js"></script>

<!-- Плагин для перетаскивания!-->
<script type="text/javascript" src="js/ui.multidraggable.js"></script>

<!-- Плагин всплывающих подсказок!-->
<script type="text/javascript" src="js/jquery.stickr.min.js"></script>

<!-- Плагин выбора цвета!-->
<script type="text/javascript" src="js/colorpick.js"></script>

<!-- Наша функция для переноса main!-->
<script type="text/javascript" src="js/movemain.js"></script>

<!-- Функция создания стикера!-->
<script type="text/javascript">
function showstickergood()
{
	$.stickr({note:
	'Успешно сохранено! Переадресация...<meta http-equiv="Refresh" content="2; URL=home.php?act=close">',className:'classic'});
}
function showstickerbad()
{
	$.stickr({note:
	'Не удалось сохранить. Обратитесь к администратору!',className:'classic error',sticked:true});
}
</script>

<!-- Функция для блока editor для перетаскивания!-->
<script type="text/javascript">

var t=0;

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
		$("#editradius").multidraggable();
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
function hideshoweditor()
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
function hideshowradius()
{
	$('#editradius').toggle('slow');
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


$(document).ready(function(){
$('#vl').keypress(function(e) {
if (!(e.which>47 && e.which<58)) return false;
});
$('#vp').keypress(function(e) {
if (!(e.which>47 && e.which<58)) return false;
});
$('#np').keypress(function(e) {
if (!(e.which>47 && e.which<58)) return false;
});
$('#nl').keypress(function(e) {
if (!(e.which>47 && e.which<58)) return false;
});

});


</script>


<script type="text/javascript">
$(function()
	{
		
		$('#main').mousemove(function(){
			var c=document.getElementById("main").getBoundingClientRect();
			document.getElementById("marleft").value=c.left;
			document.getElementById("martop").value=c.top;
		});
	});
	
	$(document).ready(function(){
			$('#colorpickerHolder').ColorPicker({flat: true});
	});
</script>

<script type="text/javascript">
function save()
{

//Получаем параметры
var text = document.getElementById("main").innerHTML;


var myid = $("#myid").val();
var left = $("#marleft").val();
var top  = $("#martop").val();
var color= $(".colorpicker_hex input").val();
var shadx= $("#shadx").val();
var shady= $("#shady").val();
var shadrad= $("#shadradius").val();
var vl=$("#vl").val();
var vp=$("#vp").val();
var np=$("#np").val();
var nl=$("#nl").val();

var str = "";
var cnt = 0;
for (var i=1; i <= t; ++i)
{
	//img_names[i] = $(".ntd"+i).val();
	//img_left[i] = $(".left"+i).val();
	//img_top[i] = $(".top"+i).val();
	//"&img1=123123.png&img1top=12&img1left=234&img2="
	 if (array["d"+i]==true)
	  ++cnt;
	 else
	  str += "&img" + (i-cnt) + "=" + $(".ntd" + i).val() + "&img" + (i-cnt) + "top=" + $(".topd" + i).val() + "&img" + (i-cnt) + "left=" + $(".leftd" + i).val() + "&img" + (i - cnt) + "height=" + $(".heightd" + i).val() + "&img" + (i - cnt) + "width=" + $(".widthd"+i).val();

}

var postwidth=document.body.clientWidth;
var postheight=document.body.clientHeight;

var left=(left/postwidth)*100;
var top=(top/postheight)*100;

var text = text.replace( /&/g, "[{~~}]" );

if(shadx=='' || shadx==' ')shadx=0;
if(shady=='' || shady==' ')shady=0;
if(shadrad=='' || shadrad==' ')shadrad=0;
	
  // Отсылаем паметры
       $.ajax({
                type: "POST",
                url: "editor/save.php",
                data: 
				"text="+text+"&myid="+myid+"&left="+left+"&top="+top+
				"&color="+color+"&shadx="+shadx+"&shady="+shady+"&shadrad="+shadrad+"&vl="+vl+"&vp="+vp+"&np="+np+"&nl="+nl+"&size="+(t-cnt)+str,
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#result").empty();
					$("#result").append(html);
                }
        });

}
</script>


</head>

<input type="hidden" id="marleft" value="20" />
<input type="hidden" id="martop" value="10" />
<input type="hidden" value="<?php echo $_GET['id'];?>" name="myid" id="myid" />

<div id="panelbar">

<input type="button" id="panelbut" value="Редактор текста" onClick="hideshoweditor();">
<input type="button" id="panelbut" value="Цвет блока" onClick="hideshowcolor();">
<input type="button" id="panelbut" value="Настройки тени" onClick="hideshowshadow();">
<input type="button" id="panelbut" value="Закруглить края" onClick="hideshowradius();">
<input type="button" id="panelbut" class="upb" value="Залить картинку">

<input type="button" id="panelbut" value="Закрыть" onClick="window.close();">
<input type="button" id="panelbut" value="Сохранить" onClick="save();this.disabled='true';" id="savebut">

</div>

<div id="result"></div>

<div id="editor">
<img id="closewindow" src = "img/delete.png" align = "right" width = "20" onClick = "hideshoweditor();" />
<textarea name="text" id="text" style="resize: none">
Вы можете сами выбирать расположение блока. Просто передвиньте мышью!
</textarea>

<script type="text/javascript">
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
setTimeout('reload_div(CKEDITOR.instances.text.getData())', 200);
function reload_div(text)
            {
            //обновление информации в диве
            document.getElementById("main").innerHTML=text;
            //рекурсивный вызов
            setTimeout('reload_div(CKEDITOR.instances.text.getData())', 200);
            }

</script>



<script>

	function deleteimage (prid, prname)
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
					$("."+prname).remove();
					$(".div"+prname).remove();
					array[prname] = true;
                }				
        });
	}
	
	function add_div_image(iname,perdid)
	{
		++t;
		var img=iname;
		
		
		
		var k_name="d"+t;		
		var q = '"';
		$("body").append("<div id='res"+k_name+"' style='width:100px; height:100px;position:absolute;cursor:move;background-size:cover;background-image:url("+q+"user_images/"+iname+q+");' class='"+k_name+"'><img src='img/delete.png' style='cursor:pointer;position:absolute;margin-left:-20px;' onClick='deleteimage("+q+perdid+q+","+q+k_name+q+");'></div>");
		
		$('.'+k_name).multidraggable();
		
		$(function() {
				$('#res'+k_name).resizable();
		});
		
		$("body").append("<div class='div"+k_name+"'></div>");
		
		$(".div"+k_name).append("<input type='hidden' class='nt"+k_name+"' />");
		$(".nt"+k_name).val(img);
		$(".div"+k_name).append("<input type='hidden' class='top"+k_name+"'>");
		$(".div"+k_name).append("<input type='hidden' class='left"+k_name+"'>");
		$(".div"+k_name).append("<input type='hidden' class='height"+k_name+"'>");
		$(".div"+k_name).append("<input type='hidden' class='width"+k_name+"'>");
		
		$('.'+k_name).mousemove(function(){
			var left=$("."+k_name).offset().left;
			var top=$("."+k_name).offset().top;
			var width=$("."+k_name).width();
			var height=$("."+k_name).height();
			$(".left"+k_name).val(left);
			$(".top"+k_name).val(top);
			$(".height"+k_name).val(height);
			$(".width"+k_name).val(width);
		});
		
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
</script>

</div>

<div id="colorpick">
<img id="closewindow" src = "img/delete.png" align = "right" width = "20" onClick = "hideshowcolor();" />
<div id="handler"></div>
<div id="colorpickerHolder"></div>
</div>


<div id="editshadow">
<img id="closewindow" src = "img/delete.png" align = "right" width = "20" onClick = "hideshowshadow();" />
Сдвиг по x: <br><input type="text" style="width:40;" name="shadx" id="shadx" onKeyUp="changeshadow();" value='20'><br>
Сдвиг по y:	<br><input type="text" style="width:40;"  name="shady" id="shady" onKeyUp="changeshadow();" value='20'><br>
Радиус размытия: <br><input type="text" style="width:40;" name="shadradius" id="shadradius" onKeyUp="changeshadow();" value='30'><br>
</div>


<div id="editradius">
<img id="closewindow" src = "img/delete.png" align = "right" width = "20" onClick = "hideshowradius();" />
Верхний левый: <br> <input type="text" id="vl" style="width:40;" onKeyUp="changeradius();" value="0"> <br>
Верхний правый:<br><input type="text" id="vp" style="width:40;" onKeyUp="changeradius();" value="0"><br>
Нижний правый:<br> <input type="text" id="np" style="width:40;" onKeyUp="changeradius();" value="0"><br>
Нижний левый:  <br> <input type="text" id="nl" style="width:40;" onKeyUp="changeradius();" value="0"> <br>
</div>


<?php
$text='Вы можете сами выбирать расположение блока. Просто передвиньте мышью!';
$martop='10';
$marleft='20';
$color='87cefa';
$shadx='20';
$shady='20';
$shadrad='30';
$images_code='';

$htmlcode=file_get_contents("temps/index.php");
$htmlcode=str_replace("{images}",$images_code,$htmlcode);
$htmlcode=str_replace("{text}",$text,$htmlcode);
$htmlcode=str_replace("{martop}",$martop,$htmlcode);
$htmlcode=str_replace("{marleft}",$marleft,$htmlcode);
$htmlcode=str_replace("{color}",$color,$htmlcode);
$htmlcode=str_replace("{shadx}",$shadx,$htmlcode);
$htmlcode=str_replace("{shady}",$shady,$htmlcode);
$htmlcode=str_replace("{shadrad}",$shadrad,$htmlcode);

echo $htmlcode;
?>
</html>