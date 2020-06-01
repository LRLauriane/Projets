<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Filtres</title>
  </head>
  <body>
    <?php
    $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
    if ($link->connect_errno) {
    die ("Erreur de connexion : errno: " . $link->errno .
                      "error:" . $link->error);
    }

    $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);
    ?>

    <div align="right">
        <table width="30%">
          <tr>
            <td align="right">
              <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="image" width="80%" src="../images/button_choice.png"/>
              </form>
            </td>
            <td align="center">
              <form action="aeroport_inge_vol.php" method="post">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="action" value="select">
                <input type="image" width="80%" src="../images/button_select.png"/>
              </form>
          </tr>
        </table>
    </div>

    <?php
    if(empty($_POST['num_vol_gestion'])
    &&(empty($_POST['depart_vol']))
    &&(empty($_POST['depart_gestion']))
    &&(empty($_POST['arrivee_vol']))
    &&(empty($_POST['arrivee_gestion']))
    &&(empty($_POST['date_vol']))
    &&(empty($_POST['date_gestion']))
    &&(empty($_POST['horaires_vol']))
    &&(empty($_POST['horaires_gestion']))
    &&(empty($_POST['pays_gestion']))
    &&(empty($_POST['pays_compagnie']))
    &&(empty($_POST['capacite']))
    &&(empty($_POST['compagnie']))
    &&(empty($_POST['id_avion']))
    )
    {
        $num = $_POST['num_vol_vol'];
        $res = $link->query("SELECT * FROM Vol WHERE num_vol = $num")
        or die("Search Error:" .$link->error());

        $iterator = $res->fetch_assoc();

      ?>
        <div align="center">

          <h1>Les vols</h1>

          <table width = "100%" class = "tableau">
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
            <table width="100%" class = "tableau">
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
          $iterator = $res->fetch_assoc();
        }
        exit();
      }

      if(empty($_POST['num_vol_vol'])
      &&(empty($_POST['depart_vol']))
      &&(empty($_POST['depart_gestion']))
      &&(empty($_POST['arrivee_vol']))
      &&(empty($_POST['arrivee_gestion']))
      &&(empty($_POST['date_vol']))
      &&(empty($_POST['date_gestion']))
      &&(empty($_POST['horaires_vol']))
      &&(empty($_POST['horaires_gestion']))
      &&(empty($_POST['pays_gestion']))
      &&(empty($_POST['pays_compagnie']))
      &&(empty($_POST['capacite']))
      &&(empty($_POST['compagnie']))
      &&(empty($_POST['id_avion']))
      )
      {
        $num = $_POST['num_vol_gestion'];
        $res = $link->query("SELECT * FROM gestion_vols WHERE num_vol = $num")
        or die("Search Error:" .$link->error());

        $iterator = $res->fetch_assoc();

      ?>
        <div align="center">

          <h1>Vue complète des vols</h1>

          <table width = "100%" class = "tableau">
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
            <table width="100%" class = "tableau">
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
            $iterator = $res->fetch_assoc();
          }
          exit();

      }

      if(empty($_POST['num_vol_gestion'])
      &&(empty($_POST['num_vol_vol']))
      &&(empty($_POST['depart_gestion']))
      &&(empty($_POST['arrivee_vol']))
      &&(empty($_POST['arrivee_gestion']))
      &&(empty($_POST['date_vol']))
      &&(empty($_POST['date_gestion']))
      &&(empty($_POST['horaires_vol']))
      &&(empty($_POST['horaires_gestion']))
      &&(empty($_POST['pays_gestion']))
      &&(empty($_POST['pays_compagnie']))
      &&(empty($_POST['capacite']))
      &&(empty($_POST['compagnie']))
      &&(empty($_POST['id_avion']))
      )
    {
        $depart = $_POST['depart_vol'];
        $res = $link->query("SELECT * FROM Vol WHERE depart = '$depart'")
        or die("Search Error:" .$link->error());

        $iterator = $res->fetch_assoc();

      ?>
        <div align="center">

          <h1>Les vols</h1>

          <table width = "100%" class = "tableau">
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
            <table width="100%" class = "tableau">
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
          $iterator = $res->fetch_assoc();
        }
        exit();

      }

      if(empty($_POST['num_vol_gestion'])
      &&(empty($_POST['num_vol_vol']))
      &&(empty($_POST['depart_vol']))
      &&(empty($_POST['arrivee_vol']))
      &&(empty($_POST['arrivee_gestion']))
      &&(empty($_POST['date_vol']))
      &&(empty($_POST['date_gestion']))
      &&(empty($_POST['horaires_vol']))
      &&(empty($_POST['horaires_gestion']))
      &&(empty($_POST['pays_gestion']))
      &&(empty($_POST['pays_compagnie']))
      &&(empty($_POST['capacite']))
      &&(empty($_POST['compagnie']))
      &&(empty($_POST['id_avion']))
      )
      {
        $depart = $_POST['depart_gestion'];
        $res = $link->query("SELECT * FROM gestion_vols WHERE depart = '$depart'")
        or die("Search Error:" .$link->error());

        $iterator = $res->fetch_assoc();

      ?>
        <div align="center">

          <h1>Vue complète des vols</h1>

          <table width = "100%" class = "tableau">
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
            <table width="100%" class = "tableau">
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
            $iterator = $res->fetch_assoc();
          }
          exit();

      }

      if(empty($_POST['num_vol_gestion'])
      &&(empty($_POST['num_vol_vol']))
      &&(empty($_POST['depart_vol']))
      &&(empty($_POST['depart_gestion']))
      &&(empty($_POST['arrivee_gestion']))
      &&(empty($_POST['date_vol']))
      &&(empty($_POST['date_gestion']))
      &&(empty($_POST['horaires_vol']))
      &&(empty($_POST['horaires_gestion']))
      &&(empty($_POST['pays_gestion']))
      &&(empty($_POST['pays_compagnie']))
      &&(empty($_POST['capacite']))
      &&(empty($_POST['compagnie']))
      &&(empty($_POST['id_avion']))
      )
    {
        $arrivee = $_POST['arrivee_vol'];
        $res = $link->query("SELECT * FROM Vol WHERE arrivee = '$arrivee'")
        or die("Search Error:" .$link->error());

        $iterator = $res->fetch_assoc();

      ?>
        <div align="center">

          <h1>Les vols</h1>

          <table width = "100%" class = "tableau">
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
            <table width="100%" class = "tableau">
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
          $iterator = $res->fetch_assoc();
        }
        exit();

      }

      if(empty($_POST['num_vol_gestion'])
      &&(empty($_POST['num_vol_vol']))
      &&(empty($_POST['depart_vol']))
      &&(empty($_POST['depart_gestion']))
      &&(empty($_POST['arrivee_vol']))
      &&(empty($_POST['date_vol']))
      &&(empty($_POST['date_gestion']))
      &&(empty($_POST['horaires_vol']))
      &&(empty($_POST['horaires_gestion']))
      &&(empty($_POST['pays_gestion']))
      &&(empty($_POST['pays_compagnie']))
      &&(empty($_POST['capacite']))
      &&(empty($_POST['compagnie']))
      &&(empty($_POST['id_avion']))
      )
      {
        $arrivee = $_POST['arrivee_gestion'];
        $res = $link->query("SELECT * FROM gestion_vols WHERE arrivee='$arrivee'")
        or die("Search Error:" .$link->error());

        $iterator = $res->fetch_assoc();

      ?>
        <div align="center">

          <h1>Vue complète des vols</h1>

          <table width = "100%" class = "tableau">
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
            <table width="100%" class = "tableau">
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
            $iterator = $res->fetch_assoc();
          }
          exit();

      }


      if(empty($_POST['num_vol_gestion'])
      &&(empty($_POST['num_vol_vol']))
      &&(empty($_POST['depart_vol']))
      &&(empty($_POST['depart_gestion']))
      &&(empty($_POST['arrivee_vol']))
      &&(empty($_POST['arrivee_gestion']))
      &&(empty($_POST['date_gestion']))
      &&(empty($_POST['horaires_vol']))
      &&(empty($_POST['horaires_gestion']))
      &&(empty($_POST['pays_gestion']))
      &&(empty($_POST['pays_compagnie']))
      &&(empty($_POST['capacite']))
      &&(empty($_POST['compagnie']))
      &&(empty($_POST['id_avion']))
      )
    {
        $date = $_POST['date_vol'];
        $res = $link->query("SELECT * FROM Vol WHERE date_vol = '$date'")
        or die("Search Error:" .$link->error());

        $iterator = $res->fetch_assoc();

      ?>
        <div align="center">

          <h1>Les vols</h1>

          <table width = "100%" class = "tableau">
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
            <table width="100%" class = "tableau">
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
          $iterator = $res->fetch_assoc();
        }
        exit();


      }

      if(empty($_POST['num_vol_gestion'])
      &&(empty($_POST['num_vol_vol']))
      &&(empty($_POST['depart_vol']))
      &&(empty($_POST['depart_gestion']))
      &&(empty($_POST['arrivee_vol']))
      &&(empty($_POST['arrivee_gestion']))
      &&(empty($_POST['date_vol']))
      &&(empty($_POST['horaires_vol']))
      &&(empty($_POST['horaires_gestion']))
      &&(empty($_POST['pays_gestion']))
      &&(empty($_POST['pays_compagnie']))
      &&(empty($_POST['capacite']))
      &&(empty($_POST['compagnie']))
      &&(empty($_POST['id_avion']))
      )
      {
        $date = $_POST['date_gestion'];
        $res = $link->query("SELECT * FROM gestion_vols WHERE date_vol = $date")
        or die("Search Error:" .$link->error());

        $iterator = $res->fetch_assoc();

      ?>
        <div align="center">

          <h1>Vue complète des vols</h1>

          <table width = "100%" class = "tableau">
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
            <table width="100%" class = "tableau">
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
            $iterator = $res->fetch_assoc();
          }
          exit();

      }

      if(empty($_POST['num_vol_gestion'])
      &&(empty($_POST['num_vol_vol']))
      &&(empty($_POST['depart_vol']))
      &&(empty($_POST['depart_gestion']))
      &&(empty($_POST['arrivee_vol']))
      &&(empty($_POST['arrivee_gestion']))
      &&(empty($_POST['date_vol']))
      &&(empty($_POST['date_gestion']))
      &&(empty($_POST['horaires_gestion']))
      &&(empty($_POST['pays_gestion']))
      &&(empty($_POST['pays_compagnie']))
      &&(empty($_POST['capacite']))
      &&(empty($_POST['compagnie']))
      &&(empty($_POST['id_avion']))
      )
    {
        $horaires = $_POST['horaires_vol'];
        $res = $link->query("SELECT * FROM Vol WHERE horaires = '$horaires'")
        or die("Search Error:" .$link->error());

        $iterator = $res->fetch_assoc();

      ?>
        <div align="center">

          <h1>Les vols</h1>

          <table width = "100%" class = "tableau">
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
            <table width="100%" class = "tableau">
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
          $iterator = $res->fetch_assoc();
        }
        exit();


      }

      if(empty($_POST['num_vol_gestion'])
      &&(empty($_POST['num_vol_vol']))
      &&(empty($_POST['depart_vol']))
      &&(empty($_POST['depart_gestion']))
      &&(empty($_POST['arrivee_vol']))
      &&(empty($_POST['arrivee_gestion']))
      &&(empty($_POST['date_vol']))
      &&(empty($_POST['date_gestion']))
      &&(empty($_POST['horaires_vol']))
      &&(empty($_POST['pays_gestion']))
      &&(empty($_POST['pays_compagnie']))
      &&(empty($_POST['capacite']))
      &&(empty($_POST['compagnie']))
      &&(empty($_POST['id_avion']))
      )
      {
        $horaires= $_POST['horaires_gestion'];
        $res = $link->query("SELECT * FROM gestion_vols WHERE horaires = '$horaires'")
        or die("Search Error:" .$link->error());

        $iterator = $res->fetch_assoc();

      ?>
        <div align="center">

          <h1>Vue complète des vols</h1>

          <table width = "100%" class = "tableau">
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
            <table width="100%" class = "tableau">
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
            $iterator = $res->fetch_assoc();
          }
          exit();

      }

      if(empty($_POST['num_vol_gestion'])
      &&(empty($_POST['num_vol_vol']))
      &&(empty($_POST['depart_vol']))
      &&(empty($_POST['depart_gestion']))
      &&(empty($_POST['arrivee_vol']))
      &&(empty($_POST['arrivee_gestion']))
      &&(empty($_POST['date_vol']))
      &&(empty($_POST['date_gestion']))
      &&(empty($_POST['horaires_vol']))
      &&(empty($_POST['horaires_gestion']))
      &&(empty($_POST['pays_gestion']))
      &&(empty($_POST['pays_compagnie']))
      &&(empty($_POST['capacite']))
      &&(empty($_POST['compagnie']))
      )
    {
      $id= $_POST['id_avion'];
      $res = $link->query("SELECT * FROM Avion WHERE id_avion = $id")
      or die("Search Error:" .$link->error());

      $iterator = $res->fetch_assoc();

      ?>
      <div align="center">

        <h1>Les avions</h1>

        <table width = "100%" class = "tableau">
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
          <table width="100%" class = "tableau">
            <tr>
              <td align="center" width = "13%"><?php echo $iterator['id_avion']?></td>
              <td align="center" width = "14%"><?php echo $iterator['capacite']?></td>
              <td align="center" width = "13%"><?php echo $iterator['nom']?></td>
            </tr>
          </table>
        </div>
    <?php
        $iterator = $res->fetch_assoc();
      }
      exit();

    }

    if(empty($_POST['num_vol_gestion'])
    &&(empty($_POST['num_vol_vol']))
    &&(empty($_POST['depart_vol']))
    &&(empty($_POST['depart_gestion']))
    &&(empty($_POST['arrivee_vol']))
    &&(empty($_POST['arrivee_gestion']))
    &&(empty($_POST['date_vol']))
    &&(empty($_POST['date_gestion']))
    &&(empty($_POST['horaires_vol']))
    &&(empty($_POST['horaires_gestion']))
    &&(empty($_POST['pays_gestion']))
    &&(empty($_POST['pays_compagnie']))
    &&(empty($_POST['id_avion']))
    &&(empty($_POST['compagnie']))
    )
    {
      $capacite= $_POST['capacite'];
      $res = $link->query("SELECT * FROM Avion WHERE capacite = $capacite")
      or die("Search Error:" .$link->error());

      $iterator = $res->fetch_assoc();

      ?>
      <div align="center">

        <h1>Les avions</h1>

        <table width = "100%" class = "tableau">
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
          <table width="100%" class = "tableau">
            <tr>
              <td align="center" width = "13%"><?php echo $iterator['id_avion']?></td>
              <td align="center" width = "14%"><?php echo $iterator['capacite']?></td>
              <td align="center" width = "13%"><?php echo $iterator['nom']?></td>
            </tr>
          </table>
        </div>
    <?php
        $iterator = $res->fetch_assoc();
      }
      exit();

    }

    if(empty($_POST['num_vol_gestion'])
    &&(empty($_POST['num_vol_vol']))
    &&(empty($_POST['depart_vol']))
    &&(empty($_POST['depart_gestion']))
    &&(empty($_POST['arrivee_vol']))
    &&(empty($_POST['arrivee_gestion']))
    &&(empty($_POST['date_vol']))
    &&(empty($_POST['date_gestion']))
    &&(empty($_POST['horaires_vol']))
    &&(empty($_POST['horaires_gestion']))
    &&(empty($_POST['pays_gestion']))
    &&(empty($_POST['pays_compagnie']))
    &&(empty($_POST['id_avion']))
    &&(empty($_POST['capacite']))
    )
    {
      $compagnie= $_POST['compagnie'];
      $res = $link->query("SELECT * FROM Avion WHERE nom = '$compagnie'")
      or die("Search Error:" .$link->error());

      $iterator = $res->fetch_assoc();

      ?>
      <div align="center">

        <h1>Les avions</h1>

        <table width = "100%" class = "tableau">
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
          <table width="100%" class = "tableau">
            <tr>
              <td align="center" width = "13%"><?php echo $iterator['id_avion']?></td>
              <td align="center" width = "14%"><?php echo $iterator['capacite']?></td>
              <td align="center" width = "13%"><?php echo $iterator['nom']?></td>
            </tr>
          </table>
        </div>
    <?php
        $iterator = $res->fetch_assoc();
      }
      exit();

    }

    if(empty($_POST['num_vol_gestion'])
    &&(empty($_POST['num_vol_vol']))
    &&(empty($_POST['depart_vol']))
    &&(empty($_POST['depart_gestion']))
    &&(empty($_POST['arrivee_vol']))
    &&(empty($_POST['arrivee_gestion']))
    &&(empty($_POST['date_vol']))
    &&(empty($_POST['date_gestion']))
    &&(empty($_POST['horaires_vol']))
    &&(empty($_POST['horaires_gestion']))
    &&(empty($_POST['compagnie']))
    &&(empty($_POST['pays_gestion']))
    &&(empty($_POST['id_avion']))
    &&(empty($_POST['capacite']))
    )
    {
        $pays = $_POST['pays_compagnie'];
        $res = $link->query("SELECT * FROM Compagnie WHERE pays='$pays'")
        or die("Search Error:" .$link->error());

        $iterator = $res->fetch_assoc();

        ?>
        <div align="center">

          <h1>Les compagnies</h1>

          <table width = "100%" class = "tableau">
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
            <table width="100%" class = "tableau">
              <tr>
                <td align="center" width = "13%"><?php echo $iterator['nom']?></td>
                <td align="center" width = "14%"><?php echo $iterator['pays']?></td>
                <td align="center" width = "13%"><?php echo $iterator['nbre_avions']?></td>
                <td align="center" width = "14%"><?php echo $iterator['nbre_vols_semaine']?></td>
              </tr>
            </table>
          </div>
      <?php
          $iterator = $res->fetch_assoc();
        }
        exit();
      }

      if(empty($_POST['num_vol_gestion'])
      &&(empty($_POST['num_vol_vol']))
      &&(empty($_POST['depart_vol']))
      &&(empty($_POST['depart_gestion']))
      &&(empty($_POST['arrivee_vol']))
      &&(empty($_POST['arrivee_gestion']))
      &&(empty($_POST['date_vol']))
      &&(empty($_POST['date_gestion']))
      &&(empty($_POST['horaires_vol']))
      &&(empty($_POST['horaires_gestion']))
      &&(empty($_POST['compagnie']))
      &&(empty($_POST['pays_compagnie']))
      &&(empty($_POST['id_avion']))
      &&(empty($_POST['capacite']))
      )
      {
        $pays = $_POST['pays_gestion'];
        $res = $link->query("SELECT * FROM gestion_vols WHERE pays = '$pays'")
        or die("Search Error:" .$link->error());

        $iterator = $res->fetch_assoc();

      ?>
        <div align="center">

          <h1>Vue complète des vols</h1>

          <table width = "100%" class = "tableau">
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
            <table width="100%" class = "tableau">
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
            $iterator = $res->fetch_assoc();
          }
          exit();

      }
    ?>
  </body>
</html>
