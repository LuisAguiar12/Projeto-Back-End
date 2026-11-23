<?php
    session_start();
    if(!isset($_SESSION["usuario_id"])){
        header("Location: /login.php");
        exit;
    }else{
        if($_SESSION["tipo_usuário"] === "Cliente"){
            header("Location /home.php");
        }else{
            header("Location /index.php");
        }
    }
?>