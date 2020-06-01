<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Réserver</title>
  </head>
  <div align="right">
    <table class="tableau" width ="20%">
      <form id = "select" action="aeroport_choix_billet.php" method="post">
        <tr>
          <td align="center">
            <h3 class = "recherche"> Choix du billet</h3>
            <br>
            <select form = "select" name="choix" required>
              <?php

              $link = new mysqli('localhost', 'admin', 'Admin75!');
              if ($link->connect_errno) {
              die ("Erreur de connexion : errno: " . $link->errno .
                                "error:" . $link->error);
              }

              $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

              $arrivee = $_POST['arrivee_vol'];

              $res = $link->query("SELECT num_billet FROM Billet WHERE date_reservation IS NULL AND num_vol IN (SELECT num_vol FROM Vol WHERE arrivee = '$arrivee')") or die("Search Error:" .$link->error());
              $iterator = $res->fetch_assoc();

              while($iterator)
              {
                ?>
                <option value = "<?php echo $iterator['num_billet']?>">
                <?php
                echo '<p>' . $iterator['num_billet'] . '</p>';
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
        </tr>
        <tr>
          <td align="center">
            <input type="hidden" name="id_passager" value="<?php echo $_POST['id_passager'] ?>">
            <input type="image" src = "../images/button_submit.png" width="50%">
          </td>
        </tr>
      </form>
    </table>
  </div>
  <body>
    <?php
    $billet = $link->query("SELECT * FROM Billet WHERE date_reservation IS NULL AND num_vol IN (SELECT num_vol FROM Vol WHERE arrivee = '$arrivee')") or die("Select error : ".$link->error);
    $iterator = $billet->fetch_assoc();

    ?>
    <div align="center">

      <h1>Réserver un vol</h1>

      <table width = "100%" class="tableau">
        <tr>
          <th width = "7%"> Billet </th>
          <th width = "7%"> Siège </th>
          <th width = "8%"> Classe </th>
          <th width = "7%"> Prix </th>
          <th width = "8%"> Vol </th>
          <th width = "7%"> Date </th>
          <th width = "8%"> Horaires </th>
          <th width = "7%"> Escale </th>
        </tr>
      </table>
    </div>
  <?php
    while($iterator)
    {
  ?>
      <div align="center">
        <table width="100%" class="tableau">
          <tr>
            <td align="center" width = "7%"><?php echo $iterator['num_billet']?></td>
            <td align="center" width = "7%"><?php echo $iterator['siege']?></td>
            <td align="center" width = "8%"><?php echo $iterator['classe']?></td>
            <td align="center" width = "7%"><?php echo $iterator['prix']?></td>
            <td align="center" width = "8%"><?php echo $iterator['num_vol']?></td>
            <td align="center" width = "7%"><?php
              $num = $iterator['num_vol'];
              $date = $link->query("SELECT date_vol FROM Vol WHERE num_vol = $num") or die("Select error : ".$link->error);
              $iterater = $date->fetch_assoc();
              echo $iterater['date_vol'];
            ?></td>
            <td align="center" width = "8%"><?php
              $num = $iterator['num_vol'];
              $date = $link->query("SELECT horaires FROM Vol WHERE num_vol = $num") or die("Select error : ".$link->error);
              $iterater = $date->fetch_assoc();
              echo $iterater['horaires'];
            ?></td>
            <td align="center" width = "7%"><?php
              $num = $iterator['num_vol'];
              $date = $link->query("SELECT escale FROM Vol WHERE num_vol = $num") or die("Select error : ".$link->error);
              $iterater = $date->fetch_assoc();
              echo $iterater['escale'];
            ?></td>

          </tr>
        </table>
      </div>
  <?php
      $iterator = $billet->fetch_assoc();
    }

    $link->close();
    ?>
  </body>
</html>
