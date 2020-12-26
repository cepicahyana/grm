<style>
#map_canvas {
  height:400px;
  width: 100%;
}
#m_tom_full{
    position: absolute;
    z-index: 1;
    top:75px;
    right:10px;
}

.btnmaps{
    background-color: rgb(255, 255, 255); border: 2px solid rgb(255, 255, 255); border-radius: 3px; box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 3px;
}
</style>
<div id="m_tom_full">
    <button type="button" class="btn btn-icon btnmaps of" onclick="openFullscreen();" title="Fullscreen">
        <i class="icon-size-fullscreen"></i>
    </button>
    <button type="button" class="btn btn-icon btnmaps cf" onclick="closeFullscreen();" style="display:none;" title="End Fullscreen">
        <i class="icon-size-actual"></i>
    </button>
</div>
<div id="map_canvas"></div>


<script>
var elem = document.documentElement;
/* View in fullscreen */
function openFullscreen() {
   $('.of').hide();
   $('.cf').show();
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.webkitRequestFullscreen) { /* Safari */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE11 */
    elem.msRequestFullscreen();
  }
}
/* Close fullscreen */
function closeFullscreen() {
   $('.of').show();
   $('.cf').hide();
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) { /* Safari */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE11 */
    document.msExitFullscreen();
  }
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    
    $(".resAll").on('click', function(){
        resetMarker();
    });
  
});
</script>
<script>
    function history_track_kri(id){
        //alert('history');
        var form = $("#"+id);
        var url = base_url+'maps_kri/history_track_kri';
        $.ajax({
            url: url,
            data: $(form).serialize(),
            type: 'POST',
            dataType: 'JSON',
            beforeSend: function() {
		        $('#msg_'+id+'').addClass('fa fa-spinner fa-spin');
		    },
            success: function(markersOnMap){
                $('#msg_'+id+'').removeClass('fa fa-spinner fa-spin');
                if(markersOnMap.length >= 1){
                resetMarker();
                showPline(markersOnMap);
                }else{
                    alert('No history');
                }
            }
        });
    }
</script>

<script>
    var map;
    var InforObj = [];
    var markersOnMap; 
    var markers = [];
    var line = [];
    
    window.onload = function () { 
        initMap(); singleMarker();
    };
    function CenterControl(controlDiv, map) {
        // Set CSS for the control border.
        const controlUI = document.createElement("div");
        controlUI.style.backgroundColor = "#fff";
        controlUI.style.border = "2px solid #fff";
        controlUI.style.borderRadius = "3px";
        controlUI.style.boxShadow = "0 1px 3px rgba(0,0,0,.2)";
        controlUI.style.cursor = "pointer";
        controlUI.style.marginTop = "70px";
        controlUI.style.marginRight = "10px";
        controlUI.style.marginBottom = "5px";
        controlUI.style.textAlign = "center";
        controlUI.title = "Recenter the map";
        controlDiv.appendChild(controlUI);
        // Set CSS for the control interior.
        const controlText = document.createElement("div");
        controlText.style.color = "rgb(25,25,25)";
        controlText.style.fontFamily = "Roboto,Arial,sans-serif";
        controlText.style.fontSize = "20px";
        controlText.style.lineHeight = "30px";
        controlText.style.paddingTop = "4px";
        controlText.style.paddingLeft = "8px";
        controlText.style.paddingRight = "8px";
        controlText.innerHTML = "<i class='icon-target'></i>";
        controlUI.appendChild(controlText);
        // Setup the click event listeners: simply set the map to Chicago.
        controlUI.addEventListener("click", () => {
            map.setCenter({ lat: <?php echo $this->m_konfig->konfigmaps(2)?>, lng: <?php echo $this->m_konfig->konfigmaps(3)?> });
        });
    }
    function initMap() {
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 5,
            center: { lat: <?php echo $this->m_konfig->konfigmaps(2)?>, lng: <?php echo $this->m_konfig->konfigmaps(3)?> },
            scaleControl: true,
            mapTypeId: google.maps.MapTypeId.CLOUDMADE,
            streetViewControl: false,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_TOP,
            },
            zoomControl: true,
            zoomControlOptions: {
                 position: google.maps.ControlPosition.LEFT_CENTER,
            },
            fullscreenControl: false,
            
        });
        //add div center control
        const centerControlDiv = document.createElement("div");
        CenterControl(centerControlDiv, map);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(centerControlDiv);

        //addMarkerInfo();
    }
    function singleMarker(){
        var fm = 'fm';
        var course = 'fm';
        var url = base_url+'maps_kri/get_fm';
        $.ajax({
            url: url,
            data: "fm="+fm+"&ak="+course,
            type: 'POST',
            dataType: 'JSON',
            success: function(markersOnMap){
                showMarker(markersOnMap);
            }
        });
    }
    /*function addMarkerInfo() {
        for (var i = 0; i < markersOnMap.length; i++) {
            var contentString = '<div id="content"><h3>' + markersOnMap[i].placeName + '</h3>' + markersOnMap[i].descCription;
            const marker = new google.maps.Marker({
                position: markersOnMap[i].LatLng[0],
                map: map
            });
            const infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 200
            });
            marker.addListener('click', function () {
                closeOtherInfo();
                infowindow.open(marker.get('map'), marker);
                InforObj[0] = infowindow;
            });
            // marker.addListener('mouseover', function () {
            //     closeOtherInfo();
            //     infowindow.open(marker.get('map'), marker);
            //     InforObj[0] = infowindow;
            // });
            // marker.addListener('mouseout', function () {
            //     closeOtherInfo();
            //     infowindow.close();
            //     InforObj[0] = infowindow;
            // });
        }
    }*/
    function closeOtherInfo() {
        if (InforObj.length > 0) {
            InforObj[0].set("marker", null);
            InforObj[0].close();
            InforObj.length = 0;
        }
    }
    function setMapOnAll(map) {      
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    function showMarker(markersOnMap){ 
        for (var i = 0; i < markersOnMap.length; i++) {
            var level = markersOnMap[i].level;
            var latitude = markersOnMap[i]['LatLng'].lat;
            var longitude = markersOnMap[i]['LatLng'].lng;
            var aa = $.parseJSON(latitude);
            var bb = $.parseJSON(longitude);
            var contentString = markersOnMap[i].infoMarker;
            var iconmar = markersOnMap[i].icons;
           
            if(level==3){
                var labels = markersOnMap[i].placeName;
            }else{
                var labels = null;
            }
            
            const marker = new google.maps.Marker({
                position: {lat: aa, lng: bb},
                icon: {
                    url: iconmar,
                    labelOrigin: new google.maps.Point(20, 20),
                    size: new google.maps.Size(35,35),
                    anchor: new google.maps.Point(16,32)
                },
                label: {
                    text: labels,
                    color: '#C70E20',
                    fontSize: '10px'
                },
                map: map
            });
            const infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 400
            });
            marker.addListener('click', function () {
                closeOtherInfo();
                infowindow.open(marker.get('map'), marker);
                InforObj[0] = infowindow;
            });
            marker.locType = level;
            markers.push(marker);
        }
        
    }


    function showPline(markersOnMap){
        var aa;
        var bb;
        var lineCoords=[];

        for (var i = 0; i < markersOnMap.length; i++) {
            var kp = markersOnMap[i].idkri;
            var tg = markersOnMap[i].tanggal;
            var ll = markersOnMap[i].LatLng;

            var level = markersOnMap[i].level;
            var placeName = markersOnMap[i].placeName;
            var iconmar = markersOnMap[i].icons;
           
            if(level==3){
                var labels = markersOnMap[i].placeName;
            }else{
                var labels = null;
            }


            for (var key in ll) {
                // skip loop if the property is from prototype
                if (!ll.hasOwnProperty(key)) continue;
                var obj = ll[key];

                for (var prop in obj) {
                    if (!obj.hasOwnProperty(prop)) continue;
                    //alert(prop.length); //jumlah data
                    //alert(prop + " = " + obj[prop]); cek key val
                    var latitude = obj['lat']; 
                    var longitude = obj['lng'];
                    var aa = parseFloat(latitude);
                    var bb = parseFloat(longitude);
                    var linelatLng = new google.maps.LatLng(aa, bb);
                    var tginArr = key.split(' '); 
                    var tg_in = tginArr[0].split('-');
                    var tm_in = tginArr[1];
                    var tgin = tg_in[1] + '-' + tg_in[2] + '-' + tg_in[0];

                    lineCoords.push(linelatLng);
                    const consPolyline = new google.maps.Polyline({
                        path: lineCoords,
                        geodesic: true,
                        strokeColor: "#FF0000",
                        strokeOpacity: 1.0,
                        strokeWeight: 3,
                    });
                    consPolyline.setMap(map);
                    line.push(consPolyline);
                    const path = consPolyline.getPath();
                    // Because path is an MVCArray, we can simply append a new coordinate
                    // and it will automatically appear.
                    path.push(linelatLng);
                    // Add a new marker at the new plotted point on the polyline.

                    const marker = new google.maps.Marker({
                        position: {lat: aa, lng: bb},
                        icon: {
                            url: iconmar,
                            labelOrigin: new google.maps.Point(20, 20),
                            size: new google.maps.Size(35,35),
                            anchor: new google.maps.Point(16,32)
                        },
                        label: {
                            text: labels,
                            color: '#C70E20',
                            fontSize: '10px'
                        },
                        map: map
                    });
                    const infowindow = new google.maps.InfoWindow({
                        content: "<div style='height:auto;'><h3>"+placeName+"</h3><div class='tborder'><table style='font-size:10px'><tbody><tr style='font-size:11px'><td class='text-left'>Lat</td><td class='text-left'>"+aa+"</td></tr><tr style='font-size:11px'><td class='text-left'>Long</td><td class='text-left'>"+bb+"</td></tr><tr style='font-size:11px'><td class='text-left'>Date</td><td class='text-left'>"+tgin+"</td></tr><tr style='font-size:11px'><td class='text-left'>Time</td><td class='text-left'>"+tm_in+"</td></tr></tbody></table></div></div>",
                        maxWidth: 400
                    });
                    marker.addListener('click', function () {
                        closeOtherInfo();
                        infowindow.open(marker.get('map'), marker);
                        InforObj[0] = infowindow;
                    });
                    markers.push(marker);
                } 
            }
        }
    }
    function removeLine() {
        for (i=0; i<line.length; i++) 
        {                           
             line[i].setMap(null); //or line[i].setVisible(false);
        }
        hideMarkerAll();
    }

    
    function hideMarkerAll(){
        setMapOnAll(null);  
    }

    function hideMarkersOfType(type) {
        var i = markers.length;
        while(i--) {
            if (markers[i].locType == type) {
                markers[i].setVisible(false);
            }
        }
    }
    function resetMarker(){
        $(".fm").prop('checked', false); //change "select all" checked status to false
        hideMarkerAll();
        removeLine();
        singleMarker();
    }
</script>




<script>
$(document).ready(function(e) {
	var hheight = $(window).height();
	$('#map_canvas').css('height', hheight);
	$(window).resize(function(){
		var hheight = $(window).height();
		$('#map_canvas').css('height', hheight);
	});
});
</script>

<script>
function update_tracking_kri(){
    var track_lat = '-4.187608945390835';
    var track_lng = '110.14316333842572';
    alert(track_lat+','+track_lng);
    $.ajax({
        url:'<?php echo site_url("maps_kri/update_tracking_kri"); ?>',
        data: 'track_lat='+track_lat+'&track_lng='+track_lng,
        method:"POST",
        //dataType:"JSON",
        success: function(data)
        { 	   	  
            if(data["table"]==true){
                toastr['success']("Successfully update");
            }else{
                notif("<b>Proscess Failed!!</b>");
            }
        }		
    });
}
</script>