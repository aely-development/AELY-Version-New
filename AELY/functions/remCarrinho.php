<?php
    require_once '../config/config.php';
if(session_status() == PHP_SESSION_ACTIVE){
    if(!isset($_SESSION['carrinho'])){
        }else{
        $sql = "DELETE FROM carrinho where cd_jogo LIKE :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        }
        header("Location: ../carrinho.php");
    
}
?>