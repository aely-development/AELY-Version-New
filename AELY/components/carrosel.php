<?php

    require_once 'config/config.php';
    
    $sth = $pdo->prepare("SELECT * FROM `jogo` WHERE status_jogo = true LIMIT 0,3");
    $sth->execute();                     
    $consulta = $sth->fetchAll(PDO::FETCH_ASSOC);    
    $item=0;           
?>
    
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

    <?php foreach($consulta as $linha){ ?>
      <?php if($item==0){?>
        <div class="item active">
      <a href="descJogo.php?id=<?php echo $linha['cd_jogo'];?>">
      <img src="<?php echo $linha['img_jogo'];?>" alt="<?php echo $linha['cd_jogo'];?>" style="width: 100%;">
      </a>
      </div>
      <?php }else{?>
        <div class="item">
      <a href="descJogo.php?id=<?php echo $linha['cd_jogo'];?>">
      <img src="https://pbs.twimg.com/media/DmdCa-BX0AEcuU6.jpg" alt="<?php echo $linha['cd_jogo'];?>" style="width: 100%;">
      </a>
      </div>
      <?php }$item++?>
      <?php }?>
    
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
