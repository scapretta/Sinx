<?php
/*======================================================================+
 File name   : Install.php
 Begin       : 2013-01-09
 Last Update : 2013-01-13

 Description : confirm a canc date calendar

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
=========================================================================+
*/

  session_start();

$user = $_SESSION['utente'];
if ($user) {

	$id = $_POST['id'];

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
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

		if ($id == "")
 		{
   		echo "<center><b>Il campo Id &egrave obbligatorio</b></center>";
   		redirect('./Calendario2.php' ,2);
		// break;
die ("");
		}

		$sql="DELETE FROM appuntamenti WHERE id = '$id'"; //inserisco i valori nel database
		$result=mysqli_query($connect, $sql);

	if (!$result) {
 die(header('location: ./errore.php?rif=Calendario2'));//"Errore nella query $query: " . mysqli_error());
	//	header('location: errore.html'); //Vado alla pagina di errore
	}else{ 
		header('location: ./conferma.php?rif=Calendario2'); //Vado alla pagina di conferma
		}
mysqli_close($connect);
} else {
header('Location: ./index.php');
}
?>
