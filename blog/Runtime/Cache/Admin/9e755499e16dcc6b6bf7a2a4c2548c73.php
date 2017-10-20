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
<title>编辑权限</title>
</head>
<body>
<div class="pd-20">
  <form class="Huiform" id="loginform" method="post">
    <table class="table table-border table-bordered table-bg">
      <thead>
        <tr>
          <th colspan="2">
              编辑权限
              <span class="r" style="display: none;" id="msgBox"></span>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class="text-r" width="30%">动作：</th>
          <td>
              <?php echo ($power["name"]); ?>
          </td>
        </tr>
        <tr>
            <th class="text-r">CODE：</th>
            <td>
                <?php echo ($power["url"]); ?>
            </td>
        </tr>
        <tr>
            <th class="text-r">菜单显示：</th>
            <td>
                <?php if(($power['HideInMenu']) == "1"): ?>隐藏
                    <?php else: ?>
                    显示<?php endif; ?>
            </td>
        </tr>
        <tr>
          <th class="text-r">排序：</th>
          <td>
            <input type="text" id="sort" class="input-text"  tabindex="1" value="<?php echo ($power["sort"]); ?>">
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
        var pid = '<?php echo ($power["id"]); ?>';
        $('#save').click(function () {
            var sort = $('#sort').val();
            var data = {'sort':sort , 'id':pid};
            $.ajax({
                url: '/Admin/admin/powers_edit/pid/1.html',
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
                        $('#msgBox').html('<font color="green">'+ res.msg +'</font>');
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