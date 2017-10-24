<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/blog/Public/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/blog/Public/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/blog/Public/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/blog/Public/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="/blog/Public/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="/blog/Public/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="/blog/Public/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="/blog/Public/lib/DD_belatedPNG_0.0.8a-min.js"></script>
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
<article class="page-container">
    <form action="<?php echo U('admin/posts/add');?>" method="post" class="form form-horizontal" id="form-member-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>标题：</label>
            <div class="formControls col-xs-8 col-sm-6">
                <input type="text" class="input-text" name="title" value="" placeholder="请输入文章标题">
            </div>
        </div>

        <!--<div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">附件：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="btn-upload form-group">
				<input class="input-text upload-url" type="text" name="uploadfile" id="uploadfile" readonly nullmsg="请添加附件！" style="width:200px">
				<a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
				<input type="file" multiple name="file-2" class="input-file">
				</span> </div>
        </div>-->
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>内容：</label>
            <div class="formControls col-xs-8 col-sm-6">
                <textarea name="content" cols="" rows="" class="textarea"  placeholder="说点什么..." onKeyUp="$.Huitextarealength(this,100)"></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="status" type="radio" id="sex-1" checked value="1">
                    <label for="sex-1">启用</label>
                </div>
                <div class="radio-box">
                    <input name="status" type="radio" id="sex-2" value="0">
                    <label for="sex-2">禁用</label>
                </div>
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</article>

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

</body>
</html>