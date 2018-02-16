<?php
/*======================================================================+
 File name   : conf_canc.php
 Begin       : 2013-01-09
 Last Update : 2013-01-14

 Description : confirm a generic cancel date

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
$Tabella = 'tb_primanota';
$contoec = $_POST['nomecontoec'];

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
/* LO STATO PATRIMONIALE PRENDE LE SOMME DIRETTAMENTE DAI TOTALI DELLA PRIMA NOTA */
		if ($id_canc == "")
 		{
   		echo "<center><b>Il campo &egrave obbligatorio</b></center>";
   		redirect('./insPrimanota.php' ,2);
		// break;
die ("");
		}
		if ($contoec == "")
 		{
   		echo "<center><b>Devi selezionare la voce del conto economico</b></center>";
   		redirect('./insPrimanota.php' ,2);
		// break;
die ("");
		}

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

	
		$attivo="SELECT entrata,entratab FROM tb_primanota WHERE id_primanota = '$id_canc'"; //Raccolgo il valore pnota positivo
		$rvalore=mysqli_query($connect, $attivo);
		$row=mysqli_fetch_row($rvalore);
		$valore = $row[0]+$row[1];
		
		$passivo="SELECT uscita,uscitab FROM tb_primanota WHERE id_primanota = '$id_canc'"; //Raccolgo il valore pnota negativo
		$rvalore2=mysqli_query($connect, $passivo);
		$row2=mysqli_fetch_row($rvalore2);
		$valore2 = $row2[0]+$row2[1];
		
		$sqlistrce="SELECT valore FROM tb_conto_economico WHERE descrizione = '$contoec'"; //recupero il valore originario
		$result2=mysqli_query($connect, $sqlistrce);
		$rowce=mysqli_fetch_row($result2);
		
		if ($valore > 0) {
		$nuovovalorece=($rowce[0]-$valore);

		} else {
		$nuovovalorece=($rowce[0]-$valore2);
		}
		
		//Controllo la voce corretta del conto economico
		if ($nuovovalorece < 0) {
		echo "ATTENZIONE il valore aggiornato risulta negativo, controlla la voce del conto economico inserita";
		redirect('./InsPrimanota.php',3);
		// break;
die ("");
		}
		
		
		$aggiornamentoce="UPDATE tb_conto_economico SET valore = $nuovovalorece WHERE descrizione = '$contoec'";
		//correggo il valore della primanota dal conto economico
		$resultce = mysqli_query($connect, $aggiornamentoce);
		// $risce = mysqli_fetch_row($resultce);

 
		$sql = "DELETE FROM tb_primanota WHERE id_primanota = '$id_canc'"; //inserisco i valori nel database
		$result = mysqli_query($connect, $sql);
		
 

	if (!$result) {
 die(header('location: ./errore.php?rif=insPrimanota'));//"Errore nella query $query: " . mysqli_error());
		 //Vado alla pagina di errore
	}else{ 
	echo "<img src='./Immagini/dialog_ok_apply.png' height='50px'> Aggiorno Conto economico $contoec ...".'<br>';
	echo "<img src='./Immagini/dialog_ok_apply.png' height='50px'> Aggiorno Stato patrimoniale ...".'<br>';
	echo "<img src='./Immagini/dialog_ok_apply.png' height='50px'> Aggiorno Prima nota ...";
	
	redirect('./conferma.php?rif=InsPrimanota',2); //Vado alla pagina di conferma
		}
mysqli_close($connect);
} else {
header('Location: ./index2.php');
}
?>
