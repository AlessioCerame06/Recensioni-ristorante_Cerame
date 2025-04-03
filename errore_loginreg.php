<?php
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ERRORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">
  </head>
  <body>
    <?php
      if(isset($_SESSION["erroreLogin"])) {
        if ($_SESSION["erroreLogin"] == "erroreUsername") {
          echo "<h2 class='text-center text-danger'>Username inesistente</h2>";
        } else if ($_SESSION["erroreLogin"] == "errorePassword") {
          echo "<h2 class='text-center text-danger'>Password non corretta</h2>";
        } else if ($_SESSION["erroreLogin"] == "credenzialiNonInserite") {
          echo "<h2 class='text-center text-danger'>Username e/o password non inseriti</h2>";
        }
        $link = true;
        $_SESSION["erroreLogin"] = null;
      } else {
        if ($_SESSION["erroreRegistrazione"] == "datiRegistrazioneNonInseriti") {
          echo "<h2 class='text-center text-danger'>Campi della registrazione non inseriti</h2>";
        } else if ($_SESSION["erroreRegistrazione"] == "usernameEsistente") {
          echo "<h2 class='text-center text-danger'>Username già esistente</h2>";
        } else if ($_SESSION["erroreRegistrazione"] == "emailEsistente") {
          echo "<h2 class='text-center text-danger'>Email già esistente</h2>";
        } else if ($_SESSION["erroreRegistrazione"] == "utenteNonInserito") {
          echo "<h2 class='text-center text-danger'>Utente non inserito</h2>";
        }
        $link = false;
        $_SESSION["erroreRegistrazione"] = null;
      }

        if ($link == true) {
          echo "<div class='text-center'>
                <a href='paginaLogin.html' class='stileLink'>Ritorna al login</a>
                </div>";
        } else {
          echo "<div class='text-center'>
                <a href='paginaRegistrazione.html' class='stileLink'>Ritorna alla registrazione</a>
                </div>";
        }
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>