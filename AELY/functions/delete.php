<?php

    // CRIAÇÃO DO BOTÃO "DELETE"
    # Neste arquivo "delete.php", temos o código que irá realizar
    # o funcionamento do botão "DELETE" no resultado da consulta.

    // CONEXÃO COM O BANCO DE DADOS
    require_once '../config/config.php';

    // Verificação e execução da função de deletar o produto
    
    if(isset($_GET["id"])){
        $id = $_GET['id'];
        $sql_code = "DELETE FROM jogo WHERE cd_jogo LIKE :id";
        $stmt = $pdo->prepare($sql_code);
        $stmt->bindParam(':id', $id);
        $delete = $stmt->execute();

        header("Location: ../lista.php");

    }


?>