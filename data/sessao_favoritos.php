<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$idsFavoritos = [];
if (isset($_SESSION["ids_favoritos"]) && is_array($_SESSION["ids_favoritos"])) {
    foreach ($_SESSION["ids_favoritos"] as $idFavorito) {
        $idValidado = filter_var($idFavorito, FILTER_VALIDATE_INT);
        if ($idValidado !== false && $idValidado > 0) {
            $idsFavoritos[] = $idValidado;
        }
    }
}

$idsFavoritos = array_values(array_unique($idsFavoritos));
$_SESSION["ids_favoritos"] = $idsFavoritos;

if (!isset($_SESSION["token_favoritos"]) || !is_string($_SESSION["token_favoritos"])) {
    $_SESSION["token_favoritos"] = bin2hex(random_bytes(32));
}
$tokenFavoritos = $_SESSION["token_favoritos"];
