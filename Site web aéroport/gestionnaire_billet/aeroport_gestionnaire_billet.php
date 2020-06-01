<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Gestion des billets</title>
  </head>
  <body>
    <div align="right">
      <table width="30%">
        <tr>
          <td align = "right">
            <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="image" width = "35%" src="../images/button_choice.png">
            </form>
          </td>
        </tr>
      </table>
    </div>
    <div align="center">
        <?php
          if($_POST['action']=='insert')
          {
        ?>
            <h3>Insérer un nouveau billet</h3><br>
            <form id = "sign" action="aeroport_insert_billet.php" method="post">
              <table width = "30%" class="tableau">
                <tr>
                  <td align="center">
                    Numéro de siège :
                    <br>
                    <br>
                    <input type="number" name="siege" min="1" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    Classe :
                    <br>
                    Premium : <input type="radio" name="classe" value="premium" required>
                    Economique : <input type="radio" name="classe" value="economique" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    Prix :
                    <br>
                    <br>
                    <input type="number" name="prix" min="0" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    Numéro de vol :
                    <br>
                    <br>
                    <select form = "sign" name="num_vol" required>
                      <?php
                      $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
                      if ($link->connect_errno) {
                      die ("Erreur de connexion : errno: " . $link->errno .
                                        "error:" . $link->error);
                      }

                      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

                      $res = $link->query("SELECT num_vol FROM Vol GROUP BY num_vol ORDER BY num_vol")
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
                      $link->close();
                      ?>"
                      >
                    </select>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <br>
                    <input type="image" width = "30%" src="../images/button_submit.png">
                  </td>
                </tr>
              </table>
            </form>
        <?php
          }
          else if($_POST['action']=='delete')
          {
        ?>
          <h3>Supprimer un billet</h3><br>
          <div align = "center">
            <form action="aeroport_choix_infos.php" method="post">
              <table width = "30%" class="tableau">
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                </tr>
                <tr>
                  <td align = "center">
                    A partir de quelle information ?
                    <br>
                    <br>
                    Numéro du billet <input type="radio" name="choix" value="billet" required>
                    Numéro de vol <input type="radio" name="choix" value="vol" required>
                    <br>
                    <br>
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
          else if($_POST['action']=='update')
          {
        ?>
            <h3>Mettre à jour un billet</h3><br>
            <div align = "center">
              <form action="aeroport_update_billet.php" method="post">
                <table width = "30%" class="tableau">
                  <tr>
                    <td align="center">
                      <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                      <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  </tr>
                  <tr>
                    <td align = "center">
                      Numéro du billet à modifier :
                      <br>
                      <br>
                      <input type="number" name="billet" min="1" required>
                      <br>
                      <br>
                    </td>
                  </tr>
                  <tr>
                    <td align = "center">
                      Nouveau prix :
                      <br>
                      <br>
                      <input type="number" name="prix" min="0" required>
                      <br>
                      <br>
                    </td>
                  </tr>
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
            <h3>Sélectionnez une table</h3><br>
            <div align = "center">
              <form action="aeroport_select_billet.php" method="post">
                <table width = "30%" class="tableau">
                  <tr>
                    <td align="center">
                      <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                      <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  </tr>
                  <tr>
                    <td align = "center">
                      Quelle table voulez-vous voir ?
                      <br>
                      <br>
                      Vol <input type="radio" name="choix" value="vol" required>
                      Billet <input type="radio" name="choix" value="billet" required>
                      <br>
                      <br>
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
        ?>
    </div>
  </body>
</html>
