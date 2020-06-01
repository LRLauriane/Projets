<!DOCTYPE html>


	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/style_destination.css" type="text/css" />
		<title>Compagnies aériennes</title>
	</head>

	<body>
		<a href = "./accueil.php">
			<input type="button" value="Accueil" />
		</a>
		<h1>LISTE DES COMPAGNIES AÉRIENNES</h1>
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
$sql = "SELECT nom FROM Compagnie WHERE nom LIKE 'a%' GROUP BY nom ORDER BY nom";
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

while($compagnie = $result->fetch_assoc())
{
echo '<p>' . $compagnie['nom'] . '</p>';
}

$result->free();
?>


			</p>
		</div>

		<div style = "position:absolute;left:500px;top:110px">
			<h2>C</h2>
			<p>

<?php
// Réaliser une requête SQL
$sql = "SELECT nom FROM Compagnie WHERE nom LIKE 'c%' GROUP BY nom ORDER BY nom";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}


while($compagnie = $result->fetch_assoc())
{
	echo '<p>' . $compagnie['nom'] . '</p>';
}

$result->free();
?>
			</p>
			<h2>D</h2>
			<p>

<?php
// Réaliser une requête SQL
$sql = "SELECT nom FROM Compagnie WHERE nom LIKE 'd%' GROUP BY nom ORDER BY nom";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}


while($compagnie = $result->fetch_assoc())
{
	echo '<p>' . $compagnie['nom'] . '</p>';
}

$result->free();
?>
			</p>

			<h2>E</h2>
			<p>

<?php
// Réaliser une requête SQL
$sql = "SELECT nom FROM Compagnie WHERE nom LIKE 'e%' GROUP BY nom ORDER BY nom";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($compagnie = $result->fetch_assoc())
{
	echo '<p>' . $compagnie['nom'] . '</p>';
}

$result->free();
?>
			</p>

			<h2>F</h2>
			<p>

<?php
// Réaliser une requête SQL
$sql = "SELECT nom FROM Compagnie WHERE nom LIKE 'f%' GROUP BY nom ORDER BY nom";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($compagnie = $result->fetch_assoc())
{
	echo '<p>' . $compagnie['nom'] . '</p>';
}

$result->free();
?>
			</p>

			<h2>I</h2>
			<p>

<?php
// Réaliser une requête SQL
$sql = "SELECT nom FROM Compagnie WHERE nom LIKE 'i%' GROUP BY nom ORDER BY nom";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($compagnie = $result->fetch_assoc())
{
	echo '<p>' . $compagnie['nom'] . '</p>';
}

$result->free();
?>
			</p>

		</div>


		<div style = "position:absolute;left:1000px;top:110px">

		<h2>K</h2>
			<p>

<?php
// Réaliser une requête SQL
$sql = "SELECT nom FROM Compagnie WHERE nom LIKE 'k%' GROUP BY nom ORDER BY nom";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($Compagnie = $result->fetch_assoc())
{
	echo '<p>' . $compagnie['nom'] . '</p>';
}

$result->free();
?>
			</p>

		<h2>L</h2>
			<p>

<?php
// Réaliser une requête SQL
$sql = "SELECT nom FROM Compagnie WHERE nom LIKE 'l%' GROUP BY nom ORDER BY nom";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($compagnie = $result->fetch_assoc())
{
	echo '<p>' . $compagnie['nom'] . '</p>';
}

$result->free();
?>
			</p>


		<h2>M</h2>
		<p>

<?php
// Réaliser une requête SQL
$sql = "SELECT nom FROM Compagnie WHERE nom LIKE 'm%' GROUP BY nom ORDER BY nom";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}

while($compagnie = $result->fetch_assoc())
{
	echo '<p>' . $compagnie['nom'] . '</p>';
}

$result->free();
?>
		</p>

		<h2>N</h2>
		<p>

<?php
// Réaliser une requête SQL
$sql = "SELECT nom FROM Compagnie WHERE nom LIKE 'n%' GROUP BY nom ORDER BY nom";
if (!$result = $mysqli->query($sql)) {
    echo "Désolé, le site web subit des problèmes.";
    echo "Error: Notre requête a échoué lors de l'exécution et voici pourquoi :\n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit;
}


while($compagnie = $result->fetch_assoc())
{
	echo '<p>' . $compagnie['nom'] . '</p>';
}

$result->free();
?>
		</p>
		<h2>R</h2>
		<p>

<?php
// Réaliser une requête SQL
$sql = "SELECT nom FROM Compagnie WHERE nom LIKE 'r%' ORDER BY nom";
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

while($compagnie = $result->fetch_assoc())
{
	echo '<p>' . $compagnie['nom'] . '</p>';
}

$result->free();
?>
		</p>

		<h2>S</h2>
		<p>

<?php
// Réaliser une requête SQL
$sql = "SELECT nom FROM Compagnie WHERE nom LIKE 's%' ORDER BY nom";
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

while($compagnie = $result->fetch_assoc())
{
	echo '<p>' . $compagnie['nom'] . '</p>';
}

$result->free();
$mysqli->close();
?>
		</p>
		</div>

	</body>

</html>
