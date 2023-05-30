<?php

    # Nesse início do código, eu realizo a conexão com o banco de dados,
    # iniciando coneção com o arquivo 'config.php', e usando uma variável
    # para conexão PDO.

    require_once 'config/config.php';
    
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CONFIG. DE ESTILO DA PÁGINA-->
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
    <title>AELY Games</title>
</head>

<body>

    <?php
        require_once 'components/navbar.php';
    ?>

    <h1 id="cons-prod">Menu ADM</h1>

<!-- INÍCIO DO FORMULÁRIO DE ENVIO -->
    <form action="" method="POST">
        <div class="insert">
            <div class="container-fluid col-sm-6">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" placeholder="Digite o nome..." required>
                </div>
                <div class="col-auto">
                    <input type="submit" name="submit" class="btn btn-block mb-4 main">
                    <a href="cadJogo.php"><input type="button" value="Cadastrar" class="btn btn-block mb-4 cad"></a>
                    <a href="lista.php"><input type="button" value="Lista de jogos" class="btn btn-block mb-4 cad"></a>
                </div>
                
                <div class="infos">
                    <table class="table">

<!-- INSERÇÃO DE CÓDIGO PHP DENTRO DO HTML -->
                <?php

                if (!isset($_POST['nome'])) {
                    
                }else{
# Preparação para realizar a consulta feita por código SQL, no php.

                    $codigo = trim($_POST['nome'])."%";
                    $sth = $pdo->prepare("SELECT * FROM `jogo` WHERE `nm_jogo` LIKE :nome");
                    $sth->bindParam(':nome', $codigo, PDO::PARAM_STR);
                    $sth->execute();

                    $consulta = $sth->fetchAll(PDO::FETCH_ASSOC);

# Verificação e exibição do resultado da consulta
                    if(count($consulta)){ ?>

                    <?php foreach($consulta as $linha){?>

                        <div class="card" style="width: 18rem;">
                            <img src=" <?php echo $linha['img_jogo'];?>" class="card-title" alt="Imagem do jogo">
                            <div class="card-body">
                                <h3 class="card-title">Nome: <?php echo $linha['nm_jogo']; ?></h4>
                                <h3 class="card-title">Valor: <?php echo str_replace('.', ',', $linha['vl_jogo']); ?></h4>
                                <h3 class="card-title">Código: <?php echo $linha['cd_jogo']; ?></h4>
                                <a href="atualizar.php?id=<?php echo $linha['cd_jogo'];?>" class="btn btn-block mb-4 main">Atualizar</a>
                                <a href="functions/desativar.php?id=<?php echo $linha['cd_jogo'];?>" class="btn btn-block mb-4 cad">
                                    <i class="fa fa-ban" style="color: #583c87;"></i>
                                </a>
                                <a href="functions/delete.php?id=<?php echo $linha['cd_jogo'];?>" class="btn btn-block mb-4 cad">
                                    <i class="fa fa-trash" style="color: #583c87;"></i>    
                                    </a>
                            </div>
                            
                        </div>

<!-- Caso a consulta não retorne nenhum resultado -->
                    <?php }}else{?>

                        <tr>
                            <td colspan="3">Nenhum resultado encontrado...</td>
                        </tr>
                        
                    <?php } }?>
                        
                    </table>

                </div>        
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>