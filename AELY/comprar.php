<?php

    require_once 'config/config.php';

    if(empty($_SESSION['carrinho'])||($_SESSION['vl_total']==0)){
        header("Location: carrinho.php");
      }
     $carrinho = array_filter($_SESSION['carrinho']);
     $vl_total = $_SESSION['vl_total'];
     $usuario = $_SESSION['cduser'];
     $codigo = rand(100000,999999);
     $sql = "INSERT INTO pedido (cd_pedido, dt_pedido, vl_pedido, cd_usuario) VALUES (:codigo, now(), :vltotal,:usuario)";
     $sql = $pdo->prepare($sql);
     $sql->bindParam('codigo', $codigo);
     $sql->bindParam('vltotal', $vl_total);
     $sql->bindParam('usuario', $usuario);        
     $sql->execute();
    
    header("Location: lista-pedido.php");
?>


