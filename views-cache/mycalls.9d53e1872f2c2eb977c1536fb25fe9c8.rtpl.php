<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="content-inside">
    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #5FB404;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Meus chamados</b></a>
        </li>
      </ul>

      <div class="table-responsive">
        <table class="table table-hover  table-bordered">
          <thead style="background-color: #D8D8D8">
            <tr style="font-size: 16px; font-weight: bold; ">

              <th>
                <center>Código<b>
              </th>
              <th>
                <center>Local<b>
              </th>
              <th>
                <center>Observação
              </th>
              <th>
                <center>Localização
              </th>
              <th>
                <center>Fotos
              </th>
              <th>
                <center>Prioridade
              </th>
              <th>
                <center>Situação
              </th>
              <th>
                <center>Data de Registro
              </th>
            </tr>
          </thead>
          <tbody>
            <?php $counter1=-1;  if( isset($calls) && ( is_array($calls) || $calls instanceof Traversable ) && sizeof($calls) ) foreach( $calls as $key1 => $value1 ){ $counter1++; ?>

            <tr style="font-size: 15px;font-weight: normal;">

              <td><br>
                <center><?php echo $value1["idcall"]; ?>

              </td>
              <td><br>
                <center><?php echo $value1["locality"]; ?>

              </td>
              <td><br>
                <center><?php echo $value1["observation"]; ?>

              </td>
              <td><br>
                <center><a href="/user/calls/maps/<?php echo $value1["idcall"]; ?>" class="btn btn-info btn-sm"><b> Localização</b></a>
              </td />
              <?php if( namePhotos($value1["idcall"]) == '' ){ ?>

                    <td><br><center><b>Sem Fotos<b></td/>
                    <?php }else{ ?>

                    <td><br><center>   <a href="/user/calls/images/<?php echo $value1["idcall"]; ?>" style="width: 100px;" class="btn btn-info btn-sm" >
                      <?php if( numPhotos($value1["idcall"]) == 1 ){ ?>

                      <b><?php echo numPhotos($value1["idcall"]); ?> Foto</b></a>
                      <?php }else{ ?>

                      <b><?php echo numPhotos($value1["idcall"]); ?> Fotos</b></a>
                      <?php } ?>

                   </td/>
                   <?php } ?>

              <td><br>
                <center><?php echo $value1["priority"]; ?>

              </td>
              <td><br>
                <center>
                  <?php if( $value1["situation"] == 1 ){ ?><b style="color: #FF4000;">Pendente</b>
                  <?php }elseif( $value1["situation"] == 2 ){ ?><b style="color: #D7DF01;">Em Andamento</b>
                  <?php }else{ ?><b style="color: #04B404;">Finalizado</b>
                  <?php } ?>

              </td>
              <td><br>
                <center><?php echo formatDate($value1["dtregister"]); ?>

              </td>


            </tr>



            <?php } ?>

          </tbody>
        </table>
      </div>



      <hr class="my-4" />


    </div>
  </div>
</div>