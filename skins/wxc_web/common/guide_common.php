<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0042)http://www.themixc.com/wxc/MixClub/21.aspx -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title> 青岛万象城</title>
    <meta name="robots" content="all,follow">
    <meta name="Keywords" content="华润中心万象城,华润中心,万象城">
    <meta name="Description" content="万象城，中国购物中心行业的领跑者，倡导国际化的消费理念，彰显时尚品味与优雅格调，引领全新的生活方式与消费潮流。在这个18.8万平方米的时尚殿堂，品牌零售、特色餐饮交相辉映，娱乐休闲、文化风情异彩纷呈。前沿魅力、和谐体验，尽在华润·万象城。">
    <link rel="stylesheet" href="<?php echo $tag['path.skin']; ?>css/subpage.css">
    <script type="text/javascript" src="<?php echo $tag['path.skin']; ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo $tag['path.skin']; ?>js/common.js"></script>
    <script type="text/javascript" src="<?php echo $tag['path.skin']; ?>js/slide.js"></script>
    <!-- bxSlider Javascript file -->
    <script src="<?php echo $tag['path.skin']; ?>js/jquery.bxslider.min.js"></script>
    <!-- bxSlider CSS file -->
    <link href="<?php echo $tag['path.skin']; ?>js/jquery.bxslider.css" rel="stylesheet" />
    <link href="<?php echo $tag['path.skin']; ?>res/plug-in/myfocus/pattern/mF_pithy_tb.css" rel="stylesheet" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/templates/mixc/wxc/scripts/DD_belatedPNG.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('.ie6png');
    </script>
    <![endif]-->
    <link rel="icon" type="image/x-icon" href="/wxc/favicon.ico" />
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
                <img src="<?php echo $tag['path.skin']; ?>images/sina_weibo.gif"></a>
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
        var nid = "11";
        //上级栏目
        var parentid = "6";
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
                window.location = "";
        });
    </script>

    <!-- /header -->

    <div id="content">
        <div class="banner"><img src="<?php echo $tag['path.skin']; ?>images/inside_banner/wanxiangzhinan.jpg" alt=""></div>


        <div class="bodymain know clearfix">

            <div class="location ie6png">
                <span>您的位置：</span>
                <?php nav_location("&nbsp;&gt;&nbsp;", "万象城"); ?>
            </div>

            <div class="sidebar">
                <ul class="menu">
                    <?php global $menus,$subs; ($subs[$_GET['p']]==null)?nav_sub($menus[$_GET['p']]['parentId'],1,0):nav_sub($_GET['p'],1,0); //侧导航调用的标签?>
                </ul>
            </div>

            <div class="main">
                <div class="restore details">
                    <table style="width: 100%; height: 707px">
                        <tbody>
                        <tr>
                            <td class="know_content" style="vertical-align: top">
                                <?php doc_focus(3,0,0,0,0,true,'ordering',0) ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p>&nbsp;</p>
                </div>
            </div>

        </div>

    </div>
    <!-- /content -->
    <div id="footer">
        <img src="<?php echo $tag['path.skin']; ?>images/ft.png" alt="" class="ie6png">
    </div>
    <!-- /footer --></div>
<style type="text/css">
    .mF_pithy_tb_guide_focus {
        background: transparent;
    }
    .restore ul, .restore ol {
        padding:0px;
    }
    #guide_slider {
        width:720px;
        position:relative;
    }
</style>
<script type="text/javascript">
    var zIndex = 99;
    $('.select_s').each(function(i){
        var _this = $(this);
        zIndex = zIndex - i;
        $(this).css('z-index',zIndex);
        _this.hover(
            function(){$(this).find('ul').stop(true,true).animate({ height: 'show'},300)},
            function(){$(this).find('ul').stop(true,true).animate({ height: 'hide'},1)}
        )
        _this.find('li').click(function(){
            _this.find('h4').html($(this).html());
            _this.find('input').eq(0).val($(this).attr('value'));
            _this.find('ul').hide();
        })
    })
    $(".menu li").each(function() {
        if (this.id == "21")
            $(this).addClass("current");
    });

</script>

<!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=slide&amp;img=4&amp;pos=right&amp;uid=3814934" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
var bds_config={"bdTop":274};
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<!-- Baidu Button END -->
</body></html>