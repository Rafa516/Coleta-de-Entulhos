<?php if(!class_exists('Rain\Tpl')){exit;}?>

<div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #5FB404;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>
                           <?php if( totalCallFinished() == 0 ){ ?>

                          Nenhum Chamado Finalizado
                          <?php }elseif( totalCallFinished() == 1 ){ ?>

                          <?php echo totalCallFinished(); ?> Chamado Finalizado
                          <?php }else{ ?>

                          <?php echo totalCallFinished(); ?> Chamados Finalizados
                          <?php } ?> 
                         <b></a>
                </li>
            </ul>
             <?php if( totalCallFinished() != 0 ){ ?>

             <div class="table-responsive">
            <table class="table table-hover  table-bordered">
                <thead style="background-color: #D8D8D8">
                  <tr style="font-size: 16px; font-weight: bold; " >
                    
                    <th  ><center>Código<b></th>
                    <th  ><center>Foto<b></th>
                    <th  ><center>Nome<b></th>
                    <th  ><center>Local<b></th>
                    <th ><center>Observação</th>
                    <th><center>Mapa</th>
                    <th><center>Fotos</th>
           
                    <th><center>Situação</th>
                    <th><center>Data de Registro</th>
                    <th><center>Excluir</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($callFinished) && ( is_array($callFinished) || $callFinished instanceof Traversable ) && sizeof($callFinished) ) foreach( $callFinished as $key1 => $value1 ){ $counter1++; ?>

                  <tr style="font-size: 15px;font-weight: normal;">
                    <td><br><center><?php echo $value1["idcall"]; ?></td>
                    <td><br><center> 
                      <?php if( $value1["picture"] == 0 && $value1["genre"] == 1 ){ ?>

                      <img src="/res/ft_perfil/ft_male.png" style="height: 50px;width: 50px;border-radius: 30px;">
                      <?php }elseif( $value1["picture"] == 0 && $value1["genre"] == 2 ){ ?>

                      <img src="/res/ft_perfil/ft_female.png" style="height: 50px;width: 50px;border-radius: 30px;">
                      <?php }elseif( $value1["picture"] == 0 && $value1["genre"] == 3 ){ ?>

                      <img src="/res/ft_perfil/ft_unknowm.png" style="height: 50px;width: 50px;border-radius: 30px;">
                      <?php }else{ ?>

                      <img src="/res/ft_perfil/<?php echo $value1["picture"]; ?>" style="height: 50px;width: 50px;border-radius: 30px;">
                      <?php } ?>

                    </td>
                    <td><br><center><?php echo $value1["person"]; ?></td>
                    <td><br><center><?php echo $value1["locality"]; ?></td>
                    <td><br><center><?php echo $value1["observation"]; ?></td>
                    <td><br><center><a href="/admin/calls/maps/<?php echo $value1["idcall"]; ?>"  class="btn btn-info btn-sm"><b>Localização</b></a></td/>
                    <td><br><center>   <a href="/admin/calls/images/<?php echo $value1["idcall"]; ?>"  style="width: 100px;" class="btn btn-info btn-sm" >
                     <?php if( numPhotos($value1["idcall"]) == 1 ){ ?>

                      <b><?php echo numPhotos($value1["idcall"]); ?> Foto</b></a>
                      <?php }else{ ?>

                      <b><?php echo numPhotos($value1["idcall"]); ?> Fotos</b></a>
                      <?php } ?>

                   </td/>
                 
                    <td><br><center>
                      <?php if( $value1["situation"] == 1 ){ ?>

                         
                          <a style="width: 80px;" href="/admin/call-situation/<?php echo $value1["idcall"]; ?>" onclick="return confirm('Deseja alterar a situação do chamado <?php echo $value1["idcall"]; ?>?')" type="button" class="btn btn-outline-danger btn-sm ">Pendente</a></td>
                      <?php }elseif( $value1["situation"] == 2 ){ ?>

                         
                            <a style="width: 120px;color: #585858"  href="/admin/call-situation/<?php echo $value1["idcall"]; ?>" onclick="return confirm('Deseja alterar a situação do chamado <?php echo $value1["idcall"]; ?>?')" type="button" class="btn btn-outline-warning btn-sm ">Em andamento</a></td>
                      <?php }else{ ?>

                          <a style="width: 80px;"  href="/admin/call-situation/<?php echo $value1["idcall"]; ?>" onclick="return confirm('Deseja alterar a situação do chamado <?php echo $value1["idcall"]; ?>?')" type="button" class="btn btn-outline-success btn-sm ">Finalizado</a>
                         
                      <?php } ?>

                    </td>
                    <td><br><center><?php echo formatDate($value1["dtregister"]); ?></td>
                    <td><br><center> <a style="width: 80px;" href="/admin/calls/delete/<?php echo $value1["idcall"]; ?>"  onclick="return confirm('Deseja realmente excluir o chamado <?php echo $value1["idcall"]; ?>?')" class="btn btn-danger btn-sm"> Excluir</a></td>
                                     
                  </tr>       
                  <?php } ?>

                </tbody>
              </table>
          </div>          
            <hr class="my-4" />
        <?php } ?>

            <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>

        </div>
    </div>
</div>



      