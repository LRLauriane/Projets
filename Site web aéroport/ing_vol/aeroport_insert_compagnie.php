<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Insertion d'une compagnie</title>
  </head>
  <body>
<?php
$nom = $_POST['nom'];
$pays = $_POST['pays'];
$nb_avions = $_POST['nb_avions'];
$nb_vol = $_POST['nb_vols_semaine'];

$link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
if ($link->connect_errno) {
die ("Erreur de connexion : errno: " . $link->errno ."error:" . $link->error);}

$link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

$res = $link->query("SELECT * FROM Compagnie where nom = '$nom'") or die("Insert Error:" .$link->error());
$iterator = $res->fetch_assoc();

if(!(empty($iterator)))
{
  ?>
      <div align="center">
        <h3>La compagnie existe déjà.</h3>
          <table>
            <form action="aeroport_insert_ing.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="choix" value="compagnie">
                <input type="image" src = "../images/button_retour.png" width="11%">
            </form>
          </table>
        </div>
  <?php
  $link->close();
  exit();
}

$link->query("INSERT INTO Compagnie VALUES ('$nom','$pays',$nb_avions,$nb_vol)") or die("Insert Error:" .$link->error());

$link->close();
?>
    <div align="center">
      <h3>L'insertion a été effectué avec succès.</h3>
      <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
        <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
        <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
        <input type="image" src = "../images/button_choice.png" width="11%">
      </form>
    </div>
  </body>
</html>
