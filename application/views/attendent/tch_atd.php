<!DOCTYPE html>
<html>
	<base href="<?=base_url()?>">
	<head>
		<meta http-equiv="Content-Type" content="text ml; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
		<title>教师考勤</title>
		<link rel="stylesheet" href="style/attendent/css/stu_attd.css">
		<script type="text/javascript" src="style/attendent/js/weixin.js"></script>
		<script type="text/javascript" src="style/attendent/js/resetcss.js"></script>
	</head>
	<?php 
	$user_name = $user_info->user_stu_name;
	$open_id = $user_info->user_open_id;
	$class_name = $user_info->user_class;
	$tea_id = $user_info->user_stu_id;
	?>
	<body>
		<h1>教师考勤</h1>
		<div w_lin>
			<div id="top_line">
			</div>
			<input type="hidden" id="class_name" value="<?php echo $class_name?>"/>
			<input type="hidden" id="tea_id" value="<?php echo $tea_id;?>"/>
			<div id="t_show">
				<li><label>科目：</label><span id="cl_name"><?php echo $lesson_name;?></span></li>
				<li><label>教师姓名：</label><span id="tea_name"><?php echo $user_name;?></span></li>
			</div>
			<div id="t_show">
				<li><label>考勤时间：</label>
					<time id="time"><?php echo $time;?></time>
				</li>
			</div>
		</div>
		<div id="but">
		<button class="bota" onclick="changePct()">开始发起考勤</button>
		</div>
	</body>

</html>