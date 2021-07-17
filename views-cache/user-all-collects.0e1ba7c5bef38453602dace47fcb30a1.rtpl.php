<?php if(!class_exists('Rain\Tpl')){exit;}?>

<div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #088A08;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Pontos de Coletas -   
                          <?php if( totalCollects() == 0 ){ ?>

                          Nenhum Local Registrado
                          <?php }elseif( totalCollects() == 1 ){ ?>

                          <?php echo totalCollects(); ?> Local Registrado
                          <?php }else{ ?>

                          <?php echo totalCollects(); ?> Locais Registrados
                          <?php } ?>  </b></a>

                </li>
            </ul>


            <?php if( $profileMsg != '' ){ ?>

            <div class="alert alert-success">
                <b><?php echo $profileMsg; ?></b>
            </div>
            <?php } ?>


             <?php if( totalCollects() != 0 ){ ?>

            
                <div class="search" style="float: right">
                  <form  action="/user/all-collects" method="get" >
                        <div class="input-group">
                          <input   type="text" name="search"  class="form-control" placeholder="Digite sua pesquisa...">
                              <span  class="input-group-btn">
                                <button  class="btn btn" style="background-color: #088A08;color: white" type="submit"  id="search-btn"  ><i class="fa fa-search"style="font-size:13px;" > PESQUISAR</i>
                                </button>
                              </span>
                        </div>
                      </form>
                 </div><br><br>
            <div class="table-responsive">
            <table class="table table-hover  table-bordered">
                <thead style="background-color: #D8D8D8">
                  <tr style="font-size: 16px; font-weight: bold; " >
                    
                  
                    <th  ><center>Local<b></th>
                    <th ><center>Contato</th>
                    <th><center>E-mail</th>
                    <th><center>Serviço</th>
                    <th><center>Informações</th>
                    <th><center>Localização</th>
                    <th><center>Fotos</th>
                    <th><center>Data de Registro</th>
                   

                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($allCollects) && ( is_array($allCollects) || $allCollects instanceof Traversable ) && sizeof($allCollects) ) foreach( $allCollects as $key1 => $value1 ){ $counter1++; ?>

                  <tr style="font-size: 15px;font-weight: normal;">
                   
                    <td><br><center><?php echo $value1["locality"]; ?></td>
                    <td><br><center><?php echo $value1["phone"]; ?></td>
                    <td><br><center><?php echo $value1["email"]; ?></td>
                    <td><br><center><?php echo $value1["service"]; ?> </td>
                    <td><br><center><?php echo $value1["informations"]; ?> </td>
                    <td><br><center><a href="/user/collects/maps/<?php echo $value1["idcollect"]; ?>"  class="btn btn-info btn-sm"></i><b>Localização</b></a></td/>
                   
                    <?php if( namePhotosCollects($value1["idcollect"]) == '' ){ ?>

                       <td><br><center><b>Sem Fotos</b></td>
                        <?php }else{ ?>

                    <td><br><center>   <a href="/user/collects/images/<?php echo $value1["idcollect"]; ?>" style="width: 100px;" class="btn btn-info btn-sm" >
                      <?php if( numPhotosCollects($value1["idcollect"]) == 1 ){ ?>

                      <b><?php echo numPhotosCollects($value1["idcollect"]); ?> Foto</b></a>
                      <?php }else{ ?>

                      <b><?php echo numPhotosCollects($value1["idcollect"]); ?> Fotos</b></a>
                      <?php } ?>

                   </td/>
                      <?php } ?>

                 
                   </td/>
                    <td><br><center><?php echo formatDate($value1["dtregister"]); ?></td>
                   
                   
                   
                  </tr>
                  
                  <?php } ?>

                </tbody>
              </table>
            </div>
                <br>
              <center>
            <div class="box-footer clearfix">
              <ul class="pagination">
               <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>

                          <?php if( $pages == $value1["link"] ){ ?> 
                       <li> <a class="active"href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a></li>
                        <?php }else{ ?>

                        <li><a href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a></li>
                          <?php } ?>

                        <?php } ?>

              </ul>
            </div>
          </center>
          </div>
           <?php } ?>

          <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>


            <hr class="my-4" />


        </div>
    </div>
</div>



      