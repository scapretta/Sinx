<?php
/*======================================================================+
 File name   : Nuovo_Anno_soc.php
 Begin       : 2012-12-28
 Last Update : 2012-12-28

 Description : New social year, delete all contabiles

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
$langNannosoc = $_SESSION['lingua'];
$paginaNannosoc = "Nannosoc.inc";
$linguaNannosoc = ($langNannosoc.$paginaNannosoc);
include($linguaNannosoc);

if ($user == 'admin') {
include('./top.inc');
include('./menu.inc');
?>
<html>
<head>
  <title><?php echo $LtitoloNannosoc ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<div style="text-align: center;"><span
 style="font-weight: bold;"><br><?php echo $LattenzioneNannosoc ?><br><br>
<?php echo $LavvertenzaNannosoc ?></span><br style="font-weight: bold;"><br>
<a href='./Stampa_Anno.php'><img src="./ImmTemplate/Pulsanti/Archivia.png" title="Creazione file per achivio e stampa" ></img></a>
<a href='./cancella_anno_sociale.php'><img src="./ImmTemplate/Pulsanti/Azzera.png" title="Azzeramenti contabili" ></img></a><br>
<hr style="width: 80%; height: 2px;">
 <span style="font-weight: bold;"><a
 href="./index2.php"><?php echo $LannullaesciNannosoc ?></a></span><br>
</div>
</body>
</html>

<?php
include('./menusx.inc');
?><hr><img src='./Immagini/suggerimento.png'><small><i><?php echo $LmsarchiviaNannosoc ?><hr></i></small><?
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

echo "<center>$Lmslogin1Nannosoc<b>$user</b> <br>$Lmslogin2Nannosoc<b>$Lmslogin3Nannosoc</b></center>";
redirect('./index2.php',3);
}
?>
