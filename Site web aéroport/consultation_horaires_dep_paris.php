<!DOCTYPE html>
<html>
    <head><title>Consultation horaires</title></head>
    <link rel="stylesheet" href="css/style_consultation.css" type="text/css" />
    <body>
		<a href = "./accueil.php">
			<input type="button" value="Accueil" class = "accueil"/>
		</a>
        <h1>Consulation des horaires de vol ayant pour départ Paris</h1>
        <div align="center">
      <table width="30%" bgcolor="#CEE3F6">
        <br><br><br>
           <form method="post" action="cible_saisie.php">
            <tr>
              <td align="center">Départ :
                  <br>
                  <br>
				   <select name="depart">
					<option>Paris</option>
				   </select>
              </td>
            </tr>
            <tr>
              <td align="center">
                  <br>
                  Destination :
                  <br>
                  <br>
                  <select name="destination">
				<option <?php

$user = 'localhost';
$database = 'aeroport';
$mysqli = new mysqli($user, 'admin', 'Admin75!',$database);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}


// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'Paris' GROUP BY arrivee ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

if ($result->num_rows === 0) {
    echo "Nous n'avons pas trouvé de correspondance pour ID $aid, nous sommes désolé. Veuillez réessayer de nouveau.";
    exit;
}

while($vol = $result->fetch_assoc())
{


echo '<p>' . $vol['arrivee'] . '</p>';
	?>
	</option>
	<option
	<?php
}

$result->free();
?>
</option>
            </select>
                  <br>
                  </td>
            </tr>
            <tr>
                <td align="center">
                  <br>
                  <input type="submit" value="Trouver">
                </td>
            </tr>
          </form>
      </table><br>
    </div>
    </body>
</html>
