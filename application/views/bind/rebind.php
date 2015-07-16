<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <base href="<?=base_url()?>">
        <title>账号重绑</title>
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
        <script type="text/javascript" src="style/bind/assets/js/berror.js"></script>

    </head>

    <body>

        <div class="page-container">
            <div>
                <h1>账号重绑</h1>
            </div>
<form>
                <input type="text" name="user_stu_id" class="user_stu_id" id="user_stu_id" placeholder="用户名">
                <input type="password" name="user_password" class="user_password" id="user_password" placeholder="密码">
                <div class="stu_option">
                    <select id="user_power" name="user_power" class="select">
                        <option value="0">---請選擇您的身份--</option>
                        <option value="1">学生</option>
                        <option value="2">辅导员</option>
                        <option value="3">任课教师</option>
                        <option value="4">管理层</option>
                    </select>
                </div>
                <button type="submit" onclick="verify()">重绑</button>
                <div class="error"><span>+</span>
                </div>
</form>
        </div>
    </body>

</html>

