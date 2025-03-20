<?php
    include("connessione/connessione.php");
    session_start();
    $username = $_POST["username"];
    $password = $_POST["password"];

    $selectUsername = "SELECT password FROM utente WHERE username = $username";
    if (!($ris = $conn -> query($selectUsername))) {
        $_SESSION["errore"] = "erroreUsername";
        header("Location: errore_loginreg.php");
        exit;
    } else {
        echo "<p>fjdijfsdpjfosdifjs</p>";
    }
?>