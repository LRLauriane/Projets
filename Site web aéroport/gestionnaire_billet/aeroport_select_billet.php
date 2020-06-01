<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Sélection</title>
  </head>
  <body>
    <?php
      $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
      if ($link->connect_errno) {
      die ("Erreur de connexion : errno: " . $link->errno .
                        "error:" . $link->error);
      }

      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

      if($_POST['choix'] == "vol")
      {
        $vol = $link->query("SELECT * FROM Vol") or die("Select error : ".$link->error);
        $iterator = $vol->fetch_assoc();
    ?>
        <div align="right">
          <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
            <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
            <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
            <input type="image" width = "11%" src="../images/button_choice.png">
          </form>
        </div>

        <div align="center">

          <h1>Les vols</h1>

          <table width = "100%" class="tableau">
            <tr>
              <th width = "13%"> Numéro de vol </th>
              <th width = "14%"> Départ </th>
              <th width = "13%"> Arrivée </th>
              <th width = "14%"> Date </th>
              <th width = "13%"> Horaires </th>
              <th width = "14%"> Escale </th>
              <th width = "13%"> Porte </th>
              <th width = "14%"> Avion </th>
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
                <td align="center" width = "13%"><?php echo $iterator['num_vol']?></td>
                <td align="center" width = "14%"><?php echo $iterator['depart']?></td>
                <td align="center" width = "13%"><?php echo $iterator['arrivee']?></td>
                <td align="center" width = "14%"><?php echo $iterator['date_vol']?></td>
                <td align="center" width = "13%"><?php echo $iterator['horaires']?></td>
                <td align="center" width = "14%"><?php echo $iterator['escale']?></td>
                <td align="center" width = "13%"><?php echo $iterator['porte']?></td>
                <td align="center" width = "14%"><?php echo $iterator['id_avion']?></td>
              </tr>
            </table>
          </div>
      <?php
          $iterator = $vol->fetch_assoc();
        }
      }
      else {
        $billet = $link->query("SELECT * FROM gestion_billet ORDER BY num_vol") or die("Select error : ".$link->error);
        $iterator = $billet->fetch_assoc();
    ?>
        <div align="right">
          <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
            <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
            <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
            <input type="image" width = "11%" src="../images/button_choice.png">
          </form>
        </div>

        <div align="left">
          <form action="aeroport_select_billet_par_vol.php" method="post">
            <table class="tableau" width = "20%">
              <tr>
                <td align = "center">
                  <h3 class="recherche">Sur quel vol ?</h3>
                </td>
              </tr>
              <tr>
                <td align = center>
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                  <input type="text" name="vol">
                </td>
              </tr>
              <tr>
                <td align ="center">
                  <input type="image" width = "50%" src="../images/button_advance.png">
                </td>
              </tr>
            </table>
          </form>
        </div>

        <div align="center">

          <h1>Les billets</h1>

          <table width = "100%" class="tableau">
            <tr>
              <th width = "7%"> Passager </th>
              <th width = "8%"> Passeport </th>
              <th width = "7%"> Billet </th>
              <th width = "8%"> Date de réservation </th>
              <th width = "7%"> Siège </th>
              <th width = "8%"> Classe </th>
              <th width = "7%"> Prix </th>
              <th width = "8%"> Vol </th>
              <th width = "7%"> Depart </th>
              <th width = "8%"> Arrivee </th>
              <th width = "7%"> Date </th>
              <th width = "8%"> Horaires </th>
              <th width = "7%"> Compagnie </th>
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
                <td align="center" width = "7%"><?php echo $iterator['id_passager']?></td>
                <td align="center" width = "8%"><?php echo $iterator['num_passeport']?></td>
                <td align="center" width = "7%"><?php echo $iterator['num_billet']?></td>
                <td align="center" width = "8%"><?php echo $iterator['date_reservation']?></td>
                <td align="center" width = "7%"><?php echo $iterator['siege']?></td>
                <td align="center" width = "8%"><?php echo $iterator['classe']?></td>
                <td align="center" width = "7%"><?php echo $iterator['prix']?></td>
                <td align="center" width = "8%"><?php echo $iterator['num_vol']?></td>
                <td align="center" width = "7%"><?php echo $iterator['depart']?></td>
                <td align="center" width = "8%"><?php echo $iterator['arrivee']?></td>
                <td align="center" width = "7%"><?php echo $iterator['date_vol']?></td>
                <td align="center" width = "8%"><?php echo $iterator['horaires']?></td>
                <td align="center" width = "7%"><?php echo $iterator['Compagnie']?></td>

              </tr>
            </table>
          </div>
      <?php
          $iterator = $billet->fetch_assoc();
        }
      }
      $link->close();
    ?>
  </body>
</html>
