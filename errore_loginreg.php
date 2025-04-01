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
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <?php
      if ($_SESSION["errore"] == "erroreUsername") {
        echo "<h2 class='text-center text-danger'>Username inesistente</h2>";
      } else if ($_SESSION["errore"] == "errorePassword") {
        echo "<h2 class='text-center text-danger'>Password non corretta</h2>";
      } else if ($_SESSION["errore"] == "credenzialiNonInserite") {
        echo "<h2 class='text-center text-danger'>Username e/o password non inseriti</h2>";
      }
    ?>
    <div class="text-center">
      <a href="paginaLogin.html" class="stileLink">Ritorna al login</a>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>