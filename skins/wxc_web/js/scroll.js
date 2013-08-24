function DUSroll(arr){
  this.ShowBox = $(arr.ShowBox);
  this.Show = $(arr.Show);
  this.ShowItem = $(arr.ShowItem);
  this.Show.width(this.ShowItem.length * (arr.ShowItemW));
  this.ScrollBox = $(arr.ScrollBox);
  this.Scroll = $(arr.Scroll);
  this.ShowBoxWidth = this.ShowBox.width();
  this.ShowWidth = $(arr.Show).width();
  this.ScrollBoxWidth = this.ScrollBox.width();
  if(this.ShowWidth > this.ShowBoxWidth){
    this.ScrollWidth = this.ShowBoxWidth / (this.ShowWidth / this.ShowBoxWidth);
    $(arr.Scroll).width(this.ScrollWidth);
  }
  this.ScrollWidth = $(arr.Scroll).width() + 15;
  this.status = false;
  this.L = 0;
  this.LMax = this.ScrollBoxWidth - this.ScrollWidth;
  this.SL = 0;
  this.SLMax = this.ShowWidth - this.ShowBoxWidth;
  var _this = this;

  this.ShowBox.bind({
    mousemove: function (){
      window.clearTimeout(_this.running);
    },
    mouseout: function (){
      _this.autoL();
    }
  })

  this.Scroll.bind("mousedown", function (){
    _this.status = true;
    return false;
  }).mousemove(function (e){
    if(_this.status){
      window.clearTimeout(_this.running);
      _this.getX(e.pageX);
      _this.Scroll.css("left", _this.L);
      _this.ShowBox.scrollLeft(_this.SL);
    }
  }).mouseup(function (){
    _this.status = false;
    window.clearTimeout(_this.running);
    _this.autoL();
  })

  $(document).mouseup(function (){
    _this.status = false;
  })

  _this.autoL();
  /*
  //鼠标滚轮事件
  this.Show.bind("mousewheel",function(e){
    //alert(e.wheelDelta);
    //当滚轮向下滚的时候 e.wheelDelta = -120,向上滚e.wheelDelta = 120
    if(e.wheelDelta == -120){
      _this.getX(false,1)
    }else{
      _this.getX(false,0)
    }
    _this.Scroll.css("left", _this.L);
    _this.ShowBox.scrollLeft( _this.SL);
  })

  this.Show.bind("DOMMouseScroll",function(e){
    //alert(e.detail);
    //当滚轮向下滚的时候 e.detail= 3,向上滚e.wheelDelta = -3
    if(e.detail == 3){
      _this.getX(false,1)
    }else{
      _this.getX(false,0)
    }
    _this.Scroll.css("left", _this.L);
    _this.ShowBox.scrollLeft( _this.SL);
  })
*/
}
DUSroll.prototype = {
  getX: function (x, o){
    if(!x){
      if(o == 1){
        this.L += 1;
      }else{
        this.L -= 1;
      }
    }else{
      this.L = x - this.ScrollBox.offset().left - parseInt(this.ScrollWidth / 2);
    }

    if(this.L > this.LMax){
      this.L = this.LMax;
    }
    if(this.L < 0){
      this.L = 0;
    }

    this.SL = parseInt((this.ShowWidth - this.ShowBoxWidth) / (this.ScrollBoxWidth - this.ScrollWidth) * this.L);

    if(this.SL > this.SLMax){
      this.SL = this.SLMax;
    }
    if(this.SL < 0){
      this.SL = 0;
    }
  },
  autoL: function (){
    var _this = this;
    if(this.ShowWidth > this.ShowBoxWidth){
      (function (){
        if(_this.L >= _this.LMax){
          _this.L = _this.LMax;
          _this.getX(false, 1);
          _this.Scroll.css('left', _this.L);
          _this.ShowBox.scrollLeft(_this.SL);
          _this.L = 0;
        }else if(_this.L == 0){
          _this.getX(true, 1);
          _this.Scroll.css('left', _this.L);
          _this.ShowBox.scrollLeft(_this.SL);
          _this.L = 1;
        }else{
          _this.getX(false, 1);
          _this.Scroll.css('left', _this.L);
          _this.ShowBox.scrollLeft(_this.SL);
        }
        _this.running = setTimeout(arguments.callee, 150);
      })();
    }
  }
}

