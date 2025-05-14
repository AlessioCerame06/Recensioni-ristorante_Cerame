<?php
session_start();
include("connessione/connessione.php");

$nome = $_POST['nome'];
$indirizzo = $_POST['indirizzo'];
$citta = $_POST['citta'];

$insertRistorante = "INSERT INTO ristoranti (nome, indirizzo, citta) VALUES ($nome, $indirizzo, $citta)";

if ($result = $conn -> query($insertRistorante)) {
    $_SESSION['esito_inserimento'] = "Ristorante inserito con successo";
} else {
    $_SESSION['esito_inserimento'] = "Impossibile aggiungere il ristorante";
}

header("Location: pannelloadmin.php");
exit;
?>