<div id="<?php echo $data['boxId'];?>" ><!--焦点图盒子-->
  <!--载入画面-->
  <div  class="__pic">
    <ul class="bxslider mF_pithy_tb">
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

    <div  id="bx-pager" class="__thumb" style="width: 142px; height: 600px; top: 441px;left:20px;position:absolute;">
        <ul >
            <li style="height: 34px;position:absolute;top:10px;z-index:10;" class=""><a data-slide-index="0" href=""><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:25px;z-index:9;" class=""><a data-slide-index="1" href=""><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:40px;z-index:8;" class="" ><a data-slide-index="2" href=""><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:55px;z-index:7;" class=""><a data-slide-index="3" href=""><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:70px;z-index:6;" class=""><a data-slide-index="4" href=""><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:85px;z-index:5;" class=""><a data-slide-index="5" href=""><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:100px;z-index:4;" class=""><a data-slide-index="6" href=""><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
            <li style="height: 34px;position:absolute;top:115px;z-index:3;" class=""><a data-slide-index="7" href=""><img src="/wxc/upload/small.png" style="height: 34px; width: 56px;"></a><b></b></li>
        </ul></div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
      $('.bxslider').bxSlider({
  pagerCustom: '#bx-pager'
});
    });
</script>