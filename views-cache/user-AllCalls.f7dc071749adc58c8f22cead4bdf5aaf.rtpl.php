<?php if(!class_exists('Rain\Tpl')){exit;}?>

<div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #088A08;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Tabela com Locais -   
                          <?php if( totalCalls() == 0 ){ ?>

                          Nenhum Local Resgistrado
                          <?php }elseif( totalCalls() == 1 ){ ?>

                          <?php echo totalCalls(); ?> Local Registrado
                          <?php }else{ ?>

                          <?php echo totalCalls(); ?> Locais Registrados
                          <?php } ?>  </b></a>
                      
                </li>
                     
            </ul>

             <?php if( totalCalls() != 0 ){ ?>

             <div class="table-responsive">
              <div style="float: right">
                  <form  action="/user/all-calls" method="get" >
                        <div class="input-group">
                          <input   type="text" name="search"  class="form-control" placeholder="Digite sua pesquisa...">
                              <span  class="input-group-btn">
                                <button  class="btn btn" style="background-color: #088A08;color: white" type="submit"  id="search-btn"  ><i class="fa fa-search"style="font-size:13px;" > PESQUISAR</i>
                                </button>
                              </span>
                        </div>
                      </form>
                 </div><br><br>
            <table class="table table-hover  table-bordered">
                <thead style="background-color: #D8D8D8">
                  <tr style="font-size: 16px; font-weight: bold; " >
                    
                  
                    <th  ><center>Local<b></th>
                    <th ><center>Observação</th>
                    <th><center>Localização</th>
                    <th><center>Fotos</th>
                 
                    <th><center>Tipos de Entulhos</th>
                    <th><center>Data de Registro</th>
                  

                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($allCalls) && ( is_array($allCalls) || $allCalls instanceof Traversable ) && sizeof($allCalls) ) foreach( $allCalls as $key1 => $value1 ){ $counter1++; ?>

                  <tr style="font-size: 15px;font-weight: normal;">
                   
                    <td><br><center><?php echo $value1["locality"]; ?></td>
                    <td><br><center><?php echo $value1["observation"]; ?></td>
                    <td><br><center><a href="/user/calls/maps/<?php echo $value1["idcall"]; ?>"  class="btn btn-info btn-sm"></i><b>Localização</b></a></td/>
                   
                    <?php if( namePhotos($value1["idcall"]) == '' ){ ?>

                       <td><br><center><b>Sem Fotos</b></td>
                        <?php }else{ ?>

                    <td><br><center>   <a href="/user/calls/images/<?php echo $value1["idcall"]; ?>" style="width: 100px;" class="btn btn-info btn-sm" >
                      <?php if( numPhotos($value1["idcall"]) == 1 ){ ?>

                      <b><?php echo numPhotos($value1["idcall"]); ?> Foto</b></a>
                      <?php }else{ ?>

                      <b><?php echo numPhotos($value1["idcall"]); ?> Fotos</b></a>
                      <?php } ?>

                   </td/>
                      <?php } ?>

                 
                   </td/>

                    <td><br><center>
                      <?php echo $value1["type1"]; ?> 
                      <?php echo $value1["type2"]; ?> 
                      <?php echo $value1["type3"]; ?> 
                      <?php echo $value1["type4"]; ?>  
                      </td>

                    <td><br><center><?php echo formatDate($value1["dtregister"]); ?></td>
                  
                   
                  </tr>
                  
                  <?php } ?>

                </tbody>
              </table>
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



      