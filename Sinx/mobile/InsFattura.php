<?php
/*======================================================================+
 File name   : InsFattura.php
 Begin       : 2010-08-04
 Last Update : 2011-04-08

 Description : Compilation tax bills

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
$langinsfattura = $_SESSION['lingua'];
$paginainsfattura = "insfattura.inc";
$linguainsfattura = ($langinsfattura.$paginainsfattura);
include($linguainsfattura);

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
$Query = "SELECT MAX(id_tot_fatture) FROM tb_tot_fatture";
$Qultimoid = mysqli_query($connect, $Query);
while($Tultimoid = mysqli_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(id_tot_fatture)'];
}

?>
<center><h3><?php echo $Lptitolofattura; ?></h3></center>

<!-- Per Stampare le fatture -->

<p><center><b><?php echo $Lstampa; ?></b></center></p>
      <form action='./stampa_fattura.php' method='POST'>
        <table align='center' border='0' width='45%'>
            <tr>
              <td width='80%'><font color="red"><?php echo $Lnumerofattura; ?> *:</td>
              <td><select name="id" >
   <option value="" selected="selected"></option>

<?php



$a = '1';
do {
$query = "SELECT id_tot_fatture
	FROM tb_tot_fatture
	WHERE id_tot_fatture = $a
	ORDER BY tot_fattura DESC, id_tot_fatture
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
              <td colspan='2' align='center'>
              <input value= <? echo $L_stampafattura; ?> type='submit' <?php echo($limit); echo($limite);?>></td>
            </tr>
	</table>
	</form>
<hr style="width: 90%; height: 2px;">

<!-- Registrare fatture in primanota-->

<p><center><b><?php echo $Lregistrafattura; ?></b></center></p>
      <form action='./incasso_fattura.php' method='POST'>
        <table align='center' border='0' width='70%'>
            <tr>
              <td width='150'><font color="red"><?php echo $Lvocecontoec; ?>*:</td>
		<td colspan='2'>
<p><center>
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
</center></p><br><small><sub><i><?php echo $Linscausale; ?></small></i></sub></td>
            </tr>
            <tr>
              <td><font color="red"><?php echo $Lnumerofattura; ?> *:</td>
              <td ><select name="id" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_tot_fatture
	FROM tb_tot_fatture
	WHERE id_tot_fatture = $a
	ORDER BY tot_fattura DESC, id_tot_fatture
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
<td>
 <fieldset>
  <legend><small><?php echo $Lincassoin; ?>:</small></legend>
  <small><?php echo $Lcassa; ?></small><input type="radio" name="incasso" value="cassa" checked="checked"/>
  <small><?php echo $Lbanca; ?></small><input type="radio" name="incasso" value="banca"/>
</fieldset>
	</td>
              <td colspan='2' align='center'>
              <input value='- Registra incasso -' type='submit' <?php echo($limit); echo($limite);?>></td>
            </tr>
	</table>
	</form>
<hr style="width: 80%; height: 2px;">

<!-- Compilazione nuova fattura o aggiunta record fattura -->
     <p align="center"><b><?php echo $Lcompfattura; ?></b></p>
<center><small><?php echo $Lnota1; ?></small></center>
<br>
      <form action='./conf_dati_fattura.php' method='POST'>
        <table align='left' border='0' width='30%'>
            <tr>
              <td width='80%'><?php echo $Lnumerofattura; ?>:</td>
              <td><input name='fattnum' size='10%' type='text' value=<?php echo($ultimoid+1); ?>></td>
            </tr>
            <tr>
              <td width='80%'><font color="red"><?php echo $Lnomecliente; ?> *:</td>
              <td><select name="nome" >
   <option value="" selected="selected"></option>

<?php
$query = "SELECT nome FROM tb_anagrafe ORDER BY nome";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
?>
  </select></td>
            </tr>
            <tr>
              <td width='150'><?php echo $Ldata; ?>:</td>
              <td width='50'><small><input name='data' size='10' type='text' value=<?php echo date('d-m-Y') ?>></small><td>
            </tr>
        </table>
<br><br><br><br><br>
<table align='center' border='0' width='82%'>
<tbody>
	<tr>
	 <td height='25px' width='38%'><small><?php echo $Ldescrizione; ?></small></td>
	 <td height='25px' width='11%'><small><?php echo $Lquantita; ?></small></td>
	 <td height='25px' width='20%'><small><?php echo $Lprezzoun; ?>.</small></td>
	 <td height='25px' width='7%'><small><?php echo $Liva; ?></small></td>
	 <!-- <td height='25px' width='25%'><small><?php echo $Lmodpaga; ?></small></td> -->
	</tr>

	<tr>
	      <td><input name='Descr' size='40%'  type='text'></td>
              <td><input name='Qta' size='10%' type='text'></td>
              <td><input name='prezzoun' size='20%' type='text'></td>
              <td><input name='iva' size='4%' type='text'></td>
      <!--        <td><input name='modpaga' size='25%' type='text'></td> -->
	</tr>
</table>
<p><center><small><?php echo $Lnota2; ?></small></center></p>

        <table align='center' border='0' width='30%'>
            <tr>
              <td colspan='2' align='center'>
              <input value='- Registra Fattura -' type='submit' <?php echo($limit); echo($limite);?>></td>
            </tr>
      </tbody>
	</table>
    </form>

<!-- Per Visualizzare e modificare le fatture -->
<hr style="width: 60%; height: 2px;">
<p><center><b><?php echo $Lvisualizzafatt; ?></b></center></p>
      <form action='./visual_fattura.php' method='POST'>
        <table align='center' border='0' width='45%'>
            <tr>
              <td width='80%'><font color="red"><?php echo $Lnumerofattura; ?> *:</td>
              <td><select name="id" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_tot_fatture
	FROM tb_tot_fatture
	WHERE id_tot_fatture = $a
	ORDER BY tot_fattura DESC, id_tot_fatture
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
              <td colspan='2' align='center'>
              <input value='- Visualizza Fattura -' type='submit' <?php echo($limit); echo($limite);?>></td>
            </tr>
	</table>
	</form>
<p><center><small><?php echo $Lnota3; ?></small></center></p>
<hr style="width: 40%; height: 2px;">

<!-- popolo la tabella delle fatture -->
	<p align="center"><small><b><?php echo $Lelencofatture; ?></b></small></p>
<table class='bordo' align='center' cellpadding='0' cellspacing='0' width='80%'>
	<tr>
	<td height='25px' width='10%' align='center'><small><b><?php echo $Lnumerofattura; ?></b></small></td>
	<td width='20%'><small><b><?php echo $Ldata; ?></b></small></td>
	<td width='40%'><small><b><?php echo $Lnomecliente; ?></b></small></td>
	<td width='30%' align='right'><small><b><?php echo $Ltotivaincl; ?></b></small></td>
	</tr>
<?php

$a = '1';
do {
$Query = "SELECT id_tot_fatture, tot_fattura, nome, data
	FROM tb_tot_fatture
	WHERE id_tot_fatture = $a
	ORDER BY tot_fattura DESC, id_tot_fatture
	LIMIT 1";

$rs=mysqli_query($connect, $Query)
or die('' . mysqli_error());

while ($row=mysqli_fetch_array($rs))
	{
echo <<<EOM
		<tr>
		<td height='25px' align='center'><small>$row[id_tot_fatture]</small></td>
		<td height='25px'><small>$row[data]</small></td>
		<td height='25px'><small>$row[nome]</small></td>
		<td height='25px' align='right'><small>$row[tot_fattura]</small></td>
		</tr>


EOM;
	}
$a++;
} while ($a <= $ultimoid);
echo <<<EOT
</table><p></p>
EOT;
mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelpfatture; ?>
<hr></i></small><?
include('./botton.inc');

?>
