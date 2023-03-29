
$(document).ready(function(){
	var selectid="";
	var Row = document.getElementById("table");
	var Cells = Row.getElementsByTagName("tr");
	var Cells1 = Cells[14].getElementsByTagName("td");
	var Cells2 = Cells[1].getElementsByTagName("td");
	var first = Cells2[0].id;
	var last = Cells1[7].id;

	function request(){
	jQuery.ajax({
		url:     "/wp-content/themes/urist/checkdays.php",
                type:     "POST", 
                dataType: "html", 
                data: {data: first.slice(0, 9)+'000000',
                data1: last
                },
                success: function(response) {
				  console.log(response);
					var str = response.slice(0, response.length-1)
					var arr = str.split(';');
					arr.forEach(function(item, i, arr) {
							var date = item.slice(0, 8)+'T'+item.slice(8, item.length);
							try{
							document.getElementById(date).attributes["class"].value = "busy";}
							catch{}
					});
                },
                error: function(response) { 
                    document.getElementById(result_id).innerHTML = "Ошибка при отправке формы";
                }
	})};
			
	request();
	
	$("td").click(function(){
		if ($(this).attr("class") != "busy")
		{
			$(".date").val($(this).attr("id"));
			console.log("Время свободно");
			selectid = $(this).attr("id");
			$(".formreview").show();
			$("#table").hide();
		}
	});
	
	$("#cancel").click(function(){
		request();
		$(".formreview").hide();
		$("#table").show();
	});
	
	
	$("#formreview").submit(
		function()
		{ 
		var dataform = $("#formreview").serialize(); 
		jQuery.ajax({
			url:     "send.php",
			type:     "POST", 
            dataType: "html", 
            data: dataform,
            success: function(response) 
			{
				$('#formreview').trigger( 'reset' );
				request();
				$(".formreview").hide();
				$("#table").show();
				// console.log(response);
			},
            error: function(response) 
			{ 
                console.log("Ошибка при отправке формы");
				
            }
		})
		});
 });
