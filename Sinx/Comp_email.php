<?php
/*======================================================================+
 File name   : Comp_email.php
 Begin       : 2013-01-09
 Last Update : 2013-08-24

 Description : creating a message mail for associates

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
=========================================================================+
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

$langemail = $_SESSION['lingua'];
$paginaemail = "email.inc";
$linguaemail = ($langemail.$paginaemail);
include($linguaemail);

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");
?>

    <form action='./email.php' method='POST'>
<center><h2><?php echo $Ltitoloemail ?></h2></center>
      <table align='center' width='60%' border='0'>
	<tr>
	  <td width='150'><?php echo $Laemail ?>: *</td>
	  <td>
 <fieldset>
  <legend><small><?php echo $Ldestinatarioemail ?>:</small></legend>
  <input type="radio" name="destinatario" value="esterno" checked="checked"/><input type='email' name='recipient' size='30' /><br>
  <input type="radio" name="destinatario" value="associato"/><select name="iscritto" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT email
	FROM tb_anagrafe
	WHERE id_anagrafe = $a AND email != '' 
	ORDER BY email ASC
	LIMIT 1";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
$a++;
} while ($a <= 500);
?>
  </select><br>
  <input type="radio" name="destinatario" value="tutti"/><b><i><small><?php echo $Ltuttiemail ?></small></i></b><br>
<small><sub><i><?php echo $Lesclusicollabemail ?></i></sub></small><br>
  <input type="radio" name="destinatario" value="fondatori"/><b><i><small><?php echo $Lfondatoriemail ?></small></i></b><br>
<small><sub><i><?php echo $Llistafondatoriemail ?></i></sub></small><br>
</fieldset>
	</td>
	</tr>
	<tr>
	<tr>
	  <td width='150'><?php echo $Loggemail ?> *</td>
	  <td><input type='text' name='subject' size='30' /></td>
	</tr>
	<tr>
	  <td width='150'><?php echo $Lmessgemail ?> *</td>
	  <td><textarea name='formcontent' rows="7" cols="60"></textarea><br>
<small><sub><i><?php echo $Lsugg1email ?> &lt;br&gt; <?php echo $Lacapoemail ?>, &lt;b&gt;&lt;/b&gt; <?php echo $Lgrassettoemail ?> &lt;i&gt;&lt;/i&gt; <?php echo $Lcorsivoemail ?> &lt;hr&gt; <?php echo $Lorizzemail ?> &lt;li&gt;&lt;/li&gt; <?php echo $Lpuntatoemail ?> &lt;h1&gt;&lt;/h1&gt;...&lt;h6&gt;&lt;/h6&gt; <?php echo $Ltitoliemail ?></i></sub></small>
	</td>
	</tr>
	<tr>
	 <td></td>
	  <td><input type="checkbox" name="check" value="salva"> <?php echo $Lsalvaemail ?><br></td>
	</tr>
<tr><td><hr></td><td><hr></td></tr>
	<tr>
	  <td colspan='2' align='center'><input type='submit' value='Spedisci' <?php echo($limite); ?>/></td>
	</tr><br>
<center><b><?php echo $Lnota1email ?></b></center><br>
      </table>
    </form>

<table align='center'>
<tr>
<!-- <td><a href='./Posta_ricevuta.php'><img src="./ImmTemplate/Pulsanti/Posta_ricevuta.png" onMouseOver="this.src='./ImmTemplate/Pulsanti/Posta_ricevuta2.png'" onMouseOut="this.src='./ImmTemplate/Pulsanti/Posta_ricevuta.png'" title="Ultimi 30 messaggi presenti sulla casella di posta"></img></a></td> -->
<td><a class="transp" href='./Posta_inviata.php' ><img src="./ImmTemplate/Pulsanti/Posta_inviata.png" title="Posta inviata e salvata su Sinx" ></img></a></td>
</tr>
</table>


<?php


mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lnota2email ?><hr></i></small>
<?
include('./botton.inc');

?>
