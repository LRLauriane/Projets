<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Vérification</title>
  </head>
  <body>
    <div align="right">
      <a href="aeroport_login_employe.php">
        <img src="../images/button_deco.png" alt="Déconnexion" width = "11%">
      </a>
    </div>
  <?php
      $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
      if ($link->connect_errno) {
        header('Location: http://localhost/projet/connexion_employe/aeroport_login_error_employe.php');
        die ("Erreur de connexion : errno: " . $link->errno .
                          "error:" . $link->error);
      }

      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

      if ($_POST['identifiant']=='ing.op.vol')
      {
      ?>
        <div align="center">
          <h1>Bienvenue</h1>
            <form action="../ing_vol/aeroport_inge_vol.php" method="post">
              <table width = "30%" class = "tableau">
                <tr>
                  <td align = "center">
                    Que voulez-vous faire ?
                    <br>
                    <br>
                      <input type="radio" name="action" value="insert" required> Insertion<br>
                      <input type="radio" name="action" value="update" required> Mise à jour<br>
                      <input type="radio" name="action" value="select" required> Sélection<br>
                      <input type="radio" name="action" value="delete" required> Suppression<br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="image" width="30%" src = "../images/button_submit.png">
                  </td>
                </tr>
              </table>
            </form>
        </div>
      <?php
      }
      else if($_POST['identifiant']=='gestionnaire.billet')
      {
      ?>
        <div align="center">
          <h1>Bienvenue</h1>
            <form action="../gestionnaire_billet/aeroport_gestionnaire_billet.php" method="post">
              <table width = "30%" class = "tableau">
                <tr>
                  <td align = "center">
                    Que voulez-vous faire ?
                    <br>
                    <br>
                    <input type="radio" name="action" value="insert" required> Insertion<br>
                    <input type="radio" name="action" value="update" required> Mise à jour<br>
                    <input type="radio" name="action" value="select" required> Sélection<br>
                    <input type="radio" name="action" value="delete" required> Suppression<br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="image" width="30%" src = "../images/button_submit.png">
                  </td>
                </tr>
              </table>
            </form>
        </div>
      <?php
      }
      else if($_POST['identifiant']=='gestionnaire.humains')
      {
        ?>
          <div align="center">
            <h1>Bienvenue</h1>
              <form action="../gestionnaire_humains/aeroport_gestionnaire_humains.php" method="post">
                <table width = "30%" class = "tableau">
                  <tr>
                    <td align = "center">
                      Que voulez-vous faire ?
                      <br>
                      <br>
                      <input type="radio" name="action" value="insert" required> Insertion<br>
                      <input type="radio" name="action" value="update" required> Mise à jour<br>
                      <input type="radio" name="action" value="select" required> Sélection<br>
                      <input type="radio" name="action" value="delete" required> Suppression<br>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">
                      <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                      <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                      <input type="image" width="30%" src = "../images/button_submit.png">
                    </td>
                  </tr>
                </table>
              </form>
          </div>
        <?php
      }

  ?>
  </body>
</html>
