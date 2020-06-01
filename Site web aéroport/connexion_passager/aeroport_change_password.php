<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Modification réussie</title>
  </head>
  <body>
    <?php
      $id=$_POST['identifiant'];
      $mdp=$_POST['password'];

      $link = new mysqli('localhost', 'admin', 'Admin75!');
      if ($link->connect_errno) {
      die ("Erreur de connexion : errno: " . $link->errno .
                        "error:" . $link->error);
      }

      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);
      $link->query("UPDATE Compte SET password='$mdp'WHERE identifiant = $id") or die("Search Error:" .$link->error());
      $link->close();

    ?>
      <div align="center">
          <h3>Le mot de passe a bien été modifié.</h3>
          <a href="aeroport_login_passager.php">
            <img src="../images/button_retour.png" alt="Retour" width="11%">
          </a>
      </div>
  </body>
</html>
