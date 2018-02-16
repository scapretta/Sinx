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

	$id_mod = $_POST['id_mod'];
	$campo = $_POST['campo'];
	$nrecord = $_POST['record'];
	$Tabella = $_GET['Tabella'];
	
	//Per i redirect a seconda di quali pagine sono
	if ($Tabella == "tb_stato_patrimoniale")
	{
	$riferimento = "./InsStatoPatrimoniale.php";
	$rifconf = "InsStatoPatrimoniale";
	} else {
	$riferimento = "./InsContoEconomico";
	$rifconf = "InsContoEconomico";
	} 

$record = htmlspecialchars($nrecord, ENT_NOQUOTES, "UTF-8");

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
   		redirect($riferimento ,2);
		// break;
die ("");
		}
		if ($campo == "")
 		{
   		echo "<center><b>Il campo 'Campo' &egrave obbligatorio</b></center>";
   		redirect($riferimento ,2);
		// break;
die ("");
		}
		if ($record == "")
 		{
   		echo "<center><b>Il campo Nuovo record &egrave obbligatorio</b></center>";
   		redirect($riferimento ,2);
		// break;
die ("");
		}

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

 
		$sql="UPDATE $Tabella SET $campo = '$record' WHERE id = '$id_mod'"; //inserisco i valori nel database
		$result=mysqli_query($connect, $sql);

	if (!$result) {
 die(header("location: ./errore.php?rif=$rifconf"));//"Errore nella query $query: " . mysqli_error());
	//	header('location: errore.html'); //Vado alla pagina di errore
	}else{ 
		header("location: ./conferma.php?rif=$rifconf"); //Vado alla pagina di conferma
		}
mysqli_close($connect);
} else {
header('Location: ./index.php');
}
?>
