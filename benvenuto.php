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
      $selectNumRecensioni = "SELECT COUNT(*) AS n_recensioni FROM recensione r JOIN utente u ON r.idUtente = u.idUtente WHERE u.username = " . $_SESSION["username"] . ";";
      if (!($result = $conn -> query($selectNumRecensioni))) {
        echo "<h2 class='text-center'>Nessuna recensione effetuata</h2>";
      } else {
        $row = $result -> fetch_assoc();
        echo "<h2 class='text-center'>Hai fatto " .  $row["n_recensioni"] . " recensioni</h2>";
        $selectRecensioni = "SELECT idUtente, voto, data, idUtente, codiceRistorante FROM recensioni WHERE username = " . $_SESSION["username"];
        $result = $conn -> query($selectRecensioni);
        echo "<table class='table table-striped'>";
        echo "<tr><th>Voto</th><th>Data</th><th>Utente</th><th>Ristorante</th></tr>";
        while ($recensione = $result -> fetch_assoc()) {
          $selectUtente = "SELECT username FROM utente WHERE idUtente = " . $recensione["idUtente"];
          $utente = $conn -> query($selectUtente);
          $ut = $utente -> fetch_assoc();
          $selectRistorante = "SELECT nome FROM ristorante WHERE codiceRistorante = " . $recensione["codiceRistorante"];
          $ristorante = $conn -> query($selectRistorante);
          $ri = $ristorante -> fetch_assoc();
          echo "<tr><td>" . $recensione["voto"] . "</td><td> " . $recensione["data"] . "</td><td>" . $ut["username"] . "</td><td> " . $ri["nome"] . "</td></tr>";
        }
        echo "</table>"
      }
    }
    ?>

    <div class="text-center m-auto col-10 border border-solid border-2 border-black rounded-pill">
    <h2 class="text-danger">Fai una recensione</h2>
    <h3>Compila tutti i campi e clicca sul bottone per inviare una recensione</h3>
    <div style="margin: 0 30px;">
    <form action="inseriscirecensione.php" method="get">

    <?php
    $selectRistoranti = "SELECT nome FROM ristorante;";
    $res = $conn->query($selectRistoranti);
    if (!$res) {
      echo "<h2 class='text-center text-danger'>Nessun ristorante trovato</h2>";
    } else {
      echo "<p></p>";
      echo "<select class='form-select' name='ristorante'>";
      while ($ristorante = $res->fetch_assoc()) {
        echo "<option value='" . $ristorante["nome"] . "'>" . $ristorante["nome"] . "</option>";
      }
      
    }
    ?>
    </select>
    <p>Voto</p>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="votoRec" id="votoRec" value="1" checked>
    <label class="form-check-label" for="votoRec">1</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="votoRec" id="votoRec" value="2">
    <label class="form-check-label" for="votoRec">2</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="votoRec" id="votoRec" value="3">
    <label class="form-check-label" for="votoRec">3</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="votoRec" id="votoRec" value="4">
    <label class="form-check-label" for="votoRec">4</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="votoRec" id="votoRec" value="5">
    <label class="form-check-label" for="votoRec">5</label>
    </div><br><br>
    <input type="submit" value="Invia" class="border border-solid border-black bg-primary text-white rounded-4 dimensioneBottoni">
    <?php
      if (isset($_SESSION["errore"]) && $_SESSION["errore"] == "erroreInserimentoRecensione") {
        echo "<h2 class='text-center text-danger'>Recensione non inserita. Riprovare</h2>";
        $_SESSION["errore"] = null;
      } else if (isset($_SESSION["esitoInsertRecensione"]) && $_SESSION["esitoInsertRecensione"] == true) {
        echo "<h2 class='text-center text-success'>Recensione inserita correttamente</h2>";
        $_SESSION["esitoInsertRecensione"] = false;

      }
    ?>
    </form></div><br></div><br>
    
    <div class="m-auto text-center">
        <a href="scriptlogout.php"><button class="border border-solid border-black bg-primary text-white rounded-4 dimensioneBottoni">Logout <i class="bi bi-box-arrow-right text-white"></i></button></a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>