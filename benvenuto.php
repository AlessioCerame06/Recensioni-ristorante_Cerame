<?php
  session_start();
  include("connessione/connessione.php");
  if (!(isset($_SESSION["login"]))) {
    header("Location: paginaLogin.php");
  }
  if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
    header("Location: pannelloadmin.php");
    exit;
  }
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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="profilo.php"><i class="bi bi-person-circle"></i> Profilo</a>
    <a href="scriptlogout.php"><button class="border border-solid border-black bg-primary text-white rounded-4 dimensioneBottoni">Logout <i class="bi bi-box-arrow-right text-white"></i></button></a>
</nav>
    <?php


    echo "<h1 class='text-center text-danger'>Benvenuto " . $_SESSION["username"] . "</h1>";
    if (isset($_SESSION["primaRegistrazione"])) {
      echo "<ul class='text-center border border-2 border-solid border-black m-auto w-50'>";
      echo "<li>Nome: " . $_SESSION["nome"] . "</li>";
      echo "<li>Cognome: " . $_SESSION["cognome"] . "</li>";
      echo "<li>Username: " . $_SESSION["username"] . "</li>";
      echo "<li>Email: " . $_SESSION["email"] . "</li>";
      echo "<li>Password: " . $_SESSION["password"] . "</li>";
      echo "</ul>";
      $_SESSION["primaRegistrazione"] = null;
    } else {
      $username = $_SESSION["username"];

      $selectUtente = "SELECT idUtente FROM utente WHERE username = '$username'";
      $utente = $conn->query($selectUtente);
      $ut = $utente->fetch_assoc();

      $idUtente = $ut['idUtente'];
      $selectNumRecensioni = "SELECT COUNT(*) AS n_recensioni FROM recensione WHERE idUtente = '$idUtente'";
      $result = $conn->query($selectNumRecensioni);
      $n_recensioni = $result->fetch_assoc()["n_recensioni"];

      if ($n_recensioni == 0) {
          echo "<h2 class='text-center'>Nessuna recensione effettuata</h2>";
      } else {
          $testo = ($n_recensioni == 1) ? "recensione" : "recensioni";
          echo "<h2 class='text-center'>Hai fatto $n_recensioni $testo</h2>";
          $selectRecensioni = "
              SELECT r.voto, r.data, r.idRecensione, rst.nome AS nomeRistorante
              FROM recensione r 
              JOIN ristorante rst ON r.codiceRistorante = rst.codiceRistorante 
              WHERE r.idUtente = '$idUtente'
              ORDER BY r.data DESC;
          ";
          $result = $conn->query($selectRecensioni);

          echo "<form action='elimina_recensioni.php' method='post'>";
          echo "<table class='table table-striped w-75 text-center m-auto'>";
          echo "<tr><th>Voto</th><th>Data</th><th>Ristorante</th><th>ELIMINA?</th></tr>";

          while ($recensione = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $recensione["voto"] . "</td>";
            echo "<td>" . $recensione["data"] . "</td>";
            echo "<td>" . $recensione["nomeRistorante"] . "</td>";
            echo "<td><input type='checkbox' name='recensioni[]' value='" . $recensione["idRecensione"] . "'></td>";
            echo "</tr>";
          }

          echo "</table> <br />
          <div class='m-auto text-center'>
          <input type='submit' value='Elimina' class='border border-solid border-black bg-primary text-white rounded-4 dimensioneBottoni'></div></form>";
          if (isset($_SESSION["esitoCheckbox"]) && $_SESSION["esitoCheckbox"] == "nessunaCheckboxSelezionata") {
            echo "<h2 class='text-center text-danger'>Nessuna checkbox selezionata</h2>";
            $_SESSION["esitoCheckbox"] = null;
          } else if (isset($_SESSION["esitoCheckbox"]) && $_SESSION["esitoCheckbox"] == "eliminazioneEffetuata") {
            echo "<h2 class='text-center text-success'>Sono state eliminate " . $_SESSION["nCheckbox"] . " recensioni</h2>";
            $_SESSION["esitoCheckbox"] = null;
            $_SESSION["nCheckbox"] = 0;
          }
      }

    }
    ?>
    <br />

    <div class="text-center m-auto col-10 border border-solid border-2 border-black rounded-pill">
    <h2 class="text-danger">Fai una recensione</h2>
    <h3>Compila tutti i campi e clicca sul bottone per inviare una recensione</h3>
    <div style="margin: 0 30px;">
    <form action="inseriscirecensione.php" method="get">

    <?php
    $selectRistoranti = "SELECT nome FROM ristorante ORDER BY(nome);";
    $res = $conn->query($selectRistoranti);
    if (!$res) {
      echo "<h2 class='text-center text-danger'>Nessun ristorante trovato</h2>";
    } else {
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
    </div><br /><br />
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
    </form></div><br /></div><br />
    <div class="col-10 border border-solid border-2 border-black rounded-pill m-auto text-center">
      <h2 class="text-center text-danger">Info ristoranti</h2>
    <?php
    $selectRistoranti = "SELECT nome FROM ristorante ORDER BY (nome);";
    $res = $conn->query($selectRistoranti);
    if (!$res) {
      echo "<h2 class='text-danger'>Nessun ristorante trovato</h2>";
    } else {
      echo "<div style='margin: 0 30px;'>";
      echo "<form action='info_ristorante.php' method='get'>";
      echo "<select class='form-select' name='infoRistorante'>";
      while ($ristorante = $res->fetch_assoc()) {
        echo "<option value='" . $ristorante["nome"] . "'>" . $ristorante["nome"] . "</option>";
      }
      echo "</select>";
      echo "<br />";
      echo "<input type='submit' value='Invia' class='border border-solid border-black bg-primary text-white rounded-4 dimensioneBottoni'>";
      echo "</form>";
      echo "<br />";
      echo "</div>";
    }
    ?>
    </div> <br />



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>