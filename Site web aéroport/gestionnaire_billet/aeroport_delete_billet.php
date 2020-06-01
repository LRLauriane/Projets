<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Suppression d'un billet</title>
  </head>
  <body>
    <?php
      $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
      if ($link->connect_errno) {
      die ("Erreur de connexion : errno: " . $link->errno .
                        "error:" . $link->error);
      }

      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

      if($_POST['choix'] == "billet")
      {
        $num = $_POST['billet'];
        $test = $link->query("SELECT num_billet FROM Billet WHERE num_billet = $num") or die("Delete error : ".$link->error);
        $res = $test->fetch_assoc();

        if(empty($res))
        {
          $link->close();
      ?>
          <div align="center">
            <h3>Le numéro de billet n'existe pas.</h3>
            <form action="aeroport_choix_infos.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" width = "11%" src="../images/button_retour.png">
            </form>
          </div>
      <?php
        }
        else
        {
          $link->query("DELETE FROM Bagage WHERE num_billet=$num") or die("Delete error : ".$link->error);
          $link->query("DELETE FROM Billet WHERE num_billet = $num") or die("Delete error : ".$link->error);
          $link->close();
      ?>
          <div align="center">
            <h3>La suppression a réussie.</h3>
            <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="image" width = "11%" src="../images/button_choice.png">
            </form>
          </div>
      <?php
        }
      }
      else {
        $num = $_POST['vol'];
        $test = $link->query("SELECT num_vol FROM Billet WHERE num_vol = $num") or die("Delete error : ".$link->error);
        $res = $test->fetch_assoc();

        if(empty($res))
        {
          $link->close();
      ?>
          <div align="center">
            <h3>Le numéro de vol n'existe pas.</h3>
            <form action="aeroport_choix_infos.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" width = "11%" src="../images/button_retour.png">
            </form>
          </div>
      <?php
        }
        else
        {
          $link->query("DELETE FROM Bagage WHERE num_billet IN (SELECT num_billet FROM Billet WHERE num_vol = $num)") or die("Delete error : ".$link->error);
          $link->query("DELETE FROM Billet WHERE num_vol = $num") or die("Delete error : ".$link->error);
          $link->close();
      ?>
        <div align="center">
          <h3>La suppression a réussie.</h3>
          <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
            <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
            <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
            <input type="image" width = "11%" src="../images/button_choice.png">
          </form>
        </div>
      <?php
        }
      }
    ?>
  </body>
</html>
