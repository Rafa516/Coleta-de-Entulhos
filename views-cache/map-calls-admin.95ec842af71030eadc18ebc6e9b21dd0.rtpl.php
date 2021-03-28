<?php if(!class_exists('Rain\Tpl')){exit;}?>

<div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #088A08;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Localização - Ponto de Entulhos,  <?php echo $markers["valueLocality"]; ?></b></a>
                </li>
            </ul>
            
           <div id="map1"></div>

            <hr class="my-4" />

             <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>


        </div>
    </div>
</div>

       <script src="https://d19vzq90twjlae.cloudfront.net/leaflet-0.7/leaflet.js">
    </script>

    <script>

      var initialCoordinates = [<?php echo $markers["valueLat"]; ?>, <?php echo $markers["valueLng"]; ?>]; 
      var initialZoomLevel = 16;

      // create a map in the "map" div, set the view to a given place and zoom
      var map = L.map('map1').setView(initialCoordinates, initialZoomLevel);

      // add an OpenStreetMap tile layer
      L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
          attribution: '&copy; Pontos de Entulhos - DF'
      }).addTo(map);
    

      var muxiCoordinates = [<?php echo $markers["valueLat"]; ?>, <?php echo $markers["valueLng"]; ?>];
      var muxiMarkerMessage = "<b style='font-size:16px;'><?php echo $markers["valueLocality"]; ?></b><br><?php echo $markers["valueObservation"]; ?><b>Latitude:</b><?php echo $markers["valueLat"]; ?><br><b>Longitude:</b><?php echo $markers["valueLng"]; ?>";

      var muxiIconProperties = {
        iconUrl: "/res/map/marker.png"
      , iconSize: [44, 59]
      , iconAnchor: [22, 59]
      , popupAnchor: [0, -50]
      };

      var muxiIcon = L.icon(muxiIconProperties);

      L.marker(muxiCoordinates, {icon: muxiIcon})
        .addTo(map)
        .bindPopup(muxiMarkerMessage)
      ;
            

               
    </script>








 