<!DOCTYPE html>


	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style_destination.css" type="text/css" />
		<title>Classement destinations</title>
	</head>

	<body>
		<a href = "./accueil.php">
			<input type="button" value="Accueil" />
		</a>
		<h1>CLASSEMENT DES DESTINATIONS LES PLUS TOURISTIQUES</h1>
		<div align = "center">
			<p>
				<?php

$user = 'localhost';
$database = 'aeroport';
$mysqli = new mysqli($user, 'admin', 'Admin75!',$database);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}


// Réaliser une requête SQL
$sql = "SELECT arrivee
FROM(
  SELECT arrivee,COUNT(num_billet) as Nb_billets
  FROM Vol,Billet
  WHERE Vol.num_vol = Billet.num_vol
  AND Vol.arrivee NOT LIKE 'Paris'
  GROUP BY arrivee
) as NPPV
ORDER BY Nb_billets DESC;";

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

while($destination = $result->fetch_assoc())
{
echo '<p>' . $destination['arrivee'] . '</p>';
}

$result->free();
$mysqli->close();
?>


			</p>

	</body>

</html>
