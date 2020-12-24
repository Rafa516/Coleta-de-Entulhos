<?php if(!class_exists('Rain\Tpl')){exit;}?>

<div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #5FB404;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Situação do chamado <?php echo $idcall["value"]; ?></b></a>
                </li>
            </ul>
            
            <?php if( $callSituation["value"] == 1 ){ ?>

           <form class="form-group" action="/admin/calls/update-situation/<?php echo $idcall["value"]; ?>" method="post">
           <div class="form-group">
                <select class="form-control " name="situation">
                    <option value="1">Pendente</option>
                    <option value="2">Em andamento</option>
                    <option value="3">Finalizado</option>
                     </select>
            </div>
           
              <input class="btn btn-primary btn btn-block" type="submit" value="Alterar">
           </form>

            <?php }elseif( $callSituation["value"] == 2 ){ ?>

           <form class="form-group" action="/admin/calls/update-situation/<?php echo $idcall["value"]; ?>" method="post">
           <div class="form-group">
                <select class="form-control " name="situation">
                    <option value="2">Em andamento</option>
                    <option value="1">Pendente</option>
                    <option value="3">Finalizado</option>
                     </select>
            </div>
           
              <input class="btn btn-primary btn btn-block" type="submit" value="Alterar">
           </form>
            <?php }else{ ?>

           <form class="form-group" action="/admin/calls/update-situation/<?php echo $idcall["value"]; ?>" method="post">
           <div class="form-group">
                <select class="form-control " name="situation">
                    <option value="3">Finalizado</option>
                    <option value="2">Em andamento</option>
                    <option value="1">Pendente</option>
                     </select>
            </div>
           
              <input class="btn btn-primary btn btn-block" type="submit" value="Alterar">
           </form>
             <?php } ?>

            

            <hr class="my-4" />

            <a href="javascript:history.back()" class="btn btn-info btn-xs">Voltar</a>

        </div>
    </div>
</div>



      