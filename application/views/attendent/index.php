<!DOCTYPE html>
<html>
	<base href="<?=base_url()?>">
	
	<head>
		<meta http-equiv="Content-Type" content="text ml; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
		<title>学生考勤</title>
		<link rel="stylesheet" href="style/attendent/css/stu_attd.css">
		<script type="text/javascript" src="style/attendent/js/resetcss.js"></script>
	</head>
	<?php 
	$user_name = $user_info->user_stu_name;
	$open_id = $user_info->user_open_id;
	$class_name = $user_info->user_class;
	$stu_id = $user_info->user_stu_id;
	?>
	<body>
		<h1>学生考勤</h1>
		<div w_lin>
			<div id="top_line">
			</div>
			<div id="t_show">
				<input type="hidden" id="open_id" value="<?php echo $open_id?>"/>
				<input type="hidden" id="class_name" value="<?php echo $class_name?>"/>
				<li><label>科目：</label><span id="cl_name"><?php echo $lesson_name;?></span></li>
				<li><label>时间：</label>
					<time id="time"><?php echo $time;?></time>
				</li>
			</div>
			<div id="t_show">
				<li><label>姓名：</label><span id="stu_name"><?php echo $user_name;?></span></li>
				<li><label>学号：</label><span id="stu_id"><?php echo $stu_id;?></span></li>
			</div>
		</div>
		<div id="but" class="box">
		<button id="btn3" onclick="changePicture()"> 未签到</button>
		</div>
	</body>

</html>