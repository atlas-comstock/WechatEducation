var verify = function() {
    var user_stu_id = document.getElementById("user_stu_id").value;
    var user_password = document.getElementById("user_password").value;
    var user_power = document.getElementById("user_power").value;
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
            if(xmlhttp.responseText == "HAVE_BIND")
                alert("帐号已经绑定");
            else if(xmlhttp.responseText == "NO_INFO")
                alert("【账号】或者【密码】错误");
            else if(xmlhttp.responseText == "SUC")
                alert("绑定成功！");
            else
                alert("未知错误，请重试");
        }
    }
    xmlhttp.open("POST","index.php/bind/single_bind",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var post_data = 'user_stu_id='+user_stu_id+'&user_password='+user_password+'&user_power='+user_power;
    xmlhttp.send(post_data);
    alert("欢迎使用教学系统");


    //    $.ajax({
    //        url: 'index.php/bind/single_bind',
    //        type: 'POST',
    //        data: 'user_stu_id='+user_stu_id+'&user_password='+user_password+'&user_power='+user_power,
    //        success: function(data) {
    //            alert("success");
    //            alert("返回的数据: " + data);
    //            //$.ajax({
    //            //    url: 'index.php/bind/single_bind',
    //            //    type: 'POST',
    //            //    data: '/'+user_name+'/'+user_pwd+'/'+user_type,//+ user_name +'&pw='user_pwd,
    //            //    success: function(data) {
    //            //        alert("Data Loaded success: " + data);
    //            //    },
    //            //    error: function(data) {
    //            //        alert("post error " + data);
    //            //    }
    //            //});
    //            //window.location.href="xx";
    //        },
    //        //called when successful
    //        //	$('#ajaxphp-results').html(data);
    //        error: function(data) {
    //            alert("【账号】或者【密码】错误,或者帐号已经绑定");
    //            alert("返回的数据: " + data);
    //            return false;
    //            //called when there is an error
    //            //console.log(e.message);
    //        }
    //    });
}
