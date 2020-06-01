<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Mise à jour du billet</title>
  </head>
  <body>
    <?php
      $link = new mysqli('localhost', 'admin', 'Admin75!');
      if ($link->connect_errno) {
      die ("Erreur de connexion : errno: " . $link->errno .
                        "error:" . $link->error);
      }

      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

      $choix = $_POST['choix'];
      $id_passager = $_POST['id_passager'];
      $date = date('Y-m-d H:i:s');

      $link->query("UPDATE Billet SET id_passager = $id_passager WHERE num_billet = $choix") or die("Update Error:" .$link->error());
      $link->query("UPDATE Billet SET date_reservation = '$date' WHERE num_billet = $choix") or die("Update Error:" .$link->error());

      $link->close();
    ?>
    <div align="center">
      <h3>La mise à jour a réussie.</h3>
      <form action="aeroport_compte_passager.php" method="post">
        <input type="hidden" name="id_passager" value="<?php echo $_POST['id_passager'] ?>">
        <input type="image" width = "11%" src="../images/button_retour.png">
      </form>
    </div>
  </body>
</html>
