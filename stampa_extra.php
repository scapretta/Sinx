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
$langstampasoci = $_SESSION['lingua'];
$paginastampasoci = "stampaextra.inc";
$linguastampasoci = ($langstampasoci.$paginastampasoci);
include($linguastampasoci);

if ($user) {

include('./Intestazione.php');

$ordine = $_POST['ordine'];

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

?>
     <center><h2><?php echo $Ltitolosoci; ?></h2></center>

<?php
// $classe = $_POST['classi'];
$Query_nome = "SELECT * FROM tb_anagrafe WHERE tipologia = 'Extra' ORDER BY $ordine";

$rs=mysqli_query($connect, $Query_nome)
or die("Errore nella query $query: " . mysqli_error()); //die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='2' width='90%'>
	<tr>
	<td width='5%'><small><b>$Lid</b></small></td>
	<td width='10%'><small><b>$Lnome</b></small></td>
	<td width='25%'><small><b>$Lindirizzo</b></small></td>
	<td width='20%'><small><b>$Lcitta</b></small></td>
	<td width='5%'><small><b>$Lprovincia</b></small></td>
	<td width='10%'><small><b>$Lcodfisc</b></small></td>
	<td width='15%'><small><b>$Lemail</b></small></td>
	<td width='10%'><small><b>$Lnote</b></small></td>
	
	</tr>
	<tr><td></td></tr>
EOM;
}

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td><small><center>$row[ntessera]</center></small></td>
	<td ><small>$row[nome]</small></td>
	<td ><small>$row[indirizzo]</small></td>
	<td ><small>$row[cap] $row[citta]</small></td>
	<td ><small>$row[provincia]</small></td>
	<td ><small>$row[nomerif]</small></td>
	<td ><small>$row[email]</small></td>
	<td ><small>$row[note]</small></td>

	</tr>

EOM;
}

echo <<<EOT
</table>
EOT;

mysqli_close($connect);

} else {
header('Location: ./index.php');
}
?>



