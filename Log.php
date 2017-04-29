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
$langlog = $_SESSION['lingua'];
$paginalog = "log.inc";
$lingualog = ($langlog.$paginalog);
include($lingualog);

if ($user == 'admin') {
include('./top.inc');
include('./menu.inc');
?>

<table align='center' border='0' width='80%'>
<tbody>
      <tr><td><center><h2><?php echo $Ltitololog ?></h2><hr></center></td></tr>
<tr><td align='right'><small><a href="./CancLog.php"><?php echo $Lcanclog ?></a></small></td></tr>
<tr><td><small><?php include('./log/logSinx.txt') ?></small></td></tr>
      
</tbody>
</table>
<?php

include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $Lsugg1log ?><hr></i></small>

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

echo "<center>$Lhelp1log<b>$user</b> <br>$Lhelp2log<b>Admin</b></center>";
redirect('./index2.php',3);
}
?>

