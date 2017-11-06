<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo ($conf["keywords"]); ?>" />
    <meta name="description" content="<?php echo ($conf["description"]); ?>" />
    <meta name="author" content="balun wang">
    <link rel="shortcut icon" href="../../docs-/Public/tmp2/ico/favicon.png">

    <title><?php if(!empty($post['title'])): echo ($post['title']); ?> -<?php endif; ?> <?php echo ($conf["webName"]); ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/Public/tmp2/css/bootstrap.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="/Public/tmp2/css/main.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Static navbar -->
<div class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Balun Wang</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php if(is_array($GCate)): $i = 0; $__LIST__ = $GCate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="/category/<?php echo ($vo["url"]); ?>.html"><?php echo ($vo["name"]); ?> <span class="badge"><?php echo ($vo["num"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<?php if(is_array($posts)): $k = 0; $__LIST__ = $posts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$post): $mod = ($k % 2 );++$k;?><div id="<?php if($k%2==0){echo 'grey';}else{echo 'white';} ?>">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<h4><?php echo ($post["title"]); ?></h4>
					<p>
						<i>POST IN : </i>
						<bd><a><?php echo (date('F d ,Y',$post["createtime"])); ?></a></bd>
						<i>CATEGORY : </i>
                        <bd><a href="/category/<?php echo ($cate[$post['cate']]['url']); ?>.html"><?php echo ($cate[$post['cate']]['name']); ?></a> </bd>
                        <?php if(!empty($post['tags'])): ?><i>TAGS : </i>
                            <?php if(is_array($post[tags])): foreach($post[tags] as $key=>$tag): if(!empty($tag)): ?><span class="tag_item">
										<bd><a href="/tag/<?php echo ($tags[$tag]['url']); ?>.html"><?php echo ($tags[$tag]['name']); ?></a></bd>
									</span><?php endif; endforeach; endif; endif; ?>
					</p>
					<p><?php echo (mb_substr(strip_tags($post["content"]),0,180,'utf-8')); ?></p>
					<p><a href="/post/<?php echo ($post['url']); ?>.html">继续瞅...</a></p>
				</div>
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /grey --><?php endforeach; endif; else: echo "" ;endif; ?>
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h4>Contacts</h4>
                <p>
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    <a href="mailto:balun-wang@qq.com">balun-wang@qq.com</a>
                </p>
            </div><!-- /col-lg-4 -->

            <div class="col-lg-4">
                <h4>My Links</h4>
                <p>
                    <a href="https://github.com/juelite" rel="nofollow" target="_blank">Github</a><br/>
                    <a href="http://www.yuuuu.wang">Balun Wang</a><br/>
                    <a href="http://lts.yuuuu.wang">LTS</a>
                </p>
            </div><!-- /col-lg-4 -->

            <div class="col-lg-4">
                <h4>CopyRight</h4>
                <p>
                    <?php echo ($conf["copyright"]); ?>
                    <br/>
                    <bd><a href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action" target="_blank"><?php echo ($conf["icp"]); ?></a></bd>
                </p>
            </div><!-- /col-lg-4 -->

        </div>

    </div>
</div>
<script src="/Public/tmp2/js/bootstrap.min.js"></script>
</body>
</html>