<?php
/*======================================================================+
 File name   : importacsv.php
 Begin       : 2014-01-31
 Last Update : 2014-01-31

 Description : Import csv file for associates

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
$paginagestfiles = "importacsv.inc";
$linguagestfiles = ($langgestfiles.$paginagestfiles);
include($linguagestfiles);


if ($user == 'admin') {

include('./top.inc');
include('./menu.inc');
?>

<!-- UPLOAD FILES CSV-->
<hr style="width: 80%; height: 2px;">
      <form action='./conf_importacsv.php' method='POST' enctype="multipart/form-data">
<center><h3><?php echo $LTitoloimportacsv ?></h3></center>
<table align='center' width='80%'>

	    <tr>
	      <td width='150'><?php echo $Lcaricafile ?><input type="hidden" name="MAX_FILE_SIZE" value="1000000"> </td>
	      <td> <input name="filecsv" type="file"><br><small><sub><i><?php echo $Lsugg1caricafiles ?></small></i></sub></td>
	      <td><small><sub><i><?php echo $Lsugg2caricafiles ?></b>.<br></i></sub></small></td>
	    </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value='upload' type='submit'></td>
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
