<?php
session_start();
include("connessione/connessione.php");
$listaCheckbox = $_POST["checkbox"];
if (!(isset($listaCheckbox))) {
    $_SESSION["esitoCheckbox"] = "nessunaCheckboxSelezionata";
    header("benvenuto.php");
    exit;
} else {
    $cont = 0;
    foreach($listaCheckbox as $checkbox) {
        $deleteRecensione = "DELETE FROM recensione WHERE $checkbox";
        $result = $conn -> query($deleteRecensione);
        $cont ++;
    }
    $_SESSION["esitoCheckbox"] = "eliminazioneEffetuata";
    $_SESSION["nCheckbox"] = $cont;
    header("benvenuto.php");
    exit;
}
?>