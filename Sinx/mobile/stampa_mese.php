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
<!-- Visualizzazione calendario -->
	<small><center>Seleziona il Mese da stampare<br>
	e premeri -Stampa-
	</small></center>
<form action='./StampaCalendario.php' method='POST'><br>
	<table align='center' border='0' width='50'>
	<tbody>
		<tr>
		<td width='150'>Mese</td>
		<td><select name="ricsaula" >
	<option value="" selected="selected">Seleziona il mese da stampare</option>
  <option value="Gennaio">Gennaio</option>
  <option value="Febbraio">Febbraio</option>
  <option value="Marzo">Marzo</option>
  <option value="Aprile">Aprile</option>
  <option value="Maggio">Maggio</option>
  <option value="Giugno">Giugno</option>
  <option value="Luglio">Luglio</option>
  <option value="Agosto">Agosto</option>
  <option value="Settembre">Settembre</option>
  <option value="Ottobre">Ottobre</option>
  <option value="Novembre">Novembre</option>
  <option value="Dicembre">Dicembre</option>
</td>
</tr>
<tr><td><br></td></tr>
	<tr align='center'>
              <td colspan='2' align='center'>
              <input value='- Stampa -' type='submit'></td>

	</tr>
</table>
</form>

<?php
mysqli_close($connect);
include('./botton.inc');
} else {
header('Location: ./index.php');
}
?>



