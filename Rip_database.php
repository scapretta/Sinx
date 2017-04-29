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
$langripdatabase = $_SESSION['lingua'];
$paginaripdatabase = "ripdatabase.inc";
$linguaripdatabase = ($langripdatabase.$paginaripdatabase);
include($linguaripdatabase);

if ($user == 'admin') {
include('./top.inc');
include('./menu.inc');

?>
<h2><?php echo $Lpresentazionebackup; ?></h2>
<hr width='80%'><br>

<h3><?php echo $Lbackup; ?></h3>
<center><sub><i><?php echo $Lcomandobackup; ?></center>
<center><a class="transp" href='./Backup_database.php'><img src="./ImmTemplate/Pulsanti/Backup.png" title="Effettua un backup dei dati del database" ></img></a></center>
<hr width='60%'><br>

<h3><?php echo $Lripristino; ?></h3>
<center><sub><i><?php echo $Listrripristino; ?></center>
<br>
      <form action='conf_ripBack.php' method='POST' enctype="multipart/form-data">
<table align='center' width='60%'>

	    <tr>
	      <td width='30%'><?php echo $Lfilebackup; ?><input type="hidden" name="MAX_FILE_SIZE" value="300000000"> </td>
	      <td> <input name="backup" type="file" accept="text/*"></td>
	    </tr>
            <tr>
              <td colspan='2' align='center'>
              <input value=<? echo $Linvia; ?> type='submit'></td>
            </tr>
</table>
</form>

<?php

include('./menusx.inc');
echo $Lhelpbackup;
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

echo $Lutentelimitato;
redirect('./index2.php',3);
}
?>
