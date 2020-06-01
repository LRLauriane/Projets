<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Insertion d'un avion</title>
  </head>
  <body>
<?php
$comp = $_POST['compagnie'];
$capacite = $_POST['capacite'];

$link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
if ($link->connect_errno) {
die ("Erreur de connexion : errno: " . $link->errno ."error:" . $link->error);}

$link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

/*Vérification du numéro de l'avion*/
$res = $link->query("SELECT * FROM Compagnie WHERE nom = '$comp'") or die("Search Error:" .$link->error());
$iterator = $res->fetch_assoc();

if(empty($iterator))
{
?>
    <div align="center">
      <h3>La compagnie n'existe pas.</h3>
        <table>
          <form action="aeroport_insert_ing.php" method="post">
            <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="avion">
              <input type="image" src = "../images/button_retour.png" width="11%">
          </form>
        </table>
      </div>
<?php
$link->close();
exit();
}

/*Calcul du numéro de l'avion*/
$last_num = $link->query("SELECT * FROM Avion ORDER BY id_avion DESC") or die("Search Error:" .$link->error());
$iterator = $last_num->fetch_assoc();
$num = $iterator['id_avion']+1;

$link->query("INSERT INTO Avion VALUES ($num,$capacite,'$comp')") or die("Insert Error:" .$link->error());

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
