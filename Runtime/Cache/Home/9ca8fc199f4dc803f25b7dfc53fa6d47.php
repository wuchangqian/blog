<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <title><?php echo ($conf["webName"]); ?></title>
    <meta name="keywords" content="<?php echo ($conf["keywords"]); ?>" />
    <meta name="description" content="<?php echo ($conf["description"]); ?>" />
    <link href="/Public/blog/css/base.css" rel="stylesheet">
    <link href="/Public/blog/css/index.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/Public/blog/js/modernizr.js"></script>
    <![endif]-->
    <script src="/Public/blog/js/scrollReveal.js"></script>

</head>
<body>
<header>
    <div class="logo" data-scroll-reveal="enter right over 1s">
        <a href="/"><font size="18"><?php echo ($conf["webName"]); ?></font></a>
    </div>
    <nav class="topnav" data-scroll-reveal="enter bottom over 1s after 1s">
        <a href="/"><span>所有文章</span><span class="en">ALL</span></a>
        <?php if(is_array($GCate)): $i = 0; $__LIST__ = $GCate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/category/<?php echo ($vo["url"]); ?>.html"><span><?php echo ($vo["name"]); ?></span><span class="en"><?php echo ($vo["name"]); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
    </nav>
</header>
<article>
<div class="container">
    <ul class="cbp_tmtimeline">
        <?php if(is_array($posts)): $i = 0; $__LIST__ = $posts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$post): $mod = ($i % 2 );++$i;?><li>
                <time class="cbp_tmtime"><span><?php echo (date('m-d',$post["createtime"])); ?></span> <span><?php echo (date('Y',$post["createtime"])); ?></span></time>
                <div class="cbp_tmicon"></div>
                <div class="cbp_tmlabel" data-scroll-reveal="enter right over 1s" >
                    <h2><?php echo ($post["title"]); ?></h2>
                    <p>
                        <span class="blogpic">
                            <a href="/">
                                <?php if(empty($post['img'])): ?><img src="/Public/blog/images/t03.jpg">
                                <?php else: ?>
                                    <img src="<?php echo ($post["img"]); ?>"><?php endif; ?>

                            </a>
                        </span>
                        <div style="max-height: 60px;overflow: hidden">
                            <?php echo (mb_substr(strip_tags($post["content"]),0,180,'utf-8')); ?>
                        </div>

                    </p>
                    <a href="/post/<?php echo ($post['url']); ?>.html" target="_blank" class="readmore">阅读全文&gt;&gt;</a>
                </div>

            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
</article>
<footer style="padding: 15px 0;font-family: tahoma,Arial;font-size: 12px;color: #999;line-height: 22px;text-align: center;">
    <?php echo ($conf["copyright"]); ?> <a href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action" target="_blank"><?php echo ($conf["icp"]); ?></a>
</footer>
<script>
	if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
		(function(){
			window.scrollReveal = new scrollReveal({reset: true});
		})();
	};
</script> 
</body>
</html>