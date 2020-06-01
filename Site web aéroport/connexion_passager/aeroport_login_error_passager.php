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
        <img src="../images/button_accueil.png" alt="Accueil" width="11%">
      </a>
      <a href="aeroport_sign_passager.php">
        <img src="../images/button_sign.png" alt="Inscription" width="11%">
      </a>
    </div>
    <div class="login" align="center">
      <table width="30%" class="tableau">
        <h1>CONNEXION</h1><br>
          <h4>Votre identifiant et/ou mot de passe est incorrect</h4><br>
          <form action="aeroport_verification_passager.php" method="post">
            <tr>
              <td align="center">Votre identifiant :
                  <br>
                  <br>
                  <input type="number" name="identifiant" min = "1" size="20" required>
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
                  <input type="image" width = "35%" src="../images/button_submit.png">
                </td>
            </tr>
          </form>
      </table>
    </div>
  </body>
</html>
