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

include('./Intestazione.php');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

?>
     <p align="center"><b>Scheda Associato</b></p><br>

<?php
$associato = $_POST['associato'];
$Query_nome = "SELECT * FROM tb_anagrafe WHERE id_anagrafe = $associato";

$rs=mysqli_query($connect, $Query_nome)
or die("Errore nella query $Query_nome: " . mysqli_error()); //die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_array($rs))
{

echo <<<EOM
<b><center> $row[nome]</b><br></center>
<table align='center' border='0' cellpadding='0' cellspacing='2' width='90%'>
	<tr><td><img src='./Immagini/Utenti/personal.gif'><td height='40px' width='150'><small><b>id: </b>$row[id_anagrafe]</small></td></td></tr>
	<tr><td width='150'><small><b>Indirizzo </b></small></td><td width='150'><small>$row[indirizzo]</small></td></tr>
	<tr><td width='150'><small><b>c.a.p. </b></small></td><td width='150'><small>$row[cap]</small></td></tr>
	<tr><td width='150'><small><b>Citta </b></small></td>	<td width='150'><small>$row[citta]</small></td></tr>
	<tr><td width='150'><small><b>Provincia </b></small></td>	<td width='150'><small>$row[provincia]</small></td></tr>
	<tr><td width='150'><small><b>Telefono </b></small></td>	<td width='150'><small>$row[tel]</small></td></tr>
	<tr><td width='150'><small><b>Telefono 2 </b></small></td>	<td width='150'><small>$row[tel2]</small></td></tr>
	<tr><td width='150'><small><b>e-mail </b></small></td>	<td width='150'><small>$row[email]</small></td></tr>
	<tr><td width='150'><small><b>Tipo Socio </b></small></td>	<td width='150'><small>$row[materia]</small></td></tr>
	<tr><td width='150'><small><b>Codice Fiscale </b></small></td>	<td width='150'><small>$row[nomerif]</small></td></tr>
	<tr><td width='150'><small><b>Data nascita </b></small></td>	<td width='150'><small>$row[datan]</small></td></tr>
	<tr><td width='150'><small><b>Funzione </b></small></td>	<td width='150'><small>$row[classe]</small></td></tr>
	<tr><td width='150'><small><b>Mansione </b></small></td>	<td width='150'><small>$row[mansione]</small></td></tr>
	<tr><td width='150'><small><b>Socio Attivo </b></small></td>	<td width='150'><small>$row[associato]</small></td></tr>
	<tr><td width='150'><small><b>note </b></small></td>	<td width='150'><small>$row[note]</small></td></tr>
</table><hr>
EOM;

// popolo la tabella delle ricevute
$Query = "SELECT * FROM tb_ricevute WHERE nome = '$row[nome]'";
$rb=mysqli_query($connect, $Query)
or die("Errore nella query $Query: " . mysqli_error());

while ($row=mysqli_fetch_array($rb))


echo <<<EOM
<b><center>Ricevuta emessa</b></center><br>
<table align='center' border='0' cellpadding='0' cellspacing='2' width='40%'>
	<tr><td height='25px' width= '20%' <small><b>num ricevuta</b></small></td><td height='25px' width='10%' align='center'><small>$row[id_ric]</small></td></tr>
	<tr><td width='20%'><small><b>data</b></small></td>	<td height='25px' width='20%' align='center'><small>$row[data]</small></td></tr>
	<tr><td width='20%'><small><b>euro</b></small></td>	<td height='25px' width='20%' align='right'><small>$row[euro]</small></td></tr>
	<tr><td width='40%'><small><b>descr</b></small></td>	<td height='25px' width='40%' align='right'><small>$row[descr]</small></td></tr>
</table><hr>
EOM;
}

mysqli_close($connect);

} else {
header('Location: ./index.php');
}
?>



