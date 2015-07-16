<!DOCTYPE html>
<html>
	<base href="<?=base_url()?>">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
		<title>考勤名单</title>
		<link rel="stylesheet" href="style/attendent/css/list.css">
		<link rel="stylesheet" href="style/attendent/css/amazeui.min.css">
	</head>
	<?php 
	$lesson = $list[0]->attendent_stu_lesson;
	$time =date("Y-m-d G:i:s");
	$class = $list[0]->attendent_stu_class;
	?>
	<body>
		<h1>签到名单</h1>
		<div class="w_lin">
			<div id="t_show">
				<li><font>科目：</font><?php echo $lesson;?></li>
				<li><font>时间：</font>
					<time datetime="<?php echo $time;?>" title="<?php echo $time;?>"><?php echo $time;?></time>
				</li>
			</div>
			<table class="am-table am-table-bordered am-table-striped">
				<thead>
					<tr>
						<th style="width:100px">班级</th>
						<th style="width:200px">学号</th>
						<th style="width:100px">姓名</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($list as $item):?>
					<tr>
						<td><code><?php echo $item->attendent_stu_class?></code>
						</td>
						<td><code><?php echo $item->attendent_stu_id?></code>
						</td>
						<td><code><?php echo $item->attendent_stu_name?></code>
						</td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		</div>

		<div class="i_total">
			<ul>
				<li>班级：<span><?php echo $class;?></span>
				</li>
				<li>总人数：<span><?php echo $stu_count;?></span>人</li>
				<li>签到人数：<span><?php echo $stu_attend_count;?></span>人</li>
				<li>缺席人数：<span><?php echo $stu_count-$stu_attend_count;?></span>人</li>
			</ul>
		</div>
<!--		<div id="w_total">
			<ul>
				<li>班级：<span>外包112</span>
				</li>
				<li>总人数：<span>50</span>人</li>
				<li>heehehehe;</li>
				<li>asfjbdkla:jsahjf</li>
			</ul>
		</div>-->

	</body>

</html>