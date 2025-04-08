<?php
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REGISTRAZIONE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <div class="w-50 m-auto text-center">
        <h1 class="text-danger">REGISTRAZIONE</h1>
        <i class="bi bi-person-fill-add dimensioneIcon"></i>
        <h2>Compila tutti i campi e clicca il bottone per registrarti</h2>
        <form action="scriptregistrazione.php" method="post">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                <input type="text" aria-label="First name" class="form-control" placeholder="Nome" name="nome">
                <input type="text" aria-label="Last name" class="form-control" placeholder="Cognome" name="cognome">
            </div> <br>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="username">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope-fill"></i></span>
                <input type="email" class="form-control" placeholder="email" aria-label="Username" aria-describedby="basic-addon1" name="email">
            </div>
            <div class="input-group mb-3 col-sm-12">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-lock-fill"></i></span>
                <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="password">
            </div>
            <input type="submit" class="border border-solid border-black bg-primary text-white rounded-4 dimensioneBottoni" value="REGISTRATI">
        </form> <br>
        <p>Sei già registrato? <a href="paginalogin.php" class="stileLinkRegistrazione">CLICCA QUI</a></p>
    </div>

    <?php
    if (isset($_SESSION["erroreRegistrazione"])) {
      if ($_SESSION["erroreRegistrazione"] == "datiRegistrazioneNonInseriti") {
        echo "<h2 class='text-center text-danger'>Campi della registrazione non inseriti</h2>";
      } else if ($_SESSION["erroreRegistrazione"] == "usernameEsistente") {
        echo "<h2 class='text-center text-danger'>Username già esistente</h2>";
      } else if ($_SESSION["erroreRegistrazione"] == "emailEsistente") {
        echo "<h2 class='text-center text-danger'>Email già esistente</h2>";
      } else if ($_SESSION["erroreRegistrazione"] == "utenteNonInserito") {
        echo "<h2 class='text-center text-danger'>Utente non inserito</h2>";
      }
      $_SESSION["erroreRegistrazione"] = null;
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>