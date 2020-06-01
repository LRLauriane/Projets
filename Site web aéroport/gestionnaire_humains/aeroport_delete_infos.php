<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Choix de champ</title>
  </head>
  <body>
    <div align="right">
      <table width="30%">
        <tr>
          <td align="right">
            <form action="aeroport_gestionnaire_humains.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="action" value="delete">
              <input type="image" src = "../images/button_retour.png" width="35%">
            </form>
          </td>
        </tr>
      </table>
    </div>

    <form id ="delete" action="aeroport_delete_humains.php" method="post">
    <?php
    $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
    if ($link->connect_errno) {
    die ("Erreur de connexion : errno: " . $link->errno .
                      "error:" . $link->error);
    }

    $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

    if($_POST['choix']=="employe")
    {
    ?>
      <div align="center">
        <br>
        <table width="30%" class="tableau">
          <tr>
            <td align="center">
              Numéro de l'employé : <br><br>
              <select form = "delete" name="employe" required>
                <?php
                $res = $link->query("SELECT num_employe FROM Employe GROUP BY num_employe ORDER BY num_employe")
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
              <input type="image" src = "../images/button_submit.png" width="30%">
            </td>
          </tr>
        </table>
      </div>
    <?php
    }
    else if($_POST['choix']=="passager")
    {
    ?>
      <div align="center">
        <table width="30%" class="tableau">
          <tr>
            <td align="center">
              <br>
              Numéro du passager :<br><br>
              <select form = "delete" name="passager" required>
                <?php
                $res = $link->query("SELECT id_passager FROM Passager GROUP BY id_passager ORDER BY id_passager")
                or die("Search Error:" .$link->error());

                $iterator = $res->fetch_assoc();

                while($iterator)
                {
                  ?>
                  <option value = "<?php echo $iterator['id_passager']?>">
                  <?php
                  echo '<p>' . $iterator['id_passager'] . '</p>';
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
              <input type="image" src = "../images/button_submit.png" width="30%">
            </td>
          </tr>
        </table>
      </div>
    <?php
    }
    else if($_POST['choix']=="travaille")
    {
    ?>
      <div align="center">
        <h3>Selon quel champ ?</h3>
        <table width="30%" class="tableau">
          <tr>
            <td align="center">
              Numéro de vol :
              <input type="radio" name="travaille" value="vol" required><br>
              Numéro d'employé :
              <input type="radio" name="travaille" value="employe" required><br>
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
          <h3>Selon quel champ ?</h3>
          <table width="30%" class="tableau">
            <tr>
              <td align="center">
                Numéro de bagage :
                <input type="radio" name="bagage" value="bagage" required><br>
                Numéro de billet :
                <input type="radio" name="bagage" value="billet" required><br>
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
