<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Billets par vol</title>
  </head>
  <body>
    <?php
      $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
      if ($link->connect_errno) {
      die ("Erreur de connexion : errno: " . $link->errno .
                        "error:" . $link->error);
      }

      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

      $num_vol = $_POST['vol'];
      $billet = $link->query("SELECT * FROM gestion_billet WHERE num_vol = $num_vol") or die("Select error : ".$link->error);
      $iterator = $billet->fetch_assoc();

      if(empty($iterator))
      {
    ?>
        <div align="right">
          <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
            <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
            <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
            <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
            <input type="image" width = "11%" src="../images/button_choice.png">
          </form>
        </div>
    <?php
      }
    ?>
    <div align="right">
      <table width="30%">
        <tr>
          <td align="right">
            <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="image" width = "70%" src="../images/button_choice.png">
            </form>
          </td>
          <td align="center">
            <form action="aeroport_select_billet.php" method="post">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="hidden" name="choix" value="billet">
              <input type="image" width = "70%" src="../images/button_retour.png">
            </form>
          </td>
        </tr>
      </table>
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

    $link->close();
  ?>
  </body>
</html>
