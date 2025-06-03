<?php
session_start();
include("connessione/connessione.php");

$passInserita = $_POST["password"];
$selectPassword = "SELECT password FROM utente WHERE username = '" . $_SESSION["username"] . "'";
$result = $conn -> query($selectPassword);
$passDB = $result -> fetch_assoc();
$passInseritaHashata = hash("sha256", $passInserita);
if ($passInseritaHashata == $passDB["password"]) {
    $_SESSION["erroreCambioPassword"] = "passwordUguale";
    header("Location: benvenuto.php");
    exit;
}
$updatePassword = "UPDATE utente SET password = '$passInseritaHashata' WHERE username = '" . $_SESSION["username"] . "'";
$result = $conn -> query($updatePassword);
$_SESSION["erroreCambioPassword"] = "passwordModificata";

header("Location: benvenuto.php");
exit;
?>