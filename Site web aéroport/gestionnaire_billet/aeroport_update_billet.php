<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Mise à jour des billets</title>
  </head>
  <body>
    <?php
      $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
      if ($link->connect_errno) {
      die ("Erreur de connexion : errno: " . $link->errno .
                        "error:" . $link->error);
      }

      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

      $prix = $_POST['prix'];
      $billet = $_POST['billet'];

      $test = $link->query("SELECT num_billet FROM Billet WHERE num_billet =$billet") or die("Select error : ".$link->error);
      $iterator = $test->fetch_assoc();

      if(empty($iterator))
      {
        $link->close();
    ?>
        <div align="center">
          <h3>Ce numéro de billet n'existe pas.</h3>
          <form action="aeroport_gestionnaire_billet.php" method="post">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
            <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
            <input type="image" width = "11%" src="../images/button_retour.png">
          </form>
        </div>
    <?php
        exit();
      }

      $link->query("UPDATE Billet SET prix=$prix WHERE num_billet =$billet") or die("Update error : ".$link->error);
      $link->close();
    ?>
    <div align="center">
      <h3>La mise à jour a réussie.</h3>
      <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
        <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
        <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
        <input type="image" width = "11%" src="../images/button_choice.png">
      </form>
    </div>
  </body>
</html>
