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
$langricerca = $_SESSION['lingua'];
$paginaricerca = "ricerca.inc";
$linguaricerca = ($langricerca.$paginaricerca);
include($linguaricerca);

if ($user == 'admin') {
  $limit='';
} else if ($user == 'associato') {
  $limit='disabled';
} else if ($user == 'limitato') {
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
redirect('./Redirect_no_enter.php',0);
}


include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

?>
<center><h2><?php echo $Ltitoloricerca; ?></h2></center>
<center><br><table style="text-align: left; width: 50%;"
 border="0" cellpadding="2" cellspacing="1">
  <tbody>
    <tr>
      <td width="33%"><img align="middle" src="./ImmTemplate/block.png"><?php echo $Lfondatori; ?></td>
      <td width="33%">
	<form action='./ricerca_nome_stud.php?tipologia=Stud' method='POST'>

	<p colspan='2' align='center'>
<select name="iniziale" >
	<option value="" selected="selected"></option>
  <option value="a">A</option>
  <option value="b">B</option>
  <option value="c">C</option>
  <option value="d">D</option>
  <option value="e">E</option>
  <option value="f">F</option>
  <option value="g">G</option>
  <option value="h">H</option>
  <option value="i">I</option>
  <option value="j">J</option>
  <option value="k">K</option>
  <option value="l">L</option>
  <option value="m">M</option>
  <option value="n">N</option>
  <option value="o">O</option>
  <option value="p">P</option>
  <option value="q">Q</option>
  <option value="r">R</option>
  <option value="s">S</option>
  <option value="t">T</option>
  <option value="u">U</option>
  <option value="v">V</option>
  <option value="w">W</option>
  <option value="x">X</option>
  <option value="y">Y</option>
  <option value="z">Z</option></p>
	<p colspan='2' align='center'>
	<input value=<? echo $Lricercanome; ?> type='submit'></p>
	</form></td>
      <td width="33%">
	<form action='./ricerca_classe_stud.php' method='POST'>
	
<p><center>
<select name="tipo" >
   <option value="" selected="selected"><?php echo $Lfunzione; ?></option>

<?php
$query = "SELECT classe FROM tb_classe";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}

?>
</center></p>
<p colspan='2' align='center'>
	<input value=<? echo $Lfunzione; ?> type='submit'></p>
	</form>
</td>
</tr>
<tr><td></td><td><sub><i><small><?php echo $Lnota1; ?></small></i></sub></td><td></td></tr>
</table>

<hr style="width: 80%; height: 2px;">
<table style="text-align: left; width: 50%;"
 border="0" cellpadding="2" cellspacing="1">
  <tbody>
	<tr>
      <td width="33%"><img align="middle" src="./ImmTemplate/personal.gif"><?php echo $Lassociati; ?></td>
      <td width="33%">
	<form action='./ricerca_nome_stud.php?tipologia=Ins' method='POST'>

	<p colspan='2' align='center'>
<select name="iniziale" >
	<option value="" selected="selected"></option>
  <option value="a">A</option>
  <option value="b">B</option>
  <option value="c">C</option>
  <option value="d">D</option>
  <option value="e">E</option>
  <option value="f">F</option>
  <option value="g">G</option>
  <option value="h">H</option>
  <option value="i">I</option>
  <option value="j">J</option>
  <option value="k">K</option>
  <option value="l">L</option>
  <option value="m">M</option>
  <option value="n">N</option>
  <option value="o">O</option>
  <option value="p">P</option>
  <option value="q">Q</option>
  <option value="r">R</option>
  <option value="s">S</option>
  <option value="t">T</option>
  <option value="u">U</option>
  <option value="v">V</option>
  <option value="w">W</option>
  <option value="x">X</option>
  <option value="y">Y</option>
  <option value="z">Z</option></p>

	<p colspan='2' align='center'>
	<input value=<? echo $Lricercanome; ?> type='submit'></p>
	</form></td>
     <td width="33%">
	<form action='./ricerca_tipo_ass.php' method='POST'>

<p><center>
<select name="tipo" >
   <option value="" selected="selected"><?php echo $Ltipo; ?></option>

<?php
$query = "SELECT materia FROM tb_materia";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}

?></p>
	<p colspan='2' align='center'>
	<input value=<? echo $Ltipo; ?> type='submit'></p>
</form>
</td>
    </tr>
<tr><td></td><td><sub><i><small><?php echo $Lnota1; ?></small></i></sub></td><td></td></tr>

  </tbody>
</table></center>

<hr style="width: 60%; height: 2px;">
<center><table style="text-align: left; width: 50%;"
 border="0" cellpadding="1" cellspacing="1">
 
  <tbody>
	<tr>
      <td width="33%"><img align="middle" src="./ImmTemplate/masssubscribe.gif"><?php echo $Lcontatti; ?></td>
	<td width="33%">	<form action='./ricerca_nome_stud.php?tipologia=Extra' method='POST'>
	<p colspan='2' align='center'>
	<input value=<? echo $Lricercanome; ?> type='submit'></p></td>
      <td width="33%">

	</form></td>

    </tr>
  </tbody>
</table></center>
<hr style="width: 40%; height: 2px;">
<br>

<center><h2><?php echo $Lricercaricevute; ?></h2>
<small><sub><i><?php echo $Lnota2; ?></center>
<center><br><table style="text-align: left; width: 50%;"
 border="0" cellpadding="2" cellspacing="1">
  <tbody>
	<form action='./ricerca_ricevute.php' method='POST'>
<tbody>

	    <tr><td colspan='2'><fieldset>
		<legend><small><?php echo $Lcamporicerca; ?></small></legend>
		<input type="radio" name="campo" value="nome" checked="checked"/><?php echo $Lricercanome; ?>
		<input type="radio" name="campo" value="descr" /><?php echo $Lricercadescrizione; ?>
		<input type="radio" name="campo" value="euro" /><?php echo $Lvalore; ?>
		<input type="radio" name="campo" value="data" /><?php echo $Lricercadata; ?>
		</fieldset></td>
	    </tr>

            <tr>
              <td width='10%'><font color="red"><?php echo $Lricerca; ?></td>
	      <td><input name='ricevute' size='40%' type='search'><br></td>
	      <td><input value=<? echo $Lcerca; ?> size='50%' type='submit'></td>            
	    </tr>
	    
</tbody>
	</form>
</table>

<h4><?php echo $Ltitoloesempio; ?></h4>
<?php echo $Lesempioricric; ?>

<?php
mysqli_close($connect);
include('./menusx.inc');
echo $Lhelpricerca;
include('./botton.inc');

?>
