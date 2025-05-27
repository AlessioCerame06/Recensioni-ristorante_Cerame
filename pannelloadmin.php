<?php
    session_start();
    include("connessione/connessione.php");
?>

<doctype>
<html>
    <head>
        <title>ADMIN</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="./styles/styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body>

<?php

if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header("Location: paginalogin.php");
    exit;
}

$sql = "SELECT r.*, COUNT(rec.idRecensione) as num_recensioni
        FROM ristorante r LEFT JOIN recensione rec ON r.codiceRistorante = rec.codiceRistorante
        GROUP BY r.codiceRistorante";
    $result = $conn->query($sql);

if ($result -> num_rows > 0) {
    echo "<h2 class='text-center'>Ristoranti</h2>";
    echo "<table class='table table-striped m-auto text-center w-75'><tr><th>Nome</th><th>Indirizzo</th><th>Città</th><th>Recensioni</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['nome']}</td><td>{$row['indirizzo']}</td><td>{$row['citta']}</td><td>{$row['num_recensioni']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<h2 class='text-center'>Nessun ristorante presente</h2>";
}

?>
<br />
<div class="text-center mx-auto w-75 border border-2 border-black p-4">
    <h2 class="text-center text-danger">INSERISCI UN NUOVO RISTORANTE</h2>
    <i class="bi bi-building-add dimensioneIcon"></i>
    <h3>Compila tutti i campi per inserire un nuovo ristorante</h3>
    <form action="inserisciristorante.php" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-type"></i></span>
            <input type="text" class="form-control" placeholder="Nome" name="nome" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-signpost-split-fill"></i></span>
            <input type="text" class="form-control" placeholder="Indirizzo" name="indirizzo" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
            <input type="text" class="form-control" placeholder="Città" name="citta" required>
        </div>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-geo"></i></span>
            <input type="text" aria-label="latitudine" class="form-control" placeholder="Latidudine" required>
            <input type="text" aria-label="longitudine" class="form-control" placeholder="Longitudine" required>
        </div>
        <br />
        <button type="submit" class="btn btn-primary text-white rounded-4 dimensioneBottoni">Inserisci</button>
        <?php
        if(isset($_SESSION['esito_inserimento'])) {
            if ($_SESSION['esito_inserimento'] == "Ristorante inserito con successo") {
                echo "<h2 class='text-center text-success'>Ristorante inserito con successo</h2>";
            } else {
                echo "<h2 class='text-center text-danger'>Ristorante non inserito con successo</h2>";
            }
            $_SESSION['esito_inserimento'] = null;
        }
        ?>
    </form>
</div>
<br />

        <div class="m-auto text-center">
            <a href="scriptlogout.php"><button class="border border-solid border-black bg-primary text-white rounded-4 dimensioneBottoni">Logout <i class="bi bi-box-arrow-right text-white"></i></button></a>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>