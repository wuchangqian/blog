<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Public/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Public/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Public/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Public/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Public/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>权限管理</title>
</head>
<body>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页
    <noempty name="bread['parName']">
        <span class="c-gray en">&gt;</span> <?php echo ($bread['parName']); ?>
    </noempty>
    <noempty name="bread['curName']">
        <span class="c-gray en">&gt;</span> <?php echo ($bread['curName']); ?>
    </noempty>
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<div class="text-c">
		<form class="Huiform" method="get" action="/index.php/Admin/admin/roles.html" target="_self">
			<input type="text" class="input-text" style="width:250px" placeholder="权限名称" value="<?php echo ($keyword); ?>" name="keyword">
			<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜权限节点</button>
		</form>
	</div>

	<div class="cl pd-5  mt-20"></div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="7">权限节点</th>
			</tr>
			<tr class="text-c">
				<th width="40">ID</th>
				<th width="200">模块</th>
				<th width="200">动作</th>
				<th>CODE</th>
                <th>排序</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($powers['list'])): $i = 0; $__LIST__ = $powers['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
					<td><?php echo ($vo["id"]); ?></td>
					<td><?php echo ($vo["name"]); ?></td>
					<td>  </td>
					<td><?php echo ($vo["url"]); ?></td>
                    <td><?php echo ($vo["sort"]); ?></td>
					<td>
                        <a title="编辑" href="javascript:;" onclick="admin_permission_edit('权限编辑','<?php echo U('admin/powers_edit?pid='.$vo['id']);?>','<?php echo ($vo["id"]); ?>','','400')" class="ml-5" style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6df;</i>
                        </a>
                    </td>

				</tr>
				<?php if(!empty($vo['sub'])): if(is_array($vo['sub'])): $i = 0; $__LIST__ = $vo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?><tr class="text-c">
						<td><?php echo ($sub["id"]); ?></td>
						<td> ├ </td>
						<td><?php echo ($sub["name"]); ?> </td>
						<td><?php echo ($sub["url"]); ?></td>
                        <td><?php echo ($sub["sort"]); ?></td>
						<td>
                            <a title="编辑" href="javascript:;" onclick="admin_permission_edit('权限编辑','<?php echo U('admin/powers_edit?pid='.$sub['id']);?>','<?php echo ($sub["id"]); ?>','','400')" class="ml-5" style="text-decoration:none">
                                <i class="Hui-iconfont">&#xe6df;</i>
                            </a>
                        </td>
					</tr><?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/Public/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript">

    function admin_permission_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }

    function closeHandle() {
        location.replace(location.href);
    }




</script>
</body>
</html>