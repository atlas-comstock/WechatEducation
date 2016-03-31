<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <base href="<?=base_url()?>">
        <title>账号绑定</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="style/bind/assets/css/reset.css">
        <link rel="stylesheet" href="style/bind/assets/css/supersized.css">
        <link rel="stylesheet" href="style/bind/assets/css/style.css">

        <!-- Javascript -->
        <script src="style/bind/assets/js/jquery-1.8.2.min.js"></script>
        <script src="style/bind/assets/js/supersized.3.2.7.min.js"></script>
        <script src="style/bind/assets/js/supersized-init.js"></script>
        <script src="style/bind/assets/js/scripts.js"></script>

    </head>

    <body>

        <div class="page-container">
            <div>
                <h1>账号绑定</h1>
            </div>
<form>
                <input type="text" name="user_stu_id" class="user_stu_id" id="user_stu_id" placeholder="用户名">
                <input type="password" name="user_password" class="user_password" id="user_password" placeholder="密码">
                <div class="stu_option">
                    <select id="user_power" name="user_power" class="select">
                        <option value="1">---請選擇您的身份--</option>
                        <option value="1">学生</option>
                        <option value="2">任课教师</option>
                        <option value="3">领导</option>
                        <option value="4">超级管理员</option>
                    </select>
                </div>
                <button type="submit" onclick="verify()">绑定</button>
                <div class="error"><span>+</span>
                </div>
</form>
        </div>
    </body>

<script>
var verify = function() {
    var open_id = <?php echo '"'.$open_id.'"'; ?>;
    var student_main = "http://av.jejeso.com/education/index.php/student_main/index/"+open_id;
    var user_stu_id = document.getElementById("user_stu_id").value;
    var user_password = document.getElementById("user_password").value;
    var user_power = document.getElementById("user_power").value;
    var xmlhttp;
    if (window.XMLHttpRequest)
    {//code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {//code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            if(xmlhttp.responseText == "HAVE_BIND") {
                alert("帐号已经绑定");
                window.location.href=student_main;
            }
            else if(xmlhttp.responseText == "NO_INFO")
                alert("【账号】或者【密码】错误");
            else {
                alert("绑定成功！");
                window.location.href=student_main;
            }
        }
    }
    xmlhttp.open("POST","index.php/bind/single_bind",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var post_data = 'open_id='+open_id+'&user_stu_id='+user_stu_id+'&user_password='+user_password+'&user_power='+user_power;
    xmlhttp.send(post_data);
    alert("欢迎使用微信教学平台");
}
</script>
</html>

