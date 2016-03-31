var changePicture = function() {
	$user_number = document.getElementById("User_Number").value;
	$user_name = document.getElementById("User_Name").value;
	if ($user_number == '123'||$user_name == '123') {
		alert("信息输入错误！");
		return false;
	}
	return true;
}
