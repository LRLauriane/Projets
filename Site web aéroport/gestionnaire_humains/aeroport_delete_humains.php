<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Supression</title>
  </head>
  <body>
    <?php
    $link = new mysqli('localhost', 'admin', 'Admin75!');
    if ($link->connect_errno) {
    die ("Erreur de connexion : errno: " . $link->errno .
                      "error:" . $link->error);
    }

    $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

    if($_POST['choix']=="employe")
    {
      $num = $_POST['employe'];

      $res = $link->query("SELECT * FROM Employe WHERE num_employe=$num") or die("Select Error:" .$link->error());
      $iterator = $res->fetch_assoc();

      if(empty($iterator))
      {
          $link->close();
      ?>
          <div align="center">
            <h3>Le numéro d'employé n'existe pas.</h3>
            <form action="aeroport_delete_infos.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_retour.png" width="11%">
            </form>
          </div>
      <?php
        exit();
      }

      $link->query("DELETE FROM Travaille WHERE num_employe=$num") or die("Delete Error:" .$link->error());
      $link->query("DELETE FROM Employe WHERE num_employe=$num") or die("Delete Error:" .$link->error());
      $link->close();
    ?>
      <div align="center">
        <table>
          <h3>La supression a été faite avec succès.</h3>
          <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
            <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
            <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
            <input type="image" src = "../images/button_choice.png" width="11%">
          </form>
        </table>
      </div>
    <?php
    }
    else if($_POST['choix']=="passager")
    {
      $num = $_POST['passager'];

      $res = $link->query("SELECT * FROM Passager WHERE id_passager=$num") or die("Select Error:" .$link->error());
      $iterator = $res->fetch_assoc();

      if(empty($iterator))
      {
          $link->close();
      ?>
          <div align="center">
            <h3>Le numéro de passager n'existe pas.</h3>
            <form action="aeroport_delete_infos.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_retour.png" width="11%">
            </form>
          </div>
      <?php
        exit();
      }

      $link->query("DELETE FROM Bagage WHERE num_billet IN (SELECT num_billet FROM Billet WHERE id_passager = $num)") or die("Delete Error:" .$link->error());
      $link->query("DELETE FROM Billet WHERE id_passager=$num") or die("Delete Error:" .$link->error());
      $link->query("DELETE FROM Compte WHERE id_passager=$num") or die("Delete Error:" .$link->error());
      $link->query("DELETE FROM Passager WHERE id_passager=$num") or die("Delete Error:" .$link->error());
      $link->close();
      ?>
      <div align="center">
        <table>
          <h3>La supression a été faite avec succès.</h3>
          <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
            <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
            <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
            <input type="image" src = "../images/button_choice.png" width="11%">
          </form>
        </table>
      </div>
      <?php
    }
    else if($_POST['choix']=="travaille")
    {
    ?>
    <div align="right">
      <table width="30%">
        <tr>
          <td align="right">
            <form action="aeroport_delete_infos.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_retour.png" width="35%">
            </form>
          </td>
        </tr>
      </table>
    </div>
    <?php
        if($_POST['travaille']=='vol')
        {
          ?>
          <div align="center">
            <form id = "delete" action="aeroport_delete_humains_bis.php" method="post">
              <table width="30%" class="tableau">
                <tr>
                  <td align = "center">
                    <br>
                    Numéro de vol :<br><br>
                    <select form = "delete" name="vol" required>
                      <?php
                      $res = $link->query("SELECT num_vol FROM Travaille GROUP BY num_vol ORDER BY num_vol")
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
                    <br><br>
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
             </form>
            </div>
          <?php
        }
        else {
          ?>
          <div align="center">
            <form id = "delete" action="aeroport_delete_humains_bis.php" method="post">
              <table width="30%" class="tableau">
                <tr>
                  <td align = "center">
                    <br>
                    Numéro d'employé :<br><br>
                    <select form = "delete" name="employe" required>
                      <?php
                      $res = $link->query("SELECT num_employe FROM Travaille GROUP BY num_employe ORDER BY num_employe")
                      or die("Search Error:" .$link->error());

                      $iterator = $res->fetch_assoc();

                      while($iterator)
                      {
                        ?>
                        <option value = "<?php echo $iterator['num_employe']?>">
                        <?php
                        echo '<p>' . $iterator['num_employe'] . '</p>';
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
                    <br><br>
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
             </form>
            </div>
          <?php
        }
    }
    else {
    ?>
    <div align="right">
      <table width="30%">
        <tr>
          <td align="right">
            <form action="aeroport_delete_infos.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_retour.png" width="35%">
            </form>
          </td>
        </tr>
      </table>
    </div>

  <div align="center">
    <form id = "delete" action="aeroport_delete_humains_bis.php" method="post">
      <table width="30%" class="tableau">
      <?php
      if($_POST['bagage']=='bagage')
      {
        ?>
          <tr>
            <td align = "center">
              <br>Numéro de bagage :<br><br>
              <input type="number" name="bagage" min="1" required><br><br>
            </td>
          </tr>
      <?php
      }
      else {
      ?>
        <tr>
          <td align = "center">
            <br>Numéro de billet : <br><br>
            <input type="number" name="billet" min="1" required><br><br>
          </td>
        </tr>
      <?php
      }
      ?>
        <tr>
          <td align="center">
            <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
            <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
            <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
            <input type="image" src = "../images/button_submit.png" width="35%">
          </td>
        </tr>
      </table>
     </form>
    </div>
    <?php
    }
    ?>
      </table>
     </form>
    </div>
  </body>
</html>
