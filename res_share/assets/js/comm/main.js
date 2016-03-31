var curr=0;
var total=5;
$(document).ready(function(){
	$("#comm_form").hide();
	$("#load_more").click(
	function(){
		alert("hello moto");
	}
	);
	$("#showhide").click(
	function(){
		var text = $("#showhide").val();
		switch(text){
			case "隐藏栏目":$(".channel_group").hide("fast");$("#showhide").val("显示栏目");break;
			case "显示栏目":$(".channel_group").show("fast");$("#showhide").val("隐藏栏目");break;
		}
	}
	);
	$("#get_comm_form").click(
		function(){
			 $("#comm_form").show();
		}
	);
});

