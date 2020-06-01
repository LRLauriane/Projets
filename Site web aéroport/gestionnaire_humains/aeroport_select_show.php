<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_compte.css" type="text/css" />
    <title>Affichage de la recherche</title>
  </head>
  <body>
    <div align="right">
        <table width="100%">
            <td align = "right">
              <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="image" src = "../images/button_choice.png" width="11%">
              </form>
            </td>
          </tr>
        </table>
    </div>
    <?php
    $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
    if ($link->connect_errno) {
    die ("Erreur de connexion : errno: " . $link->errno .
                      "error:" . $link->error);
    }

    $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

    if($_POST['choix']=="employe")
    {
        if($_POST['employe']=="numero")
        {
          $num = $_POST['num_employe'];
          $res = $link->query("SELECT * FROM Employe WHERE num_employe = $num")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();

          if(empty($iterator))
          {
            $link->close();
            ?>
                <div align="center">
                  <h3>Le numéro d'employé n'existe pas.</h3>
                  <form action="aeroport_select_enter.php" method="post">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                    <input type="hidden" name="employe" value="<?php echo $_POST['employe'] ?>">
                    <input type="image" src = "../images/button_retour.png" width="11%">
                  </form>
                </div>
            <?php
            exit();
          }
          ?>
            <div align="center">

              <h1>Les employés</h1>

              <table width = "100%" class="tableau">
                <tr>
                  <th width = "8%"> Numéro de l'employé </th>
                  <th width = "8%"> Numéro de l'équipage </th>
                  <th width = "8%"> Rôle </th>
                  <th width = "8%"> Nom </th>
                  <th width = "8%"> Prénom </th>
                  <th width = "8%"> Sexe </th>
                  <th width = "8%"> Date de naissance </th>
                  <th width = "8%"> Nationalité </th>
                  <th width = "8%"> Adresse </th>
                  <th width = "8%"> Numéro de tel </th>
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
                    <td align="center" width = "8%"><?php echo $iterator['num_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['num_equipage']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['role']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['nom_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['prenom_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['sexe_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['date_naissance_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['nationalite_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['adr_postale_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['num_tel_employe']?></td>
                  </tr>
                </table>
              </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
        else if($_POST['employe']=="equipage")
        {
          $num = $_POST['equipage'];
          $res = $link->query("SELECT * FROM Employe WHERE num_equipage = $num")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();

          if(empty($iterator))
          {
            $link->close();
            ?>
                <div align="center">
                  <h3>Le numéro d'équipage n'existe pas.</h3>
                  <form action="aeroport_select_enter.php" method="post">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                    <input type="hidden" name="employe" value="<?php echo $_POST['employe'] ?>">
                    <input type="image" src = "../images/button_retour.png" width="11%">
                  </form>
                </div>
            <?php
            exit();
          }
          ?>
            <div align="center">

              <h1>Les employés</h1>

              <table width = "100%" class="tableau">
                <tr>
                  <th width = "8%"> Numéro de l'employé </th>
                  <th width = "8%"> Numéro de l'équipage </th>
                  <th width = "8%"> Rôle </th>
                  <th width = "8%"> Nom </th>
                  <th width = "8%"> Prénom </th>
                  <th width = "8%"> Sexe </th>
                  <th width = "8%"> Date de naissance </th>
                  <th width = "8%"> Nationalité </th>
                  <th width = "8%"> Adresse </th>
                  <th width = "8%"> Numéro de tel </th>
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
                    <td align="center" width = "8%"><?php echo $iterator['num_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['num_equipage']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['role']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['nom_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['prenom_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['sexe_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['date_naissance_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['nationalite_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['adr_postale_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['num_tel_employe']?></td>
                  </tr>
                </table>
              </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
        else if($_POST['employe']=="role")
        {
          $role = $_POST['role'];
          $res = $link->query("SELECT * FROM Employe WHERE role = '$role'")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();
          ?>
            <div align="center">

              <h1>Les employés</h1>

              <table width = "100%" class="tableau">
                <tr>
                  <th width = "8%"> Numéro de l'employé </th>
                  <th width = "9%"> Numéro de l'équipage </th>
                  <th width = "8%"> Rôle </th>
                  <th width = "9%"> Nom </th>
                  <th width = "8%"> Prénom </th>
                  <th width = "9%"> Sexe </th>
                  <th width = "8%"> Date de naissance </th>
                  <th width = "9%"> Nationalité </th>
                  <th width = "8%"> Adresse </th>
                  <th width = "9%"> Numéro de tel </th>
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
                    <td align="center" width = "8%"><?php echo $iterator['num_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['num_equipage']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['role']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['nom_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['prenom_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['sexe_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['date_naissance_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['nationalite_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['adr_postale_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['num_tel_employe']?></td>
                  </tr>
                </table>
              </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
        else if($_POST['employe']=="genre")
        {
          $sexe = $_POST['sexe'];
          $res = $link->query("SELECT * FROM Employe WHERE sexe_employe = '$sexe'")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();
          ?>
            <div align="center">

              <h1>Les employés</h1>

              <table width = "100%" class="tableau">
                <tr>
                  <th width = "8%"> Numéro de l'employé </th>
                  <th width = "9%"> Numéro de l'équipage </th>
                  <th width = "8%"> Rôle </th>
                  <th width = "9%"> Nom </th>
                  <th width = "8%"> Prénom </th>
                  <th width = "9%"> Sexe </th>
                  <th width = "8%"> Date de naissance </th>
                  <th width = "9%"> Nationalité </th>
                  <th width = "8%"> Adresse </th>
                  <th width = "9%"> Numéro de tel </th>
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
                    <td align="center" width = "8%"><?php echo $iterator['num_employe']?></td>
                    <td align="center" width = "9%"><?php echo $iterator['num_equipage']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['role']?></td>
                    <td align="center" width = "9%"><?php echo $iterator['nom_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['prenom_employe']?></td>
                    <td align="center" width = "9%"><?php echo $iterator['sexe_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['date_naissance_employe']?></td>
                    <td align="center" width = "9%"><?php echo $iterator['nationalite_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['adr_postale_employe']?></td>
                    <td align="center" width = "9%"><?php echo $iterator['num_tel_employe']?></td>
                  </tr>
                </table>
              </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
        else {
          $nat = $_POST['nationalite'];
          $res = $link->query("SELECT * FROM Employe WHERE nationalite_employe = '$nat'")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();
          ?>
            <div align="center">

              <h1>Les employés</h1>

              <table width = "100%" class="tableau">
                <tr>
                  <th width = "8%"> Numéro de l'employé </th>
                  <th width = "9%"> Numéro de l'équipage </th>
                  <th width = "8%"> Rôle </th>
                  <th width = "9%"> Nom </th>
                  <th width = "8%"> Prénom </th>
                  <th width = "9%"> Sexe </th>
                  <th width = "8%"> Date de naissance </th>
                  <th width = "9%"> Nationalité </th>
                  <th width = "8%"> Adresse </th>
                  <th width = "9%"> Numéro de tel </th>
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
                    <td align="center" width = "8%"><?php echo $iterator['num_employe']?></td>
                    <td align="center" width = "9%"><?php echo $iterator['num_equipage']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['role']?></td>
                    <td align="center" width = "9%"><?php echo $iterator['nom_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['prenom_employe']?></td>
                    <td align="center" width = "9%"><?php echo $iterator['sexe_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['date_naissance_employe']?></td>
                    <td align="center" width = "9%"><?php echo $iterator['nationalite_employe']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['adr_postale_employe']?></td>
                    <td align="center" width = "9%"><?php echo $iterator['num_tel_employe']?></td>
                  </tr>
                </table>
              </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
      }
      else if($_POST['choix']=="passager")
      {
        if($_POST['passager']=="numero")
        {
          $num = $_POST['num_passager'];
          $res = $link->query("SELECT * FROM Passager WHERE id_passager = $num")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();

          if(empty($iterator))
          {
            $link->close();
            ?>
                <div align="center">
                  <h3>Le numéro de passager n'existe pas.</h3>
                  <form action="aeroport_select_enter.php" method="post">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                    <input type="hidden" name="passager" value="<?php echo $_POST['passager'] ?>">
                    <input type="image" src = "../images/button_retour.png" width="11%">
                  </form>
                </div>
            <?php
            exit();
          }

          ?>
            <div align="center">

              <h1>Les passagers</h1>

              <table width = "100%" class="tableau">
                <tr>
                  <th width = "7%"> Numéro </th>
                  <th width = "8%"> Nom </th>
                  <th width = "7%"> Prénom </th>
                  <th width = "8%"> Sexe </th>
                  <th width = "7%"> Date de naissance </th>
                  <th width = "8%"> Nationalité </th>
                  <th width = "7%"> Adresse </th>
                  <th width = "8%"> Numéro de tel </th>
                  <th width = "7%"> Passeport </th>
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
                    <td align="center" width = "8%"><?php echo $iterator['nom_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['prenom_passager']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['sexe_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['date_naissance_passager']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['nationalite_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['adr_postale_passager']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['num_tel_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['num_passeport']?></td>

                  </tr>
                </table>
              </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
        else if($_POST['passager']=="passeport")
        {
          $num = $_POST['passeport'];
          $res = $link->query("SELECT * FROM Passager WHERE num_passeport = $num")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();

          if(empty($iterator))
          {
            $link->close();
            ?>
                <div align="center">
                  <h3>Le numéro de passeport n'existe pas.</h3>
                  <form action="aeroport_select_enter.php" method="post">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                    <input type="hidden" name="passager" value="<?php echo $_POST['passager'] ?>">
                    <input type="image" src = "../images/button_retour.png" width="11%">
                  </form>
                </div>
            <?php
            exit();
          }

          ?>
            <div align="center">

              <h1>Les passagers</h1>

              <table width = "100%" class="tableau">
                <tr>
                  <th width = "7%"> Numéro </th>
                  <th width = "8%"> Nom </th>
                  <th width = "7%"> Prénom </th>
                  <th width = "8%"> Sexe </th>
                  <th width = "7%"> Date de naissance </th>
                  <th width = "8%"> Nationalité </th>
                  <th width = "7%"> Adresse </th>
                  <th width = "8%"> Numéro de tel </th>
                  <th width = "7%"> Passeport </th>
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
                    <td align="center" width = "8%"><?php echo $iterator['nom_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['prenom_passager']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['sexe_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['date_naissance_passager']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['nationalite_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['adr_postale_passager']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['num_tel_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['num_passeport']?></td>

                  </tr>
                </table>
              </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
        else if($_POST['passager']=="genre")
        {
          $sexe = $_POST['sexe'];
          $res = $link->query("SELECT * FROM Passager WHERE sexe_passager = '$sexe'")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();

          ?>
            <div align="center">

              <h1>Les passagers</h1>

              <table width = "100%" class="tableau">
                <tr>
                  <th width = "7%"> Numéro </th>
                  <th width = "8%"> Nom </th>
                  <th width = "7%"> Prénom </th>
                  <th width = "8%"> Sexe </th>
                  <th width = "7%"> Date de naissance </th>
                  <th width = "8%"> Nationalité </th>
                  <th width = "7%"> Adresse </th>
                  <th width = "8%"> Numéro de tel </th>
                  <th width = "7%"> Passeport </th>
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
                    <td align="center" width = "8%"><?php echo $iterator['nom_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['prenom_passager']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['sexe_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['date_naissance_passager']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['nationalite_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['adr_postale_passager']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['num_tel_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['num_passeport']?></td>

                  </tr>
                </table>
              </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
        else {
          $nat = $_POST['nationalite'];
          $res = $link->query("SELECT * FROM Passager WHERE nationalite_passager = '$nat'")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();

          ?>
            <div align="center">

              <h1>Les passagers</h1>

              <table width = "100%" class="tableau">
                <tr>
                  <th width = "7%"> Numéro </th>
                  <th width = "8%"> Nom </th>
                  <th width = "7%"> Prénom </th>
                  <th width = "8%"> Sexe </th>
                  <th width = "7%"> Date de naissance </th>
                  <th width = "8%"> Nationalité </th>
                  <th width = "7%"> Adresse </th>
                  <th width = "8%"> Numéro de tel </th>
                  <th width = "7%"> Passeport </th>
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
                    <td align="center" width = "8%"><?php echo $iterator['nom_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['prenom_passager']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['sexe_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['date_naissance_passager']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['nationalite_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['adr_postale_passager']?></td>
                    <td align="center" width = "8%"><?php echo $iterator['num_tel_passager']?></td>
                    <td align="center" width = "7%"><?php echo $iterator['num_passeport']?></td>

                  </tr>
                </table>
              </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
      }
      else if($_POST['choix']=="travaille")
      {
        if($_POST['travaille']=="employe")
        {
          $num = $_POST['employe'];
          $res = $link->query("SELECT * FROM Travaille WHERE num_employe=$num")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();

          if(empty($iterator))
          {
            $link->close();
            ?>
                <div align="center">
                  <h3>Le numéro d'employé n'existe pas.</h3>
                  <form action="aeroport_select_enter.php" method="post">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                    <input type="hidden" name="travaille" value="<?php echo $_POST['travaille'] ?>">
                    <input type="image" src = "../images/button_retour.png" width="11%">
                  </form>
                </div>
            <?php
            exit();
          }

          $res = $link->query("SELECT * FROM Vol WHERE num_vol IN (SELECT num_vol FROM Travaille WHERE num_employe=$num)")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();
          ?>
          <div align="center">

            <h1>Les vols de l'employé <?php echo $num ?></h1>

            <table width = "100%" class="tableau">
              <tr>
                <th width = "7%"> Numéro de vol </th>
                <th width = "8%"> Départ </th>
                <th width = "7%"> Arrivée </th>
                <th width = "8%"> Date </th>
                <th width = "7%"> Horaires </th>
                <th width = "8%"> Escale </th>
                <th width = "7%"> Porte </th>
                <th width = "8%"> Avion </th>
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
                  <td align="center" width = "7%"><?php echo $iterator['num_vol']?></td>
                  <td align="center" width = "8%"><?php echo $iterator['depart']?></td>
                  <td align="center" width = "7%"><?php echo $iterator['arrivee']?></td>
                  <td align="center" width = "8%"><?php echo $iterator['date_vol']?></td>
                  <td align="center" width = "7%"><?php echo $iterator['horaires']?></td>
                  <td align="center" width = "8%"><?php echo $iterator['escale']?></td>
                  <td align="center" width = "7%"><?php echo $iterator['porte']?></td>
                  <td align="center" width = "8%"><?php echo $iterator['id_avion']?></td>
                </tr>
              </table>
            </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
        else {
          $num = $_POST['vol'];
          $res = $link->query("SELECT * FROM Travaille WHERE num_vol=$num")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();

          if(empty($iterator))
          {
            $link->close();
            ?>
                <div align="center">
                  <h3>Le numéro de vol n'existe pas.</h3>
                  <form action="aeroport_select_enter.php" method="post">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                    <input type="hidden" name="travaille" value="<?php echo $_POST['travaille'] ?>">
                    <input type="image" src = "../images/button_retour.png" width="11%">
                  </form>
                </div>
            <?php
            exit();
          }

          $res = $link->query("SELECT * FROM Employe WHERE num_employe IN (SELECT num_employe FROM Travaille WHERE num_vol=$num)")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();
          ?>
          <div align="center">

            <h1>Les employés du vol <?php echo $num ?></h1>

            <table width = "100%" class="tableau">
              <tr>
                <th width = "7%"> Numéro de l'employé </th>
                <th width = "8%"> Numéro de l'équipage </th>
                <th width = "7%"> Rôle </th>
                <th width = "8%"> Nom </th>
                <th width = "7%"> Prénom </th>
                <th width = "8%"> Sexe </th>
                <th width = "7%"> Date de naissance </th>
                <th width = "8%"> Nationalité </th>
                <th width = "7%"> Adresse </th>
                <th width = "8%"> Numéro de tel </th>
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
                  <td align="center" width = "7%"><?php echo $iterator['num_employe']?></td>
                  <td align="center" width = "8%"><?php echo $iterator['num_equipage']?></td>
                  <td align="center" width = "7%"><?php echo $iterator['role']?></td>
                  <td align="center" width = "8%"><?php echo $iterator['nom_employe']?></td>
                  <td align="center" width = "7%"><?php echo $iterator['prenom_employe']?></td>
                  <td align="center" width = "8%"><?php echo $iterator['sexe_employe']?></td>
                  <td align="center" width = "7%"><?php echo $iterator['date_naissance_employe']?></td>
                  <td align="center" width = "8%"><?php echo $iterator['nationalite_employe']?></td>
                  <td align="center" width = "7%"><?php echo $iterator['adr_postale_employe']?></td>
                  <td align="center" width = "8%"><?php echo $iterator['num_tel_employe']?></td>
                </tr>
              </table>
            </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
      }
      else
      {
        if($_POST['bagage']=="bagage")
        {
          $num = $_POST['num_bagage'];
          $res = $link->query("SELECT * FROM Bagage WHERE num_bagage=$num")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();

          if(empty($iterator))
          {
            $link->close();
            ?>
                <div align="center">
                  <h3>Le numéro de bagage n'existe pas.</h3>
                  <form action="aeroport_select_enter.php" method="post">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                    <input type="hidden" name="bagage" value="<?php echo $_POST['bagage'] ?>">
                    <input type="image" src = "../images/button_retour.png" width="11%">
                  </form>
                </div>
            <?php
            exit();
          }

          ?>
          <div align="center">

            <h1>Le bagage numéro <?php echo $num ?></h1>

            <table width = "100%" class="tableau">
              <tr>
                <th width = "13%"> Numéro de bagage </th>
                <th width = "14%"> Taille </th>
                <th width = "13%"> Poids </th>
                <th width = "14%"> Numéro de billet </th>
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
                  <td align="center" width = "13%"><?php echo $iterator['num_bagage']?></td>
                  <td align="center" width = "14%"><?php echo $iterator['taille']?></td>
                  <td align="center" width = "13%"><?php echo $iterator['poids']?></td>
                  <td align="center" width = "14%"><?php echo $iterator['num_billet']?></td>
                </tr>
              </table>
            </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
        else {
          $num = $_POST['billet'];
          $res = $link->query("SELECT * FROM Bagage WHERE num_billet=$num")
          or die("Search Error:" .$link->error());

          $iterator = $res->fetch_assoc();

          if(empty($iterator))
          {
            $link->close();
            ?>
                <div align="center">
                  <h3>Le numéro de billet n'existe pas.</h3>
                  <form action="aeroport_select_enter.php" method="post">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                    <input type="hidden" name="bagage" value="<?php echo $_POST['bagage'] ?>">
                    <input type="image" src = "../images/button_retour.png" width="11%">
                  </form>
                </div>
            <?php
            exit();
          }
          ?>
          <div align="center">

            <h1>Le bagage du billet <?php echo $num ?></h1>

            <table width = "100%" class="tableau">
              <tr>
                <th width = "13%"> Numéro de bagage </th>
                <th width = "14%"> Taille </th>
                <th width = "13%"> Poids </th>
                <th width = "14%"> Numéro de billet </th>
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
                  <td align="center" width = "13%"><?php echo $iterator['num_bagage']?></td>
                  <td align="center" width = "14%"><?php echo $iterator['taille']?></td>
                  <td align="center" width = "13%"><?php echo $iterator['poids']?></td>
                  <td align="center" width = "14%"><?php echo $iterator['num_billet']?></td>
                </tr>
              </table>
            </div>
          <?php
              $iterator = $res->fetch_assoc();
            }
          exit();
        }
      }


    $link->close();
    ?>
  </body>
</html>
