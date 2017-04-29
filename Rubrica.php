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
$langrubrica = $_SESSION['lingua'];
$paginarubrica = "rubrica.inc";
$linguarubrica = ($langrubrica.$paginarubrica);
include($linguarubrica);

if ($user) {
include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

?>
<center><h2><?php echo $Lpresentazionerubrica; ?></h2></center>
<table align='center' border='0' cellpadding='3' cellspacing='2' width='100%'>
	<tr>
	<td width='150'><small><b><?php echo $Lnome; ?></b></small></td>
	<td width='150'><small><b><?php echo $Lindirizzo; ?></b></small></td>
	<td width='150'><small><b><?php echo $Lcitta; ?> </b></small></td>
	<td width='150'><small><b><?php echo $Lprovincia; ?> </b></small></td>
	<td width='150'><small><b><?php echo $Lemail; ?> </b></small></td>
	<td width='150'><small><b><?php echo $Ltelefono; ?> </b></small></td>
	<td width='150'><small><b><?php echo $Ltelefono; ?> </b></small></td>
	<td width='150'><small><b><?php echo $Ldatanasc; ?> </b></small></td>
	</tr>
	<tr><td></td></tr>
</table>
<?php
$alfabeto = array(1 => "a", "b", "c", "d", "e", "f" ,"g" ,"h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t" ,"u", "v", "w", "x", "y", "z");
for ($cont=1; $cont<27; $cont++)
{
$Query_nome = "SELECT * FROM tb_anagrafe WHERE nome REGEXP '^$alfabeto[$cont]' ORDER BY nome";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<small><b><span style="background-color:#fffdb9">- $alfabeto[$cont] -</b></small><br>
<br>
<table align='center' border='0' cellpadding='3' cellspacing='2' width='100%'>

EOM;
}

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td width='150'><small>$row[nome]</small></td>
	<td width='150'><small>$row[indirizzo]</small></td>
	<td width='150'><small>$row[cap] $row[citta]</small></td>
	<td width='150'><small>$row[provincia]</small></td>
	<td width='150'><small>$row[email]</small></td>
	<td width='150'><small>$row[tel]</small></td>
	<td width='150'><small>$row[tel2]</small></td>
	<td width='150'><small>$row[datan]</small></td>
	</tr>

EOM;
}

echo <<<EOT
</table>
EOT;
}
mysqli_close($connect);
include('./menusx.inc');
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>
