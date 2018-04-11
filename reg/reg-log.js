function register()
{
//Получаем параметры
var login = $('#reglogin').val();
var password= $("#regpassword").val();
var repassword=$("#reregpassword").val();
var cap=$("#regcap").val();

  // Отсылаем паметры
       $.ajax({
                type: "POST",
                url: "reg/register.php",
                data: "login="+login+"&password="+password+"&repassword="+repassword+"&cap="+cap,
                // Выводим то что вернул PHP
                success: function(html)
				{
				//предварительно очищаем нужный элемент страницы
        		                $("#regresult").empty();
					$("#regcap").val("");
					load_cap();
					//и выводим ответ php скрипта
					show_res(html);
				}
        });

}

function login()
{
//Получаем параметры
var login = $('#login').val()
var password = $('#password').val()
  // Отсылаем паметры
       $.ajax({
                type: "POST",
                url: "reg/login.php",
                data: "login="+login+"&password="+password,
                // Выводим то что вернул PHP
                success: function(html) {
				//предварительно очищаем нужный элемент страницы
				show_res(html);
                }
        });

}











