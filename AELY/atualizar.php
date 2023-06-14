<?php

    // CRIAÇÃO DO BOTÃO "Atualizar"

    // CONEXÃO COM O BANCO DE DADOS
    require_once 'config/config.php';
    // Verificação e execução da função de deletar o produto
    if(isset($_GET["id"])){
        $id = $_GET['id'];

        $sth = $pdo->prepare("SELECT * FROM `jogo` WHERE `cd_jogo` LIKE :codigo");
        $sth->bindParam(':codigo', $id, PDO::PARAM_STR);
        $sth->execute();
        $consulta = $sth->fetchAll(PDO::FETCH_ASSOC);
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
    include 'components/navbar.php';

    foreach($consulta as $linha){
?>

<h1 id="cad-prod">Atualizar produto</h1>
<form enctype="multipart/form-data" action="" method="POST">
    <div class="insert">
        <div class="container-fluid col-sm-6">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" placeholder="Digite o nome do jogo" value="<?php echo $linha['nm_jogo'];?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gênero</label>
                <input type="text" name="genero" class="form-control" placeholder="Digite a marca do jogo" value="<?php echo $linha['nm_genero'];?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea type="text" name="ds" class="form-control" placeholder="Digite a marca do jogo" required><?php echo $linha['ds_jogo'];?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Data de lançamento</label>
                <input type="date" name="dtlanc" class="form-control" placeholder="Digite a marca do jogo" value="<?php echo $linha['dt_lancamento'];?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Desenvolvedora</label>
                <input type="text" name="marca" class="form-control" placeholder="Digite a marca do jogo" value="<?php echo $linha['nm_desenvolvedora'];?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Valor</label>
                <input type="decimal" name="valor" class="form-control" placeholder="Digite o valor do jogo" value="<?php echo $linha['vl_jogo'];?>" required>
            </div>
            <img src="<?php echo $linha['img_jogo'];?>" style="margin-top: 5px"></img>
            <div class="mb-3">
                
                <label class="form-label">Alterar imagem</label>
                <input type="file" name="img" class="form-control" placeholder="Envie a imagem do jogo">
                
            </div>
            <div class="col-auto">
                <input type="submit" value="Atualizar" class="btn btn-block mb-4 main">
                <?php

                    if(!isset($_POST['codigo']) && !isset($_POST['nome']) && !isset($_POST['genero']) 
                    && !isset($_POST['ds']) && !isset($_POST['dtlanc'])  && !isset($_POST['marca']) && 
                    !isset($_FILES['img']) && !isset($_POST['valor'])){
                        
                    }else{
                        
                        $codigo = $id;
                        $nome = $_POST['nome'];
                        $genero = $_POST['genero'];
                        $ds = $_POST['ds'];
                        $dtlanc = $_POST['dtlanc'];
                        $marca = $_POST['marca'];
                        $img = $_FILES['img'];
                        $v = $_POST['valor'];

                        $valor = str_replace(',', '.', str_replace('.', '', $v));

                        $pasta = "img/";
                        $nomeImg = $img['name'];
                        $novonomeImg = uniqid();
                        $extensao = strtolower(pathinfo($nomeImg, PATHINFO_EXTENSION));
                        $path = $pasta . $novonomeImg . "." . $extensao;

                        if($img['error'])
                            die("Falha ao enviar imagem!");

                        if($extensao != "jpg" && $extensao != 'png')
                            die("Escolha uma imagem .jpg ou .png");

                            $sucesso = move_uploaded_file($img["tmp_name"], $pasta . $novonomeImg . "." . $extensao);

                        global $pdo;
 
                            $sql = "UPDATE jogo 
                            SET nm_jogo=:nome, nm_desenvolvedora=:marca, img_jogo=:img, vl_jogo=:valor  
                            WHERE cd_jogo = :codigo";
                            $sql = $pdo->prepare($sql);
                            $sql->bindParam('nome', $nome);
                            $sql->bindParam('marca', $marca);
                            $sql->bindParam('img', $path);
                            $sql->bindParam('valor', $valor);
                            $sql->bindParam(':codigo', $id);
                            $sql->execute();

                            if($sql->rowCount()){
                                echo "<p style='color: green;'>Produto atualizado com sucesso!</p>";
                            }else{
                                echo "<p style='color: red;'>Erro ao atualizar produto!</p>";
                            }
                        }
                    }

                ?>
                <a href="menuAdm.php"><button type="button" class="btn btn-block mb-4 cad">Voltar</button></a>
            </div>
            
        </div>
    </div>
</form>


<?php
        include 'components/footer.php';

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>