<?php
    require_once '../config/config.php';
if(session_status() == PHP_SESSION_ACTIVE){
    $existe=false;
    if(!isset($_SESSION['carrinho'])){
        $_SESSION['carrinho']=array($_GET['id']);
        }else{
        foreach($_SESSION['carrinho'] as $var){
        if($var==$_GET['id']){
        $existe=true;
        }
        }
        if(!$existe){
        $_SESSION['carrinho'][]=$_GET['id'];
        }
        }
        header("Location: ../carrinho.php");
    
}else{
    header("Location: ../login.php");
}
?>