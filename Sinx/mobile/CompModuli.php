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


function modulo($limite)
{
$langmoduli = $_SESSION['lingua'];
$paginamoduli = "moduli.inc";
$linguamoduli = ($langmoduli.$paginamoduli);
include($linguamoduli);

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");
	
?>
      <center><h2><? echo $Ltitolomoduli ?></h2></center>
      <form action='./gen_moduli.php' method='POST'>
        <table align='center' border='0' width='80%' cellspacing='6'>
 <caption>
  <center><small><i><? echo $Lsugg1moduli ?></i></small></center>
 </caption>
          <tbody>
            <tr>
              <td width='30%'><font color="red"><? echo $Lmodulo ?>*:</td>
              <td><select name="modulo" >
   <option value="" selected="selected"><? echo $Lmodulo ?>  </option>
   
<optgroup label="Associazione -> Socio" <? echo $limite; ?>>
	<option value="ammissione" ><? echo $Lammissionsocio ?></option>
	<option value="ammissioneminore" ><? echo $Lammissionesociominore ?></option>
	<option value="consenso" ><? echo $Lconsensoprivacy ?></option>
</optgroup>
<optgroup label="Socio -> Associazione" >
	<option value="consenso" ><? echo $Lconsensoprivacy ?></option>
	<option value="dimissioni" ><? echo $Ldimissionisocio ?></option>
	<option value="rimborso" ><? echo $Lrimborsospese ?></option>
	<option value="rapporto" ><? echo $Lrapportosoci ?></option>
</optgroup>
<optgroup label="interno Associazione" <? echo $limite; ?>>
	<option value="consiglio" ><? echo $Lverbassemblea ?>/<? echo $Lriunione ?></option>
	<option value="convocazione" ><? echo $Lconvocazioneconsiglio ?></option>
	<option value="convocazioneassemblea" ><? echo $Lconvocazioneassemblea ?></option>
</optgroup>
  </select></td>
            </tr>
            <tr>
              <td ><? echo $Lassociato ?>:</td>
              <td colspan='2'><select name="nomeass" >
   <option value="" selected="selected"><? echo $Lnome ?>: </option>
              <?php
		$query = "SELECT nome FROM tb_anagrafe ORDER BY nome";
 
$rs=mysqli_query($connect,  $query)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");

while ($row=mysqli_fetch_row($rs))
{
echo "<option>" .$row["0"]. "</option>";

}
?></select></td>
            </tr>
            <tr>
              <td width='30%'><? echo $Ldata ?>documento</td>
              <td><input name='data' size='30' type='text' value=<?php echo date('d-m-Y') ?>><br><small><sub><i><? echo $Ltuttimoduli ?></small></i></sub></td>
            </tr>
                        <tr>
              <td width='30%'><? echo $Ldata2 ?>:</td>
              <td><input name='data2' size='30' type='text' value=<?php echo date('d-m-Y-H:i'); ?>><br><small><sub><i><? echo $Ldataritrovo ?> - <? echo $Lconvocazioneconsiglio ?></small></i></sub></td>
            </tr>
                        <tr>
              <td width='30%'><? echo $Ldata3 ?>:</td>
              <td><input name='data3' size='30' type='text' value=<?php echo date('d-m-Y-H:i'); ?>><br><small><sub><i><? echo $Ldataritrovo2 ?></small></i></sub></td>
            </tr>
            <tr><td colspan="2" bgcolor="#fffece"><center><small><sub><i><? echo $Lsugg2moduli ?><br> &lt;br&gt; <? echo $Lvacapo ?> - &lt;b&gt;&lt;/b&gt; <? echo $Lgrassetto ?> - &lt;i&gt;&lt;/i&gt;<? echo $Lcorsivo ?> - &lt;hr&gt; <? echo $Llineaorr ?> - &lt;li&gt;&lt;/li&gt; <? echo $Lelenco ?></small></i></sub></center></td>
            </tr>
	    <tr>
	      <td width='150'><? echo $Lsocipresenti ?>:</td>
	      <td><textarea name='presenti' rows="5" cols="40">&lt;li&gt;<? echo ($Lsocio.$Luno) ?> &lt;/li&gt;&lt;li&gt;<? echo ($Lsocio.$Ldue) ?>&lt;/li&gt;</textarea><br><small><sub><i>"<? echo $Lverbassemblea ?>" - "<? echo $Lrapportosoci ?>"</small></i></sub></td>
            </tr>
            <tr>
	      <td width='150'><? echo $Lordinegiorno ?><br><? echo $Lluogoattivitasoci ?>:<br><br></td>
	      <td><textarea name='OrdineGiorno' rows="5" cols="40">&lt;li&gt;<? echo $Lordinegiorno.$Luno ?>&lt;/li&gt;&lt;li&gt;<? echo $Lordinegiorno.$Ldue ?>&lt;/li&gt;</textarea><br><small><sub><i>"<? echo $Lverbassemblea?>" - "<? echo $Lconvocazioneconsiglio ?>" - "<? echo $Lrapportosoci ?>" - "<? echo $Lconvocazioneassemblea?>"</small></i></sub></td>
            </tr>
	    <tr>
	      <td width='150'><? echo $Lverbale ?>:</td>
	      <td><textarea name='Verbale' rows="5" cols="40"></textarea><br><small><sub><i>"<? echo $Lverbassemblea ?>" - "<? echo $Lrimborsospese ?>" - "<? echo $Ldimissionisocio ?>" - "<? echo $Lrapportosoci ?>"</small></i></sub></td>
            </tr>

            <tr>
              <td colspan='2' align='center'>
              <input value='- Crea Modulo -' type='submit'></td>
            </tr>
</table>
<hr style="width: 60%; height: 2px;">
<table align='center' border='0' width='60%'>
<tr>
	<!--<td height=50%; align='center'><a href="./Files.php">Directory Moduli e Files</td>-->
<td height=50%; align='center'><a class="transp" href="./Files.php"><img src="./ImmTemplate/Pulsanti/Files.png" title="Caricamento files e immagini" ></img></a></td>

</tr>
          </tbody>
        </table>
        <br>
      </form>
<?php

include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><? echo $Lsugg3moduli ?>
<hr></i></small><?
include('./botton.inc');
}

if ($user == 'admin') {
  modulo();
} else if ($user == 'limitato') {
  header('Location: Rip_database.php');
} else if ($user == 'operatore') {
  $limit='';
  modulo();
} else if ($user == 'associato') {
 $limit='disabled';
 modulo($limit);
 
}

if( isset($connect) ) mysqli_close($connect);
?>

