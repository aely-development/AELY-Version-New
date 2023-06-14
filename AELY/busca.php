<?php

    require_once 'config/config.php';
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
    <link rel="stylesheet" href="components/css/navbar.css">
    <title>AELY GAMES</title>
</head>
<body>
    <?php
        require_once 'components/navbar.php';
    ?>
    
    <form enctype="multipart/form-data" action="" method="POST">
        <div class="insert">
            <div class="container-fluid col-sm-10">
            <div class="infos">
                    <table class="table">

                <?php             

                    $busca=$_POST['busca'];
                    #Receber o numero da pagina
                    $pagina_atual=filter_input(INPUT_GET,'pagina',
                    FILTER_SANITIZE_NUMBER_INT);
                    $pagina=(!empty($pagina_atual))?$pagina_atual:1;
                    #numero de jogos por pagina e contador
                    $row_item=8;
                    $item=0;
                    #Calcular o inicio da visualização
                    $inicio =($row_item*$pagina)-$row_item;

                    if(!empty($busca)){
                    #conexao do banco
                    $sth = $pdo->prepare("SELECT * FROM `jogo`
                    WHERE nm_jogo LIKE '%$busca%' AND status_jogo = true LIMIT $inicio,$row_item");
                    $sth->execute();                     
                    $consulta = $sth->fetchAll(PDO::FETCH_ASSOC);

                    #calculo para saber quantas paginas posso ter
                    #tem que fazer outra chamada
                    $sth2 = $pdo->prepare("SELECT * FROM `jogo`");
                    $sth2->execute();                     
                    $con = $sth2->fetchAll(PDO::FETCH_ASSOC);
                    $total_paginas=ceil((count($con))/$row_item);

# Verificação e exibição do resultado da consulta
                    if(count($consulta)){ 

                    echo '<div class="row"><h3>Resultados por "'.$busca.'"<h3/></div>';?>
                    <div class="row">
                    <?php foreach($consulta as $linha){$item++; ?>
                        <div class="card" style="width: 270px; margin: 5px">
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
                    <?php }?>
                    </div>
                    <div>
                    <?php 
                       if($total_paginas>2){
                         #limite de links
                         $max_links=2;
                         echo "<a href='index.php?pagina=1'><button type='button' 
                         class='btn btn-block mb-4 cad'>Primeira</button></a>"; 
                             for($pag_ant=$pagina-$max_links; $pag_ant<=$pagina-1;$pag_ant++){
                                 if($pag_ant>=1){
                                 echo "<a href='index.php?pagina=$pag_ant'><button type='button' 
                                 class='btn btn-block mb-4 cad'>$pag_ant</button></a>";
                             }
                             }
                             echo "<a href='index.php?pagina=$pagina'><button type='button' 
                                 class='btn btn-block mb-4 cad'>$pagina</button></a>";
                             for($pag_dep=$pagina+1;$pag_dep<=$pagina+$max_links;$pag_dep++){
                             if($pag_dep>=1 && $pag_dep<=$total_paginas){
                             echo "<a href='index.php?pagina=$pag_dep'><button type='button' 
                             class='btn btn-block mb-4 cad'>$pag_dep</button></a>";
                             }
                             } 
 
                         echo "<a href='index.php?pagina=$total_paginas'><button type='button' 
                         class='btn btn-block mb-4 cad'>Ultima</button></a>"; 
                       }
                     ?>
                     </div>
                    <?php }}else{?>
                        <tr>
                            <td colspan="3">Nenhum jogo encontrado...</td>
                        </tr>
                        
                    <?php } ?>
                        
                    </table>
                
            </div>
        </div>
    </form>

    <?php
        include 'components/footer.php';
    
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>