<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Insertion d'un billet</title>
  </head>
  <body>
    <?php
      $link = new mysqli('localhost',$_POST['identifiant'],$_POST['password']);
      if ($link->connect_errno) {
      die ("Erreur de connexion : errno: " . $link->errno .
                        "error:" . $link->error);
      }

      $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

      $num_vol = $_POST['num_vol'];

      /*Tester si le siège entré existe déjà dans le vol*/
      $billets = $link->query("SELECT siege FROM Billet WHERE num_vol = $num_vol") or die("Search Error:" .$link->error());
      $iterator = $billets->fetch_assoc();

      while($iterator)
      {
        if($_POST['siege']==$iterator['siege'])
        {
          $link->close();
      ?>
          <div align="center">
            <h3>Ce numéro de siège existe déjà dans ce vol.</h3>
            <form action="aeroport_gestionnaire_billet.php" method="post">
              <input type="hidden" name="action" value="insert">
              <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
              <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
              <input type="image" width = "11%" src="../images/button_retour.png">
            </form>
          </div>
      <?php
          exit();
        }
        $iterator = $billets->fetch_assoc();
      }

      /*Trouvez le dernier numéro de billet*/
      $siege = $_POST['siege'];
      $classe = $_POST['classe'];
      $prix = $_POST['prix'];

      $last_num = $link->query("SELECT * FROM Billet ORDER BY num_billet DESC") or die("Search Error:" .$link->error());
      $iterator = $last_num->fetch_assoc();
      $num = $iterator['num_billet']+1;

      /*Insertion du nouveau billet*/
      $link->query("INSERT INTO Billet(num_billet,siege,classe,prix,num_vol) VALUES($num,$siege,'$classe',$prix,$num_vol)") or die("Search Error:" .$link->error());

      $link->close();
    ?>

    <div align="center">
      <h3>L'insertion a été effectué avec succès.</h3>
      <form action="../connexion_employe/aeroport_verification_employe.php" method="post">
        <input type="hidden" name="identifiant" value="<?php echo $_POST['identifiant'] ?>">
        <input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
        <input type="image" width = "11%" src="../images/button_choice.png">
      </form>
    </div>
  </body>
</html>
