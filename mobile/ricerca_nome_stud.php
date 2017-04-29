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

$langnomstud = $_SESSION['lingua'];
$paginanomstud = "ricercanomestud.inc";
$linguanomstud = ($langnomstud.$paginanomstud);
include($linguanomstud);

if ($user) {
include('./top.inc');
include('./menu.inc');
$iniz = $_POST['iniziale'];
$tipologia = $_GET[tipologia];

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

//$ultimoid = mysql_query("SELECT MAX(id_anagrafe) FROM tb_anagrafe"); 

$Query_nome = "SELECT * FROM tb_anagrafe WHERE tipologia = '$tipologia' AND nome REGEXP '^$iniz' ORDER BY nome";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<center><h2>$Lelencosoci</h2></center>
<table align='center' border='0' cellpadding='3' cellspacing='2' width='95%'>
	<tr>
	<td height='30px' width='2%' align='center'><small><b>id </b></small></td>
	<td width='5%'><small><b>$Lntessera </b></small></td>
	<td width='10%'><small><b>$Lnome </b></small></td>
	<td width='20%'><small><b>$Lindirizzo </b></small></td>
	<td width='20%'><small><b>$LCitta </b></small></td>
	<td width='10%'><small><b>$LProvincia </b></small></td>
	<td width='20%'><small><b>$Lemail </b></small></td>
	<td width='10%'><small><b>$LFunzTipo </b></small></td>
	<td width='3%'><small><b>$LAttivo</b></small></td>
	</tr>
	<tr><td></td></tr>
EOM;
}

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td height='30px' width='150'; align='center'><small><sub>vai scheda</sub><form method="post" action="./Scheda_associato.php">
		<input type="submit" name="associato" value="$row[id_anagrafe]">
		</form></small></td>
        <td ><small>$row[ntessera]</small></td>
	<td ><small>$row[nome]</small></td>
	<td ><small>$row[indirizzo]</small></td>
	<td ><small>$row[cap] $row[citta]</small></td>
	<td ><small>$row[provincia]</small></td>
	<td ><small>$row[email]</small></td>
	<td ><small>$row[classe] $row[mansione] $row[materia]</small></td>
	<td ><small>$row[associato]</small></td>
	 </tr>

EOM;
}

echo <<<EOT
</table>
EOT;

mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><? echo $Lnota; ?><hr></i></small><?
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
