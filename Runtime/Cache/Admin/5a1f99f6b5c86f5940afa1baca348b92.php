<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
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
    <title>文章管理</title>
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
    <div class="cl pd-5 bg-1 bk-gray"><span class="l">
        <a href="javascript:;" onclick="batchdelete()" class="btn btn-danger radius">
            <i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
        <a class="btn btn-primary radius" href="<?php echo U('admin/posts/add');?>">
            <i class="Hui-iconfont">&#xe600;</i> 发布文章</a> </span>
        <span class="r">共有数据：<strong><?php echo ($total); ?></strong> 条</span></div>
    <table class="table table-border table-bordered table-hover table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="8">文章管理</th>
        </tr>
        <tr class="text-c">
            <th width="20"><input type="checkbox" name="" value=""></th>
            <th width="25">ID</th>
            <th>标题</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>操作人</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="checkbox"></td>
                <td><?php echo ($vo["id"]); ?></td>
                <td><?php echo ($vo["title"]); ?></td>
                <td><?php echo (date("Y-m-d H:i:s",$vo["createtime"])); ?></td>
                <td><?php echo (date("Y-m-d H:i:s",$vo["updatetime"])); ?></td>
                <td><?php echo ($vo["username"]); ?></td>
                <td class="td-status">
                    <?php if(($vo["status"]) == "1"): ?><span class="label label-success radius">已启用</span>
                    <?php else: ?>
                        <span class="label radius">已停用</span><?php endif; ?>
                </td>
                <td class="f-14">
                    <a title="编辑" href="javascript:;" onclick="posts_edit('文章编辑','<?php echo U('posts/edit?id='.$vo['id']);?>','<?php echo ($vo["id"]); ?>')" style="text-decoration:none">
                        <i class="Hui-iconfont">&#xe6df;</i>
                    </a>
                    <a title="删除" href="javascript:;" onclick="posts_del(this,'<?php echo ($vo['id']); ?>')" class="ml-5" style="text-decoration:none">
                        <i class="Hui-iconfont">&#xe6e2;</i>
                    </a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="col-xs-6">
        <div class="dataTables_paginate paging_simple_numbers" id="sample-table-2_paginate">
            <ul class="pagination">
                <?php echo ($page); ?>
            </ul>
        </div>
    </div>
</div>
<footer class="footer mt-20">
    <div class="container">
        <p>
            Copyright &copy;2017 Balun Wang All Rights Reserved.<br>
        </p>
    </div>
</footer>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/blog/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/blog/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/blog/Public/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/blog/Public/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/blog/Public/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    /*管理员-文章-编辑*/
    function posts_edit(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }

    /*管理员-文章-删除*/
    function posts_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: '<?php echo U("posts/del");?>',
                dataType: 'json',
                data:{'id':id},
                success: function (data) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                    window.location.reload();
                },
                error: function (data) {
                    console.log(data.msg);
                }
            });
        });
    }

    /*批量删除*/
    function batchdelete() {
        var ids = '';
        $('input[name="checkbox"]:checked').each(function () {
            ids += $(this).val() + ',';
        });
        if (ids.length <= 0) {
            layer.msg('请选择要删除的数据!', {icon: 3, time: 2000});
            return false;
        }
        layer.confirm('确认要批量删除选中的数据吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: '<?php echo U("posts/batchdelete");?>',
                dataType: 'json',
                data: {'ids': ids},
                success: function (data) {
                    layer.msg('删除成功!', {icon: 1, time: 1000});
                    window.location.reload();
                },
                error: function (data) {
                    console.log(data.msg);
                }
            });
        });
    }
</script>
</body>
</html>