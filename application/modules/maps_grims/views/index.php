<style>
#map_canvas {
  height:400px;
  width: 100%;
}
#top_canvas{
    padding-top: 60px;
}
#m_logo{
    position: absolute;
    z-index: 1;
    margin-top:10px;
    margin-left:10px;
}

#m_tom_logout{
    position: absolute;
    z-index: 1;
    top:10px;
    right:10px;

}
#m_tom_range{
    position: absolute;
    z-index: 1;
    top:10px;
    right:65px;
}
#m_tom_notif{
    position: absolute;
    z-index: 1;
    top:10px;
    right:120px;
}
#m_tom_back{
    position: absolute;
    z-index: 1;
    top:65px;
    right:10px;
}
#m_tom_full{
    position: absolute;
    z-index: 1;
    top:120px;
    right:10px;
}

#m_info_position{
    position: absolute;
    z-index: 1;
    bottom:20px;
    left:40%;
    background:#fff;
    opacity: 0.8;
    color:#000;
    font-size: 11px;
    padding:4px;
    border-radius: 3px;
}


.btnmaps{
    background-color: rgb(255, 255, 255); border: 2px solid rgb(255, 255, 255); border-radius: 3px; box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 3px;
}
.btnmaps_notif{
    background-color: rgb(255, 255, 255); border: 2px solid rgb(255, 255, 255); border-radius: 3px; box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 3px; width:100%;padding-top:5px;padding-left:6px;padding-right:6px;
}
.notifa{
    font-size:10px;
    margin-top:-5px;
}

.gm-style .gm-style-iw-c{
    background-color: rgba(0, 0, 0, 0.4);
}
.gm-style .gm-style-iw-t::after{
    opacity:0.6;
}



</style>
<!--div id="top_canvas"></div-->

<?php $img1=$this->m_konfig->konfigurasi(4);
if($img1!=''){
$img_1=''.base_url().'theme/images/'.$img1.'';
}else{
$img_1='';
}
?>

<div id="m_logo">
    <img src="<?php echo $img_1; ?>">
</div>
<div id="m_tom_logout">
    <button type="button" class="btn btn-icon btnmaps" onclick="logout()" title="Logout">
        <i class="icon-logout"></i>
    </button>
</div>
<div id="m_tom_range">
    <button type="button" class="btn btn-icon btnmaps" onclick="sidebar_right()" title="History KRI">
        <i class="icon-calendar"></i>
    </button>
</div>
<div id="m_tom_notif">
    <button type="button" class="btn btn-icon btnmaps_notif" data-toggle="dropdown" aria-expanded="false" title="Notification">
        <i class="icon-bell"></i> <span class="badge bg-danger notifa">16</span>
    </button>	
    <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn" style="width:340px;margin-left:-225px;">
        <div class="quick-actions-header" style="background:#6893B3;">
            <span class="title mb-1">Notification</span>
        </div>
        <div class="quick-actions-scroll scrollbar-outer">
            <div class="quick-actions-items">
                <div class="row m-0">
                    <div class="col-6 col-md-6 col-xs-12 p-2">
                        <h5>SEGERA</h5>
                        <ul class="list-group list-group-bordered list">
                            <li class="list-group-item" style="padding:4px 8px;">
                            <a href="#">
                            <span style="font-size:12px;">Langgar Batas <span class="badge bg-danger text-white">2</span></span>
                            </a>
                            </li>
                            <li class="list-group-item" style="padding:4px 8px;">
                            <a href="#">
                            <span style="font-size:12px;">Distress Signal <span class="badge bg-danger text-white">2</span></span>
                            </a>
                            </li>
                            <li class="list-group-item" style="padding:4px 8px;">
                            <a href="#">
                            <span style="font-size:12px;">Input Signal SSAT <span class="badge bg-danger text-white">2</span></span>
                            </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-6 col-xs-12 p-2">
                    <h5>RAHASIA</h5>
                        <ul class="list-group list-group-bordered list">
                            <li class="list-group-item" style="padding:4px 8px;">
                            <a href="#">
                            <span style="font-size:12px;">Update Konis <span class="badge bg-danger text-white">2</span></span>
                            </a>
                            </li>
                            <li class="list-group-item" style="padding:4px 8px;">
                            <a href="#">
                            <span style="font-size:12px;">Update Konlog <span class="badge bg-danger text-white">2</span></span>
                            </a>
                            </li>
                            <li class="list-group-item" style="padding:4px 8px;">
                            <a href="#">
                            <span style="font-size:12px;">Update Konpers <!--span class="badge bg-danger text-white">9</span--></span>
                            </a>
                            </li>
                        </ul>
                        <ul class="list-group list-group-bordered list mt-2">
                            <li class="list-group-item" style="padding:4px 8px;">
                            <a href="#">
                            <span style="font-size:12px;">Laporan Ilo <span class="badge bg-danger text-white">2</span></span>
                            </a>
                            </li>
                            <li class="list-group-item" style="padding:4px 8px;">
                            <a href="#">
                            <span style="font-size:12px;">Laporan Staf Intel <span class="badge bg-danger text-white">2</span></span>
                            </a>
                            </li>
                            <li class="list-group-item" style="padding:4px 8px;">
                            <a href="#">
                            <span style="font-size:12px;">Laporan Eksternal <span class="badge bg-danger text-white">2</span></span>
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>

<div id="m_tom_back">
    <button type="button" class="btn btn-icon btnmaps" onclick="back()" title="Admin">
        <i class="icon-screen-desktop"></i>
    </button>
</div>    	

<div id="m_tom_full">
    <button type="button" class="btn btn-icon btnmaps of" onclick="openFullscreen();" title="Fullscreen">
        <i class="icon-size-fullscreen"></i>
    </button>
    <button type="button" class="btn btn-icon btnmaps cf" onclick="closeFullscreen();" style="display:none;" title="End Fullscreen">
        <i class="icon-size-actual"></i>
    </button>
</div>

<div id="m_info_position">
    LatLong: <span id="latlong"><?php echo $this->m_konfig->konfigmaps(2)?>, <?php echo $this->m_konfig->konfigmaps(3)?></span>
</div>

<div id="map_canvas"></div>


<script>
function logout() {
    window.location.href = '<?php echo site_url('login/logout')?>';
}
function back() {
    window.location.href = '<?php echo site_url('dashboard')?>';
}
</script>

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

<script>
function defaultMarker(){
    var fm = $('#customCheck1:checked').map(function(_, el) {
        return $(el).val();
    }).get();

    var course = [];
    $(".fm").each(function(){
        if ($('#customCheck1').is(":checked")) {
            course.push($(this).val());
        }
    });
    course = course.toString();
    var url = base_url+'maps_grims/get_fm';
    if(true == $('#customCheck1').prop("checked")){ 
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
}

</script>
<script type="text/javascript">
$(document).ready(function(){
    
    $('#customCheck1').change(function() { 
        var fm = $('#customCheck1:checked').map(function(_, el) {
            return $(el).val();
        }).get();

        var course = [];
        $(".fm").each(function(){
            if ($(this).is(":checked")) {
                course.push($(this).val());
            }
        });
        course = course.toString();

        var url = base_url+'maps_grims/get_fm';
        if(true == $(this).prop("checked")){ 
            $.ajax({
                url: url,
                data: "fm="+fm+"&ak="+course,
                type: 'POST',
                dataType: 'JSON',
                success: function(markersOnMap){
                    showMarker(markersOnMap);
                }
            });
        }else{
            hideMarkersOfType(3);
            closeOtherInfo();
        }
    });	

    $('#customCheck2').change(function() { 
        var fm = $('#customCheck2:checked').map(function(_, el) {
            return $(el).val();
        }).get();

        var course = [];
        $(".fm").each(function(){
            if ($(this).is(":checked")) {
                course.push($(this).val());
            }
        });
        course = course.toString();

        var url = base_url+'maps_grims/get_fm';
        if(true == $(this).prop("checked")){ 
            $.ajax({
                url: url,
                data: "fm="+fm+"&ak="+course,
                type: 'POST',
                dataType: 'JSON',
                success: function(markersOnMap){
                    showMarker(markersOnMap);
                }
            });
        }else{
            hideMarkersOfType(4);
            closeOtherInfo();
        }
    });

	$('#customCheck3').change(function() { 
        var fm = $('#customCheck3:checked').map(function(_, el) {
            return $(el).val();
        }).get();

        var course = [];
        $(".fm").each(function(){
            if ($(this).is(":checked")) {
                course.push($(this).val());
            }
        });
        course = course.toString();

        var url = base_url+'maps_grims/get_fm';
        if(true == $(this).prop("checked")){ 
            $.ajax({
                url: url,
                data: "fm="+fm+"&ak="+course,
                type: 'POST',
                dataType: 'JSON',
                success: function(markersOnMap){
                    showMarker(markersOnMap);
                }
            });
        }else{
            hideMarkersOfType(5);
            closeOtherInfo();
        }
    });

	$('#customCheck4').change(function() { 
        var fm = $('#customCheck4:checked').map(function(_, el) {
            return $(el).val();
        }).get();

        var course = [];
        $(".fm").each(function(){
            if ($(this).is(":checked")) {
                course.push($(this).val());
            }
        });
        course = course.toString();

        var url = base_url+'maps_grims/get_fm';
        if(true == $(this).prop("checked")){ 
            $.ajax({
                url: url,
                data: "fm="+fm+"&ak="+course,
                type: 'POST',
                dataType: 'JSON',
                success: function(markersOnMap){
                    showMarker(markersOnMap);
                }
            });
        }else{
            hideMarkersOfType(6);
            closeOtherInfo();
        }
    });

	$('#customCheck5').change(function() { 
        var fm = $('#customCheck5:checked').map(function(_, el) {
            return $(el).val();
        }).get();

        var course = [];
        $(".fm").each(function(){
            if ($(this).is(":checked")) {
                course.push($(this).val());
            }
        });
        course = course.toString();

        var url = base_url+'maps_grims/get_fm';
        if(true == $(this).prop("checked")){ 
            $.ajax({
                url: url,
                data: "fm="+fm+"&ak="+course,
                type: 'POST',
                dataType: 'JSON',
                success: function(markersOnMap){
                    showMarker(markersOnMap);
                }
            });
        }else{
            hideMarkersOfType(7);
            closeOtherInfo();
        }
    });
	
	$('#customCheck6').change(function() { 
        var fm = $('#customCheck6:checked').map(function(_, el) {
            return $(el).val();
        }).get();

        var course = [];
        $(".fm").each(function(){
            if ($(this).is(":checked")) {
                course.push($(this).val());
            }
        });
        course = course.toString();

        var url = base_url+'maps_grims/get_fm';
        if(true == $(this).prop("checked")){ 
            $.ajax({
                url: url,
                data: "fm="+fm+"&ak="+course,
                type: 'POST',
                dataType: 'JSON',
                success: function(markersOnMap){
                    showMarker(markersOnMap);
                }
            });
        }else{
            hideMarkersOfType(8);
            closeOtherInfo();
        }
    });
	
	$('#customCheck7').change(function() { 
        var fm = $('#customCheck7:checked').map(function(_, el) {
            return $(el).val();
        }).get();

        var course = [];
        $(".fm").each(function(){
            if ($(this).is(":checked")) {
                course.push($(this).val());
            }
        });
        course = course.toString();

        var url = base_url+'maps_grims/get_fm';
        if(true == $(this).prop("checked")){ 
            $.ajax({
                url: url,
                data: "fm="+fm+"&ak="+course,
                type: 'POST',
                dataType: 'JSON',
                success: function(markersOnMap){
                    showMarker(markersOnMap);
                }
            });
        }else{
            hideMarkersOfType(9);
            closeOtherInfo();
        }
    });
	
	$('#customCheck8').change(function() { 
        var fm = $('#customCheck8:checked').map(function(_, el) {
            return $(el).val();
        }).get();

        var course = [];
        $(".fm").each(function(){
            if ($(this).is(":checked")) {
                course.push($(this).val());
            }
        });
        course = course.toString();

        var url = base_url+'maps_grims/get_fm';
        if(true == $(this).prop("checked")){ 
            $.ajax({
                url: url,
                data: "fm="+fm+"&ak="+course,
                type: 'POST',
                dataType: 'JSON',
                success: function(markersOnMap){
                    showMarker(markersOnMap);
                }
            });
        }else{
            hideMarkersOfType(10);
            closeOtherInfo();
        }
    });


    $(".resAll").on('click', function(){
        resetMarker();
        removeLine();
        removeGone();
    });
   
});
</script>
<script>
    function history_range_kri(id){
        //alert('history');
        var form = $("#"+id);
        var url = base_url+'maps_grims/history_range_kri';
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
                removeLine();
                showPline(markersOnMap);
                }else{
                    //alert('No history');
                    toastr['info']("No History this day");
                }
            }
        });
    }
    function history_track_kri(id){
        //alert('history');
        var url = base_url+'maps_grims/history_track_kri';
        $.ajax({
            url: url,
            data: "id="+id,
            type: 'POST',
            dataType: 'JSON',
            beforeSend: function() {
		        $('#msg_'+id+'').addClass('fa fa-spinner fa-spin');
		    },
            success: function(markersOnMap){
                $('#msg_'+id+'').removeClass('fa fa-spinner fa-spin');
                if(markersOnMap.length >= 1){
                resetMarker();
                removeLine();
                showPline(markersOnMap);
                }else{
                    //alert('No history');
                    toastr['info']("No History this day");
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
    var gone = [];

    window.onload = function () {
        initMap();
        $('#customCheck1').prop("checked", true);
        defaultMarker();
    };
    function CenterControl(controlDiv, map) {
        // Set CSS for the control border.
        const controlUI = document.createElement("div");
        controlUI.style.backgroundColor = "#fff";
        controlUI.style.border = "2px solid #fff";
        controlUI.style.borderRadius = "3px";
        controlUI.style.boxShadow = "0 1px 3px rgba(0,0,0,.2)";
        controlUI.style.cursor = "pointer";
        controlUI.style.marginTop = "175px";
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
                position: google.maps.ControlPosition.LEFT_BOTTOM,
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
        google.maps.event.addListener(map,'mousemove',function(event) {
            document.getElementById('latlong').innerHTML = event.latLng.lat() + ', ' + event.latLng.lng()
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
                maxWidth: 360
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
    }

    var dgon_nd;
    var dgon_lw;
    var dgon_bw;
    function showPgon(gonLL,nd,lw,bw){
        removeGone();
        dgon_nd=nd;
        dgon_lw=lw;
        dgon_bw=bw;

        var gonCoords=[];
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
        // Add a listener for the click event.
        consPolygon.addListener("click", showArrgon);
        infoWindow = new google.maps.InfoWindow({maxWidth: 400});
    }
    function showArrgon(event) {
        // MVCArray of LatLngs.
        const polygon = this;
        const vertices = polygon.getPath();
        let contentString = "<div class='tborder'><table style='font-size:10px'><tbody><tr style='font-size:11px' valign='top'><td class='text-left' style='width:100px'>Wilayah Kerja</td><td class='text-left'><b>"+dgon_nd+"</b></td></tr><tr style='font-size:11px' valign='top'><td class='text-left'>Luas Wilayah</td><td class='text-left'>"+dgon_lw+"</td></tr><tr style='font-size:11px' valign='top'><td class='text-left'>Batas Wilayah</td><td class='text-left'>"+dgon_bw+"</td></tbody></table></div>";
        // tampil coordinate polygon 
        /*for (let i = 0; i < vertices.getLength(); i++) {
            const xy = vertices.getAt(i);
            contentString +=
            "<div style='font-size:10px'><br>" + "Coordinate " + i + ":<br>" + xy.lat() + "," + xy.lng()+"</div>";
        }*/
        // Replace the info window's content and position.
        infoWindow.setContent(contentString);
        infoWindow.setPosition(event.latLng);
        infoWindow.open(map);
    }
    function removeGone() {
        for (i=0; i<gone.length; i++) 
        {                           
            gone[i].setMap(null);
        }
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
        url:'<?php echo site_url("maps_grims/update_tracking_kri"); ?>',
        data: 'track_lat='+track_lat+'&track_lng='+track_lng,
        method:"POST",
        //dataType:"JSON",
        success: function(data)
        { 	   	  
            if(data["table"]==true){
                toastr['success']("Successfully update");
            }else{
                toastr['danger']("Successfully update");
            }
        }		
    });
}
</script>

<script>
function konlog(){ 
	$("#title_mdl_konlog").html("DATA KONLOG");
	$("#mdl_formSubmit_konlog").modal({backdrop: 'static', keyboard: false});
	$("#konlog_page").html('<center>Please wait..</center>');
	$.post(base_url+"maps_grims/page_konlog",function(data){
		$("#konlog_page").html(data);
		//$("#formSubmit_page")[0].reset();
		//$("#inputpreview_img").attr("src", '<.?php echo base_url()?>theme/images/user/img_not.png');
	});	
}
function close_modal(){
	$('.nav-item').removeClass('active');
}

function history_konlog()
{ 
	$("#konlog_page").html('<center>Please wait..</center>');
	$.post("<?php echo site_url("maps_grims/history_konlog"); ?>",function(data){
		$("#konlog_page").html(data);
	});	
}
function back_konlog(){
	$("#konlog_page").html('<center>Please wait..</center>');
	$.post("<?php echo site_url("maps_grims/page_konlog"); ?>",function(data){
		$("#konlog_page").html(data);
	});	
}	
</script>
<!-- modal -->
<div class="modal fade" id="mdl_formSubmit_konlog">
<div class="modal-dialog modal-lg" id="area_formSubmit_konlog"> 
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_konlog">Default Modal</h4>
	  <button type="button" onclick="close_modal()" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_konlog" action="javascript:submitForm('formSubmit_konlog')" method="post">
	<div class="modal-body">
        <div class="row align-items-center mb-3">
            <div class="col">
            </div>
            <div class="col-auto">
                <a href="javascript:history_konlog()" class="btn btn-light btn-border btn-sm">
                    <i class="fas fa-clock"></i> History
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="konlog_page"></div>
            </div>
        </div>
	</div>
	<div class="modal-footer justify-content-between">
	  <button type="button" onclick="close_modal()" class="btn btn-default" data-dismiss="modal">Close</button>
	  <!--button  title="Save" id="submit" onclick="submitForm('formSubmit_page')" class="btn btn-primary"><i id="msg_formSubmit_page"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button-->
	</div>
	</form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script>
function konis(){ 
	$("#title_mdl_konis").html("DATA KONIS");
	$("#mdl_formSubmit_konis").modal({backdrop: 'static', keyboard: false});
	$("#konis_page").html('<center>Please wait..</center>');
	$.post(base_url+"maps_grims/page_konis",function(data){
		$("#konis_page").html(data);
		//$("#formSubmit_page")[0].reset();
		//$("#inputpreview_img").attr("src", '<.?php echo base_url()?>theme/images/user/img_not.png');
	});	
}
function close_modal(){
	$('.nav-item').removeClass('active');
}

function history_konis()
{ 
	$("#konis_page").html('<center>Please wait..</center>');
	$.post("<?php echo site_url("maps_grims/history_konis"); ?>",function(data){
		$("#konis_page").html(data);
	});	
}
function back_konis(){
	$("#konis_page").html('<center>Please wait..</center>');
	$.post("<?php echo site_url("maps_grims/page_konis"); ?>",function(data){
		$("#konis_page").html(data);
	});	
}	
</script>
<!-- modal -->
<div class="modal fade" id="mdl_formSubmit_konis">
<div class="modal-dialog modal-lg" id="area_formSubmit_konis"> 
  <div class="modal-content">
	<div class="modal-header">
	  <h4 class="modal-title" id="title_mdl_konis">Default Modal</h4>
	  <button type="button" onclick="close_modal()" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<form class="form-horizontal" id="formSubmit_konis" action="javascript:submitForm('formSubmit_konis')" method="post">
	<div class="modal-body">
        <div class="row align-items-center mb-3">
            <div class="col">
            </div>
            <div class="col-auto">
                <a href="javascript:history_konis()" class="btn btn-light btn-border btn-sm">
                    <i class="fas fa-clock"></i> History
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="konis_page"></div>
            </div>
        </div>
	</div>
	<div class="modal-footer justify-content-between">
	  <button type="button" onclick="close_modal()" class="btn btn-default" data-dismiss="modal">Close</button>
	  <!--button  title="Save" id="submit" onclick="submitForm('formSubmit_page')" class="btn btn-primary"><i id="msg_formSubmit_page"></i>&nbsp;&nbsp;<i class='fa fa-save'></i> Save changes</button-->
	</div>
	</form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->