<?php
    session_start();

    include("connessione/connessione.php");

    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!(isset($username))) {
        $_SESSION["errore"] = "usernameNonInserito";
        header("Location: errore_loginreg.php");
        exit;
    } else if (!(isset($password))) {
        $_SESSION["errore"] = "passwordNonInserita";
        header("Location: errore_loginreg.php");
        exit;
    } else {
        $selectUsername = "SELECT password FROM utente WHERE username = '$username';";
        if (!($ris = $conn -> query($selectUsername))) {
            $_SESSION["errore"] = "erroreUsername";
            header("Location: errore_loginreg.php");
            exit;
        } else {
            $passwordDB = $ris -> fetch_assoc();
            if ($passwordDB["password"] == $password) {
                $_SESSION["username"] = $username;
                header("Location: benvenuto.php");
                exit;
            } else {
                $_SESSION["errore"] = "errorePassword";
                header("Location: errore_loginreg.php");
                exit;
            }
        }  
    }

    
?>