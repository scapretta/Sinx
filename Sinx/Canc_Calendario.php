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

if ($user == 'admin') {
  $limit=''; $limite='';
} else if ($user == 'limitato') {
  $limit='disabled'; $limite='';
} else if ($user == 'operatore') {
  $limit='disabled'; $limite='';
} else if ($user == 'associato') {
  $limit='disabled'; $limite='disabled';
}

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

//Recupero l'ultimo id della tabella
$Query = "SELECT MAX(id) FROM appuntamenti";
$Qultimoid = mysqli_query($connect, $Query);
while($Tultimoid = mysqli_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(id)'];
}
?>

<p><center><h3>Cancella singolo evento</h3></center></p>
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
	<form action='./conf_canc_cal.php' method='POST'>
	<td><select name="id" >
   <option value="" selected="selected"></option>
<?php
// Creo la combo
$a = '1';
do {
$query = "SELECT id
	FROM appuntamenti
	WHERE id = $a
	ORDER BY id
	LIMIT 1";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
$a++;
} while ($a <= $ultimoid);
?></select></td>
		<td><input name="data" readonly="text" value="<?php echo $_GET[cod]; ?>"></td>
	  </tr>
	  <tr>
	<td></td>
		<td><p colspan='2' align='center'>
		<input value='- Cancella singolo evento -' type='submit' <?php echo($limite) ?>></p>
		</td>
	</tr>
</tbody>
</table>
</form>
<hr style="width: 80%; height: 2px;">

<!-- Cancello tutto il calendario -->
<table align='center' border='0' width='40%'>
<tbody>
	<tr><td><h3>Cancella tutto</h3></td>
	
	<form action='./conf_canc_all_cal.php' method='POST'>

	  </tr>
	  <tr>
		<td><p colspan='2' align='center'>
		<input value='- Cancella tutto -' type='submit' <?php echo($limite) ?>></p>
		</td>
	</tr>
</tbody>
</table>
</form>
<hr style="width: 80%; height: 2px;">

<?
mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Puoi cancellare un singolo evento o tutti gli eventi<bt>Gli eventi cancellati non si possono recuperare
<hr></i></small><?
include('./botton.inc');

?>
