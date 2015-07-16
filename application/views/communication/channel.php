<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
        />
        <title>
            交流平台
        </title>
        <!-- Set render engine for 360 browser -->
        <meta name="renderer" content="webkit" />
        <!-- No Baidu Siteapp-->
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <!-- Add to homescreen for Chrome on Android -->
        <meta name="mobile-web-app-capable" content="yes" />
        <link rel="icon" sizes="192x192" href="<?=base_url()?>style/conan_style/i/app-icon72x72@2x.png"
        />
        <!-- Add to homescreen for Safari on iOS -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="apple-mobile-web-app-title" content="Amaze UI" />
        <link rel="stylesheet" href="<?=base_url()?>style/conan_style/css/amazeui.flat.min.css" />
        <link rel="stylesheet" href="<?=base_url()?>style/conan_style/css/amazeui.min.css" />
        <link rel="stylesheet" href="<?=base_url()?>style/conan_style/css/app.css" />
        <link rel="stylesheet" href="<?=base_url()?>style/conan_style/css/comm.css" />
        <script type="text/javascript" src="<?=base_url()?>style/conan_style/js/jquery.min.js">
        </script>
        <script type="text/javascript" src="<?=base_url()?>style/conan_style/js/handlebars.min.js">
        </script>
        <script type="text/javascript" src="<?=base_url()?>style/conan_style/js/amazeui.min.js">
        </script>
        <script type="text/javascript" src="<?=base_url()?>style/conan_style/js/comm/main.js">
        </script>
        <script>
            $(function() {
                var id = '#slider';
                var $myOc = $(id);
                $('.doc-oc-js').on('click',
                function() {
                    $myOc.offCanvas($(this).data('rel'));
                });
            });
        </script>
    </head>
    
    <body>
        <!--头部-->
        <header data-am-widget="header" class="am-header am-header-default am-header-fixed">
            <div class="am-header-left am-header-nav">
                <a href="index?openid=<?php echo $_REQUEST['openid'];?>" class="top_left">
                    频道
                </a>
            </div>
            <div class="am-header-right am-header-nav">
                <a href="#slider" class="am-icon-user-plus doc-oc-js" data-rel="open">
                </a>
            </div>
        </header>
        <!--头部end-->
        <!-- 侧边栏内容 -->
        <div id="slider" class="am-offcanvas">
            <div class="am-offcanvas-bar am-offcanvas-bar-flip">
                <div class="am-offcanvas-content">
					<ul class="slider_content">
						<li>
							<img src="<?=base_url()?>style/conan_style/image/topic_head.ico" />
							<a href="new_ques?openid=<?php echo $_REQUEST['openid'];?>">发起话题</a>
							<hr />
						</li>	
						<li>
							<img src="<?=base_url()?>style/conan_style/image/answer.ico" />
							<a href="mykey?openid=<?php echo $_REQUEST['openid'];?>">我的回答</a>
							<hr />
						</li>	
						<li>
							<img src="<?=base_url()?>style/conan_style/image/collect.ico" />
							<a href="mycollect?openid=<?php echo $_REQUEST['openid'];?>">我的收藏</a>
							<hr />
						</li>
						<li>
							<img src="<?=base_url()?>style/conan_style/image/navi.ico" />
							<a href="search?openid=<?php echo $_REQUEST['openid'];?>">快速定位</a>
						</li>
					</ul>
                </div>
            </div>
        </div>
        <!--侧边栏over-->
        <!--频道选择-->
        <div class="channel">
        	<img src="<?=base_url()?>style/conan_style/image/Radio.ico" />
        	选择栏目
        	<input id="showhide" type="button" class="am-btn am-btn-danger  am-btn-sm" value="隐藏栏目"/>
        	<div class="channel_group">
        		<select name="par">
        			<option value="all">--请选择一级栏目--</option>
        			<option value="computer">计算机科学与技术</option>
        			<option value="ecnomic">经济学</option>
        			<option value="medicine">药学</option>
        		</select>
        		<br />
        		<select name="child">
        			<option value="all">--请选择二级栏目--</option>
        			<option value="java">JAVA</option>
        			<option value="C">C</option>
        		</select>
        		<input type="text" name="keyword" placeholder="这里输入关键字"/>
        		<br />
        		<button id="show_result" class="am-btn am-btn-secondary am-btn-sm" type="button">查询</button>
        	</div>
        </div>
        <!--频道选择结束-->
        
        <!-- 话题列表-->
        <div class="am-scrollable-vertical content_list">
            <!--最新问题列表-->
            <div class="new_list">
                <div id="wrapper">
                    <ul id="search_result">
                    </ul>
                    <!--加载更多按钮-->
                    <div class="add_more">
<!--                     	<button id="load_more" class="am-btn am-btn-success"> -->
<!--                     		点击加载更多 -->
<!--                     	</button> -->
                    </div>
                    <!--加载更多按钮over-->
                </div>
                <!--话题列表over-->
            </div>
        </div>
    </body>
<script type="text/javascript">
$("#show_result").click(
		function (){
			var par = $("select[name=par]").val();
			var child = $("select[name=child]").val();
			var keyword = $("input[name=keyword]").val(); 
			$.post("<?php echo base_url();?>index.php/communication/comm/get_search?openid=os4ODuBQdQveaddXu2U1pmjLL6Uk",
					{
						par:par,
						child:child,
						keyword:keyword
					}
					,function(data,status){
						$("div#wrapper ul").empty();;
						$("div#wrapper ul").append(data);
				  	});
		}
	);
</script>
</html>