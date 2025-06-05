<?php
session_start();
include("connessione/connessione.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PROFILO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  </head>
  <body>
  <?php
    echo "<h1 class='text-center'>PROFILO</h1>";
    echo "<h1 class='text-center text-danger'>" . $_SESSION["username"] . "</h1>";
    $selectUtente = "SELECT idUtente, nome, cognome, email, dataRegistrazione FROM utente WHERE username = '" . $_SESSION["username"] . "'";
    $result = $conn -> query($selectUtente);
    $row = $result -> fetch_assoc();
    $selectNumRecensioni = "SELECT count(*) AS nRecensioni FROM recensione WHERE idUtente = '" . $row["idUtente"] . "'";
    $result = $conn -> query($selectNumRecensioni);
    $nRecensioni = $result -> fetch_assoc();
    $selectUltimaData = "SELECT MAX(data) AS ultima_data FROM recensione WHERE idUtente = '" . $row["idUtente"] . "'";
    $result = $conn -> query($selectUltimaData);

    echo "<table class='table table-striped table-hover w-25 m-auto'>";
    echo "<thead><tr><th class='text-center' colspan='2'>INFO</th></tr></thead>
          <tr><td>Nome</td><td>" . $row["nome"] . "</td></tr>
          <tr><td>Cognome</td><td>" . $row["cognome"] . "</td></tr>
          <tr><td>Email</td><td>" . $row["email"] . "</td></tr>
          <tr><td>Data di registrazione</td><td>" . $row["dataRegistrazione"] . "</td></tr>
          <tr><td>Numero recensioni effetuate</td><td>" . $nRecensioni["nRecensioni"] . "</td></tr>";
    if (!($result)) {
      echo "<tr><td>Data dell'ultima data</td><td>Nessuna recensione effetuata</td></tr>";
    } else {
      $ultimaData = $result -> fetch_assoc();
      echo "<tr><td>Data dell'ultima data</td><td>" . $ultimaData["ultima_data"] . "</td></tr>";
    }
    echo "</table>";
  ?>
  <br />

  <div class="col-10 border border-solid border-2 border-black m-auto text-center">
      <h2 class="text-center text-danger">Cambio password</h2>
      <form action="cambio_password.php" method="post">
        <div class="input-group mb-3 w-75 text-center m-auto">
          <span class="input-group-text" id="basic-addon1"><i class="bi bi-lock-fill"></i></span>
          <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="password">
        </div>
        <input type='submit' value='Cambia' class='border border-solid border-black bg-primary text-white rounded-4 dimensioneBottoni'>
      </form> <br />
      <?php
        if (isset($_SESSION["erroreCambioPassword"]) && $_SESSION["erroreCambioPassword"] == "passwordModificata") {
          echo "<h2 class='text-center text-success'>Password modificata corretamente</h2>";
          $_SESSION["erroreCambioPassword"] = null;
        } else if (isset($_SESSION["erroreCambioPassword"]) && $_SESSION["erroreCambioPassword"] == "passwordUguale") {
          echo "<h2 class='text-center text-danger'>Le due password sono uguali</h2>";
          $_SESSION["erroreCambioPassword"] = null;
        }
      ?>
    </div>
    <br />


    <div class="m-auto text-center">
        <a href="benvenuto.php"><button class="border border-solid border-black bg-primary text-white rounded-4 dimensioneBottoni">Indietro</i></button></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>