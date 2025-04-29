<?php
    session_start();
    include ("connessione/connessione.php");
    $nomeRistorante = $_GET["ristorante"];
    $voto = $_GET["votoRec"];
    $votoIntero = intval($voto);
    $data = date("y-m-d");
    $us = $_SESSION["username"];
    $idUtente = $conn -> query("SELECT idUtente FROM utente WHERE username = '$us'");
    $codRistorante = $conn -> query("SELECT codiceRistorante FROM ristorante WHERE nome = '$nomeRistorante'");
    $id = $idUtente->fetch_assoc()["idUtente"];
    $cod = $codRistorante->fetch_assoc()["codiceRistorante"];
    $insertRecensione = "INSERT INTO recensione(voto, data, idUtente, codiceRistorante) VALUES ($votoIntero, '$data', '$id', '$cod')";
    if (!($result = $conn -> query($insertRecensione))) {
        $_SESSION["errore"] = "erroreInserimentoRecensione";
    } else {
        $_SESSION["esitoInsertRecensione"] = true;
    }
    header("location: benvenuto.php");
    exit;
?>