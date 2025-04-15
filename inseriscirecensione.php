<?php
    session_start();
    include ("connessione/connessione.php");
    $nomeRistorante = $_GET["ristorante"];
    $voto = $_GET["votoRec"];
    $votoIntero = intval($voto);
    $data = date("y-m-d");
    $idUtente = $conn -> query("SELECT idUtente FROM utente WHERE username = " . $_SESSION["username"] . ";");
    $codRistorante = $conn -> query("SELECT codRistorante FROM ristorante WHERE nome = $nomeRistorante;");
    $insertRecensione = "INSERT INTO recensione(voto, data, idUtente, codiceRistorante) VALUES ($votoIntero, '$data', '$idUtente', '$codRistorante')";
    if (!($result = $conn -> query($insertRecensione))) {
        $_SESSION["errore"] = "erroreInserimentoRecensione";
    } else {
        $_SESSION["esitoInsertRecensione"] = true;
    }
    header("location: benvenuto.php");
    exit;
?>