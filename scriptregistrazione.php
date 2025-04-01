<?php
    session_start();
    include("connessione/connessione.php");

    if ((empty($_POST["nome"])) || (empty($_POST["cognome"])) || (empty($_POST["email"])) || (empty($_POST["password"]))) {
        $_SESSION["erroreRegistrazione"] = "datiRegistrazioneNonInseriti";
        header("Location: errore_loginreg.php");
        exit;
    } else {
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $selectEmail = "SELECT email FROM utenti WHERE username = '$nome'";
    }
?>