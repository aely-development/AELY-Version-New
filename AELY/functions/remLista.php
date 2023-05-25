<?php
    require_once '../config/config.php';
if(session_status() == PHP_SESSION_ACTIVE){
    $existe=false;
    if(!isset($_SESSION['listaDesejo'])){
        }else{
        $item=0;
        foreach($_SESSION['listaDesejo'] as $var){
        if($var==$_GET['id']){
        $_SESSION['listaDesejo'][$item]=null;
        }
        $item++;}
        }
        header("Location: ../listaDesejo.php");
    
}
?>