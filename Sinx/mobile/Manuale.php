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
?>
      <h3>Manuale Sinx</h3>
<table cellspacing="1" cellpadding="5" border="0" align="center">
    <tbody>
	<tr>
	<td>
	<a target="_blank" href="http://www.mokazine.com/read/sinx/manuale-di-sinx-versione-0-97"><img width="212" src="http://s3.mokazine.com/moka/9459/magazine/manuale-di-sinx-versione-0-97-cover.jpg?r=1454932307" style="cursor:pointer; border:0"></a>
	</td>
	</tr> 
	

    </tbody>
</table>
<?php
include('./menusx.inc');
include('./botton.inc');
} else {
header('Location: index.php');
}
?>
