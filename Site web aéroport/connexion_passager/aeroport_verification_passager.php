<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Vérification effectuée</title>
  </head>
  <body>
    <?php
    $id = $_POST['identifiant']; $mdp = $_POST['password'];

    $link = new mysqli('localhost','admin', 'Admin75!');
    if ($link->connect_errno) {
    die ("Erreur de connexion : errno: " . $link->errno .
                      "error:" . $link->error);
    }

    $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

    $result=$link->query("SELECT * FROM Compte WHERE identifiant = $id") or die("Search Error:" .$link->error());
    $data = $result->fetch_assoc();

    if($data['password']==$mdp)
    {
      $id_passager = $data['id_passager'];
    ?>
      <div align="center">
        <h3>Cliquez sur le bouton pour continuer :</h3><br>
        <form method="post" action="aeroport_compte_passager.php">
          <input type="hidden" name="id_passager" value="<?php echo "".$id_passager.""?>"/><br>
          <input type="image" src="../images/button_submit.png" width="11%">
        </form>
      </div>
    <?php
      $link->close();
    }
    else {
      $link->close();
      header('Location: http://localhost/projet/connexion_passager/aeroport_login_error_passager.php');
      exit();
    }
    ?>
  </body>
</html>
