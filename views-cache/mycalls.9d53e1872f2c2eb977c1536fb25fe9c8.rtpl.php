<?php if(!class_exists('Rain\Tpl')){exit;}?>

<div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #5FB404;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Meus chamados<b></a>
                </li>
            </ul>

             <div class="table-responsive">
            <table class="table table-hover  table-bordered">
                <thead style="background-color: #D8D8D8">
                  <tr style="font-size: 16px; font-weight: bold; " >
                    
                    <th  ><center>Código<b></th>
                    <th  ><center>Local<b></th>
                    <th ><center>Obsercação</th>
                    <th><center>Mapa</th>
                    <th><center>Fotos</th>
                    <th><center>Situação</th>
                    <th><center>Data de Registro</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($calls) && ( is_array($calls) || $calls instanceof Traversable ) && sizeof($calls) ) foreach( $calls as $key1 => $value1 ){ $counter1++; ?>

                  <tr style="font-size: 15px;font-weight: normal;">
                    
                    <td><center><?php echo $value1["idcall"]; ?></td>
                    <td><center><?php echo $value1["locality"]; ?></td>
                    <td><center><?php echo $value1["observation"]; ?></td>
                    <td><center><a href=""  class="btn btn-info btn-xs"><i class="fa fa-globe"></i> Mapa</a></td/>
                    <td><center>   <a href="/user/mycalls/images/<?php echo $value1["idcall"]; ?>"  class="btn btn-info btn-xs"><i class="fa fa-camera"></i> Fotos</a>
                   </td/>
                    <td><center><?php if( $value1["situation"] == 1 ){ ?><b style="color: #FF4000;">Pendente</b><?php }else{ ?>Não<?php } ?></td>
                    <td><center><?php echo formatDate($value1["dtregister"]); ?></td>
                   
                   
                  </tr>
         

                  
                  <?php } ?>

                </tbody>
              </table>
          </div>
            


            <hr class="my-4" />


        </div>
    </div>
</div>



      