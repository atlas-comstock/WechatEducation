"<!DOCTYPE html>
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
<?php
if($power > 1) {
$url = "index.php/notice/send_msg_action/".$user_id. "/" .$power;
print<<<EOT
<div class="ps">
	<label>PS：更多分析性反馈请在PC端查阅；处在PC端外，微信端也可快速发教务通知！</label>
    <a href="$url">
<button>发通知</button></a>
</div>
EOT;
}
?>

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

		<div class="doc-example">
			<ul class="am-comments-list am-comments-list-flip">
<?php
foreach ($history_contents as $content) {
$url = "index.php/notice/show_content/".$content->noti_id;
print<<<EOT
<li class="am-comment">
					<a href="kong">
						<img src=" {$content->noti_from_user_image}" alt="" class="am-comment-avatar" width="48" height="48">
					</a>
					<div class="am-comment-main">
						<header class="am-comment-hd">
							<div class="am-comment-meta"><a href="#link-to-user" class="am-comment-author"> {$content->noti_from_user_name}</a> 更新于
								<time datetime="2013-07-27T04:54:29-07:00" title="2013年7月27日 下午7:54 格林尼治标准时间+0800"> {$content->noti_date}</time>
							</div>
						</header>
						<div class="am-comment-bd">
							<a href=" {$url}"><p> {$content->noti_title}</p></a>
						</div>
					</div>
				</li>
EOT;
}?>

</body>

</html>
