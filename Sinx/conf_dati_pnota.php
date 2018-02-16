<?php
/*======================================================================+
 File name   : conf_dati_pnota.php
 Begin       : 2010-08-04
 Last Update : 2011-04-08

 Description : Check and confirm data prior notice

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
	$data = $_POST['data'];
	if($data == FALSE){
	$data = date('d-m-Y');
	}	
	$contoec = $_POST['contoec'];
	$operazione = $_POST['operazione'];
	$valore = $_POST['valore'];
	$conto = $_POST['conto'];

	include ('./dati_db.inc');
	$connect = mysqli_connect("$host", "$username", "$password", "$db_name", $port ) or die("cannot connect DB");

//$soperazione = htmlspecialchars($noperazione, ENT_NOQUOTES, "UTF-8");
//$operazione = mysqli_real_escape_string($connect, $soperazione);


switch ($conto) {
 case 'entrata':
$entrata = $valore;
break;
 case 'uscita':
$uscita = $valore;
break;
 case 'entratab':
$entratab = $valore;
break;
 case 'uscitab':
$uscitab = $valore;
break;
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
		if ($operazione == "")
 		{
   		echo "<center><b>Il campo Operazione &egrave obbligatorio</b></center>";
   		redirect('./InsPrimanota.php' ,2);
		break;
		}



//Inserisco dati nella tabella primanota
$tb_primanota = ('tb_primanota(data_registr, descrizione, entrata, uscita, entratab, uscitab)');
	if ($operazione){ 
		$sql="insert into $tb_primanota values('$data', '$operazione', ".($entrata ? "'$entrata'" : "null").", ".($uscita ? "'$uscita'" : "null").", ".($entratab ? "'$entratab'" : "null").", ".($uscitab ? "'$uscitab'" : "null").")"; //inserisco i valori nel database
		$result=mysqli_query($connect, $sql);
		header('location: ./conferma.php?rif=InsPrimanota'); //Vado alla pagina di conferma
	}else{ 
		header('location: ./errore.php?rif=InsPrimanota'); //Vado alla pagina di errore
		}
// Aggiornamento tabella conto economico
  //Recupero il valore originale e lo aggiorno
    $query = "SELECT valore FROM tb_conto_economico WHERE descrizione = '$contoec'";
    $result = mysqli_query($connect,  $query);
    $valoreorig = mysqli_fetch_row($result);
$nuovovalore = ($valoreorig[0] + $valore);

		$sql="UPDATE tb_conto_economico SET valore = '$nuovovalore' WHERE descrizione = '$contoec'"; //inserisco i valori nel database
		$result=mysqli_query($connect, $sql);

mysqli_close($connect);
} else {
header('Location: ./index.php');
}
?>
