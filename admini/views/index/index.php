<div class="noun">
  <div id="am_menu">
    <ul>
      <li class="amli hover" onclick="dex(0)">功能菜单</li>
      <li class="amli" onclick="dex(1)">最新新闻</li>
      <li class="amli" onclick="dex(2)">站点信息</li>
      <li class="amli" onclick="dex(3)">网站统计</li>
      <li class="amli" onclick="dex(4)">关于主机</li>
    </ul>
  </div>
  <div id="am_main">
    <div class="amcon func" id="block">
      <ul>
        <li> <a href="./index.php?m=system&s=managechannel">设计导航菜单</a>
          <p>从这里开始建设网站，给网站设定栏目。</p>
        </li>
        <li> <a href="./index.php?m=system&s=changeskin">模板管理</a>
          <p>选择或修改您喜欢的网站模板样式。</p>
        </li>
        <li> <a href="./index.php?m=system&s=options">站点设置</a>
          <p>设定网站基本信息和各项参数配制。</p>
        </li>
      </ul>
      <ul>
        <li> <a href="./index.php?m=system&s=userinfo">用户管理</a>
          <p>在这里创建您的用户账号以及分配用户权限。</p>
        </li>
        <li> <a href="./index.php?m=system&s=managemodel">模块管理</a>
          <p>在这里管理和查看模块属性。</p>
        </li>
        <li> <a href="./index.php?m=system&s=bakup">数据库管理</a>
          <p>垃圾数据清理，数据库备份、恢复、管理。</p>
        </li>
      </ul>
      <ul>
        <li> <a href="./index.php?m=system&s=flashoptions">广告管理</a>
          <p>控制首页焦点图中的轮换图片。</p>
        </li>
        <li> <a href="./index.php?m=system&s=managehtml">静态化设置</a>
          <p>网站页面静态化管理。</p>
        </li>
        <li> <a href="./index.php?m=system&s=manageresource">Ftp资源管理</a>
          <p>利用在线Ftp功能帮助清理垃圾数据和文件。</p>
        </li>
      </ul>
    </div>
    <div class="amcon amnew">
      <ul>
        <?php echo $news_list_content;?>
      </ul>
    </div>
    <style>
	.table_list{ border:2px solid #FFFFFF; border-width:2px 0 0 2px; margin:15px 0; background:#f8f8ff; }
	.table_list td,.table_list th{ padding:3px 5px; line-height:16px;border:2px solid #FFFFFF; border-width:0 1px 1px 0; text-align: left;}
	li {line-height: 22px; list-style:none;font-size: 12px;}
	.copy {line-height: 22px;font-family: PMingLiU, Verdana, serif;font-size: 12px;}
	.yellow{ color:#FF9900;}
	.red{ color:#FF0000;}
	.right{ padding-left:15px; background:url(images/right.gif) left center no-repeat;}
	.wrong{ padding-left:15px; background:url(images/wrong.gif) left center no-repeat;}
	.dis{ display:none}
	.red{ color:#F00}
	.green{ color:#690}
	.yelo{ color:#F60}
	.spacecount{ color:#000}
.webstatistic { width:98%; height:134px; margin:10px 0 0 10px; }
.webstatistic li { height:44px; float:left; width:16.45%; }
.webstatistic .stactop { border-top:1px solid #ddd; border-left:1px solid #ddd; }
.webstatistic li span { display:block; height:20px; text-align:center; line-height:20px; color:#666; }
.webstatistic li .atsn { background:#efefef; margin:2px 0 2px 2px; }
.webstatistic li .numb { background:#f8f8f8; margin:0 0 0 2px; }
.webstatistic .statop { border-top:1px solid #ddd; }
.webstatistic .statopc { border-top:1px solid #ddd; border-right:1px solid #ddd; padding-right:2px; }
.webstatistic .staleft { border-left:1px solid #ddd; }
.webstatistic .staright { border-right:1px solid #ddd; padding-right:2px; }
.webstatistic .stacbot { border-left:1px solid #ddd; border-bottom:1px solid #ddd; padding-bottom:2px; }
.webstatistic .stabot { border-bottom:1px solid #ddd; padding-bottom:2px; }
.webstatistic .stabotc { border-right:1px solid #ddd; border-bottom:1px solid #ddd; padding-bottom:2px; padding-right:2px; }
.main h4{ padding:20px 0; font-size:16px; text-align:center; font-weight:normal; color:#FDD90B;}
.main p{ padding:6px 0; text-indent:24px;}		
.main{ font-size:13px; font-family:"微软雅黑"; line-height:26px; padding:15px;}
.main a{ color:#FDD90B;}
.adintro{ margin:15px 0; border:1px dotted #ddd; padding:10px; background:#fff; color:#666;}
	</style>
    <?php
    $PHP_GD = '';
	if(extension_loaded('gd'))
	{
		if(function_exists('imagepng')) $PHP_GD .= '.png';
		if(function_exists('imagejpeg')) $PHP_GD .= ' .jpg';
		if(function_exists('imagegif')) $PHP_GD .= ' .gif';
	}
	?>
    <div class="amcon">
      <table width="100%" cellpadding="0" cellspacing="0" class="table_list">
        <tr>
          <th>检查项目</th>
          <th>当前环境</th>
          <th>建议环境</th>
          <th>功能影响</th>
        </tr>
        <tr>
          <td>操作系统</td>
          <td><?php echo php_uname();?></td>
          <td>Windows_NT/Linux/Freebsd</td>
          <td><span class="yellow">√</span></td>
        </tr>
        <tr>
          <td>web 服务器</td>
          <td><?php echo $_SERVER['SERVER_SOFTWARE'];?></td>
          <td>Apache/IIS</td>
          <td><span class="yellow">√</span></td>
        </tr>
        <tr>
          <td>php 版本</td>
          <td><?php echo phpversion();?></td>
          <td>php 5.0 及以上</td>
          <td><?php if(phpversion() >= '5.0.0'){ ?>
            <span class="yellow">√</span>
            <?php }else{ ?>
            <span class="red">无法正常使用</span>
            <?php }?></td>
        </tr>
        <tr>
          <td>mysql 版本</td>
          <td><?php global $db;echo $db->get_var('SELECT VERSION()');?></td>
          <td>mysql 5.0 及以上</td>
          <td><?php if((float)$db->get_var('SELECT VERSION()') >= '5.0'){ ?>
            <span class="yellow">√</span>
            <?php }else{ ?>
            <span class="red">无法正常使用</span>
            <?php }?></td>
        </tr>
        <tr>
          <td>mysql 扩展</td>
          <td><?php if(extension_loaded('mysql')){ ?>
            √
            <?php }else{ ?>
            ×
            <?php }?></td>
          <td>建议开启</td>
          <td><?php if(extension_loaded('mysql')){ ?>
            <span class="yellow">√</span>
            <?php }else{ ?>
            <span class="red">无法正常使用</span>
            <?php }?></td>
        </tr>
        <tr>
          <td>gd 扩展</td>
          <td><?php if($PHP_GD){ ?>
            √ （支持 <?php echo $PHP_GD;?>）
            <?php }else{ ?>
            ×
            <?php }?></td>
          <td>建议开启</td>
          <td><?php if($PHP_GD){ ?>
            <span class="yellow">√</span>
            <?php }else{ ?>
            <span class="red">不支持缩略图和水印</span>
            <?php }?></td>
        </tr>
        <tr>
          <td>ob_start 缓存</td>
          <td><?php if(function_exists(ob_start)){ ?>
            √ （支持网站静态化）
            <?php }else{ ?>
            <span class="red">×</span>
            <?php }?></td>
          <td>建议开启</td>
          <td><?php if(function_exists(ob_start)){ ?>
            <span class="yellow">√</span>
            <?php }else{ ?>
            <span class="red">不支持网站静态化</span>
            <?php }?></td>
        </tr>
      </table>
    </div>
    <div class="amcon">
      <ul class="webstatistic">
        <li class="stactop"><span class="atsn">图文模块</span><span class="numb">
          <?php global $db;if($db->get_var("SHOW TABLES LIKE '".TB_PREFIX."article'")==TB_PREFIX.'article')echo $db->get_var("SELECT count(*) FROM ".TB_PREFIX."article");?>
          </span></li>
        <li class="statop"><span class="atsn">文章列表</span><span class="numb">
          <?php global $db;if($db->get_var("SHOW TABLES LIKE '".TB_PREFIX."list'")==TB_PREFIX.'list')echo $db->get_var("SELECT count(*) FROM ".TB_PREFIX."list");?>
          </span></li>
        <li class="statop"><span class="atsn">图片模块</span><span class="numb">
          <?php global $db;if($db->get_var("SHOW TABLES LIKE '".TB_PREFIX."picture'")==TB_PREFIX.'picture')echo $db->get_var("SELECT count(*) FROM ".TB_PREFIX."picture");?>
          </span></li>
        <li class="statop"><span class="atsn">产品模块</span><span class="numb">
          <?php global $db;if($db->get_var("SHOW TABLES LIKE '".TB_PREFIX."product'")==TB_PREFIX.'product')echo $db->get_var("SELECT count(*) FROM ".TB_PREFIX."product");?>
          </span></li>
        <li class="statop"><span class="atsn">订单模块</span><span class="numb">
          <?php global $db;if($db->get_var("SHOW TABLES LIKE '".TB_PREFIX."order'")==TB_PREFIX.'order')echo $db->get_var("SELECT count(*) FROM `".TB_PREFIX."order`");?>
          </span></li>
        <li class="statopc"><span class="atsn">google地图</span><span class="numb">
          <?php global $db;if($db->get_var("SHOW TABLES LIKE '".TB_PREFIX."mapshow'")==TB_PREFIX.'mapshow')echo $db->get_var("SELECT count(*) FROM ".TB_PREFIX."mapshow");?>
          </span></li>
        <li class="staleft"><span class="atsn">招聘模块</span><span class="numb">
          <?php global $db;if($db->get_var("SHOW TABLES LIKE '".TB_PREFIX."jobs'")==TB_PREFIX.'jobs')echo $db->get_var("SELECT count(*) FROM ".TB_PREFIX."jobs");?>
          </span></li>
        <li><span class="atsn">投票系统</span><span class="numb">
          <?php global $db;echo $db->get_var("SELECT count(*) FROM ".TB_PREFIX."poll_category");?>
          </span></li>
        <li><span class="atsn">友情链接</span><span class="numb">
          <?php global $db;echo $db->get_var("SELECT count(*) FROM ".TB_PREFIX."linkers");?>
          </span></li>
        <li><span class="atsn">视频模块</span><span class="numb">
          <?php global $db;echo $db->get_var("SELECT count(*) FROM ".TB_PREFIX."video");?>
          </span></li>
        <li><span class="atsn">留言模块</span><span class="numb">
          <?php global $db;echo $db->get_var("SELECT count(*) FROM ".TB_PREFIX."guestbook");?>
          </span></li>
        <li class="staright"><span class="atsn">下载模块</span><span class="numb">
          <?php global $db;echo $db->get_var("SELECT count(*) FROM ".TB_PREFIX."download");?>
          </span></li>
        <li class="stacbot"><span class="atsn">列表调用</span><span class="numb">
          <?php global $db;echo $db->get_var("SELECT count(*) FROM ".TB_PREFIX."calllist");?>
          </span></li>
        <li class="stabot"><span class="atsn"></span><span class="numb"></span></li>
        <li class="stabot"><span class="atsn"></span><span class="numb"></span></li>
        <li class="stabot"><span class="atsn"></span><span class="numb"></span></li>
        <li class="stabot"><span class="atsn"></span><span class="numb"></span></li>
        <li class="stabotc"><span class="atsn"></span><span class="numb"></span></li>
      </ul>
    </div>
    <div class="amcon">

    </div>
  </div>
  <div class="clr"></div>
</div>
<div class="clear"></div>
<div class="admin_info">
  <p><span>服务器IP</span><?php echo $_SERVER['SERVER_ADDR'] ?></p>
  <p><span>站点状态</span><?php echo WEBOPEN?'开启':'关闭'; ?></p>
  <div class="spaceuse"> <span>空间统计</span>
    <div id="space">
      <div id="using"></div>
    </div>
    <span style="padding-left:12px;" id="num"> 计算中...</span> <span>
    <input type="button" value="重新计算" onclick="recounts()" id="countbut" />
    </span></div>
  <div class="clr"></div>
</div>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$.ajax({
		type:"POST",
		url:"index.php?a=readDirSize",
		timeout:"100000",
		async  :true,
		cache:false,                                
		success: function(html){
			if(parseInt(html)<=<?php echo WEBSIZE?>)
				$("#using").animate({width:(parseInt(html)/<?php echo WEBSIZE?WEBSIZE:'500'?>*100).toFixed(2)+"%"},1000);
			else
				$("#using").css({width:"100%",background:"#F00"});
			$("#num").empty();
			$("#num").append(parseInt(html)+"MB/<a class='spacecount' href='./index.php?m=system&s=options' title='点击修改空间总容量'><?php echo WEBSIZE?WEBSIZE:'500'?> MB</a> ("+(parseInt(html)/<?php echo WEBSIZE?WEBSIZE:'500'?>*100).toFixed(2)+"%)");
		},
		error:function(){	
		}
	});
})
function recounts()
{
	document.getElementById("countbut").disabled=true;
	$("#using").css({width:"100%"});	
	$("#num").empty();
	$("#num").append('计算中...');
	document.getElementById("countbut").value="请稍后...";
	$.ajax({
		type:"POST",
		url:"index.php?a=readDirSize&type=retry",
		timeout:"100000",
		async  :true,
		cache:false,                                
		success: function(html){	
			if(parseInt(html)<=<?php echo WEBSIZE?>)
				$("#using").animate({width:(parseInt(html)/<?php echo WEBSIZE?WEBSIZE:'500'?>*100).toFixed(2)+"%"},1000);
			else
				$("#using").css({width:"100%",background:"#F00"});
			$("#num").empty();
			$("#num").append(parseInt(html)+"MB/<a class='spacecount' href='./index.php?m=system&s=options' title='点击修改空间总容量'><?php echo WEBSIZE?WEBSIZE:'500'?> MB</a> ("+(parseInt(html)/<?php echo WEBSIZE?WEBSIZE:'500'?>*100).toFixed(2)+"%)");
			document.getElementById("countbut").disabled=false;
			document.getElementById("countbut").value="重新计算";
		},
		error:function(){	
		}
	});
}
</script> 