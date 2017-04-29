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
	mysql_connect("$host", "$username", "$password")or die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

//Recupero l'ultimo id della tabella
$Query = "SELECT MAX(id_ric) FROM tb_ricevute";
$Qultimoid = mysql_query($Query);
while($Tultimoid = mysql_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(id_ric)'];
}

?>
     <h3><center><? echo $Ltitoloric; ?></center></h3>
     
<p align="center"><small><? echo $Lnotaric; ?></small></center><br></p>
	<center><h4><? echo $Lstampa; ?></h4></center>


<!-- Stampa della ricevuta fiscale -->
<table align='center' border='0' width='30%'>
<tbody>
<form action='./stampa_rfisc.php' method='POST'>
<small><center><i><sub><? echo $Listrstampa; ?></sub></i></center></small>
	<tr><center>
	<input type="radio" name="tipo" value="immagine" checked="checked"/><small>Stampa vista immagine | </small>
	<input type="radio" name="tipo" value="foglio"/><small>Stampa vista pagina</small><br><br></center>
  </tr>
  <tr>
	<td width='50%'><font color="red"><? echo $Lnumero; ?>*:</td>

<!-- Creo la combo -->
              <td><select name="numero" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_ric
	FROM tb_ricevute
	WHERE id_ric = $a
	ORDER BY id_ric
	LIMIT 1";
 
$rs=mysql_query($query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysql_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
$a++;
} while ($a <= $ultimoid);
?>
  </select></td>

	<td><p align='center'>
		<input value='- Stampa -' type='submit' <? echo($limit); ?>></p>
	</td>
	</tr>
	</form>
</tbody>
</table>

<!-- Sezione per cancellare un record -->
<hr style="width: 80%; height: 2px; position: center">
	<p align="center"><small><b><? echo $Lcancella; ?></b></small></p>
<table align='center' border='0' width='60%'>
<tbody>
	<form action='./conf_canc_ric.php' method='POST'>
	
		<p><small><center><? echo $Listrcancella; ?></center></small></p>
	<tr>
		<td width='50%'><font color="red"><? echo $Lnumric; ?>*:</td>

<!-- Creo la combo -->
              <td><select name="id_canc" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_ric
	FROM tb_ricevute
	WHERE id_ric = $a
	ORDER BY id_ric
	LIMIT 1";
 
$rs=mysql_query($query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysql_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
$a++;
} while ($a <= $ultimoid);
?>
  </select></td>
</tr>
<tr>
              <td><font color="red"><? echo $Lvocecontoec; ?>*:</td>
		<td colspan='2'>
<center>
<select name="contoec" >
   <option value="" selected="selected"><? echo $Lcausale; ?></option>

<?php
$query = "SELECT descrizione FROM tb_conto_economico";
 
$rs=mysql_query($query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysql_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}

?>
</center></td>
            </tr>
<tr>
	<td  colspan='2' align='center'><sub><i><center><small><? echo $Listrcontoec; ?></small></center></i></sub><p >
		<input value='- Cancella -' type='submit' <? echo($limit); ?>></p>
	</td>
	</tr>
	</form>
</tbody>
</table>
<hr style="width: 60%; height: 2px;">
	<p align="center"><small><b><? echo $Lmodifica; ?></b></small></p>

<!-- Sezione per modificare un record -->
<p align="center"><small><? echo $Listrmodifica; ?></p></small>

<table align='center' border='0' width='50%'>
          <tbody>
	<form action='./conf_mod_ric.php' method='POST'>
            <tr>
              <td width='50%'><font color="red"><? echo $Lnumric; ?>*:</td>
<!-- Creo la combo -->
              <td width='50%'><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_ric
	FROM tb_ricevute
	WHERE id_ric = $a
	ORDER BY id_ric
	LIMIT 1";
 
$rs=mysql_query($query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysql_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
$a++;
} while ($a <= $ultimoid);
?>
  </select></td>

            </tr>
            <tr>
		<td><font color="red"><? echo $Lcampo; ?>*:</td>
		<td>
<select name="campo" >
	<option value="" selected="selected"></option>
  <option value="nome"><? echo $Lnome; ?></option>
  <option value="data"><? echo $Ldata; ?></option>
  <option value="euro"><? echo $Lprezzo; ?></option>
  <option value="descr"><? echo $Ldescrizione; ?></option>
</td>
	</tr>
	<tr>
		<td ><font color="red"><? echo $Lnuovorecord; ?>*:</td>
		<td><input name='record' type='text' required='required'></td>
	</tr>
	<tr>
	<td colspan='2' align='center'><sub><center><small><i><? echo $Listrnuovorecord; ?></i></small></center></sub>
	<input value='- Modifica -' type='submit' <? echo($limit); ?>></td>
	</tr>
	</form>
</tbody>
</table>

<!-- ELENCO DELLE RICEVUTE -->
	<h3 align="center"><? echo $Lelencoricevute; ?></h3>
<table class='bordo' align='center' cellpadding='2' cellspacing='2' width='80%'>
	<tr>
	<td height='25px' width='10%' align='center'><small><b><? echo $Lnumric; ?></b></small></td>
	<td width='15%'><small><b><? echo $Ldata; ?></b></small></td>
	<td width='25%'><small><b><? echo $Lnome; ?></b></small></td>
	<td width='20%' align='right'><small><b><? echo $Leuro; ?></b></small></td>
	<td width='30%' align='right'><small><b><? echo $Ldescrizione; ?></b></small></td>
	</tr>
<?php
// popolo la tabella delle ricevute
$Query = "SELECT * FROM tb_ricevute ORDER BY id_ric";

$rs=mysql_query($Query)
or die('' . mysql_error());

while ($row=mysql_fetch_array($rs))
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
mysql_close();
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><? echo $Lhelpric; ?>
<hr></i></small><?
include('./botton.inc');

?>

