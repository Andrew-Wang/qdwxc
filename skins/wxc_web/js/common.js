jQuery(function($){
  $('#hd-links').hover(
    function(){$(this).find('ul').show()},
    function(){$(this).find('ul').hide()}
  )

  $('#hd-nav>li').hover(
    function(){
      $(this).find('a').eq(0).addClass('current');
      $(this).find('.subnav').show();
    },
    function(){
      $('#hd-nav>li>a').removeClass('current');
      $(this).find('.subnav').hide()
    }
  )
})

function onKey(t,txt,s){
  if(s==1){
    t.value = t.value == '' ? txt : t.value;
  }else{
    t.value = t.value == txt ?'':t.value;
  }
}

function autoImgSize(obj, MAX_WIDTH, MAX_HEIGHT, IMG_MARGIN){
  var dImg = new Image();
  dImg.src = obj.src;
  dImg.onload = function (){
    var w = dImg.width;
    var h = dImg.height;
    var _this = obj;
    //对比图片宽高是否超出
    if(w > MAX_WIDTH || h > MAX_HEIGHT){
      if(w > MAX_WIDTH){
        //对比图片宽
        _this.style.width = parseInt(MAX_WIDTH) + 'px';
        _this.style.height = parseInt(dImg.height * MAX_WIDTH / dImg.width) + 'px';
        var h2 = parseInt(_this.style.height);
        //设置完宽,高超出时
        if(h2 > MAX_HEIGHT){
          _this.style.height = parseInt(MAX_HEIGHT) + 'px';
          _this.style.width = parseInt(parseInt(_this.style.width) * MAX_HEIGHT / h2) + 'px';
        }
      }else{
        //对比图片高
        _this.style.height = parseInt(MAX_HEIGHT) + 'px';
        _this.style.width  = parseInt(dImg.width * MAX_HEIGHT / dImg.height) + 'px';
        //设置完高,宽超出时
        var w2 = parseInt(_this.style.width);
        if(w2 > MAX_WIDTH){
          _this.style.width  = parseInt(MAX_WIDTH) + 'px';
          _this.style.height = parseInt(parseInt(_this.style.height) * MAX_WIDTH / w2) + 'px';
        }
      }
    }else{
      _this.style.width  = parseInt(dImg.width)+'px';
      _this.style.height = parseInt(dImg.height)+'px';
   }
    _this.style.marginLeft = parseInt(parseInt(MAX_WIDTH - parseInt(_this.style.width)) / 2) + 'px';
    _this.style.marginTop  = parseInt(parseInt(MAX_HEIGHT - parseInt(_this.style.height)) / 2) + 'px';
  }
  dImg.src = obj.src;
}

function $Tabs(id,className,s){
  $(id+' .tabs>li').each(function(i){
  if(!s){
    $(id+' .tabs>li').eq(1).addClass('bgnone');
  }
    $(this).click(function(){
      $(id+' .tabs>li').removeClass('current');
      if(!s){
        $(id+' .tabs>li').removeClass('bgnone');
        if(i>0){
          $(id+' .tabs>li').eq(0).addClass('bgnone');
        }
        $(this).next('li').addClass('bgnone');
      }
      $(this).addClass('current');
      $(id+' '+className).hide();
      $(id+' '+className).eq(i).show();
    })
  })
}



