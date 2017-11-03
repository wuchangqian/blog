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
<link href="/Public/blog/css/post.css" rel="stylesheet">
<article>
    <div class="content">
        <div class="title">
            <?php echo ($post["title"]); ?>
        </div>
        <div class="nav_bar">
            <div class="post_bar">
                post time : <?php echo (date('Y-m-d H:i:s',$post["createtime"])); ?> &nbsp;&nbsp;
                category : <a href="category/<?php echo ($cate[$post['cate']]['url']); ?>.html"><?php echo ($cate[$post['cate']]['name']); ?></a>  &nbsp;&nbsp;
                author : <?php echo ($author[$post['uid']]); ?>
            </div>
        </div>
        <div class="content_area"><?php echo ($post["content"]); ?></div>
        <div class="foot_bar">
            <?php if(!empty($post['tags'])): if(is_array($post[tags])): foreach($post[tags] as $key=>$tag): if(!empty($tag)): ?><span class="tag_item">
                            <a href="/tag/<?php echo ($tags[$tag]['url']); ?>.html"><?php echo ($tags[$tag]['name']); ?></a>
                        </span><?php endif; endforeach; endif; endif; ?>
        </div>
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

<script type="text/javascript" src="/Public/lib/jquery/1.9.1/jquery.min.js"></script>
<script src="/Public/markdown/markdown.js"></script>
<script>
    $(window).ready(function(){
        var con = htmlspecialchars_decode($('.content_area').html());
        console.log(con);
        var html = markdown.toHTML(con);
        $('.content_area').html(html);
    });

    function htmlspecialchars_decode(str)
    {
        str = str.replace(/&lt;/g , '<' );
        str = str.replace(/&gt;/g , '>');
        return str;
    }
</script>
</body>
</html>