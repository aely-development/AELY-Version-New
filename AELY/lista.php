<?php

    require_once 'config/config.php';
    if(session_status() == PHP_SESSION_ACTIVE){
        if($_SESSION['adm']==0){
        header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        #cad-prod{
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

    </style>
    <title>Aely Games</title>
</head>

<body>

    <?php
        require_once 'components/navbar.php'
    ?>

    <h1 id="cad-prod">Lista de jogos</h1>
        

    <form enctype="multipart/form-data" action="" method="POST" class="container">
        <div class="insert">
            <div class="container-fluid col-sm-10">
            <div class="infos">
                    <table class="table">


                <?php
                #Receber o numero da pagina
                $pagina_atual=filter_input(INPUT_GET,'pagina',
                FILTER_SANITIZE_NUMBER_INT);
                $pagina=(!empty($pagina_atual))?$pagina_atual:1;
                #numero de jogos por pagina e contador
                $row_item=8;
                $item=0;

                #Calcular o inicio da visualização
                $inicio =($row_item*$pagina)-$row_item;
                
                #conexao do banco
                $sth = $pdo->prepare("SELECT * FROM `jogo` LIMIT $inicio,$row_item");
                $sth->execute();                     
                $consulta = $sth->fetchAll(PDO::FETCH_ASSOC);

                #calculo para saber quantas paginas posso ter
                #tem que fazer outra chamada
                $sth2 = $pdo->prepare("SELECT * FROM `jogo`");
                $sth2->execute();                     
                $con = $sth2->fetchAll(PDO::FETCH_ASSOC);
                $total_paginas=ceil((count($con))/$row_item);

                    # Verificação e exibição do resultado da consulta
                    if(count($consulta)){ ?>

                    <div class="row">

                    <?php foreach($consulta as $linha){$item++; ?>

                        <div class="card" style="width: 16rem;height: auto; margin: 5px;">
                            <img src=" <?php echo $linha['img_jogo'];?>" class="card-img-top w-55" alt="Imagem do jogo">
                            <div class="card-body">
                                <h3>Codigo: <?php echo $linha['cd_jogo']; ?></h3>
                                <h3 class="card-title">Nome: <?php echo $linha['nm_jogo']; ?></h3>
                                <h3>Valor: R$<?php echo str_replace('.', ',', $linha['vl_jogo']); ?></h3>
                                <a href="atualizar.php?id=<?php echo $linha['cd_jogo'];?>" class="btn btn-block mb-4 main">Atualizar</a>
                                <?php if($linha['status_jogo']){?>
                                    <a href="functions/desativar.php?id=<?php echo $linha['cd_jogo'];?>" class="btn btn-block mb-4 cad">
                                    <i class="fa fa-ban" style="color: #583c87;"></i>    
                                    </a>
                                <?php }else{?>
                                    <a href="functions/ativar.php?id=<?php echo $linha['cd_jogo'];?>" class="btn btn-block mb-4 cad">
                                    <i class="fa fa-check" style="color: #583c87;"></i>    
                                    </a>
                                <?php } ?>
                                    <a href="functions/delete.php?id=<?php echo $linha['cd_jogo'];?>" class="btn btn-block mb-4 cad">
                                    <i class="fa fa-trash" style="color: #583c87;"></i>    
                                    </a>
                            </div>                            
                        </div>

                        <?php if($item%4==0){ ?>
                        </div>
                        <div class="row">              
                        <?php }?>
                    <?php } ?>
                    </div>
                    
                    <?php 
                        #limite de links
                        $max_links=2;
                        echo "<a href='lista.php?pagina=1'><button type='button' 
                        class='btn btn-block mb-4 cad'>Primeira</button></a>"; 
                            for($pag_ant=$pagina-$max_links; $pag_ant<=$pagina-1;$pag_ant++){
                                if($pag_ant>=1){
                                echo "<a href='lista.php?pagina=$pag_ant'><button type='button' 
                                class='btn btn-block mb-4 cad'>$pag_ant</button></a>";
                            }
                            }
                            echo "<a href='lista.php?pagina=$pagina'><button type='button' 
                                class='btn btn-block mb-4 cad'>$pagina</button></a>";
                            for($pag_dep=$pagina+1;$pag_dep<=$pagina+$max_links;$pag_dep++){
                            if($pag_dep>=1 && $pag_dep<=$total_paginas){
                            echo "<a href='lista.php?pagina=$pag_dep'><button type='button' 
                            class='btn btn-block mb-4 cad'>$pag_dep</button></a>";
                            }
                            } 

                        echo "<a href='lista.php?pagina=$total_paginas'><button type='button' 
                        class='btn btn-block mb-4 cad'>Ultima</button></a>"; 
                     ?>

                    <!-- Caso a consulta não retorne nenhum resultado -->
                    <?php }else{?>
                        <tr>
                            <td colspan="3">Nenhum jogo encontrado...</td>
                        </tr>
                        
                    <?php } ?>
                        
                    </table>

                </div>    
                
                    <a href="menuAdm.php"><button type="button" class="btn btn-block mb-4 cad">Voltar</button></a>
                </div>
                
            </div>
        </div>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>