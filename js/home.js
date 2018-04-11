function show_temps(cat)
{
  // Отсылаем параметры
       $.ajax(
	   {
                type: "POST",
                url: "editor/showtemps.php",
                data: "cat="+cat,
				beforeSend: function()
				{
						$("#wait").empty();
						$('#wait').html("<img src='img/loading.gif' border='0'/>")
				},
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#images").empty();
					document.getElementById("nowcat").value=cat;
					//и выводим ответ php скрипта	
                    $("#images").append(html);				
					$('#wait').empty();
                }
        }
		);
}
function myposts(login)
{
  // Отсылаем параметры
       $.ajax(
	   {
                type: "POST",
                url: "editor/myposts.php",
                data: "login="+login,
				beforeSend: function()
				{
						$("#wait").empty();
						$('#wait').html("<img src='img/loading.gif' border='0'/>")
				},
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#images").empty();
					$("#result").empty();
					//и выводим ответ php скрипта
                    $("#images").append(html);	
					$("#cats").empty();
					$('#wait').empty();
                }
        }
		);
}
function showcats()
{
	// Отсылаем параметры
       $.ajax(
	   {
                type: "POST",
                url: "editor/showcats.php",
                data: "req=true",
				beforeSend: function()
				{
						$("#wait").empty();
						$('#wait').html("<img src='img/loading.gif' border='0'/>")
				},
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#cats").empty();
					//и выводим ответ php скрипта
					$("#result").empty();
					$("#result").append("<b>Выберите категорию: </b><br>");	
                    $("#cats").append(html);	
					$("#images").empty();
					$('#wait').empty();
                }
        }
		);
}
function del(myid)
{
	var login=$("#namelogin").val();
	function sure_del()
	{
		if(confirm("Вы действительно хотите удалить открытку?"))
		{
			return true;
		}
		else return false;
	}
	if(sure_del())
	{
	// Отсылаем параметры
       $.ajax(
	   {
                type: "POST",
                url: "editor/delete.php",
                data: "myid="+myid,
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#result").empty();
					myposts(login);
					$("#result").append(html);
                }
        }
		);
	}
	else
	{
		
	}
}
function showindex()
{
	// Отсылаем параметры
       $.ajax(
	   {
                type: "POST",
                url: "editor/showindex.php",
                data: "req=true",
				beforeSend: function()
				{
						$("#wait").empty();
						$('#wait').html("<img src='img/loading.gif' border='0'/>")
				},
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#cats").empty();
					$("#result").empty();
					$("#images").empty();
					$("#images").append(html);
					$('#wait').empty();
                }
        }
		);
}
function showprof(login)
{
	// Отсылаем параметры
       $.ajax(
	   {
                type: "POST",
                url: "editor/showprofile.php",
                data: "login="+login,
				beforeSend: function()
				{
						$("#wait").empty();
						$('#wait').html("<img src='img/loading.gif' border='0'/>")
				},
                // Выводим то что вернул PHP
                success: function(html)
				{
					$("#cats").empty();
					$("#result").empty();
					$("#images").empty();
					$("#images").append(html);
					$('#wait').empty();
                }
        }
	);
}
function deltemplate(myid)
{
	function sure_del()
	{
	if(confirm("Вы действительно хотите удалить этот шаблон?"))
	{
			return true;
	}
	else return false;
	}
	
	if(sure_del())
	{
		var cat=$("#nowcat").val();
	// Отсылаем параметры
       $.ajax(
	   {
                type: "POST",
                url: "admin/pages/actions/deltemplate.php",
                data: "myid="+myid,
				beforeSend: function()
				{
						$("#wait").empty();
						$('#wait').html("<img src='img/loading.gif' border='0'/>")
				},
                // Выводим то что вернул PHP
                success: function(html)
				{
					$('#wait').empty();
					
					$("#messes").empty();
                        $("#messes").append(html);	
						$("#messes").toggle();
						setTimeout(function(){
						$("#messes").hide('blind', {}, 400)
						}, 4000);
						show_temps(cat);
                }
        }
		);
	}
}
function showmess(mess)
{
	$.stickr({note:
	mess,className:'classic'})
}