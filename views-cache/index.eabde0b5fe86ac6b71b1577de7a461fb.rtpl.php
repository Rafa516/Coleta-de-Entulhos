<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #5FB404;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Painel de Controle<b></a>
                </li>
            </ul>

              <a href="/admin/calls-pendings"><div class="card-body color" style="background-color:#FE642E">
                <div class="float-left">
                    <h3>
                      <center><span class="count">Chamados Pendentes</span></center>
                    </h3>
                    <br><center> <i class="fas fa-exclamation-triangle" aria-hidden="true"></i></center>
                    <?php if( totalCallPendings() == 0 ){ ?>

                         <center><p style="font-size: 20px;">Nenhum Chamado</p></center>
                        
                        <?php }elseif( totalCallPendings() == 1 ){ ?>

                         <center><p style="font-size: 20px;"><?php echo totalCallPendings(); ?> Chamado</p></center>
                        
                        <?php }else{ ?>

                         <center><p style="font-size: 20px;"><?php echo totalCallPendings(); ?> Chamados</p></center>
                        
                        <?php } ?>

                </div>

            </div></a>
            <!--Widget End-->
            <!--Widget Start-->
            <a href="/admin/calls-progress"> <div class="card-body color" style="background-color:#D7DF01">
                <div class="float-left">
                    <h3>
                        <h3>
                            <center><span class="count">Chamados em Andamento</span></center>
                        </h3>
                        <br><center> <i class="fas fa-hourglass-half" aria-hidden="true"></i></center>
                         <?php if( totalCallProgress() == 0 ){ ?>

                         <center><p style="font-size: 20px;">Nenhum Chamado</p></center>
                        
                        <?php }elseif( totalCallProgress() == 1 ){ ?>

                         <center><p style="font-size: 20px;"><?php echo totalCallProgress(); ?> Chamado</p></center>
                        
                        <?php }else{ ?>

                         <center><p style="font-size: 20px;"><?php echo totalCallProgress(); ?> Chamados</p></center>
                        
                        <?php } ?>

                </div>

            </div></a>
            <!--Widget End-->
            <!--Widget Start-->
             <a href="/admin/calls-finished"><div class="card-body color" style="background-color:#00C292">
                <div class="float-left">
                    <h3>
                        <h3>
                            <center><span class="count">Chamados Finalizados</span></center>
                        </h3>
                        <br><center> <i class="fas fa-check-square" aria-hidden="true"></i></center>
                        <?php if( totalCallFinished() == 0 ){ ?>

                         <center><p style="font-size: 20px;">Nenhum Chamado</p></center>
                        
                        <?php }elseif( totalCallFinished() == 1 ){ ?>

                         <center><p style="font-size: 20px;"><?php echo totalCallFinished(); ?> Chamado</p></center>
                        
                        <?php }else{ ?>

                         <center><p style="font-size: 20px;"><?php echo totalCallFinished(); ?> Chamados</p></center>
                        
                        <?php } ?>

                </div>

            </div></a>
            <!--Widget End-->
            <!--Widget Start-->
            <a href="/admin/users"> <div class="card-body color" style="background-color:#0431B4">
                <div class="float-left">
                    <h3>
                        <h3>
                            <center><span class="count">Usuários Cadastrados</span></center>
                        </h3>
                        <br><center> <i class="fas fa-users" aria-hidden="true"></i></center>
                        <?php if( totalUsers() == 0 ){ ?>

                         <center><p style="font-size: 20px;">Nenhum usuário</p></center>
                        
                        <?php }elseif( totalUsers() == 1 ){ ?>

                         <center><p style="font-size: 20px;"><?php echo totalUsers(); ?> Usuário</p></center>
                        
                        <?php }else{ ?>

                         <center><p style="font-size: 20px;"><?php echo totalUsers(); ?> Usuários</p></center>
                        
                        <?php } ?>

                </div>

            </div></a>
            <!--Widget End-->

            <hr class="my-4" />


        </div>
    </div>
</div>