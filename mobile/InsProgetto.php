<?php
/*======================================================================+
 File name   : InsProgetto.php
 Begin       : 2013-08-05
 Last Update : 2013-08-06

 Description : Compilation Association's Project

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
}

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

//Recupero l'ultimo id della tabella
$Query = "SELECT id FROM tb_tot_progetto ORDER BY id DESC LIMIT 1";
$Qultimoid = mysqli_query($connect, $Query);
$ultimoid=mysqli_fetch_row($Qultimoid)

?>
<center><h3>Creazione e gestione progetti</h3></center>

<!-- Per Stampare progetti -->

<p><center><b>Stampa Progetto</b></center></p>
      <form action='./stampa_progetto.php' method='POST'>
        <table align='center' border='0' width='45%'>
            <tr>
              <td width='80%'><font color="red">Numero Progetto *:</td>
              <td><select name="numero" >
   <option value="" selected="selected"></option>

<?php


$query = "SELECT id
	FROM tb_tot_progetto
	ORDER BY id";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";
}

?>
  </select></td>
              <td colspan='2' align='center'>
              <input value='- Stampa progetto -' type='submit' <?php echo($limit); ?>></td>
            </tr>
	</table>
	</form>
<hr style="width: 90%; height: 2px;">

<!-- Registrare progetto in primanota-->

<p><center><b>Registra e chiudi Progetto</b></center></p>
      <form action='./chiusura_progetto.php' method='POST'>
        <table align='center' border='0' width='70%'>
            <tr>
              <td width='150'><font color="red">Voce Conto economico*:</td>
		<td colspan='2'>
<p><center>
<select name="contoec" >
   <option value="" selected="selected">Causale</option>

<?php
$query = "SELECT descrizione FROM tb_conto_economico";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}

?>
</center></p><br><small><sub><i>Inserire la causale</small></i></sub></td>
            </tr>
            <tr>
              <td><font color="red">Numero Progetto *:</td>
              <td ><select name="id" >
   <option value="" selected="selected"></option>

<?php
$query = "SELECT id
	FROM tb_tot_progetto
	ORDER BY id";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";
}
?>
  </select></td>
<td>
 <fieldset>
  <legend><small>Incasso in:</small></legend>
  <small>Cassa</small><input type="radio" name="incasso" value="cassa" checked="checked"/>
  <small>Banca</small><input type="radio" name="incasso" value="banca"/>
</fieldset>
	</td>
              <td colspan='2' align='center'>
              <input value='- Registra -' type='submit' <?php echo($limit); ?>></td>
            </tr>
	</table>
	</form>
<hr style="width: 80%; height: 2px;">

<!-- Compilazione nuov progetto o gestione -->
     <p align="center"><b>Nuovo Progetto</b></p>
<center><small>I campi contrassegnati con l'asterisco sono obbligatori</small></center>
<br>
      <form action='./conf_dati_progetto.php' method='POST'>
        <table align='center' border='0' width='80%'>
        <tbody>
            <tr>
              <td width='30%'>N.ro Progetto:</td>
              <td><?php echo(($ultimoid["0"])+1); ?></td><td width='30%'><font color="red">Associato di riferimento *:</td>
            </tr>
              <td width='30%'>Descrizione Progetto:</td>
              <td><textarea name='formcontent' rows="3" cols="60"></textarea></td>
              
              <td width='80%' VALIGN="top"><select name="nome" >
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
              <td width='30%'>Data:</td>
              <td width='20%'><small><input name='data' size='10' type='text' value=<?php echo date('d-m-Y') ?>></small></td><td></td>
            </tr>
        </table>
<!-- <br><br><br><br><br>
<table align='center' border='0' width='80%'>
<tbody>
	<tr>
	 <td height='25px' width='50%'><small>Descrizione</small></td>
	 <td height='25px' width='10%'><small>Quantit&agrave</small></td>
	 <td height='25px' width='30%'><small>Prezzo un.</small></td>
	 <td height='25px' width='10%'><small>Iva %</small></td>
	</tr>
</table>
<table align='center' border='0' width='80%'>
	<tr>
	      <td><input name='Descr' size='42%'  type='text'></td>
              <td><input name='Qta' size='5%' type='text'></td>
              <td><input name='prezzoun' size='22%' type='text'></td>
              <td><input name='iva' size='8%' type='text'></td>
	</tr>
</table>
<p><center><small>Per inserire pi&ugrave voci nella stessa fattura, basta inserire lo stesso numero di fattura, il programma inserir&agrave in coda la voce e calcoler&agrave automaticamente il totale</small></center></p> -->

        <table align='center' border='0' width='30%'>
            <tr>
              <td colspan='2' align='center'>
              <input value='- Crea Progetto -' type='submit' <?php echo($limit); ?>></td>
            </tr>
      </tbody>
	</table>
    </form>

<!-- Per Visualizzare e modificare Progetto -->
<hr style="width: 60%; height: 2px;">
<p><center><b>Gestione Progetti</b></center></p>
      <form action='./visual_progetto.php' method='POST'>
        <table align='center' border='0' width='45%'>
            <tr>
              <td width='80%'><font color="red">Numero Progetto *:</td>
              <td><select name="numero" >
   <option value="" selected="selected"></option>

<?php
$query = "SELECT id
	FROM tb_tot_progetto
	ORDER BY id";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";
}
?>
  </select></td>
              <td colspan='2' align='center'>
              <input value='- Vai al Progetto -' type='submit'></td>
            </tr>
	</table>
	</form>
<p><center><small>Da qui &egrave possibile visualizzare i dettagli per singolo Progetto e modificare</small></center></p>
<hr style="width: 40%; height: 2px;">

<!-- popolo la tabella progetti -->
	<p align="center"><small><b>Elenco Progetti</b></small></p>
<table class='bordo' align='center' cellpadding='0' cellspacing='0' width='60%'>
	<tr>
	<td height='25px' width='10%' align='center'><small><b>num</b></small></td>
	<td width='10%'><small><b>data</b></small></td>
	<td width='30%'><small><b>nome riferimento</b></small></td>
	<td width='40%'><small><b>descrizione</b></small></td>
	</tr>
<?php

$Query = "SELECT * FROM tb_tot_progetto ORDER BY id";

$rs=mysqli_query($connect, $Query)
or die('' . mysqli_error());

while ($row=mysqli_fetch_array($rs))
	{
echo <<<EOM
		<tr>
		<td height='25px' align='center'><small>$row[id]</small></td>
		<td height='25px'><small>$row[data]</small></td>
		<td height='25px'><small>$row[nome]</small></td>
		<td height='25px'><small>$row[descrizione]</small></td>
		</tr>


EOM;
	}

echo <<<EOT
</table><p></p>
EOT;
mysqli_close($connect);
include('./menusx.inc');
include('./botton.inc');

?>
