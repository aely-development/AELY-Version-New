<?php

    // CRIAÇÃO DO BOTÃO "Atualizar"

    // CONEXÃO COM O BANCO DE DADOS
    require_once 'config/config.php';
    // Verificação
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Descrição do Jogo</title>

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
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

		.input-group{
            display: inline;
            flex-direction: row;
		}

    </style>
</head>
<body>
  
<header>

  <?php 
    include 'components/navbar.php';
  ?>

</header>

<!-- content -->
<?php foreach($consulta as $linha){?>
<section class="py-5"s>
  <div class="container">
    <div class="row gx-5">
      <aside class="col-lg-6">
        <div class="border rounded-4 mb-3 d-flex justify-content-center">
            <img style="width:100%; height:100%" src="<?php echo $linha['img_jogo']; ?>" />
          </a>
        </div>
        <!-- thumbs-wrap.// -->
        <!-- gallery-wrap .end// -->
      </aside>
      <main class="col-lg-6">
        <div class="ps-lg-3">
          <h1 class="title text-dark">
            <?php echo $linha['nm_jogo']; ?>
          </h1>


          <div class="mb-3">
            <span class="h3">R$<?php echo $linha['vl_jogo']; ?></span>
          </div>

          <hr />

          <div class="row mb-4">
            <div class="col-md-4 col-6">
              <label class="mb-2">Para</label>
              <select class="form-select border border-secondary" style="height: 35px;">
                <option>Steam</option>
                <option>Epic Games</option>
              </select>
            </div>
            <!-- col.// -->
          </div>
          <a href="functions/addCarrinho.php?id=<?php echo $linha['cd_jogo'];?>" class="btn btn-primary shadow-0"> <i class="me-1 fa fa-shopping-basket"></i> Carrinho </a>
          <a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa fa-heart fa-lg"></i> Lista de Favoritos</a>
        </div>
      </main>
    </div>
  </div>
</section>
<!-- content -->

<section class="bg-light border-top py-4">

  <div class="container">
        <div class="border rounded-2 px-3 py-2 bg-white">

          <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item d-flex" role="presentation">
              <h3 class="nav-link d-flex align-items-center justify-content-center w-100 active" id="ex1-tab-1" data-mdb-toggle="pill" href="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1" aria-selected="true">Detalhes do jogo</h3>
            </li>
          </ul>

            <p>
              <?php echo $linha['ds_jogo']; ?>
            </p>
              
            <div class="row">
              <dt class="col-2">Categoria:</dt>
              <dd class="col-9"><?php echo $linha['nm_genero']; ?></dd>
              <dt class="col-2">Desenvolvedora:</dt>
              <dd class="col-9"><?php echo $linha['nm_desenvolvedora']; ?></dd>
            </div>

          </div>
        </div>

      <?php } ?>
</section>



    <!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>

