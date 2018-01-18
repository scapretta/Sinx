<?php
/*======================================================================+
 File name   : InsStatoPatrimoniale.php
 Begin       : 2012-07-05
 Last Update : 2012-09-21

 Description : Page of the balance sheet

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
$langinsstatopat = $_SESSION['lingua'];
$paginainsstatopat = "insstatopatr.inc";
$linguainsstatopat = ($langinsstatopat.$paginainsstatopat);
include($linguainsstatopat);

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
$Query = "SELECT MAX(id) FROM tb_stato_patrimoniale";
$Qultimoid = mysqli_query($connect, $Query);
while($Tultimoid = mysqli_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(id)'];
}

// Aggiornamento tabella stato patrimoniale
//Calcolo delle somme di Cassa
$query = "SELECT SUM(entrata) FROM tb_primanota";
$result = mysqli_query($connect,  $query);
$entrata_tot = mysqli_fetch_row($result);

$query = "SELECT SUM(uscita) FROM tb_primanota";
$result = mysqli_query($connect,  $query);
$uscita_tot = mysqli_fetch_row($result);

$valorecassa = $entrata_tot[0]-$uscita_tot[0];

		$sql="UPDATE tb_stato_patrimoniale SET valore = '$valorecassa' WHERE id = '38'"; //inserisco i valori nel database
		$result=mysqli_query($connect, $sql);

//Calcolo delle somme di Banca
$query = "SELECT SUM(entratab) FROM tb_primanota";
$result = mysqli_query($connect,  $query);
$entrata_tot = mysqli_fetch_row($result);

$query = "SELECT SUM(uscitab) FROM tb_primanota";
$result = mysqli_query($connect,  $query);
$uscita_tot = mysqli_fetch_row($result);

$valorecassa = $entrata_tot[0]-$uscita_tot[0];

		$sql="UPDATE tb_stato_patrimoniale SET valore = '$valorecassa' WHERE id = '36'"; //inserisco i valori nel database
		$result=mysqli_query($connect, $sql);

?>
     <center><h3><?php echo $Ltitolostatopatr; ?></h3></center>
<center><small><?php echo $Lnota1; ?></small><center><br>

 <form action='./InsStatoPatrimoniale_exp.php'>
 <center><button name="stampa" type="submit" <?php echo ($limite) ?>>
   Stampa | Cancella | Modifica
 </button></center>
 </form>


<hr style="width: 60%; height: 2px;">
	<p align="center"><small><b><?php echo $Lnuovavoce; ?></b></small></p>
<!-- Sezione per inserire una nuova voce -->

      <form action='./conf_dati_patrim.php' method='POST'>
        <table align='center' border='0' width='60%'>
          <tbody>
            <tr>
              <td width='150'><font color="red"><?php echo $Loperazione; ?>*:</td>
		<td><input name='operazione' size='30' type='text' required='required'><br><small><sub><i><?php echo $Linscausale; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><font color="red"><?php echo $Lvalore; ?>*:</td>
		<td><input name='valore' size='30' type='text' required='required'><br><small><sub><i><?php echo $Lnotavalore; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><?php echo $Ltipovoce; ?>:</td>
              <td>
	      <fieldset>
	      <legend><small><?php echo $Ltipovoce; ?>:</small></legend>
  <small><?php echo $Lattivita; ?></small><input type="radio" name="patrim" value="attivita" checked="checked"/>
  <small><?php echo $Lpassivita; ?></small><input type="radio" name="patrim" value="passivita"/>
	      </fieldset>
	    </td>
            </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit' <?php echo($limite); ?>></td>
            </tr>
          </tbody>
        </table>
      </form>
     <center><h3><?php echo $Ltitolostatopatr; ?></h3></center>
<?php
// popolo la tabella dello stato Patrimoniale


{
echo <<<EOM

<table width='90%' border='0' cellspacing='0'>
	<tr>
	<td height='35px' align='center' width='50%' bgcolor="#D1D1D1"><small><b>$Lattivita</b></small></td>
	<td height='35px' align='center' width='50%' bgcolor="#D1D1D1"><small><b>$Lpassivita</b></small></td>
	</tr>
</table>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%' >
	<tr>
	<td height='25px' width='5%' align='center'><small><b>$Lid</b></small></td>
	<td height='25px' width='30%'><small><b>$Ldescrizione</b></small></td>
	<td height='25px' width='15%' align='center'><small><b>$Limporto</b></small></td>
	<td height='25px' width='5%' align='center'><small><b>$Lid</b></small></td>
	<td height='25px' width='30%'><small><b>$Ldescrizione</b></small></td>
	<td height='25px' width='15%' align='center'><small><b>$Limporto</b></small></td>
	</tr>
</table>
EOM;
}
?>

<!-- Creo la tabella attività/passività -->
<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%' >
<tr>
  <td width="50%">
    <?php
$Query_nome = "SELECT * FROM tb_stato_patrimoniale WHERE costoricavo = 'attivita' ORDER BY id";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM

<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%'>
	<tr >
	<td height='25px' width='5%'><small>$row[id]</small></td>
	<td height='25px' width='30%'><small>$row[descrizione]</small></td>
	<td height='25px' width='15%' align='right'><small>$row[valore]</small></td>
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
<table align='center' border='0' cellpadding='0' cellspacing='0' width='90%'>
	<tr >
	<td height='25px' width='5%'><small>$riga[id]</small></td>
	<td height='25px' width='30%'><small>$riga[descrizione]</small></td>
	<td height='25px' width='15%' align='right'><small>$riga[valore]</small></td>
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
<table width='100%' border='0'>
<tr>
	<td height='30px' width='20%'><small><?php echo $Ltotaleattivi; ?></small></td>
	<td height='30px' align='right' width='20%'><small><?php echo $entrata[0]; ?> &euro;</small></td>
	<td width='20%'></td>
	<td height='30px' width='20%'><small><?php echo $Ltotalepassivi; ?></small></td>
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
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelpatatopatr; ?><hr></i></small>
<?
include('./botton.inc');

?>
