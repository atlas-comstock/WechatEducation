<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <base href="<?=base_url()?>">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>教务通知</title>
		<!-- Set render engine for 360 browser -->
		<meta name="renderer" content="webkit">

		<!-- No Baidu Siteapp-->
		<meta http-equiv="Cache-Control" content="no-siteapp" />
		<!-- Add to homescreen for Chrome on Android -->
		<meta name="mobile-web-app-capable" content="yes">
		<link rel="icon" sizes="192x192" href="assets/i/app-icon72x72@2x.png">
		<!-- Add to homescreen for Safari on iOS -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-title" content="Amaze UI" />

        <link rel="stylesheet" href="style/notice/css/inform.css" />
        <link rel="stylesheet" href="style/notice/css/amazeui.min.css" />
        <link rel="stylesheet" href="style/notice/css/bbk.css" />
        <script type="text/javascript" src="style/notice/assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="style/notice/assets/js/amazeui.min.js"></script>

	</head>
	<body>
		<!--头部-->
		<header data-am-widget="header" class="am-header am-header-default am-header-fixed">

			<h1 class="am-header-title">

				<a href="../main/index.html" class="">通知内容</a>

				<div class="am-header-left am-header-nav">

				<a href="../" class="">返回</a>
				</div>
  </h1>
		</header>

		<div class="head_sp">
			<div class="res_example">
				<label>题目：</label>
			<span id="">
            <?php echo $noti_title;?>
			</span>
			</div>

			<div class="res_example">
				<label>内容：</label>
				<span id="">
            <?php echo $noti_content;?>
			</span>
			</div>


		</div>






	</body>
</html>
