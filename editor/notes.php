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
		"������� ���������!",className:'classic'})
	}
	function showbad()
	{
		$.stickr({note:
		"<center>������! <br>�������� �� ����������� <br>������������ �������!</center>",className:'classic'})
	}
	function savenote()
	{
		var note=$("#note").val();
		//�������� �������
			$.ajax({
                type: "POST",
                url: "editor/savenote.php",
                data: "note="+note,
                // ������� �� ��� ������ PHP
                success: function(html)
				{
					$("#shoutmesses").append(html);
                }
				});
	}
	function helpnote()
	{
		$("#helpes").append(" ����� �� ������ ������� ���� �������.  &nbsp;<br> ��� ����� �������� ������ �� ������ ��������.");
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
<b>��� �������:</b>
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
	echo "����� �� ������ ������� ���� �������.
	
������: '�� ������ ���������� ����� 1 ������.'

��� '���� ������������ ����� 13 ��������' ";
}
?>
</textarea>
<br>
<br>
<input type="button" id="savenote" onClick="savenote();" value="���������">