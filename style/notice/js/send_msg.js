var send_msg = function() {
    var noti_title = document.getElementById("title").value;
    alert("hi");
    var noti_content = document.getElementById("content").value;
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
            if(xmlhttp.responseText == "NOPEOPLE")
                alert("没有对象可以发送");
            else if(xmlhttp.responseText == "SUC")
                alert("发送成功！");
            else
                alert("未知错误，请重试");
        }
    }
    xmlhttp.open("POST","index.php/notice/send_msg",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    alert("2");
    var user_id = '<?=$user_id?>';
    var user_power = '<?=$user_power?>';
    alert(user_id);
    alert(user_power);
    var post_data = 'user_id='+user_id+'&user_power='+user_power+'&noti_title='+noti_title+'&noti_content='+noti_content;
    xmlhttp.send(post_data);
    alert("4");
}
