<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
   <div class="content-inside">
      <div class="my-4">
         <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item">
               <a style="background-color: #088A08;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
                  role="tab" aria-controls="home" aria-selected="false"><b>Mapa com Pontos de Coleta -  
                   <?php if( totalCollects() == 0 ){ ?>

                          Nenhum local Registrado 
                          <?php }elseif( totalCollects() == 1 ){ ?>

                          <?php echo totalCollects(); ?> Local registrado 
                          <?php }else{ ?>

                          <?php echo totalCollects(); ?> Locais registrados 
                          <?php } ?></b></a>
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
    
   var planes = [
      <?php $counter1=-1;  if( isset($serviceOne) && ( is_array($serviceOne) || $serviceOne instanceof Traversable ) && sizeof($serviceOne) ) foreach( $serviceOne as $key1 => $value1 ){ $counter1++; ?>["<?php echo $value1["locality"]; ?>",'<?php echo $value1["informations"]; ?>',"<?php echo $value1["service"]; ?>",<?php echo $value1["lat"]; ?>,<?php echo $value1["lng"]; ?>,<?php echo $value1["idcollect"]; ?>],<?php } ?>

      ];
   var planesTwo = [
      <?php $counter1=-1;  if( isset($serviceTwo) && ( is_array($serviceTwo) || $serviceTwo instanceof Traversable ) && sizeof($serviceTwo) ) foreach( $serviceTwo as $key1 => $value1 ){ $counter1++; ?>["<?php echo $value1["locality"]; ?>",'<?php echo $value1["informations"]; ?>',"<?php echo $value1["service"]; ?>",<?php echo $value1["lat"]; ?>,<?php echo $value1["lng"]; ?>,<?php echo $value1["idcollect"]; ?>],<?php } ?>

      ];

    var planesThree = [
      <?php $counter1=-1;  if( isset($serviceThree) && ( is_array($serviceThree) || $serviceThree instanceof Traversable ) && sizeof($serviceThree) ) foreach( $serviceThree as $key1 => $value1 ){ $counter1++; ?>["<?php echo $value1["locality"]; ?>",'<?php echo $value1["informations"]; ?>',"<?php echo $value1["service"]; ?>",<?php echo $value1["lat"]; ?>,<?php echo $value1["lng"]; ?>,<?php echo $value1["idcollect"]; ?>],<?php } ?>

      ];

   var planesFour = [
      <?php $counter1=-1;  if( isset($serviceFour) && ( is_array($serviceFour) || $serviceFour instanceof Traversable ) && sizeof($serviceFour) ) foreach( $serviceFour as $key1 => $value1 ){ $counter1++; ?>["<?php echo $value1["locality"]; ?>",'<?php echo $value1["informations"]; ?>',"<?php echo $value1["service"]; ?>",<?php echo $value1["lat"]; ?>,<?php echo $value1["lng"]; ?>,<?php echo $value1["idcollect"]; ?>],<?php } ?>

      ];    
   


        var map = L.map('map1').setView([-15.792873001853433,-47.882795333862305], 11);
        mapLink = 
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; Pontos de Entulhos - DF',
            
            }).addTo(map);

       var muxiIconProperties = {
      iconUrl: "/res/map/papa_entulho.png"
    , iconSize: [55, 40]
    , iconAnchor: [22, 59]
    , popupAnchor: [0, -50]
    };

      var muxiIconPropertiesTwo = {
      iconUrl: "/res/map/vidros.png"
    , iconSize: [45, 45]
    , iconAnchor: [22, 59]
    , popupAnchor: [0, -50]
    };

     var muxiIconPropertiesThree = {
      iconUrl: "/res/map/eletronicos.png"
    , iconSize: [60, 55]
    , iconAnchor: [22, 59]
    , popupAnchor: [0, -50]
    };

       var muxiIconPropertiesFour = {
      iconUrl: "/res/map/reciclaveis.png"
    , iconSize: [60, 55]
    , iconAnchor: [22, 59]
    , popupAnchor: [0, -50]
    };

    var muxiIcon = L.icon(muxiIconProperties);

      for (var i = 0; i < planes.length; i++) {
         marker = new L.marker([planes[i][3],planes[i][4]],{icon: muxiIcon})
            .bindPopup("<center><img src='/res/map/papa_entulho.png' height='150px' width='200px'></center><b style='font-size:16px;'>"+planes[i][2]+"<br></b>"+"<b style='font-size:14px;'>"+planes[i][0]+"</b><br>"+planes[i][1]+"<b>Latitude:</b> "+planes[i][3]+"<br><b>Longitude:</b>"+planes[i][4]+"<center><br><a href='/user/collects/images/"+planes[i][5]+"'' style='width: 100px;color:white;'' class='btn btn-info btn-sm' ><b> Ver Fotos</b></a>")
            .addTo(map);
        
      }

      var muxiIconTwo = L.icon(muxiIconPropertiesTwo);

      for (var i = 0; i < planesTwo.length; i++) {
         marker = new L.marker([planesTwo[i][3],planesTwo[i][4]],{icon: muxiIconTwo})
            .bindPopup("<center><img src='/res/map/vidros.png' height='150px' width='150px'></center><b style='font-size:16px;'>"+planesTwo[i][2]+"<br></b>"+"<b style='font-size:14px;'>"+planesTwo[i][0]+"</b><br>"+planesTwo[i][1]+"<b>Latitude:</b> "+planesTwo[i][3]+"<br><b>Longitude:</b>"+planesTwo[i][4]+"<center><br><a href='/user/collects/images/"+planesTwo[i][5]+"'' style='width: 100px;color:white;'' class='btn btn-info btn-sm' ><b> Ver Fotos</b></a>")
            .addTo(map);
        
      }

       var muxiIconThree = L.icon(muxiIconPropertiesThree);

      for (var i = 0; i < planesThree.length; i++) {
         marker = new L.marker([planesThree[i][3],planesThree[i][4]],{icon: muxiIconThree})
            .bindPopup("<center><img src='/res/map/eletronicos.png' height='200px' width='200px'></center><b style='font-size:16px;'>"+planesThree[i][2]+"<br></b>"+"<b style='font-size:14px;'>"+planesThree[i][0]+"</b><br>"+planesThree[i][1]+"<b>Latitude:</b> "+planesThree[i][3]+"<br><b>Longitude:</b>"+planesThree[i][4]+"<center><br><a href='/user/collects/images/"+planesThree[i][5]+"'' style='width: 100px;color:white;'' class='btn btn-info btn-sm' ><b> Ver Fotos</b></a> " )
            .addTo(map);
        
      }

       var muxiIconFour = L.icon(muxiIconPropertiesFour);

      for (var i = 0; i < planesFour.length; i++) {
         marker = new L.marker([planesFour[i][3],planesThree[i][4]],{icon: muxiIconFour})
            .bindPopup("<center><img src='/res/map/reciclaveis.png' height='200px' width='200px'></center><b style='font-size:16px;'>"+planesFour[i][2]+"<br></b>"+"<b style='font-size:14px;'>"+planesFour[i][0]+"</b><br>"+planesFour[i][1]+"<b>Latitude:</b> "+planesFour[i][3]+"<br><b>Longitude:</b>"+planesFour[i][4]+"<center><br><a href='/user/collects/images/"+planesFour[i][5]+"'' style='width: 100px;color:white;'' class='btn btn-info btn-sm' ><b> Ver Fotos</b></a> " )
            .addTo(map);
        
      }
               
    </script>

  