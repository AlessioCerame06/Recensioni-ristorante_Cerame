<?php
  session_start();
  include("connessione/connessione.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BENVENUTO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <?php
    echo "<h1 class='text-center text-danger'>Benvenuto " . $_SESSION["username"] . "</h1>";
    if (isset($_SESSION["primaRegistrazione"])) {
      echo "<ul>";
      echo "<li>Nome: " . $_SESSION["nome"] . "</li>";
      echo "<li>Cognome: " . $_SESSION["cognome"] . "</li>";
      echo "<li>Username: " . $_SESSION["username"] . "</li>";
      echo "<li>Email: " . $_SESSION["email"] . "</li>";
      echo "<li>Password: " . $_SESSION["password"] . "</li>";
      echo "</ul>";
      $_SESSION["primaRegistrazione"] = null;
    } else {
      $selectRecensioni = "SELECT COUNT(*) AS n_recensioni FROM recensione r JOIN utente u ON r.idUtente = u.idUtente WHERE u.username = " . $_SESSION["username"] . ";";
      $result = $conn -> query($selectRecensioni);
      $row = $result -> fetch_assoc();
      echo "<h2 class='text-center'>Hai fatto " .  $row["n_recensioni"] . " recensioni</h2>";
      if ($nRecensioni > 1) {

      }
    }
    ?>
    
    <div class="m-auto text-center">
        <a href="scriptlogout.php"><button class="border border-solid border-black bg-primary text-white rounded-4 dimensioneBottoni">Logout <i class="bi bi-box-arrow-right text-white"></i></button></a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>