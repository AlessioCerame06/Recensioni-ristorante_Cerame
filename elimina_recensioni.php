<?php
session_start();
include("connessione/connessione.php");

if (!isset($_POST["recensioni"]) || empty($_POST["recensioni"])) {
    $_SESSION["esitoCheckbox"] = "nessunaCheckboxSelezionata";
    header("Location: benvenuto.php");
    exit;
}

$listaCheckbox = $_POST["recensioni"];
$cont = 0;


foreach ($listaCheckbox as $idRecensione) {
    $deleteRecensione = "DELETE FROM recensione WHERE idRecensione = $idRecensione";
    $result = $conn -> query($deleteRecensione);
    $cont ++;
}

$_SESSION["esitoCheckbox"] = "eliminazioneEffetuata";
$_SESSION["nCheckbox"] = $cont;
header("Location: benvenuto.php");
exit;
?>
