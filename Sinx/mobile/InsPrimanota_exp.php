<?php
/*======================================================================+
 File name   : InsPrimanota.php
 Begin       : 2010-08-04
 Last Update : 2011-04-08

 Description : Insert, modify, and delete data management first note

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
$langinsprimanota = $_SESSION['lingua'];
$paginainsprimanota = "insprimanota.inc";
$linguainsprimanota = ($langinsprimanota.$paginainsprimanota);
include($linguainsprimanota);

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
$Query = "SELECT MAX(id_primanota) FROM tb_primanota";
$Qultimoid = mysqli_query($connect, $Query);
while($Tultimoid = mysqli_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(id_primanota)'];
}

//Recupero l'ultimo id della tabella
$Query = "SELECT MAX(id) FROM tb_conto_economico";
$Qultimoid = mysqli_query($connect, $Query);
while($Tultimoid = mysqli_fetch_array($Qultimoid)){
$ultimoidce= $Tultimoid['MAX(id)'];
}

//Recupero l'ultimo id della tabella
$Query = "SELECT MAX(id) FROM tb_stato_patrimoniale";
$Qultimoid = mysqli_query($connect, $Query);
while($Tultimoid = mysqli_fetch_array($Qultimoid)){
$ultimoidsp= $Tultimoid['MAX(id)'];
}

?>
     <center><h3><?php echo $Ltitoloprimanota; ?></h3></center>
<center><small><?php echo $Lnota; ?></small><center><br>
<small><center><a href="./stampa_pnota.php"><?php echo $Lstampa; ?></a> | <a href="./Azzera.php?Tabella=tb_primanota&Modulo=Prima Nota"><?php echo $Lazzera; ?></a></center></small>
	<p align="center"><small><b><?php echo $Lcancella; ?></b></small></p>
	<p align="center"><small><i><?php echo $Linserisciid; ?></i></small></p>
	
<!-- Sezione per cancellare un record di prima nota -->
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
	<form action='./conf_canc_pnota.php' method='POST'>		
		<td width='10'><font color="red"><small>id prima nota*:</small></td>
		<td><select name="id_canc" >
   <option value="" selected="selected"></option>

<!-- SELEZIONA ID PRIMANOTA PER LA CANCELLAZIONE -->
<?php
$a = '1';
do {
$query = "SELECT id_primanota
	FROM tb_primanota
	WHERE id_primanota = $a
	ORDER BY id_primanota
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
  </select></td></tr>

<!-- SELEZIONA VOCE CONTO ECONOMICO PER LA CANCELLAZIONE -->
<tr><td width='10'><font color="red"><small>Voce Conto Economico*:</small></td>
		<td><select name="nomecontoec" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT descrizione
	FROM tb_conto_economico
	WHERE id = $a
	ORDER BY id
	LIMIT 1";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
$a++;
} while ($a <= $ultimoidce);
?>
  </select></td></tr>
    
	<tr><td colspan="2"><p colspan='2' align='center'>
		<input value='- Cancella -' type='submit' <?php echo($limit); ?>></p>
	</td>
	</tr>
	</form>
</tbody>
</table>
<hr style="width: 80%; height: 2px;">
	<p align="center"><small><b><?php echo $Lmodifica; ?></b></small></p>
<!-- Sezione per modificare un record di prima nota -->
<p align="center"><small><?php echo $Linserisciidmodifica; ?></p></small>

<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod_pnota.php' method='POST'></td>
            <tr>
              <td width='150'><font color="red"><?php echo $Lnumero; ?>*:</td>
<!-- Creo la combo -->
              <td><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id_primanota
	FROM tb_primanota
	WHERE id_primanota = $a
	ORDER BY id_primanota
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
<!--              <td><input name='id_mod' size='10' type='text'></td> -->
            </tr>
            <tr>
		<td width='150'><font color="red"><?php echo $Lcampo; ?>*:</td>
		<td>
<select name="campo" >
	<option value="" selected="selected" ></option>
  <option value="data_registr"><?php echo $Ldata; ?></option>
  <option value="descrizione"><?php echo $Ldescrizione; ?></option>
  <option value="entrata"><?php echo $Lentratacassa; ?></option>
  <option value="uscita"><?php echo $Luscitacassa; ?></option>
  <option value="entratab"><?php echo $Lentratabanca; ?></option>
  <option value="uscitab"><?php echo $Luscitacassa; ?></option>
</td>
<!--		<td><input name='campo' size='20' type='text'></td> -->
	</tr>
	<tr>
		<td width='150'><font color="red"><?php echo $Lnuovorecord; ?>*:</td>
		<td><input name='record' size='20' type='text' required='required'></td>
	<td><p colspan='2' align='center'>
	<input value=' Modifica ' type='submit' <?php echo($limit); ?>></p></td>
	</tr>
	</form>
</tbody>
</table>

<hr style="width: 60%; height: 2px;">
 </form>
	<center><h3><?php echo $Lprimanota; ?></h3></center>
<?php
// popolo la tabella della primanota
$Query_nome = "SELECT * FROM tb_primanota ORDER BY id_primanota";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<table width='95%' border='0'>
	<tr>
	<td width='64%'></td>
	<td height='35px' align='center' width='18%' bgcolor="#D1D1D1"><small><b>$Lcassa</b></small></td>
	<td height='35px' align='center' width='18%' bgcolor="#D1D1D1"><small><b>$Lbanca</b></small></td>
	</tr>
</table>
<table align='center' border='0' cellpadding='0' cellspacing='0' width='95%' bgcolor="#D1D1D1">
	<tr>
	<td height='25px' width='10%' align='center'><small><b>$Lnumero</b></small></td>
	<td width='15%'><small><b>$Ldata</b></small></td>
	<td width='35%'><small><b>$Ldescrizione</b></small></td>
	<td width='10%' align='right'><small><b>$Lentrata</b></small></td>
	<td width='10%' align='right'><small><b>$Luscita</b></small></td>
	<td width='10%' align='right'><small><b>$Lentrata</b></small></td>
	<td width='10%' align='right'><small><b>$Luscita </b></small></td>
	</tr>
	<tr><td></td></tr>
</table>
EOM;
}

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
<table align='center' border='0' cellpadding='0' cellspacing='0' width='95%'>
	<tr>
	<td height='25px' width='10%' align='center'><small>$row[id_primanota]</small></td>
	<td height='25px' width='15%'><small>$row[data_registr]</small></td>
	<td height='25px' width='35%'><small>$row[descrizione]</small></td>
	<td height='25px' width='10%' align='right'><small>$row[entrata]</small></td>
	<td height='25px' width='10%' align='right'><small>$row[uscita]</small></td>
	<td height='25px' width='10%' align='right'><small>$row[entratab]</small></td>
	<td height='25px' width='10%' align='right'><small>$row[uscitab]</small></td>
	</tr>
</table><br>
EOM;
}

//Calcolo delle somme di Cassa
$query = "SELECT SUM(entrata) FROM tb_primanota";
$result = mysqli_query($connect,  $query);
$entrata_tot = mysqli_fetch_row($result);

?>
<hr style="width: 20%; height: 2px; position: absolute; right: 16%"><br>
<table width='95%' border='0'>
<tr>
	<td width='56%'></td>
	<td height='30px' width='22%'><small><?php echo $Lentratacassa; ?></small></td>
	<td height='30px' align='right' width='22%'><small><?php echo $entrata_tot[0]; ?></small></td>
</tr>

<?php
$query = "SELECT SUM(uscita) FROM tb_primanota";
$result = mysqli_query($connect,  $query);
$uscita_tot = mysqli_fetch_row($result);

?>
<tr>
	<td width='56%'></td>
	<td height='30px' width='22%'><small><?php echo $Luscitacassa; ?></small></td>
	<td height='30px' align='right' width='22%'><small><?php echo $uscita_tot[0]; ?></small></td>
</tr>
<tr>
	<td width='56%'></td>
	<td height='30px' width='22%'><small><b><?php echo $Lguadperdita; ?></b></small></td>
	<td height='30px' align='right' width='22%'><small><b><?php echo ($entrata_tot[0]-$uscita_tot[0]); ?></b></small></td>
</tr>
</table><br>

<?php
//Calcolo delle somme di Banca
$query = "SELECT SUM(entratab) FROM tb_primanota";
$result = mysqli_query($connect,  $query);
$entratab_tot = mysqli_fetch_row($result);

?>
<hr style="width: 20%; height: 2px; position: absolute; right: 16%"><br>
<table width='95%' border='0'>
<tr>
	<td width='56%'></td>
	<td height='30px' width='22%'><small><?php echo $Lentratabanca; ?></small></td>
	<td height='30px' align='right' width='22%'><small><?php echo $entratab_tot[0]; ?></small></td>
</tr>
<?php
$query = "SELECT SUM(uscitab) FROM tb_primanota";
$result = mysqli_query($connect,  $query);
$uscitab_tot = mysqli_fetch_row($result);
?>
<tr>
	<td width='56%'></td>
	<td height='30px' width='22%'><small><?php echo $Luscitacassa; ?></small></td>
	<td height='30px' align='right' width='22%'><small><?php echo $uscitab_tot[0]; ?></small></td>
</tr>
<tr>
	<td width='56%'></td>
	<td height='30px' width='22%'><small><b><?php echo $Lguadperdita; ?></b></small></td>
	<td height='30px' align='right' width='22%'><small><b><?php echo ($entratab_tot[0]-$uscitab_tot[0]); ?></b></small></td>
</tr></table><br>
<?php
mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelpprimanota; ?><hr></i></small><?
include('./botton.inc');

?>
