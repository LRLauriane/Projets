<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Opérations</title>
  </head>
  <body>
    <div align="right">
      <table width="30%">
        <tr>
          <td align="right">
            <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="image" src = "../images/button_choice.png" width="35%">
            </form>
          </td>
        </tr>
      </table>
    </div>
    <div align="center">
      <h1>Bienvenue</h1><br>
    <?php
      if($_POST['action']=="insert")
      {
    ?>
        <form action="aeroport_insert_infos.php" method="post">
          <h3>Sur quelle table ?</h3>
          <br>
          <br>
          <table width="30%" class="tableau">
            <tr>
              <td align="center">
                Employe <input type="radio" name="choix" value="employe" required><br>
                Passager <input type="radio" name="choix" value="passager" required><br>
                Bagage <input type="radio" name="choix" value="bagage" required> <br>
                Travaille <input type="radio" name="choix" value="travaille" required>
                <br>
                <br>
              </td>
            </tr>
            <tr>
              <td align = "center">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="action" value="<?php echo $_POST['action'] ?>">
                <input type="image" src = "../images/button_submit.png" width="30%">
              </td>
            </tr>
          </table>
        </form>
      </div>
    <?php
      }
      else if($_POST['action']=="update")
      {
    ?>
        <form action="aeroport_update_infos.php" method="post">
          <h3>Sur quelle table ?</h3>
          <br>
          <br>
          <table width="30%" class="tableau">
            <tr>
              <td align="center">
                Employe <input type="radio" name="choix" value="employe" required><br>
                Passager <input type="radio" name="choix" value="passager" required>
                <br>
                <br>
              </td>
            </tr>
            <tr>
              <td align = "center">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="action" value="<?php echo $_POST['action'] ?>">
                <input type="image" src = "../images/button_submit.png" width="30%">
              </td>
            </tr>
          </table>
        </form>
      </div>
    <?php
      }
      else if($_POST['action']=="delete")
      {
    ?>
          <form action="aeroport_delete_infos.php" method="post">
            <h3>Sur quelle table ?</h3>
            <br>
            <br>
            <table width="30%" class="tableau">
              <tr>
                <td align="center">
                  Employe <input type="radio" name="choix" value="employe" required><br>
                  Passager <input type="radio" name="choix" value="passager" required><br>
                  Bagage <input type="radio" name="choix" value="bagage" required> <br>
                  Travaille <input type="radio" name="choix" value="travaille" required>
                  <br>
                  <br>
                </td>
              </tr>
              <tr>
                <td align = "center">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="hidden" name="action" value="<?php echo $_POST['action'] ?>">
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
              <form action="aeroport_select_infos.php" method="post">
                <h3>Sur quelle table ?</h3>
                <br>
                <br>
                <table width="30%" class="tableau">
                  <tr>
                    <td align="center">
                      Employe <input type="radio" name="choix" value="employe" required><br>
                      Passager <input type="radio" name="choix" value="passager" required><br>
                      Bagage <input type="radio" name="choix" value="bagage" required> <br>
                      Travaille <input type="radio" name="choix" value="travaille" required>
                      <br>
                      <br>
                    </td>
                  </tr>
                  <tr>
                    <td align = "center">
                      <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                      <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                      <input type="hidden" name="action" value="<?php echo $_POST['action'] ?>">
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
