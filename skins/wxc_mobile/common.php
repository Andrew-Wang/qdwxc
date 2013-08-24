<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html dir="ltr" lang="en-US">
<head>
<title><?php echo $tag['seo.title']; ?></title>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">

<meta name="keywords" content="<?php echo $tag['seo.keywords']; ?>" />
<meta name="description" content="<?php echo $tag['seo.description'];  ?>" />
<link rel="stylesheet"  href="<?php echo $tag['path.skin']; ?>css/jquery.mobile-1.3.2.min.css">
<link rel="stylesheet" href="<?php echo $tag['path.skin']; ?>css/style.css" type="text/css" media="screen" />
<script type='text/javascript' src='<?php echo $tag['path.skin']; ?>js/jquery.js?ver=1.7.2'></script>
<script type='text/javascript' src='<?php echo $tag['path.skin']; ?>js/functions.js?ver=3.4.1'></script>
<script type='text/javascript' src='<?php echo $tag['path.skin']; ?>js/jquery.mobile-1.3.2.min.js'></script>
<script type='text/javascript' src='<?php echo $tag['path.skin']; ?>js/custom.js'></script>
</head>
<body>
<div data-role="page" data-quicklinks="true">

	<!-- leftpanel  -->
	<div data-role="panel" id="leftpanel" data-position="left" data-display="push" data-theme="e">

        <ul data-role="listview" data-inset="true" data-theme="e">
			<?php global $menus,$subs; ($subs[$_GET['p']]==null)?nav_sub($menus[$_GET['p']]['parentId'],1,0):nav_sub($_GET['p'],1,0); //侧导航调用的标签?>
		</ul>
	</div><!-- /leftpanel -->

    <div  class="w_header">
        <h1 class="logo"><a href="<?php echo $tag['path.root']; ?>/">万象城</a></h1>
        <div class="nav">
            <ul class="clearfix">
                <?php nav_custom('2,3,4,5,6,25')?>
            </ul>
        </div><!-- /navbar -->
    </div><!-- /header -->
	<!-- END OF HEADER -->
	<!-- BEGIN OF CONTENT -->
	
	<div data-role="content" style="height:100%;width:100%;">	
	<?php sys_parts() //内容调用的标签?>
	
	</div><!-- /content -->
	
	<div data-role="footer" data-position="fixed">
		<div class="menu_panel">
			<a href="#leftpanel" data-inline="true" data-shadow="false" data-iconshadow="false" data-icon="bars" data-iconpos="notext" data-role="button">Menu</a>
		</div>
		<div class="footer_btns">
			<a href="#" class="sina_weibo"><img src="<?php echo $tag['path.skin']; ?>images/sina_weibo.png"/></a>
			<a href="#" class="we_chat"><img src="<?php echo $tag['path.skin']; ?>images/we_chat.png"/></a>
			<a href="#" class="call_us"><img src="<?php echo $tag['path.skin']; ?>images/call_us.png"/></a>
		</div>
	</div><!-- /footer -->

</div><!-- /page -->
 </body>
</html>