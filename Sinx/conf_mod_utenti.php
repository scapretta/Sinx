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
if ($user) {

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

	$id_mod = $_POST['id_mod'];
	$campo = $_POST['campo'];
	$nrecord = $_POST['record'];

if($campo == "pswd"){
	$record = MD5($nrecord);
}else{
	$record = htmlspecialchars($nrecord, ENT_NOQUOTES, "UTF-8");

}

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

//Controllo campi compilati
		if ($id_mod == "")
 		{
   		echo "<center><b>Il campo id &egrave obbligatorio</b></center>";
   		redirect('./InsUtente.php' ,2);
		// break;
die ("");
		}
		if ($campo == "")
 		{
   		echo "<center><b>Il campo &egrave obbligatorio</b></center>";
   		redirect('./InsUtente.php' ,2);
		// break;
die ("");
		}
		if ($record == "")
 		{
   		echo "<center><b>Il campo Nuovo Record &egrave obbligatorio</b></center>";
   		redirect('./InsUtente.php' ,2);
		// break;
die ("");
		}

		$sql="UPDATE utenti SET $campo = '$record' WHERE id = '$id_mod'"; //inserisco i valori nel database
		$result=mysqli_query($connect, $sql);

	if (!$result) {
	redirect('./errore.php?rif=InsUtente',2);
// die(header('location: ./errore.php?rif=InsUtente'));
	}else{ 
	redirect('./conferma.php?rif=InsUtente',2);
		}
mysqli_close($connect);
} else {
header('Location: ./index2.php');
}
?>
