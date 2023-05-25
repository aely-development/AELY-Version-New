<?php

    require_once 'config/config.php';
    if(empty($_SESSION['carrinho'])||($_SESSION['vl_total']==0)){
        header("Location: carrinho.php");
      }
    $carrinho = array_filter($_SESSION['carrinho']);
    $vl_total = $_SESSION['vl_total'];
    $usuario = $_SESSION['cduser'];
    $codigo = rand(100000,999999);
    $sql = "INSERT INTO pedido (cd_pedido, dt_pedido, vl_pedido, cd_usuario) VALUES (:codigo, now(), :vltotal,:usuario)";
    $sql = $pdo->prepare($sql);
    $sql->bindParam('codigo', $codigo);
    $sql->bindParam('vltotal', $vl_total);
    $sql->bindParam('usuario', $usuario);
            
    $sql->execute();
    
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap');

        body {
            font-family: montserrat, sans-serif;
            font-size: 20px;
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
    <title>AELY GAMES</title>
</head>
<body>
    <?php
        include 'components/navbar.php';
    ?>

<div class="container" style="align-items: center;">

    <?php
        include 'components/lista-pedido.php';
    ?>
</div>
    
</body>
</html>