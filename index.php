<?php require "PripojeniDB.php"; ?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>Anketa</title>
</head>
<body>
    <h1>Anketa</h1>
    <hr>
    <a href="index.php">Home</a>
    <a href="hlasovani.php">Hlasování</a>
    <hr>
    <?php

if (!($con = mysqli_connect($server, $uzivatel, $heslo, $databaze))) {
    die("Nelze pripojit k databazi</body></html>");
}

if (isset($_POST["btnSubmit"]) && isset($_POST["otazka"])) 
{
    $otazka = addslashes($_POST["otazka"]);


    mysqli_query($con, "SET NAMES 'utf8'");


    if (mysqli_query($con, "INSERT INTO anketa_otazka(otazka) VALUES('" . $otazka . "')")) {
        echo "Nová anketní otázka byla vložena.<br>";
    }
    else {
        echo "Dotaz nelze provest " . mysqli_error($con);
    }
}

if (!($vysledek = mysqli_query($con, "SELECT * FROM anketa_otazka"))) {
    echo "Dotaz nelze provest " . mysqli_error($con);
}
?>
 <span><h3>Anketní otázky</h3><span> 
 
 <table  >
  <?php
while ($radek = mysqli_fetch_array($vysledek)) {
    echo "<tr><td><a href='otazka.php?id_otazka=" . htmlspecialchars($radek["id_otazka"]) . "'>detail</a></td><td> " . htmlspecialchars($radek["otazka"]) . "</td></tr>";

}
mysqli_free_result($vysledek);
mysqli_close($con);
?>
 </table>

 <hr>
Nová otázka
 <form method="POST" action="index.php">
     <input type="text" name="otazka">
     <input type="submit" name="btnSubmit" value="uložit">
</form>
</body>
</html>