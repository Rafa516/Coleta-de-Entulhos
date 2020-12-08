<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coleta de  Entulhos</title>
    <link rel="stylesheet" href="res/user/css/login_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
  </head>
	<body>

		<!--form area start-->
		<div class="form">
			<form class="login-form" action="/login" method="post">

				 <img src="res/user/img/logo.png" class="logo" alt="">


			  <?php if( $profileMsg != '' ){ ?>
                <div class="alert alert-success">
                    <?php echo $profileMsg; ?>
                </div>
                <?php } ?>
                <?php if( $error != '' ){ ?>
			      <div class="alert alert-danger">
			   		<?php echo $error; ?>
			      </div>
			      <?php } ?>

			 <?php if( $errorRegister != '' ){ ?>
                <div class="alert alert-danger">
                    <?php echo $errorRegister; ?>
                </div>
                <?php } ?>

				<input class="user-input" type="email" name="login" placeholder="Email" required>
				<input class="user-input" type="password" name="despassword" placeholder="Senha" required>
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

			<form class="signup-form" action="/register" method="post" enctype="multipart/form-data"><br>

				<i style="font-size: 40px;color: #0B610B"  class="fas fa-user-plus"></i>
				<input class="user-input" type="text" name="person" placeholder="Nome" required>
				<input class="user-input" type="email" name="email" placeholder="Email " required>
				<input class="user-input" type="phone" name="phone" placeholder="Telefone" required>
				<input class="user-input" type="password" name="despassword" placeholder="Senha" required>
			
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