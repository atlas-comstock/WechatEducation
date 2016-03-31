<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
        <base href="<?=base_url()?>">
		<title>考试安排</title>
		<link rel="stylesheet" href="style/teacher/css/b_most.css" />
		<link rel="stylesheet" href="style/teacher/css/amazeui.min.css">
		<link rel="stylesheet" href="style/teacher/css/bbk.css" />
		<script type="text/javascript" src="style/teacher/assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="style/teacher/assets/js/amazeui.min.js"></script>

	</head>

	<body>
		<div class="wx_show">
			<div id="touxiang">
				<a href="javascript:void(0);" class="am-btn am-btn-primary" data-am-offcanvas="{target: '#doc-oc-demo2', effect: 'push'}">
					<img src="img/02.jpg" alt="" class="abc" width="48" height="48">
				</a>
			</div>
			<div id="wx_name">
				<label id="stu_open_id">用户1_niki</label>
			</div>
		</div>

		<!-- 侧边栏内容 -->
		<div id="doc-oc-demo2" class="am-offcanvas">
			<div class="am-offcanvas-bar">
				<div class="am-offcanvas-content">
					<h1>个人中心</h1>
					<div class="bbk">
						<a href="../private/yourself.html">
							<p>基本信息>></p>
						</a>
						<a href="../private/collect.html">
							<p>个人收藏>></p>
						</a>
						<a href="../private/majors.html">
							<p>班级信息>></p>
						</a>
						<a href="../private/advice.html">
							<p>意见反馈>></p>
						</a>
						<a href="../private/about.html">
							<p>关于我们>></p>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div id="font_z">
			<label class="f_size">科目：
				<label id="">大学生商务英语入门</label>
			</label>
			<div class="op">
				<label>学院：</label>
				<select name="select">
					<option value="0">---請選擇---</option>
					<option value="1">公共卫生学院</option>
					<option value="2">药科学院</option>
					<option value="3">医药经贸学院</option>
					<option value="4">医药信息工程学院</option>
				</select>
			</div>
			<div class="op">
				<label>班级：</label>
				<select name="select" class="select_1">
					<option value="0">---請選擇---</option>
					<option value="1">计算机科学与技术（医药软件服务外包13）1</option>
					<option value="2">计算机科学与技术（医药软件服务外包13）2</option>
					<option value="3">计算机科学与技术（医药软件服务外包14）1</option>
					<option value="4">计算机科学与技术（医药软件服务外包14）2</option>
				</select>
			</div>
			<div class="op1">
				<label>考试时间：</label>
				<input type="date" />
				<br />
				<label>试室号：</label>
				<input type="text" />
			</div>
			<div class="butt_1">
				<a href="index.html">
					<button type="submit">确定</button>
				</a>
			</div>

		</div>
	</body>

</html>
