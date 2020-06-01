 <!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <title>Consultation</title>
  </head>

  <body style = "background-image : url(images/horaires.jpg)" >
 <p>




 <?php
 $depart=$_POST['depart'];
 $arrivee=$_POST['destination'];

 $mysqli = new mysqli('localhost', 'admin', 'Admin75!', 'aeroport');
 if ($mysqli->connect_errno) {
	  echo "Erreur de connexion : errno:" . $mysqli->errno . "error:" . $mysqli->error;
	     exit;
	  }
$sql = "SELECT depart,arrivee,date_vol,horaires,Avion.nom FROM Vol,Avion
WHERE depart LIKE '$depart'
AND arrivee LIKE '$arrivee'
AND Vol.id_avion=Avion.id_avion";

if (!$result = $mysqli->query($sql))
{
	echo "SELECT error in query " . $sql . "errno:" . $mysqli->errno . " error: " . $mysqli->error;
	 exit;
	 }
$num_rows = $result->num_rows;
if($num_rows==0)
{
	print "Aucun résultat trouvé";
}
else{
	print "Il y a $num_rows résultat(s) trouvé(s).<br/> <br/>";
	print "<table width=1250 border=1 bgcolor=white>\n";
}
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
