<?php
/*======================================================================+
 File name   : Install.php
 Begin       : 2013-01-09
 Last Update : 2013-01-15

 Description : confirm a cancel ricevute

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
	$id_canc = $_POST['id_canc'];
	$contoec = $_POST['contoec'];
	//$id_canc = htmlspecialchars($nid_canc, ENT_NOQUOTES, "UTF-8");

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

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
		if ($id_canc == "")
 		{
   		echo "<center><b>Il campo Numero &egrave obbligatorio</b></center>";
   		redirect('./InsRicFisc.php' ,2);
		// break;
die ("");
		}

//Cancello dalla prima nota
		$sql="DELETE FROM tb_primanota WHERE id_ricevuta = '$id_canc'";
		$result=mysqli_query($connect, $sql);

	if (!$result) {
 die(header('location: ./errore.php?rif=InsRicFisc'));//"Errore nella query $query: " . mysqli_error());
		//header('location: errore.html'); //Vado alla pagina di errore
	}else{ 

//Cancello dal conto economico
		$nsql="SELECT euro FROM tb_ricevute WHERE id_ric = '$id_canc'";
		$nresult=mysqli_query($connect, $nsql) or die(header('location: ./errore.php?rif=InsRicFisc'));

$nrow=mysqli_fetch_row($nresult);


    $nquery = "SELECT valore FROM tb_conto_economico WHERE descrizione = '$contoec'";
    $nnresult = mysqli_query($connect, $nquery);
    $valoreorig = mysqli_fetch_row($nnresult);
$nuovovalore = ($valoreorig[0] - $nrow[0]);

		$ssql="UPDATE tb_conto_economico SET valore = '$nuovovalore' WHERE descrizione = '$contoec'"; //inserisco i valori nel database
		$rresult=mysqli_query($connect, $ssql);

	if (!$rresult) {
 die(header('location: ./errore.php?rif=InsRicFisc'));//"Errore nella query $query: " . mysqli_error());
		//header('location: errore.html'); //Vado alla pagina di errore 
	}else{ 

//Cancello dalle ricevute
		$sql="DELETE FROM tb_ricevute WHERE id_ric = '$id_canc'";
		$result=mysqli_query($connect, $sql);

	if (!$result) {
 die(header('location: ./errore.php?rif=InsRicFisc'));//"Errore nella query $query: " . mysqli_error());
	//	header('location: errore.html'); //Vado alla pagina di errore
	}else{ 
		header('location: ./conferma.php?rif=InsRicFisc'); //Vado alla pagina di conferma
		}
}
}
mysql_close();
} else {
header('Location: ./index.php');
}
?>
