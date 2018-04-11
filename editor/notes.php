	<style>
	#savenote
	{
		border:1px solid silver;
		padding:3;
		font-size:12;
	}
	#savenote:hover
	{
		background:silver;
		cursor:pointer;
	}
	#note
	{
		border:1px solid orange;
	}
	</style>
	<script>
	function showgood()
	{
		$.stickr({note:
		"Успешно сохранено!",className:'classic'})
	}
	function showbad()
	{
		$.stickr({note:
		"<center>Ошибка! <br>Возможно Вы используете <br>некорректные символы!</center>",className:'classic'})
	}
	function savenote()
	{
		var note=$("#note").val();
		//Отсылаем паметры
			$.ajax({
                type: "POST",
                url: "editor/savenote.php",
                data: "note="+note,
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#shoutmesses").append(html);
                }
				});
	}
	function helpnote()
	{
		$("#helpes").append(" Здесь вы можете хранить свои заметки.  &nbsp;<br> Они будут доступны только из Вашего аккаунта.");
	}
	function clearhelpnote()
	{
		$("#helpes").empty();
		document.getElementById("helpes").style.borderTop="0px";
		document.getElementById("helpes").style.borderBottom="0px";
		document.getElementById("helpes").style.borderLeft="0px";
	}
	</script>
<br>
<br>
<b>Мои заметки:</b>
<p>&nbsp;</p>
<textarea id="note" cols=64 rows=8 onMouseOver="helpnote();" onMouseOut="clearhelpnote();">
<?php
$login=$_SESSION['login'];
$res=mysql_query("SELECT * FROM `notes` WHERE `login`='$login'");
$data=mysql_fetch_array($res);
$note=$data['note'];
echo $note;
if(empty($note))
{
	echo "Здесь вы можете хранить свои заметки.
	
Пример: 'Не забыть поздравить друга 1 января.'

Или 'День программиста будет 13 сентября' ";
}
?>
</textarea>
<br>
<br>
<input type="button" id="savenote" onClick="savenote();" value="Сохранить">