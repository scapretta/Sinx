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
include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

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

$tipo = $_POST['ricevute'];
$campo = $_POST['campo'];

//Controllo campi compilati
		if ($tipo == "")
 		{
   		echo "<center><b>Il campo di ricerca &egrave obbligatorio</b></center>";
   		redirect('./ricerca.php' ,2);
		// break;
die ("");
		}

$Query_nome = "SELECT tb_ricevute.*, tb_anagrafe.id_anagrafe
FROM tb_ricevute, tb_anagrafe
WHERE tb_ricevute.nome = tb_anagrafe.nome AND (CONVERT(tb_ricevute.`$campo` USING utf8) LIKE '%$tipo%')";

$rs=mysqli_query($connect, $Query_nome)
or die("Errore nella query $query: " . mysqli_error()); //die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<p><center><h2>Elenco Associati con <i>$tipo</i></h2></center></p>
<table align='center' border='0' cellpadding='3' cellspacing='2' width='100%'>
	<tr>
	<td height='30px' width='20%' align='center' colspan='2'><small><b>Vedi ricevuta</b></small></td>
	<td width='10%' align='center'><small><b>scheda associato </b></small></td>
	<td width='15%'><small><b>nome </b></small></td>
	<td width='10%'><small><b>data </b></small></td>
	<td width='15%'><small><b>euro </b></small></td>
	<td width='30%'><small><b>descrizione </b></small></td>
	</tr>
	<tr><td></td></tr>
EOM;
}

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td height='30px' align='center'><small><form method="post" action="./stampa_rfisc.php" target="_blank">
		<input type="submit" name="numero" value="$row[id_ric]">
		</small></td>
	<td ><input type="radio" name="tipo" value="immagine" checked="checked"/><small><sub>immagine</sub></small><br>
	<input type="radio" name="tipo" value="foglio"/><small><sub>pagina</sub></small></form></td>
	<td ><small><form method="post" action="./Scheda_associato.php"><center>
		<input type="submit" name="associato" value="$row[id_anagrafe]"></center>
		</form></small></td>
	<td ><small>$row[nome]</small></td>
	<td ><small>$row[data]</small></td>
	<td ><small>$row[euro]</small></td>
	<td ><small>$row[descr]</small></td>

	</tr>

EOM;
}

echo <<<EOT
</table>
EOT;

mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Per visualizzare la scheda di un associato, inserisci l'id (numero identificativo) in 'scheda associato' e premi 'visualizza'
<hr></i></small><?
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
