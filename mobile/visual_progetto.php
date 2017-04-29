<?php
/*======================================================================+
 File name   : visual_progetto.php
 Begin       : 2013-08-06
 Last Update : 2013-08-06

 Description : View and edit project

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


$progetto = $_POST['numero'];
//Controllo dati
		if ($progetto == "")
 		{
   		echo "<center><b>Numero progetto non selezionato</b><br>Inserisci un numero corretto</center>";
   		redirect('./InsProgetto.php',2);
		// break;
die ("");
		}

$dataoggi = date('d-m-Y');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

?>
<!-- cancella -->
<h2>Gestione progetto</h2>
	<p align="center"><small><b>Cancella</b></small></p>
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
		<td><p><small>Inserisci il numero id della riga da cancellare e premi cancella</small></p></td>
	<td><form action='./conf_canc.php?Tabella=tb_progetto&Riferimento=id_riga_art' method='POST'>
		</td>		
		<td width='10'>id*:</td>
		<td><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php

$query = "SELECT id_riga_art
	FROM tb_progetto
	WHERE id_progetto = $progetto
	ORDER BY id_riga_art";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}

?>
  </select></td>
	<td><p colspan='2' align='center'>
		<input value='- Cancella -' type='submit' <?php echo($limit); ?>></p>
	</td>
	</tr>
</tbody>
</table>
</form>
<hr style="width: 80%; height: 2px;">

<!-- Blocco Modifica (da rendere in un unico blocco comune) -->
	<p align="center"><small><b>Modifica</b></small></p>
<p align="center"><small>Inserisci in numero id e campo della riga da modificare<br>Inserisci la modifica su Nuovo record e premi modifica</p></small>

<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod_progetto.php' method='POST'></td>
            <tr>
              <td width='150'>Id*:</td>
              <td><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php
$query = "SELECT id_riga_art
	FROM tb_progetto
	WHERE id_progetto = $progetto
	ORDER BY id_riga_art";
 
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
		<td width='150'>Campo*:</td>
<td><select name="campo" >
	<option value="" selected="selected">Seleziona il campo</option>
  <option value="quantita">Quantit&agrave</option>
  <option value="descr">Descrizione</option>
  <option value="euro">Prezzo Unitario</option>
  <option value="iva">Iva</option>
</select>
	</td>
	</tr>
	<tr>
		<td width='150'>Nuovo record*:</td>
		<td><input name='record' size='20' type='text'></td>
	<td><p colspan='2' align='center'>
	<input value=' Modifica ' type='submit' <?php echo($limit); ?>></p></td>
	</tr>

</tbody>
</table>
</form> 
<hr style="width: 60%; height: 2px;">


<!-- AGGIUNGI RECORD DEL PROGETTO -->
<p align="center"><small><b>Aggiungi voce nel progetto</b></small></p>
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
<p><center><small>Per inserire pi&ugrave voci nella stessa fattura, basta inserire lo stesso numero di fattura, il programma inserir&agrave in coda la voce e calcoler&agrave automaticamente il totale</small></center></p>


<!-- VISUALIZZAZIONE PROGETTO -->
<h3>Dettagli Progetto n.<i><?php echo($progetto) ?></i></h3>

<?php
$query_cliente = "SELECT nome, data, descrizione FROM tb_tot_progetto WHERE id = '$progetto'";
 $comando=mysqli_query($connect, $query_cliente) or die(mysqli_error);
 while ($array=mysqli_fetch_array($comando))
  {
   echo <<<EOM
<br>
<table align='center' border='0' cellpadding='1' cellspacing='2' width='100%'>
	<tr>
	<td width='100'><b>Descrizione Generale</b></td>
	</tr>
	<tr>
	<td width='100'><small>Progetto creato il: <b>$array[data]</b></small></td>
	</tr>
	<tr>
	<td width='100'><small>Associato di riferimento: <b>$array[nome]</b></small></td>
	</tr>
	<tr>	
	<td width='100'><small>Descrizione: <b>$array[descrizione]</b></small></td>
	</tr>
	<tr><td height='35px'></td></tr>
</table>
EOM;
}
$query = "SELECT SUM(totale) as totale_numero FROM tb_progetto WHERE id_riga_art = $progetto";
$result = mysqli_query($connect,  $query);
  $row = mysqli_fetch_array($result);
$totale = $row['totale_numero'];
{
   echo <<<EOM

<table align='left' border='0' cellpadding='1' cellspacing='2' width='30%' bgcolor="#D1D1D1">
	<tr>
	<td width='100'><small><b>Totale Progetto:</b></small></td>
	<td width='100'><small>$totale &euro;</small></td>
	</tr>
</table>
EOM;
}


$Query_tab = "SELECT * FROM tb_progetto WHERE id_progetto = '$progetto'";
$ris=mysqli_query($connect, $Query_tab)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM

<table align='center' border='0' cellpadding='2' cellspacing='2' width='90%'>

	<tr>
	<td width='5%' height='35px' bgcolor="#D1D1D1"><small><b>id articolo </b></small></td>
	<td width='5%' height='35px' bgcolor="#D1D1D1"><small><b>Data </b></small></td>
	<td width='15%' height='35px' bgcolor="#D1D1D1"><small><b>Associato </b></small></td>
	<td width='30%' height='35px' bgcolor="#D1D1D1"><small><b>Descrizione </b></small></td>
	<td width='5%' height='35px' bgcolor="#D1D1D1"><small><b>Quantit&agrave </b></small></td>
	<td width='15%' height='35px' bgcolor="#D1D1D1"><small><b>Euro </b></small></td>
	<td width='5%' height='35px' bgcolor="#D1D1D1"><small><b>IVA </b></small></td>
	<td width='20%' height='35px' bgcolor="#D1D1D1"><small><b>Totale </b></small></td>

	</tr>
EOM;
}

while ($riga=mysqli_fetch_array($ris))
{
echo <<<EOM
	<tr>
	<td height='35px'><small>$riga[id_riga_art]</small></td>
	<td height='35px'><small>$riga[data]</small></td>
	<td height='35px'><small>$riga[nome]</small></td>
	<td height='35px'><small>$riga[descrizione] </small></td>
	<td height='35px'><small>$riga[quantita] %</small></td>
	<td><small>$riga[euro] </small></td>
	<td><small>$riga[iva] </small></td>
	<td><small>$riga[totale] </small></td>

	</tr>
EOM;
}

echo <<<EOT
</table>
EOT;



mysqli_close($connect);
include('./menusx.inc');
include('./botton.inc');

?>
