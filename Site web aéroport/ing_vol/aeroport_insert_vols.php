<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Insertion d'un vol</title>
  </head>
  <body>
    <?php
      $depart = $_POST['depart'];
      $arrivee= $_POST['arrivee'];
      $date_vol=$_POST['date'];
      $horaires=$_POST['horaires'];
      $escale = $_POST['escale'];
      $porte = $_POST['porte'];
      $id_avion = $_POST['id_avion'];

      $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
      if ($link->connect_errno) {
      die ("Erreur de connexion : errno: " . $link->errno .
                        "error:" . $link->error);
      }

      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

      /*Vérifier que les deux destinations sont différentes*/

      if($depart == $arrivee)
      {
        ?>
          <div align="center">
            <h3>Le départ et l'arrivée ne peuvent pas être le même lieu.</h3>
            <table>
              <form action="aeroport_insert_ing.php" method="post">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="choix" value="vol">
                <input type="image" src = "../images/button_retour.png" width="11%">
              </form>
            </table>
          </div>
        <?php
        $link->close();
        exit();
      }

      /*Vérification du numéro de l'avion*/
      $avion = $link->query("SELECT * FROM Avion WHERE id_avion = $id_avion") or die("Search Error:" .$link->error());
      $iterator = $avion->fetch_assoc();

      if(empty($iterator))
      {
        ?>
          <div align="center">
            <h3>Le numéro d'avion entré n'existe pas.</h3>
            <table>
              <form action="aeroport_insert_ing.php" method="post">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="choix" value="vol">
                <input type="image" src = "../images/button_retour.png" width="11%">
              </form>
            </table>
          </div>
        <?php
        $link->close();
        exit();
      }

      /*Calcul du numéro du vol*/
      $last_num = $link->query("SELECT * FROM Vol ORDER BY num_vol DESC") or die("Search Error:" .$link->error());
      $iterator = $last_num->fetch_assoc();
      $num = $iterator['num_vol']+1;

      $link->query("INSERT INTO Vol VALUES ($num,'$depart','$arrivee','$date_vol','$horaires','$escale','$porte',$id_avion)")
      or die("Insert Error:" .$link->error());

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
