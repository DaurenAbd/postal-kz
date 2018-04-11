<?php
header('Content-Type: text/html; charset=cp1251');
function is_empty($s)
{
	if(empty($s))return "Не указано";
	else return $s;
}
include("../bd.php");
session_start();
if(isset($_POST['login']))
{
	$forlogin=$_POST['login'];
}

$login=$_SESSION['login'];
$res=mysql_query("SELECT * FROM `users` WHERE `login`='$forlogin' ");
$user_data=mysql_fetch_array($res);

if(empty($user_data['login']))die("<b>Такого пользователя не существует!</b>");

if($login==$forlogin)$host=true;
else $host=false;

?>
<input type="hidden" id="userlogin" value="<?php echo $login;?>" />


<script type="text/javascript" src="js/fileuploader.js"></script>

<script>
$(document).ready(function() {
      var button = $('#uploadButton');
      $.ajax_upload(button, {
            action : 'editor/changeavatar.php',
            name : 'avatar',
            onSubmit : function(file, ext) {
              // показываем картинку загрузки файла
		$("#uploadButton").empty();
        $("#uploadButton").append('<img src=img/loading.gif />');

              /*
               * Выключаем кнопку на время загрузки файла
               */
             this.disable();

            },
            onComplete : function(file, response) {
			$("#uploadButton").empty();
              $("#uploadButton").append('Загрузить');
              // снова включаем кнопку
              	this.enable();
				
		var login=$("#userlogin").val();

		jQuery("#images").fadeOut(); 
		showprof(login);
		jQuery("#images").fadeIn(); 
            }
          });
    });
function good()
{
	$.stickr({note:
	"Успешно обновлено!",className:'classic'})
}
function bad()
{
	$.stickr({note:
	"Ошибка! Обратитесь к администратору",className:'classic'})
}
function mess(text)
{
	$.stickr({note:
	text,className:'classic'})
}
function editprof()
{
	var login=$("#userlogin").val();
	var name=$("#name").val();
	var surname=$("#surname").val();
	var from=$("#from").val();
	var birthday=$("#birthday").val();
	 $.ajax(
	   {
                type: "POST",
                url: "editor/editprof.php",
                data: "name="+name+"&surname="+surname+"&from="+from+"&birthday="+birthday,
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#images").append(html);
					showprof(login);
                }
        }
		);
}
function changepass()
{
	var login=$("#userlogin").val();
	var oldpass=$("#oldpass").val();
	var newpass=$("#newpass").val();
	var newrepass=$("#newrepass").val();
	 $.ajax(
	   {
                type: "POST",
                url: "editor/changepass.php",
                data: "oldpass="+oldpass+"&newpass="+newpass+"&newrepass="+newrepass,
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#images").append(html);
					showprof(login);
                }
       		 }
		);
}

</script>

<style>
#avatardiv
{
	border:1px solid orange;
}
#uploadButton
{
padding:5px;
font-weight:bold;
text-align:center;
background:#f2f2f2;
color:#3366cc;
border:1px solid #ccc;
width:140px;
}
#save
{
	border:1px solid silver;
	padding:3;
	font-size:12;
}
#save:hover
{
	background:silver;
	cursor:pointer;
}
</style>
<div id="profile">

<center>
<div id="ava">
<img src="avatars/<?php echo $user_data['avatar'];?>" id="avatardiv"/>
</div>

<br>
<?php
if($host)
{
?>
 <button id="uploadButton">
            <font>Загрузить</font>
        </button>
<?php
}
?>
</center>

<form action="javascript:editprof();">
<table cellspacing=15 id="profpage">
<tr>
<td>
<b>Имя:</b>
</td><td width=30></td><td>
<?php
if($host) echo "<input type='text' id='name' value='";
echo is_empty($user_data['name']);
if($host) echo "' />";
?>
</td></tr>
<tr><td>
<b>Фамилия:</b></td><td width=30></td><td>
<?php
if($host) echo "<input type='text' id='surname' value='";
echo is_empty($user_data['surname']);
if($host) echo "' />";
?>
</td></tr>
<tr><td>
<b>Город:</b></td><td width=30></td><td>
<?php
if($host) echo "<input type='text' id='from' value='";
echo is_empty($user_data['from']);
if($host) echo "' />";
?>
</td></tr>
<tr><td>
<b>Дата рождения:</b></td><td width=30></td><td>
<?php 
if($host) echo "<input type='text' id='birthday' value='";
echo is_empty($user_data['birthday']);
if($host) echo "' />";
?>
</td></tr>
<?php
if($host)
{
?>
<tr>
<td></td><td><input type="submit" value="Сохранить" id="save"></td>
</tr>
<?php
}
?>
</table>
</form>

<?php
if($host)
{
?>
<form action="javascript:changepass();">
<table id="profpage" cellspacing=15><tr><td>
<?php
	echo "<b><u>Сменить пароль</u></b>";
	?>
	</td><td></td></tr>
	<tr>
	<td>
	<b>Старый пароль:</b>
	</td>
	<td width=30></td>
	<td>
	<input type="password" id="oldpass">
	</td>
	</tr>
	<tr>
	<td>
	<b>Новый пароль:</b>
	</td>
	<td width=30></td>
	<td>
	<input type="password" id="newpass">
	</td>
	</tr>
	<tr>
	<td>
	<b>Еще раз:</b>
	</td>
	<td width=30>
	
	</td>
	<td>
	<input type="password" id="newrepass">
	</td>
	</tr>
	<tr>
<td></td><td><input type="submit" value="Сохранить" id="save"></td>
</tr>
	</table>
	</form>
	<?php
}
?>
</div>