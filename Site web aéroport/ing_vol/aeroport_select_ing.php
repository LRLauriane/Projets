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
          <table width="30%">
            <tr>
              <td align="right">
                <form action="aeroport_select_advanced.php" method="post">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                  <input type="image" src = "../images/button_advance.png" width="70%">
                </form>
              </td>
              <td align = "center">
                <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="image" src = "../images/button_choice.png" width="70%">
                </form>
              </td>
            </tr>
          </table>
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
      else if($_POST['choix'] == "avion")
      {
        $avion = $link->query("SELECT * FROM Avion") or die("Select error : ".$link->error);
        $iterator = $avion->fetch_assoc();
    ?>
        <div align="right">
          <table width="30%">
            <tr>
              <td align="right">
                <form action="aeroport_select_advanced.php" method="post">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                  <input type="image" src = "../images/button_advance.png" width="70%">
                </form>
              </td>
              <td align = "center">
                <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="image" src = "../images/button_choice.png" width="70%">
                </form>
              </td>
            </tr>
          </table>
        </div>

        <div align="center">

          <h1>Les avions</h1>

          <table width = "100%" class="tableau">
            <tr>
              <th width = "13%"> Numéro de l'avion </th>
              <th width = "14%"> Capacité </th>
              <th width = "13%"> Compagnie </th>
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
                <td align="center" width = "13%"><?php echo $iterator['id_avion']?></td>
                <td align="center" width = "14%"><?php echo $iterator['capacite']?></td>
                <td align="center" width = "13%"><?php echo $iterator['nom']?></td>
              </tr>
            </table>
          </div>
      <?php
          $iterator = $avion->fetch_assoc();
        }
      }else if($_POST['choix']=="compagnie")
      {
        $compagnie = $link->query("SELECT * FROM Compagnie") or die("Select error : ".$link->error);
        $iterator = $compagnie->fetch_assoc();
    ?>
        <div align="right">
          <table width="30%">
            <tr>
              <td align="right">
                <form action="aeroport_select_advanced.php" method="post">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                  <input type="image" src = "../images/button_advance.png" width="70%">
                </form>
              </td>
              <td align = "center">
                <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="image" src = "../images/button_choice.png" width="70%">
                </form>
              </td>
            </tr>
          </table>
        </div>

        <div align="center">

          <h1>Les compagnies</h1>

          <table width = "100%" class="tableau">
            <tr>
              <th width = "13%"> Nom </th>
              <th width = "14%"> Pays </th>
              <th width = "13%"> Nombre d'avions </th>
              <th width = "14%"> Nombre de vols par semaine </th>
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
                <td align="center" width = "13%"><?php echo $iterator['nom']?></td>
                <td align="center" width = "14%"><?php echo $iterator['pays']?></td>
                <td align="center" width = "13%"><?php echo $iterator['nbre_avions']?></td>
                <td align="center" width = "14%"><?php echo $iterator['nbre_vols_semaine']?></td>
              </tr>
            </table>
          </div>
      <?php
          $iterator = $compagnie->fetch_assoc();
        }
      }else if($_POST['choix']=="gestion")
      {
        $gestion = $link->query("SELECT * FROM gestion_vols") or die("Select error : ".$link->error);
        $iterator = $gestion->fetch_assoc();
    ?>
        <div align="right">
          <table width="30%">
            <tr>
              <td align="right">
                <form action="aeroport_select_advanced.php" method="post">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                  <input type="image" src = "../images/button_advance.png" width="70%">
                </form>
              </td>
              <td align = "center">
                <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="image" src = "../images/button_choice.png" width="70%">
                </form>
              </td>
            </tr>
          </table>
        </div>

        <div align="center">

          <h1>Vue complète des vols</h1>

          <table width = "100%" class="tableau">
            <tr>
              <th width = "8%"> Nom </th>
              <th width = "9%"> Numéro de vol </th>
              <th width = "8%"> Départ </th>
              <th width = "9%"> Arrivée </th>
              <th width = "8%"> Date </th>
              <th width = "9%"> Horaires </th>
              <th width = "8%"> Escale </th>
              <th width = "9%"> Porte </th>
              <th width = "8%"> Avion </th>
              <th width = "9%"> Pays </th>
              <th width = "8%"> Nombre de vols par semaine </th>
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
                <td align="center" width = "8%"><?php echo $iterator['nom']?></td>
                <td align="center" width = "9%"><?php echo $iterator['num_vol']?></td>
                <td align="center" width = "8%"><?php echo $iterator['depart']?></td>
                <td align="center" width = "9%"><?php echo $iterator['arrivee']?></td>
                <td align="center" width = "8%"><?php echo $iterator['date_vol']?></td>
                <td align="center" width = "9%"><?php echo $iterator['horaires']?></td>
                <td align="center" width = "8%"><?php echo $iterator['escale']?></td>
                <td align="center" width = "9%"><?php echo $iterator['porte']?></td>
                <td align="center" width = "8%"><?php echo $iterator['id_avion']?></td>
                <td align="center" width = "9%"><?php echo $iterator['pays']?></td>
                <td align="center" width = "8%"><?php echo $iterator['nbre_vols_semaine']?></td>
              </tr>
            </table>
          </div>
      <?php
          $iterator = $gestion->fetch_assoc();
        }
      }
      else {
        $number = $link->query("SELECT * FROM nb_passager_vol") or die("Select error : ".$link->error);
        $iterator = $number->fetch_assoc();
    ?>
        <div align="right">
          <table width="30%">
              <td align = "right">
                <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
                  <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                  <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                  <input type="image" src = "../images/button_choice.png" width="40%">
                </form>
              </td>
            </tr>
          </table>
        </div>

        <div align="center">

          <h1>Nombre de passagers par vol</h1>

          <table width = "100%" class="tableau">
            <tr>
              <th width = "13%"> Numéro de vol </th>
              <th width = "13%"> Nombre de passagers </th>
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
                <td align="center" width = "13%"><?php echo $iterator['nb_passagers']?></td>
              </tr>
            </table>
          </div>
      <?php
          $iterator = $number->fetch_assoc();
        }
      }
    ?>
  </body>
</html>
