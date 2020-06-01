<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Inscription réussie</title>
  </head>
  <body>
  <?php
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $sexe = $_POST['sexe'];
  $date = $_POST['date'];
  $nationalite = $_POST['nationalite'];
  $adr = $_POST['adresse'];
  $num = $_POST['numero'];
  $passeport = $_POST['passeport'];
  $id = $_POST['identifiant'];
  $mdp = $_POST['password'];
  $email = $_POST['email'];

  $link = new mysqli('localhost', 'admin', 'Admin75!');
  if ($link->connect_errno) {
  die ("Erreur de connexion : errno: " . $link->errno .
                    "error:" . $link->error);
  }

  $link->select_db('aeroport') or die("Erreur selection BD: ".$link->error);

  /*Vérification de l'identifiant*/
  $identifiant = $link->query("SELECT identifiant FROM Compte") or die("Search Error:" .$link->error());
  $iterator = $identifiant->fetch_assoc();

  while($iterator)
  {
      if($iterator['identifiant']==$id)
      {
        $link->close();
        header('Location: http://localhost/projet/connexion_passager/aeroport_sign_error_id_passager.php');
        exit();
      }

      $iterator = $identifiant->fetch_assoc();
  }

  /*Vérification du numéro de passeport*/
  $num_pass = $link->query("SELECT num_passeport FROM Passager") or die("Search Error:" .$link->error());
  $iterator = $num_pass->fetch_assoc();

  while($iterator)
  {
      if($iterator['num_passeport']==$passeport)
      {
        $link->close();
        header('Location: http://localhost/projet/connexion_passager/aeroport_sign_error_passeport_passager.php');
        exit();
      }

      $iterator = $num_pass->fetch_assoc();
  }

  /*Vérification de l'email*/
  $mail = $link->query("SELECT email FROM Compte") or die("Search Error:" .$link->error());
  $iterator = $mail->fetch_assoc();

  while($iterator)
  {
      if($iterator['email']==$email)
      {
        $link->close();
        header('Location: http://localhost/projet/connexion_passager/aeroport_sign_error_email_passager.php');
        exit();
      }

      $iterator = $mail->fetch_assoc();
  }

  /*Trouver le dernier id_passager*/
  $last_id = $link->query("SELECT COUNT(*) as nb_passagers FROM Passager") or die("Search Error:" .$link->error());
  $iterator = $last_id->fetch_assoc();
  $new_id = $iterator['nb_passagers']+1;

  $link->query("INSERT INTO Passager VALUES($new_id,'$nom','$prenom','$sexe','$date','$nationalite','$adr','$num','$passeport')") or die("Insert Error:" .$link->error());
  $link->query("INSERT INTO Compte VALUES($id,'$mdp','$email',$new_id)") or die("Insert Error:" .$link->error());

  $link->close();
  ?>
    <div align="center">
      <h3>Votre inscription a été enregistré.</h3>
      <a href="accueil.php">
        <img src="../images/button_accueil.php" alt="Accueil">
      </a>
    </div>
  </body>
</html>
