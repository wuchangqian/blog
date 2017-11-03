<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" type="text/css" href="__PUBLIC__/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/h-ui.admin/css/style.css" />
    <title>跳转提示</title>
</head>
<body>
<div class="page-container">
    <article class="page-404 minWP text-c">
        <p class="error-title">
            <i class="Hui-iconfont va-m">
                <?php if(isset($message)){ ?>
                &#xe659;
                <?php }else{ ?>
                &#xe660;
                <?php } ?>

            </i>
            <span class="va-m">
                <?php if(isset($message)){ ?>
                    操作成功
                <?php }else{ ?>
                    操作失败
                <?php } ?>
            </span>
        </p>
        <p class="error-description">
            <?php if(isset($message)){ ?>
                <?php echo($message); ?>
            <?php }else{ ?>
                <?php echo($error); ?>
            <?php } ?>
        </p>
        <p class="jump">
            页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
        </p>
    </article>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>