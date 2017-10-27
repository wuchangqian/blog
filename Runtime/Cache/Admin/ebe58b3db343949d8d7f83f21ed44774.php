<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/blog/Public/lib/html5shiv.js"></script>
<script type="text/javascript" src="/blog/Public/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/blog/Public/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/blog/Public/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/blog/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/blog/Public/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/blog/Public/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/blog/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>我的桌面</title>
</head>
<body>
<div class="page-container">
	<p class="f-20 text-success">欢迎使用 [ Balun-wang ] blog cms</p>
	<p>登录次数：<?php echo ($user["loginNum"]); ?> </p>
	<p>上次登录IP：<?php echo ($user["lastIp"]); ?>  上次登录地点：<?php echo ($addr); ?>  上次登录时间：<?php echo (date('Y-m-d H:i:s',$user["lastLogin"])); ?></p>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th colspan="7" scope="col">信息统计</th>
			</tr>
			<tr class="text-c">
				<th>统计</th>
				<th>资讯库</th>
				<th>图片库</th>
				<th>产品库</th>
				<th>用户</th>
				<th>管理员</th>
			</tr>
		</thead>
		<tbody>
			<tr class="text-c">
				<td>总数</td>
				<td>92</td>
				<td>9</td>
				<td>0</td>
				<td>8</td>
				<td>20</td>
			</tr>
			<tr class="text-c">
				<td>今日</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>昨日</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>本周</td>
				<td>2</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>本月</td>
				<td>2</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr>
				<th colspan="2" scope="col">服务器信息</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th width="30%">服务器名</th>
				<td><span id="lbServerName"><?php echo ($_SERVER['HTTP_HOST']); ?></span></td>
			</tr>
			<tr>
				<td>服务器IP地址</td>
				<td><?php echo ($_SERVER['SERVER_ADDR']); ?></td>
			</tr>
			<tr>
				<td>服务器域名</td>
				<td><?php echo ($_SERVER['SERVER_NAME']); ?></td>
			</tr>
			<tr>
				<td>服务器端口 </td>
				<td><?php echo ($_SERVER['SERVER_PORT']); ?></td>
			</tr>
			<tr>
				<td>运行环境</td>
				<td><?php echo ($_SERVER['SERVER_SOFTWARE']); ?></td>
			</tr>
			<tr>
				<td>系统路径 </td>
				<td><?php echo ($_SERVER['DOCUMENT_ROOT']); ?></td>
			</tr>
			<tr>
				<td>空间剩余 </td>
				<td>
                    <?php echo ($info["free_disk"]); ?>
                </td>
			</tr>
			<tr>
				<td>服务器操作系统 </td>
				<td>
                    <?php echo ($info["uname"]); ?>
                </td>
			</tr>
			<tr>
				<td>当前脚本 </td>
				<td><?php echo ($_SERVER['PHP_SELF']); ?></td>
			</tr>
			<tr>
				<td>服务器当前时间 </td>
				<td><?php echo ($info["server_time"]); ?></td>
			</tr>

			<tr>
				<td>PHP版本 </td>
				<td><?php echo ($info["php_ver"]); ?></td>
			</tr>
			<tr>
				<td>超时时间 </td>
				<td><?php echo ($info["out_time"]); ?>S</td>
			</tr>
			<tr>
				<td>最大上传 </td>
				<td><?php echo ($info["max_upload"]); ?></td>
			</tr>
			<tr>
				<td>已加载模块 </td>
				<td>
					<?php echo ($info["load_module"]); ?>
				</td>
			</tr>
            <tr>
				<td>数据库 </td>
				<td>
					Mysql <?php echo ($info["mysql_ver"]); ?>
				</td>
			</tr>




		</tbody>
	</table>
</div>
<footer class="footer mt-20">
    <div class="container">
        <p>
            Copyright &copy;2017 Balun Wang All Rights Reserved.<br>
        </p>
    </div>
</footer>
<script type="text/javascript" src="/blog/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/blog/Public/h-ui/js/H-ui.min.js"></script>

</body>
</html>