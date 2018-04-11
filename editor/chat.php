<script>

	loadmesses();
	window.setInterval("loadmesses();", 10000);
	function send()
	{
		var shouttext=$("#shoutmess").val();
		// �������� �������
       $.ajax({
                type: "POST",
                url: "editor/sendmess.php",
                data: "mess="+shouttext,
                // ������� �� ��� ������ PHP
                success: function(html)
				{
					$("#shoutmesses").append(html);
					messform.reset();
					loadmesses();
                }
        });
	}
	function loadmesses()
	{
		  // �������� �������
       $.ajax({
                type: "POST",
                url: "editor/loadmesses.php",
                data: "request=true",
                // ������� �� ��� ������ PHP
                success: function(html)
				{
					$("#shoutmesses").empty();
					$("#shoutmesses").append(html);
					document.getElementById('shoutmesses').scrollTop = 9999;
                }
        });
	}
	
	function delshoutmess(myid)
	{
		function sure_del()
		{
			if(confirm("�� ������������� ������ ������� ���������?"))
		{
			return true;
		}
			else return false;
		}
		if(sure_del())
		{
			// �������� �������
			$.ajax({
                type: "POST",
                url: "editor/delshoutmess.php",
                data: "myid="+myid,
                // ������� �� ��� ������ PHP
                success: function(html)
				{
					loadmesses();
                }
			});
			}
		}
		
		function userdelshoutmess(myid,user)
		{
			function sure_del()
			{
			if(confirm("�� ������������� ������ ������� ���������?"))
			{
				return true;
			}
				else return false;
			}
		if(sure_del())
		{
			// �������� �������
			$.ajax({
                type: "POST",
                url: "editor/userdelshoutmess.php",
                data: "myid="+myid+"&login="+user,
                // ������� �� ��� ������ PHP
                success: function(html)
				{
					loadmesses();
                }
				});
			}
		}
	</script>
	<style>
	#even
	{
		background:#DCDCDC;
	}
	#odd
	{
		background:#E0FFFF;
	}
	#shoutmesses
	{
		height:100px;
		overflow:auto;
	}
	#shoutbox
	{
		border:1px solid orange;
		width:508;
		padding:10;
		word-wrap:break-word;
		background:#E0FFFF;
	}
	#sendbutton
	{
		border:1px solid silver;
		padding:3;
		font-size:12;
	}
	#sendbutton:hover
	{
		background:silver;
		cursor:pointer;
	}
	.toprof
	{
		cursor:pointer;
	}
	.toprof:hover
	{
		color:red;
	}
	</style>
	<b>�����������, ���������, ���������</b>
	<p>&nbsp;</p>
<div id="shoutbox">
<div id="shoutmesses">
</div>
<br>
<hr size=1 color=orange>
<br>
<form action="javascript:send();" id="messform">
<input type="text" id="shoutmess" name="shoutmess" style="width:250px;">
<input type="submit" style="padding:1px;" value="���������" id="sendbutton">
</form>
</div>
