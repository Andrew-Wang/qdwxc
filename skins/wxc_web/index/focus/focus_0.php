<script type="text/javascript" src="<?php echo $myfocus_js;?>"></script><!--引入myFocus库-->
<script type="text/javascript">
myFocus.set({id:'<?php echo $data['boxId'];?>',pattern:'<?php echo $data['pattern'];?>', time:<?php echo $data['times'];?>,trigger:'<?php echo $data['adTrigger'];?>',width:<?php echo $data['width'];?>,height:<?php echo $data['height'];?>,txtHeight:'<?php echo $data['txtHeight'];?>'});
</script>

<div id="<?php echo $data['boxId'];?>" ><!--焦点图盒子-->
  <div class="__loading"><img src="<?php echo $tag['path.skin']?>res/plug-in/myfocus/pattern/img/loading.gif" alt="请稍候..." /></div>
  <!--载入画面-->
  <div  class="__pic">
    <ul>
    <!--内容列表-->
    <?php
    foreach($flash['results'] as $data)
    {
   ?>
      <li><a href="<?php echo $data['url'];?>" target="_blank"><img src="<?php echo $data['picpath'];?>" thumb="<?php echo $data['thumbpath'];?>" alt="<?php echo $data['title'];?>" text="<?php echo $data['summary'];?>" /></a></li>
      <?php
    }
    ?>
    </ul>
  </div>
    <div class="__thumb" style="width: 142px; height: 600px; top: 452px;">
        <ul >
            <li style="height: 34px;position:absolute;top:10px;z-index:10;" class=""><a><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:25px;z-index:9;" class=""><a><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:40px;z-index:8;" class=""><a><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:55px;z-index:7;" class=""><a><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:70px;z-index:6;" class=""><a><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:85px;z-index:5;" class=""><a><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:100px;z-index:4;" class=""><a><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:115px;z-index:3;" class=""><a><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
        </ul></div>
</div>
<script type="text/javascript">
    $('.__thumb ul li').click(function() {
        $('.__next-2').click();
    });
</script>