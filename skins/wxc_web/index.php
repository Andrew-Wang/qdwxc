<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>万象城</title>
    <meta name="robots" content="all,follow">
    <meta name="Keywords" content="万象城">
    <meta name="Description" content="万象城">
    <link rel="stylesheet" href="<?php echo $tag['path.skin']; ?>css/index.css">
    <script type="text/javascript" src="<?php echo $tag['path.skin']; ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $tag['path.skin']; ?>js/common.js"></script>
    <script type="text/javascript" src="<?php echo $tag['path.skin']; ?>js/slide.js"></script>
    <!--[if IE 6]>
    <script type="text/javascript" src="/templates/mixc/wxc/scripts/DD_belatedPNG.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('.ie6png');
    </script>
    <![endif]-->
</head>

<body>
<div id="t_bg" class="ie6png"></div>
<div id="wrapper">
    <div id="header" class="ie6png">
        <h1 class="logo"><a href="<?php echo $tag['path.root']; ?>" class="ie6png">万象城</a></h1>

        <div class="nav ie6png">
            <ul id="hd-nav">
        <?php nav_main() //主导航调用的标签?>
                </ul>
          </div>

        <div class="links" id="hd-links">
            <a href="javascript:void(0);">登录</a>
			<div style="position:absolute;right:0;top:0;"><a href="javascript:void(0);">注册</a></div>
        </div>
        <div class="weibo"><a target="_blank" href="http://e.weibo.com/qlmixc">
                <img src="<?php echo $tag['path.skin']; ?>images/W091735305A098925.gif"></a>
        </div>
       
        <div class="search2">
            <div class="input_s">
                <input type="text" id="searchtxt" name="text2" value="全站搜索" class="text" onblur="onKey(this,&#39;全站搜索&#39;,1)" onclick="onKey(this,&#39;全文搜索&#39;,0)"><input type="button" class="submit" id="searchglobal" value=" "></div>
        </div>
    </div>

    <script type="text/javascript">
        $('#hd-nav>li').each(function(i) {
            $(this).attr('id', 'nav_li_' + i);
        })
        var nid = "6";
        //上级栏目
        var parentid = "0";
        $("#hd-nav li").removeClass("current");
        $("#hd-nav li").each(function() {
            if (this.id == nid || this.id == parentid)
                $(this).attr("class", "current");

        });
        $("#searchglobal").click(function() {
            var searchtxt = $("#searchtxt").val();
            if (searchtxt == "" || searchtxt == "全文搜索")
                alert("请输入搜索内容");
            else
                window.location = "/Search.aspx?type=global&key=" + escape(searchtxt);
        });
    </script>

    <!-- /header -->
    <div id="content">
        <div class="slide">
            <ul class="big" id="big_wrap">
                <li style="z-index: 1; display: none;"> <a href="http://themixc.com/ShopDir/DMMagazine/index.aspx?id=963" target="_blank">  <img src="<?php echo $tag['path.skin']; ?>images/banner/01.jpg" alt=""></a></li>
                <li style="z-index: 2; display: none;"><a href="<?php echo $tag['path.root']; ?>/?p=14&mdtp=3"><img src="<?php echo $tag['path.skin']; ?>images/banner/02.jpg" alt=""></a></li>
                <li style="z-index: 9;"><a href="<?php echo $tag['path.root']; ?>/?p=14&mdtp=3"><img src="<?php echo $tag['path.skin']; ?>images/banner/03.jpg" alt=""></a></li>
                <li style="display: none; z-index: 4;"><a href="<?php echo $tag['path.root']; ?>/?p=15"><img src="<?php echo $tag['path.skin']; ?>images/banner/04.jpg" alt=""></a></li>
                <li style="display: none; z-index: 5;"><a href="<?php echo $tag['path.root']; ?>/?p=14"><img src="<?php echo $tag['path.skin']; ?>images/banner/05.jpg" alt=""></a></li>
            </ul>
            <ul class="small ie6png" id="small">
                <li class="">1</li>
                <li class="">2</li>
                <li class="current">3</li>
                <li>4</li>
                <li>5</li>
            </ul>
        </div>
        <script type="text/javascript">
            //<![CDATA[
            new jQSlide('big_wrap','small',1,5000);
            //]]>
        </script>
        <div class="main">

            <ul class="happy_nav">
                <li>
                    <h3>悦府</h3>
                    <p><a href="<?php echo $tag['path.root']; ?>/?p=61"><img src="<?php echo $tag['path.skin']; ?>images/index-1.jpg" alt=""></a></p>
                </li>
                <li>
                    <h3>华润大厦</h3>
                    <p><a href="<?php echo $tag['path.root']; ?>/?p=62"><img src="<?php echo $tag['path.skin']; ?>images/index-2.jpg" alt=""></a></p>
                </li>
                <li>
                    <h3>悦玺</h3>
                    <p><a href="<?php echo $tag['path.root']; ?>/?p=63"><img src="<?php echo $tag['path.skin']; ?>images/index-3.jpg" alt=""></a></p>
                </li>
                <li>
                    <h3>柏悦酒店</h3>
                    <p><a href="<?php echo $tag['path.root']; ?>/?p=64"><img src="<?php echo $tag['path.skin']; ?>images/index-4.jpg" alt=""></a></p>
                </li>
            </ul>

            <div class="dm_box">
                <h3>DM杂志</h3>
                <a href="http://www.themixc.com/wxc/DMMagazine/index.aspx" class="more" target="_blank">更多&gt;</a>

                <a href="#" target="_blank"><img src="<?php echo $tag['path.skin']; ?>images/H01150925D48AAE7E.jpg" alt="" class="image"></a>
                <div class="dm_box_r">
                    <h4 class="h4t"><a href="http://www.themixc.com/ShopDir/DMMagazine/index.aspx?id=963" target="_blank">2013年8月刊</a></h4>
                    <h4 class="h4t"><a href="http://www.themixc.com/ShopDir/DMMagazine/index.aspx?id=958" target="_blank">2013年7月份DM</a></h4>
                    <h4 class="h4t"><a href="http://www.themixc.com/ShopDir/DMMagazine/index.aspx?id=940" target="_blank">2013年6月刊</a></h4>
                </div>
            </div>
        </div>
    </div>
    <!-- /content -->
    <div id="footer">
        <img src="<?php echo $tag['path.skin']; ?>images/ft.png" alt="" class="ie6png">
        <!--
            营业时间：周日-周四 10:00-22:00
                      周五-周六 10:00-22:30
                      服务热线： (86 755) 8266 8266
            &copy; 2011华润︱万象城。保留所有权利 citycrossing.com.cn allrights reserved. 粤ICP备06032566号
 -->
<span style="display:none"><script src="./深圳万象城_files/stat.php" language="JavaScript"></script>
<script src="./深圳万象城_files/cnzz_core.php" charset="utf-8" type="text/javascript">
</script><a href="http://www.cnzz.com/stat/website.php?web_id=3761835" target="_blank" title="站长统计">站长统计</a></span>
    </div>
    <!-- /footer --></div>
<script type="text/javascript">
    var id = 0;

    var zIndex = 99;
    $('.select_s').each(function(i) {
        var _this = $(this);
        zIndex = zIndex - i;
        $(this).css('z-index', zIndex);
        _this.hover(
            function() { $(this).find('ul').stop(true, true).animate({ height: 'show' }, 300) },
            function() { $(this).find('ul').stop(true, true).animate({ height: 'hide' }, 1) }
        )
        _this.find('li').click(function() {
            _this.find('h4').html($(this).html());
            _this.find('input').eq(0).val($(this).attr('value'));
            _this.find('ul').hide();
        })
    })
    function switchmagazine(year) {
        var _downul = $('#downnode');
        jQuery.get("/Ajax/AjaxMethod.aspx", { type: "getmagazineul", curryear: year, tempid: Math.random() }, function(data, textStatus) {
            _downul.html(data);
            id = _downul.find("ul").find("li").last().attr("id");
            _downul.each(function(i) {
                zIndex = zIndex - i;
                $(this).css('z-index', zIndex);
                _downul.hover(
                    function() { $(this).find('ul').stop(true, true).animate({ height: 'show' }, 300) },
                    function() { $(this).find('ul').stop(true, true).animate({ height: 'hide' }, 1) }
                )
                _downul.find('li').click(function() {
                    _downul.find('h4').html($(this).html());
                    id = this.id;
                    _downul.find('ul').hide();
                });
            });

            /*
             $(".prev a").click(function() {
             });
             $(".next a").click(function() {
             });
             */

        });
    }
    //购物搜索
    $("#shopsearch").click(function() {
        var searchtype = $("#shoptype h4").html();
        var searchkey = $("#shopkey").val();
        //location = "/SearchShop.aspx?type=shop&cate=" + escape(searchtype) + "&key=" + escape(searchkey);
    });
    //转到杂志页
    $("input[class='btn']").click(function() {
        //window.open( "/ShopDir/DMMagazine/index.aspx?id=" + id);
    });
</script>


</body></html>