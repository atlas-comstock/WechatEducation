$(document).ready(function(){
	$("#comm_form").hide();
	var url = $("noscript").text();
	var curr=$("#load_more").attr("curr");
	var total=$("#load_more").attr("total");
	$("#load_more").click(
		function(){
			if (curr==total) {
				$("#load_more").hide();
			}else{
				curr++;
				if (curr==total)$("#load_more").hide();
				$("#load_more").attr("curr",curr);
				$.get(url+"index.php/communication/comm/take_more_topic?start="+curr+"&openid=os4ODuBQdQveaddXu2U1pmjLL6Uk",function(data,status){$("#all_topic").append(data);});
			}
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
				$("#comm_form").toggle();
			}
	);
	$("#submit_reply").click(
			function(){
				var openid = $("#submit_reply").attr('rel2');
				var quesid = $("#submit_reply").attr('rel');
				var title = $("#topic_title").val();
				var content = $("textarea[name=reply_content]").val();
				$.post("submit_answer?openid=os4ODuBQdQveaddXu2U1pmjLL6Uk",
						{
					openid:openid,
					quesid:quesid,
					topic:title,
					content:content
						}
				,function(data,status){
					alert(data);
					history.go(0);
				});
			}
	);
});

