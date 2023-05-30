<?php
    require_once '../config/config.php';
    include '../configUsuarioClass.php';
    unset($_SESSION['adm']);
    session_destroy();
    header("Location: ../index.php");
?>


