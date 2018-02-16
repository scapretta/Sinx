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
?>

     <center><h3><?php echo $Ltitoloprimanota; ?></h3></center>
<center><small><?php echo $Lnota; ?></small><center><br>

 <form action='./InsPrimanota_exp.php'>
 <center><button name="stampa" type="submit" <?php echo($limite); echo($limit); ?>>
   Stampa | Cancella | Modifica
 </button></center>
 </form>
 

<hr style="width: 60%; height: 2px;">
	<p align="center"><small><b><?php echo $Lnuovomovimento; ?></b></small></p>
      <form action='./conf_dati_pnota.php' method='POST'>

<!-- Sezione per inserire una nuova voce di primanota -->
        <table align='center' border='0' width='60%'>
          <tbody>
            <tr>
              <td width='150'><?php echo $Ldata; ?>:</td>
	      <td width='50'><input name='data' size='10' type='text' required='required' value=<?php echo date('d-m-Y') ?> ><br></td>
            </tr>
            <tr>
              <td width='150'><font color="red"><?php echo $Lvocecontoec; ?></td>
		<td>
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
</center></p><br><small><sub><i><?php echo $Linserirecausale; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><font color="red"><?php echo $Loperazione; ?></td>
		<td><input name='operazione' size='30' type='text'><br><small><sub><i><?php echo $Linserirecausale; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><?php echo $Limporto; ?></td>
              <td><input name='valore' size='30' type='text'><br><small><sub><i><?php echo $Lsuggdecimali; ?></small></i></sub></td>
            </tr>
            <tr>
              <td width='150'><?php echo $Ltipodivoce; ?></td>
              <td>
	      <fieldset>
	      <legend><small><i><?php echo $Ltipomovimento; ?></i></small></legend>
  <small><b><i><?php echo $Lcassa; ?></i></b></small><br>
  <input type="radio" name="conto" value="entrata" checked="checked"/><small><?php echo $Lentrata; ?> -</small>
  <input type="radio" name="conto" value="uscita"/><small><?php echo $Luscita; ?></small><br><br>
  <small><b><i><?php echo $Lbanca; ?></i></b></small><br>
  <input type="radio" name="conto" value="entratab" /><small><?php echo $Lentrata; ?> -</small>
  <input type="radio" name="conto" value="uscitab"/><small><?php echo $Luscita; ?></small>
	      </fieldset>
	    </td>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit' <?php echo($limit); echo($limite); ?>></td>
            </tr>
          </tbody>
        </table>
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
	<td height='30px' width='22%'><small><?php echo $Luscitabanca; ?></small></td>
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
