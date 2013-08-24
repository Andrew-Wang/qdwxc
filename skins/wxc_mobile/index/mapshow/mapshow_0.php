<script src="http://ditu.google.cn/maps?file=api&amp;v=2&amp;key=<?php echo $data['mapKey']; ?>&sensor=true" type="text/javascript"></script>
<script type="text/javascript">
window.g = {};
window.$ = function (id) { return document.getElementById(id) };

window.onload = function () {
	if (GBrowserIsCompatible()) {
		g.map = new GMap2($("map"));
		
		g.map.addControl(new GLargeMapControl());
		g.map.addControl(new GMapTypeControl());
		g.map.addControl(new GScaleControl());
				
		g.map.setCenter(new GLatLng(<?php echo empty($data['lat'])?'39.90627970711568':$data['lat'] ?>,<?php echo empty($data['lng'])?'116.3975715637207':$data['lng'] ?>),13);
		//定义一个经纬度点
		var point = new GLatLng(<?php echo empty($data['lat'])?'39.90627970711568':$data['lat'] ?>,<?php echo empty($data['lng'])?'116.3975715637207':$data['lng'] ?>);
		//定义一个标注对象
		var marker = new GMarker(point);
		//在地图上加入泡泡提示
		var info ="<?php echo $data['title']?>"+"<br><b>联系电话：</b><?php echo $data['phone']?><br><b>公司地址：</b><?php echo $data['address']?>";
		marker.openInfoWindowHtml('<b>公司名称:</b> '+ info);

		//在地图上加入标注
		g.map.addOverlay(marker);
						
        GEvent.addListener(g.map, "click", function(overlay, latlng) {       
			if (latlng) {
				var myHtml = "点击坐标为: [" + latlng.lat() + "," + latlng.lng() + "]";
			 
				$('lat').value=latlng.lat();
				$('lng').value=latlng.lng();
					
				g.map.openInfoWindow(latlng, myHtml);
			}
		});	
		g.geocoder = new GClientGeocoder();
	}
}
		
function showAddress(address) {
	if (g.geocoder) {
		g.geocoder.getLatLng(
			address,
			function(point) {
				if (!point) {
					alert("不能解析: " + address);
				} else {
					g.map.clearOverlays();
					g.map.setCenter(point, 15);
					var marker = new GMarker(point);
					g.map.addOverlay(marker);
					marker.openInfoWindowHtml(address+"<br/>纬度"+point.lat()+"经度："+point.lng());		  
				}
			}
		);
	}
}
</script>    
         <div id="map" style=" <?php if (intval($data['width'])>100) echo 'width:'.$data['width'].'px;'; else echo 'width:95%;'; ?> height: <?php echo empty($data['height'])?'400':$data['height'] ?>px; margin: 0 0 10px; border: 5px solid #ccc;"> </div>