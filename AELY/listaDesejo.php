<?php

    // CRIAÇÃO DO BOTÃO "Atualizar"

    // CONEXÃO COM O BANCO DE DADOS
    require_once 'config/config.php';

        $sth = $pdo->prepare("SELECT * FROM `jogo`");
        $sth->execute();
        $consulta = $sth->fetchAll(PDO::FETCH_ASSOC);
    
        $vl_total=0;
        if(!empty($_SESSION['listaDesejo'])){
          $carrinho = $_SESSION['listaDesejo'];
        }

        if(session_status() == PHP_SESSION_ACTIVE && (!empty($_SESSION['emailUser']))){

        }else{
          header("Location:login.php");
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
</head>

<body>
  
<header>  
  <?php 
    include 'components/navbar.php';
  ?>

</header>

<form method="post" action="comprar.php" >
<section class="h-100" style="background-color: #eee;">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Lista de Desejos</h3>
        </div>

       <!-- Fazer um loop para todos os itens no carrinho -->
 <?php if(isset($_SESSION['listaDesejo'])){
        foreach($consulta as $linha){ 
        foreach($_SESSION['listaDesejo'] as $listaDesejo){
              if($linha['cd_jogo']==$listaDesejo){
                $vl_total += $linha['vl_jogo'];?>

                <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-2 col-lg-2 col-xl-2">
                <img
                  src="<?php echo $linha['img_jogo'];?>"
                  class="img-fluid rounded-3" alt="Cotton T-shirt">
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2"><?php echo $linha['nm_jogo']?></p>
              </div>
              
              <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                <h5 class="mb-0">R$<?php echo str_replace('.', ',', $linha['vl_jogo']);?></h5>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a href="functions/remLista.php?id=<?php echo $linha['cd_jogo'];?>" class="text-danger"><i class="fa fa-trash fa-lg"></i></a>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                <a href="functions/addCarrinho.php?id=<?php echo $linha['cd_jogo'];?>" class="text-danger"><i class="fa fa-shopping-cart fa-lg" style="color: #583c87;"></i></a>
              </div>
            </div>
          </div>
        </div>
                <?php }} ?>
        <?php }}else{ ?>
        <div class="card rounded-3 mb-4">
          <h3 class="fw-normal mb-0 text-black">Nenhum jogo adicionado na <b>Lista de Desejos</b></h3>
        </div>
        <?php }?>


    
      </div>
    </div>
  </div>
</section>
</form>
<?php
        include 'components/footer.php';
?>

</body>
</html>