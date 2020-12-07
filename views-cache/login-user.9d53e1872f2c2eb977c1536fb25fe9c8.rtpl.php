<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coleta de  Entulhos</title>
    <link rel="stylesheet" href="res/css/login_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
  </head>
	<body>

		<!--form area start-->
		<div class="form">
			 <img src="res/img/logo.png" class="logo" alt="">
			<form class="login-form" action="" method="post">
				<input class="user-input" type="email" name="" placeholder="Email" required>
				<input class="user-input" type="password" name="" placeholder="Senha" required>
				<div class="options-01">
					<label class="remember-me"><input type="checkbox" name="">Lembrar</label>
					<a href="#">Esqueceu a senha</a>
				</div>
				<input class="btn" type="submit" name="" value="Acessar">
				<div class="options-02">
					<p>Não é registrado? <a href="#">Crie uma conta</a></p>
				</div>
			</form>
			<!--login form end-->
			<!--signup form start-->
			<form class="signup-form" action="" method="post">
				<i style="font-size: 50px;color: #0B610B"  class="fas fa-user-plus"></i>
				<input class="user-input" type="text" name="" placeholder="Nome" required>
				<input class="user-input" type="email" name="" placeholder="Email " required>
				<input class="user-input" type="phone" name="" placeholder="Telefone" required>
				<input class="user-input" type="password" name="" placeholder="Senha" required>
				<input class="btn" type="submit" name="" value="Registrar">
				<div class="options-02">
					<p> <a href="#">Voltar</a></p>
				</div>
			</form>
			<!--signup form end-->
		</div>
		<!--form area end-->

		<script type="text/javascript">
		$('.options-02 a').click(function(){
			$('form').animate({
				height: "toggle", opacity: "toggle"
			}, "slow");
		});
		</script>

	</body>
</html>