<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Don des informations</title>
  </head>
  <body>
    <div align="right">
      <table width="30%">
        <tr>
          <td align="right">
            <form action="aeroport_gestionnaire_humains.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="action" value="update">
              <input type="image" src = "../images/button_retour.png" width="35%">
            </form>
          </td>
        </tr>
      </table>
    </div>
    <form action="aeroport_update.php" method="post">
    <?php
      if($_POST['choix']=="passager")
      {
        ?>
        <div align="center">
          <h3>Entrez le nouveau numéro de passeport</h3>
          <table width="30%" class="tableau">
            <tr>
              <td align="center">
                Nouveau numéro de passeport : <br><br>
                <input type="number" name="passeport" min="0" required><br><br>
              </td>
            </tr>
            <tr>
              <td align="center">
                Numéro du passager : <br><br>
                <input type="number" name="id_passager" min="1" required><br><br>
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
        </div>
        <?php
      }
      else
      {
        ?>
        <div align="center">
          <h3>Entrez le nouveau numéro d'équipage</h3>
          <table width="30%" class="tableau">
            <tr>
              <td align="center">
                Nouveau numéro d'équipage : <br><br>
                <input type="number" name="equipage" min="0" required><br><br>
              </td>
            </tr>
            <tr>
              <td align="center">
                Numéro de l'employe : <br><br>
                <input type="number" name="num_employe" min="0" required><br><br>
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
        </div>
        <?php
      }
      ?>
    </form>
  </body>
</html>
