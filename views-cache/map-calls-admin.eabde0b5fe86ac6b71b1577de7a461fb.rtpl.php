<?php if(!class_exists('Rain\Tpl')){exit;}?>

<div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #5FB404;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Mapa - Localização Chamado <?php echo $call["value"]; ?></b></a>
                </li>
            </ul>
            
           <div id="mapa"></div>

            <hr class="my-4" />

         <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>


        </div>
    </div>
</div>

 <script>

      function inicializar() {
        var coordenadas = {lat: -16.018568390360233, lng: -47.988355895404055};

        var mapa = new google.maps.Map(document.getElementById('mapa'), {
          zoom: 15,
          center: coordenadas 
        });

        var marker = new google.maps.Marker({
          position: coordenadas,
          map: mapa,
          title: 'Meu marcador'
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJ1RqQyxumXFMLKO2NG9isrbO8nXTPtxc&callback=inicializar">
    </script>
