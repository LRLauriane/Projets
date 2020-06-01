<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Vérification des informations</title>
  </head>
  <body>
    <?php
      $id = $_POST['identifiant'];
      $email = $_POST['email'];

      $link = new mysqli('localhost', 'admin', 'Admin75!');
      if ($link->connect_errno) {
      die ("Erreur de connexion : errno: " . $link->errno .
                        "error:" . $link->error);
      }

      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);
      $result = $link->query("SELECT * FROM Compte WHERE identifiant = $id") or die("Search Error:" .$link->error());
      $compte = $result->fetch_assoc();

      if(empty($compte)||$compte['email']!=$email)
      {
        $link->close();
        header('Location: http://localhost/projet/connexion_passager/aeroport_password_forget_error_passager.php');
        exit();
      }
      else
      {
    ?>
        <div align="center">
          <form action="aeroport_change_password.php" method="post">
            <br><h3>Modification du mot de passe</h3><br>
            <input type="hidden" name="identifiant" value="<?php echo $id ?>">
            <table width="30%" class="tableau">
              <tr>
                <td align = "center">Entrez votrez nouveau mot de passe :</td>
              </tr>
              <tr>
                <td align = "center">
                  <br>
                  <input type="password" name="password" required>
                </td>
              </tr>
              <tr>
                <td align = "center">
                  <br>
                  <input type="image" width = "35%" src="../images/button_submit.png">
                </td>
              </tr>
            </table>
          </form>
        </div>
    <?php
        $link->close();
      }
    ?>
  </body>
</html>
