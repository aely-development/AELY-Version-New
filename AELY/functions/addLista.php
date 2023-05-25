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
        $_SESSION['listaDesejo'][]=$_GET['id'];
        }
        }
        header("Location: ../listaDesejo.php");
    
}else{
    header("Location: ../login.php");
}
?>