<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Recherche avancée</title>
  </head>
  <body>
    <div align="right">
      <table width="10%">
        <tr>
          <td align="right">
            <form action="aeroport_select_ing.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_retour.png" width="105%">
            </form>
          </td>
        </tr>
      </table>
    </div>
    <form action="aeroport_select_filters.php" method="post">
    <?php
        if($_POST['choix']=="vol")
        {
      ?>
          <div align="center">
            <h3>Filtrer par</h3>
            <table width="30%" class="tableau">
              <tr>
                <td align="center">
                  Numéro de vol : <input type="radio" name="choix_vol" value="num_vol" required> <br>
                  Départ : <input type="radio" name="choix_vol" value="depart" required> <br>
                  Arrivee : <input type="radio" name="choix_vol" value="arrivee" required> <br>
                  Date de vol : <input type="radio" name="choix_vol" value="date" required> <br>
                  Horaires : <input type="radio" name="choix_vol" value="horaires" required> <br>
                </td>
              </tr>
              <tr>
                <td align="center">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                  <input type="image" src = "../images/button_submit.png" width="35%">
                </td>
              </tr>
            </table>
          </div>
      <?php
        }
        else if($_POST['choix']=="avion")
        {
      ?>
          <div align="center">
            <h3>Filtrer par</h3>
            <table width="30%" class="tableau">
              <tr>
                <td align="center">
                  Numéro d'avion : <input type="radio" name="choix_avion" value="id_avion" required> <br>
                  Capacité : <input type="radio" name="choix_avion" value="capacite" required> <br>
                  Compagnie : <input type="radio" name="choix_avion" value="compagnie" required> <br>
              </tr>
              <tr>
                <td align="center">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                  <input type="image" src = "../images/button_submit.png" width="35%">
                </td>
              </tr>
            </table>
          </div>
      <?php
        }
        else if($_POST['choix']=="compagnie")
        {
       ?>
           <div align="center">
             <h3>Filtrer par</h3>
             <table width="30%" class="tableau">
               <tr>
                 <td align="center">
                   Pays : <input type="radio" name="choix_compagnie" value="pays" required> <br>
                 </td>
               </tr>
               <tr>
                 <td align="center">
                   <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                   <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                   <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                   <input type="image" src = "../images/button_submit.png" width="35%">
                 </td>
               </tr>
             </table>
           </div>
       <?php
        }
        else if($_POST['choix']=="gestion")
        {
      ?>
          <div align="center">
            <h3>Filtrer par</h3>
            <table width="30%" class="tableau">
              <tr>
                <td align="center">
                  Numéro de vol : <input type="radio" name="choix_gestion" value="num_vol"> <br>
                  Départ : <input type="radio" name="choix_gestion" value="depart"> <br>
                  Arrivee : <input type="radio" name="choix_gestion" value="arrivee"><br>
                  Date de vol : <input type="radio" name="choix_gestion" value="date"><br>
                  Horaires : <input type="radio" name="choix_gestion" value="horaires"><br>
                </td>
              </tr>
              <tr>
                <td align="center">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                  <input type="image" src = "../images/button_submit.png" width="35%">
                </td>
              </tr>
            </table>
          </div>
      <?php
        }
      ?>
  </body>
</html>
