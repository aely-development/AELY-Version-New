<?php
        require_once '../config/config.php';
    if(session_status() == PHP_SESSION_ACTIVE){
        $existe=false;
        if(!isset($_SESSION['carrinho'])){
            $_SESSION['carrinho']=array($_GET['id']);
            }else{
            foreach($_SESSION['carrinho'] as $linha){
            if($linha['cd_jogo']==$_GET['id']){
            $existe=true;
            }
            }
            if(!$existe){
            $sql = "INSERT INTO carrinho (cd_jogo, cd_usuario) 
            VALUES (:codjogo,:cd_usuario)";
            $sql = $pdo->prepare($sql);
            $sql->bindParam('codjogo', $_GET['id']);
            $sql->bindParam('cd_usuario', $_SESSION['cduser']);
            $sql->execute();
            }
            }
            header("Location: ../carrinho.php");
        
    }else{
        header("Location: ../login.php");
    }
?>