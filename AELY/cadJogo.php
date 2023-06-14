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

    <h1 id="cad-prod">Cadastrar produtos</h1>
        

    <form enctype="multipart/form-data" action="" method="POST">
        <div class="insert">
            <div class="container-fluid col-sm-6">
                
                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" placeholder="Digite o nome do produto" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gênero</label>
                    <input type="text" name="genero" class="form-control" placeholder="Digite o gênero do produto" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea type="text" name="ds" class="form-control" placeholder="Digite a descrição do produto" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Data de lançamento</label>
                    <input type="date" name="dtlanc" class="form-control" placeholder="Digite a data de lançamento do produto" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Desenvolvedora</label>
                    <input type="text" name="marca" class="form-control" placeholder="Digite a marca do produto" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Valor</label>
                    <input type="decimal" name="valor" class="form-control" placeholder="Digite o valor do produto" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Imagem</label>
                    <input type="file" name="img" class="form-control" placeholder="Envie a imagem do jogo" required>
                </div>
                
                <div class="col-auto">
                    <input type="submit" value="Cadastrar" class="btn btn-block mb-4 main">
                    <?php

                        

                        if(!isset($_POST['codigo']) && !isset($_POST['nome']) && !isset($_POST['genero']) && !isset($_POST['ds']) && !isset($_POST['dtlanc']) && !isset($_FILES['img']) && !isset($_POST['marca']) && !isset($_POST['valor'])){
                            
                        }else{
                            
                            $codigo = rand(100000,999999);
                            $nome = $_POST['nome'];
                            $genero = $_POST['genero'];
                            $ds = $_POST['ds'];
                            $dtlanc = $_POST['dtlanc'];
                            $marca = $_POST['marca'];
                            $v = $_POST['valor'];
                            $img = $_FILES['img'];
                            
                            $valor = str_replace(',', '.', str_replace('.', '', $v));
                                                   
                            
                                $pasta = "img/";
                                $nomeImg = $img['name'];
                                $novonomeImg = uniqid();
                                $extensao = strtolower(pathinfo($nomeImg, PATHINFO_EXTENSION));
                                $path = $pasta . $novonomeImg . "." . $extensao;
    
                                if($img['error'])
                                    die("Falha ao enviar imagem!");
    
                                if($extensao != 'jpg' && $extensao != 'png' && $extensao != '.jpeg')
                                    die("Escolha um formato de imagem válido!");
    
                                    $sucesso = move_uploaded_file($img["tmp_name"], $pasta . $novonomeImg . "." . $extensao);
                            

                            global $pdo;
     
                                $sql = "INSERT INTO jogo (cd_jogo, nm_jogo, nm_genero, ds_jogo, dt_lancamento, nm_desenvolvedora, vl_jogo, valor_desconto, img_jogo, status_jogo) VALUES (:codigo, :nome, :genero, :ds, :dtlanc, :marca, :valor, null, :img, true)";
                                $sql = $pdo->prepare($sql);
                                $sql->bindParam('codigo', $codigo);
                                $sql->bindParam('nome', $nome);
                                $sql->bindParam('genero', $genero);
                                $sql->bindParam('ds', $ds);
                                $sql->bindParam('dtlanc', $dtlanc);
                                $sql->bindParam('marca', $marca);
                                $sql->bindParam('valor', $valor);
                                $sql->bindParam('img', $path);
                                
                                $sql->execute();

                                if($sql->rowCount()){
                                    echo "<p style='color: green;'>Produto cadastrado com sucesso!</p>";
                                }else{
                                    echo "<p style='color: red;'>Erro ao cadastrar produto!</p>";
                                }
                        }

                    ?>
                    <a href="menuAdm.php"><button type="button" class="btn btn-block mb-4 cad">Voltar</button></a>
                </div>
                
            </div>
        </div>
    </form>
    
<?PHP
        include 'components/footer.php';

?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>

