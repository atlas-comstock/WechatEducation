<!doctype html>
<html class="no-js">

	<head>
		<base href="<?=base_url()?>">
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>信息登记</title>
		<!-- Add to homescreen for Chrome on Android -->
		<meta name="mobile-web-app-capable" content="yes">
		<link rel="icon" sizes="192x192" href="assets/i/app-icon72x72@2x.png">

		<!-- Add to homescreen for Safari on iOS -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-title" content="Amaze UI" />

		<link rel="stylesheet" href="style/conan_style/css/amazeui.flat.min.css">
		<link rel="stylesheet" href="style/conan_style/css/amazeui.min.css">
		<link rel="stylesheet" href="style/conan_style/css/app.css">
		<link rel="stylesheet" href="style/conan_style/css/information.css">
	</head>

	<body>
		<div class="form-main">
				<div class="form-header">
					<h1>信息登记</h1>
				</div>
				<form class="am-form form-width" action="index.php/information/infor_controller/submit_info">
					<input type="hidden" name="infor_usr_id" value="<?php echo $info[0]->user_id;?>">
					<input type="hidden" name="infor_date" value="<?php echo date("Y-m-d G:i:s");?>">
					<div class="am-form-group">
						<select id="doc-select-1" name="infor_type">
							<option value="0">--请选择消息类型--</option>
							<option value="stay">留校登记</option>
							<option value="prize">获奖登记</option>
						</select>
						<span class="am-form-caret"></span>
					</div>
					<div class="infor_content">
						<textarea rows="15" col="40" id="content_area" name="infor_content">
						</textarea>
					</div>
					<div class="button_group">
						<button type="submit" class="am-btn am-btn-secondary">提交</button>
						<button type="reset" class="am-btn am-btn-danger">重置</button>
					</div>
				</form>
		</div>

		<!--[if (gte IE 9)|!(IE)]><!-->
		<script src="style/conan_style/js/jquery.min.js"></script>
		<!--<![endif]-->
		<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<![endif]-->
	</body>

</html>