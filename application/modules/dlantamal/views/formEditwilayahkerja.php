<?php 
$id=isset($data->id)?($data->id):'';
$imgdata=isset($data->imgdata)?($data->imgdata):'';	
$namadata=isset($data->namadata)?($data->namadata):'';	
$level=isset($data->level)?($data->level):'';	
$lat=isset($data->lat)?($data->lat):'';	
$lng=isset($data->lng)?($data->lng):'';	
$wilayah_kerja=isset($data->wilayah_kerja)?($data->wilayah_kerja):'';
$LLpolygon=json_encode($wilayah_kerja);
$LLlat=json_encode($lat);	
$LLlng=json_encode($lng);	
$dbicon=$this->db->get_where('tm_iconmarker',array('level'=>$level))->row();
    $icon=isset($dbicon->icon)?($dbicon->icon):'';

    if($icon!=''){
        $icon_1=''.base_url().'theme/images/marker/'.$icon.'';
    }else{
        $icon_1=''.base_url().'theme/images/marker/default.png';
    }             		
?>
<!-- google maps key -->
<script
	src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->m_konfig->konfigmaps(1)?>&callback=initMap&libraries=drawing&v=weekly"
	defer
></script>
<style>
#map_canvas_draw {
  height:400px;
  width: 100%;
  border :1px solid #000;
}
#map_canvas_show {
  height:400px;
  width: 100%;
  border :1px solid #000;
}
</style>
<div class="row">
    <div class="col-md-12">
        <center>MARKER NAME : <?php echo $namadata?></center>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <h6>DRAW POLYGON</h6>
        <div id="map_canvas_draw"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <div>Lattitude: <span id="latspan"></span></div>
                <div>Longitude: <span id="lngspan"></span></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <div>Lat Lng: <span id="latlong"></span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <h6>SHOW POLYGON</h6>
        <div id="map_canvas_show"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Lat Lng on click: </label>
            <textarea class="form-control" id="latlongclicked" rows="1"></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="comment">Coordinate Polygon</label>
            <input type="hidden" name="id" value="<?php echo $id?>">
            <textarea name="wilayah_kerja" class="form-control" id="coords" rows="5"><?php echo $wilayah_kerja?></textarea>
            </textarea>
            <button type="button" class="btn btn-default btn-sm mt-2" onclick="showPogon()">SHOW</button>
        </div>
    </div>
</div>


<script>
    var map;
    var myCenterLatLng;
    var markers = [];
    var gone = [];
    window.onload = function () {
        initMap();
    };
    
    <?php if($lat!='' && $lng!=''){?>
        var myCenterLatLng = { lat: <?php echo json_decode($LLlat) ?>, lng: <?php echo json_decode($LLlng) ?> };
    <?php }else{?>
        var myCenterLatLng = { lat: <?php echo $this->m_konfig->konfigmaps(2)?>, lng: <?php echo $this->m_konfig->konfigmaps(3)?> };
    <?php }?>

    function initMap() {
        map = new google.maps.Map(document.getElementById('map_canvas_draw'), {
            zoom: 5,
            center: myCenterLatLng,
            scaleControl: true,
            mapTypeId: google.maps.MapTypeId.CLOUDMADE,
            streetViewControl: false,
        });
        map.setOptions({ draggableCursor : "url(<?php echo base_url('theme/images/cursor-pin_a.png')?>), auto" });
        const marker = new google.maps.Marker({
            position: { lat: <?php echo json_decode($LLlat) ?>, lng: <?php echo json_decode($LLlng) ?> },
            icon: {
                url: '<?php echo $icon_1 ?>',
                labelOrigin: new google.maps.Point(16,-10),
                size: new google.maps.Size(35,35),
                anchor: new google.maps.Point(16,32)
            },
            label: {
                text: '<?php echo $namadata ?>',
                color: '#C70E20',
                background: "#000000",
                fontSize: '10px',
                fontWeight: "bold"
            },
            map: map
        });

        google.maps.event.addListener(map,'click',function(event) {
		    document.getElementById('latlongclicked').value = event.latLng.lat() + ', ' + event.latLng.lng()
        })
        google.maps.event.addListener(map,'mousemove',function(event) {
            document.getElementById('latspan').innerHTML = event.latLng.lat()
            document.getElementById('lngspan').innerHTML = event.latLng.lng()
            document.getElementById('latlong').innerHTML = event.latLng.lat() + ', ' + event.latLng.lng()
        });	


        var drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: ['polygon']
            },
        });
        google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
            var coordStr = "";
            for (var i = 0; i < polygon.getPath().getLength(); i++) {
            coordStr += polygon.getPath().getAt(i).toUrlValue(6) + ";";
            }
            document.getElementById('coords').value = coordStr.substring(0,coordStr.length - 1);
        });
        drawingManager.setMap(map);
        markers.push(marker);
        initMap_2();
    }

    function setMapOnAll(map) {      
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }
    function hideMarkerAll(){
        setMapOnAll(null);  
    }


    function initMap_2() {
        map = new google.maps.Map(document.getElementById('map_canvas_show'), {
            zoom: 5,
            center: myCenterLatLng,
            scaleControl: true,
            mapTypeId: google.maps.MapTypeId.CLOUDMADE,
            streetViewControl: false
        });
        const marker = new google.maps.Marker({
            position: { lat: <?php echo json_decode($LLlat) ?>, lng: <?php echo json_decode($LLlng) ?> },
            icon: {
                url: '<?php echo $icon_1 ?>',
                labelOrigin: new google.maps.Point(16,-10),
                size: new google.maps.Size(35,35),
                anchor: new google.maps.Point(16,32)
            },
            label: {
                text: '<?php echo $namadata ?>',
                color: '#C70E20',
                background: "#000000",
                fontSize: '10px',
                fontWeight: "bold"
            },
            map: map
        });
        showPogon();
    }
    
    function showPogon(){
        var gonLL = $('textarea#coords').val();
        showPgon();
    }
    function showPgon(){
        var gonLL = $('textarea#coords').val();
        //alert(gonLL);
        removeGone();
        var gonCoords=[];
        //var gonLL = <.?php echo $LLpolygon ?>;
        var n = gonLL.split(';');
        for (i=0; i<n.length; i++) 
        {         
            var [latitude, longitude] = n[i].split(',');
            var gonlatLng = new google.maps.LatLng(latitude, longitude);
            gonCoords.push(gonlatLng);
        }
        // Construct the polygon.
        const consPolygon = new google.maps.Polygon({
            paths: gonCoords,
            strokeColor: "#FFFFFF",
            strokeOpacity: 0.8,
            strokeWeight: 3,
            fillColor: "#f9bb00",
            fillOpacity: 0.35,
        });
        consPolygon.setMap(map);
        gone.push(consPolygon);
    }
    function removeGone() {
        for (i=0; i<gone.length; i++) 
        {                           
            gone[i].setMap(null);
        }
    }


</script>
