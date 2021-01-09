<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
   <div class="content-inside">
      <div class="my-4">
         <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item">
               <a style="background-color: #088A08;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
                  role="tab" aria-controls="home" aria-selected="false"><b>Locais Marcados -  
                   <?php if( totalMarkers() == 0 ){ ?>

                          Nenhum Ponto de Entulho marcado no Mapa
                          <?php }elseif( totalMarkers() == 1 ){ ?>

                          <?php echo totalMarkers(); ?> Ponto de Entulho Marcado no Mapa
                          <?php }else{ ?>

                          <?php echo totalMarkers(); ?> Pontos de Entulhos Marcados no Mapa
                          <?php } ?></b></a>
            </li>
         </ul>

         <div id="map1" class="mapa"></div>

         <hr class="my-4" />

         <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>


      </div>
   </div>
</div>
    <script src="https://d19vzq90twjlae.cloudfront.net/leaflet-0.7/leaflet.js">
    </script>

    <script>
    

   var planes = [
      <?php $counter1=-1;  if( isset($markers) && ( is_array($markers) || $markers instanceof Traversable ) && sizeof($markers) ) foreach( $markers as $key1 => $value1 ){ $counter1++; ?>["<?php echo $value1["locality"]; ?>","<?php echo $value1["observation"]; ?>",<?php echo $value1["lat"]; ?>,<?php echo $value1["lng"]; ?>,<?php echo $value1["idcall"]; ?>],<?php } ?>

      ];

        var map = L.map('map1').setView([-15.792873001853433,-47.882795333862305], 11);
        mapLink = 
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; ' + mapLink + ' Contributors',
            
            }).addTo(map);

       var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    , iconAnchor: [22, 59]
    , popupAnchor: [0, -50]
    };

    var muxiIcon = L.icon(muxiIconProperties);

      for (var i = 0; i < planes.length; i++) {
         marker = new L.marker([planes[i][2],planes[i][3]],{icon: muxiIcon})
            .bindPopup("<b style='font-size:16px;'>"+planes[i][0]+"</b><br>"+planes[i][1]+"<b>Latitude:</b> "+planes[i][2]+"<br><b>Longitude:</b>"+planes[i][3]+"<center><br><a href='/user/calls/images/"+planes[i][4]+"'' style='width: 100px;color:white;'' class='btn btn-info btn-sm' ><b> Ver Fotos</b></a>")
            .addTo(map);

            
      }
               
    </script>

