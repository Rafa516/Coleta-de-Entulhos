<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

  <div class="content-inside">

    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #088A08;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Marcar local com Entulhos</b></a>
        </li>
      </ul>
      <?php if( $markerOpenMsg != '' ){ ?>

            <div class="alert alert-success">
                <b><?php echo $markerOpenMsg; ?></b>
            </div>
            <?php } ?>


       <?php if( $errorRegister != '' ){ ?>

            <div class="alert alert-danger">
                  <b><?php echo $errorRegister; ?></b>
            </div>
             <?php } ?>


      <div class="row mt-5 align-items-center">
        <div class="col-md-7 text-center mb-5">
          <div class="avatar avatar-xl">
            <div id="map"></div>
          </div>
        </div>

        <div class="col">
          <div>

          </div>
          <div class="row mb-7">
            <div class="col-md-10">
              <p class="text-muted">

              <form class="form-group" action="/admin/open-marker/submit" method="post" enctype="multipart/form-data"><br>


                <div class="form-group"><label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Local</b></label>
                  <input class="form-control py-1" placeholder="Preencha o Endereço e a Cidade" type="text" name="locality" required />
                </div>

                <div class="form-group"><label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Observação</b></label>
                  <textarea class="form-control py-1" value="" type="text" name="observation" height="10"> </textarea>
                </div>

                <label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Tipo de Entulho/Resíduos</b></label>
               <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Classe A" name="type1"multiple="multiple" >
                <label class="form-check-label" >
                  <b>Classe A:</b> resíduos recicláveis e passíveis de reutilização tais como: tijolos, blocos, telhas, placas de revestimento, argamassa e concreto.
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Classe B" name="type2"multiple="multiple">
                <label class="form-check-label" >
                 <b>Classe B:</b> resíduos recicláveis formados por plásticos, papéis, metais, vidros e madeiras em geral, incluindo gesso.
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Classe C" name="type3"multiple="multiple">
                <label class="form-check-label" >
                 <b>Classe C:</b> resíduos que não são passiveis de reciclagem ou recuperação por não possuir tecnologia desenvolvida para isso.
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Classe D" name="type4"multiple="multiple">
                <label class="form-check-label" >
                 <b>Classe D:</b> resíduos perigosos, tais como: tintas, solventes, óleos, amianto, produtos de demolições, reformas e reparos em clínicas radiológicas, instalações industriais e outras.
                </label>
              </div>




                <div class="form-group"><label class="small mb-1"><b b
                      style="font-size:20px;color: #585858">Fotos</b></label>
                  <input id="addPhoto" class="form-control py-1" type="file" id="" name="namephoto[]" multiple="multiple"/>
                </div>

                <input class="form-control py-1" value="<?php echo $user["iduser"]; ?>" name="iduser" type="hidden">


                <input class="form-control py-1" id="lat" type="hidden" name="lat">


                <input class="form-control py-1" id="lng" type="hidden" name="lng">


                <center><input style="width: 100%;" class="btn btn-primary btn " type="submit" value="Enviar"></center>

            </div>

          </div>
        </div>

      </div>
      <hr class="my-4" />
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>

<script data-require="leaflet@0.7.3" data-semver="0.7.3" src="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>
    <script src="script.js"></script>


<!-- BRASÍLIA--> 

<?php if( $user["city"] == 'Brasília - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.79291429721882,-47.88494110107422],
  'zoom': 13,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.79291429721882,-47.88494110107422],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- GAMA --> 

<?php if( $user["city"] == 'Gama - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-16.013888502191303,-48.064413070678704],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-16.013888502191303,-48.064413070678704],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- TAGUATINGA --> 

<?php if( $user["city"] == 'Taguatinga - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.832553961950342,-48.05488586425781],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.832553961950342,-48.05488586425781],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- BRAZLÂNDIA --> 

<?php if( $user["city"] == 'Brazlândia - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.668990420812593,-48.197879791259766],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.668990420812593,-48.197879791259766],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>



<!-- SOBRADINHO --> 

<?php if( $user["city"] == 'Sobradinho - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.645849615729336,-47.79945373535156],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.645849615729336,-47.79945373535156],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- PLANALTINA --> 

<?php if( $user["city"] == 'Planaltina - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.614936028740939,-47.65525817871094],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.614936028740939,-47.65525817871094],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- PARANOÁ --> 

<?php if( $user["city"] == 'Paranoá - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.77110917357528,-47.779541015625],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.77110917357528,-47.779541015625],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- NÚCLEO BANDEIRANTE --> 

<?php if( $user["city"] == 'Núcleo Bandeirante - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.87049339830241,-47.96729564666748],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.87049339830241,-47.96729564666748],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- CEILÂNDIA --> 

<?php if( $user["city"] == 'Ceilândia - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.813065430724166,-48.10123443603515],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.813065430724166,-48.10123443603515],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>]


<!-- GUARÁ --> 

<?php if( $user["city"] == 'Guará - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.826360776446784,-47.9827880859375],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.826360776446784,-47.9827880859375],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>



<!-- CRUZEIRO --> 

<?php if( $user["city"] == 'Cruzeiro - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.78969323344034,-47.93952941894531],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.78969323344034,-47.93952941894531],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- SAMAMBAIA --> 

<?php if( $user["city"] == 'Samambaia - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.878790408710541,-48.08810234069824],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.878790408710541,-48.08810234069824],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>



<!-- SANTA MARIA--> 

<?php if( $user["city"] == 'Santa Maria- DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-16.01562099500949,-48.01403045654297],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-16.01562099500949,-48.01403045654297],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- SÃO SEBASTIÃO--> 

<?php if( $user["city"] == 'São Sebastião - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.899593349509573,-47.77730941772461],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.899593349509573,-47.77730941772461],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>



<!-- RECANTO DAS EMAS--> 

<?php if( $user["city"] == 'Recanto das Emas - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.905123928202842,-48.06690216064453],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.905123928202842,-48.06690216064453],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- LAGO SUL--> 

<?php if( $user["city"] == 'Lago Sul - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.837508373675316,-47.87610054016113],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.837508373675316,-47.87610054016113],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>



<!-- RIACHO FUNDO--> 

<?php if( $user["city"] == 'Riacho Fundo - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.88283559334234,-48.01823616027832],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.88283559334234,-48.01823616027832],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- LAGO NORTE--> 

<?php if( $user["city"] == 'Lago Norte - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.731127027915745,-47.8645133972168],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.731127027915745,-47.8645133972168],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- LAGO NORTE--> 

<?php if( $user["city"] == 'Lago Norte - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.731127027915745,-47.8645133972168],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.731127027915745,-47.8645133972168],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- CANDANGOLÂNDIA--> 

<?php if( $user["city"] == 'Candangolândia - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.851999330234726,-47.950944900512695],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.851999330234726,-47.950944900512695],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- ÁGUAS CLARAS--> 

<?php if( $user["city"] == 'Águas Claras- DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.839324960860003,-48.02608966827392],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.839324960860003,-48.02608966827392],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- RIACHO FUNDO II--> 

<?php if( $user["city"] == 'Riacho Fundo II - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.902936478692661,-48.04887771606445],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.902936478692661,-48.04887771606445],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- SUDOESTE/OCTOGONAL--> 

<?php if( $user["city"] == 'Sudoeste/Octogonal - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.79869556527687,-47.924766540527344],
  'zoom': 15,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.79869556527687,-47.924766540527344],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!--VARJÃO--> 

<?php if( $user["city"] == 'Varjão - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.7098936428559,-47.876272201538086],
  'zoom': 16,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.7098936428559,-47.876272201538086],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>



<!-- PARK WAY--> 

<?php if( $user["city"] == 'Park Way - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.903803206816589,-47.96055793762207],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.903803206816589,-47.96055793762207],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- SCIA--> 

<?php if( $user["city"] == 'SCIA - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.787215457226939,-47.97626495361328],
  'zoom': 15,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.787215457226939,-47.97626495361328],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- SOBRADINHO 2--> 

<?php if( $user["city"] == 'Sobradinho II - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.6436593681599,-47.82352924346923],
  'zoom': 15,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.6436593681599,-47.82352924346923],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- JARDIM BOTÂNICO--> 

<?php if( $user["city"] == 'Jardim Botânico - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.863640883389225,-47.78945446014404],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.863640883389225,-47.78945446014404],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- ITAPOÃ--> 

<?php if( $user["city"] == 'Itapoã - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.746534303077151,-47.769198417663574],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.746534303077151,-47.769198417663574],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- SIA--> 

<?php if( $user["city"] == 'SIA - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.804807012041678,-47.95849800109863],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.804807012041678,-47.95849800109863],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- VICENTE PIRES--> 

<?php if( $user["city"] == 'Vicente Pires - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.81273510044835,-48.01681995391846],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.81273510044835,-48.01681995391846],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>



<!-- FERCAL--> 

<?php if( $user["city"] == 'Fercal - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.600841522251699,-47.87118673324585],
  'zoom': 15,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.600841522251699,-47.87118673324585],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- SOL NASCENTE/POR DO SOL--> 

<?php if( $user["city"] == 'Sol Nascente/Pôr do Sol - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.825080827778534,-48.1340217590332],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.825080827778534,-48.1340217590332],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>


<!-- ARNIQUEIRA--> 

<?php if( $user["city"] == 'Arniqueira - DF' ){ ?>


<script>
  var tileLayer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: '&copy; Pontos de Entulhos - DF'
});

var map = new L.Map('map', {
  'center': [-15.85790275499089,-48.01179885864257],
  'zoom': 14,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-15.85790275499089,-48.01179885864257],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>
<?php } ?>



<script src="/res/admin/js/functions.js"></script>
<script type="text/javascript">observation()</script>  