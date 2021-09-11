<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pontos de Entulhos</title>
	<link href="/res/user/img/icon.png" rel="icon">
	<link rel="stylesheet" href="/res/user/css/login_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>

	<!--form area start-->

	<center><img src="res/user/img/logo.png" class="logo" alt=""></center>

	<div class="form">
		<form class="login-form" action="/login" method="post">

			


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


			<input    class="user-login" type="email" name="login" placeholder="Email" required>
			<input class="user-login" type="password" name="despassword" placeholder="Senha" required>
			<div class="options-01">
				<label class="remember-me"><input type="checkbox" name="">Lembrar</label>
				<a href="/forgot">Esqueceu a senha</a>
			</div>
			<input class="btn" type="submit" name="" value="Acessar">
			<div class="options-02">
				<p>Não é registrado? <a href="#">Crie uma conta</a></p>
			</div>
		</form>

		
		<!--login form end-->
		<!--signup form start-->

		<form class="signup-form" action="/register" method="post"><br>


			<i style="font-size: 40px;color: #0B610B" class="fas fa-user-plus"></i><br>
			Nome
			<input class="user-input" id="person"type="text" name="person" placeholder="Digite seu nome" required>
			Email
			<input class="user-input" id="email"type="email" name="email" placeholder="Digite um e-mail válido " required>
			Telefone
			<input class="user-input" id="phone"type="tel" name="phone" placeholder="(00)-00000 0000" maxlength="13"
				pattern="[0-9]+$" required>

			Endereço
			<input class="user-input"  id="address" type="text" name="address" placeholder="Digite seu Endereço" required>

			Data de Nascimento
			<input class="user-input" id="born_date" type="date" name="born_date" required>

			Gênero
			<select class="user-input" name="genre" id="genre">
				<option value="1">Masculino</option>
				<option value="2">Feminino</option>
				<option value="3">Outros</option>
			</select>

			Senha
			<input class="user-input"  id="despassword"type="password" name="despassword" placeholder="Digite uma senha" required>
			Cidade
			<select class="user-input" name="city" id="city">
				<option value="Brasília - DF">Brasília - DF</option>
				<option value="Gama - DF">Gama - DF</option>
				<option value="Taguatinga - DF">Taguatinga - DF</option>
				<option value="Brazlândia - DF">Brazlândia - DF</option>
				<option value="Sobradinho - DF">Sobradinho - DF</option>
				<option value="Planaltina - DF">Planaltina - DF</option>
				<option value="Paranoá - DF">Paranoá - DF</option>
				<option value="Núcleo Bandeirante - DF">Núcleo Bandeirante - DF</option>
				<option value="Ceilândia - DF">Ceilândia - DF</option>
				<option value="Guará - DF">Guará - DF</option>
				<option value="Cruzeiro - DF">Cruzeiro - DF</option>
				<option value="Samambaia - DF"> Samambaia - DF</option>
				<option value="Santa Maria- DF">Santa Maria - DF</option>
				<option value="São Sebastião - DF">São Sebastião - DF</option>
				<option value="Recanto das Emas - DF">Recanto das Emas - DF</option>
				<option value="Lago Sul - DF">Lago Sul - DF</option>
				<option value="Riacho Fundo - DF">Riacho Fundo - DF</option>
				<option value="Lago Norte - DF">Lago Norte - DF</option>
				<option value="Candangolândia - DF">Candangolândia - DF</option>
				<option value="Águas Claras- DF">Águas Claras - DF</option>
				<option value="Riacho Fundo II - DF">Riacho Fundo II - DF</option>
				<option value="Sudoeste/Octogonal - DF">Sudoeste/Octogonal - DF</option>
				<option value="Varjão - DF">Varjão - DF</option>
				<option value="Park Way - DF">Park Way - DF</option>
				<option value="SCIA - DF">SCIA - DF</option>
				<option value="Sobradinho II - DF">Sobradinho II - DF</option>
				<option value="Jardim Botânico - DF">Jardim Botânico - DF</option>
				<option value="Itapoã - DF">Itapoã - DF</option>
				<option value="SIA - DF">SIA - DF</option>
				<option value="Vicente Pires - DF">Vicente Pires - DF</option>
				<option value="Fercal - DF">Fercal - DF</option>
				<option value="Sol Nascente/Pôr do Sol - DF">Sol Nascente/Pôr do Sol - DF</option>
				<option value="Arniqueira - DF">Arniqueira - DF</option>

			</select>

			<input class="btn" type="submit" name="" value="Registrar">

			<div class="options-02">
				<p> <a href="#">Voltar</a></p>
			</div>
		</form>
		<!--signup form end-->
	</div>
	<!--form area end-->

	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

	<script src="/res/user/js/functions.js"></script>

	<script type="text/javascript">
		$('.options-02 a').click(function () {
			$('form').animate({
				height: "toggle", opacity: "toggle"
			}, "slow");
		});
	</script>

</body>

</html>