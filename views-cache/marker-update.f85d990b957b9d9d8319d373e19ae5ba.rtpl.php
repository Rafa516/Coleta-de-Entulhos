<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

  <div class="content-inside">

    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #088A08;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Marcar local com Entulhos</b></a>
        </li>
      </ul>
      

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
                  <input class="form-control py-1" value="<?php echo $marker["locality"]; ?>" placeholder="Preencha o Endereço e a Cidade" type="text" name="locality" required />
                </div>

                <div class="form-group"><label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Observação</b></label>
                  <textarea class="form-control py-1" value="" type="text" name="observation" height="10"><?php echo $marker["observation"]; ?></textarea>
                </div>

                <label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Tipo de Entulho/Resíduos</b></label>
               <div class="form-check">
                <input class="form-check-input" type="checkbox" value="<?php echo $marker["type1"]; ?>" name="type1"multiple="multiple" >
                <label class="form-check-label" >
                  <b>Classe A:</b> resíduos recicláveis e passíveis de reutilização tais como: tijolos, blocos, telhas, placas de revestimento, argamassa e concreto.
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="<?php echo $marker["type2"]; ?>" name="type2"multiple="multiple">
                <label class="form-check-label" >
                 <b>Classe B:</b> resíduos recicláveis formados por plásticos, papéis, metais, vidros e madeiras em geral, incluindo gesso.
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="<?php echo $marker["type3"]; ?>" name="type3"multiple="multiple">
                <label class="form-check-label" >
                 <b>Classe C:</b> resíduos que não são passiveis de reciclagem ou recuperação por não possuir tecnologia desenvolvida para isso.
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="<?php echo $marker["type4"]; ?>" name="type4"multiple="multiple">
                <label class="form-check-label" >
                 <b>Classe D:</b> resíduos perigosos, tais como: tintas, solventes, óleos, amianto, produtos de demolições, reformas e reparos em clínicas radiológicas, instalações industriais e outras.
                </label>
              </div>




                <div class="form-group"><label class="small mb-1"><b b
                      style="font-size:20px;color: #585858">Fotos</b></label>
                  <input id="addPhoto"value ="" class="form-control py-1" type="file" id="" name="namephoto[]" multiple="multiple"/>
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



<script src="/res/admin/js/functions.js"></script>
<script type="text/javascript">observation()</script>  