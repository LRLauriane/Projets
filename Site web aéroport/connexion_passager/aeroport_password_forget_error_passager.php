<!DOCTYPE html>
<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_connexion.css" type="text/css" />
    <title>Vos informations</title>
  </head>
  <body>
    <div align="right">
      <a href="aeroport_login_passager.php">
        <img src="../images/button_connect.png" alt="Connexion" width="11%">
      </a>
      <a href="aeroport_sign_passager.php">
        <img src="../images/button_sign.png" alt="Inscription" width="11%">
      </a>
    </div>
    <form action="aeroport_check_infos.php" method="post">
      <div align="center">
        <br><h3>Veuillez renseigner les informations suivantes : </h3><br>
        <br><h4>Identifiant ou email incorrect.</h4><br>
        <table width="30%" class = "tableau">
          <tr>
            <td align="center">
              Votre identifiant :
              <br>
              <br>
            <input type="number" name="identifiant" min="1" required>
            </td>
          </tr>
          <tr>
            <td align="center"><br>
              Votre email:
              <br>
              <br>
            <input type="text" name="email" required>
            </td>
          </tr>
          <tr>
            <td align="center">
              <br>
              <input type="image" width = "35%" src="../images/button_submit.png">
            </td>
          </tr>
        </table>
      </div>
    </form>
  </body>
</html>
