<?php
/*======================================================================+
 File name   : incasso_fattura.php
 Begin       : 2010-08-04
 Last Update : 2011-04-08

 Description : Confirm and Control
	       Compilation tax bills

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
include('./top.inc');
include('./menu.inc');

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

$fattura = $_POST['id'];
$contoec = $_POST['contoec'];

//Controllo dati
		if ($fattura == "")
 		{
   		echo "<center><b>Numero fattura non selezionato</b><br>Inserisci un numero di fattura</center>";
   		redirect('./InsFattura.php',2);
		// break;
die ("");
		}
		if ($contoec == "Causale")
 		{
   		echo "<center><b>Inserire la causale conto economico</b><br>Inserisci un numero di fattura</center>";
   		redirect('./InsFattura.php',2);
		// break;
die ("");
		}

$cassa = $_POST['incasso'];
$data = date('d-m-Y');

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");


//Recupera fattura
$operazione= "Incasso fattura n. $fattura";

$query = "SELECT SUM(totale) as totale_numero FROM tb_fatture WHERE id_fatt = $fattura";
$result = mysqli_query($connect,  $query);
  $row = mysqli_fetch_array($result);

if ($cassa == 'cassa') {
$entrata = $row['totale_numero'];
$valore = $entrata;
} else {
$entratab = $row['totale_numero'];
$valore = $entratab;
}

$tb_primanota = ('tb_primanota(data_registr, descrizione, entrata, uscita, entratab, uscitab)');
	if ($operazione){ 
		$sql="insert into $tb_primanota values('$data', '$operazione', ".($entrata ? "'$entrata'" : "null").", ".($uscita ? "'$uscita'" : "null").", ".($entratab ? "'$entratab'" : "null").", ".($uscitab ? "'$uscitab'" : "null").")"; //inserisco i valori nel database
		$risultato = mysqli_query($connect, $sql);

// Aggiornamento tabella conto economico
  //Recupero il valore originale e lo aggiorno
    $query = "SELECT valore FROM tb_conto_economico WHERE descrizione = '$contoec'";
    $result = mysqli_query($connect,  $query);
    $valoreorig = mysqli_fetch_row($result);
$nuovovalore = ($valoreorig[0] + $valore);

		$sql="UPDATE tb_conto_economico SET valore = '$nuovovalore' WHERE descrizione = '$contoec'"; //inserisco i valori nel database
		$result=mysqli_query($connect, $sql);

   		redirect('./conferma.php?rif=InsPrimanota' ,2);
		// break;
die ("");

	}else{ 
		header('location: ./errore.php'); //Vado alla pagina di errore
		}
mysqli_close($connect);
} else {
header('Location: ./index.php');
}
?>
