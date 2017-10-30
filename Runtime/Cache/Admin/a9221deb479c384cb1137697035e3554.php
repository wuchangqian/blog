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
<title>角色管理</title>
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
		<form class="Huiform" method="get" action="/Admin/system/dict.html" target="_self">
			<input type="text" class="input-text" style="width:250px" placeholder="名称" value="<?php echo ($keyword); ?>" name="keyword">
			<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索字典</button>
		</form>
	</div>
	<div class="cl pd-5  mt-20"></div>
	<div class="cl pd-5 bg-1 bk-gray">
		<span class="l">
			<a href="javascript:;" onclick="admin_roles_del()" class="btn btn-danger radius">
				<i class="Hui-iconfont">&#xe6e2;</i>
				批量删除
			</a>
			<a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加角色','<?php echo U('system/dict_add');?>','','300')">
				<i class="Hui-iconfont">&#xe600;</i>
				添加字典
			</a>
		</span>
		<span class="r"></span>
	</div>
	<table class="table table-border table-bordered table-hover table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="6"><?php echo ($bread['curName']); ?></th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" value="" name=""></th>
				<th width="40">ID</th>
				<th >根名称</th>
				<th>名称</th>
				<th width="200">创建时间</th>
				<th width="90">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($data['list'])): $i = 0; $__LIST__ = $data['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
					<td><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="ids"></td>
					<td><?php echo ($vo["id"]); ?></td>
					<td>  <?php echo ($vo["name"]); ?></td>
					<td> </td>
					<td><?php echo (date('Y-m-d H:i:s',$vo["createAt"])); ?></td>
					<td>
						<a title="编辑" href="javascript:;" onclick="admin_role_edit('编辑字典','<?php echo U('system/dict_edit?did='.$vo['id']);?>','','','300')" class="ml-5" style="text-decoration:none">
							<i class="Hui-iconfont">&#xe6df;</i>
						</a>
						<a title="删除" href="javascript:;" onclick="admin_role_del(this,'<?php echo ($vo["id"]); ?>')" class="ml-10" style="text-decoration:none">
							<i class="Hui-iconfont">&#xe6e2;</i>
						</a>
					</td>
					<?php if(!empty($vo['sub'])): if(is_array($vo['sub'])): $i = 0; $__LIST__ = $vo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?><tr class="text-c">
								<td><input type="checkbox" value="<?php echo ($sub["id"]); ?>" name="ids"></td>
								<td><?php echo ($sub["id"]); ?></td>
								<td> ├ </td>
								<td><?php echo ($sub["name"]); ?> </td>
								<td><?php echo (date('Y-m-d H:i:s',$vo["createAt"])); ?></td>
								<td>
									<a title="编辑" href="javascript:;" onclick="admin_role_edit('编辑字典','<?php echo U('system/dict_edit?did='.$sub['id']);?>','','','300')" class="ml-5" style="text-decoration:none">
										<i class="Hui-iconfont">&#xe6df;</i>
									</a>
									<a title="删除" href="javascript:;" onclick="admin_role_del(this,'<?php echo ($sub["id"]); ?>')" class="ml-10" style="text-decoration:none">
										<i class="Hui-iconfont">&#xe6e2;</i>
									</a>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	</div>
</div>
<footer class="footer mt-20">
    <div class="container">
        <p>
            Copyright &copy;2017 Balun Wang All Rights Reserved.<br>
        </p>
    </div>
</footer>
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Public/h-ui.admin/js/H-ui.admin.js"></script>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript">

	/*管理员-角色-添加*/
	function admin_role_add(title,url,w,h){
		layer_show(title,url,w,h);
	}
	/*管理员-角色-编辑*/
    function admin_role_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }


	/*管理员-角色-删除*/
	function admin_role_del(obj,id){
		layer.confirm('确认要删除吗？',function(index){
			$.ajax({
				type: 'POST',
				url: '<?php echo U("system/dict_del");?>',
				data: {'id':id},
				dataType: 'json',
				success: function(data){
				    var status = 1;
				    if(data.code < 0){
				        status = 0;
					}
                    layer.msg(data.msg,{icon:status,time:2500});
                    setTimeout(function () {
                        close_handle_self();
                    },2500);
				},
				error:function(data) {
					console.log(data.msg);
				},
			});
		});
	}
    function admin_roles_del(){
        var ids = new Array();

		$("input[name='ids']:checkbox:checked").each(function(){
			ids.push($(this).val());
		});

        layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '<?php echo U("system/dict_del");?>',
                data: {'id':ids},
                dataType: 'json',
                success: function(data){
                    var status = 1;
                    if(data.code < 0){
                        status = 0;
                    }
                    layer.msg(data.msg,{icon:status,time:2500});
                    setTimeout(function () {
                        close_handle_self();
                    },2500);
                },
                error:function(data) {
                    console.log(data.msg);
                },
            });
        });
    }

</script>
</body>
</html>