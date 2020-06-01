<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Update</title>
  </head>
  <body>
    <?php
    $link = new mysqli('localhost', 'admin', 'Admin75!');
    if ($link->connect_errno) {
    die ("Erreur de connexion : errno: " . $link->errno .
                      "error:" . $link->error);
    }

    $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

    if($_POST['choix']=="passager")
    {
      $num_passager = $_POST['id_passager'];
      $num_passeport = $_POST['passeport'];

      /*Vérification du numéro de passager*/
      $res = $link->query("SELECT * FROM Passager WHERE id_passager=$num_passager") or die("Select Error:" .$link->error());
      $iterator = $res->fetch_assoc();

      if(empty($iterator))
      {
          $link->close();
      ?>
          <div align="center">
            <h3>Le numéro de passager n'existe pas.</h3>
            <form action="aeroport_update_infos.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_retour.png" width="11%">
            </form>
          </div>
      <?php
        exit();
      }

      /*Vérification du numéro de passeport*/
      $res = $link->query("SELECT * FROM Passager WHERE num_passeport=$num_passeport") or die("Select Error:" .$link->error());
      $iterator = $res->fetch_assoc();

      if(!(empty($iterator)))
      {
          $link->close();
      ?>
          <div align="center">
            <h3>Le numéro de passeport existe déjà.</h3>
            <form action="aeroport_update_infos.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_retour.png" width="11%">
            </form>
          </div>
      <?php
        exit();
      }


      $link->query("UPDATE Passager SET num_passeport = $num_passeport WHERE id_passager=$num_passager") or die("Update Error:" .$link->error());
      $link->close();
    }
    else {
      $num_employe = $_POST['num_employe'];
      $num_equipage = $_POST['equipage'];

      $res = $link->query("SELECT * FROM Employe WHERE num_employe = $num_employe") or die("Select Error:" .$link->error());
      $iterator = $res->fetch_assoc();

      if(empty($iterator))
      {
          $link->close();
      ?>
          <div align="center">
            <h3>Le numéro d'employé' n'existe pas.</h3>
            <form action="aeroport_update_infos.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_retour.png" width="11%">
            </form>
          </div>
      <?php
        exit();
      }

      $link->query("UPDATE Employe SET num_equipage = $num_equipage WHERE num_employe=$num_employe") or die("Update Error:" .$link->error());
      $link->close();
    }
    ?>
    <div align="center">
      <table>
        <h3>La mise à jour a été faite avec succès.</h3>
        <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
          <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
          <input type="image" src = "../images/button_choice.png" width="11%">
        </form>
      </table>
    </div>
  </body>
</html>
