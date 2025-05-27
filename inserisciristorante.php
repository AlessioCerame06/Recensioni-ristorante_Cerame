<?php
session_start();
include("connessione/connessione.php");

$nome = $_POST["nome"];
$indirizzo = $_POST["indirizzo"];
$citta = $_POST["citta"];
$latitudine = $_POST["latitudine"];
$longitudine = $_POST["longitudine"];


$selectRistoranti = "SELECT COUNT(codiceRistorante) AS n_codici FROM ristorante";
$result1 = $conn->query($selectRistoranti);

if (!$result1) {
    $codiceRistorante = "ris1";
} else {
    $row = $result1->fetch_assoc();
    if (($row["n_codici"] + 1) < 10 ) {
        $codiceRistorante = "ris0" . ($row["n_codici"] + 1);
    } else {
        $codiceRistorante = "ris" . ($row["n_codici"] + 1);
    }
}

$insertRistorante = "INSERT INTO ristorante (codiceRistorante, nome, indirizzo, citta, latitudine, longitudine) 
                    VALUES ('$codiceRistorante', '$nome', '$indirizzo', '$citta', $latitudine, $longitudine)";
$result2 = $conn->query($insertRistorante);

if ($result2) {
    $_SESSION['esito_inserimento'] = "Ristorante inserito con successo";
} else {
    $_SESSION['esito_inserimento'] = "Impossibile aggiungere il ristorante";
}

header("Location: pannelloadmin.php");
exit;
?>