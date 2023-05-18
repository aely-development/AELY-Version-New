<?php

	// PÁGINA DE LOGIN DE USUÁRIO
	
	require_once 'config/config.php';

?>

<!-- CÓDIGO HTML -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap');

        body {
            font-family: montserrat, sans-serif;
            font-size: 20px;
        }

        .insert {
            margin-top: 150px;
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

		.btn.btn-block.mb-4.cad{
			border: 2px solid #583c87;
            color: #583c87;
		}

		.btn:hover {
  			color: #583c87;
  			cursor: pointer;
		}

        .img{
            height: 160px;
        }
    </style>
	
	<title>Login</title>
</head>

<body>
<!-- NAVBAR DO SISTEMA -->
	<?php
        include('components/navbar.php');
    ?>

	<!-- INÍCIO DO FORMULÁRIO DE ENVIO -->
	<div class="contatiner">

	<form action="functions/logar.php" method="POST">
		<div class="insert">
			<div class="container-fluid col-sm-4">
		<div class="card">
			<div class="card-body">
			

			<h1 id="cons-prod">Login</h1>

				<!-- Email -->
				<div class="form-outline mb-4">
					<label class="form-label" for="form2Example1">Email</label>
					<input type="email" id="form2Example1" name="email" class="form-control" placeholder="exemplo@exemplo.com" required>
				    
				</div>

				<!-- Senha -->
				<div class="form-outline mb-4">
					<label class="form-label" for="form2Example2">Senha</label>
					<input type="password" id="form2Example2" name="senha" class="form-control" required>
					<?php if(isset($_SESSION['error'])){ ?>
					<?php if($_SESSION['error']){ ?>
					<div><p style='color: red;'>Senha ou usuario incorreta!</p></div>
					<?php }}?>
				</div>

				<!-- Botão Submit -->
				<button type="submit" class="btn btn-block mb-4 main">Login</button>
				<a href="cadUsuario.php"><button type="button" class="btn btn-block mb-4 cad">Cadastrar-se</button></a>
				<?php if(isset($_SESSION['error'])){ ?>
				<?php if($_SESSION['error']){ ?>
                <a href="cadUsuario.php?sol=true"><button type="button" class="btn btn-block mb-4 cad">Esqueceu a senha?</button></a>
				<?php }$_SESSION['error']=false;}?>
				</div>
			</div>
	</form>

	</div>
</body>

</html>