<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> <html
dir="ltr" lang="en- US"> <head> <title><?php echo $tag['seo.title']; ?></title> <meta charset="utf-8"> <meta
content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"> <meta content="yes"
name ="apple-mobile-web-app-capable"> <meta content="black" name="apple-mobile-web- app-status-bar-style"> <meta
content="telephone=no" name="format-detection"> <META HTTP-EQUIV="Pragma" CONTENT="no-cache"> <meta name="keywords"
content="<?php echo $tag['seo.keywords']; ?>" /> <meta name="description" content="<?php echo $tag['seo.description'];
?>" /> <link rel="stylesheet" href="<?php echo $tag['path.skin']; ?>css/jquery.mobile-1.3.2.min.css"> <link
rel="stylesheet" href="<?php echo $tag['path.skin']; ?>css/style.css" type="text/css" media="screen" /> <script
type='text/javascript' src='<?php echo $tag['path.skin']; ?>js/jquery.js?ver=1.7.2'></script> <script
type='text/javascript' src='<?php echo $tag['path.skin']; ?>js/functions.js?ver=3.4.1'></script> <script
type='text/javascript' src='<?php echo $tag['path.skin']; ?>js/jquery.mobile-1.3.2.min.js'></script> <script
type='text/javascript' src='<?php echo $tag['path.skin']; ?>js/custom.js'></script>
<!--*********************图片墙************************--> <noscript>
			<style>
				.ib-main a{
					cursor:pointer;
				}
				.ib-main-wrapper{
					position:absolute;
					top:0px;
					bottom:24px;
					overflow:scroll;
				}
			</style>
		</noscript>
		<script id="previewTmpl" type="text/x-jquery-tmpl">
			<div id="ib-img-preview" class="ib-preview">
                <img src="${src}" alt="" class="ib-preview-img"/>
                <span class="ib-preview-descr" style="display:none;">${description}</span>
                <div class="ib-nav" style="display:none;">
                    <span class="ib-nav-prev">Previous</span>
                    <span class="ib-nav-next">Next</span>
                </div>
                <span class="ib-close" style="display:none;">Close Preview</span>
                <div class="ib-loading-large" style="display:none;">Loading...</div>
            </div>		
		</script>
		<script id="contentTmpl" type="text/x-jquery-tmpl">	
			<div id="ib-content-preview" class="ib-content-preview">
                <div class="ib-teaser" style="display:none;">{{html teaser}}</div>
                <div class="ib-content-full" style="display:none;">{{html content}}</div>
                <span class="ib-close" style="display:none;">Close Preview</span>
            </div>
		</script>	
</head> <body> <div data-role="page" data- quicklinks="true">

	
	<div  class="w_header">
		<h1 class="logo"><a href="<?php echo $tag['path.root']; ?>/">万象城</a></h1>
        <div class="nav"  style="line-height:26px;">
            <ul class="clearfix">
				<?php nav_custom('2,3,4,5,6,25')?>
			</ul>
		</div><!-- /navbar -->
	</div><!-- /header -->
	
	<div data-role="content">
	<div id="slider">
		 <div class="container">
  
            <div id="ib-main-wrapper" class="ib-main-wrapper">
                <div class="ib-main">
                    <a href="#"><img src="<?php echo $tag['path.skin']; ?>images/thumbs/1.jpg" data-largesrc="<?php echo $tag['path.skin']; ?>images/large/1.jpg" alt="image01"/><span></span></a>
					<a href="#"><img src="<?php echo $tag['path.skin']; ?>images/thumbs/2.jpg" data-largesrc="<?php echo $tag['path.skin']; ?>images/large/1.jpg" alt="image02"/><span></span></a>
					<a href="#"><img src="<?php echo $tag['path.skin']; ?>images/thumbs/3.jpg" data-largesrc="<?php echo $tag['path.skin']; ?>images/large/1.jpg" alt="image03"/><span></span></a>
					<a href="#"><img src="<?php echo $tag['path.skin']; ?>images/thumbs/4.jpg" data-largesrc="<?php echo $tag['path.skin']; ?>images/large/1.jpg" alt="image04"/><span></span></a>
					<a href="#"><img src="<?php echo $tag['path.skin']; ?>images/thumbs/5.jpg" data-largesrc="<?php echo $tag['path.skin']; ?>images/large/1.jpg" alt="image05"/><span></span></a>
					<a href="#"><img src="<?php echo $tag['path.skin']; ?>images/thumbs/6.jpg" data-largesrc="<?php echo $tag['path.skin']; ?>images/large/1.jpg" alt="image06"/><span></span></a>
					<a href="#"><img src="<?php echo $tag['path.skin']; ?>images/thumbs/7.jpg" data-largesrc="<?php echo $tag['path.skin']; ?>images/large/1.jpg" alt="image07"/><span></span></a>
					<a href="#"><img src="<?php echo $tag['path.skin']; ?>images/thumbs/8.jpg" data-largesrc="<?php echo $tag['path.skin']; ?>images/large/1.jpg" alt="image08"/><span></span></a>
					<a href="#"><img src="<?php echo $tag['path.skin']; ?>images/thumbs/9.jpg" data-largesrc="<?php echo $tag['path.skin']; ?>images/large/1.jpg" alt="image09"/><span></span></a>
					<div class="clr"></div>
				</div><!-- ib-main -->
            </div><!-- ib-main-wrapper -->
        </div>
	</div>
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
		<script type="text/javascript" src="<?php echo $tag['path.skin']; ?>js/jquery.tmpl.min.js"></script>
        <script type="text/javascript" src="<?php echo $tag['path.skin']; ?>js/jquery.kinetic.js"></script>
		<script type="text/javascript" src="<?php echo $tag['path.skin']; ?>js/jquery.easing.1.3.js"></script>
</div><!-- /page -->
</body>
</html>