<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <base href="<?=base_url()?>">
        <base href="<?=base_url()?>">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>小组讨论</title>
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

  		<link rel="stylesheet" href="style/small_wechat/assets/css/amazeui.flat.min.css">
 	 	<link rel="stylesheet" href="style/small_wechat/assets/css/amazeui.min.css">
 	 	<link rel="stylesheet" href="style/small_wechat/css/new_one.css">
	</head>
	<body>
		<!--头部-->
		<header data-am-widget="header" class="am-header am-header-default am-header-fixed">

			<h1 class="am-header-title">

				<a href="../main/index.html" class="">进入小组</a>

				<div class="am-header-left am-header-nav">

				<a href="../main/index.html" class="">返回</a>
				</div>
  </h1>
		</header>

			<div class="cla_select">
			<div style="" class="c_select">
<form action="<?php echo 'http://localhost:8888/education/index.php/communication/small_wechat/delete_group/'.$user_id.'/'; ?>" method="POST" enctype="UTF-8">
<?php
foreach ($groups as $single_group) {
print<<<EOT
					<label>
						<input name="group_id" type="radio" value=" {$single_group->group_id}" /> {$single_group->group_name}</label>
					<br />
					<label>
EOT;
}?>
				</from>
			</div>

		<div class="butt_1">
			<button type="submit" > 删除 </button>
		</div>
			</div>

		</div>







	</body>
</html>
