<?php
session_start();
include("connessione/connessione.php");

if ((empty($_POST["nome"])) || (empty($_POST["cognome"])) || (empty($_POST["email"])) || (empty($_POST["password"]))) {
    $_SESSION["erroreRegistrazione"] = "datiRegistrazioneNonInseriti";
    header("Location: errore_loginreg.php");
    exit;
} else {
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $selectUsername = "SELECT username FROM utente WHERE username = '$username';";
    $resultUsername = $conn->query($selectUsername);
    if ($resultUsername->num_rows > 0) {
        $_SESSION["erroreRegistrazione"] = "usernameEsistente";
        header("Location: errore_loginreg.php");
        exit;
    }

    $selectEmail = "SELECT email FROM utente WHERE email = '$email';";
    $resultEmail = $conn->query($selectEmail);
    if ($resultEmail->num_rows > 0) {
        $_SESSION["erroreRegistrazione"] = "emailEsistente";
        header("Location: errore_loginreg.php");
        exit;
    }

    $passwordHash = hash("sha256", $password);
    $data = date("y-m-d h:i:s"); 
    $insertNuovoUtente = "INSERT INTO utente (username, password, nome, cognome, email, dataregistrazione)
                          VALUES ('$username', '$passwordHash', '$nome', '$cognome', '$email', '$data');";

    if (!$conn->query($insertNuovoUtente)) {
        $_SESSION["erroreRegistrazione"] = "utenteNonInserito";
        header("Location: errore_loginreg.php");
        exit;
    } else {
        $_SESSION["username"] = $username;
        header("Location: benvenuto.php");
        exit;
    }
}
?>