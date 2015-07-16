<!DOCTYPE html>
<html class="no-js">
    
    <head>
    	<noscript><?php echo base_url();?></noscript>
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
        <noscript><?=base_url()?></noscript>
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
                    回答
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
							<a href="">我的回答</a>
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
        <!-- 话题列表-->
        <div class="am-scrollable-vertical content_list">
            <!--最新问题列表-->
            <div class="new_list">
                <div id="wrapper">
                    <ul>
                    	<?php
                    		$ci = &get_instance();
                    		$ci->load->library('base_infor');  
                    		foreach ($content as $item){
//                     		$openid = $item->topic_user_id;
// 							$json =$ci->base_infor->get_userInfo($openid);            			
//                     		$json =json_decode($json);
//                     		$image = $json->headimgurl;
                    		$image = $item->user_image;
                    	?>
                    	 <!--一个话题样式-->
                        <li>
                            <div class="topic">
                                <div class="bottom_hr">
                                </div>
                                <div class="topic_zan">
                                    <div id="compo">
                                        <p id="author_head">
                                        	 <img id="topic_author_head" src="<?php echo $image;?>" />
                                        </p>
                                        <p>
                                            <img id="point_zan" ref="<?=$_REQUEST['quesid']?>" ref2="<?=$_REQUEST['openid']?>" src="<?=base_url()?>style/conan_style/image/thumb.ico"/>
                                            <span id="mark_count"><?php echo $item->count_num;?></span>
                                        </p>
                                        <br/>
                                        <p>
                                            <img id="collect" ref="<?=$_REQUEST['quesid']?>" ref2="<?=$_REQUEST['openid']?>" src="<?=base_url()?>style/conan_style/image/star.ico" />
                                            <span>
                                                收藏
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="topic_view">
                                    <span class="author">
                                        来自:<?php echo $item->topic_user_name;?>
                                    </span>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<span class="author">
									<?php echo $item->topic_date?>
									</span>
                                    <br />
                                    <span class="title">
<!--                                         大煞风景很舒大煞风景很asasasdasfasdasdsa -->
                                    <?php echo $item->topic_title;?>
                                    </span>
                                    <p>
<!--                                         asasasdasfasdasdsa大煞风煞风景很舒大煞风景很asasasdasfasdasdsa大煞风景很舒大煞风景很asasasdasfasdasdsa大煞风景很舒大煞风景很 -->
                                    <?php echo $item->topic_content;?>
                                    </p>
                                </div>
                            </div>
                        </li>
                         <!--一个话题样式 over-->
                         <?php }?>
                    </ul>
                </div>
                <!--话题列表over-->
                <div style="background-color: #CCCCCC;height: 1px;"></div>
                <!--评论回复区域-->
                <ul class="am-comments-list am-comments-list-flip">
                	<!--评论样式-->
                	<?php foreach ($reply as $item){?>
                	<?php 
                			$openid = $item->reply_from_user_id;
// 							$json =$ci->base_infor->get_userInfo($openid);            			
//                     		$json =json_decode($json);
//                     		$image = $json->headimgurl;
							$image = $item->user_image;
                    ?>
					  <li class="am-comment conan_comm">
					  	<a href="#link-to-user-home">
					  		<img src="<?=$image?>" alt="" class="am-comment-avatar" width="48" height="48">
					  		<iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe>
					  	</a><div class="am-comment-main">
					  		<header class="am-comment-hd">
					  			<div class="am-comment-meta">
					  				<a href="#link-to-user" class="am-comment-author">
					  					<?php echo $item->reply_from_user_name;?>
					  				</a>
					  				 评论于 
					  				 <time datetime="<?=$item->reply_date?>">
					  				 	<?=$item->reply_date?>
					  				 </time>
					  			</div>
					  		</header>
					  		<div class="am-comment-bd">
					  			<p>
					  			<?=$item->reply_content?>
					  			</p>
					  		</div>
					  	</div>
					  </li>
					  <?php }?>
					  <!--评论样式over-->
					</ul>
            </div>
            
            <div class="add_comment">
            	<button id="get_comm_form" type="button" class="am-btn am-btn-success" rel="close">参与评论</button>
            	<div id="comm_form">
            		<form action="" method="post">
            			<input id="topic_title" type="text" placeholder="标题"/>
            			<br />
            			<textarea name="reply_content" placeholder="回答"></textarea>
            			<br />
            			<button id="submit_reply" rel="<?=$_REQUEST['quesid']?>" rel2="<?php echo $_REQUEST['openid'];?>" type="button" class="am-btn am-btn-primary">提交</button>
            		</form>
            	</div>
            </div>
            
        </div>
    </body>
<script type="text/javascript">
$("img[id=point_zan]").click(
		function(){
			var id = $("#point_zan").attr("ref");
			var uid =$("#point_zan").attr("ref2");
				$.post("<?php echo base_url();?>index.php/communication/comm/mark?openid=os4ODuBQdQveaddXu2U1pmjLL6Uk",
					{
				quesid:id,
				uid:uid
					}
			,function(data,status){
				if(data=="已经点赞"){
					$("#mark_count").css("color","red");
				}else{
					var v = $("#mark_count").text();
					$("#mark_count").text(++v);
					$("#mark_count").css("color","red");
				}
				alert(data);
			});
		}
);
$("img[id=collect]").click(
		function(){
			var id = $("#collect").attr("ref");
			var uid =$("#collect").attr("ref2");
				$.post("<?php echo base_url();?>index.php/communication/comm/collect?openid=os4ODuBQdQveaddXu2U1pmjLL6Uk",
					{
				quesid:id,
				uid:uid
					}
			,function(data,status){
				alert(data);
			});
		}
);
</script>
</html>