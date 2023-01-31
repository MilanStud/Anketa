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
    <h1 class="p-1 mb-4 bg-success text-white rounded-bottom">Anketa - hlasování</h1>
<div class="btn-group mb-4">
    <a href="index.php" class="btn btn-success " aria-current="page"><i class="bi bi-house-door"></i> Home</a>
    <a href="hlasovani.php" class="btn btn-success active"><i class="bi bi-check2-square"></i> Hlasování</a>
</div>

    <?php
if (!($con = mysqli_connect($server, $uzivatel, $heslo, $databaze))) {
    die("Nelze pripojit k databazi</body></html>");
}
//----------------------
// hlasovanii
if (isset($_GET["id_odpoved"])) 
{


    if (mysqli_query($con, "UPDATE anketa_odpoved SET pocet_hlasu = pocet_hlasu + 1 WHERE id_odpoved = '" . addslashes($_GET["id_odpoved"]) . "'")) {
        // echo "Hlas byl zapocten.<br>";
        ?>
        <div class="alert alert-success " role="alert">
        <i class="bi bi-info-square"></i>
        Váš hlas byl započten.
        </div>
        <?php 

    // header("Location: hlasovani.php");
    }
    else {
        echo "Dotaz nelze provest " . mysqli_error($con);
    }
}
?>
<div class="rounded bg-success text-white p-2 mb-2"><h3>Hlasuj pro vybranou otázku!</h3></div>
<?php
//----------------------
// vypis otezek i odpovedi
if (!($vysledek = mysqli_query($con, "SELECT * FROM anketa_otazka"))) {
    echo "Dotaz nelze provest " . mysqli_error($con);
}
?>
<div class="overflow-auto"  style="max-height:350px; min-height:200px">
 <table  class="table table-striped  text-start">
  <?php
while ($radek = mysqli_fetch_array($vysledek)) {
    // echo "<tr><td colspan=4><b> " . htmlspecialchars($radek["otazka"]) . "</b></td></tr>";
?>
<tr>
    <td colspan=2>
        <b><?php echo htmlspecialchars($radek["otazka"]) ?></b>
    </td>
    <td  class="text-end">Počet hlasů:</td>
    <td></td>
</tr>
<?php
    if (!($vysledekOdopoved = mysqli_query($con, "SELECT * FROM anketa_odpoved WHERE id_otazka = '" . $radek["id_otazka"] . "'"))) {
        echo "Dotaz nelze provest " . mysqli_error($con);
    }

    while ($radekOdopoved = mysqli_fetch_array($vysledekOdopoved)) {
        ?>
        <tr>
            <td width="50">

            </td>
            <td> 
                <?php echo htmlspecialchars($radekOdopoved["odpoved"]) ?>
            </td>
            <td class="text-end">
            <?php echo  htmlspecialchars($radekOdopoved["pocet_hlasu"]) ?>
            </td>
            <td class="text-end">
                <a class="btn btn-outline-success  btn-sm" href="hlasovani.php?id_odpoved=<?php echo htmlspecialchars($radekOdopoved["id_odpoved"]) ?>"><i class="bi bi-check2-square"></i> hlasuj</a>
            </td>
            
        </tr>
<?php
    }
}

mysqli_free_result($vysledek);
mysqli_close($con);
?>
 </table>
 </div>
 </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</body>
</html>