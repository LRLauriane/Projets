<!DOCTYPE html>


	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style_destination.css" type="text/css" />
		<title>Destination vols</title>
	</head>

	<body>
		<a href = "./accueil.php">
			<input type="button" value="Accueil" />
		</a>
		<h1>LES DESTINATIONS DE L'AÉROPORT</h1>
		<div style = "position:absolute;top:110px">
			<h2>A</h2>
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
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 'a%' GROUP BY arrivee ORDER BY arrivee";
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
}

$result->free();
?>


			</p>
			<h2>B</h2>
			<p>

<?php

// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 'b%' GROUP BY arrivee ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($vol = $result->fetch_assoc())
{
echo '<p>' . $vol['arrivee'] . '</p>';
}

$result->free();
?>
			</p>
		</div>

		<div style = "position:absolute;left:300px;top:110px">
			<h2>C</h2>
			<p>

<?php

// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 'c%' GROUP BY arrivee ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}
while($vol = $result->fetch_assoc())
{
echo '<p>' . $vol['arrivee'] . '</p>';
}

$result->free();
?>
			</p>
			<h2>D</h2>
			<p>


<?php


// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 'd%' GROUP BY arrivee ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($vol = $result->fetch_assoc())
{
echo '<p>' . $vol['arrivee'] . '</p>';
}

$result->free();
?>
			</p>

			<h2>F</h2>
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
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 'f%' ORDER BY arrivee";
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
}

$result->free();
?>			</p>

			<h2>H</h2>
			<p>


<?php
// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 'h%' ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($vol = $result->fetch_assoc())
{
echo '<p>' . $vol['arrivee'] . '</p>';
}

$result->free();
?>
			</p>

		</div>


		<div style = "position:absolute;left:600px;top:110px">

		<h2>L</h2>
			<p>


<?php

// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 'l%' GROUP BY arrivee ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($vol = $result->fetch_assoc())
{
echo '<p>' . $vol['arrivee'] . '</p>';
}

$result->free();
?>				</p>

		<h2>M</h2>
			<p>


<?php
// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 'm%' GROUP BY arrivee ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($vol = $result->fetch_assoc())
{
echo '<p>' . $vol['arrivee'] . '</p>';
}

$result->free();
?>
			</p>
		</div>
		<div style = "position:absolute;left:900px;top:110px">
		<h2>N</h2>
		<p>


<?php
// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 'n%' GROUP BY arrivee ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($vol = $result->fetch_assoc())
{
echo '<p>' . $vol['arrivee'] . '</p>';
}

$result->free();
?>
		</p>

		<h2>O</h2>
		<p>


<?php
// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 'o%' ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($vol = $result->fetch_assoc())
{
echo '<p>' . $vol['arrivee'] . '</p>';
}

$result->free();
?>
		</p>
		<h2>P</h2>
		<p>


<?php

// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 'p%' ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($vol = $result->fetch_assoc())
{
echo '<p>' . $vol['arrivee'] . '</p>';
}

$result->free();
?>			</p>
			<h2>R</h2>
		<p>


<?php
// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 'r%' ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}


while($vol = $result->fetch_assoc())
{
echo '<p>' . $vol['arrivee'] . '</p>';
}

$result->free();
?>
		</p>
		</div>
		<div style = "position:absolute;left:1200px;top:110px">
		<h2>S</h2>
		<p>


<?php
// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 's%' ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}


while($vol = $result->fetch_assoc())
{
echo '<p>' . $vol['arrivee'] . '</p>';
}

$result->free();
?>
		</p>

		<h2>T</h2>
		<p>


<?php

// Réaliser une requête SQL
$sql = "SELECT arrivee FROM Vol WHERE depart LIKE 'paris' AND arrivee LIKE 't%' ORDER BY arrivee";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($vol = $result->fetch_assoc())
{
echo '<p>' . $vol['arrivee'] . '</p>';
}

$result->free();
$mysqli->close();
?>
		</p>
		</div>

	</body>

</html>
