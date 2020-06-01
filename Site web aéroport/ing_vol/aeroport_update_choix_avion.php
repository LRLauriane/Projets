<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Update d'un avion</title>
  </head>
  <body>
    <div align="right">
      <table width="10%">
        <tr>
          <td align="right">
            <form action="aeroport_update_ing.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
              <input type="image" src = "../images/button_retour.png" width="105%">
            </form>
          </td>
        </tr>
      </table>
    </div>
    <?php
        if($_POST['choice']=="capacite")
        {
    ?>
          <div align="center">
            <h3>Complétez les champs suivants :</h3>
            <form action="aeroport_update_ing_avion.php" method="post">
              <table width="30%" class="tableau">
                <tr>
                  <td align="center">
                    Capacité :
                    <br>
                    <br>
                    <input type="text" name="capacite" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    Numéro d'avion :
                    <br>
                    <br>
                    <input type="number" name="avion" min ="1" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choice" value="<?php echo $_POST['choice'] ?>">
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
            <h3>Complétez les champs suivants :</h3>
            <form id = "maj" action="aeroport_update_ing_avion.php" method="post">
              <table width="30%" class="tableau">
                <tr>
                  <td align="center">
                    Compagnie :<br><br>
                    <select form = "maj" name="compagnie" required>
                      <?php
                      $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
                      if ($link->connect_errno) {
                      die ("Erreur de connexion : errno: " . $link->errno .
                                        "error:" . $link->error);
                      }

                      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

                      $res = $link->query("SELECT nom FROM Compagnie GROUP BY nom ORDER BY nom")
                      or die("Search Error:" .$link->error());

                      $iterator = $res->fetch_assoc();

                      while($iterator)
                      {
                        ?>
                        <option value = "<?php echo $iterator['nom']?>">
                        <?php
                        echo '<p>' . $iterator['nom'] . '</p>';
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
                    Numéro d'avion :
                    <br>
                    <br>
                    <input type="number" name="avion" min="1" required>
                    <br>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choice" value="<?php echo $_POST['choice'] ?>">
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
