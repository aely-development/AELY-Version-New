<?php

    require_once 'config/config.php';
    
    #consulta para buscar os registros de generos distintos do banco de dados
    $sth = $pdo->prepare("SELECT COUNT(*), `nm_genero` 
    FROM `jogo` GROUP BY `nm_genero` ORDER BY `nm_genero`");
    $sth->execute();
    $genero = $sth->fetchAll(PDO::FETCH_ASSOC);
    if(isset($_GET['genero'])){
    $op=$_GET['genero'];
    }

    if(isset($_POST['genero'])){
    $op = $_POST['genero'];                                                                
    foreach($genero as $linha){        
     if($op==$linha['nm_genero']){
    $aux=$linha['nm_genero'];
    $sth = $pdo->prepare("SELECT * FROM `jogo` WHERE nm_genero LIKE '$aux'");
    $sth->execute();
    $consulta = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    }
    }else{
    if(isset($op)){                                                            
    foreach($genero as $linha){        
    if($op==$linha['nm_genero']){
    $aux=$linha['nm_genero'];
    $sth = $pdo->prepare("SELECT * FROM `jogo` WHERE nm_genero LIKE '$aux'");
    $sth->execute();
    $consulta = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    }
    }   
    }
                
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AELY GAMES</title>

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
    <link rel="stylesheet" href="components/css/card-produto.css">
</head>
<body>
    <?php
        include 'components/navbar.php';
    ?>

<div class="insert">
    <div class="container-fluid col-sm-6">

        <h3 class="card-title"><?php echo $op; ?></h3>
        <div class="infos">
            <table class="table">                     

<form enctype="multipart/form-data" action="" method="POST">
        <div class="insert">
            <div class="container-fluid col-sm-10">
            <div class="infos">
                    <table class="table">

                <?php
                  $item=0;
# Verificação e exibição do resultado da consulta
                    if(isset($consulta)&&count($consulta)){ ?>

                    <div class="row" style="width: 1200px;">

                    <?php foreach($consulta as $linha){$item++?>

                        <div class="card" style="width: 270px; height: auto; margin: 5px">
                            <img src=" <?php echo $linha['img_jogo'];?>" class="card-title" style="margin-top: 5px" alt="Imagem do jogo">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $linha['nm_jogo']; ?></h3>
                                <h3>R$ <?php echo str_replace('.', ',', $linha['vl_jogo']); ?></h3>
                                <a href="descJogo.php?id=<?php echo $linha['cd_jogo'];?>" class="btn btn-block mb-4 main">Ver mais</a>
                            </div>                            
                        </div>

                        <?php if($item%4==0){ ?>

                        </div>
                        <div class="row">              
                        <?php }?>
                    <?php } ?>
                    </div>
                    <?php }else{?>
                        <tr>
                            <td colspan="3">Escolha um genero...</td>
                        </tr>
                        
                    <?php } ?>
                        
                    </table>
                
            </div>
        </div>
    </form>
                    </table>

                </div>
    
            </div>
        </div>
        <?php
                include 'components/footer.php';
        ?>
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>