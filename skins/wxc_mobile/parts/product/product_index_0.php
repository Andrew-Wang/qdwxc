<?php
    // 为方便并保证您以后的快速升级 请使用SHL提供的如下全局数组
	
	// 数组定义/config/dt-global.php
	
	// 如有需要， 请去掉注释，输出数据。
	/*
	echo '<pre>';
		print_r($tag);
	echo '</pre>';
	*/
?>
<style type="text/css">
<!--
.products_list{ font-size:12px;}
.products_list h2 { color: #727171; font-size: 14px; margin: 15px 0 5px;}
.products_list ul li { clear: both; height: 190px; padding:0 15px;  width:99%; list-style:none; border-bottom:1px solid #ccc;}
.products_list ul li.p { padding-top: 5px;}
.products_list dl { float: left; margin-top: 15px;}
.products_list .info { height: 90px; line-height: 14px; margin-top: 10px; overflow: hidden; width: 310px;}
.products_list .p_list1 { color: #4D4D4D; width:180px; padding-top:8px;}
.products_list .p_list1 dt {  width:160px; height:120px; text-align:center; padding:5px; border:1px solid #eaeaea;}
.products_list .p_list2  a{color:#1E6BC5;}
.products_list .p_list2  a:hover{color:#26B170;}
.products_list .p_list2 { color: #727171; margin-left: 40px; width:50%; padding-top:10px;}
.products_list .p_list2 dd { margin-top: 2px;}
.products_list .p_list3 { padding:80px 0 0 20px; width: 100px;}
.products_list .p_list3 dd { clear: both; line-height: 28px;}
.products_list .p_list3 img { float: left;  margin: 5px 8px 0 0;}
.products_list .p_list3 a:link, .products_list .p_list3 a:visited { font-size:12px; color: #9B9B9B; text-decoration: underline;}
.products_list .p_list3 a:hover { color: #E20E0E; text-decoration: underline;}
#articeBottom { font-size: 14px; margin: 6px 0 10px; padding-top: 10px; text-align: right; width: 97%;}
.details{height:90px; overflow:hidden; line-height:25px;}
.details h2{ font-size:12px; font-weight:normal;}
-->
</style>
<link rel="stylesheet" href="<?php echo $tag['path.skin']; ?>res/css/colorbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo $tag['path.skin'];?>res/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $tag['path.skin'];?>res/js/jquery.colorbox.js"></script>
<script>
	$(document).ready(function(){
		$(".colorbox").colorbox({rel:'colorbox', transition:"fade"});
	});
</script>
<!--
以下为订单系统，如有需要自行去掉注释
<div style="margin-bottom:15px; height:25px;">
	<span class="pic_more"><a href="<?php echo sys_href($request['p'],'product_basket')?>" title="查看"><img src="<?php echo $tag['path.skin']; ?>res/images/basket/cart.jpg" width="118" height="25" /></a></span>
</div>
-->
<div class="products_list"> 
	<ul>
<?php
    
	if( !empty( $tag['data.results'] ) )
	{	
		foreach($tag['data.results'] as $k =>$data)
	    {
		  ?>

	<li>
            <dl class="p_list1">
              <dt><a class="colorbox" href="<?php echo $data['originalPic']?>" title="<?php echo $data['title']; ?>"><img src="<?php echo $data['smallPic']; ?>" width="160" height="120" alt="<?php echo $data['description'];?>"></a></dt>
            </dl>
            <dl class="p_list2">
	      <dd style="font-size:14px; color:#27AE73; margin-bottom:14px;"><strong><a href="<?php echo sys_href($data['channelId'],'product',$data['id'])?>"><?php echo $data['title']; ?></a></strong></dd>
              <dd class="details"><h2>产品摘要：<?php echo $data['description']; ?></h2></dd>
            </dl>
            <dl class="p_list3">
              <dd><a href="<?php echo sys_href($data['channelId'],'product',$data['id'])?>"><img src="<?php echo $tag['path.skin']; ?>res/images/product_05.png">详细参数</a></dd>
              <dd><a href="<?php echo sys_href($data['channelId'],'product_intobasket',$data['id'])?>"><img src="<?php echo $tag['path.skin']; ?>res/images/product_06.png">加入购物车</a></dd>
            </dl>
          </li>
	

		 <?php
        }
    }
    else
    {
        echo '<br />暂无产品列表。';
    }
?>
</ul>
</div>
  <div class="clear"></div>
  <div  id="articeBottom"><?php if(!empty($tag['pager.cn'])) echo $tag['pager.cn']; ?></div>