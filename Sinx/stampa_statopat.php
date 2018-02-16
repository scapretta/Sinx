<?php
/*======================================================================+
 File name   : stampa_statopat.php
 Begin       : 2012-09-21
 Last Update : 2012-09-21

 Description : Page format for printing listen

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

include('./Intestazione.php');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");
?>
<!-- Visualizzazione Stato Patrimoniale -->
	<p align="center"><small><b>Stato Patrimoniale</b></small></p>
<?php
// popolo la tabella


{
echo <<<EOM

<table width='80%' border='0' align='center'>
	<tr>
	<td height='35px' align='center' width='50%' bgcolor="#D1D1D1"><small><b>Attivit&agrave</b></small></td>
	<td height='35px' align='center' width='50%' bgcolor="#D1D1D1"><small><b>Passivit&agrave</b></small></td>
	</tr>
</table>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='80%' >
	<tr>
	<td height='25px' width='5%' align='center'><small><b>id</b></small></td>
	<td height='25px' width='30%'><small><b>descrizione</b></small></td>
	<td height='25px' width='15%'><small><b>Importo</b></small></td>
	<td height='25px' width='5%' align='center'><small><b>id</b></small></td>
	<td height='25px' width='30%'><small><b>descrizione</b></small></td>
	<td height='25px' width='15%'><small><b>Importo</b></small></td>
	</tr>
</table>
EOM;
}
?>

<!-- Creo la tabella attività/passività -->
<table align='center' border='0' cellpadding='0' cellspacing='0' width='80%' >
<tr>
  <td width="50%">
    <?php
$Query_nome = "SELECT * FROM tb_stato_patrimoniale WHERE costoricavo = 'attivita' ORDER BY id";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM

<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr >
	<td height='25px' width='5%' align='center'><small>$row[id]</small></td>
	<td height='25px' width='30%'><small>$row[descrizione]</small></td>
	<td height='25px' width='15%'><small>$row[valore]</small></td>
	</tr>
</table>
EOM;
}
      ?>
    </td>
    <td width="50%">
<?php

 $Query = "SELECT * FROM tb_stato_patrimoniale WHERE costoricavo = 'passivita' ORDER BY id";

$ros=mysqli_query($connect, $Query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($riga=mysqli_fetch_array($ros))
{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr >
	<td height='25px' width='5%' align='center'><small>$riga[id]</small></td>
	<td height='25px' width='30%'><small>$riga[descrizione]</small></td>
	<td height='25px' width='15%'><small>$riga[valore]</small></td>
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
$query = "SELECT SUM(valore) FROM tb_stato_patrimoniale where costoricavo = 'attivita'";
$result = mysqli_query($connect,  $query);
$entrata = mysqli_fetch_row($result);

$query = "SELECT SUM(valore) FROM tb_stato_patrimoniale where costoricavo = 'passivita'";
$result = mysqli_query($connect,  $query);
$uscita = mysqli_fetch_row($result);
?>
<hr style="width: 20%; height: 2px; position: center;"><br>
<table width='80%' border='0' align ='center'>
<tr>
	<td height='30px' width='20%'><small>Totale Proventi</small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $entrata[0]; ?> &euro;</small></td>
	<td width='20%'></td>
	<td height='30px' width='20%'><small>Totale spese</small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $uscita[0]; ?> &euro;</small></td>
</tr>
<tr>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'></td>
	<td height='30px' width='20%'><small><b>Avanzo di Gestione</b></small></td>
	<td height='30px' align='right' width='20%'><small><b><?php echo ($entrata[0]-$uscita[0]); ?> &euro;</b></small></td>
</tr>
<tr>
	<td height='30px' width='20%'><small>Totale a pareggio</small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $entrata[0]; ?> &euro;</small></td>
	<td width='20%'></td>
	<td height='30px' width='20%'><small>Totale a pareggio</small></td>
	<td height='30px' align='right' width='20%'><small><?php echo (($entrata[0]-$uscita[0])+$uscita[0]); ?> &euro;</small></td>
</table><br>

<?php
mysqli_close($connect);
} else {
header('Location: ./index.php');
}
?>



