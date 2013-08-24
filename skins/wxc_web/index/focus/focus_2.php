<div class="wrap" id="marquee1">
    <ul style="width:3000px">
    <?php
    foreach($flash['results'] as $data)
    {
   ?>
      <li><a href="<?php echo $data['url'];?>" target="_blank"><img src="<?php echo $data['picpath'];?>" thumb="" alt="<?php echo $data['title'];?>" text="<?php echo $data['summary'];?>" width="140" height="110"/></a></li>
      <?php 
    }
    ?>
    <?php if (count($flash['results']) < 6): ?>
        <?php
        foreach($flash['results'] as $data)
        {
            ?>
            <li><a href="<?php echo $data['url'];?>" target="_blank"><img src="<?php echo $data['picpath'];?>" thumb="" alt="<?php echo $data['title'];?>" text="<?php echo $data['summary'];?>" width="140" height="110"/></a></li>
        <?php
        }
        ?>
        <?php endif; ?>
	</ul>
</div>
