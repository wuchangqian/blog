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
<link href="/Public/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/Public/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/Public/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Public/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>后台登录 - Balun-Wang</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <div class="msg_box">111</div>
    <form class="form form-horizontal" action="/admin" method="post">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="username" name="username" type="text" placeholder="账户" class="input-text size-L" value="<?php echo ($user["username"]); ?>">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="password" name="password" type="password" placeholder="密码" class="input-text size-L" value="<?php echo ($user["vp"]); ?>" data-secret="<?php echo ($user["password"]); ?>">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input class="input-text size-L" type="text" id="verifyCode" name="verifyCode" placeholder="验证码" onblur="if(this.value==''){this.value='验证码'}" onclick="if(this.value=='验证码'){this.value='';}" value="验证码" style="width:150px;">
          <img id="verityImg" src="<?php echo U('tools/valid/code');?>"> <a id="kanbuq" href="javascript:;">看不清，换一张</a> </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <label for="online">
            <input type="checkbox" name="online" id="online" value="1" <?php if(($user["online"]) == "1"): ?>checked<?php endif; ?>>
            使我保持登录状态</label>
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input id="login" type="button" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright WY by H-ui.admin v3.1</div>
<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/h-ui/js/H-ui.min.js"></script>
<script>
    $(document).ready(function(){
        $('#kanbuq').click(function(){
            refresh();
        });
        
        function refresh() {
            $('#verityImg').attr('src' , "<?php echo U('tools/valid/code');?>");
        }

        var u = '<?php echo ($user["username"]); ?>' , p = '<?php echo ($user["password"]); ?>';
        if(u && p){
            $('#verifyCode').val('');
            $('#verifyCode').focus();
        }
        $('#username').keyup(function () {
            $('#password').val('');
        });

        $('#login').click(function () {
            var username = $('#username').val() , password , verifyCode = $('#verifyCode').val();
            if ($('#password').data('secret')) {
                password = $('#password').data('secret')+'[secret]';
            }else{
                password = $('#password').val();
            }
            var data = {'username':username , 'password':password , 'verifyCode':verifyCode};
            $.ajax({
                url: '/admin',
                type: 'POST',
                data: data,
                success: function (res) {
                    refresh();
                    if(res.code < 0){
                        $('.msg_box').html(res.msg);
                        $('.msg_box').fadeIn("slow");
                        setTimeout(function(){
                            $('.msg_box').fadeOut("slow");
                        },3000)
                    }else{
                        window.location.href = res['data'].jump;
                    }
                },
                error: function (res) {

                }
            });
        })
    })
</script>
</body>
</html>