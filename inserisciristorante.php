<?php
session_start();
include("connessione/connessione.php");

$nome = $_POST['nome'];
$indirizzo = $_POST['indirizzo'];
$citta = $_POST['citta'];

$selectRistoranti = "SELECT COUNT(codiceRistorante) AS n_codici FROM ristorante";
$result1 = $conn->query($selectRistoranti);

if (!$result1) {
    $codiceRistorante = "cod1";
} else {
    $row = $result1->fetch_assoc();
    $codiceRistorante = "cod" . ($row["n_codici"] + 1);
}

$insertRistorante = "INSERT INTO ristorante (codiceRistorante, nome, indirizzo, citta) VALUES ('$codiceRistorante', '$nome', '$indirizzo', '$citta')";
$result2 = $conn->query($insertRistorante);

if ($result2) {
    $_SESSION['esito_inserimento'] = "Ristorante inserito con successo";
} else {
    $_SESSION['esito_inserimento'] = "Impossibile aggiungere il ristorante";
}

header("Location: pannelloadmin.php");
exit;
?>