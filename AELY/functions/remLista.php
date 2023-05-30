<?php
    require_once '../config/config.php';
if(session_status() == PHP_SESSION_ACTIVE){
    if(!isset($_SESSION['listaDesejo'])){
        }else{
        $sql = "DELETE FROM listadesejo where cd_jogo LIKE :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        }
        header("Location: ../listaDesejo.php");
    
}
?>