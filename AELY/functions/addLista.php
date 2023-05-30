<?php
    require_once '../config/config.php';
if(session_status() == PHP_SESSION_ACTIVE){
    $existe=false;
    if(!isset($_SESSION['listaDesejo'])){
        $_SESSION['listaDesejo']=array($_GET['id']);
        }else{
        foreach($_SESSION['listaDesejo'] as $var){
        if($var==$_GET['id']){
        $existe=true;
        }
        }
        if(!$existe){
            $sql = "INSERT INTO listadesejo (cd_jogo, cd_usuario) 
            VALUES (:codjogo,:cd_usuario)";
            $sql = $pdo->prepare($sql);
            $sql->bindParam('codjogo', $_GET['id']);
            $sql->bindParam('cd_usuario', $_SESSION['cduser']);
            $sql->execute();
        }
        }
        header("Location: ../listaDesejo.php");
    
}else{
    header("Location: ../login.php");
}
?>