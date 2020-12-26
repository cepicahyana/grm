<style>
#map {
  height:400px;
  width: 100%;
}
</style>

<div id="map_canvas"></div>

<script>
    var map;
    var InforObj = [];
    var centerCords = { lat: -0.038302, lng: 120.060753 };
    var markersOnMap = [
        {
            placeName: "LANTAMAL 1",
            descCription: "<p>deskripsi silahkan di isi gan</p>",
            LatLng: [{ lat: -6.121435, lng: 106.774124 }]
        },
        {
            placeName: "LANTAMAL 2",
            descCription: "<p>deskripsi silahkan di isi gan</p>",
            LatLng: [{ lat: 4.695135, lng: 96.749397 }]
        },
        {
            placeName: "LANTAMAL 3",
            descCription: "<p>deskripsi silahkan di isi gan</p>",
            LatLng: [{ lat: -2.5315, lng: 112.9496 }]
        },
    ];

    window.onload = function () {
        initMap();
    };

    function addMarkerInfo() {
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
    }

    function closeOtherInfo() {
        if (InforObj.length > 0) {
            /* detach the info-window from the marker ... undocumented in the API docs */
            InforObj[0].set("marker", null);
            /* and close it */
            InforObj[0].close();
            /* blank the array */
            InforObj.length = 0;
        }
    }

    function initMap() {
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 5,
            center: centerCords
        });
        addMarkerInfo();
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