<?php
    session_start();

    include("connessione/connessione.php");

    if ((empty($_POST["username"])) || (empty($_POST["password"]))) {
        $_SESSION["erroreLogin"] = "credenzialiNonInserite";
        header("Location: errore_loginreg.php");
        exit;
    } else {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $selectUsername = "SELECT password FROM utente WHERE username = '$username';";
        $result = $conn -> query($selectUsername);
        if ($result -> num_rows == 0) {
            $_SESSION["erroreLogin"] = "erroreUsername";
            header("Location: errore_loginreg.php");
            exit;
        } else {
            $passwordDB = $result -> fetch_assoc();
            if ($passwordDB["password"] == $password) {
                $_SESSION["username"] = $username;
                header("Location: benvenuto.php");
                exit;
            } else {
                $_SESSION["erroreLogin"] = "errorePassword";
                header("Location: errore_loginreg.php");
                exit;
            }
        }  
    }
?>