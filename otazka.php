<?php require "PripojeniDB.php"; ?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>Anketa</title>
</head>
<body>
    <h1>Anketa - detail otázky</h1>
    <hr>
    <a href="index.php">Home</a>
    <a href="hlasovani.php">Hlasování</a>
    <hr>
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


//------------------------
if (!($vysledek = mysqli_query($con, "SELECT * FROM anketa_otazka WHERE id_otazka = '" . $id_otazka . "'"))) {
    echo "Dotaz nelze provest " . mysqli_error($con);
}

$row = mysqli_fetch_assoc($vysledek);
echo "<b>" . htmlspecialchars($row['otazka']) . "</b><hr>";

// --------------------
// ukladani odpovedi
if (isset($_POST["btnSubmit"]) && isset($_POST["odpoved"])) 
{
 
  //  $id_otazka = addslashes($_POST["id_otazka"]);
    $odpoved = addslashes($_POST["odpoved"]);


    mysqli_query($con, "SET NAMES 'utf8'");


    if (mysqli_query($con, "INSERT INTO anketa_odpoved(id_otazka,odpoved) VALUES('" . $id_otazka . "','" . $odpoved . "')")) {
        $infoText = "Nová odpověď byla vložena.";
    }
    else {
        echo "Dotaz nelze provest " . mysqli_error($con);
    }
}
// --------------------
// vypsani odpovedi na zobrazenou otazku
if (!($vysledekOdopoved = mysqli_query($con, "SELECT * FROM anketa_odpoved WHERE id_otazka = '" . $id_otazka . "'"))) {
    echo "Dotaz nelze provest " . mysqli_error($con);
}
?>
 <span><h3>Odpovědí</h3><span> 
 
 <table  >
  <?php
while ($radek = mysqli_fetch_array($vysledekOdopoved)) {
    echo "<tr><td> " . htmlspecialchars($radek["odpoved"]) . "</td></tr>";

}
mysqli_free_result($vysledek);
mysqli_close($con);
?>
 </table>
 
 <hr>
Odpověď
 <form method="POST" action="otazka.php">
        <input type="hidden" name="id_otazka" value="<?php echo $id_otazka ?>">
      
     <textarea rows="5" cols="30" name="odpoved"></textarea>
     <input type="submit" name="btnSubmit" value="uložit">
</form>
<?php echo $infoText ?>
</body>
</html>