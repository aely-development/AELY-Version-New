<?php

	// PÁGINA DE CADASTRO DE USUÁRIO

	require_once 'config/config.php';
	require_once 'config/UsuarioClass.php';

	$sol=filter_input(INPUT_GET,'sol',
	FILTER_VALIDATE_BOOLEAN);
	if(empty($sol)){
	$trocaSenha=false;
	}else{
	$trocaSenha=$sol;
	}
?>

<!-- CÓDIGO HTML -->

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link rel="icon" type="image/x-icon" href="icon.png">
	<!-- CONFIG. DE ESTILO DA PÁGINA-->
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap');

		body {
			font-family: montserrat, sans-serif;
			background-color: #959697;
		}

		.insert {
			margin-top: 40px;
			display: flex;
			flex-direction: row;
			align-items: center;
		}

		#cad-button{
			color: #0d6efd;
		}

		#cons-prod{
			padding: 5vh;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.btn.btn-block.mb-4.main{
			background-color: #583c87;
			color: white;
		}

		.btn:hover {
  			color: #583c87;
  			cursor: pointer
		}
		
	</style>
	<title>Cadastro</title>
</head>

<body>

<?php
        include('components/navbar.php');
    ?>

	

	<!-- INÍCIO DO FORMULÁRIO DE ENVIO -->
	<form action="" method="POST">
		<div class="insert">
			<div class="container-fluid col-sm-6">
		<div class="card">
			<div class="card-body">

			<h1 id="cons-prod">Cadastro</h1>

            <?php if($trocaSenha){ ?>
				<?php if(!isset($_POST['nome']) && !isset($_POST['email']) && !isset($_POST['senha'])&&!isset($_POST['csenha'])){}
			else{
				$email = $_POST['email'];
				$senha = md5($_POST['senha']);
				$csenha = md5($_POST['csenha']);
				$user = new Usuario();
			if($user->registrado($email))
			{
				if($senha!==$csenha){
					echo "<p style='color: red;'>Os campos 'senha' e 'confirmar senha' devem ser os mesmos.</p>";	
					}
				else{
					
					$sql = "UPDATE usuario 
					SET senha_usuario=:senha WHERE email_usuario = :email";
					$sql = $pdo->prepare($sql);
					$sql->bindParam('senha', $senha);
					$sql->bindParam('email', $email);
					$sql->execute();
					echo "<p style='color: green;'>Senha trocada com sucesso!</p>";
				}
			}	
			}?>
				<!-- Email input -->
				<div class="form-outline mb-4">
					<label class="form-label" for="form2Example1">Email</label>
					<input type="email" id="form2Example1" name="email" class="form-control" placeholder="exemplo@exemplo.com" required>
					<div class="col-auto">
			<?php }?>
			
			<?php 	if(!$trocaSenha){ 
		if(!isset($_POST['nome']) && !isset($_POST['email']) && !isset($_POST['senha'])&&!isset($_POST['csenha'])){}
		else{
			$email = $_POST['email'];
			$senha = md5($_POST['senha']);
			$csenha = md5($_POST['csenha']);
	        
			$user = new Usuario();
			if($user->registrado($email))
			{
			echo "<p style='color: red;'>Erro email já registrado!</p>";
			}
			else{
				if($senha!==$csenha){
					echo "<p style='color: red;'>Os campos 'senha' e 'confirmar senha' devem ser os mesmos.</p>";	
					}
				else{
	
					$nome = $_POST['nome'];
					$adm=0;
												
					$sql = "INSERT INTO usuario (nm_usuario, email_usuario, senha_usuario, usuario_adm) VALUES (:nome, :email, :senha,:adm)";
					$sql = $pdo->prepare($sql);
					$sql->bindParam('nome', $nome);
					$sql->bindParam('email', $email);
					$sql->bindParam('senha', $senha);
					$sql->bindParam('adm', $adm);
					$sql->execute();
					echo "<p style='color:green'>email cadastrado!</p>";
				}
			}
		}	
	}?>	

                <?php 	if(!$trocaSenha){?>
				<!-- Nome input -->
				<div class="form-outline mb-4">
					<label class="form-label" for="form2Example2">Nome</label>
					<input type="text" id="form2Example2" name="nome" class="form-control" placeholder="Digite seu nome completo"  required>
				</div>
                
				<!-- Email input -->
				<div class="form-outline mb-4">
					<label class="form-label" for="form2Example1">Email</label>
					<input type="email" id="form2Example1" name="email" class="form-control" placeholder="exemplo@exemplo.com" required>
					<div class="col-auto">
				</div>
				</div>
				<?php }?>				

				<!-- Senha input -->
				<div class="form-outline mb-4">
					<label class="form-label" for="form2Example2">Senha</label>
					<input type="password" id="form2Example2" name="senha" class="form-control" placeholder="Digite sua senha" required>
				</div>

				<!-- CONFIRMAR Senha input -->
				<div class="form-outline mb-4">
					<label class="form-label" for="form2Example2">Confirmar senha</label>
					<input type="password" id="form2Example2" name="csenha" class="form-control" placeholder="Digite novamente sua senha"  required>
				</div>

				<!-- Submit button -->
				<button type="submit" class="btn btn-block mb-4 main">Cadastrar</button>
                <a href="login.php"><button type="button" class="btn btn-block mb-4">Voltar</button></a>				
				</div>

			</div>
	</form>

	<?php
        include 'components/footer.php';
	?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
