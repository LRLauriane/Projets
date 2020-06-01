<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Update d'un avion</title>
  </head>
  <body>
    <?php
    $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
    if ($link->connect_errno) {
    die ("Erreur de connexion : errno: " . $link->errno .
                      "error:" . $link->error);
    }

    $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

    $nom = $_POST['nom'];

    /*Vérification du numéro de l'avion*/
    $num = $link->query("SELECT * FROM Compagnie WHERE nom = '$nom'") or die("Search Error:" .$link->error());
    $iterator = $num->fetch_assoc();

    if(empty($iterator))
    {
      ?>
        <div align="center">
          <h3>Le nom de la compagnie n'existe pas.</h3>
          <table>
            <form action="aeroport_update_choix_compagnie.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choice" value="choice">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_retour.png" width="11%">
            </form>
          </table>
        </div>
      <?php
      $link->close();
      exit();
    }

    if($_POST['choice']=="nb_avions")
    {
      $nb_avions = $_POST['nb_avions'];
      $link->query("UPDATE Compagnie SET nbre_avions = $nb_avions WHERE nom = '$nom'") or die("Update Error:" .$link->error());
    }
    else {
      $nb_vols = $_POST['nb_vols'];
      $link->query("UPDATE Compagnie SET nbre_vols_semaine = $nb_vols WHERE nom = '$nom'") or die("Update Error:" .$link->error());
    }

    $link->close();
    ?>
    <div align="center">
      <h3>La mise à jour a été effectué avec succès.</h3>
      <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
        <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
        <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
        <input type="image" src = "../images/button_choice.png" width="11%">
      </form>
    </div>
  </body>
</html>
