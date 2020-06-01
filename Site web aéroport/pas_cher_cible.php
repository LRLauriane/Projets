 <!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <title>Prix bas billet</title>
  </head>

  <body style = "background-image : url(images/avion2.jpg)" >
 <p>

 <?php
 $depart=$_POST['depart'];
 $arrivee=$_POST['arrivée'];
 $mysqli = new mysqli('localhost', 'admin', 'Admin75!', 'aeroport');
 if ($mysqli->connect_errno) {
	  echo "Erreur de connexion : errno:" . $mysqli->errno . "error:" . $mysqli->error;
	     exit;
	  }
$sql = "SELECT V.num_vol,V.depart,V.arrivee,V.date_vol,V.horaires,V.escale,V.porte,MIN(prix)
FROM Vol AS V, Billet AS B
WHERE B.num_vol = V.num_vol
AND V.depart LIKE '$depart'
AND V.arrivee LIKE '$arrivee'
AND B.date_reservation IS NULL
GROUP BY V.num_vol";


if (!$result = $mysqli->query($sql))
{
	echo "SELECT error in query " . $sql . "errno:" . $mysqli->errno . " error: " . $mysqli->error;
	 exit;
}

$num_rows = $result->num_rows;
if($num_rows==0)
{
	print "Aucun résultat trouvé";
  exit;
}
else{
	print "Résultat trouvé : <br/> <br/>";
	print "<table width=1250 border=1 bgcolor=white>\n";
}
print "
    <tr>
      <th>Numéro de vol</th>
      <th>Départ</th>
      <th>Arrivée</th>
      <th>Date</th>
      <th>Horaires</th>
      <th>Escale</th>
      <th>Porte</th>
      <th>Prix</th>
    </tr>
";
while ($get_info = $result->fetch_row()){
	print "<tr>\n";
	foreach ($get_info as $field)
	print "\t<td>$field</td>\n";
	print "</tr>\n"; }

print "</table>\n";
$result->free();
$mysqli->close();
?>

 </p>
 </body>
 </html>
