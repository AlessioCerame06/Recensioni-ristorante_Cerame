<?php
    session_start();

    include("connessione/connessione.php");

    if ((empty($_POST["username"])) || (empty($_POST["password"]))) {
        $_SESSION["erroreLogin"] = "credenzialiNonInserite";
        header("Location: paginalogin.php");
        exit;
    } else {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $selectUsername = "SELECT password FROM utente WHERE username = '$username';";
        $result = $conn -> query($selectUsername);
        if ($result -> num_rows == 0) {
            $_SESSION["erroreLogin"] = "erroreUsername";
            header("Location: paginalogin.php");
            exit;
        } else {
            $passwordDB = $result -> fetch_assoc();
            $passwordHash = hash ("sha256", $password);
            if ($passwordDB["password"] == $passwordHash) {
                $_SESSION["username"] = $username;
                header("Location: benvenuto.php");
                exit;
            } else {
                $_SESSION["erroreLogin"] = "errorePassword";
                header("Location: paginalogin.php");
                exit;
            }
        }  
    }
?>