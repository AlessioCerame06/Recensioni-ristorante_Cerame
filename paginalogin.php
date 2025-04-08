<?php
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <div class="w-50 m-auto text-center">
        <h1 class="text-danger">LOGIN</h1>
        <i class="bi bi-box-arrow-in-left dimensioneIcon"></i>
        <h2>Inserisci le credenziali per accedere</h2>
        <form action="scriptlogin.php" method="post">
            <div class="input-group mb-3 col-sm-12">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="username">
            </div>
            <div class="input-group mb-3 col-sm-12">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-lock-fill"></i></span>
                <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="password">
            </div>
            <input type="submit" class="border border-solid border-black bg-primary text-white rounded-4 dimensioneBottoni" value="ACCEDI">
        </form> <br>
        <p>Non sei registrato? <a href="paginaregistrazione.php" class="stileLinkRegistrazione">CLICCA QUI</a></p>
    </div>

    <?php
    if (isset($_SESSION["erroreLogin"])) {
      if ($_SESSION["erroreLogin"] == "erroreUsername") {
        echo "<h2 class='text-center text-danger'>Username inesistente</h2>";
      } else if ($_SESSION["erroreLogin"] == "errorePassword") {
        echo "<h2 class='text-center text-danger'>Password non corretta</h2>";
      } else if ($_SESSION["erroreLogin"] == "credenzialiNonInserite") {
        echo "<h2 class='text-center text-danger'>Username e/o password non inseriti</h2>";
      }
      $_SESSION["erroreLogin"] = null;
    }
    ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>