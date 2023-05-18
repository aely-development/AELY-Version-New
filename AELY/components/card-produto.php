<?php

    require_once 'config/config.php';

?>
<div class="container">
<form enctype="multipart/form-data" action="" method="POST">
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
                    $sth = $pdo->prepare("SELECT * FROM `jogo` WHERE status_jogo = true LIMIT $inicio,$row_item");
                    $sth->execute();                     
                    $consulta = $sth->fetchAll(PDO::FETCH_ASSOC);

                    #calculo para saber quantas paginas posso ter
                    #tem que fazer outra chamada
                    $sth2 = $pdo->prepare("SELECT * FROM `jogo` WHERE status_jogo = true");
                    $sth2->execute();                     
                    $con = $sth2->fetchAll(PDO::FETCH_ASSOC);
                    $total_paginas=ceil((count($con))/$row_item);

# Verificação e exibição do resultado da consulta
                    if(count($consulta)){ ?>

                    <div class="row" style="width: 1400px;margin-left: -7%;">

                    <?php foreach($consulta as $linha){$item++; ?>

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
                        <div class="row" style="width: 1400px;margin-left: -7%;">              
                        <?php }?>
                    <?php } ?>
                    </div>
                    <div style="width: 200px;margin-left: auto;margin-right: auto;display: flex;">
                    <?php 
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
                     ?>
                    </div>
                    <?php }else{?>
                        <tr>
                            <td colspan="3">Nenhum jogo encontrado...</td>
                        </tr>
                        
                    <?php } ?>
                        
                    </table>
                
            </div>
        </div>
    </form>
</div>