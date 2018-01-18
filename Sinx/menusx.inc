<?php
/*======================================================================+
 File name   : menu.inc
 Begin       : 2010-08-04
 Last Update : 2013-08-13

 Description : secondary menu

 Author: Sergio Capretta

 (c) Copyright:
               Sergio Capretta
             
               ITALY
               www.sinx.it
               info@sinx.it

Sinx for Association - Gestionale per Associazioni no-profit
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
=========================================================================+*/

session_start();
$user = $_SESSION['utente'];
$langmenusx = $_SESSION['lingua'];
$paginamenusx = "menusx.inc";
$linguamenusx = ($langmenusx.$paginamenusx);
include($linguamenusx);

if ($user) {
	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");


?>
<td style="vertical-align: top;" bgcolor="#e8e8e8">

<?php
include ('./Mese.php');

$oggi = date("j-n-Y");
echo <<<html
<hr style="width: 60%; height: 2px;">

<table class='bordo' align="center" width='100%' border='0'><small><center><b> $Loggi</b></center></small>
	<tr>
	<td height='25px' width='30%'><small><b>$Ltitolo</b></small></td>
	<td height='25px' width='70%'><small><b>$Ldescrizione</b></small></td>
	</tr>
html;


//Popolo la tabella appuntamenti del giorno
$Query = "SELECT * FROM appuntamenti WHERE str_data='$oggi'";
$rs=mysqli_query($connect, $Query) or die('' . mysqli_error());

while ($row=mysqli_fetch_array($rs))
{

echo <<<EOM

	<tr>
	<td height='25px' ><small>$row[titolo]</small></td>
	<td height='25px' ><small>$row[testo]</small></td>
	</tr>
EOM;
}
{
echo <<<EOT
</table>
EOT;
}

}
mysqli_close($connect);
?>
