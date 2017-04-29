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
$langtipoass = $_SESSION['lingua'];
$paginatipoass = "nmateria.inc";
$linguatipoass = ($langtipoass.$paginatipoass);
include($linguatipoass);

if ($user == 'admin') {
  $limit='';
} else if ($user == 'limitato') {
  $limit='disabled';
} else if ($user == 'operatore') {
  $limit='disabled';
}
include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");
?>

      <center><h3><?php echo $Ltitolotipoass ?></h3></center>
	<p align="center"><small><b><?php echo $Lcanctipoass ?></b></small></p>
<!-- Cancellazione e Modifica voci db -->
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
		<td><p><small><?php echo $Lsuggcanctipoass ?></small></p></td>
	<td><form action='./conf_canc.php?Tabella=tb_materia&Riferimento=id_materia' method='POST'>
		</td>		
		<td width='10'>id:</td>
		<td><input name='id_mod' size='10' type='text'></td>
	<td><p colspan='2' align='center'>
		<input value='- Cancella -' type='submit' <?php echo($limit); ?>></p>
	</td>
	</tr>
</tbody>
</table>
</form>
<hr style="width: 80%; height: 2px;">
	<p align="center"><small><b><?php echo $Lmodtipoass ?></b></small></p>
<p align="center"><small><?php echo $Lsuggmodtipoass ?></p></small>

<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod.php?Tabella=tb_materia&Voce=materia&Riferimento=id_materia' method='POST'></td>
            <tr>
              <td width='150'>Id:</td>
              <td><input name='id_mod' size='10' type='text'></td>
            </tr>
	<tr>
		<td width='150'><?php echo $Lnuovorecordtipoass ?>:</td>
		<td><input name='record' size='20' type='text'></td>
	<td><p colspan='2' align='center'>
	<input value=' Modifica ' type='submit' <?php echo($limit); ?>></p></td>
	</tr>
</tbody>
</table>
</form>
<hr width="60%">

	<p align="center"><small><b><?php echo $Lelencotipoass ?></b></small></p>
<center><h3><?php echo $Ltitoloelencotipoass ?></h3></center>
<?php
// popolo la tabella visualizzazione elenco
$Query_nome = "SELECT * FROM tb_materia ORDER BY materia";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<br>
<table class='bordo' align='center' cellpadding='0' cellspacing='0' width='50%'>
	<tr>
	<td height='25px' width='125' align='center'><small><b>id_$Lsociotipoass</b></small></td>
	<td width='125'><small><b>$Ltipotipoass $Lsociotipoass</b></small></td>
	</tr>
	<tr><td></td></tr>

EOM;
}

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td height='25px' width='125' align='center'><small>$row[id_materia]</small></td>
	<td height='25px' width='125'><small>$row[materia]</small></td>
	</tr>

EOM;
}

echo <<<EOT
</table>
EOT;
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelptipoass ?><hr></i></small>

<?
include('./botton.inc');

?>
