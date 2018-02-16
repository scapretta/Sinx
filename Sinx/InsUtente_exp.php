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
$langutente = $_SESSION['lingua'];
$paginautente = "insutente.inc";
$linguautente = ($langutente.$paginautente);
include($linguautente);

if ($user == 'admin') {

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name" ) or die("cannot connect DB");

//Recupero l'ultimo id della tabella
$Query = "SELECT MAX(id) FROM utenti";
$Qultimoid = mysqli_query($connect, $Query);
while($Tultimoid = mysqli_fetch_array($Qultimoid)){
$ultimoid= $Tultimoid['MAX(id)'];
}
?>
     <center><h2><?php echo $Ltitoloutente ?></h2></center>
	<p align="center"><small><b><?php echo $Lcancutente ?></b></small></p>

<!-- Cancellazione e Modifica voci db -->
<table align='center' border='0' width='40%'>
<tbody>
	<tr>
		<td><p><small><?php echo $Lsuggcancutente ?></small></p></td>
	<td><form action='./conf_canc.php?Tabella=utenti&Riferimento=id' method='POST'>
		</td>		
		<td width='10'>id:</td>

<!-- Creo la combo -->
              <td><select name="id_mod" >
   <option value="" selected="selected"></option>

<?php
$a = '1';
do {
$query = "SELECT id
	FROM utenti
	WHERE id = $a
	ORDER BY id
	LIMIT 1";
 
$rs=mysqli_query($connect, $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
$a++;
} while ($a <= $ultimoid);
?>
  </select></td>


<!--		<td><input name='id_mod' size='10' type='text' required='required'></td> -->
	<td><p colspan='2' align='center'>
		<input value='- Cancella -' type='submit'></p>
	</td>
	</tr>
</tbody>
</table>
</form>
<hr style="width: 80%; height: 2px;">

<!-- Modifica delle voci -->
	<p align="center"><small><b><?php echo $Lmodutente ?></b></small></p>
<p align="center"><small><?php echo $Lsuggmodutente ?></p></small>

<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod_utenti.php' method='POST'></td>
            <tr>
              <td width='150'><font color="red">Id*:</td>
              <td><input name='id_mod' size='10' type='text' required='required'></td>
            </tr>
            <tr>
		<td width='150'><font color="red"><?php echo $Lcampoutente ?>*:</td>
<td><select name="campo" >
	<option value="" selected="selected"><?php echo $Lsuggcampoutente ?></option>
  <option value="utente"><?php echo $Lnomeutente ?></option>
  <option value="nome"><?php echo $Llivelloutente ?></option>
<option value="pswd">password</option>
</select>
	</td>
	</tr>
	<tr>
		<td width='150'><font color="red"><?php echo $Lnuovorecordutente ?>*:</td>
		<td><input name='record' size='20' type='text' required='required'></td>
	<td><p colspan='2' align='center'>
	<input value=' Modifica ' type='submit'></p></td>
	</tr>
</tbody>
</table>
<hr width="60%">
</form> 

<?php

// popolo la tabella visualizzazione elenco
$Query_nome = "SELECT * FROM utenti ORDER BY id";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

{
echo <<<EOM
<br>
<table class='bordo' align='center' cellpadding='0' cellspacing='0' width='50%'>
	<tr>
	<td width='30' align='center'><small><b>id</small></td>
	<td height='25px' width='125' align='center'><small><b>$Lutenteutente</b></small></td>
	<td width='125'><small><b>$Llivelloutente</b></small></td>
	</tr>
	<tr><td></td></tr>

EOM;
}

while ($row=mysqli_fetch_array($rs))
{
echo <<<EOM
	<tr>
	<td height='25px' width='30' align='center'><small>$row[id]</small></td>
	<td height='25px' width='125' align='center'><small>$row[utente]</small></td>
	<td height='25px' width='125'><small>$row[nome]</small></td>
	</tr>

EOM;
}

echo <<<EOT
</table>
EOT;
mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelputente ?><hr></i></small>

<?
include('./botton.inc');
} else {
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

echo "<center>$Lsugg1utente<b>$user</b> <br>$Lsugg2utente<b>Admin</b></center>";
redirect('./index2.php',3);
}
?>
