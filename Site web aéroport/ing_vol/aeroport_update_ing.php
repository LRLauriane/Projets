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
              <input type="hidden" name="action" value="update">
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
            <h3>Sur quels champs ?</h3>
            <form action="aeroport_update_choix_vol.php" method="post">
              <table width="30%" class="tableau">
                <tr>
                  <td align="center">
                    Horaires : <input type="radio" name="choice" value="horaires" required> <br>
                    Date : <input type="radio" name="choice" value="date" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                    <input type="image" src = "../images/button_submit.png" width="30%">
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
            <h3>Sur quels champs ?</h3>
            <form action="aeroport_update_choix_avion.php" method="post">
              <table width="30%" class="tableau">
                <tr>
                  <td align="center">
                    Capacité : <input type="radio" name="choice" value="capacite" required> <br>
                    Compagnie : <input type="radio" name="choice" value="compagnie" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
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
            <h3>Sur quels champs ?</h3>
            <form action="aeroport_update_choix_compagnie.php" method="post">
              <table width="30%" class="tableau">
                <tr>
                  <td align="center">
                    Nombre d'avions : <input type="radio" name="choice" value="nb_avions" required> <br>
                    Nombre de vols à la semaine : <input type="radio" name="choice" value="nb_vols" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
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
