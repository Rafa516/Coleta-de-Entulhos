<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coleta de Entulhos</title>
  <link href="/res/user/img/icon.png" rel="icon">
  <link rel="stylesheet" href="/res/user/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>

  <input type="checkbox" id="check">
  <!--header area start-->
  <header>
    <label for="check">
      <i class="fas fa-bars" id="sidebar_btn"></i>
    </label>
    <div class="left_area">
      <h3>Coleta de Entulhos</h3>
    </div>
    <div class="right_area">
      <a href="/user/logout"  class="logout_btn">Sair</a>
    </div>
  </header>
  <!--header area end-->

  <!--mobile navigation bar start-->
  <div class="mobile_nav">
    <div class="nav_bar">
      <?php if( $user["picture"] == 0 ){ ?>

      <img src="/res/user/ft_perfil/no_photo.png" class="mobile_profile_image" alt="">
      <?php }else{ ?>

      <img src="/res/user/ft_perfil/<?php echo $user["picture"]; ?>" class="mobile_profile_image" alt="">
      <?php } ?>

      <b style="font-size: 17px;color: white;"><?php echo getUserName(); ?></b>
      <i class="fa fa-bars nav_btn"></i>
    </div>
    <div class="mobile_nav_items">
      <a href="/user"><i class="fas fa-home"></i><span>Home</span></a>
      <a href="#"><i class="fas fa-address-card"></i><span>Abertura de Chamado</span></a>
      <a href="#"><i class="fas fa-table"></i><span>Andamento do Chamado</span></a>
      <a href="#"><i class="fas fa-th"></i><span>Relatórios</span></a>
      <a href="/user/profile"><i class="fas fa-info-circle"></i><span>Meu Perfil</span></a>
    </div>
  </div>
  <!--mobile navigation bar end-->

  <!--sidebar start-->
  <div class="sidebar">
    <div class="profile_info">
      <?php if( $user["picture"] == 0 ){ ?>

      <img src="/res/user/ft_perfil/no_photo.png" class="profile_image" alt="">
      <?php }else{ ?>

      <img src="/res/user/ft_perfil/<?php echo $user["picture"]; ?>" class="profile_image" alt="">
      <?php } ?>

      <center><b style="font-size: 18px;color: white;"><?php echo getUserName(); ?></b></center>
    </div>
     <a href="/user"><i class="fas fa-home"></i><span>Home</span></a>
    <a href="#"><i class="fas fa-address-card"></i><span>Abertura de Chamado</span></a>
    <a href="#"><i class="fas fa-table"></i><span>Andamento do Chamado</span></a>
    <a href="#"><i class="fas fa-th"></i><span>Relatórios</span></a>
    <a href="/user/profile"><i class="fas fa-info-circle"></i><span>Meu Perfil</span></a>
  </div>
  <!--sidebar end-->