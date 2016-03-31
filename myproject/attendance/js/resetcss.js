var changePicture = function() {
	var but = document.getElementById("but");
	but.innerHTML="<button id=\"btn3\" class=\"bota\">已签到</button>";
	
	var class_name= document.getElementById("cl_name").innerHTML;
	var time= document.getElementById("time").innerHTML;
	var sname= document.getElementById("stu_name").innerHTML;
	var sid= document.getElementById("stu_id").innerHTML;
		alert(class_name+time+sname+sid);
}
var changePct = function() {
	var but = document.getElementById("but");
	but.innerHTML="<button >停止</button>";
}
