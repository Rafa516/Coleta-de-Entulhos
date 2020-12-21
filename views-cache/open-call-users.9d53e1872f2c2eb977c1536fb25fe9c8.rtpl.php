<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

  <div class="content-inside">

    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #5FB404;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Abertura de Chamado<b></a>
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

              <form class="form-group" action="/user/open-call/submit" method="post" enctype="multipart/form-data"><br>


                <div class="form-group"><label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Local</b></label>
                  <input class="form-control py-1" type="text" name="locality" required />
                </div>

                <div class="form-group"><label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Observação</b></label>
                  <textarea class="form-control py-1" value="" type="text" name="observation"> </textarea>
                </div>

                 <div class="form-group"><label class="small mb-1"><b
                      style="font-size:20px;color: #585858">Prioridade</b></label>
                    <select class="form-control py-1" name="priority" id="city">
                      <option value="Baixa">Baixa</option>
                      <option value="Alta">Alta</option>
                    </select>
                </div>



                <div class="form-group"><label class="small mb-1"><b b
                      style="font-size:20px;color: #585858">Fotos</b></label>
                  <input class="form-control py-1" type="file" id="" name="namephoto[]" multiple="multiple" required />
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

<script>
  var marker;          //Variável do marcador
  var coords = {};    //Coordenadas

  //Função principal
  initMap = function () {

    //API de geolocalização
    navigator.geolocation.getCurrentPosition(
      function (position) {
        coords = {
          lng: position.coords.longitude,
          lat: position.coords.latitude
        };
        setMapa(coords);


      }, function (error) { console.log(error); });

  }

  function setMapa(coords) {

    var map = new google.maps.Map(document.getElementById('map'),
      {
        zoom: 13,
        center: new google.maps.LatLng(coords.lat, coords.lng),

      });

    marker = new google.maps.Marker({
      map: map,
      draggable: true,
      animation: google.maps.Animation.DROP,
      position: new google.maps.LatLng(coords.lat, coords.lng),

    });

    marker.addListener('click', toggleBounce);

    marker.addListener('dragend', function (event) {

      document.getElementById("lat").value = this.getPosition().lat();
      document.getElementById("lng").value = this.getPosition().lng();
    });
  }

  function toggleBounce() {
    if (marker.getAnimation() !== null) {
      marker.setAnimation(null);
    } else {
      marker.setAnimation(google.maps.Animation.BOUNCE);
    }
  }
</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJ1RqQyxumXFMLKO2NG9isrbO8nXTPtxc&callback=initMap">
  </script>

<script src="/res/user/js/functions.js"></script>