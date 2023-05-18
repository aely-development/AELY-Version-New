<?php

    require_once 'set.php';

    global $pdo;

    try{
        $pdo = new PDO(
        "mysql:host=" . MYSQL_HOST . ";" .
        "dbname=" . MYSQL_DATABASE . "; charset=utf8",
        MYSQL_USER,
        MYSQL_PASS
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "ERRO: " . $e->getMessage();
        exit;
    }
    
?>