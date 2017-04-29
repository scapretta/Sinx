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


// popolo la tabella
$Query_nome = "SELECT * FROM tb_email ORDER BY data DESC";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<h2><center>Lista di mail salvate</h2></center>
<table align='center' border='0' cellpadding='0' cellspacing='2' width='90%'>
	<tr>
	<td width='10%' align='center'><small><b>id</b></small></td>
	<td width='20%'><small><b>data</b></small></td>
	<td width='30%'><small><b>Destinatario</b></small></td>
	<td width='40%'><small><b>Messaggio</b></small></td>
	</tr>
	<tr><td></td></tr>
</table>
EOM;
}

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%'>
	<tr>
	<td width='10%' align='center'><small>$row[id_mail]</small></td>
	<td width='20%'><small>$row[data]</small></td>
	<td width='30%'><small>$row[dest]</small></td>
	<td width='40%'><small>$row[testo]</small></td>
	</tr><HR width='80%'>
</table><br>
EOM;
}

?>
<table align='center'>
<tr>
<td><a class="transp" href='./Comp_email.php'><img src="./ImmTemplate/Pulsanti/Email.png" title="Ritorna alla posta"></img></a></td>
</tr>
</table>

<?php
mysqli_close($connect);
include('./menusx.inc');
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
