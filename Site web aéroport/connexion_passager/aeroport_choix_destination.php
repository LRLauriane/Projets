<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Choix de la destination</title>
  </head>
  <body>
    <div align="right">
      <table width="10%">
        <tr>
          <td align="right">
            <form action="aeroport_compte_passager.php" method="post">
              <input type="hidden" name="id_passager" value="<?php echo $_POST['id_passager'] ?>">
              <input type="image" src = "../images/button_retour.png" width="105%">
            </form>
          </td>
        </tr>
      </table>
    </div>
    <div align="center">
      <h3>Choissisez une destination : </h3>
      <form  id = "select" action="aeroport_reserver_vol.php" method="post">
      <table width="30%" class="tableau">
        <tr>
          <td align = "center">
            <br>
            <select form = "select" name="arrivee_vol" required>
              <?php

              $link = new mysqli('localhost', 'admin', 'Admin75!');
              if ($link->connect_errno) {
              die ("Erreur de connexion : errno: " . $link->errno .
                                "error:" . $link->error);
              }

              $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

              $res = $link->query("SELECT arrivee FROM Vol GROUP BY arrivee ORDER BY arrivee")
              or die("Search Error:" .$link->error());

              $iterator = $res->fetch_assoc();

              while($iterator)
              {
                ?>
                <option value = "<?php echo $iterator['arrivee']?>">
                <?php
                echo '<p>' . $iterator['arrivee'] . '</p>';
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
            <input type="hidden" name="id_passager" value="<?php echo $_POST['id_passager'] ?>">
            <input type="image" src = "../images/button_submit.png" width="35%">
          </td>
        </tr>
      </table>
     </form>
    </div>
  </body>
</html>
