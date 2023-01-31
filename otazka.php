<?php require "PripojeniDB.php"; ?>
<!DOCTYPE html>
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
<div class="container text-center telo">
    <h1 class="p-1 mb-4 bg-success text-white rounded-bottom">Anketa - detail otázky a odpovědi</h1>
<div class="btn-group mb-4">
    <a href="index.php" class="btn btn-success" aria-current="page"><i class="bi bi-house-door"></i> Home</a>
    <a href="hlasovani.php" class="btn btn-success"><i class="bi bi-check2-square"></i> Hlasování</a>
</div>
<br>
    <?php
$infoText = "";
if(isset($_POST["id_otazka"])){
    $id_otazka = addslashes($_POST["id_otazka"]);
}
else
{
    $id_otazka = addslashes($_GET["id_otazka"]);
}

if (!($con = mysqli_connect($server, $uzivatel, $heslo, $databaze))) {
    die("Nelze pripojit k databazi</body></html>");
}
// --------------------
// ukladani odpovedi
if (isset($_POST["btnSubmit"]) && isset($_POST["odpoved"]) && strlen($_POST["odpoved"]) > 0) 
{
 
    $odpoved = addslashes($_POST["odpoved"]);

    if (mysqli_query($con, "INSERT INTO anketa_odpoved(id_otazka,odpoved) VALUES('" . $id_otazka . "','" . $odpoved . "')")) {
        ?>
        <div class="alert alert-success " role="alert">
        <i class="bi bi-info-square"></i>
        Nová odpověď byla vložena.
        </div>
        <?php
    }
    else {
        echo "Dotaz nelze provest " . mysqli_error($con);
    }
}
elseif (isset($_POST["btnSubmit"]) && isset($_POST["odpoved"]) && strlen($_POST["odpoved"]) == 0) {
    ?>
        <div class="alert alert-danger " role="alert">
        <i class="bi bi-exclamation-triangle"></i>
        Nebyl vložen text odpovědi.
        </div>
    <?php
}
//------------------------
if (!($vysledek = mysqli_query($con, "SELECT * FROM anketa_otazka WHERE id_otazka = '" . $id_otazka . "'"))) {
    echo "Dotaz nelze provest " . mysqli_error($con);
}

$row = mysqli_fetch_assoc($vysledek);
?>
<div class="rounded bg-success text-white p-2 mb-2">
    <h3><?php echo htmlspecialchars($row['otazka']) ?></h3>
</div>
    <?php

// --------------------
// vypsani odpovedi na zobrazenou otazku
if (!($vysledekOdopoved = mysqli_query($con, "SELECT * FROM anketa_odpoved WHERE id_otazka = '" . $id_otazka . "'"))) {
    echo "Dotaz nelze provest " . mysqli_error($con);
}
?>
 <form method="POST" action="otazka.php">
     <div class="input-group flex-nowrap mb-2">
        <input type="hidden" name="id_otazka" value="<?php echo $id_otazka ?>">
        <span class="input-group-text bg-success text-white" id="addon-wrapping">Nová odpověď:</span>
        <input type="text" class="form-control" name="odpoved">
    <button class="btn btn-success  btn-sm" type="submit" name="btnSubmit" value="uložit"><i class="bi bi-save2"></i> uložit</button>
    </div>
</form>
 <div class="overflow-auto" style="max-height:350px; min-height:200px">
 <table   class="table table-striped">
  <?php
while ($radek = mysqli_fetch_array($vysledekOdopoved)) {
    echo "<tr><td> " . htmlspecialchars($radek["odpoved"]) . "</td></tr>";

}
mysqli_free_result($vysledek);
mysqli_close($con);
?>
 </table>
</div>


<?php echo $infoText ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</div>
</body>
</html>