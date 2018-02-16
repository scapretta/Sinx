<?php
/*Sinx for Association - Gestionale per Associazioni no-profit
    Copyright (C) 2011 by Sergio Capretta

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

  session_start();

$user = $_SESSION['utente'];
if ($user) {


$nnumeroric = $_POST['numero'];
$numeroric = htmlspecialchars($nnumeroric, ENT_NOQUOTES, "UTF-8");


//Funzione per il redirect
function redirect($url,$tempo = FALSE ){
 if(!headers_sent() && $tempo == FALSE ){
  header('Location:' . $url);
 }elseif(!headers_sent() && $tempo != FALSE ){
  header('Refresh:' . $tempo . ';' . $url);
 }else{
  if($tempo == FALSE ){
    $tempo = 0;
  }
  echo "<meta http-equiv=\"refresh\" content=\"" . $tempo . ";" . $url . "\">";
  }
} 



	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

//Controllo campi compilati
		if ($numeroric == "")
 		{
   		echo "<center><b>Il campo Numero &egrave obbligatorio</b></center>";
   		redirect('./InsRicFisc.php' ,2);
		// break;
die ("");
		}
		
		
// popolo la tabella delle ricevute
$Query = "SELECT * FROM tb_ricevute WHERE id_ric = '$numeroric'";

$rs=mysqli_query($connect, $Query)
or die('' . mysqli_error());

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
<table align='center' border='0' cellpadding='3' cellspacing='2' width='50%'>
	<tr>
	<td height='25px' width='50'><small>Ricevuta N.: </small></td>
	<td height='25px' width='50'><small>$row[id_ric]</small></td>
	</tr>
	<tr>
	<td height='25px' width='50'><small>Data: </small></td>
	<td height='25px' width='50'><small>$row[data]</small></td>
	</tr>
	<tr>
	<td height='25px' width='50'><small>Ricevuto da: </small></td>
	<td height='25px' width='50'><small>$row[nome]</small></td>
	</tr>
	<tr>
	<td height='25px' width='50'><small>Euro: </small></td>
	<td height='25px' width='50'><small>$row[euro]</small></td>
	</tr>
	<tr>
	<td height='25px' width='50'><small>Per: </small></td>
	<td height='25px' width='50'><small>$row[descr]</small></td>
	</tr>
	<tr><td><br></td></tr>
EOM;
}
echo <<<EOT
</table>
	<p><center><small>Firma_________________________</small></center></p>
<hr><br><bR>
EOT;
mysqli_close($connect);
} else {
header('Location: ./index.php');
}
?>

