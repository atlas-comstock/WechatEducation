<!DOCTYPE html>
<html>

    <head>
        <base href="<?=base_url()?>">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />

        <link rel="stylesheet" href="style/notice/css/inform.css" />
        <link rel="stylesheet" href="style/notice/css/amazeui.min.css" />
        <link rel="stylesheet" href="style/notice/css/bbk.css" />
        <script type="text/javascript" src="style/notice/assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="style/notice/assets/js/amazeui.min.js"></script>
        
        <title>教务通知</title>
    </head>

    <body>
        <div class="wx_show">
            <div id="touxiang">
                <a href="javascript:void(0);" class="am-btn am-btn-primary" data-am-offcanvas="{target: '#doc-oc-demo2', effect: 'push'}">
                    <img src="<?php echo $user_image;?>" alt="" class="abc" width="48" height="48">
                </a>
            </div>
            <div id="wx_name">
                <label id="stu_open_id"><?php echo $user_stu_name;?></label>
            </div>
        </div>

        <!-- 侧边栏内容 -->
        <div id="doc-oc-demo2" class="am-offcanvas">
            <div class="am-offcanvas-bar">
                <div class="am-offcanvas-content">
                    <h1>个人中心</h1>
                    <div class="bbk">
                        <a href="../private/yourself.html"><p>基本信息>></p></a>
                        <a href="../private/collect.html"><p>个人收藏>></p></a>
                        <a href="../private/majors.html"><p>班级信息>></p></a>
                        <a href="../private/advice.html"><p>意见反馈>></p></a>
                        <a href="../private/about.html"><p>关于我们>></p></a>
                    
                    </div>
                </div>
            </div>
        </div>
<div class="inputo">
<form action="<?php echo 'index.php/notice/send_msg_get/'.$user_id.'/'.$power; ?>" method="POST" enctype="UTF-8">
 <textarea name="noti_title"
    onblur="if(this.value == ''){this.style.color = '#ACA899'; this.value = '在此处填写标题'; }"
    onfocus="if(this.value == '在此处填写标题'){this.value =''; this.style.color = '#000000'; }"
                                style="color:#ACA899;">在此处填写标题</textarea>
 <textarea name="noti_content"
    onblur="if(this.value == ''){this.style.color = '#ACA899'; this.value = '在此处填写内容'; }"
    onfocus="if(this.value == '在此处填写内容'){this.value =''; this.style.color = '#000000'; }"
                                style="color:#ACA899;">在此处填写内容</textarea>
                <button type="submit">发通知</button>
</form>
</div>

    </body>

</html>

<script type="text/javascript">
//var send = function() {
//    var noti_title = document.getElementById("title").value;
//    var noti_content = document.getElementById("content").value;
//    var user_id = '<?=$user_id?>';
//    var power = '<?=$power?>';
//
//    var dzb = '"user_id="+user_id+"&power="+power+"&noti_title="+noti_title+"&noti_content="+noti_content';
////    var dzb = "{'user_id': user_id, 'power': power, 'noti_title': noti_title, 'noti_content':noti_content}";
//
//    //var dzb = "info={'FullName':'王继军','Company':'上海天正','Address':'田林路388号'}";
//    send(dzb);
//
//    function send(arg)
//    {
//        CreateXMLHttpRequest();
//        xmlhttp.onreadystatechange = callhandle;
//        xmlhttp.open("POST","index.php/notice/send_msg",true);
//        xmlhttp.setRequestHeader("Content-Length",arg.lenght);
//        xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;");  //用POST的时候一定要有这句
//        xmlhttp.send(arg);
//
//    }
//
//    function CreateXMLHttpRequest()
//    {
//        if (window.ActiveXObject)
//        {
//            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//        }
//        else if (window.XMLHttpRequest)
//        {
//            xmlhttp = new XMLHttpRequest();
//        }
//    }
//    function callhandle()
//    {
//        if (xmlhttp.readyState == 4)
//        {
//            if(xmlhttp.status == 200)
//            {
//                var dzb = eval("(" + xmlhttp.responseText +")");
//                alert(dzb.Address);
//            }
//        }
//    }
//
//
//
//
//
//
//
//
////    var aj = $.ajax( {
////        url:'index.php/notice/send_msg',// 跳转到 action
////            data:{
////                user_id: user_id,
////                    power: power,
////                    noti_title: noti_title,
////                    noti_content:noti_content
////            },
////            type:'post',
////            success:function(data) {
////                if(data.msg =="true" ){
////                    alert("修改成功！");
////                }else{
////                }
////            },
////                error : function() {
////                    alert("异常！");
////                }
////    } );
////
//
//    //    var xmlhttp;
//    //    if (window.XMLHttpRequest)
//    //    {// code for IE7+, Firefox, Chrome, Opera, Safari
//    //        xmlhttp=new XMLHttpRequest();
//    //    }
//    //    else
//    //    {// code for IE6, IE5
//    //        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//    //    }
//    //    xmlhttp.onreadystatechange=function()
//    //    {
//    //        alert("inl");
//    //        if (xmlhttp.readyState==4 && xmlhttp.status==200)
//    //        {
//    //            alert("in2");
//    //            if(xmlhttp.responseText == "NOPEOPLE")
//    //                alert("没有对象可以发送");
//    //            else if(xmlhttp.responseText == "SUC")
//    //                alert("发送成功！");
//    //            else
//    //                alert("未知错误，请重试");
//    //        }
//    //    }
//    //    xmlhttp.open("POST","index.php/notice/send_msg",true);
//    //    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//    //    var user_id = '<?=$user_id?>';
//    //    var power = '<?=$power?>';
//    //    var post_data = "user_id="+user_id+"&power="+power+"&noti_title="+noti_title+"&noti_content="+noti_content;
//    //    xmlhttp.send(post_data);
//    alert("4");
//}
</script>
