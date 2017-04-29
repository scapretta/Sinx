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
   		echo "<center><b>Il campo Numero &egrave obbligatorio</b></center>";
   		redirect('./InsRicFisc.php' ,2);
		// break;
die ("");
		}
		if ($campo == "")
 		{
   		echo "<center><b>Il campo 'Campo' &egrave obbligatorio</b></center>";
   		redirect('./InsRicFisc.php' ,2);
		// break;
die ("");
		}
		if ($record == "")
 		{
   		echo "<center><b>Il campo record &egrave obbligatorio</b></center>";
   		redirect('./InsRicFisc.php' ,2);
		// break;
die ("");
		}

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");


		$sql="UPDATE tb_ricevute SET $campo = '$record' WHERE id_ric = '$id_mod'"; //inserisco i valori nel database
		$result=mysqli_query($connect, $sql);
	if (!$result) {
 die(header('location: ./errore.php?rif=InsRicFisc'));//"Errore " . mysqli_error());

	}else{ 
		$cancella="DELETE FROM tb_primanota WHERE id_ricevuta = '$id_mod'";
		$stato=mysqli_query($connect, $cancella);
	if (!$stato) {
 die(header('location: ./errore.php?rif=InsRicFisc'));//"Errore " . mysqli_error());

	}else{ 

 //Carico in un array i dati da sincronizzare
$Query = "SELECT * FROM tb_ricevute WHERE id_ric = '$id_mod'";
$rs=mysqli_query($connect, $Query)
or die('' . mysqli_error());

while ($row=mysqli_fetch_array($rs))
{
$nome = $row['nome'];
$idric = $row['id_ric'];
$data = $row['data'];
$euro = $row['euro'];
$attivita = $row['descr'];
$descrizione = "$attivita $nome"; 
}
//Aggiorno la prima nota
$tb_paga = ('tb_primanota(nome, id_ricevuta, data_registr, entrata, descrizione)');
		$inserisci="insert into $tb_paga values('$nome', '$idric', '$data', '$euro', '$descrizione')";
		$risultato=mysqli_query($connect, $inserisci);
	if (!$risultato) {
 //die(header('location: ./errore.php?rif=InsRicFisc'));//"Errore " . mysqli_error());
		header('location: ./errore.php?rif=InsRicFisc'); //Vado alla pagina di errore
	}else{ 
		header('location: ./conferma.php?rif=InsRicFisc'); //Vado alla pagina di conferma
		}
	    }
	}
mysqli_close($connect);
} else {
header('Location: ./index.php');
}
?>
