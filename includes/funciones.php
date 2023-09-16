<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Revisar que el usuario este Autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])){
        header("Location: /");
    }
}