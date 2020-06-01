<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Insertion d'un employé</title>
  </head>
  <body>
    <?php

    $link = new mysqli('localhost', 'admin', 'Admin75!');
    if ($link->connect_errno) {
    die ("Erreur de connexion : errno: " . $link->errno .
                      "error:" . $link->error);
    }

    $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

    if($_POST['choix']=="passager")
    {
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $sexe = $_POST['sexe'];
      $date = $_POST['date'];
      $nationalite = $_POST['nationalite'];
      $adr = $_POST['adresse'];
      $num = $_POST['numero'];
      $passeport = $_POST['passeport'];

      /*Vérification du numéro de passeport*/
      $num_pass = $link->query("SELECT num_passeport FROM Passager") or die("Search Error:" .$link->error());
      $iterator = $num_pass->fetch_assoc();

      while($iterator)
      {
          if($iterator['num_passeport']==$passeport)
          {
            ?>
              <div align="center">
                <h3>Le numéro de passeport existe déjà.</h3>
                <table>
                  <form action="aeroport_insert_infos.php" method="post">
                    <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                    <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                    <input type="hidden" name="choix" value="passager">
                    <input type="image" src = "../images/button_retour.png" width="11%">
                  </form>
                </table>
              </div>
            <?php
            $link->close();
            exit();
          }

          $iterator = $num_pass->fetch_assoc();
      }

      /*Trouver le dernier id_passager*/
      $last_id = $link->query("SELECT COUNT(*) as nb_passagers FROM Passager") or die("Search Error:" .$link->error());
      $iterator = $last_id->fetch_assoc();
      $new_id = $iterator['nb_passagers']+1;

      $link->query("INSERT INTO Passager VALUES($new_id,'$nom','$prenom','$sexe','$date','$nationalite','$adr','$num','$passeport')") or die("Insert Error:" .$link->error());
      $link->close();

    }
    else if($_POST['choix']=="employe")
    {
      $role = $_POST['role'];
      $num_equipage = $_POST['equipe'];
      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $sexe = $_POST['sexe'];
      $date = $_POST['date_naissance'];
      $nationalite = $_POST['nationalite'];
      $adr = $_POST['adr'];
      $num = $_POST['numero'];

      /*Trouver le dernier id_passager*/
      $last_id = $link->query("SELECT num_employe FROM Employe ORDER BY num_employe DESC") or die("Search Error:" .$link->error());
      $iterator = $last_id->fetch_assoc();
      $new_id = $iterator['num_employe']+1;

      $link->query("INSERT INTO Employe VALUES('$new_id','$num_equipage','$role','$nom','$prenom','$sexe','$date','$nationalite','$adr','$num')") or die("Insert Error:" .$link->error());

      $link->close();
    }
    else if($_POST['choix']=="travaille")
    {
      $num_vol = $_POST['num_vol'];
      $num_employe = $_POST['num_employe'];

      $link->query("INSERT INTO Travaille VALUES($num_vol,$num_employe)") or die("Insert Error:" .$link->error());

      $link->close();
    }
    else {
      $taille = $_POST['taille'];
      $poids = $_POST['poids'];
      $num_billet = $_POST['num_billet'];

      /*Vérification du numéro du billet*/
      $res = $link->query("SELECT * FROM Billet WHERE num_billet = $num_billet") or die("Search Error:" .$link->error());
      $iterator = $res->fetch_assoc();

      if(empty($iterator))
      {
        ?>
          <div align="center">
            <h3>Le numéro de billet n'existe pas.</h3>
            <table>
              <form action="aeroport_insert_infos.php" method="post">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="choix" value="bagage">
                <input type="image" src = "../images/button_retour.png" width="11%">
              </form>
            </table>
          </div>
        <?php
        $link->close();
        exit();
      }

      $res = $link->query("SELECT * FROM Bagage WHERE num_billet = $num_billet") or die("Search Error:" .$link->error());
      $iterator = $res->fetch_assoc();

      if(!(empty($iterator)))
      {
        ?>
          <div align="center">
            <h3>Le numéro de billet est déjà associé.</h3>
            <table>
              <form action="aeroport_insert_infos.php" method="post">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="choix" value="bagage">
                <input type="image" src = "../images/button_retour.png" width="11%">
              </form>
            </table>
          </div>
        <?php
        $link->close();
        exit();
      }

      /*Trouver le dernier numéro de billet*/
      $last_id = $link->query("SELECT num_bagage FROM Bagage ORDER BY num_bagage DESC") or die("Search Error:" .$link->error());
      $iterator = $last_id->fetch_assoc();
      $new_id = $iterator['num_bagage']+1;

      $link->query("INSERT INTO Bagage VALUES($new_id,'$taille','$poids','$num_billet')") or die("Insert Error:" .$link->error());
      $link->close();
    }
    ?>
    <div align="center">
      <table>
        <h3>L'insertion a été faite avec succès.</h3>
        <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
          <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
          <input type="image" src = "../images/button_choice.png" width="11%">
        </form>
      </table>
    </div>
  </body>
</html>
