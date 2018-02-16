<?php
/*======================================================================+
 File name   : InsAnagrStud.php
 Begin       : 2010-08-04
 Last Update : 2012-07-07

 Description : associated Master

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
$langanagrstud = $_SESSION['lingua'];
$paginaanagrstud = "insanagrstud.inc";
$linguaanagrstud = ($langanagrstud.$paginaanagrstud);
include($linguaanagrstud);

if ($user == 'admin') {

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

?>

     <center><h2><? echo $Lpresentazioneanagrstud; ?></small></center>
<br>
<!--Visualizza il numero di tessere -->
<table><tr><td>
<form action='./stampa_soci.php' method='POST' target='_blank'>
<button name='ordine' type='submit' value="ntessera"><? echo $Ltessere; ?></button>
</form></td>
<td><form action='./Scheda_regioni.php' method='POST'>
<button name='Regioni' type='submit' value="regioni">Regioni</button></form></td>
<td><form action='./Scheda_province.php' method='POST'>
<button name='Province' type='submit' value="Province">Province</button></form></td>
<td><form action='./Scheda_comuni.php' method='POST'>
<button name='Comuni' type='submit' value="comuni">Comuni</button></form></td></tr>
</table>


      <form action='./conf_dati_stud.php' method='POST' enctype="multipart/form-data">
        <table align='center' border='0' width='60%'>
          <tbody>
          	    <tr>
                <td width='150'><font color="red"><? echo $Lntessera; ?></td>
              <td><input name='ntessera' size='5' type='text' required='required'>
               <br><small><sub><i><? echo $Listntessera; ?></small></i></sub></td>
            </tr>
<?php include('./DatiComuni.inc'); ?>


            <tr>
              <td width='150'><font color="red"><? echo $Lfunzione; ?>*:</td>
              <td><select name="classe" required>
   <option value="" selected="selected"><? echo $Lfunzione; ?></option>

<?php
$query = "SELECT classe FROM tb_classe";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
mysqli_close($connect);
?>

  </select></td>
            </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value=<? echo $Linvia; ?> type='submit' <? echo($limit); ?>></td>
            </tr>
          </tbody>
        </table>
        <br>
      </form>
<?php
include('./menusx.inc');
echo $Lhelpanagrstud;
include('./botton.inc');
} else {
header('Location: Rip_database.php');
}
?>

