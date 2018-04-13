<?php
/*======================================================================+
 File name   : menu.inc
 Begin       : 2010-08-04
 Last Update : 2012-12-27

 Description : secondary menu

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
$langdatiass = $_SESSION['lingua'];
$paginadatiass = "datiassociaz.inc";
$linguadatiass = ($langdatiass.$paginadatiass);
include($linguadatiass);

if ($user == 'admin') {
  $limit=''; $limite='';
} else if ($user == 'limitato') {
  $limit='disabled'; $limite='';
} else if ($user == 'operatore') {
  $limit='disabled'; $limite='';
} else if ($user == 'associato') {
  $limit='disabled'; $limite='disabled';
}

include('./top.inc');
include('./menu.inc');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

$Query_nome = "SELECT * FROM tb_anagrafe_associaz";

$rs=mysqli_query($connect, $Query_nome)
or die("<b>Errore:</b> Impossibile eseguire la query della Combo");
$row=mysqli_fetch_array($rs);

?>
<center><h2><?php echo $Ldatiassociazione; ?></h2></center>
<center><small><?php echo $Linsomod; ?></small></center>
<br>

      <form action='./conf_mod_Associaz.php' method='POST' enctype="multipart/form-data">
<table align='center' width='80%'>
<tbody>
	    <tr>
              <td width='70%'><?php echo $Llogoassociaz; ?></td>
              <td><img src='./Immagini/logo.png' width="100px"></td>
              
              <td><input type="button" <?php echo($limit);?> <? echo($limite);?> value=<? echo $Lcambialogo; ?> onclick="top.location.href = './gest_files.php'" /></td>
            </tr>
	    <tr>
              <td width='70%'><font color="red"><?php echo $Lnomeassociaz; ?></td>
              <td><input name='nome' size='30%' type='text' required='required' value='<?php echo $row['nome'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Lvia; ?></td>
              <td><input name='indirizzo' size='30%' type='text' value='<?php echo $row['indirizzo'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Lnumero; ?></td>
              <td><input name='numero' size='30%' type='text' value='<?php echo $row['numero'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Lcap; ?></td>
              <td><input name='cap' size='30%' type='text' value='<?php echo $row['cap'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Lcitta; ?></td>
              <td><input name='citta' size='30%' type='text' value='<?php echo $row['citta'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Lprovincia; ?></td>
              <td><input name='provincia' size='30%' type='text' value='<?php echo $row['provincia'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Ltelefono; ?></td>
              <td><input name='tel' size='30%' type='text' value='<?php echo $row['tel'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Lfax; ?></td>
              <td><input name='fax' size='30%' type='text' value='<?php echo $row['fax'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Lcfpi; ?></td>
              <td><input name='cf' size='30%' type='text' value='<?php echo $row['cf'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Lindirizzo; ?>e-mail:</td>
              <td><input name='email' size='30%' placeholder='email@socio.xxx' type='text' value='<?php echo $row['email'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Lindirizzo; ?>webmail:</td>
              <td><input name='webmail' size='30%' placeholder='http://webmail.dominio.xxx' type='text' value='<?php echo $row['webmail'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $LPEC; ?></td>
              <td><input name='PEC' size='30%' type='text' value='<?php echo $row['PEC'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $LwebPEC; ?></td>
              <td><input name='webPEC' size='30%' type='text' value='<?php echo $row['webPEC'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo ($Lindirizzo.$Lsito); ?></td>
              <td><input name='sito' size='30%' placeholder='http://www.sito.xxx' type='text' value='<?php echo $row['sito'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Lfacebook; ?></td>
              <td><input name='facebook' size='30%' type='text' value='<?php echo $row['facebook'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Linstagram; ?></td>
              <td><input name='instagram' size='30%' type='text' value='<?php echo $row['instagram'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Ltwitter; ?></td>
              <td><input name='twitter' size='30%' type='text' value='<?php echo $row['twitter'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Lyoutube; ?></td>
              <td><input name='youtube' size='30%' type='text' value='<?php echo $row['youtube'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $Lbanca; ?></td>
              <td><input name='banca' size='30%' type='text' value='<?php echo $row['banca'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $LIBAN; ?></td>
              <td><input name='IBAN' size='30%' type='text' value='<?php echo $row['IBAN'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $LBIC; ?></td>
              <td><input name='BIC' size='30%' type='text' value='<?php echo $row['BIC'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $LHomeBanking; ?></td>
              <td><input name='HomeBanking' size='30%' type='text' value='<?php echo $row['HomeBanking'] ?>'></td>
            </tr>
            <tr>
              <td width='70%'><?php echo $LIscrizioneODVoAPS; ?></td>
              <td><input name='IscrizioneODVoAPS' size='30%' type='text' value='<?php echo $row['IscrizioneODVoAPS'] ?>'></td>
            </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value=<? echo $Linvia; ?> type='submit' <?php echo($limit);?> <? echo($limite);?>></td>
            </tr>
</table>
</form>
<?php
include('./menusx.inc');
echo $Lhelpdatiassociaz;
include('./botton.inc');

?>
