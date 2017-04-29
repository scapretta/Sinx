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
$langstampacal = $_SESSION['lingua'];
$paginastampacal = "stampacal.inc";
$linguastampacal = ($langstampacal.$paginastampacal);
include($linguastampacal);

if ($user) {

include('./Intestazione.php');

$ordine = $_POST['ordine'];

	include ('./dati_db.inc');
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");


?>

<!-- Tabella di tutti gli appuntamenti -->
<h3>Tutti gli appuntamenti registrati</h3>


<table width='100%' align="center" border='0'>
	<tr>
	<td height='25px' width='5%' align='center'><small><b>id</b></small></td>
	<td height='25px' width='10%' align='center'><small><b><? echo $Ldatacal2 ?></b></small></td>
	<td height='25px' width='20%'><small><b><? echo $Ltitolo2cal2 ?></b></small></td>
	<td height='25px' width='65%'><small><b><? echo $Ltestocal2 ?></b></small></td>
	</tr>
<?php

$Query = "SELECT * FROM appuntamenti ORDER BY id";
$rs=mysql_query($Query)
or die('' . mysql_error());

while ($row=mysql_fetch_array($rs))
{

echo <<<EOM

	<tr>
	<td height='25px' width='5%' align='center' valign='top'><small>$row[id]</small></td>
	<td height='25px' width='10%' align='center' valign='top'><small>$row[str_data]</small></td>
	<td height='25px' width='20%' valign='top'><small>$row[titolo]</small></td>
	<td height='25px' width='65%' valign='top'><small>$row[testo]</small></td>
	</tr>
EOM;
}
{
echo <<<EOT
</table>
EOT;
}

mysql_close();

} else {
header('Location: ./index.php');
}

?>



