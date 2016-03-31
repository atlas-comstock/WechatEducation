<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <base href="<?=base_url()?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
		<title>教学评价</title>
		<link rel="stylesheet" href="style/evaluate/css/tchasses.css">
		<script type="text/javascript" src="style/evaluate/js/pjtcher.js"></script>
	</head>

	<body>
		<div class="cla_select_center">
		<h1>教学评价</h1>
		<div id="search">
			<input id="class_name" type="text" placeholder="请输入教师名或课程名...">
			<input id="in_search" type="button" value="搜索" onclick="location.href='selecteacher.html'">
		</div>
		<p>请选择需要评价的选项：</p>

		<div class="cla_select">
			<div style="" class="c_select">
				<form action="" method="get">
					<label>
						<input name="1" type="radio" value="" />java(上)，陈伟</label>
					<br />
					<label>
						<input name="1" type="radio" value="" />java(上)， 谢晓玲</label>
					<br />
					<label>
						<input name="1" type="radio" value="" />javaweb，xxx </label>
					<br />
				</from>
			</div>
		</div>
		</div>

		<button type="button" onclick="location.href='assessment.html'" class="ssd"> 确定</button>
	</body>

</html>
