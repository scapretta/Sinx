<?php
/*======================================================================+
 File name   : gest_files.php
 Begin       : 2012-07-08
 Last Update : 2012-07-08

 Description : Image and files upload

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
$langgestfiles = $_SESSION['lingua'];
$paginagestfiles = "gestfiles.inc";
$linguagestfiles = ($langgestfiles.$paginagestfiles);
include($linguagestfiles);


if ($user == 'admin') {

include('./top.inc');
include('./menu.inc');
?>
<!-- INSERIMENTO IMMAGINI -->
      <form action='./conf_immagine.php' method='POST' enctype="multipart/form-data">
<center><h2><?php echo $Ltitologestfiles ?></h2></center>
<table align='center' width='80%'>

	    <tr>
	      <td width='150'><?php echo $Lcaricaimmagine ?><input type="hidden" name="MAX_FILE_SIZE" value="30000"> </td>
	      <td> <input name="immagine" type="file" accept="image/*"><br><small><sub><i><?php echo $Lsugg1caricaimmagine ?></b></small></i></sub></td>
	      <td><small><sub><i><?php echo $Lsugg2caricaimmagine ?></sub></small></td>
	    </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit'></td>
            </tr>
</table>
</form>

<!-- INSERIMENTO FILES -->
<hr style="width: 80%; height: 2px;">
      <form action='./conf_files.php' method='POST' enctype="multipart/form-data">
<center><h3><?php echo $Ltitolocaricamoduli ?></h3></center>
<table align='center' width='80%'>

	    <tr>
	      <td width='150'><?php echo $Lcaricafile ?><input type="hidden" name="MAX_FILE_SIZE" value="1000000"> </td>
	      <td> <input name="immagine" type="file" accept="application/pdf,application/text,application/odt"><br><small><sub><i><?php echo $Lsugg1caricafiles ?></small></i></sub></td>
	      <td><small><sub><i><?php echo $Lsugg2caricafiles ?></b>.<br></i></sub></small></td>
	    </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit'></td>
            </tr>
</table>
<table align='center' border='0' width='60%'>
<tr>
<center><h4><?php echo $Lfileeimmaginicaricate ?></h4></center>
	<!--<td height=50%; align='center'><a href="./Files.php">Directory Moduli e Files</td>-->
<td height=50%; align='center'><input type="button" value="Files e Immagini" onclick="top.location.href = './Files.php'" /></td>

</tr>
          </tbody>
        </table>
</form>

<!-- INSERIMENTO LOGO ASSOCIAZIONE -->
<hr style="width: 40%; height: 2px;">
<center><h3><?php echo $Lcaricamentologo ?></h3></center>
      <form action='./conf_logo_associaz.php' method='POST' enctype="multipart/form-data">
<table align='center' width='80%'>

	    <tr>
	      <td width='150'><?php echo $Lcaricalogo ?>:<input type="hidden" name="MAX_FILE_SIZE" value="30000"> </td>
	      <td> <input name="immagine" type="file" accept="image/*"><br><small><sub><i><?php echo $Lsugg2caricalogo ?></b></small></i></sub></td>
	      <td><small><sub><i><?php echo $Lsugg1caricalogo ?></sub></small></td>
	    </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='invia' type='submit'></td>
            </tr>
</table>
</form>


<?php
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lhelpgestimmagini ?><hr></i></small>

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

echo "<center>$Llivello1gestimmagini<b>$user</b> <br>$Llivello2gestimmagini<b>Admin</b></center>";
redirect('./index2.php',3);
}
?>
