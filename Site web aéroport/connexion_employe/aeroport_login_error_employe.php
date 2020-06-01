<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Connexion</title>
  </head>
  <body>
    <div align="right">
      <a href="../accueil.php">
        <img width = "10%" src="../images/button_accueil.png" alt="Accueil">
      </a>
    </div>
    <div align="center">
      <table width="30%" class = "tableau">
        <h1>CONNEXION</h1><br>
        <h3>Cet utilisateur ne peut se connecter.</h3><br>
          <form action="aeroport_verification_employe.php" method="post">
            <tr>
              <td align="center">Votre identifiant :
                  <br>
                  <br>
                  <input type="text" name="identifiant" size="20" required>
              </td>
            </tr>
            <tr>
              <td align="center">
                  <br>
                  Votre mot de passe :
                  <br>
                  <br>
                  <input type="password" name="password" size = "20" required>
              </td>
            </tr>
            <tr>
                <td align="center">
                  <br>
                  <input type="image" width = "30%" src = "../images/button_submit.png">
                </td>
            </tr>
          </form>
      </table>
    </div>
  </body>
</html>
