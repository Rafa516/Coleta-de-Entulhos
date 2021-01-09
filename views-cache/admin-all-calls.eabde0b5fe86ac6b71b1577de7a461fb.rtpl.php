<?php if(!class_exists('Rain\Tpl')){exit;}?>

<div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #088A08;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Tabela com Locais -   
                          <?php if( totalCalls() == 0 ){ ?>

                          Nenhum Local Registrado
                          <?php }elseif( totalCalls() == 1 ){ ?>

                          <?php echo totalCalls(); ?> Local Registrado
                          <?php }else{ ?>

                          <?php echo totalCalls(); ?> Locais Registrados
                          <?php } ?>  <b></a>

                </li>
            </ul>


            <?php if( $profileMsg != '' ){ ?>

            <div class="alert alert-success">
                <b><?php echo $profileMsg; ?></b>
            </div>
            <?php } ?>


             <?php if( totalCalls() != 0 ){ ?>

             <div class="table-responsive">
            <table class="table table-hover  table-bordered">
                <thead style="background-color: #D8D8D8">
                  <tr style="font-size: 16px; font-weight: bold; " >
                    
                  
                    <th  ><center>Local<b></th>
                    <th ><center>Observação</th>
                    <th><center>Localização</th>
                    <th><center>Fotos</th>
                 
                    <th><center>Tipos de Entulhos</th>
                    <th><center>Data de Registro</th>
                    <th><center>Excluir</th>

                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($allCalls) && ( is_array($allCalls) || $allCalls instanceof Traversable ) && sizeof($allCalls) ) foreach( $allCalls as $key1 => $value1 ){ $counter1++; ?>

                  <tr style="font-size: 15px;font-weight: normal;">
                   
                    <td><br><center><?php echo $value1["locality"]; ?></td>
                    <td><br><center><?php echo $value1["observation"]; ?></td>
                    <td><br><center><a href="/admin/calls/maps/<?php echo $value1["idcall"]; ?>"  class="btn btn-info btn-sm"></i><b>Localização</b></a></td/>
                   
                    <td><br><center>   <a href="/admin/calls/images/<?php echo $value1["idcall"]; ?>" style="width: 100px;" class="btn btn-info btn-sm" >
                      <?php if( numPhotos($value1["idcall"]) == 1 ){ ?>

                      <b><?php echo numPhotos($value1["idcall"]); ?> Foto</b></a>
                      <?php }else{ ?>

                      <b><?php echo numPhotos($value1["idcall"]); ?> Fotos</b></a>
                      <?php } ?>

                   </td/>
                 
                   </td/>

                    <td><br><center>
                      <?php echo $value1["type1"]; ?> &ensp; 
                      <?php echo $value1["type2"]; ?> &ensp;
                      <?php echo $value1["type3"]; ?> &ensp;
                      <?php echo $value1["type4"]; ?>

                      
                      </td>

                    <td><br><center><?php echo formatDate($value1["dtregister"]); ?></td>
                    <td><br><center> <a style="width: 80px;" href="/admin/calls/delete/<?php echo $value1["idcall"]; ?>"  onclick="return confirm('Deseja realmente excluir o registro do local: <?php echo $value1["locality"]; ?>?')" class="btn btn-danger btn-sm"> Excluir</a></td>
                   
                   
                  </tr>
                  
                  <?php } ?>

                </tbody>
              </table>
          </div>
           <?php } ?>

          <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>


            <hr class="my-4" />


        </div>
    </div>
</div>



      