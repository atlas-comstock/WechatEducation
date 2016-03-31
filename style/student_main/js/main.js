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
//		var text = $("#showhide").val();
		var commid = $(this).attr("ref");
		$("div[ref="+commid+"]").toggle("fast");
//		switch(text){
//			case "收起":$(".comment").hide("fast");$("#showhide").val("回复");break;
//			case "回复":$(".comment").show("fast");$("#showhide").val("收起");break;
//			case "收起":$("div[ref="+commid+"]").val("回复").hide();break;
//			case "回复":$("div[ref="+commid+"]").toggle("fast");break;
//		}
	}
	);
	$("#get_comm_form").click(
		function(){
			 $("#comm_form").show();
		}
	);
});

