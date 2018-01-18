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
	$data = $_POST['data'];
	if($data == FALSE){
	$data = date('d-m-Y');
	}	
	$ndescrizione = $_POST['Descr'];
	$nquantita = $_POST['Qta'];
	$nprezzoun = $_POST['prezzoun'];
	$nnumfattura = $_POST['fattnum'];
	$nnome = $_POST['nome'];
	$niva = $_POST['iva'];

$descrizione = htmlspecialchars($ndescrizione, ENT_NOQUOTES, "UTF-8");
$quantita = htmlspecialchars($nquantita, ENT_NOQUOTES, "UTF-8");
$prezzoun = htmlspecialchars($nprezzoun, ENT_NOQUOTES, "UTF-8");
$numfattura = htmlspecialchars($nnumfattura, ENT_NOQUOTES, "UTF-8");
$nome = htmlspecialchars($nnome, ENT_NOQUOTES, "UTF-8");
$iva = htmlspecialchars($niva, ENT_NOQUOTES, "UTF-8");


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
		if ($descrizione == "")
 		{
   		echo "<center><b>Il campo Descrizione &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		// break;
die ("");
		}
		if ($quantita == "")
 		{
   		echo "<center><b>Il campo Quantit&agrave &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		// break;
die ("");
		}
		if ($prezzoun == "")
 		{
   		echo "<center><b>Il campo Prezzo unitario &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		// break;
die ("");
		}
		if ($numfattura == "")
 		{
   		echo "<center><b>Il campo Numero Fattura &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		// break;
die ("");
		}
		if ($nome == "")
 		{
   		echo "<center><b>Il campo Nome Cliente &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		// break;
die ("");
		}
		if ($iva == "")
 		{
   		echo "<center><b>Il campo iva &egrave obbligatorio</b></center>";
   		redirect('./InsFattura.php' ,2);
		// break;
die ("");
		}

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

//Inserisco i dati nella tabella dei record della singola fattura
$totfattura = $quantita * ($prezzoun + ($prezzoun * ( $iva / 100)));
$tb_fattura = ('tb_fatture(id_fatt, nome, data, euro, quantita, descr, iva, totale)');
$tb_tot_fattura = ('tb_tot_fatture(id_tot_fatture, tot_fattura, nome, data)');

	if ($totfattura){ 
		$sql="insert into $tb_fattura values('$numfattura', '$nome', '$data', '$prezzoun', '$quantita', '$descrizione', '$iva', '$totfattura')";
		$result=mysqli_query($connect, $sql) or die (mysqli_error());

//Aggiorno i totali della singola fattura
$query = "SELECT SUM(totale) as totale_numero FROM tb_fatture WHERE id_fatt = $numfattura";
$result = mysqli_query($connect,  $query);
if($result) {
  $row = mysqli_fetch_array($result);
$totale = $row['totale_numero'];

$totfatt="insert into $tb_tot_fattura values('$numfattura', '$totale', '$nome', '$data')";
$risultato = mysqli_query($connect, $totfatt);

} else {
  echo mysqli_error();
}


		header('location: ./conferma.php?rif=InsFattura'); //Vado alla pagina di conferma
	}else{ 
		header('location: ./errore.php?rif=InsFattura'); //Vado alla pagina di errore
		}
mysqli_close($connect);
} else {
header('Location: ./index.php');
}
?>
