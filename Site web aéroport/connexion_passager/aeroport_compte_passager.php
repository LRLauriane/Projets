<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Compte</title>
  </head>
  <body>
    <?php
    $id = $_POST['id_passager'];


    $link = new mysqli('localhost', 'admin', 'Admin75!');
    if ($link->connect_errno) {
    die ("Erreur de connexion : errno: " . $link->errno .
                      "error:" . $link->error);
    }

    $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

    $result=$link->query("SELECT * FROM Billet WHERE id_passager = $id") or die("Search Error:" .$link->error()); /*Récupération des billets*/
    $res=$link->query("SELECT * FROM Passager WHERE id_passager = $id") or die("Search Error:" .$link->error()); /*Récupération du nom et du prénom*/
    $data = $result->fetch_assoc();
    $info_passager = $res->fetch_assoc();

    ?>
    <div align="right">
      <table width="30%">
        <tr>
          <td align="right">
            <form action="aeroport_choix_destination.php" method="post">
              <input type="hidden" name="id_passager" value="<?php echo $_POST['id_passager']?>">
              <input type="image" src = "../images/button_reserve.png" width = "80%">
            </form>
          </td>
          <td align="center">
            <a href="aeroport_login_passager.php">
              <img src="../images/button_deco.png" alt="déconnexion" width = "80%">
            </a>
          </td>
        </tr>
      </table>
    </div>

    <div align="center">

      <h1>Bienvenue <?php echo $info_passager['nom_passager']." ".$info_passager['prenom_passager']." !"?></h1>

      <h3>Vos billets réservés</h3><br>

      <table width = "100%" class="tableau">
        <tr>
          <th width = "16%"> Numéro de billet </th>
          <th width = "17%"> Date de réservation </th>
          <th width = "16%"> Siège </th>
          <th width = "17%"> Classe </th>
          <th width = "16%"> Prix (en euros) </th>
          <th width = "16%"> Numéro de vol </th>
        </tr>
      </table>



    </div>
    <?php
    while($data)
    {
    ?>
      <div align="center">
        <table width="100%" class="tableau">
          <tr>
            <td align="center" width = "16%"><?php echo $data['num_billet']?></td>
            <td align="center" width = "17%"><?php echo $data['date_reservation']?></td>
            <td align="center" width = "16%"><?php echo $data['siege']?></td>
            <td align="center" width = "17%"><?php echo $data['classe']?></td>
            <td align="center" width = "16%"><?php echo $data['prix']?></td>
            <td align="center" width = "16%"><?php echo $data['num_vol']?></td>
          </tr>
        </table>
      </div>

    <?php
      $data = $result->fetch_assoc();
    }

    $result=$link->query("SELECT * FROM Bagage,Billet WHERE Billet.num_billet=Bagage.num_billet AND id_passager = $id") or die("Search Error:" .$link->error()); /*Récupération des bagages*/
    $data = $result->fetch_assoc();
    ?>

    <div align="center">
      <br>
      <h3>Vos bagages</h3><br>

      <table width = "100%" class="tableau">
        <tr>
          <th width = "16%"> Numéro de billet </th>
          <th width = "17%"> Numéro de bagage </th>
          <th width = "16%"> Taille </th>
          <th width = "17%"> Poids </th>
        </tr>
      </table>

    </div>

    <?php
    while($data)
    {
    ?>

      <div align="center">
        <table width="100%" class="tableau">
          <tr>
            <td align="center" width = "16%"><?php echo $data['num_billet']?></td>
            <td align="center" width = "17%"><?php echo $data['num_bagage']?></td>
            <td align="center" width = "16%"><?php echo $data['taille']?></td>
            <td align="center" width = "17%"><?php echo $data['poids']?></td>
          </tr>
        </table>
      </div>

    <?php
      $data = $result->fetch_assoc();
    }
    $link->close();
    ?>

  </body>
</html>
