<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
   
   <div class="content-inside">
             
          <div class="my-4">
              <ul  class="nav nav-tabs mb-4" id="myTab" role="tablist">
                  <li class="nav-item">
                      <a  style="background-color: #5FB404;color: white"  class="nav-link active" id="home-tab" data-toggle="tab"  role="tab" aria-controls="home" aria-selected="false"><b>Perfil<b></a>
                  </li>
              </ul>
              <form>
                  <div class="row mt-5 align-items-center">
                      <div class="col-md-3 text-center mb-5">
                          <div class="avatar avatar-xl">
                              <?php if( $user["picture"] == 0 ){ ?>

                              <img  src="/../res/admin/ft_perfil/no_photo.png" alt="..." class="avatar-img rounded-circle" />
                              <?php }else{ ?>

                               <img  src="/../res/admin/ft_perfil/<?php echo $user["picture"]; ?>" alt="..." class="avatar-img rounded-circle" />
                              <?php } ?>

                          </div>
                      </div>
                      <div class="col">
                          <div class="row align-items-center">
                              <div class="col-md-7">
                                  <h4 style="font-size: 25px;color: #585858;" class="mb-1"><?php echo $user["person"]; ?></h4>

                              </div>
                          </div>
                          <div class="row mb-4">
                              <div class="col-md-7">
                                  <p class="text-muted">
                                  <p style="font-size: 18px;color: #585858;" class="small mb-1"><b>Cidade:</b></p>
                                  <p style="font-size: 18px;color: #585858;" class="small mb-1"><b>Endereço:</b></p>
                                  <p style="font-size: 18px;color: #585858;" class="small mb-1"><b>Email:</b> <?php echo $user["email"]; ?></p>
                                  <p style="font-size: 18px;color: #585858;" class="small mb-1"><b>Login:</b> <?php echo $user["login"]; ?></p>
                                  <p style="font-size: 18px;color: #585858;" class="small mb-1"><b>Data Nascimento:</b></p>
                                 
                              </div>
                             
                          </div>
                      </div>
                  </div>
                  <hr class="my-4" />
                
                  </div>
                  <button type="submit" class="btn btn-primary"><b>Editar</b> </button>
              </form>
          </div>
      </div>
  </div>

  
</div>