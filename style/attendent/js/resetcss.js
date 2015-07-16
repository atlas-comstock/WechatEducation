var changePicture = function() {
	var but = document.getElementById("but");
	var lesson_name= document.getElementById("cl_name").innerHTML;
	var time= document.getElementById("time").innerHTML;
	var sname= document.getElementById("stu_name").innerHTML;
	var sid= document.getElementById("stu_id").innerHTML;
	var class_name= document.getElementById("class_name").value;
	var openid=document.getElementById("open_id").value;
	/*
	 * ajax部分
	 */
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {	
		  if(xmlhttp.responseText=="far"){
			  alert("距离当前发起考勤位置太远");
		  }else if(xmlhttp.responseText=="nocheck"){
			  alert("当前没有发起考勤");
		  }else if(xmlhttp.responseText=="success"){
			  alert("完成考勤");
			  but.innerHTML="<button id=\"btn3\" class=\"bota\">已签到</button>";
		  }
	    }
	  }
	xmlhttp.open("POST","index.php/attend/attendent/submitAttendent",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("lesson="+lesson_name+"&time="+time+"&sname="+sname+"&sid="+sid+"&class_name="+class_name+"&openid="+openid);
	/*
	 * ajax 结束
	 */
	
}
var changePct = function() {
	var but = document.getElementById("but");
	
	
	var lesson_name= document.getElementById("cl_name").innerHTML;
	var time= document.getElementById("time").innerHTML;
	var tid= document.getElementById("tea_id").value;
	var class_name= document.getElementById("class_name").value;
	/*
	 * ajax部分
	 */
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200){
//			  but.innerHTML="<button onclick='window.location.href=\'baidu.com\''>停止</button>";
			  but.innerHTML="<button onclick='checkAttendent();'>停止</button>";
		   }
	  }
	xmlhttp.open("POST","index.php/attend/attendent/startAttendent",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("lesson="+lesson_name+"&time="+time+"&tid="+tid+"&class_name="+class_name);
	/*
	 * ajax 结束
	 */
}

function checkAttendent(){
	var lesson_name= document.getElementById("cl_name").innerHTML;
	var time= document.getElementById("time").innerHTML;
	var class_name= document.getElementById("class_name").value;
	var tid= document.getElementById("tea_id").value;
	window.location.href='index.php/attend/attendent/take_attendent?tid='+tid+'&time='+time+'&lesson='+lesson_name+'&class_name='+class_name;
}
