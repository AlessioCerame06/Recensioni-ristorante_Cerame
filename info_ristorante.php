<?php
    session_start();
    include("connessione/connessione.php");

    $nome = $_GET["infoRistorante"];
    
    $selectRistorante = "SELECT codiceRistorante, indirizzo, citta FROM ristorante WHERE nome = '$nome'";
    $result = $conn->query($selectRistorante);

    $row = $result->fetch_assoc();
    $codiceRistorante = $row['codiceRistorante'];
?>

<!doctype html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>INFO RISTORANTE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles/styles.css">
  </head>
  <body>
    <div class="container">
        <h2 class="text-danger text-center">INFORMAZIONI</h2>
        <div class="row text-center">
            <div class="col-6">
                <h3 class="text-primary">NOME</h3>
                <i class="bi bi-type dimensioneIcon"></i>
                <p><?= $nome ?></p>
            </div>
            <div class="col-6">
                <h3 class="text-primary">CITTÀ</h3>
                <i class="bi bi-geo-alt-fill dimensioneIcon"></i>
                <p><?= $row["citta"] ?></p>
            </div>
            <div class="col-12">
                <h3 class="text-primary">INDIRIZZO</h3>
                <i class="bi bi-signpost-split-fill dimensioneIcon"></i>
                <p><?= $row["indirizzo"] ?></p>
            </div>
        </div>

        <?php
            $selectRecensioni = "SELECT re.voto, re.data, u.username
                                 FROM recensione re
                                 JOIN utente u ON re.idUtente = u.idUtente
                                 WHERE re.codiceRistorante = '$codiceRistorante'";
            $resultRecensioni = $conn->query($selectRecensioni);

            if ($resultRecensioni->num_rows === 0) {
                echo "<h2 class='text-center'>Nessuna recensione effettuata</h2>";
            } else {
                echo "<table class='table table-striped w-75 text-center m-auto'>";
                echo "<tr><th>Voto</th><th>Data</th><th>Utente</th></tr>";

                while ($recensione = $resultRecensioni->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $recensione["voto"] . "</td>";
                    echo "<td>" . $recensione["data"] . "</td>";
                    echo "<td>" . $recensione["username"] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            }
        ?>

        <br />
        <div class="m-auto text-center">
            <a href="benvenuto.php"><button class="border border-solid border-black bg-primary text-white rounded-4 dimensioneBottoni">Indietro</button></a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>