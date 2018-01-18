<?php
/*======================================================================+
 File name   : Scheda_regioni.php
 Begin       : 2017-02-04
 Last Update : 2017-02-04

 Description : card region

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
if ($user == 'admin') {
  $limit='';
} else if ($user == 'limitato') {
  $limit='disabled';
} else if ($user == 'operatore') {
  $limit='disabled';
} else if ($user == 'associato') {
  $limite='disabled';
}
include('./top.inc');
include('./menu.inc');

$langricerca = $_SESSION['lingua'];
$paginaricerca = "schedacomuni.inc";
$linguaricerca = ($langricerca.$paginaricerca);
include($linguaricerca);

$iniz = $_POST['iniziale'];
$associato = $_POST['associato'];

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

echo <<<EOM
<table align='left' border='0' cellpadding='0' cellspacing='2' width='70%'>
	<tr><td width='20%'><small><b>$LidComune</b></small></td>
	<td width='30%'><small><b>$LProvincia</b></small></td>
	<td width='60%'><small><b>$Lcap - $Lcomune</b></small></td></tr>
</table><br>
EOM;
$Query_nome = "SELECT c.id_com, c.id_pro, p.nome_provincia, c.cap, c.comune FROM comuni AS c INNER JOIN province AS p ON c.id_pro = p.id_pro ORDER BY p.nome_provincia";

$rs=mysqli_query($connect, $Query_nome)
or die("Errore nella query $Query_nome: " . mysqli_error()); //die("<b>Errore:</b> Impossibile eseguire la query della Combo");

?><select name="" size="20px" ALIGN="middle"><? 
while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM

<option value="">$row[id_com] ------------------- $row[id_pro] - $row[nome_provincia] ------------------------ $row[cap] - $row[comune]</option>
<!--<table align='center' border='0' cellpadding='0' cellspacing='2' width='70%'>
	<tr><td width='20%'><small>$row[id_com]</small></td>
	<td width='30%'><small>$row[id_pro] - $row[nome_provincia]</small></td>
	<td width='60%'><small>$row[cap] - $row[comune]</small></td></tr>
</table> -->

EOM;
}
?>	</select><hr>
<form action='./conf_comuni.php' method='POST' enctype="multipart/form-data">
<table align='center' border='0' cellpadding='0' cellspacing='2' width='100%'>
<tr>
    <td align='right'><small><?php echo $LidComune; ?></small></td>
    <td><input name='id_c' size='5' type='text' required='required'>           <small></td>
    
        <td align='right'><small><?php echo $Lidprovincia; ?></small></td>
    <td><input name='id_p' size='5' type='text' required='required'>           <small></td>
    
        <td align='right'><small><?php echo $Lcap; ?></small></td>
    <td><input name='cap' size='5' type='text' required='required'>           <small></td>
    
    <td align='right'><small><?php echo $Lnome; ?></small></td>
    <td><input name='nome' size='15' type='text' required='required'></td>
    <td><fieldset><small>
         <input type="radio" name="operazione" value="mod"/>Modifica
          <input type="radio" name="operazione" value="canc"/>Cancella
         <input type="radio" name="operazione" value="agg"/>Aggiungi</small>
    </fieldset></td>

              <td align='center'>
              <input value='Vai' type='submit' <?php echo($limit); echo($limite);?> </td>
            </tr>
</table></form>

<table><tr>
<td><form action='./Scheda_regioni.php' method='POST'>
<button name='Regioni' type='submit' value="regioni">Regioni</button></form></td>
<td><form action='./Scheda_province.php' method='POST'>
<button name='Province' type='submit' value="Province">Province</button></form></td>
<td><form action='./Scheda_comuni.php' method='POST'>
<button name='Comuni' type='submit' value="comuni">Comuni</button></form></td></tr>
</table>

<?
mysqli_close($connect);
include('./menusx.inc');
echo $Lsuggerimento;
include('./botton.inc');

?>
