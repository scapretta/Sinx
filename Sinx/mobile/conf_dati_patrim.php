<?php
/*======================================================================+
 File name   : Conf_dati_patrim.php
 Begin       : 2012-09-21
 Last Update : 2012-09-21

 Description : Page of the balance sheet

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
if ($user) {
	$nricavi_oneri = $_POST['patrim'];
	$noperazione = $_POST['operazione'];
	$nvalore = $_POST['valore'];

$ricavi_oneri = htmlspecialchars($nricavi_oneri, ENT_NOQUOTES, "UTF-8");
$operazione = htmlspecialchars($noperazione, ENT_NOQUOTES, "UTF-8");
$valore = htmlspecialchars($nvalore, ENT_NOQUOTES, "UTF-8");

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
		if ($operazione == "")
 		{
   		echo "<center><b>Il campo Operazione &egrave obbligatorio</b></center>";
   		redirect('./InsStatoPatrimoniale.php' ,2);
		// break;
die ("");
		}

		if ($valore == "")
 		{
   		echo "<center><b>Il campo Valore &egrave obbligatorio</b></center>";
   		redirect('./InsStatoPatrimoniale.php' ,2);
		// break;
die ("");
		}

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

$tb_contoec = ('tb_stato_patrimoniale(descrizione, valore, costoricavo)');
	if ($operazione){ 
		$sql="insert into $tb_contoec values('$operazione', '$valore', '$ricavi_oneri')"; //inserisco i valori nel database
		$result=mysqli_query($connect, $sql);
		header('location: ./conferma.php?rif=InsStatoPatrimoniale'); //Vado alla pagina di conferma
	}else{ 
		header('location: ./errore.php?rif=InsStatoPatrimoniale'); //Vado alla pagina di errore
		}
mysqli_close($connect);
} else {
header('Location: ./index.php');
}
?>
