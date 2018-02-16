<?php
/*======================================================================+
 File name   : conf_Ric_Fiscale.php
 Begin       : 2010-08-04
 Last Update : 2013-01-20

 Description : Print, clear, modify and insert table of Ricevute/quietanze

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
$langinsricfisc = $_SESSION['lingua'];
$paginainsricfisc = "insricfisc.inc";
$linguainsricfisc = ($langinsricfisc.$paginainsricfisc);
include($linguainsricfisc);

if ($user == 'admin') {
  $limit=''; $limite='';
} else if ($user == 'operatore') {
  $limit='disabled'; $limite='';
} else if ($user == 'associato' or 'limitato') {
	//Funzione per il redirect
	function redirect($url,$tempo = FALSE ){
 	if(!headers_sent() && $tempo == FALSE ){
	  header('Location:' . $url);
	 }elseif(!headers_sent() && $tempo != FALSE ){
	  header('Refresh:' . $tempo . ';' . $url);
	 }else{
	  if($tempo == FALSE ){
	    $tempo = 0;
	  }
	  echo "<meta http-equiv=\"refresh\" content=\"" . $tempo . ";" . $url . "\">";
	  }
	}

echo "<center>Il tuo utente ha un livello <b>$user</b> <br>Area permessa solo all'utente <b>Admin</b></center>";
redirect('./index2.php',3);
break;
}
include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");
	
	//Recupero l'ultimo id della tabella
$Query = "SELECT MAX(id_ric) FROM tb_ricevute";
$Qultimoid = mysqli_query($connect, $Query);
while($Tultimoid = mysqli_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(id_ric)'];
}

?>
     <h3><center><?php echo $Ltitoloric; ?></center></h3>
  
 <form action='./InsRicFisc_exp.php'>
 <center><button name="stampa" type="submit" <?php echo($limite); echo($limit); ?>><? echo $Lstampcancmod; ?> </button></center>
 </form>
     


<hr style="width: 40%; height: 2px;">
	<p align="center"><h3><b><?php echo $Lnuova; ?></b></h3></p>
<!-- Inserimento ricevuta fiscale -->
<br>
      <form action='./conf_Ric_Fiscale.php' method='POST'>
        <table align='center' border='0' width='60%'>
          <tbody>

            <tr>
              <td width='30%'><small><?php echo $Ldata; ?> </small></td>
	      <td width='50%'><small><input name='data' size='10' type='text' value=<?php echo date('d-m-Y') ?>></small></td>
	      <td width='20%'><small><?php echo $Lnumric; ?>: <b><?php echo ($ultimoid+1) ?></b></small></td>
            </tr>
<tr>
              <td><font color="red"><small><?php echo $Lvocecontoec; ?>*:</small></td>
		<td colspan='2'>
<select name="contoec" >
   <option value="" selected="selected"><?php echo $Lcausale; ?></option>

<?php
$query = "SELECT descrizione FROM tb_conto_economico";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}

?>
<br><small><sub><i><?php echo $Linserirecausale; ?></small></i></sub></td>
            </tr>
            <tr>
              <td ><font color="red"><?php echo $Lricevutoda; ?>*:</td>
              <td colspan='2'><select name="insnome" >
   <option value="" selected="selected"><?php echo $Lnome; ?>: </option>

<?php
$query = "SELECT nome FROM tb_anagrafe ORDER BY nome";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}

?>
<!-- CREA IL MODULO -->
  </select></td>
            </tr>
            <tr>
              <td ><font color="red"><small><?php echo $Leuro; ?>*:</small></td>
              <td colspan='2'><input name='euro' size='30' type='text' required='required'></td>
            </tr>
           
            <tr>
            <td colspan="4">
		<fieldset>
	      <legend><small><i><?php echo $Lmodalita.$Lcausale; ?></i></small></legend>
  <small><b><i><small><?php echo $Lsuggcausale; ?></i></b></small></small><br>
  <input type="radio" name="causale" value="preimpostata" checked="checked"/><small><?php echo $Lpreimpostata; ?> </small>
  <input type="radio" name="causale" value="libera"/><small><?php echo $Llibera; ?></small><br>
	      </fieldset></td></tr>
            <tr>
              <td ><small><?php echo $Lcausale.$Llibera; ?>:</small></td>
              <td colspan='2'><input name='descrizione' size='30' type='textarea'></td>
            </tr>
            <tr>
	      <td><small><?php echo $Lcausale.$Lpreimpostata; ?>:</small></td>
		<td colspan='2'>
<select name="causalepre" >
   <option value="Tesseramento <?php echo date('Y') ?> con avviso" selected="selected"><?php echo $Ltesseramentocscadenza; ?></option>
   <option value="Tesseramento <?php echo date('Y') ?> senza avviso " ><?php echo $Ltesseramentonoscadenza; ?></option>

</select></td></tr>
            <tr>
              <td colspan='3' align='center'>
              <input value=<? echo $Linvia; ?> type='submit' <?php echo($limit); echo($limite); ?>></td>
            </tr>
          </tbody>
        </table>
      </form>

<!-- ELENCO DELLE RICEVUTE -->
	<h3 align="center"><?php echo $Lelencoricevute; ?></h3>
<table class='bordo' align='center' cellpadding='2' cellspacing='2' width='80%'>
	<tr>
	<td height='25px' width='10%' align='center'><small><b><?php echo $Lnumric; ?></b></small></td>
	<td width='15%'><small><b><?php echo $Ldata; ?></b></small></td>
	<td width='25%'><small><b><?php echo $Lnome; ?></b></small></td>
	<td width='20%' align='right'><small><b><?php echo $Leuro; ?></b></small></td>
	<td width='30%' align='right'><small><b><?php echo $Ldescrizione; ?></b></small></td>
	</tr>
<?php
// popolo la tabella delle ricevute
$Query = "SELECT * FROM tb_ricevute ORDER BY id_ric";

$rs=mysqli_query($connect, $Query)
or die('' . mysqli_error());

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td height='25px' align='center'><small>$row[id_ric]</small></td>
	<td height='25px'><small>$row[data]</small></td>
	<td height='25px'><small>$row[nome]</small></td>
	<td height='25px' align='right'><small>$row[euro]</small></td>
	<td height='25px' align='right'><small>$row[descr]</small></td>
	</tr>

EOM;
}
echo <<<EOT
</table><p></p>
EOT;
mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelpric; ?>
<hr></i></small><?
include('./botton.inc');

?>

