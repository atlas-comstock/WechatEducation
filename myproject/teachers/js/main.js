var curr=0;
var total=5;
$(document).ready(function(){
	$("#comm_form").hide();
	$(".comment").hide("fast");
	$("#load_more").click(
	function(){
		alert("hello moto");
	}
	);
	$("input[id=showhide]").click(
	function(){
		var commid = $(this).attr("ref");
		$("div[ref="+commid+"]").toggle("fast");
	}
	);
	$("#get_comm_form").click(
		function(){
			 $("#comm_form").show();
		}
	);
});


