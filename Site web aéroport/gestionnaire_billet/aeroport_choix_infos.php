<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Choix</title>
  </head>
  <body>
      <?php
      $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
      if ($link->connect_errno) {
      die ("Erreur de connexion : errno: " . $link->errno .
                        "error:" . $link->error);
      }

      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

          if($_POST['choix'] == "billet")
          {
      ?>
            <div align="right">
              <table width = "30%">
                <tr>
                  <td align="right">
                    <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
                      <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                      <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                      <input type="image" width = "75%" src="../images/button_choice.png">
                    </form>
                  </td>
                  <td align="center">
                    <form action="aeroport_gestionnaire_billet.php" method="post">
                      <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                      <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                      <input type="hidden" name="action" value="delete">
                      <input type="image" src = "../images/button_retour.png" width="75%">
                    </form>
                  </td>
                </tr>
              </table>
            </div>
            <br>
            <div align = "center">
              <form id = "delete" action="aeroport_delete_billet.php" method="post">
                <table width = "30%" class = "tableau">
                  <tr>
                    <td align="center">
                      <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                      <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                      <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                  </tr>
                  <tr>
                    <td align = "center">
                      Numéro de billet : <br><br>
                      <input type="number" name="billet" min=1 required>
                      <br><br>
                    </td>
                  <tr>
                    <td align = "center">
                    <input type="image" width = "30%" src="../images/button_submit.png">
                    </td>
                  </tr>
                </table>
              </form>
            </div>
      <?php
          }
          else {
      ?>
                <div align="right">
                  <table width = "30%">
                    <tr>
                      <td align="right">
                        <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
                          <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                          <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                          <input type="image" width = "75%" src="../images/button_choice.png">
                        </form>
                      </td>
                      <td align="center">
                        <form action="aeroport_gestionnaire_billet.php" method="post">
                          <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                          <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                          <input type="hidden" name="action" value="delete">
                          <input type="image" src = "../images/button_retour.png" width="75%">
                        </form>
                      </td>
                    </tr>
                  </table>
                </div>

                <div align = "center">
                  <form id = "delete" action="aeroport_delete_billet.php" method="post">
                    <table width = "30%" class="tableau">
                      <tr>
                        <td align="center">
                          <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                          <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                          <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                      </tr>
                      <tr>
                        <td align = "center">
                          Numéro de vol : <br><br>
                          <select form = "delete" name="vol" required>
                            <?php

                            $res = $link->query("SELECT num_vol FROM Billet GROUP BY num_vol ORDER BY num_vol")
                            or die("Search Error:" .$link->error());

                            $iterator = $res->fetch_assoc();

                            while($iterator)
                            {
                              ?>
                              <option value = "<?php echo $iterator['num_vol']?>">
                              <?php
                              echo '<p>' . $iterator['num_vol'] . '</p>';
                              ?>
                              </option>
                              <?php
                              $iterator = $res->fetch_assoc();
                            }
                            $res->free();
                            ?>"
                            >
                          </select>
                          <br><br>
                        </td>
                      <tr>
                        <td align = "center">
                          <input type="image" width = "35%" src="../images/button_submit.png">
                        </td>
                      </tr>
                    </table>
                  </form>
                </div>
      <?php
          }
          $link->close();
      ?>

  </body>
</html>
