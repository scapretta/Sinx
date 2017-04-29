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

	$testo = $_POST['formcontent'];
	$nomenota = $_POST['nome'];


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
	include ('./dati_db.inc');
	$link=mysqli_connect("$host", "$username", "$password","$db_name")or die(mysqli_connect_error("Non posso connettermi al database"));

//CONTROLLO DEI CAMPI

 
		$sql="UPDATE tb_note SET testo='$testo', dest='$nomenota'"; //inserisco i valori nel database
		$result=mysqli_query($link, $sql);

	if (!$result) {

		header('location: errore.php?rif=InsNotepad'); //Vado alla pagina di errore
	}else{ 
		header('location: ./conferma.php?rif=InsNotepad'); //Vado alla pagina di conferma
		}
mysqli_close($link);
} else {
header('Location: ./index2.php');
}
?>
