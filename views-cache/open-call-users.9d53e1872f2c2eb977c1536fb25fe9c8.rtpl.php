<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

  <div class="content-inside">

    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #5FB404;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Abertura de Chamado<b></a>
        </li>
      </ul>

       <?php if( $CallOpenMsg != '' ){ ?>

            <div class="alert alert-success">
                <b><?php echo $CallOpenMsg; ?></b>
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

              <form class="form-group" action="/user/open-call/submit" method="post" enctype="multipart/form-data"><br>


                <div class="form-group"><label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Local</b></label>
                  <input class="form-control py-1" placeholder="Preencha o Endereço e a Cidade" type="text" name="locality" required />
                </div>

                <div class="form-group"><label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Observação</b></label>
                  <textarea  id="observation"  value=""  type="text" name="observation"> </textarea>
                </div>



                <div class="form-group"><label class="small mb-1"><b b
                      style="font-size:20px;color: #585858">Fotos</b></label>
                  <input  class="form-control py-1" type="file" id="addPhoto" name="namephoto[]" multiple="multiple"/>
                </div>

                <input class="form-control py-1" value="<?php echo $user["iduser"]; ?>" name="iduser" type="hidden">

                <input class="form-control py-1" value="1" name="situation" type="hidden">


                <input class="form-control py-1" id="lat" type="hidden" name="lat">


                <input class="form-control py-1" id="lng" type="hidden" name="lng">


                <center><input style="width:100%;" class="btn btn-primary btn " type="submit" value="Enviar"></center>

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
attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> Contributors'
});

var map = new L.Map('map', {
  'center': [-16.027876751643, -48.041942848535],
  'zoom': 13,
  'layers': [tileLayer]
});

  var muxiIconProperties = {
      iconUrl: "/res/map/marker.png"
    , iconSize: [44, 59]
    };

    var muxiIcon = L.icon(muxiIconProperties);

var marker = L.marker([-16.027876751643, -48.041942848535],{
  draggable: true,
  icon: muxiIcon
}).addTo(map);

marker.on('dragend', function (e) {
  document.getElementById('lat').value = marker.getLatLng().lat;
  document.getElementById('lng').value = marker.getLatLng().lng;
});
</script>

<script src="/res/user/js/functions.js"></script>

<script type="text/javascript">observation()</script>   