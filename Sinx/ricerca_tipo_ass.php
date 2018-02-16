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

$tipo = $_POST['tipo'];

//Controllo campi compilati
		if ($tipo == "")
 		{
   		echo "<center><b>Il campo Tipo &egrave obbligatorio</b></center>";
   		redirect('./ricerca.php' ,2);
		die ("");
		// break;
		}

//include('./modifica_cancella.inc'); //Inserisco le funzioni Modifica e cancella

$Query_nome = "SELECT * FROM tb_anagrafe WHERE materia = '$tipo' AND tipologia = 'Ins' ORDER BY nome";

$rs=mysqli_query($connect, $Query_nome)
or die("Errore nella query $query: " . mysqli_error()); //die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<p><center><h2>Elenco Associati tipo <i>$tipo</i></h2></center></p>
<table align='center' border='0' cellpadding='3' cellspacing='2' width='100%'>
	<tr>
	<td height='40px' width='150'><small><b>id </b></small></td>
	<td width='150'><small><b>nome </b></small></td>
	<td width='150'><small><b>indirizzo </b></small></td>
	<td width='150'><small><b>Citt&agrave </b></small></td>
	<td width='150'><small><b>Provincia </b></small></td>
	<td width='150'><small><b>tel </b></small></td>
	<td width='150'><small><b>tel2 </b></small></td>
	<td width='150'><small><b>e-mail </b></small></td>
	</tr>
	<tr><td></td></tr>
EOM;
}

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td height='30px' width='150' align='center'><small>$row[id_anagrafe]</small></td>
	<td width='150'><small>$row[nome]</small></td>
	<td width='150'><small>$row[indirizzo]</small></td>
	<td width='150'><small>$row[cap] $row[citta]</small></td>
	<td width='150'><small>$row[provincia]</small></td>
	<td width='150'><small>$row[tel]</small></td>
	<td width='150'><small>$row[tel2]</small></td>
	<td width='150'><small>$row[email]</small></td>
	</tr>

EOM;
}

echo <<<EOT
</table><hr>
EOT;
include('./Scheda_ass.inc');

mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Per visualizzare la scheda di un associato, inserisci l'id (numero identificativo) in 'scheda associato' e premi 'visualizza'
<hr></i></small><?
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
