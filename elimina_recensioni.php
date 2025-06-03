<?php
session_start();
include("connessione/connessione.php");

if (!isset($_GET["recensioni"])) {
    $_SESSION["esitoCheckbox"] = "nessunaCheckboxSelezionata";
    header("Location: benvenuto.php");
    exit;
} else {
    $listaCheckbox = $_POST["recensioni"];
    $cont = 0;

    foreach($listaCheckbox as $checkbox) {
        $deleteRecensione = "DELETE FROM recensione WHERE idRecensione = '$checkbox'";
        $cont++;
    }

    $_SESSION["esitoCheckbox"] = "eliminazioneEffetuata";
    $_SESSION["nCheckbox"] = $cont;
    header("Location: benvenuto.php");
    exit;
}
?>