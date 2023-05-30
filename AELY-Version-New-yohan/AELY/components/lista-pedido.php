<?php 
    $usuario = $_SESSION['cduser'];
    $sth = $pdo->prepare("SELECT * FROM `pedido` WHERE cd_usuario = $usuario");
    $sth->execute();                     
    $consulta = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-black">Carrinho</h3>
        </div>
<?php foreach($consulta as $linha){
?>

        
    <div class="card rounded-3 mb-4">
        <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2"><?php echo $linha['cd_pedido']?></p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2"><?php echo $linha['dt_pedido']?></p>
              </div>
              <div class="col-md-3 col-lg-3 col-xl-3">
                <p class="lead fw-normal mb-2">R$<?php echo str_replace('.', ',', $linha['vl_pedido']);?></p>
              </div>
            </div>
        </div>
    </div>
    
<?php } ?>


