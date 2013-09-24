<?php
/*初始化参数
*  by grysoft (狗头巫师)
*  QQ:767912290
*  nav_sub_custom 调用频道导航 子栏目的样式标签
*  样式文件存于 index文件夹下 nav_sub_custom_style.php 中。
* 
*  第一参数：指定频道下栏目调用，不填则默认当前栏目。
*  第二参数：指定所调用样式文件 nav_sub_custom_style.php 中style 的数值，默认不填则为 sub_custom_0.php。 
*  第三参数：是否同时展开子类，默认不填则为展开。
*  
*  此标签内置一递增变量 $i ,以方便制作各种样式的菜单, 此变量可在此文件中任意地方调用。;
* 
*/

$select ='class="select"';  //选中状态的样式，若无选中状态，可不添加。
$target ='target="_blank"'; //外链则弹出新窗口，若不需弹出新窗口可清空此变量。
$ico = ispic($data['originalPic'])?'<img src="'.$data['originalPic'].'" />':''; //栏目图标，可在后台栏目缩略图处上传
$select = $params['id']==$data['id']?$select:''; 
$target = $data['isTarget']?$target:'';

// URGLY HACK CODE
if (in_array($data['id'], array(5,6,11,15,17,20,25,16,12,13,18,21,22,26,27,28,65,66,67,68,76))) { 
	$url = 'javascript:void(0)';
	$l_style= 'cursor:default;color:darkgray;';
	$target = "";
}else {
	$l_style = 'cursor:pointer';
}
?>
<li><a href="<?php echo $url?>" <?php echo $target?> style="<?php echo $l_style; ?>"><?php echo $data['title'];?></a>
	<?php if ($_GET['p'] == $data['id'] && $_GET['p'] == '47'): ?>
		
			<li class="subleft"><a href="?p=47#a1">公司简介</a></li>
			<li class="subleft"><a href="?p=47&mdtp=2#a1">差异化生意模式</a></li>
			<li class="subleft"><a href="?p=47&mdtp=3#a1">企业公民</a></li>
			<li class="subleft"><a href="?p=47&mdtp=4#a1">企业文化</a></li>
			<li class="subleft"><a href="?p=47&mdtp=5#a1">历史与荣誉</a></li>
		
	<?php endif; ?>
	<?php if ($_GET['p'] == $data['id'] && $_GET['p'] == '49'): ?>
		
			<li class="subleft"><a href="?p=49&mdtp=1#a">橡树湾学府系列</a></li>
			<li class="subleft"><a href="?p=49&mdtp=2#a">橡树湾英伦系列</a></li>
			<li class="subleft"><a href="?p=49&mdtp=3#a">凤凰城精品都市</a></li>
			<li class="subleft"><a href="?p=49&mdtp=4#a">百万平米城中城</a></li>
			<li class="subleft"><a href="?p=49&mdtp=5#a">特色高端作品</a></li>
			<li class="subleft"><a href="?p=49&mdtp=6#a">低密度大平层作品</a></li>
			<li class="subleft"><a href="?p=49&mdtp=7#a">住宅+区域商业</a></li>
			<li class="subleft"><a href="?p=49&mdtp=8#a">万象城都市综合体</a></li>
			<li class="subleft"><a href="?p=49&mdtp=9#a">住宅+欢乐颂</a></li>
			
		
	<?php endif; ?>
	<?php if ($_GET['p'] == $data['id'] && $_GET['p'] == '52'): ?>
		
			<li class="subleft"><a href="?p=52">青岛</a></li>
			<li class="subleft"><a href="?p=52&mdtp=7">淄博</a></li>
			<li class="subleft"><a href="?p=52&mdtp=2">日照</a></li>
			<li class="subleft"><a href="?p=52&mdtp=3">威海</a></li>
			<li class="subleft"><a href="?p=52&mdtp=4">烟台</a></li>
			<li class="subleft"><a href="?p=52&mdtp=5">济南</a></li>
			<li class="subleft"><a href="?p=52&mdtp=6">临沂</a></li>
			<li class="subleft"><a href="?p=52&mdtp=8">太原</a></li>
		
	<?php endif; ?>

	<?php if ($_GET['p'] == $data['id'] && $_GET['p'] == '46'): ?>
		
			<li class="subleft"><a href="?p=46&mdtp=2">消费品</a></li>
			<li class="subleft"><a href="?p=46&mdtp=3">电力</a></li>
			<li class="subleft"><a href="?p=46&mdtp=4">地产</a></li>
			<li class="subleft"><a href="?p=46&mdtp=5">水泥</a></li>
			<li class="subleft"><a href="?p=46&mdtp=6">燃气</a></li>
			<li class="subleft"><a href="?p=46&mdtp=7">医药</a></li>
			<li class="subleft"><a href="?p=46&mdtp=8">金融</a></li>
		
	<?php endif; ?>

	<?php if ($_GET['p'] == $data['id'] && $_GET['p'] == '78'): ?>
		
			<li class="subleft"><a href="javascript:void(0);" style="cursor:default;">公司新闻</a></li>
			<li class="subleft"><a href="?p=78">媒体报道</a></li>
		
	<?php endif; ?>
</li>