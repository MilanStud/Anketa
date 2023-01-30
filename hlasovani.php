<?php require "PripojeniDB.php"; ?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>Anketa</title>
</head>
<body>
    <h1>Anketa - hlasování</h1>
    <hr>
    <a href="index.php">Home</a>
    <hr>
    <?php
if (!($con = mysqli_connect($server, $uzivatel, $heslo, $databaze))) {
    die("Nelze pripojit k databazi</body></html>");
}
//----------------------
// hlasovanii
if (isset($_GET["id_odpoved"])) 
{

    mysqli_query($con, "SET NAMES 'utf8'");
    //UPDATE …. SET hlasu = hlasu + 1 WHERE 
//INSERT INTO anketa_otazka(pocet_hlasu) VALUES('" . $otazka . "')
    if (mysqli_query($con, "UPDATE anketa_odpoved SET pocet_hlasu = pocet_hlasu + 1 WHERE id_odpoved = '" . $_GET["id_odpoved"] . "'")) {
        echo "Hlas byl zapocten.<br>";
    }
    else {
        echo "Dotaz nelze provest " . mysqli_error($con);
    }
}
//----------------------
// vypis otezek i odpovedi
if (!($vysledek = mysqli_query($con, "SELECT * FROM anketa_otazka"))) {
    echo "Dotaz nelze provest " . mysqli_error($con);
}
?>
 <table >
  <?php
while ($radek = mysqli_fetch_array($vysledek)) {
    echo "<tr><td colspan=3><b> " . htmlspecialchars($radek["otazka"]) . "</b></td></tr>";

    if (!($vysledekOdopoved = mysqli_query($con, "SELECT * FROM anketa_odpoved WHERE id_otazka = '" . $radek["id_otazka"] . "'"))) {
        echo "Dotaz nelze provest " . mysqli_error($con);
    }

    while ($radekOdopoved = mysqli_fetch_array($vysledekOdopoved)) {
        echo "<tr><td width=50></td><td> " . htmlspecialchars($radekOdopoved["odpoved"]) . "</td><td><a href='hlasovani.php?id_odpoved=" . htmlspecialchars($radekOdopoved["id_odpoved"]) . "'>hlasuj</a></td><td>" . htmlspecialchars($radekOdopoved["pocet_hlasu"]) . "</td></tr>";

    }
}

mysqli_free_result($vysledek);
mysqli_close($con);
?>
 </table>
</body>
</html>