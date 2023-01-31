<?php require "PripojeniDB.php"; ?>
<!DOCTYPE html>
<html lang="cs">
<html>
<head>
   <meta charset="UTF-8">
   <title>Anketa</title>
   <link rel="stylesheet" href="styly.css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <!-- linkovani bootstrap ikon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
</head>
<body>
<div class="container text-center">
    <h1 class="p-1 mb-4 bg-success text-white rounded-bottom">Anketa</h1>

<div class="btn-group mb-4">
    <a href="index.php" class="btn btn-success active" aria-current="page"><i class="bi bi-house-door"></i> Home</a>
    <a href="hlasovani.php" class="btn btn-success"><i class="bi bi-check2-square"></i> Hlasování</a>
</div>
     
    <?php

if (!($con = mysqli_connect($server, $uzivatel, $heslo, $databaze))) {
    die("Nelze pripojit k databazi</body></html>");
}

if (isset($_POST["btnSubmit"]) && isset($_POST["otazka"]) && strlen($_POST["otazka"]) > 0) 
{
    $otazka = addslashes($_POST["otazka"]);

    if (mysqli_query($con, "INSERT INTO anketa_otazka(otazka) VALUES('" . $otazka . "')")) {

        ?>
        <div class="alert alert-success" role="alert">
        <i class="bi bi-info-square"></i>
        Nová anketní otázka byla vložena.
        </div>
        <?php
    }
    else {
        echo "Dotaz nelze provest " . mysqli_error($con);
    }
}
elseif (isset($_POST["btnSubmit"]) && isset($_POST["otazka"]) && strlen($_POST["otazka"]) == 0) {
    ?>
        <div class="alert alert-danger " role="alert">
        <i class="bi bi-exclamation-triangle"></i>
        Nebyl vložen text otázky.
        </div>
    <?php
}

if (!($vysledek = mysqli_query($con, "SELECT * FROM anketa_otazka"))) {
    echo "Dotaz nelze provest " . mysqli_error($con);
}
?>
 <div class="rounded bg-success text-white p-2 mb-2"><h3>Anketní otázky</h3></div> 
<form method="POST" action="index.php">
    <div class="input-group flex-nowrap mb-2">
        <span class="input-group-text bg-success text-white" id="addon-wrapping">Nová otázka:</span>
        <input type="text" class="form-control" name="otazka">
        <button class="btn btn-success  btn-sm" type="submit" name="btnSubmit" value="uložit"><i class="bi bi-save2"></i> uložit</button>
    </div>
</form>
 <div class="overflow-auto"  style="max-height:350px; min-height:200px">
 <table class="table table-striped  text-start" >
  <?php
while ($radek = mysqli_fetch_array($vysledek)) {
    ?>
    <tr>
        <td>
            <?php echo htmlspecialchars($radek["otazka"]) ?>
        </td>
        <td class="text-end">
            <a class="btn btn-outline-success  btn-sm" href='otazka.php?id_otazka=<?php echo htmlspecialchars($radek["id_otazka"]) ?>'><i class="bi bi-pencil-square"></i> vložit odpověď</a>
        </td>
    </tr>
<?php
}
mysqli_free_result($vysledek);
mysqli_close($con);
?>
 </table>
</div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</div>
</body>
</html>