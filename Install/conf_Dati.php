<?php
/*======================================================================+
 File name   : conf_dati.php
 Begin       : 2010-08-04
 Last Update : 2012-07-08

 Description : confirm data

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
//Apro il db
	include ('../dati_db.inc');
	$link=mysqli_connect("$host", "$username", "$password","$db_name")or die(mysqli_connect_error("Non posso connettermi al database"));

	$nome = $_POST['nome'];
	$indirizzo = $_POST['indirizzo'];
	$numero = $_POST['numero'];
	$cap = $_POST['cap'];
	$citta = $_POST['citta'];
	$provincia = $_POST['provincia'];
	$tel = $_POST['tel'];
	$fax = $_POST['fax'];
	$cf = $_POST['cf'];
	$email = $_POST['email'];
	$webmail = $_POST['webmail'];
	$sito = $_POST['sito'];
	
$provenienza = $_SERVER['HTTP_REFERER'];
$data = date("d-m-y"); $ora = date("G:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];

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
		if ($nome == "")
 		{
   		echo "<center><b>Il campo nome &egrave obbligatorio</b></center>";
   		redirect('./Install3.php' ,2);
		break;
		}
		if ($cf == "")
 		{
   		echo "<center><b>Il campo Codice fiscale &egrave obbligatorio</b></center>";
   		redirect('./Install3.php' ,2);
		break;
		}



//popolo la tabella
$tb_anagrafe = ('tb_anagrafe_associaz(nome, indirizzo, numero, cap, citta, provincia, tel, fax, cf, email, webmail, sito)');
	if ($nome){ 
		$sql="insert into $tb_anagrafe values('$nome','$indirizzo','$numero','$cap','$citta','$provincia','$tel','$fax','$cf','$email','$webmail','$sito')"; //inserisco i valori nel database
		$result=mysqli_query($link, $sql);
	
$recipient = "info@sinx.it";
$subject = $provenienza;
$formcontent = "$nome ha installato Sinx";
$mailheader = "$data<br>$ip<br>$provenienza<br>$browser";
mail($recipient, $subject, $formcontent, $mailheader);

		echo("<center><h2>Installazione effettuata</h2></center>");
		redirect('../index.php' ,2); //Vado alla pagina di conferma
	}else{ 
		echo("Errore nell'inserimento dei dati"); //Vado alla pagina di errore
		}
mysqli_close($link);
?>
