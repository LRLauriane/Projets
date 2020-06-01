<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Updates</title>
  </head>
  <body>
    <div align="right">
      <table width="10%">
        <tr>
          <td align="right">
            <form action="aeroport_inge_vol.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="action" value="delete">
              <input type="image" src = "../images/button_retour.png" width="105%">
            </form>
          </td>
        </tr>
      </table>
    </div>

    <?php
        if($_POST['choix'] == "vol")
        {
    ?>
          <div align="center">
            <h3>Numéro du vol</h3>
            <form action="aeroport_delete_inge_vol.php" method="post">
              <table width="30%" class="tableau">
                <tr>
                  <td align="center">
                    <input type="number" name="vol" min="1" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="image" src = "../images/button_submit.png" width="35%">
                  </td>
                </tr>
              </table>
            </form>
          </div>
      <?php
        }
        else if($_POST['choix'] == "avion")
        {
      ?>
          <div align="center">
            <h3>Numéro de l'avion</h3>
            <form action="aeroport_delete_inge_avion.php" method="post">
              <table width="30%" class="tableau">
                <tr>
                  <td align="center">
                    <input type="number" name="avion" min="1" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="image" src = "../images/button_submit.png" width="35%">
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
            <h3>Nom de la compagnie</h3>
            <form action="aeroport_delete_inge_compagnie.php" method="post">
              <table width="30%" class="tableau">
                <tr>
                  <td align="center">
                    <input type="text" name="compagnie" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="image" src = "../images/button_submit.png" width="35%">
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
