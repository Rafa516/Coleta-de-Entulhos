<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #088A08;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Informações  
                          </b></a>
                </li>
            </ul>
        
      

      
           <div style="float: right">
                  <form  action="" method="get" >
                        <div class="input-group">
                          <input   type="text" name="search"  class="form-control" placeholder="Digite sua pesquisa...">
                              <span  class="input-group-btn">
                                <button  class="btn btn" style="background-color: #088A08;color: white" type="submit"  id="search-btn"  ><i class="fa fa-search"style="font-size:13px;" > PESQUISAR</i>
                                </button>
                              </span>
                        </div>
                      </form>
                 </div><br><br><br><br>


                 <?php $counter1=-1;  if( isset($informations) && ( is_array($informations) || $informations instanceof Traversable ) && sizeof($informations) ) foreach( $informations as $key1 => $value1 ){ $counter1++; ?>


                <h5><b>Autor: <?php echo $value1["person"]; ?></b></h5> 
                <i class="fa fa-calendar-alt"></i>&nbsp;&nbsp;<?php echo formatDate($value1["dtregister"]); ?><br><br>

                 <h2><?php echo $value1["title"]; ?></h2><br>
                 <?php echo $value1["informations"]; ?><br><br>

            

                <hr class="my-4" />

                 <?php } ?>


             

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
          
          <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>
          </div>

          
            <hr class="my-4" />


        </div>
    </div>
</div>

    