function register()
{
//�������� ���������
var login = $('#reglogin').val();
var password= $("#regpassword").val();
var repassword=$("#reregpassword").val();
var cap=$("#regcap").val();

  // �������� �������
       $.ajax({
                type: "POST",
                url: "reg/register.php",
                data: "login="+login+"&password="+password+"&repassword="+repassword+"&cap="+cap,
                // ������� �� ��� ������ PHP
                success: function(html)
				{
				//�������������� ������� ������ ������� ��������
        		                $("#regresult").empty();
					$("#regcap").val("");
					load_cap();
					//� ������� ����� php �������
					show_res(html);
				}
        });

}

function login()
{
//�������� ���������
var login = $('#login').val()
var password = $('#password').val()
  // �������� �������
       $.ajax({
                type: "POST",
                url: "reg/login.php",
                data: "login="+login+"&password="+password,
                // ������� �� ��� ������ PHP
                success: function(html) {
				//�������������� ������� ������ ������� ��������
				show_res(html);
                }
        });

}











