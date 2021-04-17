<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #088A08;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Painel de Controle<b></a>
                </li>
            </ul>
             <center><img src="res/user/img/logo.png"  alt="">

          <center>
              <!--Widget Start-->
             <a href="/admin/all-collects"><div class="card-body color" style="background-color:#088A08">
                <div class="float-left">
                    <h3>
                        <h3>
                            <center><span class="count">Pontos de &nbsp;&nbsp;Coletas</span><center>
                        </h3>
                        <br><center> <i class="fas fa-recycle" aria-hidden="true"></i></center>
                        <?php if( totalCollects() == 0 ){ ?>

                         <center><p style="font-size: 20px;">Nenhum Registrado</p></center>
                        
                        <?php }elseif( totalMarkers() == 1 ){ ?>

                         <center><p style="font-size: 20px;"><?php echo totalCollects(); ?> Registrado</p></center>
                        
                        <?php }else{ ?>

                         <center><p style="font-size: 20px;"><?php echo totalCollects(); ?> Registrados</p></center>
                        
                        <?php } ?>

                </div>

            </div></a>
            <!--Widget End-->
            <!--Widget Start-->
             <a href="/admin/all-markers"><div class="card-body color" style="background-color:#FF4000">
                <div class="float-left">
                    <h3>
                        <h3>
                            <span class="count">Pontos de Entulhos</span>
                        </h3>
                        <br><center> <i class="fa fa-globe" aria-hidden="true"></i></center>
                        <?php if( totalMarkers() == 0 ){ ?>

                         <center><p style="font-size: 20px;">Nenhum Registrado</p></center>
                        
                        <?php }elseif( totalMarkers() == 1 ){ ?>

                         <center><p style="font-size: 20px;"><?php echo totalMarkers(); ?> Registrado</p></center>
                        
                        <?php }else{ ?>

                         <center><p style="font-size: 20px;"><?php echo totalMarkers(); ?> Registrados</p></center>
                        
                        <?php } ?>

                </div>

            </div></a>
            <!--Widget End-->
            <!--Widget Start-->
            <a href="/admin/users"> <div class="card-body color" style="background-color:#0431B4">
                <div class="float-left">
                    <h3>
                        <h3>
                            <span class="count">Usuários Cadastrados</span>
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
        </center>

            <hr class="my-4" />


        </div>
    </div>
</div>