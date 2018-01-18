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
$langanagrextra = $_SESSION['lingua'];
$paginaanagrextra = "insanagrextra.inc";
$linguaanagrextra = ($langanagrextra.$paginaanagrextra);
include($linguaanagrextra);

if ($user == 'admin') {
  $limit=''; $limite='';
} else if ($user == 'limitato') {
  $limit='disabled'; $limite='';
} else if ($user == 'operatore') {
  $limit='disabled'; $limite='';
} else if ($user == 'associato') {
  $limit='disabled'; $limite='disabled';
}

if ($user == 'admin') {

include('./top.inc');
include('./menu.inc');
?>
      <center><h2><?php echo $Lpresentazioneextra; ?></h2>
<small><?php echo $Lnotaextra; ?></small></center>

<!--Visualizza il numero di tessere -->
<table><tr><td>
<form action='./stampa_extra.php' method='POST' target='_blank'>
<button name='ordine' type='submit' value="ntessera"><? echo $Ltessere; ?></button>
</form></td>
<td><form action='./Scheda_regioni.php' method='POST'>
<button name='Regioni' type='submit' value="regioni">Regioni</button></form></td>
<td><form action='./Scheda_province.php' method='POST'>
<button name='Province' type='submit' value="Province">Province</button></form></td>
<td><form action='./Scheda_comuni.php' method='POST'>
<button name='Comuni' type='submit' value="comuni">Comuni</button></form></td></tr>
</table>

      <form action='./conf_dati_extra.php' method='POST' enctype="multipart/form-data">
        <table align='center' border='0' width='60%'>
          <tbody>
            <tr>
                <td width='150'><font color="red"><? echo $Lntessera; ?></td>
              <td><input name='ntessera' size='5' type='text' required='required'>
               <br><small><sub><i><? echo $Listntessera; ?></small></i></sub></td>
            </tr>
<?php include('./DatiComuni.inc'); ?>
            <tr>
              <td width='150'><?php echo $Lmansione; ?></td>
              <td><input name='mansione' size='30' type='text' background='#D9D9D9'></td>
            </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value=<? echo $Linvia; ?> type='submit' <?php echo($limit); ?>></td>
            </tr>
          </tbody>
        </table>
        <br>
      </form>
<?php
include('./menusx.inc');
echo $Lhelpextra;
include('./botton.inc');
} else {
header('Location: Rip_database.php');
}
?>
