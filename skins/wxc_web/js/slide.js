function jQSlide(a,b,c,d){
  this.Big = a;
  this.Small = b;
  this.Eve =c;
  this.Tim = d;
  if(!this.Big){return;}
  this.Count = $('#'+this.Big+' > li').length;
	if(this.Count<2){return;}
  this.I = 0;
  this.N = 0;
  this.attZindex();
  this.Play();
  this.Event();
}
jQSlide.prototype = {
  Play:function(){
    var _this=this;
    (function(){
      if(_this.N>0){
        if( _this.I >= _this.Count ){_this.I =0}
        $('#'+_this.Small+' > li').removeClass('current');
        $('#'+_this.Small+' > li').eq(_this.I).addClass('current');
        //$('#'+_this.Big+' > li:visible').fadeOut(400);
        $('#'+_this.Big+' > li').hide();
        _this.attZindex();
        $('#'+_this.Big+' > li').eq(_this.I).css('z-index','9')
        $('#'+_this.Big+' > li').eq(_this.I).fadeIn(1000);
      }
      _this.N=1;
      _this.I++;
      _this.running=setTimeout(arguments.callee, _this.Tim);
    })();
  },Event:function(){
    var _this=this;
    $('#'+_this.Small+' > li').each(function(i){
      if(_this.Eve==1){
        $(this).click(function(){
          window.clearTimeout(_this.running);
          _this.I = i;
          _this.Play();
        });
      }else{
        $(this).hover(function(){
          window.clearTimeout(_this.running);
          _this.I = i;
          _this.Play();
        });
      }
    })
  },attZindex:function(){
    $('#'+this.Big+'>li').each(function(i){
      $(this).css('z-index',i+1);
    })
  }
}
