var changePicture = function() {
	$user_name = document.getElementById("User_Name").value;
	$user_pwd = document.getElementById("User_Pwd").value;
	if ($user_name == '123') {
		alert("用户名不存在");
		return false;
	}
	if ($user_pwd == '123') {
		alert("密码不正确");
		return false;
	}
	return true;
}
