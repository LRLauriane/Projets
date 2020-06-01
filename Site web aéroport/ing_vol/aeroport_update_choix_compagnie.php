<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Update d'une compagnie</title>
  </head>
  <body>
    <div align="right">
      <table width="10%">
        <tr>
          <td align="right">
            <form action="aeroport_update_ing.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_retour.png" width="105%">
            </form>
          </td>
        </tr>
      </table>
    </div>
    <?php
        if($_POST['choice']=="nb_avions")
        {
    ?>
          <div align="center">
            <h3>Entrez une nouveau nombre d'avions</h3>
            <form action="aeroport_update_ing_compagnie.php" method="post">
              <table width="30%" class="tableau">
                <tr>
                  <td align="center">
                    Nombre d'avions :
                    <br>
                    <br>
                    <input type="number" name="nb_avions" min="0" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    Compagnie :
                    <br>
                    <br>
                    <input type="text" name="nom" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choice" value="<?php echo $_POST['choice'] ?>">
                    <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                    <input type="image" src = "../images/button_submit.png" width="30%">
                  </td>
                </tr>
              </table>
            </form>
          </div>
    <?php
        }
        else {
    ?>
          <div align="center">
            <h3>Entrez un nouveau nombre de vols par semaine</h3>
            <form action="aeroport_update_ing_compagnie.php" method="post">
              <table width="30%" class="tableau">
                <tr>
                  <td align="center">
                    Nombre de vols par semaine
                    <br>
                    <br>
                    <input type="number" name="nb_vols" min="0" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    Compagnie :
                    <br>
                    <br>
                    <input type="text" name="nom" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choice" value="<?php echo $_POST['choice'] ?>">
                    <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                    <input type="image" src = "../images/button_submit.png" width="30%">
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
