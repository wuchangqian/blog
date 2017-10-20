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
<title>设置权限</title>
</head>
<body>
<div class="pd-20">
  <form class="Huiform" id="listForm" method="post">
    <table class="table table-border table-bordered table-bg" style="margin-bottom: 10px;">
        <thead>
        <tr>
            <th colspan="2">
                设置权限
                <span class="r" style="display: none;" id="msgBox"></span>
            </th>
        </tr>
        </thead>
        <tbody>
            <tr>
              <th class="text-r" width="30%">角色名称：</th>
              <td>
                  <?php echo ($role["name"]); ?>
              </td>
            </tr>
            <tr>
                <th colspan="2">
                    <?php if(is_array($powers)): $i = 0; $__LIST__ = $powers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="skin-minimal pd-10" style="padding-bottom: 0px;">
                            <div class="check-box">
                                <input type="checkbox" data-id="checkbox-<?php echo ($vo["id"]); ?>" id="<?php echo ($vo["id"]); ?>" class="selectAll">
                                <label for="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></label>
                            </div>
                            <div style="padding-left: 15px;">
                                <?php if(is_array($vo['sub'])): $i = 0; $__LIST__ = $vo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?><div class="check-box pd-10 wantInput">
                                        <input type="checkbox" name="checkbox-<?php echo ($vo["id"]); ?>[]" id="checkbox-<?php echo ($sub["id"]); ?>" value="<?php echo ($sub["id"]); ?>" <?php if(in_array(($sub['id']), is_array($hasPower)?$hasPower:explode(',',$hasPower))): ?>checked<?php endif; ?>>
                                        <label for="checkbox-<?php echo ($sub["id"]); ?>"><?php echo ($sub["name"]); ?></label>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </th>
            </tr>
            <tr class="">
              <td colspan="2" style="text-align: center;">
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
    var id = '<?php echo ($role["id"]); ?>';
    $(document).ready(function(){
        $('#save').click(function () {
            var chk_value =[];
            $('.wantInput > input[type=checkbox]:checked').each(function() {
                chk_value.push($(this).val());
            });
            console.log(chk_value);

            var data = {'id':id,'powers':chk_value};
            $.ajax({
                url: '/Admin/admin/roles_powers/rid/26.html',
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
        $('.selectAll').click(function(){
            var obj = $(this).data('id');
            if($(this).prop('checked')) {
                $("input[name='"+obj+"[]']").prop("checked",true);
            }else{
                $("input[name='"+obj+"[]']").prop("checked",false);
            }
        });
    });
</script>
</html>