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
$langcontoec = $_SESSION['lingua'];
$paginacontoec = "inscontoec.inc";
$linguacontoec = ($langcontoec.$paginacontoec);
include($linguacontoec);

if ($user == 'admin') {

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

//Recupero l'ultimo id della tabella
$Query = "SELECT MAX(id) FROM tb_conto_economico";
$Qultimoid = mysqli_query($connect, $Query);
while($Tultimoid = mysqli_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(id)'];
}
?>
     <center><h3><?php echo $Ltitolocontoec; ?></h3></center>
<center><small><?php echo $Lnota1; ?></small><center><br>
<small><center><a href="./stampa_contoec.php"><?php echo $Lstampacontoec; ?></a> | <a href="./Azzera.php?Tabella=tb_conto_economico&Modulo=Conto Economico"><?php echo $Lazzeracontoec; ?></a></center></small>
	<p align="center"><small><b><?php echo $Lcancella; ?></b></small></p>
<!-- Sezione per cancellare un record del conto economico -->
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
		<td><p><small><?php echo $Lnota2; ?></small></p></td>
	<td><form action='./conf_canc.php?Tabella=tb_conto_economico&Riferimento=id' method='POST'>
		</td>		
		<td width='10'><font color="red"><?php echo $Lnumero; ?>*:</td>

<!-- Creo la combo -->
              <td><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id
	FROM tb_conto_economico
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
?>
  </select></td>

	<td><p colspan='2' align='center'>
		<input value='- Cancella -' type='submit' <?php echo($limit); ?>></p>
	</td>

	</tr>
	</form>
</tbody>
</table>
<hr style="width: 80%; height: 2px;">
	<p align="center"><small><b><?php echo $Lmodifica; ?></b></small></p>
<!-- Sezione per modificare un record del conto economico -->
<p align="center"><small><?php echo $Lnota3; ?></p></small>

<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod_ceconomico.php?Tabella=tb_conto_economico' method='POST'></td>
            <tr>
		</td>		
		<td width='10'><font color="red"><?php echo $Lnumero; ?>*:</td>

<!-- Creo la combo -->
              <td><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id
	FROM tb_conto_economico
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
?>
  </select></td>
            </tr>
            <tr>
		<td width='150'><font color="red"><?php echo $Lcampo; ?>*:</td>
		<td>
<select name="campo" >
	<option value="" selected="selected"></option>
  <option value="descrizione"><?php echo $Ldescrizione; ?></option>
  <option value="valore"><?php echo $Lvalore; ?></option>
</td>
	</tr>
	<tr>
		<td width='150'><font color="red"><?php echo $Lnuovorecord; ?>*:</td>
		<td><input name='record' size='20' type='text' required='required'></td>
	<td><p colspan='2' align='center'>
	<input value=' Modifica ' type='submit' <?php echo($limit); ?>></p></td>
	</tr>
	</form>
</tbody>
</table>


     <center><h3><?php echo $Ltitolocontoec; ?></h3></center>
<?php
// popolo la tabella della conto economico


{
echo <<<EOM

<table width='90%' border='0'>
	<tr>
	<td height='35px' align='center' width='50%' bgcolor="#D1D1D1"><small><b>$Lproventiric</b></small></td>
	<td height='35px' align='center' width='50%' bgcolor="#D1D1D1"><small><b>$Lcostioneri</b></small></td>
	</tr>
</table>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%' >
	<tr>
	<td height='25px' width='5%' align='center'><small><b>$Lid</b></small></td>
	<td height='25px' width='35%'><small><b>$Ldescrizione</b></small></td>
	<td height='25px' width='10%'><small><b>$Limporto</b></small></td>
	<td height='25px' width='5%' align='center'><small><b>$Lid</b></small></td>
	<td height='25px' width='35%'><small><b>$Ldescrizione</b></small></td>
	<td height='25px' width='10%'><small><b>$Limporto</b></small></td>
	</tr>
</table>
EOM;
}
?>

<!-- Creo la tabella costi/ricavo -->
<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%' >
<tr>
  <td width="50%">
    <?php
$Query_nome = "SELECT * FROM tb_conto_economico WHERE costoricavo = 'ricavi' ORDER BY id";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM

<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr >
	<td height='25px' width='5%' align='center'><small>$row[id]</small></td>
	<td height='25px' width='35%'><small>$row[descrizione]</small></td>
	<td height='25px' width='10%'><small>$row[valore]</small></td>
	</tr>
</table>
EOM;
}
      ?>
    </td>
    <td width="50%">
<?php

 $Query = "SELECT * FROM tb_conto_economico WHERE costoricavo = 'oneri' ORDER BY id";

$ros=mysqli_query($connect, $Query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($riga=mysqli_fetch_array($ros))
{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr >
	<td height='25px' width='5%' align='center'><small>$riga[id]</small></td>
	<td height='25px' width='35%'><small>$riga[descrizione]</small></td>
	<td height='25px' width='10%'><small>$riga[valore]</small></td>
	</tr>
</table>
EOM;
}

?>
    </td>
  </tr>
</table>

<?php
//Calcolo delle somme
$query = "SELECT SUM(valore) FROM tb_conto_economico where costoricavo = 'ricavi'";
$result = mysqli_query($connect,  $query);
$entrata = mysqli_fetch_row($result);

$query = "SELECT SUM(valore) FROM tb_conto_economico where costoricavo = 'oneri'";
$result = mysqli_query($connect,  $query);
$uscita = mysqli_fetch_row($result);
?>
<hr style="width: 20%; height: 2px; position: center;"><br>
<table width='100%' border='0'>
<tr>
	<td height='30px' width='20%'><small><?php echo $Ltotproventi; ?></small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $entrata[0]; ?> &euro;</small></td>
	<td width='20%'></td>
	<td height='30px' width='20%'><small><?php echo $Ltotspese; ?></small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $uscita[0]; ?> &euro;</small></td>
</tr>
<tr>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'><small><b><?php echo $Lavanzogestione; ?></b></small></td>
	<td height='30px' align='right' width='20%'><small><b><?php echo ($entrata[0]-$uscita[0]); ?> &euro;</b></small></td>
</tr>
<tr>
	<td height='30px' width='20%'><small><?php echo $Ltotpareggio; ?></small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $entrata[0]; ?> &euro;</small></td>
	<td width='20%'></td>
	<td height='30px' width='20%'><small><?php echo $Ltotpareggio; ?></small></td>
	<td height='30px' align='right' width='20%'><small><?php echo (($entrata[0]-$uscita[0])+$uscita[0]); ?> &euro;</small></td>
</table><br>


<?php
mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelpcontoec; ?>
<hr></i></small><?
include('./botton.inc');
} else {
header('Location: Rip_database.php');
}
?>
