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

<p><center><b>Cancella</b></center></p>
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
		<input value='- Cancella -' type='submit' <?php echo($limite) ?>></p>
		</td>
	</tr>
</tbody>
</table>
</form>
<hr style="width: 80%; height: 2px;">

<!-- Sezione modifica -->
<p><center><b>Modifica</b></center></p>

<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod_cal.php' method='POST'></td>
            <tr>
	<td width='150'><small>Solo in caso di modifica </small><b><font color="red">id*:</b></td>
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
} while ($a <= 1000);
?></select></td>
	</tr>
            <tr>
              <td></td>
              <td><input name="data" readonly="text" value="<?php echo $_GET[cod]; ?>"></td>
            </tr>
            <tr>
	<td width='150'><font color="red"><b>Titolo*:</b></td>
	<td><input name="campo" type="text"></td>
	</tr>
	<tr>
		<td width='150'><font color="red"><b>Testo *:</b></td>
		<td><textarea name="record" cols="40" rows="4"></textarea></td>
	</tr>
	<tr><td></td>
	  <td><p colspan='2' align='center'>
	  <input name='modifica' value=' Modifica ' type='submit' <?php echo($limit); echo($limite); ?>>
	  <input name='nuovo' value=' Nuovo ' type='submit' <?php echo($limit); echo($limite); ?>></p></td>
	</tr>
</tbody>
</table>
</form> 
<hr style="width: 60%; height: 2px;">

<table class='bordo' width='60%' align="center"><h3>Appuntamento</h3>
	<tr>
	<td height='25px' width='10%' align='center'><small><b>id</b></small></td>
	<td height='25px' width='10%' align='center'><small><b>Data</b></small></td>
	<td height='25px' width='20%'><small><b>Titolo</b></small></td>
	<td height='25px' width='30%'><small><b>Testo</b></small></td>
	</tr>
<?php
$Query = "SELECT * FROM appuntamenti WHERE str_data='$_GET[cod]'";

$rs=mysqli_query($connect, $Query)
or die('' . mysqli_error());

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM

	<tr>
	<td height='25px' width='10%' align='center'><small>$row[id]</small></td>
	<td height='25px' width='10%' align='center'><small>$row[str_data]</small></td>
	<td height='25px' width='20%'><small>$row[titolo]</small></td>
	<td height='25px' width='30%'><small>$row[testo]</small></td>
	</tr>
EOM;
}
{
echo <<<EOT
</table><p></p>
EOT;
}

mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i>Se devi aggiungere un'altro appuntamento, inserisci titolo e descrizione e premi 'Nuovo'.<br>Se devi modificare un appuntamento, devi inserire anche l'id dell'appuntamneto da modificare, lo modifichi e premi 'modifica'
<hr></i></small><?
include('./botton.inc');

?>
