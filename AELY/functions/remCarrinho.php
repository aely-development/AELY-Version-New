<?php
    require_once '../config/config.php';
if(session_status() == PHP_SESSION_ACTIVE){
    $existe=false;
    if(!isset($_SESSION['carrinho'])){
        }else{
        $item=0;
        foreach($_SESSION['carrinho'] as $var){
        if($var==$_GET['id']){
        $_SESSION['carrinho'][$item]=null;
        }
        $item++;}
        }
        header("Location: ../carrinho.php");
    
}
?>