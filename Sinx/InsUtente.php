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
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");
?>
     <center><h2><?php echo $Ltitoloutente ?></h2></center>
     
      <form action='./InsUtente_exp.php'>
 <center><button name="stampa" type="submit">
   Stampa | Cancella | Modifica
 </button></center>
 </form>

<!-- Inserimento Voci db -->
     <p align="center"><b><small><?php echo $Linsnuovoutente ?></small></b></p>
<center><small><?php echo $Lsuggnuovoutente ?></small></center>
<br>
      <form action='./conf_dati_utente.php' method='POST'>
        <table align='center' border='0' width='60%'>
          <tbody>
            <tr>
              <td width='150'><font color="red"><?php echo $Lnuovoutente ?> *:</td>
              <td><input value="Nome Utente" name='nomeut' size='30' type='text' required='required'></td>
            </tr>
            <tr>
              <td width='150'><font color="red"><?php echo $Llivelloutente ?> *:</td>
              <td><select name="livello" >
   <option value="" selected="selected"></option>
  <option value="admin"><?php echo $Lamministrutente ?></option>
  <option value="operatore"><?php echo $Loperatoreutente ?></option>
  <option value="associato"><?php echo $Loperatorelimitato ?></option>
  <option value="limitato"><?php echo $Llimitatoutente ?></option>
  
  </select>
	</td>
       </tr>
            <tr>
              <td width='150'><font color="red"><?php echo $Lpasswdutente ?> *:</td>
              <td><input type='password' name='passwd' size='30' required='required'></td>
            </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit'></td>
            </tr>
          </tbody>
        </table>
        <br>
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

// NOTE PRIVATE DELL'UTENTE

$Query_nome = "SELECT * FROM utenti WHERE utente = '$nutente'";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$riga=mysqli_fetch_array($rs);

echo <<<EOT
<center><h3>Note personali</h3></center>

<!-- Compilazione nuovo progetto -->
     <p align="center"><b>Compilazione e lista delle note</b></p>

<br>
       <form action='./conf_note_utenti.php' method='POST' enctype="multipart/form-data">

<table align='center' border='0' width='80%'>
<tbody>
	<tr>
	 <td height='100%' width='38%'><small>Note private di $nutente</small></td>
	</tr>
	<tr>
	  <td><input name='nome' size='5%' type='text' value='$riga[id]' readonly='readonly'></td>
	</tr>
	<tr>
	  <td><textarea name='formcontent' rows="20" cols="100%" >$riga[note]</textarea></td>
	</tr>
EOT;
 ?>
</table>

        <table align='center' border='0' width='30%'>
            <tr>
              <td colspan='2' align='center'>
              <input value='- Registra Nota -' type='submit'<? echo($limit);?>></td>
            </tr>
      </tbody>
	</table>
    </form>
<?

mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelputente ?><hr></i></small>

<?
include('./botton.inc');

//Nel caso di accesso per livelli inferiori da admin
} else if ($user != 'admin'){

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name" ) or die("cannot connect DB");

// popolo la tabella visualizzazione elenco
$Query_nome = "SELECT * FROM utenti WHERE utente = '$nutente'";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$riga=mysqli_fetch_array($rs);
?>
     <center><h2><?php echo $nutente?></h2></center>
	

<!-- Modifica delle voci -->
	
<table align='center' border='0' width='50%'>
          <tbody>
	<td><form action='./conf_mod_utenti.php' method='POST'></td>
            <tr>
              <td width='150'>Id*:</td>
              <td><input name='id_mod' size='10' type='text' value= '<? echo $riga[id]; ?>' readonly='readonly'></td>
            </tr>
            <tr>
		<td width='150'><font color="red"><?php echo $Lcampoutente ?>*:</td>
<td><select name="campo" >
	<option value="" selected="selected"><?php echo $Lsuggcampoutente ?></option>
 <option value="utente"><?php echo $Lnomeutente ?></option>
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
<?
// NOTE PRIVATE DELL'UTENTE

$Query_nome = "SELECT * FROM utenti WHERE utente = '$nutente'";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$riga=mysqli_fetch_array($rs);

echo <<<EOT
<center><h3>Note personali</h3></center>

<!-- Compilazione nuovo progetto -->
     <p align="center"><b>Compilazione e lista delle note</b></p>

<br>
       <form action='./conf_note_utenti.php' method='POST' enctype="multipart/form-data">

<table align='center' border='0' width='80%'>
<tbody>
	<tr>
	 <td height='100%' width='38%'><small>Note private di $nutente</small></td>
	</tr>
	<tr>
	  <td><input name='nome' size='5%' type='text' value='$riga[id]' readonly='readonly'></td>
	</tr>
	<tr>
	  <td><textarea name='formcontent' rows="20" cols="100%" >$riga[note]</textarea></td>
	</tr>
EOT;
 ?>
</table>

        <table align='center' border='0' width='30%'>
            <tr>
              <td colspan='2' align='center'>
              <input value='- Registra Nota -' type='submit'<? echo($limit);?>></td>
            </tr>
      </tbody>
	</table>
    </form>

<?
mysqli_close($connect);
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelputentesingolo ?><hr></i></small>

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
