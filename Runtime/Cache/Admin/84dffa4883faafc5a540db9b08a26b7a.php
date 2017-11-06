<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
    <script type="text/javascript" src="http://libs.useso.com/js/respond.js/1.4.2/respond.min.js"></script>
    <script type="text/javascript" src="http://cdn.bootcss.com/css3pie/2.0beta1/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/h-ui.admin/css/H-ui.admin.css" />
    <!--[if IE 7]>
    <link href="http://www.bootcss.com/p/font-awesome/assets/css/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <title>添加字典</title>
</head>
<body>
<div class="pd-20">
    <form class="Huiform" id="loginform" method="post">
        <table class="table table-border table-bordered table-bg">
            <thead>
            <tr>
                <th colspan="2">
                    添加字典
                    <span class="r" style="display: none;" id="msgBox"></span>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th class="text-r" width="30%">分类：</th>
                <td>
                  <span class="select-box inline">
                      <select class="select" id="category">
                          <option value="0">根字典</option>
                          <?php if(is_array($cates)): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cate["id"]); ?>" <?php if(($dict['cateId']) == $cate['id']): ?>selected<?php endif; ?>><?php echo ($cate["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                      </select>
                  </span>
                </td>
            </tr>
            <tr>
                <th class="text-r" width="30%">名称：</th>
                <td>
                    <input type="hidden" id="id" value="<?php echo ($dict["id"]); ?>">
                    <input type="text" id="name" class="input-text"  tabindex="1" value="<?php echo ($dict["name"]); ?>">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button type="button" class="btn btn-success radius" id="save"><i class="icon-ok"></i> 确定</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
</body>
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Public/h-ui.admin/js/H-ui.admin.js"></script>
<script>
    $(document).ready(function(){
        $('#save').click(function () {
            var name = $('#name').val() , cateId = $('#category').val(),id = $('#id').val();
            var data = {'name':name , 'cateId':cateId , 'id':id};
            $.ajax({
                url: '/admin.php/system/dict_edit/did/5.html',
                type: 'POST',
                data: data,
                success: function (res) {

                    if(res.code < 0){
                        $('#msgBox').html('<font color="red">'+ res.msg +'</font>');
                        $('#msgBox').fadeIn("slow");
                        setTimeout(function(){
                            $('#msgBox').fadeOut("slow");
                        },3000);
                    }else{
                        layer.msg(res.msg,{icon:1,time:2500});
                        setTimeout(function () {
                            close_handle_parent();
                        },2500);
                    }
                },
                error: function (res) {
                    $('#msgBox').html('<font color="red">请求出错</font>');
                    $('#msgBox').fadeIn("slow");
                    setTimeout(function(){
                        $('#msgBox').fadeOut("slow");
                    },3000);
                }
            });
        });
    });

</script>
</html>