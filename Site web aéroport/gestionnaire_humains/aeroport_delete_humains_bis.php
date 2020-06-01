<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Supression</title>
  </head>
  <body>
    <?php
    $link = new mysqli('localhost', 'admin', 'Admin75!');
    if ($link->connect_errno) {
    die ("Erreur de connexion : errno: " . $link->errno .
                      "error:" . $link->error);
    }

    $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

    if($_POST['choix']=="travaille")
    {
      if(empty($_POST['employe']))
      {
        $num = $_POST['vol'];

        $res = $link->query("SELECT * FROM Travaille WHERE num_vol=$num") or die("Select Error:" .$link->error());
        $iterator = $res->fetch_assoc();

        if(empty($iterator))
        {
            $link->close();
        ?>
            <div align="center">
              <h3>Le numéro de vol n'existe pas.</h3>
              <form action="aeroport_delete_humains.php" method="post">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                <input type="hidden" name="travaille" value="vol">
                <input type="image" src = "../images/button_retour.png" width="11%">
              </form>
            </div>
        <?php
        exit();
        }

        $link->query("DELETE FROM Travaille WHERE num_vol = $num") or die("Search Error:" .$link->error());
        $link->close();
      }
      else {
        $num = $_POST['employe'];

        $res = $link->query("SELECT * FROM Travaille WHERE num_employe=$num") or die("Select Error:" .$link->error());
        $iterator = $res->fetch_assoc();

        if(empty($iterator))
        {
            $link->close();
        ?>
            <div align="center">
              <h3>Le numéro d'employé n'existe pas.</h3>
              <form action="aeroport_delete_humains.php" method="post">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                <input type="hidden" name="travaille" value="employe">
                <input type="image" src = "../images/button_retour.png" width="11%">
              </form>
            </div>
        <?php
        exit();
        }

        $link->query("DELETE FROM Travaille WHERE num_employe = $num") or die("Search Error:" .$link->error());
        $link->close();
      }
    }
    else {
      if(empty($_POST['billet']))
      {
        $num = $_POST['bagage'];

        $res = $link->query("SELECT * FROM Bagage WHERE num_bagage=$num") or die("Select Error:" .$link->error());
        $iterator = $res->fetch_assoc();

        if(empty($iterator))
        {
            $link->close();
        ?>
            <div align="center">
              <h3>Le numéro de bagage n'existe pas.</h3>
              <form action="aeroport_delete_humains.php" method="post">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                <input type="hidden" name="bagage" value="bagage">
                <input type="image" src = "../images/button_retour.png" width="11%">
              </form>
            </div>
        <?php
        exit();
        }

        $link->query("DELETE FROM Bagage WHERE num_bagage = $num") or die("Search Error:" .$link->error());
        $link->close();
      }
      else {
        $num = $_POST['billet'];

        $res = $link->query("SELECT * FROM Bagage WHERE num_billet=$num") or die("Select Error:" .$link->error());
        $iterator = $res->fetch_assoc();

        if(empty($iterator))
        {
            $link->close();
        ?>
            <div align="center">
              <h3>Le numéro de billet n'existe pas.</h3>
              <form action="aeroport_delete_humains.php" method="post">
                <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
                <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
                <input type="hidden" name="choix" value="<?php echo $_POST['choix'] ?>">
                <input type="hidden" name="bagage" value="billet">
                <input type="image" src = "../images/button_retour.png" width="11%">
              </form>
            </div>
        <?php
        exit();
        }

        $link->query("DELETE FROM Bagage WHERE num_billet = $num") or die("Search Error:" .$link->error());
        $link->close();
      }
    }
    ?>
    <div align="center">
      <table>
        <h3>La supression a été faite avec succès.</h3>
        <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
          <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
          <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
          <input type="image" src = "../images/button_choice.png" width="11%">
        </form>
      </table>
    </div>
  </body>
</html>
