<?php
/*======================================================================+
 File name   : menu.inc
 Begin       : 2012-12-28
 Last Update : 2012-12-28

 Description : File comunity
               menu

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
if ($user) {
//Recupero l'ultimo id della tabella
$Query = "SELECT MAX(id_anagrafe) FROM tb_anagrafe";
$Qultimoid = mysqli_query($connect, $Query);
while($Tultimoid = mysqli_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(id_anagrafe)'];
}
?>

<!-- Dettagli utente -->
<table align='center' border='0' width='40%'>
<tbody><center><h2>Scheda associato</h2><small><sub><i>Per consentire la visualizzazione completa del singolo associato</i></sub></small></center><br>
	<tr>
		<td><p><small>Inserisci il numero id dell'associato desiderato</small></p></td>
	<td><form action='./Scheda_associato.php' method='POST'>
		</td>		
		<td width='10'>ID*:</td>

<!-- Creo la combo -->
              <td><select name="associato" >
   <option value="" selected="selected"></option>

<?php


$a = '1';
do {
$query = "SELECT id_anagrafe
	FROM tb_anagrafe
	WHERE id_anagrafe = $a
	ORDER BY id_anagrafe
	LIMIT 1";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
$a++;
} while ($a <= $ultimoid);
?>
  </select></td>

	<td><p colspan='2' align='center'>
		<input value='- Visualizza -' type='submit'></p>
	</td>
	</tr>
	</form>
</tbody>
</table>

<?php
} else {
header('Location: ./index.php');
}
?>
