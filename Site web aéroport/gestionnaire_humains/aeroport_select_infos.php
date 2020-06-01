<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Choix du champ</title>
  </head>
  <body>
    <div align="right">
      <table width="30%">
        <tr>
          <td align="right">
            <form action="aeroport_gestionnaire_humains.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="action" value="select">
              <input type="image" src = "../images/button_retour.png" width="35%">
            </form>
          </td>
        </tr>
      </table>
    </div>

    <form class="" action="aeroport_select_enter.php" method="post">
      <div align="center">
        <h3>Sur quel champ ?</h3>
        <table width="30%" class="tableau">
        <?php
        if($_POST['choix']=="employe")
        {
        ?>
          <tr>
            <td align = "center">
              Numéro d'employé : <input type="radio" name="employe" value="numero"><br>
              Numéro d'équipage : <input type="radio" name="employe" value="equipage"><br>
              Rôle : <input type="radio" name="employe" value="role"><br>
              Nationalité : <input type="radio" name="employe" value="nationalite"><br>
              Sexe : <input type="radio" name="employe" value="genre"><br>
            </td>
          </tr>
          <tr>
            <td align = "center">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_submit.png" width="30%">
            </td>
          </tr>
        <?php
        }
        else if($_POST['choix']=="passager")
        {
        ?>
          <tr>
            <td align = "center">
              Numéro de passager : <input type="radio" name="passager" value="numero"><br>
              Numéro de passeport : <input type="radio" name="passager" value="passeport"><br>
              Nationalité : <input type="radio" name="passager" value="nationalite"><br>
              Sexe : <input type="radio" name="passager" value="genre"><br>
            </td>
          </tr>
          <tr>
            <td align = "center">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_submit.png" width="30%">
            </td>
          </tr>
        <?php
        }
        else if($_POST['choix']=="travaille")
        {
        ?>
          <tr>
            <td align = "center">
              Numéro de vol : <input type="radio" name="travaille" value="vol"><br>
              Numéro d'employé : <input type="radio" name="travaille" value="employe"><br>
            </td>
          </tr>
          <tr>
            <td align = "center">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_submit.png" width="30%">
            </td>
          </tr>
        <?php
        }
        else
        {
        ?>
          <tr>
            <td align = "center">
              Numéro de bagage : <input type="radio" name="bagage" value="bagage"><br>
              Numéro de billet : <input type="radio" name="bagage" value="billet"><br>
            </td>
          </tr>
          <tr>
            <td align = "center">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_submit.png" width="30%">
            </td>
          </tr>
        <?php
        }
        ?>
        </table>
      </div>
    </form>
  </body>
</html>
