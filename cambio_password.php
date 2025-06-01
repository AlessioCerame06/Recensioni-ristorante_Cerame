<?php
session_start();
include("connessione/connessione.php");

$passInserita = $_POST["password"];
$selectPassword = "SELECT password FROM utente WHERE username = '" . $_SESSION["username"] . "'";
$result = $conn -> query($selectPassword);
$passDB = $result -> fetch_assoc();
$passInseritaHashata = hash("sha256", $passInserita);
$passDBHashata = hash("sha256", $passDB);
$updatePassword = "UPDATE password";
?>